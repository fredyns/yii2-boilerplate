<?php

namespace frontend\controllers;

use frontend\models\RgnDistrict;
use frontend\models\form\RgnDistrictForm;
use frontend\models\search\RgnDistrictSearch;
use frontend\models\control\RgnDistrictControl;
use common\base\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use cornernote\returnurl\ReturnUrl;

/**
 * RgnDistrictController implements the CRUD actions for RgnDistrict model.
 */
class RgnDistrictController extends Controller
{

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 * Lists all RgnDistrict models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		/* checking access control */

		if (RgnDistrictControl::isAccessingIndexAllowed() == FALSE)
		{
			throw RgnDistrictControl::accessException('index');
		}

		$searchModel = new RgnDistrictSearch;
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
	 * Lists all deleted RgnDistrict models.
	 * @return mixed
	 */
	public function actionDeleted()
	{
		/* checking access control */

		if (RgnDistrictControl::isAccessingDeletedAllowed() == FALSE)
		{
			throw RgnDistrictControl::accessException('deleted');
		}

		/* search model */

		$searchModel = new RgnDistrictSearch;
		$dataProvider = $searchModel->searchActive($_GET);

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
	 * Displays a single RgnDistrict model.
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
	 * Creates a new RgnDistrict model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new RgnDistrictForm;

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
	 * Updates an existing RgnDistrict model.
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
	 * Deletes an existing RgnDistrict model.
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
	 * Restore deleted RgnCity model.
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
	 * Finds the RgnDistrict model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnDistrict the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = RgnDistrict::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Finds the RgnDistrict form based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnDistrict the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findForm($id)
	{
		if (($model = RgnDistrictForm::findOne($id)) !== null)
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
			'modelClass' => RgnDistrict::className(),
			'parents'	 => [
				'city_id' => function($value)
				{
					return ($value > 0) ? $value : "";
				},
			],
			'selected' => $selected,
		]);

	}

}
