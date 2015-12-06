<?php

namespace common\models\menu;

use Yii;
use common\widgets\Icon;
use cornernote\returnurl\ReturnUrl;

/**
 * Description of ReligionMenu
 *
 * @author fredy
 */
class ReligionMenu extends \common\base\ModelMenu
{

	/* ================ helper ================ */

	/**
	 * return complete-route to controller
	 *
	 * @return string
	 */
	static function controllerRoute()
	{
		return '/religion';

	}

	/* ================ links ================ */

	/**
	 * deleted link param
	 *
	 * @return array
	 */
	static function linkParamDeleted()
	{
		return [
			'label'			 => Icon::create([
				'icon'	 => 'trash',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">Deleted</span>',
			]),
			'url'			 => [
				static::actionRoute('deleted'),
				'ru' => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-default',
			],
		];

	}

	/**
	 * link param to restore model
	 *
	 * @return array
	 */
	static function linkParamRestore($model = NULL)
	{
		$primaryKey = $model->primaryKey()[0];

		return [
			'label'			 => Icon::create([
				'icon'	 => 'back',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">Restore</span>',
			]),
			'url'			 => [
				static::actionRoute('restore'),
				$primaryKey	 => $model->$primaryKey,
				'ru'		 => ReturnUrl::getToken(),
			],
			'buttonOptions'	 => [
				'class' => 'btn btn-default',
			],
		];

	}

}
