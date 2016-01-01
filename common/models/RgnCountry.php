<?php

namespace common\models;

use Yii;
use \common\models\base\RgnCountry as BaseRgnCountry;

/**
 * This is the model class for table "rgn_country".
 *
 * @property string $statusLabel
 */
class RgnCountry extends BaseRgnCountry
{

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

	public function getStatusLabel()
	{
		return parent::getStatusValueLabel($this->status);

	}

	public function delete()
	{
		$this->status = static::STATUS_ACTIVE;

		return parent::softDelete();

	}

	public function restore()
	{
		$this->status = static::STATUS_ACTIVE;

		return parent::restore();

	}

}
