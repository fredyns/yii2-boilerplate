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

	/* ======================== model structure ======================== */

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

}
