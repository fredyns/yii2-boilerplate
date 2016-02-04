<?php

namespace frontend\modules\region\controllers;

use frontend\modules\region\models\District;
use frontend\modules\region\models\access\DistrictAccess;
use frontend\modules\region\models\form\DistrictForm;
use frontend\modules\region\models\search\DistrictSearch;
use common\base\Controller;
use yii\web\HttpException;
use yii\helpers\Url;
use yii\filters\AccessControl;
use dmstr\bootstrap\Tabs;
use cornernote\returnurl\ReturnUrl;

/**
 * DistrictController implements the CRUD actions for District model.
 */
class DistrictController extends Controller
{

	/**
	 * @var boolean whether to enable CSRF validation for the actions in this controller.
	 * CSRF validation is enabled only when both this property and [[Request::enableCsrfValidation]] are true.
	 */
	public $enableCsrfValidation = false;

	/**
	 * Lists all District models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		if (DistrictAccess::allowIndex() == FALSE)
		{
			throw DistrictAccess::exception('index');
		}

		$searchModel = new DistrictSearch;
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
	 * Lists all District models.
	 * @return mixed
	 */
	public function actionDeleted()
	{
		if (DistrictAccess::allowDeleted() == FALSE)
		{
			throw DistrictAccess::exception('deleted');
		}

		$searchModel = new DistrictSearch;
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
	 * Displays a single District model.
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

		\Yii::$app->session['__crudReturnUrl'] = Url::previous();
		Url::remember();
		Tabs::rememberActiveState();

		return $this->render('view', [
				'model' => $model,
		]);

	}

	/**
	 * Creates a new District model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		if (DistrictAccess::allowCreate() == FALSE)
		{
			throw DistrictAccess::exception('create');
		}

		$model = new District;

		try
		{
			if ($model->load($_POST) && $model->save())
			{
				return $this->redirect(Url::previous());
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
	 * Updates an existing District model.
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
			return $this->redirect(Url::previous());
		}
		else
		{
			return $this->render('update', [
					'model' => $model,
			]);
		}

	}

	/**
	 * Deletes an existing District model.
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
			return $this->redirect(Url::previous());
		}

		// TODO: improve detection
		$isPivot = strstr('$id', ',');
		if ($isPivot == true)
		{
			return $this->redirect(Url::previous());
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
	 * Finds the District model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return District the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = District::findOne($id)) !== null)
		{
			return $model;
		}
		else
		{
			throw new HttpException(404, 'The requested page does not exist.');
		}

	}

	/**
	 * Finds the District model based on its primary key value for modification.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return District the loaded model
	 * @throws HttpException if the model cannot be found
	 */
	protected function findForm($id)
	{
		if (($model = DistrictForm::findOne($id)) !== null)
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
			'modelClass' => District::className(),
			'parents'	 => [
				'city_id' => function($value)
				{
					return ($value > 0) ? $value : "";
				},
			],
			'filter'	 => [
				'recordStatus' => District::RECORDSTATUS_USED,
			],
			'selected'	 => $selected,
		]);

	}

}
