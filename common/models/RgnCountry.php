<?php

namespace common\models;

use Yii;
use \common\models\base\RgnCountry as BaseRgnCountry;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rgn_country".
 */
class RgnCountry extends BaseRgnCountry
{

	/*
	 * Preparing option data for forms
	 */

	static function asOption()
	{
		$query = RgnCountry::find()->all();

		return ArrayHelper::map($query, 'id', 'name');

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
