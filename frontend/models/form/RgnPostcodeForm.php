<?php

namespace frontend\models\form;

use Yii;
use frontend\models\RgnPostcode;
use common\behaviors\RgnCountryBehavior;
use common\behaviors\RgnProvinceBehavior;
use common\behaviors\RgnCityBehavior;
use common\behaviors\RgnDistrictBehavior;
use common\behaviors\RgnSubdistrictBehavior;

/**
 * handling 'district' model for modification
 *
 * @author fredy
 */
class RgnPostcodeForm extends RgnPostcode
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		$rules = parent::rules();

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

		/* new subdistrict */
		$rules[] = [
			'subdistrict_id',
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
			/* auto register new district */
			[
				'class'				 => RgnDistrictBehavior::className(),
				'cityAttribute'		 => 'city_id',
				'districtAttribute'	 => 'district_id',
			],
			/* auto register new subdistrict */
			[
				'class'					 => RgnSubdistrictBehavior::className(),
				'districtAttribute'		 => 'district_id',
				'subdistrictAttribute'	 => 'subdistrict_id',
			],
		];

	}

}
