<?php

namespace frontend\modules\region\behaviors;

use Yii;
use yii\base\Event;
use yii\behaviors\AttributeBehavior;
use yii\db\BaseActiveRecord;
use frontend\modules\region\models\Subdistrict;

/**
 * handling subdistrict property
 * when typing a name instead of selecting, it will be inserted as new subdistrict
 *
 * @property string $districtAttribute
 * @property string $subdistrictAttribute
 *
 * @author fredy
 */
class SubdistrictBehavior extends AttributeBehavior
{

	public $districtAttribute = 'district_id';

	public $subdistrictAttribute = 'subdistrict_id';

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
				BaseActiveRecord::EVENT_BEFORE_INSERT	 => $this->subdistrictAttribute,
				BaseActiveRecord::EVENT_BEFORE_UPDATE	 => $this->subdistrictAttribute,
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
		$attribute = $this->subdistrictAttribute;
		$value = $this->owner->$attribute;

		$parentAttribute = $this->districtAttribute;
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
			$model = new Subdistrict([
				'name'			 => $value,
				'district_id'	 => $parent_id,
				'recordStatus'	 => Subdistrict::RECORDSTATUS_USED,
			]);

			return $model->save(FALSE) ? $model->id : 0;
		}

	}

}
