<?php

namespace frontend\models\control;

use Yii;
use common\base\ModelControl;
use frontend\models\RgnSubdistrict;

/**
 * Description of RgnSubdistrictControl
 * manage access control and operation available in frontend
 *
 * @author fredy
 */
class RgnSubdistrictControl extends ModelControl
{

	/* ================ model access control checks ================ */

	/**
	 * check permission to access deleted data
	 *
	 * @return bool
	 */
	static function isAccessingDeletedAllowed()
	{
		// some serious permission control
		if (array_key_exists('deleted', static::$accessAllowed) == FALSE)
		{
			static::$accessAllowed['deleted'] = TRUE;
		}

		// final result
		return static::$accessAllowed['deleted'];

	}

	/* ================ model action control checks ================ */

	/**
	 * check permission to delete data
	 *
	 * @return bool
	 */
	public function getIsActionDeleteAllowed()
	{
		// some serious permission control
		if (array_key_exists('delete', $this->actionAllowed) == FALSE)
		{
			// default permission
			$this->actionAllowed['delete'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setActionError('delete', 'Cann\'t delete unsaved data.');
			}
			// action whitelist
			else if ($this->model->status === RgnSubdistrict::STATUS_ACTIVE)
			{
				$this->actionAllowed['delete'] = TRUE;
			}
			// action blacklist
			else
			{
				if ($this->model->status === RgnSubdistrict::STATUS_DELETED)
				{
					$this->setActionError('delete', 'Data already (soft) deleted.');
				}
				else
				{
					$this->setActionError('delete', 'Unknown data error.');
				}
			}
		}

		// final result
		return $this->actionAllowed['delete'];

	}

	/**
	 * check permission to restore data
	 *
	 * @return bool
	 */
	public function getIsActionRestoreAllowed()
	{
		// some serious permission control
		if (array_key_exists('restore', $this->actionAllowed) == FALSE)
		{
			// default permission
			$this->actionAllowed['restore'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setActionError('restore', 'Cann\'t restore unsaved Data.');
			}
			// action whitelist
			else if ($this->model->status === RgnSubdistrict::STATUS_DELETED)
			{
				$this->actionAllowed['restore'] = TRUE;
			}
			// action blacklist
			else
			{
				if ($this->model->status === RgnSubdistrict::STATUS_ACTIVE)
				{
					$this->setActionError('restore', 'Data already active.');
				}
				else if ($this->model->status === RgnSubdistrict::STATUS_ARCHIVE)
				{
					$this->setActionError('restore', 'Data is archived, use reactivate instead.');
				}
				else
				{
					$this->setActionError('restore', 'Unknown data error.');
				}
			}
		}

		// final result
		return $this->actionAllowed['restore'];

	}

}
