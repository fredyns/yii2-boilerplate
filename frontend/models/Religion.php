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

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new ReligionOperation([
			'model' => $this
		]);

	}

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view religion detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

}
