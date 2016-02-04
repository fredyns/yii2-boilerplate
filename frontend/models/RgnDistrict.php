<?php

namespace frontend\models;

use Yii;
use common\models\RgnDistrict as BaseDistrict;
use frontend\models\operation\RgnDistrictOperation;
use frontend\models\RgnCity;
use frontend\models\RgnSubdistrict;
use frontend\models\RgnPostcode;

/**
 * Description of RgnDistrict
 *
 * @author fredy
 *
 * @property String $linkTo
 * @property \frontend\models\RgnCountry $country
 * @property \frontend\models\RgnProvince $province
 * @property \frontend\models\RgnCity $city
 *
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 * @property \frontend\models\RgnSubdistrict[] $rgnSubdistricts
 */
class RgnDistrict extends BaseDistrict
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new RgnDistrictOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view district detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		return $this->hasOne(RgnCity::className(), ['id' => 'city_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['district_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnPostcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnSubdistricts()
	{
		return $this
				->hasMany(RgnSubdistrict::className(), ['district_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnSubdistrict::RECORDSTATUS_USED]);

	}

}
