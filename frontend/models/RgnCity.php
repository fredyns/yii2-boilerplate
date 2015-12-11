<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnCityControl;
use frontend\models\menu\RgnCityMenu;

/**
 * Description of RgnCity
 *
 * @author fredy
 */
class RgnCity extends \common\models\RgnCity
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnCityControl([
			'model' => $this
		]);

		$this->menu = new RgnCityMenu([
			'control' => $this->control,
		]);

	}

}
