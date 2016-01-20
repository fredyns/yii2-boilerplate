<?php

namespace frontend\models\access;

use Yii;
use common\base\ModelAccess;
use cornernote\returnurl\ReturnUrl;
use common\widgets\Icon;

/**
 * Description of RgnCity
 *
 * @author fredy
 */
class RgnCityAccess extends ModelAccess
{

	/**
	 * @inheritdoc
	 */
	static function controllerRoute()
	{
		return 'rgn-city';

	}

	/**
	 * check permision to access deleted model
	 *
	 * @return boolean
	 */
	static function allowDeleted()
	{
		if (array_key_exists('deleted', static::$allowed) == FALSE)
		{
			static::$allowed['deleted'] = TRUE;
		}

		return static::$allowed['deleted'];

	}

	/**
	 * link parameter to access deleted model
	 *
	 * @return array
	 */
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
