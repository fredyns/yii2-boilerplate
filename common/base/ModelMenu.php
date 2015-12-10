<?php

namespace common\base;

use Yii;
use yii\helpers\Inflector;

/**
 * Description of ModelMenu
 *
 * @author fredy
 */
class ModelMenu extends ModelLink
{

	const MENU_DIVIDER = '<li role="presentation" class="divider"></li>';

	const TYPE_DROPDOWN = 'dropdown';

	const TYPE_LINK = 'link';

	const TYPE_BUTTON = 'button';

	/**
	 * model control to manipulate links
	 *
	 * @var ModelControl
	 */
	public $control;

	/**
	 * separator for link list widget
	 *
	 * @var string
	 */
	public $link_separator = ' &centerdot; ';

	/**
	 * widget type
	 * value: dropdown|link|button
	 *
	 * @var string
	 */
	public $type = 'dropdown';

	/**
	 * links to be displayed
	 *
	 * @var array
	 */
	public $items = [];

	/**
	 * button alignment
	 * value: left|right
	 *
	 * @var string
	 */
	public $align = 'right';

	/* ================ general ================ */

	/**
	 * class initiation
	 */
	public function init()
	{
		parent::init();

		if (empty($this->items))
		{
			$this->items = $this->defaultMenu();
		}

	}

	/**
	 * default menu items (name) to be displayed
	 *
	 * @return array
	 */
	public function defaultMenu()
	{
		return ['view', 'update', 'delete'];

	}

	/* ================ widget ================ */

	/**
	 * generate link anchor based on model
	 *
	 * @param string $name
	 * @return string
	 */
	public function anchor($name = '')
	{
		$allowed = $this->control->actionAllowed($name);

		if ($allowed)
		{
			return static::a($name, $this->control->model);
		}

		return '';

	}

	/**
	 * generate link button based on model
	 *
	 * @param string $name
	 * @return string
	 */
	public function button($name = '')
	{
		$allowed = $this->control->actionAllowed($name);

		if ($allowed)
		{
			return static::btn($name, $this->control->model);
		}

		return '';

	}

	/**
	 * get all link item params to be displayed
	 *
	 * @return array
	 */
	public function getItemLinks($items = [])
	{
		$menus = [];
		$count = 0;
		$lastItem = NULL;

		if (empty($items))
		{
			$items = $this->items;
		}

		// parse each items
		foreach ($items as $item)
		{
			if ($item !== static::MENU_DIVIDER)
			{
				$menu = static::linkParam($item, $this->control->model);

				$allowed = $this->control->actionAllowed($item);

				if ($menu && $allowed)
				{
					$menus[] = $menu;
					$lastItem = $menu;
					$count++;
				}
			}
			else if (is_array($item) OR ( $this->type = static::TYPE_DROPDOWN && $count > 0 && $item !== $lastItem ))
			{
				$menus[] = $item;
				$lastItem = $item;
				$count++;
			}
		}

		return $menus;

	}

	/**
	 * render widget
	 *
	 * @return string
	 */
	public function run()
	{
		$method = 'widget' . Inflector::camelize($this->type);

		return $this->$method();

	}

	/**
	 * generate dropdown widget
	 *
	 * @return string
	 */
	public function widgetDropdown($items = [])
	{
		$primaryKey = $this->control->model->primaryKey()[0];

		$buttonConfig = [
			'id'			 => Inflector::camel2id(get_called_class()) . '_' . $this->control->model->getAttribute($primaryKey),
			'encodeLabel'	 => false,
			'label'			 => 'Action',
			'dropdown'		 => [
				'options'		 => [
					'class' => 'dropdown-menu-' . $this->align,
				],
				'encodeLabels'	 => false,
				'items'			 => $this->getItemLinks($items),
			],
			'options'		 => [
				'class' => 'btn btn-primary',
			],
		];

		/* dropdown menu */
		return \yii\bootstrap\ButtonDropdown::widget($buttonConfig);

	}

	/**
	 * generate links widget
	 *
	 * @return string
	 */
	public function widgetLink($items = [])
	{
		$links = [];

		foreach ($items as $item)
		{
			if ($this->control->actionAllowed($item))
			{
				$links[] = static::a($item, $this->control->model);
			}
		}

		return ($links) ? implode($this->link_separator, $links) : '';

	}

	/**
	 * generate button widget
	 *
	 * @return string
	 */
	public function widgetButton($items = [])
	{
		$links = [];

		foreach ($items as $item)
		{
			if ($this->control->actionAllowed($item))
			{
				$links[] = static::btn($item, $this->control->model);
			}
		}

		if ($links)
		{
			$output = "<p class=\"pull-{$this->align}\">\n";

			$output .= implode("\n", $links);

			return $output . "\n</p>";
		}

		return '';

	}

	/**
	 * using sample in view
	 *
	 * @return string
	 */
	function sample_use()
	{
		self::widget([
			'type'			 => 'dropdown|link|button',
			'control'		 => new BaseModelControl([
				'model' => new BaseModel,
				]),
			'items'			 => [
				'index',
				'archived',
				'deleted',
				self::MENU_DIVIDER,
				'view',
				'update',
				'archive',
				'delete',
			],
			'route'			 => '/controller',
			'link_separator' => ' | ',
		]);

	}

}
