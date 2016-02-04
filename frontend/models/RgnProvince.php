<?php

namespace frontend\models;

use Yii;
use common\models\RgnProvince as BaseProvince;
use frontend\models\operation\RgnProvinceOperation;
use frontend\models\RgnCountry;
use frontend\models\RgnCity;
use frontend\models\RgnPostcode;

/**
 * Description of RgnProvince
 *
 * @author fredy
 *
 * @property String $linkTo
 * @property \frontend\models\RgnCountry $country
 *
 * @property \frontend\models\RgnCity[] $rgnCities
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 */
class RgnProvince extends BaseProvince
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new RgnProvinceOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view province detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnCities()
	{
		return $this
				->hasMany(RgnCity::className(), ['province_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnCity::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['province_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnPostcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		return $this->hasOne(RgnCountry::className(), ['id' => 'country_id']);

	}

}
