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
 * @property String $linkTo
 * @property \frontend\models\RgnCountry $country
 * @property \frontend\models\RgnProvince $province
 * @property \frontend\models\RgnCity $city
 * @property \frontend\models\RgnDistrict $district
 *
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnSubdistrict extends BaseSubdistrict
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new RgnSubdistrictOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view subdistrict detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['subdistrict_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnPostcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict()
	{
		return $this->hasOne(RgnDistrict::className(), ['id' => 'district_id']);

	}

}
