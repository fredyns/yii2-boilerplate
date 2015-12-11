<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "rgn_subdistrict".
 *
 * @property integer $id
 * @property string $status
 * @property string $number
 * @property string $name
 * @property integer $district_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $createdBy_id
 * @property integer $updatedBy_id
 * @property integer $deletedBy_id
 *
 * @property \common\models\RgnPostcode[] $rgnPostcodes
 * @property \common\models\RgnDistrict $district
 */
class RgnSubdistrict extends \common\base\Model
{

	/**
	 * ENUM field values
	 */
	const STATUS_ACTIVE = 'active';

	const STATUS_DELETED = 'deleted';

	var $enum_labels = false;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'rgn_subdistrict';

	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['status', 'number'], 'string'],
			[['name'], 'required'],
			[['district_id'], 'integer'],
			[['name'], 'string', 'max' => 255],
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				]
			]
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
			'district_id'	 => 'District',
			'created_at'	 => 'Created At',
			'updated_at'	 => 'Updated At',
			'deleted_at'	 => 'Deleted At',
			'createdBy_id'	 => 'Created By',
			'updatedBy_id'	 => 'Updated By',
			'deletedBy_id'	 => 'Deleted By',
		];

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRgnPostcodes()
	{
		return $this->hasMany(\common\models\RgnPostcode::className(), ['subdistrict_id' => 'id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict()
	{
		return $this->hasOne(\common\models\RgnDistrict::className(), ['id' => 'district_id']);

	}

	/**
	 * get column status enum value label
	 * @param string $value
	 * @return string
	 */
	public static function getStatusValueLabel($value)
	{
		$labels = self::optsStatus();
		if (isset($labels[$value]))
		{
			return $labels[$value];
		}
		return $value;

	}

	/**
	 * column status ENUM value labels
	 * @return array
	 */
	public static function optsStatus()
	{
		return [
			self::STATUS_ACTIVE	 => 'Active',
			self::STATUS_DELETED => 'Deleted',
		];

	}

}
