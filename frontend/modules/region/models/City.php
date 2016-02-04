<?php

namespace frontend\modules\region\models;

use Yii;

/**
 * This is the base-model class for table "rgn_city".
 *
 * @property integer $id
 * @property string $recordStatus
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
 * @property string $recordStatusLabel
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
	const RECORDSTATUS_USED = 'used';

	const RECORDSTATUS_DELETED = 'deleted';

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
			['recordStatus', 'default', 'value' => static::RECORDSTATUS_USED],
			/* required */
			[['name', 'province_id'], 'required'],
			/* field type */
			[['recordStatus'], 'string'],
			[['number'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			[['abbreviation'], 'string', 'max' => 64],
			/* value limitation */
			['recordStatus', 'in', 'range' => [
					self::RECORDSTATUS_USED,
					self::RECORDSTATUS_DELETED,
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
			'recordStatus'	 => 'Record Status',
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
				->andFilterWhere(['like', 'recordStatus', District::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPostcodes()
	{
		return $this
				->hasMany(Postcode::className(), ['city_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', Postcode::RECORDSTATUS_USED]);

	}

	/**
	 * get column recordStatus enum value label
	 * @param string $value
	 * @return string
	 */
	public static function getRecordStatusValueLabel($value)
	{
		$labels = self::optsRecordStatus();

		if (isset($labels[$value]))
		{
			return $labels[$value];
		}

		return $value;

	}

	/**
	 * column recordStatus ENUM value labels
	 * @return array
	 */
	public static function optsRecordStatus()
	{
		return [
			self::RECORDSTATUS_USED		 => 'Active',
			self::RECORDSTATUS_DELETED	 => 'Deleted',
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
	 * get recordStatus label
	 *
	 * @return string
	 */
	public function getRecordStatusLabel()
	{
		return static::getRecordStatusValueLabel($this->recordStatus);

	}

	/**
	 * @inheritdoc
	 */
	public function delete()
	{
		$this->recordStatus = static::RECORDSTATUS_USED;

		return parent::softDelete();

	}

	/**
	 * @inheritdoc
	 */
	public function restore()
	{
		$this->recordStatus = static::RECORDSTATUS_USED;

		return parent::restore();

	}

}
