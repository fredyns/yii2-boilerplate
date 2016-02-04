<?php

namespace frontend\modules\region\models;

use Yii;
use yii\helpers\ArrayHelper;
use frontend\modules\region\models\operation\CountryOperation;

/**
 * This is the base-model class for table "rgn_country".
 *
 * @property integer $id
 * @property string $recordStatus
 * @property string $name
 * @property string $abbreviation
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
 * @property Postcode[] $rgnPostcodes
 * @property Province[] $rgnProvinces
 */
class Country extends \common\base\Model
{

	/**
	 * ENUM field values
	 */
	const RECORDSTATUS_USED = 'used';

	const RECORDSTATUS_DELETED = 'deleted';

	var $enum_labels = false;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		$this->operation = new CountryOperation([
			'model' => $this
		]);

	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return 'rgn_country';

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
			[['name'], 'required'],
			/* field type */
			[['recordStatus'], 'string'],
			[['name'], 'string', 'max' => 255],
			[['abbreviation'], 'string', 'max' => 32],
			/* value limitation */
			['recordStatus', 'in', 'range' => [
					static::RECORDSTATUS_USED,
					static::RECORDSTATUS_DELETED,
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
			'recordStatus'	 => 'Record Status',
			'name'			 => 'Name',
			'abbreviation'	 => 'Abbreviation',
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
				->hasMany(Postcode::className(), ['country_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', Postcode::RECORDSTATUS_USED]);

	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProvinces()
	{
		return $this
				->hasMany(Province::className(), ['country_id' => 'id'])
				->andFilterWhere(['like', 'recordStatus', Province::RECORDSTATUS_USED]);

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
	 * Preparing option data for forms
	 *
	 * @return array
	 */
	static function asOption()
	{
		$query = static::find()->all();

		return ArrayHelper::map($query, 'id', 'name');

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

	/**
	 * generate regular link to view model detail
	 *
	 * @param array $linkOptions
	 * @return string
	 */
	public function getLinkTo($linkOptions = ['title' => 'view country detail', 'data-pjax' => 0])
	{
		return $this->operation->getLinkView('', $linkOptions);

	}

}
