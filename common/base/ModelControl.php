<?php

namespace common\base;

use Yii;
use yii\helpers\Inflector;
use yii\web\HttpException;

/**
 * Description of BaseModelAction
 * containing access control regarding data model
 *
 * @author fredy
 *
 * @property BaseModel $model
 *
 * @property Bool $isActionIndexAllowed
 * @property Bool $isActionCreateAllowed
 * @property Bool $isActionViewAllowed
 * @property Bool $isActionUpdateAllowed
 * @property Bool $isActionDeleteAllowed
 */
class ModelControl extends \yii\base\Object
{

	const ERROR_CODE = 423;

	/**
	 * Containing model being controlled
	 *
	 * @var String
	 */
	public $model;

	/**
	 * storing data/table access permission
	 *
	 * @var array
	 */
	static $accessAllowed = [
		//'index' => TRUE,
	];

	/**
	 * storing action permission
	 *
	 * @var array
	 */
	public $actionAllowed = [
		//'create' => TRUE,
		//'view'=> TRUE,
		//'update' => TRUE,
		//'delete' => TRUE,
	];

	/**
	 * storing data access error messages
	 *
	 * @var array
	 */
	static $accessErrorMessages = [];

	/**
	 * storing model action error messages
	 *
	 * @var array
	 */
	public $actionErrorMessages = [];

	/* ================ error messages ================ */

	/**
	 * getting access error message
	 *
	 * @param string $name
	 * @return string
	 */
	static function getAccessError($name = '')
	{
		return array_key_exists($name, static::$accessErrorMessages) ? static::$accessErrorMessages[$name] : NULL;

	}

	/**
	 * store access error messages
	 *
	 * @param string $name
	 * @param string $message
	 */
	static function setAccessError($name = '', $message = '')
	{
		if ($name != '' && $message != '')
		{
			static::$accessErrorMessages[$name] = $message;
		}

	}

	/**
	 * get action error message
	 *
	 * @param string $name
	 * @return string
	 */
	public function getActionError($name = '')
	{
		return array_key_exists($name, $this->actionErrorMessages) ? $this->actionErrorMessages[$name] : static::getAccessError($name);

	}

	/**
	 * store action error message
	 *
	 * @param string $name
	 * @param string $message
	 */
	public function setActionError($name = '', $message = '')
	{
		if ($name != '' && $message != '')
		{
			$this->actionErrorMessages[$name] = $message;
		}

	}

	/**
	 *
	 * @param string $accessName
	 *
	 * @return HttpException
	 */
	static function accessException($accessName = '')
	{
		return new HttpException(static::ERROR_CODE, static::getAccessError($accessName));

	}

	/**
	 *
	 * @param string $actionName
	 *
	 * @return HttpException
	 */
	public function actionException($actionName = '')
	{
		return new HttpException(static::ERROR_CODE, $this->getActionError($actionName));

	}

	/* ================ model access control checks ================ */

	/**
	 * check for particular data access permission
	 * first check cached permission
	 * then execute related filter function
	 * if fail, deny permission
	 *
	 * @param string $name
	 * @return boolean
	 */
	static function accessAllowed($name = '')
	{
		$method = 'isAccessing' . Inflector::camelize($name) . 'Allowed';

		if (array_key_exists($name, static::$accessAllowed))
		{
			return static::$accessAllowed[$name];
		}
		else if (method_exists(static::className(), $method))
		{
			return static::$method();
		}
		else
		{
			return FALSE;
		}

	}

	/**
	 * check permission to access index data
	 *
	 * @return bool
	 */
	static function isAccessingIndexAllowed()
	{
		/* perform some serious access control, RBAC included */
		if (array_key_exists('index', static::$accessAllowed) == FALSE)
		{
			static::$accessAllowed['index'] = TRUE;
		}

		/* final result */
		return static::$accessAllowed['index'];

	}

	/* ================ model action control checks ================ */

	/**
	 * check whether particular action is allowed
	 * first check in stored action permission
	 * or do checking fungtion
	 * if fail, check for access data permission
	 *
	 * @param string $name
	 * @return boolean
	 */
	public function actionAllowed($name = '')
	{
		$method = 'getIsAction' . Inflector::camelize($name) . 'Allowed';

		/* cached permission */
		if (array_key_exists($name, $this->actionAllowed))
		{
			return $this->actionAllowed[$name];
		}
		/* perform access controll method */
		else if (method_exists($this, $method))
		{
			return $this->$method();
		}
		/* lastly, check for access permission */
		else
		{
			return static::accessAllowed($name);
		}

	}

	/**
	 * shortcut function
	 *
	 * @return bool
	 */
	public function getIsActionIndexAllowed()
	{
		return static::isAccessingIndexAllowed();

	}

	/**
	 * check permission to create data
	 *
	 * @return bool
	 */
	public function getIsActionCreateAllowed()
	{
		// some serious permission control
		if (array_key_exists('create', $this->actionAllowed) == FALSE)
		{
			// default permission
			$this->actionAllowed['create'] = FALSE;

			// action whitelist
			if ($this->model->isNewRecord)
			{
				$this->actionAllowed['create'] = TRUE;
			}
			// action blacklist
			else
			{
				$this->setActionError('create', 'Unknown data error.');
			}
		}

		// final result
		return $this->actionAllowed['create'];

	}

	/**
	 * check permission to view data
	 *
	 * @return bool
	 */
	public function getIsActionViewAllowed()
	{
		// some serious permission control
		if (array_key_exists('view', $this->actionAllowed) == FALSE)
		{
			// default permission
			$this->actionAllowed['view'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setActionError('view', 'Cann\'t view unsaved Data.');
			}
			// action whitelist
			else
			{
				$this->actionAllowed['view'] = TRUE;
			}
		}

		// final result
		return $this->actionAllowed['view'];

	}

	/**
	 * check permission to update data
	 *
	 * @return bool
	 */
	public function getIsActionUpdateAllowed()
	{
		// some serious permission control
		if (array_key_exists('update', $this->actionAllowed) == FALSE)
		{
			// default permission
			$this->actionAllowed['update'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setActionError('view', 'Cann\'t update unsaved Data.');
			}
			// action whitelist
			else
			{
				$this->actionAllowed['update'] = TRUE;
			}
		}

		// final result
		return $this->actionAllowed['update'];

	}

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
			if ($this->isNewRecord)
			{
				$this->setActionError('delete', 'Cann\'t delete unsaved data.');
			}
			else if ($this->model->isSoftDeleteEnabled && $this->model->getAttribute('deleted_at') > 0)
			{
				$this->setActionError('delete', 'Data already (soft) deleted.');
			}
			// action whitelist
			else
			{
				$this->actionAllowed['delete'] = TRUE;
			}
		}

		// final result
		return $this->actionAllowed['delete'];

	}

}
