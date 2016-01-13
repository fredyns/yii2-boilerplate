<?php

namespace frontend\modules\region\models\form;

use Yii;
use frontend\modules\region\models\District;
use frontend\modules\region\behaviors\CountryBehavior;
use frontend\modules\region\behaviors\ProvinceBehavior;
use frontend\modules\region\behaviors\CityBehavior;

/**
 * Description of DistrictForm
 *
 * @author fredy
 */
class DistrictForm extends District
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

	/*
	 * auto parse attribute
	 */

	public function behaviors()
	{
		return [
			/* auto register new country */
			[
				'class'				 => CountryBehavior::className(),
				'countryAttribute'	 => 'country_id',
			],
			/* auto register new province */
			[
				'class'				 => ProvinceBehavior::className(),
				'countryAttribute'	 => 'country_id',
				'provinceAttribute'	 => 'province_id',
			],
			/* auto register new city */
			[
				'class'				 => CityBehavior::className(),
				'provinceAttribute'	 => 'province_id',
				'cityAttribute'		 => 'city_id',
			],
		];

	}

}
