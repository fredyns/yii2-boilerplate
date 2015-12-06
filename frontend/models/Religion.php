<?php

namespace frontend\models;

use Yii;
use common\models\Religion as BaseReligion;
use frontend\models\control\ReligionControl;
use frontend\models\menu\ReligionMenu;

/**
 * Description of Religion
 *
 * @author fredy
 */
class Religion extends BaseReligion
{

	/* ======================== model structure ======================== */

	public function init()
	{
		parent::init();

		$this->control = new ReligionControl([
			'model' => $this
		]);

		$this->menu = new ReligionMenu([
			'control' => $this->control,
		]);

	}

}
