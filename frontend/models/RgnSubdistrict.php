<?php

namespace frontend\models;

use Yii;
use common\models\RgnSubdistrict as BaseSubdistrict;
use frontend\models\operation\RgnSubdistrictOperation;
use frontend\models\RgnDistrict;
use frontend\models\RgnPostcode;

/**
 * Description of RgnSubdistrict
 *
 * @author fredy
 *
 * @property \frontend\models\RgnCountry $country
 * @property \frontend\models\RgnProvince $province
 * @property \frontend\models\RgnCity $city
 * @property \frontend\models\RgnDistrict $district
 *
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnSubdistrict extends BaseSubdistrict
{

	public function init()
	{
		parent::init();

		$this->operation = new RgnSubdistrictOperation([
			'model' => $this
		]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['district_id' => 'id'])
				->andFilterWhere(['like', 'status', RgnPostcode::STATUS_ACTIVE]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict()
	{
		return $this->hasOne(RgnDistrict::className(), ['id' => 'district_id']);

	}

}
