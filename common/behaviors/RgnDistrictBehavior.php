<?php

namespace common\behaviors;

use Yii;
use yii\base\Event;
use yii\db\BaseActiveRecord;
use common\models\RgnDistrict;

/**
 * Description of RgnDistrictBehavior
 *
 * @author fredy
 */
class RgnDistrictBehavior extends \yii\behaviors\AttributeBehavior
{

	public $cityAttribute = 'city_id';

	public $districtAttribute = 'district_id';

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
				BaseActiveRecord::EVENT_BEFORE_INSERT	 => $this->districtAttribute,
				BaseActiveRecord::EVENT_BEFORE_UPDATE	 => $this->districtAttribute,
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
		$attribute = $this->districtAttribute;
		$value = $this->owner->$attribute;

		$parentAttribute = $this->cityAttribute;
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
			$model = RgnDistrict::create([
					'name'		 => $value,
					'city_id'	 => $parent_id,
					'status'	 => RgnDistrict::STATUS_ACTIVE,
			]);

			return $model ? $model->id : NULL;
		}

	}

}
