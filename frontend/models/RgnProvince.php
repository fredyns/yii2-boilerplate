<?php

namespace frontend\models;

use Yii;
use frontend\models\control\RgnProvinceControl;
use frontend\models\menu\RgnProvinceMenu;

/**
 * Description of RgnProvince
 *
 * @author fredy
 */
class RgnProvince extends \common\models\RgnProvince
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new RgnProvinceControl([
			'model' => $this
		]);

		$this->menu = new RgnProvinceMenu([
			'control' => $this->control,
		]);

	}

}
