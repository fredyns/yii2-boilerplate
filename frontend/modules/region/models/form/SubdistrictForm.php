<?php

namespace frontend\modules\region\models\form;

use Yii;
use frontend\modules\region\models\Subdistrict;
use frontend\modules\region\behaviors\CountryBehavior;
use frontend\modules\region\behaviors\ProvinceBehavior;
use frontend\modules\region\behaviors\CityBehavior;
use frontend\modules\region\behaviors\DistrictBehavior;

/**
 * handling 'subdistrict' model for modification
 *
 * @author fredy
 */
class SubdistrictForm extends Subdistrict
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = parent::rules();

		$rules[] = [['city_id', 'province_id', 'country_id'], 'required'];

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

		/* new district */
		$rules[] = [
			'district_id',
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
	 * Form behavior when input data
	 * handling string input, insert it as new model
	 *
	 * @return array
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
			/* auto register new district */
			[
				'class'				 => DistrictBehavior::className(),
				'cityAttribute'		 => 'city_id',
				'districtAttribute'	 => 'district_id',
			],
		];

	}

}
