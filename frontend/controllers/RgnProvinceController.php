<?php

namespace frontend\controllers;

use frontend\models\RgnProvince;
use frontend\models\access\RgnProvinceAccess;
use frontend\models\form\RgnProvinceForm;
use frontend\models\search\RgnProvinceSearch;
use common\base\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use cornernote\returnurl\ReturnUrl;

/**
 * RgnProvinceController implements the CRUD actions for RgnProvince model.
 */
class RgnProvinceController extends Controller
{

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 * Lists all active RgnProvince models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		if (RgnProvinceAccess::allowIndex() == FALSE)
		{
			throw RgnProvinceAccess::exception('index');
		}

		$searchModel = new RgnProvinceSearch;
		$dataProvider = $searchModel->searchIndex($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('index', [
				'dataProvider'	 => $dataProvider,
				'searchModel'	 => $searchModel,
		]);

	}

	/**
	 * Lists all deleted RgnProvince models.
	 * @return mixed
	 */
	public function actionDeleted()
	{
		if (RgnProvinceAccess::allowDeleted() == FALSE)
		{
			throw RgnProvinceAccess::exception('deleted');
		}

		$searchModel = new RgnProvinceSearch;
		$dataProvider = $searchModel->searchDeleted($_GET);

		Tabs::clearLocalStorage();

		Url::remember();
		\Yii::$app->session['__crudReturnUrl'] = null;

		return $this->render('deleted', [
				'dataProvider'	 => $dataProvider,
				'searchModel'	 => $searchModel,
		]);

	}

	/**
	 * Displays a single RgnProvince model.
	 * @param integer $id
	 *
	 * @return mixed
	 */
	public function actionView($id)
	{
		$model = $this->findModel($id);

		if ($model->operation->allowView == FALSE)
		{
			throw $model->operation->exception('view');
		}

		\Yii::$app->session['__crudReturnUrl'] = ReturnUrl::getUrl(Url::previous());
		Url::remember();
		Tabs::rememberActiveState();

		return $this->render('view', [
				'model' => $model,
		]);

	}

	/**
	 * Creates a new RgnProvince model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		if (RgnProvinceAccess::allowCreate() == FALSE)
		{
			throw RgnProvinceAccess::exception('create');
		}

		$model = new RgnProvinceForm();

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
	 * Updates an existing RgnProvince model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findForm($id);

		if ($model->operation->allowUpdate == FALSE)
		{
			throw $model->operation->exception('update');
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
	 * Deletes an existing RgnProvince model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		try
		{
			$model = $this->findModel($id);

			if ($model->operation->allowDelete == FALSE)
			{
				throw $model->operation->exception('delete');
			}

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
	 * Finds the RgnProvince model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnProvince the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = RgnProvince::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Finds the RgnProvince model based on its primary key value for form purpose.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return RgnProvince the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findForm($id)
	{
		if (($model = RgnProvinceForm::findOne($id)) !== null)
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
			'modelClass' => RgnProvince::className(),
			'parents'	 => [
				'country_id' => function($value)
				{
					return ($value > 0) ? $value : "";
				},
			],
			'filter'	 => [
				'recordStatus' => RgnProvince::RECORDSTATUS_USED,
			],
			'selected'	 => $selected,
		]);

	}

}
