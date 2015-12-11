<?php

namespace common\models\base;

use Yii;

/**
 * This is the base-model class for table "rgn_postcode".
 *
 * @property integer $id
 * @property integer $postcode
 * @property integer $subdistrict_id
 * @property integer $district_id
 * @property integer $city_id
 * @property integer $province_id
 * @property integer $country_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $createdBy_id
 * @property integer $updatedBy_id
 * @property integer $deletedBy_id
 *
 * @property \common\models\RgnCountry $country
 * @property \common\models\RgnProvince $province
 * @property \common\models\RgnCity $city
 * @property \common\models\RgnDistrict $district
 * @property \common\models\RgnSubdistrict $subdistrict
 */
class RgnPostcode extends \common\base\Model
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
		return 'rgn_postcode';

	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['status'], 'string'],
			[['id', 'postcode'], 'required'],
			[['id', 'postcode', 'subdistrict_id', 'district_id', 'city_id', 'province_id', 'country_id'], 'integer'],
			[
				'status',
				'in',
				'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				],
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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		return $this->hasOne(\common\models\RgnCountry::className(), ['id' => 'country_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		return $this->hasOne(\common\models\RgnProvince::className(), ['id' => 'province_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		return $this->hasOne(\common\models\RgnCity::className(), ['id' => 'city_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict()
	{
		return $this->hasOne(\common\models\RgnDistrict::className(), ['id' => 'district_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSubdistrict()
	{
		return $this->hasOne(\common\models\RgnSubdistrict::className(), ['id' => 'subdistrict_id']);

	}

}
