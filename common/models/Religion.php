<?php

namespace common\models;

use Yii;
use common\models\base\Religion as BaseReligion;
use common\models\control\ReligionControl;
use common\models\menu\ReligionMenu;

/**
 * This is the model class for table "religion".
 *
 * @property ReligionControl $control
 * @property ReligionMenu $menu
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

	/* ======================== model operation ======================== */

	public function delete()
	{
		$this->status = self::STATUS_DELETED;
		$this->deleted_at = time();
		$this->deletedBy_id = Yii::$app->user->getId();

		/*
		 * save only deletion attribute
		 */
		return $this->update(FALSE, ['status', 'deleted_at', 'deletedBy_id']);

	}

	public function restore()
	{
		$this->status = self::STATUS_ACTIVE;
		$this->deleted_at = NULL;
		$this->deletedBy_id = NULL;

		/*
		 * save all attribute, include update moderation
		 */
		return $this->update(FALSE);

	}

}
