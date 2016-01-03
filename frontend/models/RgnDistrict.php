<?php

namespace frontend\models;

use Yii;
use common\models\RgnDistrict as BaseDistrict;
use frontend\models\operation\RgnDistrictOperation;

/**
 * Description of RgnDistrict
 *
 * @author fredy
 *
 * @property frontend\models\RgnCountry $country
 * @property frontend\models\RgnProvince $province
 * @property frontend\models\RgnCity $city
 * 
 * @property frontend\models\RgnPostcode[] $rgnPostcodes
 * @property frontend\models\RgnSubdistrict[] $rgnSubdistricts
 */
class RgnDistrict extends BaseDistrict
{

	public function init()
	{
		parent::init();

		$this->operation = new RgnDistrictOperation([
			'model' => $this
		]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		return $this->hasOne(frontend\models\RgnCity::className(), ['id' => 'city_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(frontend\models\RgnPostcode::className(), ['district_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnSubdistricts()
	{
		return $this->hasMany(frontend\models\RgnSubdistrict::className(), ['district_id' => 'id']);

	}

}
