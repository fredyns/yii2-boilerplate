<?php

namespace frontend\modules\region\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use frontend\modules\region\models\City;

/**
 * handling city property
 * when typing a name instead of selecting, it will be inserted as new city
 *
 * @property string $provinceAttribute
 * @property string $cityAttribute
 *
 * @author fredy
 */
class CityBehavior extends AttributeBehavior
{

	public $provinceAttribute = 'province_id';

	public $cityAttribute = 'city_id';

	public $value;

	/**
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

		if (empty($this->attributes))
		{
			$this->attributes = [
				BaseActiveRecord::EVENT_BEFORE_INSERT	 => $this->cityAttribute,
				BaseActiveRecord::EVENT_BEFORE_UPDATE	 => $this->cityAttribute,
			];
		}

	}

	/**
	 * Evaluates the value of the user.
	 * The return result of this method will be assigned to the current attribute(s).
	 * @param Event $event
	 * @return mixed the value of the user.
	 */
	protected function getValue($event)
	{
		$attribute = $this->cityAttribute;
		$value = $this->owner->$attribute;

		$parentAttribute = $this->provinceAttribute;
		$parent_id = $this->owner->$parentAttribute;
		$parent_valid = ($parent_id > 0);

		if (is_numeric($value))
		{
			return $value;
		}
		else if (empty($value) OR $parent_valid == FALSE)
		{
			return NULL;
		}
		else
		{
			$model = new City([
				'name'			 => $value,
				'province_id'	 => $parent_id,
				'recordStatus'	 => City::RECORDSTATUS_USED,
			]);

			return $model->save(FALSE) ? $model->id : 0;
		}

	}

}
