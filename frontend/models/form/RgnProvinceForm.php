<?php

namespace frontend\models\form;

use Yii;
use frontend\models\RgnProvince;
use common\behaviors\RgnCountryBehavior;

/**
 * handling 'province' model for modification
 *
 * @author fredy
 */
class RgnProvinceForm extends RgnProvince
{

	/**
	 * extending base rules to match form scenario
	 */
	public function rules()
	{
		$rules = parent::rules();

		/* new province */
		$rules[] = [
			'country_id',
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
		];

	}

}
