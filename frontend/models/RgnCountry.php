<?php

namespace frontend\models;

use Yii;
use common\models\RgnCountry as BaseCountry;
use frontend\models\operation\RgnCountryOperation;

/**
 * Description of RgnCountry
 *
 * @author fredy
 *
 * @property frontend\models\RgnPostcode[] $rgnPostcodes
 * @property frontend\models\RgnProvince[] $rgnProvinces
 */
class RgnCountry extends BaseCountry
{

	public function init()
	{
		parent::init();

		$this->operation = new RgnCountryOperation([
			'model' => $this
		]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(frontend\models\RgnPostcode::className(), ['country_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnProvinces()
	{
		return $this->hasMany(frontend\models\RgnProvince::className(), ['country_id' => 'id']);

	}

}
