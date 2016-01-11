<?php

namespace common\widgets;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Description of Moderation
 *
 * @author fredy
 */
class Moderation extends \yii\base\Widget
{

	public $model;

	public $types = ['created', 'updated', 'deleted'];

	public $output = '';

	public $tag_open = '<p style="opacity: 0.8; font-style: italic; font-size: 0.8em;">';

	public $tag_close = '</p>';

	public $nameField = ['username'];

	/**
	 * Initializes the widget.
	 */
	public function init()
	{
		parent::init();

	}

	/**
	 * Renders the widget.
	 */
	public function run()
	{
		$this->output .= $this->tag_open;

		$this->parseStatus();

		foreach ($this->types as $state)
		{
			$this->parseModeration($state);
		}

		$this->output .= $this->tag_close;

		return $this->output;

	}

	public function parseStatus()
	{
		if ($this->model->hasAttribute('status'))
		{
			$this->output .= "Status: {$this->model->status}<br/>";
		}

	}

	public function parseModeration($state)
	{
		$title = ucfirst($state);
		$moderator = $this->getModerator($state);
		$moderation = $this->getModeration($state);

		if ($moderator OR $moderation)
		{
			$this->output .= "{$title} ";

			if ($moderator)
			{
				$this->output .= "by {$moderator} ";
			}

			if ($moderation)
			{
				$this->output .= "at {$moderation} ";
			}

			$this->output .= '<br/>';
		}

	}

	public function getModerator($state)
	{
		$title = ucfirst($state);
		$has_moderator = $this->model->hasAttribute($state . 'By_id');

		if ($has_moderator)
		{
			$getter = "get{$title}By";
			$moderator = $this->model->$getter()->one();

			if ($moderator)
			{
				foreach ($this->nameField as $field)
				{
					$name = ArrayHelper::getValue($moderator, $field);

					if ($name)
					{
						return $name;
					}
				}
			}
		}

		return NULL;

	}

	public function getModeration($state)
	{
		$time = $this->model->getAttribute($state . '_at');

		return ($time > 0) ? date('d M Y, H:m', $time) : NULL;

	}

}
