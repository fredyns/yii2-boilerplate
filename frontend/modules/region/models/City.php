<?php

namespace frontend\modules\region\models;

use Yii;

/**
 * This is the base-model class for table "rgn_city".
 *
 * @property integer $id
 * @property string $status
 * @property string $number
 * @property string $name
 * @property string $abbreviation
 * @property integer $province_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property integer $deleted_at
 * @property integer $createdBy_id
 * @property integer $updatedBy_id
 * @property integer $deletedBy_id
 *
 * @property String $linkTo
 * @property string $statusLabel
 * @property integer $country_id
 *
 * @property Country $country
 * @property Province $province
 *
 * @property District[] $rgnDistricts
 * @property Postcode[] $rgnPostcodes
 */
class City extends \common\base\Model
{

	/**
	 * ENUM field values
	 */
	const STATUS_ACTIVE = 'active';

	const STATUS_DELETED = 'deleted';

	var $enum_labels = false;

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
	 */
	public static function tableName()
	{
		return 'rgn_city';

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
			[['status'], 'string'],
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
				'targetClass'		 => Province::className(),
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
			'province_id'	 => 'Province',
			'created_at'	 => 'Created At',
			'updated_at'	 => 'Updated At',
			'deleted_at'	 => 'Deleted At',
			'createdBy_id'	 => 'Created By',
			'updatedBy_id'	 => 'Updated By',
			'deletedBy_id'	 => 'Deleted By',
		];

	}

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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvince()
	{
		return $this->hasOne(Province::className(), ['id' => 'province_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistricts()
	{
		return $this
				->hasMany(District::className(), ['city_id' => 'id'])
				->andFilterWhere(['like', 'status', District::STATUS_ACTIVE]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPostcodes()
	{
		return $this
				->hasMany(Postcode::className(), ['city_id' => 'id'])
				->andFilterWhere(['like', 'status', Postcode::STATUS_ACTIVE]);

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
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view city detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

	/**
	 * get status label
	 *
	 * @return string
	 */
	public function getStatusLabel()
	{
		return static::getStatusValueLabel($this->status);

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
