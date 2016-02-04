<?php

namespace frontend\models;

use Yii;
use common\models\RgnCountry as BaseCountry;
use frontend\models\operation\RgnCountryOperation;
use frontend\models\RgnProvince;
use frontend\models\RgnPostcode;

/**
 * Description of RgnCountry
 *
 * @author fredy
 *
 * @property String $linkTo
 *
 * @property \frontend\models\RgnPostcode[] $rgnPostcodes
 * @property \frontend\models\RgnProvince[] $rgnProvinces
 */
class RgnCountry extends BaseCountry
{

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new RgnCountryOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view country detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this
				->hasMany(RgnPostcode::className(), ['country_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnPostcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnProvinces()
	{
		return $this
				->hasMany(RgnProvince::className(), ['country_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', RgnProvince::RECORDSTATUS_USED]);

	}

}
