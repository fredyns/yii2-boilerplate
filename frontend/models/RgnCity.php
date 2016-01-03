<?php

namespace frontend\models;

use Yii;
use common\models\RgnCity as BaseCity;
use frontend\models\operation\RgnCityOperation;

/**
 * Description of RgnCity
 *
 * @author fredy
 *
 * @property frontend\models\RgnCountry $country
 * @property frontend\models\RgnProvince $province
 *
 * @property frontend\models\RgnDistrict[] $rgnDistricts
 * @property frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnCity extends BaseCity
{

	public function init()
	{
		parent::init();

		$this->operation = new RgnCityOperation([
			'model' => $this
		]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		return $this->hasOne(frontend\models\RgnProvince::className(), ['id' => 'province_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnDistricts()
	{
		return $this->hasMany(frontend\models\RgnDistrict::className(), ['city_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(frontend\models\RgnPostcode::className(), ['city_id' => 'id']);

	}

}
