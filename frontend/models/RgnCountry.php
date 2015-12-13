<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnCountryControl;
use frontend\models\menu\RgnCountryMenu;

/**
 * Description of RgnCountry
 *
 * @author fredy
 */
class RgnCountry extends \common\models\RgnCountry
{

	/* ======================== structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnCountryControl([
			'model' => $this
		]);

		$this->menu = new RgnCountryMenu([
			'control' => $this->control,
		]);

	}

	/* ======================== relations ======================== */

	/**
	 * replace with frontend models which include Model Control & Menu
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(\frontend\models\RgnPostcode::className(), ['country_id' => 'id']);

	}

	/**
	 * replace with frontend models which include Model Control & Menu
	 *
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnProvinces()
	{
		return $this->hasMany(\frontend\models\RgnProvince::className(), ['country_id' => 'id']);

	}

}
