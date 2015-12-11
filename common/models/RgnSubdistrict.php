<?php

namespace common\models;

use Yii;
use common\models\base\RgnSubdistrict as BaseRgnSubdistrict;
use common\models\RgnDistrict;

/**
 * This is the model class for table "rgn_subdistrict".
 *
 * @property integer $country_id
 * @property integer $province_id
 * @property integer $city_id
 *
 * @property \common\models\RgnCountry $country
 * @property \common\models\RgnProvince $province
 * @property \common\models\RgnCity $city
 */
class RgnSubdistrict extends BaseRgnSubdistrict
{

	public $country_id;

	public $province_id;

	public $city_id;

	public $_country;

	public $_province;

	public $_city;

	/**
	 * @inheritdoc
	 */
	static function findOne($condition)
	{
		$model = parent::findOne($condition);
		$district = $model->district;

		if ($district)
		{
			$model->city_id = $district->city_id;
			$model->_city = $district->city;

			if ($model->_city)
			{
				$model->province_id = $model->_city->province_id;
				$model->_province = $model->_city->province;

				if ($model->_province)
				{
					$model->country_id = $model->_province->country_id;
				}
			}
		}

		return $model;

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
			'city_id'		 => 'City',
			'province_id'	 => 'Province',
			'country_id'	 => 'Country',
		];

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
			[['name', 'district_id'], 'required'],
			/* field type */
			[['status', 'number'], 'string'],
			[['number'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			/* value limitation */
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				]
			],
			[
				'district_id',
				'exist',
				'targetClass'		 => RgnDistrict::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "District doesn't exist.",
			],
		];

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		if ($this->_city === NULL)
		{
			if ($this->district_id > 0)
			{
				$district = $this->district;

				if ($district)
				{
					$this->_city = $district->city;
				}
			}
		}

		return $this->_city;

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		if ($this->_province === NULL)
		{
			if ($this->city)
			{
				$this->_province = $this->city->province;
			}
		}

		return $this->_province;

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		if ($this->_country === NULL)
		{
			if ($this->province)
			{
				$this->_country = $this->province->country;
			}
		}

		return $this->_country;

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
