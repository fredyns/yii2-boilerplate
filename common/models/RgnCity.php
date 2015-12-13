<?php

namespace common\models;

use Yii;
use common\models\base\RgnCity as BaseRgnCity;
use common\models\RgnProvince;

/**
 * This is the model class for table "rgn_city".
 *
 * @property integer $country_id
 *
 * @property \common\models\RgnCountry $country
 */
class RgnCity extends BaseRgnCity
{

	public $country_id;

	public $_country;

	/**
	 * @inheritdoc
	 *
	 * find model & search related country-id
	 */
	static function findOne($condition)
	{
		$model = parent::findOne($condition);
		$province = $model->province;

		if ($province)
		{
			$model->country_id = $province->country_id;
		}

		return $model;

	}

	/**
	 * @inheritdoc
	 *
	 * add extra field country
	 */
	public function attributeLabels()
	{
		return [
			'id'			 => 'ID',
			'status'		 => 'Status',
			'number'		 => 'Number',
			'name'			 => 'Name',
			'abbreviation'	 => 'Abbreviation',
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
			[['name', 'province_id'], 'required'],
			/* field type */
			[['status', 'number'], 'string'],
			[['number'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			[['abbreviation'], 'string', 'max' => 64],
			/* value limitation */
			['status', 'in', 'range' => [
					self::STATUS_ACTIVE,
					self::STATUS_DELETED,
				],
			],
			[
				'province_id',
				'exist',
				'targetClass'		 => RgnProvince::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "Province doesn't exist.",
			],
		];

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		if ($this->_country === NULL)
		{
			if ($this->province_id > 0)
			{
				$province = $this->province;

				if ($province)
				{
					$this->_country = $province->country;
				}
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