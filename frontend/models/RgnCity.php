<?php

namespace frontend\models;

use Yii;
use common\models\RgnCity as BaseCity;
use frontend\models\operation\RgnCityOperation;
use frontend\models\RgnProvince;
use frontend\models\RgnDistrict;
use frontend\models\RgnPostcode;

/**
 * Description of RgnCity
 *
 * @author fredy
 *
 * @property String $linkTo
 * @property \frontend\models\RgnCountry $country
 * @property \frontend\models\RgnProvince $province
 *
 * @property \frontend\models\RgnDistrict[] $rgnDistricts
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnCity extends BaseCity
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new RgnCityOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view city detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		return $this->hasOne(RgnProvince::className(), ['id' => 'province_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnDistricts()
	{
		return $this
				->hasMany(RgnDistrict::className(), ['city_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnDistrict::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['city_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnPostcode::RECORDSTATUS_USED]);

	}

}
