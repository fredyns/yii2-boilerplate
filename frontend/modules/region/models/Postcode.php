<?php

namespace frontend\modules\region\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\modules\region\models\operation\PostcodeOperation;

/**
 * This is the base-model class for table "rgn_postcode".
 *
 * @property integer $id
 * @property string $recordStatus
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
 * @property String $linkTo
 * @property string $recordStatusLabel
 *
 * @property City $city
 * @property Country $country
 * @property District $district
 * @property Province $province
 * @property Subdistrict $subdistrict
 */
class Postcode extends \common\base\Model
{

	/**
	 * ENUM field values
	 */
	const RECORDSTATUS_USED = 'used';

	const RECORDSTATUS_DELETED = 'deleted';

	var $enum_labels = false;

	/*
	 * search data based on number & country
	 */

	static function findNumber($number, $country_id)
	{
		return static::findOne([
				'postcode'	 => $number,
				'country_id' => $country_id,
		]);

	}

	/*
	 * Revalidate and/or save postcode
	 */

	static function check($param = [])
	{
		$country_id = ArrayHelper::getValue($param, 'country_id');
		$postcode = ArrayHelper::getValue($param, 'postcode');

		if ($country_id > 0 && $postcode > 0)
		{
			$model = static::findNumber($postcode, $country_id);

			if (is_null($model))
			{
				$postcode = new Postcode($param);

				return ($postcode->save(FALSE)) ? $postcode : NULL;
			}

			return $model->improveData($param);
		}

	}

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
	public function init()
	{
		parent::init();

		$this->operation = new PostcodeOperation([
			'model' => $this
		]);

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
			[['postcode', 'country_id'], 'required'],
			/* optional type */
			[['subdistrict_id', 'district_id', 'city_id', 'province_id'], 'safe'],
			/* field type */
			[['recordStatus'], 'string'],
			[['postcode'], 'integer'],
			/* value limitation */
			['recordStatus', 'in', 'range' => [
					self::RECORDSTATUS_USED,
					self::RECORDSTATUS_DELETED,
				]
			],
			[
				'country_id',
				'exist',
				'targetClass'		 => Country::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function (Postcode $model, $attribute)
				{
					$num = is_numeric($model->$attribute);
					//$model->addError($attribute, "num: [{$num}]; val: [{$model->$attribute}];");

					return $num;
				},
				'message' => "Country doesn't exist.",
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
			[
				'city_id',
				'exist',
				'targetClass'		 => City::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "City doesn't exist.",
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
			[
				'subdistrict_id',
				'exist',
				'targetClass'		 => Subdistrict::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "Subdistrict doesn't exist.",
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
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		return $this->hasOne(City::className(), ['id' => 'city_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCountry()
	{
		return $this->hasOne(Country::className(), ['id' => 'country_id']);

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
	public function getProvince()
	{
		return $this->hasOne(Province::className(), ['id' => 'province_id']);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getSubdistrict()
	{
		return $this->hasOne(Subdistrict::className(), ['id' => 'subdistrict_id']);

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
	public function getLinkTo($linkOptions = ['title' => 'view postcode detail', 'data-pjax' => 0])
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

	/*
	 * improve data & save it
	 */

	public function improveData($newData)
	{
		$improved = FALSE;
		$attributes = [
			'province_id',
			'city_id',
			'district_id',
			'subdistrict_id',
		];

		/*
		 * compare each attributes
		 */

		foreach ($attributes as $attr)
		{
			$oldValue = $this->getAttribute($attr);
			$newValue = ArrayHelper::getValue($newData, $attr);

			/*
			 * if old value is empty but new value exist, improve it
			 */

			if (empty($oldValue) && $newValue > 0)
			{
				$this->setAttribute($attr, $newValue);

				$improved = TRUE;
			}

			/*
			 * if old & new value exist but they are different, don't change any data, just leave it that way. improvement done.
			 */
			else if ($oldValue > 0 && $newValue > 0 && $oldValue != $newValue)
			{
				break;
			}
		}

		/*
		 * if data improved, save it
		 */

		if ($improved)
		{
			$this->save(FALSE);
		}

		return $this;

	}

}
