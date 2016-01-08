<?php

namespace frontend\models\access;

use Yii;
use common\base\ModelAccess;
use cornernote\returnurl\ReturnUrl;
use common\widgets\Icon;

/**
 * Description of RgnProvince
 *
 * @author fredy
 */
class RgnProvinceAccess extends ModelAccess
{

	static function controllerRoute()
	{
		return 'rgn-province';

	}

	static function allowDeleted()
	{
		if (array_key_exists('deleted', static::$allowed) == FALSE)
		{
			static::$allowed['deleted'] = TRUE;
		}

		return static::$allowed['deleted'];

	}

	static function paramsDeleted()
	{
		return [
			'url'			 => [
				static::actionRoute('deleted'),
				'ru' => ReturnUrl::getToken(),
			],
			'label'			 => 'Deleted',
			'icon'			 => Icon::create('trash'),
			'buttonOptions'	 => [
				'class' => 'btn btn-default',
			],
		];

	}

}
