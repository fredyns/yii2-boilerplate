<?php

namespace frontend\models\form;

use Yii;
use frontend\models\RgnCity;
use common\behaviors\RgnCountryBehavior;
use common\behaviors\RgnProvinceBehavior;

/**
 * handling 'city' model for modification
 *
 * @author fredy
 */
class RgnCityForm extends RgnCity
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

	/**
	 * detect when user typing new province & country
	 * register first & replace with their ID
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
		];

	}

}
