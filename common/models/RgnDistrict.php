<?php

namespace common\models;

use Yii;
use common\models\base\RgnDistrict as BaseRgnDistrict;
use common\models\RgnCity;

/**
 * This is the model class for table "rgn_district".
 *
 * @property integer $country_id
 * @property integer $province_id
 *
 * @property \common\models\RgnCountry $country
 * @property \common\models\RgnProvince $province
 */
class RgnDistrict extends BaseRgnDistrict
{

	public $country_id;

	public $province_id;

	public $_country;

	public $_province;

	/**
	 * @inheritdoc
	 */
	static function findOne($condition)
	{
		$model = parent::findOne($condition);
		$city = $model->city;

		if ($city)
		{
			$model->province_id = $city->province_id;
			$model->_province = $city->province;

			if ($model->_province)
			{
				$model->country_id = $model->_province->country_id;
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
			'name'			 => 'Name',
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
			[['name', 'city_id'], 'required'],
			/* field type */
			[['status'], 'string'],
			[['name'], 'string', 'max' => 255],
			/* value limitation */
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				]
			],
			[
				'city_id',
				'exist',
				'targetClass'		 => RgnCity::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "City doesn't exist.",
			],
		];

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		if ($this->_province === NULL)
		{
			if ($this->city_id > 0)
			{
				$city = $this->city;

				if ($city)
				{
					$this->_province = $city->province;
				}
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
