<?php

namespace common\models;

use Yii;
use common\models\base\RgnPostcode as BaseRgnPostcode;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "rgn_postcode".
 */
class RgnPostcode extends BaseRgnPostcode
{

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			/* required */
			[['postcode', 'country_id'], 'required'],
			/* optional type */
			[['subdistrict_id', 'district_id', 'city_id', 'province_id'], 'safe'],
			/* field type */
			[['postcode'], 'integer'],
			/* value limitation */
			[
				'country_id',
				'exist',
				'targetClass'		 => RgnCountry::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "Country doesn't exist.",
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
			[
				'subdistrict_id',
				'exist',
				'targetClass'		 => RgnSubdistrict::className(),
				'targetAttribute'	 => 'id',
				'when'				 => function ($model, $attribute)
				{
					return is_numeric($model->$attribute);
				},
				'message' => "Subdistrict doesn't exist.",
			],
		];

	}

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
				return static::create($param);
			}

			return $model->improveData($param);
		}

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
