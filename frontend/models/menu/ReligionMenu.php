<?php

namespace frontend\models\menu;

use Yii;
use common\base\ModelMenu;
use common\widgets\Icon;
use cornernote\returnurl\ReturnUrl;

/**
 * Description of ReligionMenu
 * devine & generate all kinds of menu about religion model
 *
 * @author fredy
 */
class ReligionMenu extends ModelMenu
{

	/* ================ helper ================ */

	/**
	 * return complete-route to controller
	 *
	 * @return string
	 */
	static function controllerRoute()
	{
		return 'religion';

	}

	/* ================ urls ================ */

	static function urlParamDeleted()
	{
		return [
			static::actionRoute('deleted'),
			'ru' => ReturnUrl::getToken(),
		];

	}

	static function urlParamRestore($model = NULL)
	{
		$primaryKey = $model->primaryKey()[0];

		return [
			static::actionRoute('restore'),
			$primaryKey	 => $model->$primaryKey,
			'ru'		 => ReturnUrl::getToken(),
		];

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
			'url'			 => static::urlParamDeleted(),
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
		return [
			'label'			 => Icon::create([
				'icon'	 => 'back',
				'class'	 => 'model-action-icon',
				'text'	 => '<span class="model-action-text">Restore</span>',
			]),
			'url'			 => static::urlParamRestore($model),
			'buttonOptions'	 => [
				'class' => 'btn btn-default',
			],
		];

	}

}
