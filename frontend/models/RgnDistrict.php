<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnDistrictControl;
use frontend\models\menu\RgnDistrictMenu;

/**
 * Description of RgnDistrict
 *
 * @author fredy
 */
class RgnDistrict extends \common\models\RgnDistrict
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnDistrictControl([
			'model' => $this
		]);

		$this->menu = new RgnDistrictMenu([
			'control' => $this->control,
		]);

	}

}
