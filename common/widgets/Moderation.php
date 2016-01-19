<?php

namespace common\widgets;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * generate widget to display status & model moderation
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
	 * @inheritdoc
	 */
	public function init()
	{
		parent::init();

	}

	/**
	 * Renders the widget.
	 *
	 * @return string
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

	/**
	 * parsing status property
	 */
	public function parseStatus()
	{
		if ($this->model->hasAttribute('status'))
		{
			$this->output .= "Status: {$this->model->status}<br/>";
		}

	}

	/**
	 * parse moderation property
	 *
	 * @param string $state
	 */
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

	/**
	 * parse blamable user for moderating
	 *
	 * @param string $state
	 * @return string
	 */
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

	/**
	 * formating moderation timestamps
	 *
	 * @param string $state
	 * @return string
	 */
	public function getModeration($state)
	{
		$time = $this->model->getAttribute($state . '_at');

		return ($time > 0) ? date('d M Y, H:m', $time) : NULL;

	}

}
