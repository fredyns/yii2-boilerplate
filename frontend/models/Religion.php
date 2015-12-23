<?php

namespace frontend\models;

use Yii;
use common\models\Religion as BaseReligion;
use frontend\models\operation\ReligionOperation;
use yii\helpers\Html;

/**
 * Description of Religion
 *
 * @author fredy
 */
class Religion extends BaseReligion
{

	public function init()
	{
		parent::init();

		$this->operation = new ReligionOperation([
			'model' => $this
		]);

	}

}
