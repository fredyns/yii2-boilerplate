<?php

namespace frontend\modules\region\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use frontend\modules\region\models\Country;

/**
 * handling country property
 * when typing a name instead of selecting, it will be inserted as new country
 *
 * @property string $countryAttribute
 *
 * @author fredy
 */
class CountryBehavior extends AttributeBehavior
{

	public $countryAttribute = 'country_id';

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
				BaseActiveRecord::EVENT_BEFORE_INSERT	 => $this->countryAttribute,
				BaseActiveRecord::EVENT_BEFORE_UPDATE	 => $this->countryAttribute,
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
		$attribute = $this->countryAttribute;
		$value = $this->owner->$attribute;

		if (is_numeric($value))
		{
			return $value;
		}
		else if (empty($value))
		{
			return NULL;
		}
		else
		{
			$model = new Country([
				'name'			 => $value,
				'recordStatus'	 => Country::RECORDSTATUS_USED,
			]);

			return $model->save(FALSE) ? $model->id : 0;
		}

	}

}
