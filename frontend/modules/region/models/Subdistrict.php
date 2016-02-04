<?php

namespace frontend\modules\region\models;

use Yii;
use frontend\modules\region\models\operation\SubdistrictOperation;

/**
 * This is the base-model class for table "rgn_subdistrict".
 *
 * @property integer $id
 * @property string $recordStatus
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
 * @property string $recordStatusLabel
 * @property integer $country_id
 * @property integer $province_id
 * @property integer $city_id
 *
 * @property Country $country
 * @property Province $province
 * @property City $city
 * @property District $district
 *
 * @property Postcode[] $rgnPostcodes
 */
class Subdistrict extends \common\base\Model
{

	/**
	 * ENUM field values
	 */
	const RECORDSTATUS_USED = 'used';

	const RECORDSTATUS_DELETED = 'deleted';

	var $enum_labels = false;

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
	public function init()
	{
		parent::init();

		$this->operation = new SubdistrictOperation([
			'model' => $this
		]);

	}

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
			/* default value */
			['recordStatus', 'default', 'value' => static::RECORDSTATUS_USED],
			/* required */
			[['name', 'district_id'], 'required'],
			/* field type */
			[['recordStatus'], 'string'],
			[['number'], 'string', 'max' => 32],
			[['name'], 'string', 'max' => 255],
			[['created_at', 'updated_at', 'deleted_at', 'createdBy_id', 'updatedBy_id', 'deletedBy_id'], 'integer'],
			/* value limitation */
			['recordStatus', 'in', 'range' => [
					self::RECORDSTATUS_USED,
					self::RECORDSTATUS_DELETED,
				]
			],
			[
				'district_id',
				'exist',
				'targetClass'		 => District::className(),
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
	 * @inheritdoc
	 */
	public function attributeLabels()
	{
		return [
			'id'			 => 'ID',
			'recordStatus'	 => 'Record Status',
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
	public function getPostcodes()
	{
		return $this
				->hasMany(Postcode::className(), ['subdistrict_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', Postcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getDistrict()
	{
		return $this->hasOne(District::className(), ['id' => 'district_id']);

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
	public function getLinkTo($linkOptions = ['title' => 'view subdistrict detail', 'data-pjax' => 0])
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
