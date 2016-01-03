<?php

namespace frontend\models;

use Yii;
use common\models\RgnProvince as BaseProvince;
use frontend\models\operation\RgnProvinceOperation;

/**
 * Description of RgnProvince
 *
 * @author fredy
 *
 * @property \frontend\models\RgnCountry $country
 *
 * @property \frontend\models\RgnCity[] $rgnCities
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnProvince extends BaseProvince
{

	public function init()
	{
		parent::init();

		$this->operation = new RgnProvinceOperation([
			'model' => $this
		]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnCities()
	{
		return $this->hasMany(\frontend\models\RgnCity::className(), ['province_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(\frontend\models\RgnPostcode::className(), ['province_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		return $this->hasOne(\frontend\models\RgnCountry::className(), ['id' => 'country_id']);

	}

}
