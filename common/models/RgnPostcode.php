<?php

namespace common\models;

use Yii;
use \common\models\base\RgnPostcode as BaseRgnPostcode;

/**
 * This is the model class for table "rgn_postcode".
 *
 * @property string $statusLabel
 */
class RgnPostcode extends BaseRgnPostcode
{

	/**
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'			 => 'ID',
			'status'		 => 'Status',
			'postcode'		 => 'Postcode',
			'subdistrict_id' => 'Subdistrict',
			'district_id'	 => 'District',
			'city_id'		 => 'City',
			'province_id'	 => 'Province',
			'country_id'	 => 'Country',
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
