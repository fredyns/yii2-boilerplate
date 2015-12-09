<?php

namespace frontend\controllers;

use frontend\models\Religion;
use frontend\models\form\ReligionForm;
use frontend\models\search\ReligionSearch;
use frontend\models\control\ReligionControl;
use common\base\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use cornernote\returnurl\ReturnUrl;

/**
 * ReligionController implements the CRUD actions for Religion model.
 */
class ReligionController extends Controller
{

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 * Lists all Religion models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		/* checking access control */

		if (ReligionControl::isAccessingIndexAllowed() == FALSE)
		{
			throw ReligionControl::accessException('index');
		}

		/* search model */

		$searchModel = new ReligionSearch;
		$dataProvider = $searchModel->searchActive($_GET);

		/* setup widget & functionality */

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		/* rendering view */

		return $this->render('index', [
				'dataProvider'	 => $dataProvider,
				'searchModel'	 => $searchModel,
		]);

	}

	/**
	 * Lists all deleted Religion models.
	 * @return mixed
	 */
	public function actionDeleted()
	{
		/* checking access control */

		if (ReligionControl::isAccessingDeletedAllowed() == FALSE)
		{
			throw ReligionControl::accessException('deleted');
		}

		/* search model */

		$searchModel = new ReligionSearch;
		$dataProvider = $searchModel->searchDeleted($_GET);

		/* setup widget & functionality */

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		/* rendering view */

		return $this->render('deleted', [
				'dataProvider'	 => $dataProvider,
				'searchModel'	 => $searchModel,
		]);

	}

	/**
	 * Displays a single Religion model.
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id)
	{
		/* setup widget & functionality */

		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();
		Tabs::rememberActiveState();

		/* find requested model */

		$model = $this->findModel($id);

		/* checking access control, based on model data */

		if ($model->control->isActionViewAllowed == FALSE)
		{
			throw $model->control->actionException('view');
		}

		/* rendering view */

		return $this->render('view', [
				'model' => $model,
		]);

	}

	/**
	 * Creates a new Religion model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		/* create new model as data container */

		$model = new ReligionForm();

		/* checking access control, based on model data */

		if ($model->control->isActionCreateAllowed == FALSE)
		{
			throw $model->control->actionException('create');
		}

		/* start data operation */

		try
		{
			/* try to save */

			if ($model->load($_POST) && $model->save())
			{
				/* successfull, redirect to previous page */

				return $this->redirect(ReturnUrl::getUrl(Url::previous()));
			}
			elseif (!\Yii::$app->request->isPost)
			{
				/* when not posting a form, catch form prefill values */

				$model->load($_GET);
			}
		}
		catch (\Exception $e)
		{
			/* catch error */

			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			$model->addError('_exception', $msg);
		}

		/* rendering view */

		return $this->render('create', ['model' => $model]);

	}

	/**
	 * Updates an existing Religion model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		/* find requested model */

		$model = $this->findForm($id);

		/* checking access control, based on model data */

		if ($model->control->isActionUpdateAllowed == FALSE)
		{
			throw $model->control->actionException('update');
		}

		/* try to save new data */

		if ($model->load($_POST) && $model->save())
		{
			/* back to previos page */

			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}
		else
		{
			/* rendering view */

			return $this->render('update', [
					'model' => $model,
			]);
		}

	}

	/**
	 * Deletes an existing Religion model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		/* find requested model */

		$model = $this->findModel($id);

		try
		{
			/* checking access control, based on model data */

			if ($model->control->isActionDeleteAllowed == FALSE)
			{
				throw $model->control->actionException('delete');
			}

			/* delete model */

			$model->delete();
		}
		catch (\Exception $e)
		{
			/* catch error */

			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			\Yii::$app->getSession()->setFlash('error', $msg);
			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}

		/* decide page to redirect */

		// TODO: improve detection
		$isPivot = strstr('$id', ',');
		if ($isPivot == true)
		{
			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}
		elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/')
		{
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		}
		else
		{
			return $this->redirect(['index']);
		}

	}

	/**
	 * Restore deleted Religion model.
	 * If restore is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionRestore($id)
	{
		/* find requested model */

		$model = $this->findModel($id);

		try
		{
			/* checking access control, based on model data */

			if ($model->control->isActionRestoreAllowed == FALSE)
			{
				throw $model->control->actionException('restore');
			}

			/* restoring data */

			$model->restore();
		}
		catch (\Exception $e)
		{
			/* catch error */

			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();

			\Yii::$app->getSession()->setFlash('error', $msg);

			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}

		/* decide page to redirect */

		// TODO: improve detection

		$isPivot = strstr('$id', ',');

		if ($isPivot == true)
		{
			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}
		elseif (isset(\Yii::$app->session['__crudReturnUrl']) && \Yii::$app->session['__crudReturnUrl'] != '/')
		{
			Url::remember(null);
			$url = \Yii::$app->session['__crudReturnUrl'];
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		}
		else
		{
			return $this->redirect(['index']);
		}

	}

	/**
	 * Finds the Religion model used in form.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Religion the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findForm($id)
	{
		if (($model = ReligionForm::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Finds the Religion model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Religion the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Religion::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

}
