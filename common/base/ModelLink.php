<?php

namespace common\base;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Inflector;
use cornernote\returnurl\ReturnUrl;
use common\widgets\Icon;

/**
 * Description of BaseModelLink
 *
 * @author fredy
 */
abstract class ModelLink extends \yii\base\Widget
{

	/* ================ helper ================ */

	static function controllerRoute()
	{
		return '';

	}

	/**
	 * add route to controller
	 *
	 * @param string $action
	 * @return string
	 */
	static function actionRoute($action)
	{
		$controllerRoute = static::controllerRoute();

		return ($controllerRoute !== '') ? "/{$controllerRoute}/{$action}" : $action;

	}

	/**
	 * generate anchor link
	 *
	 * @param string $name
	 * @return string
	 */
	static function a($name = '', $label = '', $model = NULL)
	{
		$linkParams = static::linkParam($name, $model);
		$linkLabel = ($label != '') ? $label : $linkParams['label'];

		if ($linkParams)
		{
			$linkOptions = ArrayHelper::remove($linkParams, 'linkOptions', []);

			return Html::a($linkLabel, $linkParams['url'], $linkOptions);
		}

		return NULL;

	}

	static function btn($name, $model = NULL)
	{
		$linkParams = static::linkParam($name, $model);

		if ($linkParams)
		{
			$linkOptions = ArrayHelper::remove($linkParams, 'linkOptions', []);
			$buttonOptions = ArrayHelper::remove($linkParams, 'buttonOptions', []);
			$buttonOptions = ArrayHelper::merge($linkOptions, $buttonOptions);

			return Html::a($linkParams['label'], $linkParams['url'], $buttonOptions);
		}

		return NULL;

	}

	/* ================ links params ================ */

	/**
	 * index link param
	 *
	 * @return array
	 */
	static function linkParam($name = '', $model = NULL)
	{
		$method = 'linkParam' . Inflector::camelize($name);

		return (method_exists(static::className(), $method)) ? call_user_func_array(array(static::className(), $method), array($model)) : [];

	}

	/**
	 * index link param
	 *
	 * @return array
	 */
	static function linkParamIndex()
	{
		return [
			'label'			 => Icon::create([
				'icon'	 => 'list',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">List</span>',
			]),
			'url'			 => [
				static::actionRoute('index'),
				'ru' => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-success',
			],
		];

	}

	/**
	 * link param to create model
	 *
	 * @return array
	 */
	static function linkParamCreate()
	{
		return [
			'label'			 => Icon::create([
				'icon'	 => 'plus',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">Create</span>',
			]),
			'url'			 => [
				static::actionRoute('create'),
				'ru' => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-success',
			],
		];

	}

	/**
	 * link param to view model
	 *
	 * @return array
	 */
	static function linkParamView($model = NULL)
	{
		$primaryKey = $model->primaryKey()[0];

		return [
			'label'			 => Icon::create([
				'icon'	 => 'eye-open',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">View</span>',
			]),
			'url'			 => [
				static::actionRoute('view'),
				$primaryKey	 => $model->$primaryKey,
				'ru'		 => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-primary',
			],
		];

	}

	/**
	 * link param to update model
	 *
	 * @return array
	 */
	static function linkParamUpdate($model = NULL)
	{
		$primaryKey = $model->primaryKey()[0];

		return [
			'label'			 => Icon::create([
				'icon'	 => 'pencil',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">Update</span>',
			]),
			'url'			 => [
				static::actionRoute('update'),
				$primaryKey	 => $model->$primaryKey,
				'ru'		 => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-primary',
			],
		];

	}

	/**
	 * link param to delete model
	 *
	 * @return array
	 */
	static function linkParamDelete($model = NULL)
	{
		$primaryKey = $model->primaryKey()[0];

		return [
			'label'			 => Icon::create([
				'icon'	 => 'trash',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text text-danger">Delete</span>',
			]),
			'url'			 => [
				static::actionRoute('delete'),
				$primaryKey	 => $model->$primaryKey,
				'ru'		 => ReturnUrl::getToken(),
			],
			/* basic link options */
			'linkOptions'	 => [
				'data-confirm'	 => 'Are you sure to delete this item?',
				'data-method'	 => 'post',
				'class'			 => 'danger',
			],
			/* button option, will overwrite link-options when rendering button */
			'buttonOptions'	 => [
				'class' => 'btn btn-danger',
			],
		];

	}

}
