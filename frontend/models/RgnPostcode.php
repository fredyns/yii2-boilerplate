<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnPostcodeControl;
use frontend\models\menu\RgnPostcodeMenu;

/**
 * Description of RgnPostcode
 *
 * @author fredy
 */
class RgnPostcode extends \common\models\RgnPostcode
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnPostcodeControl([
			'model' => $this
		]);

		$this->menu = new RgnPostcodeMenu([
			'control' => $this->control,
		]);

	}

}
