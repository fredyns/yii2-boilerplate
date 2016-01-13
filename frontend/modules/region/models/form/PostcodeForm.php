<?php

namespace frontend\modules\region\models\form;

use Yii;
use frontend\modules\region\models\Postcode;
use frontend\modules\region\behaviors\CountryBehavior;
use frontend\modules\region\behaviors\ProvinceBehavior;
use frontend\modules\region\behaviors\CityBehavior;
use frontend\modules\region\behaviors\DistrictBehavior;
use frontend\modules\region\behaviors\SubdistrictBehavior;

/**
 * Description of PostcodeForm
 *
 * @author fredy
 */
class PostcodeForm extends Postcode
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
			/* auto register new district */
			[
				'class'				 => DistrictBehavior::className(),
				'cityAttribute'		 => 'city_id',
				'districtAttribute'	 => 'district_id',
			],
			/* auto register new subdistrict */
			[
				'class'					 => SubdistrictBehavior::className(),
				'districtAttribute'		 => 'district_id',
				'subdistrictAttribute'	 => 'subdistrict_id',
			],
		];

	}

}
