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
 *
 * @property String $linkTo
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

	public function getLinkTo($linkOptions = ['title' => 'view religion detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

}
