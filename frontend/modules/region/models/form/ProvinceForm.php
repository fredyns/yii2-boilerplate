<?php

namespace frontend\modules\region\models\form;

use Yii;
use frontend\modules\region\models\Province;
use frontend\modules\region\behaviors\CountryBehavior;

/**
 * handling 'province' model for modification
 *
 * @author fredy
 */
class ProvinceForm extends Province
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
		];

	}

}
