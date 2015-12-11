<?php

namespace frontend\controllers;

use frontend\models\RgnSubdistrict;
use frontend\models\form\RgnSubdistrictForm;
use frontend\models\search\RgnSubdistrictSearch;
use frontend\models\control\RgnSubdistrictControl;
use common\base\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use cornernote\returnurl\ReturnUrl;

/**
 * RgnSubdistrictController implements the CRUD actions for RgnSubdistrict model.
 */
class RgnSubdistrictController extends Controller
{

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 * Lists all RgnSubdistrict models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		/* checking access control */

		if (RgnSubdistrictControl::isAccessingIndexAllowed() == FALSE)
		{
			throw RgnSubdistrictControl::accessException('index');
		}

		$searchModel = new RgnSubdistrictSearch;
		$dataProvider = $searchModel->searchActive($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
				'dataProvider'	 => $dataProvider,
				'searchModel'	 => $searchModel,
		]);

	}

	/**
	 * Lists all deleted RgnSubdistrict models.
	 * @return mixed
	 */
	public function actionDeleted()
	{
		/* checking access control */

		if (RgnSubdistrictControl::isAccessingDeletedAllowed() == FALSE)
		{
			throw RgnSubdistrictControl::accessException('deleted');
		}

		/* search model */

		$searchModel = new RgnSubdistrictSearch;
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
	 * Displays a single RgnSubdistrict model.
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id)
	{
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
	 * Creates a new RgnSubdistrict model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new RgnSubdistrictForm;

		/* checking access control, based on model data */

		if ($model->control->isActionCreateAllowed == FALSE)
		{
			throw $model->control->actionException('create');
		}

		try
		{
			if ($model->load($_POST) && $model->save())
			{
				return $this->redirect(ReturnUrl::getUrl(Url::previous()));
			}
			elseif (!\Yii::$app->request->isPost)
			{
				$model->load($_GET);
			}
		}
		catch (\Exception $e)
		{
			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			$model->addError('_exception', $msg);
		}
		return $this->render('create', ['model' => $model]);

	}

	/**
	 * Updates an existing RgnSubdistrict model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findForm($id);

		/* checking access control, based on model data */

		if ($model->control->isActionUpdateAllowed == FALSE)
		{
			throw $model->control->actionException('update');
		}

		if ($model->load($_POST) && $model->save())
		{
			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}
		else
		{
			return $this->render('update', [
					'model' => $model,
			]);
		}

	}

	/**
	 * Deletes an existing RgnSubdistrict model.
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
			$msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
			\Yii::$app->getSession()->setFlash('error', $msg);
			return $this->redirect(ReturnUrl::getUrl(Url::previous()));
		}

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
			$url = ReturnUrl::getUrl($url);
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		}
		else
		{
			return $this->redirect(['index']);
		}

	}

	/**
	 * Restore deleted RgnSubdistrict model.
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
			$url = ReturnUrl::getUrl($url);
			\Yii::$app->session['__crudReturnUrl'] = null;

			return $this->redirect($url);
		}
		else
		{
			return $this->redirect(['index']);
		}

	}

	/**
	 * Finds the RgnSubdistrict model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnSubdistrict the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = RgnSubdistrict::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Finds the RgnSubdistrict form based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnSubdistrict the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findForm($id)
	{
		if (($model = RgnSubdistrictForm::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Provide data for Depdrop options
	 * @param type $selected
	 *
	 * @return mixed
	 */
	public function actionDepdropOptions($selected = 0)
	{
		echo \common\helpers\DepdropHelper::getOptionData([
			'modelClass' => RgnSubdistrict::className(),
			'parents'	 => [
				'district_id' => function($value)
				{
					return ($value > 0) ? $value : "";
				},
			],
			'selected' => $selected,
		]);

	}

}
