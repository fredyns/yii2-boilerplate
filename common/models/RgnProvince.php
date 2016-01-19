<?php

namespace common\models;

use Yii;
use common\models\base\RgnProvince as BaseRgnProvince;

/**
 * This is the model class for table "rgn_province".
 *
 * @property string $statusLabel
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
			[['status'], 'string'],
			[['number', 'abbreviation'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			[['created_at', 'updated_at', 'deleted_at', 'createdBy_id', 'updatedBy_id', 'deletedBy_id'], 'integer'],
			/* value limitation */
			['status', 'in', 'range' => [
					static::STATUS_ACTIVE,
					static::STATUS_DELETED,
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

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'			 => 'ID',
			'status'		 => 'Status',
			'number'		 => 'Number',
			'name'			 => 'Name',
			'abbreviation'	 => 'Abbreviation',
			'country_id'	 => 'Country',
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
