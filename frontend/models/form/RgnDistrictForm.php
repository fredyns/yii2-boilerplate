<?php

namespace frontend\models\form;

use Yii;
use frontend\models\RgnDistrict;
use common\behaviors\RgnCountryBehavior;
use common\behaviors\RgnProvinceBehavior;
use common\behaviors\RgnCityBehavior;

/**
 * handling 'district' model for modification
 *
 * @author fredy
 */
class RgnDistrictForm extends RgnDistrict
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = parent::rules();

		$rules[] = [['province_id', 'country_id'], 'required'];

		/* new country */
		$rules[] = [
			'country_id',
			'string',
			'max'	 => 255,
			'when'	 => function ($model, $attribute)
			{
				return (is_numeric($model->$attribute) == FALSE);
			},
		];

		/* new province */
		$rules[] = [
			'province_id',
			'string',
			'max'	 => 255,
			'when'	 => function ($model, $attribute)
			{
				return (is_numeric($model->$attribute) == FALSE);
			},
		];

		/* new city */
		$rules[] = [
			'city_id',
			'string',
			'max'	 => 255,
			'when'	 => function ($model, $attribute)
			{
				return (is_numeric($model->$attribute) == FALSE);
			},
		];

		return $rules;

	}

	/**
	 * auto parse attribute
	 *
	 * @return array
	 */
	public function behaviors()
	{
		return [
			/* auto register new country */
			[
				'class'				 => RgnCountryBehavior::className(),
				'countryAttribute'	 => 'country_id',
			],
			/* auto register new province */
			[
				'class'				 => RgnProvinceBehavior::className(),
				'countryAttribute'	 => 'country_id',
				'provinceAttribute'	 => 'province_id',
			],
			/* auto register new city */
			[
				'class'				 => RgnCityBehavior::className(),
				'provinceAttribute'	 => 'province_id',
				'cityAttribute'		 => 'city_id',
			],
		];

	}

}
