<?php

namespace common\models;

use Yii;
use common\models\base\RgnCountry as BaseRgnCountry;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rgn_country".
 *
 * @property string $statusLabel
 */
class RgnCountry extends BaseRgnCountry
{

	/**
	 * Preparing option data for forms
	 *
	 * @return array
	 */
	static function asOption()
	{
		$query = static::find()->all();

		return ArrayHelper::map($query, 'id', 'name');

	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			/* default value */
			['status', 'default', 'value' => static::STATUS_ACTIVE],
			/* required */
			[['name'], 'required'],
			/* field type */
			[['status'], 'string'],
			[['name'], 'string', 'max' => 255],
			[['abbreviation'], 'string', 'max' => 32],
			[['created_at', 'updated_at', 'deleted_at', 'createdBy_id', 'updatedBy_id', 'deletedBy_id'], 'integer'],
			/* value limitation */
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				]
			],
		];

	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'			 => 'ID',
			'status'		 => 'Status',
			'name'			 => 'Name',
			'abbreviation'	 => 'Abbreviation',
			'created_at'	 => 'Created At',
			'updated_at'	 => 'Updated At',
			'deleted_at'	 => 'Deleted At',
			'createdBy_id'	 => 'Created By',
			'updatedBy_id'	 => 'Updated By',
			'deletedBy_id'	 => 'Deleted By',
		];

	}

	/**
	 * get status label
	 *
	 * @return string
	 */
	public function getStatusLabel()
	{
		return parent::getStatusValueLabel($this->status);

	}

	/**
	 * @inheritdoc
	 */
	public function delete()
	{
		$this->status = static::STATUS_ACTIVE;

		return parent::softDelete();

	}

	/**
	 * @inheritdoc
	 */
	public function restore()
	{
		$this->status = static::STATUS_ACTIVE;

		return parent::restore();

	}

}
