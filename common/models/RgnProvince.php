<?php

namespace common\models;

use Yii;
use common\models\base\RgnProvince as BaseRgnProvince;
use common\models\RgnCountry;

/**
 * This is the common model class for table "rgn_province".
 * will used as base for data access, searching & input forms.
 */
class RgnProvince extends BaseRgnProvince
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			/* default value */
			['status', 'default', 'value' => static::STATUS_ACTIVE],
			/* required */
			[['name', 'country_id'], 'required'],
			/* field type */
			[['status', 'number'], 'string'],
			[['number'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			[['abbreviation'], 'string', 'max' => 32],
			/* value limitation */
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				],
			],
			[
				'country_id',
				'exist',
				'targetClass'		 => RgnCountry::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "Country doesn't exist.",
			],
		];

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
