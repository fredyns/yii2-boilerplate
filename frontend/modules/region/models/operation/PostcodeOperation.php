<?php

namespace frontend\modules\region\models\operation;

use Yii;
use yii\helpers\Html;
use common\base\ModelOperation;
use frontend\modules\region\models\Postcode;
use cornernote\returnurl\ReturnUrl;
use common\widgets\Icon;

/**
 * Description of PostcodeOperation
 *
 * @author fredy
 *
 * @property Postcode $model
 * @property Bool $allowRestore
 * @property Array $paramsRestore
 */
class PostcodeOperation extends ModelOperation
{

	public $items = ['view', 'update', 'delete', 'restore'];

	/**
	 * @inheritdoc
	 */
	public function controllerRoute()
	{
		return 'region/postcode';

	}

	/**
	 * check permision to delete model
	 *
	 * @return boolean
	 */
	public function getAllowDelete()
	{
		// some serious permission control
		if (array_key_exists('delete', $this->allowed) == FALSE)
		{
			// default permission
			$this->allowed['delete'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setError('delete', "Cann't delete unsaved data.");
			}
			else if ($this->model->recordStatus == Postcode::RECORDSTATUS_DELETED)
			{
				$this->setError('delete', 'Data already (soft) deleted.');
			}
			// action whitelist
			else
			{
				$this->allowed['delete'] = TRUE;
			}
		}

		// final result
		return $this->allowed['delete'];

	}

	/**
	 * check permision to restore deleted model
	 *
	 * @return boolean
	 */
	public function getAllowRestore()
	{
		// some serious permission control
		if (array_key_exists('restore', $this->allowed) == FALSE)
		{
			// default permission
			$this->allowed['restore'] = FALSE;

			// prerequisites check
			if ($this->model->isNewRecord)
			{
				$this->setError('restore', "Cann't restore unsaved data.");
			}
			else if ($this->model->recordStatus == Postcode::RECORDSTATUS_USED)
			{
				$this->setError('restore', 'Data already activated.');
			}
			// action whitelist
			else
			{
				$this->allowed['restore'] = TRUE;
			}
		}

		// final result
		return $this->allowed['restore'];

	}

	/**
	 * link parameter to restore deleted model
	 *
	 * @return array
	 */
	public function getParamsRestore()
	{
		$primaryKey = $this->model->primaryKey()[0];

		return [
			'url'			 => [
				$this->actionRoute('restore'),
				$primaryKey	 => $this->model->getAttribute($primaryKey),
				'ru'		 => ReturnUrl::getToken(),
			],
			'label'			 => 'Restore',
			'icon'			 => Icon::create('pencil'),
			'buttonOptions'	 => [
				'class' => 'btn btn-primary',
			],
		];

	}

	/**
	 * @inheritdoc
	 */
	public function getLinkView($label = '', $linkOptions = ['title' => 'view detail'])
	{
		if ($label === '')
		{
			$label = $this->model->postcode;
		}

		$url = $this->url('view');

		return Html::a($label, $url, $linkOptions);

	}

}
