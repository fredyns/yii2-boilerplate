<?php

namespace frontend\modules\region\models\form;

use Yii;
use frontend\modules\region\models\City;
use frontend\modules\region\behaviors\CountryBehavior;
use frontend\modules\region\behaviors\ProvinceBehavior;

/**
 * This is the model class for table "rgn_city".
 *
 */
class CityForm extends City
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = parent::rules();

		$rules[] = [['country_id'], 'required'];

		/* special rule when typing new country */
		$rules[] = [
			'country_id',
			'string',
			'max'	 => 255,
			'when'	 => function ($model, $attribute)
			{
				return (is_numeric($model->$attribute) == FALSE);
			},
		];

		/* special rule when typing new province */
		$rules[] = [
			'province_id',
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
	 * detect when user typing new province & country
	 * register first & replace with their ID
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
		];

	}

}
