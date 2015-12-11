<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnSubdistrictControl;
use frontend\models\menu\RgnSubdistrictMenu;

/**
 * Description of RgnSubdistrict
 *
 * @author fredy
 */
class RgnSubdistrict extends \common\models\RgnSubdistrict
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnSubdistrictControl([
			'model' => $this
		]);

		$this->menu = new RgnSubdistrictMenu([
			'control' => $this->control,
		]);

	}

}
