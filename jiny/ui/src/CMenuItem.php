<?php declare(strict_types = 1);
namespace Jiny\UI;

use \Jiny\Html\CTag;
use \Jiny\Html\CLink;
use \Jiny\Html\CSpan;

class CMenuItem extends CTag 
{
	

	/**
	 * Create menu item.
	 *
	 * @param string $label  Menu item visual label.
	 */
	public function __construct($items = null) 
	{
		parent::__construct('li', true);
		$this->addItem($items);
	}




	/**
	 * 객체 출력 처리 부분
	 */

	public function toString($destroy = true) {
		// $this->setAttribute('name', $this->name);

		
		/*
		if ($this->url !== null || $this->sub_menu !== null) {
			$this->addItem([
				(new CLink($this->label, $this->sub_menu !== null ? '#' : $this->url->getUrl()))
					->addClass($this->icon_class)
					->setTitle($this->title)
					->setTarget($this->target),
				$this->sub_menu
			]);
		}
		else {
	
			$this->addItem(
				(new CSpan($this->label))
			
					->addClass($this->icon_class)
					->setTitle($this->title)
				
			);
		
		}
		*/
		

		return parent::toString($destroy);
	}

	public $id;
	public $ref;
	public $level;
	public $icon;
	public $title;
	public $href;
	public $target;
	

	public function set($item)
	{
		$this->id = $item['id'];
		$this->ref = $item['ref'];
		$this->level = $item['level'];
		$this->icon = $item['icon'];
		$this->title = $item['title'];
		$this->href = $item['href'];
		$this->target = $item['target'];

		if(isset($item['selected'])) {
			$this->setSelected();
		}
	

		return $this;
	}

	public function setTitle($title): self {
		$this->title = $title;

		return $this;
	}

	public function setTarget(string $target): self {
		$this->target = $target;

		return $this;
	}

	/**
	 * @var bool
	 */
	private $is_selected = false;
	public function isSelected(): bool {
		return $this->is_selected;
	}

	public function setSelected(): self {
		$this->is_selected = true;
		$this->addClass('is-selected');
		return $this;
	}















	



	private $label;
	/**
	 * Get visual label of menu item.
	 *
	 * @return string
	 */
	public function getLabel(): string 
	{
		return $this->label;
	}


	/**
	 * @var string
	 */
	private $action;

	/**
	 * @var array
	 */
	private $aliases = [];

	/**
	 * @var string
	 */
	private $icon_class;

	/**
	 * @var string
	 */
	

	/**
	 * @var CMenu
	 */
	private $sub_menu;



	/**
	 * @var CUrl
	 */
	private $url;



	

	/**
	 * Get action name.
	 *
	 * @return string|null
	 */
	public function getAction(): ?string {
		return $this->action;
	}

	/**
	 * Set action name and derive a corresponding URL for menu item link.
	 *
	 * @param string $action_name  Action name.
	 *
	 * @return CMenuItem
	 */
	public function setAction(string $action_name): self {
		return $this->setUrl((new CUrl('zabbix.php'))->setArgument('action', $action_name), $action_name);
	}

	/**
	 * Get action name aliases.
	 *
	 * @return array
	 */
	public function getAliases(): array {
		return $this->aliases;
	}

	/**
	 * Set action name aliases.
	 *
	 * @param array $aliases  The aliases of menu item. Is able to specify the alias in following formats:
	 *                        - {action_name} - The alias is applicable to page with specified action name with any GET
	 *                          parameters in URL or without them;
	 *                        - {action_name}?{param}={value} - The alias is applicable to page with specified action
	 *                          when specified GET parameter exists in URL and have the same value;
	 *                        - {action_name}?{param}=* - The alias is applicable to page with specified action
	 *                          when specified GET parameter exists in URL and have any value;
	 *                        - {action_name}?!{param}={value} - The alias is applicable to page with specified action
	 *                          when specified GET parameter not exists in URL or have different value;
	 *                        - {action_name}?!{param}=* - The alias is applicable to page with specified action
	 *                          when specified GET parameter not exists in URL.
	 *
	 * @return CMenuItem
	 */
	public function setAliases(array $aliases): self {
		foreach ($aliases as $alias) {
			['path' => $action_name, 'query' => $query_string] = parse_url($alias) + ['query' => ''];
			parse_str($query_string, $query_params);
			$this->aliases[$action_name][] = $query_params;
		}

		return $this;
	}

	/**
	 * Set icon CSS class for menu item link.
	 *
	 * @param string $icon_class
	 *
	 * @return CMenuItem
	 */
	public function setIcon(string $icon_class): self {
		$this->icon_class = $icon_class;

		return $this;
	}





	/**
	 * Deep find menu item (including this one) by action name and mark the whole chain as selected.
	 *
	 * @param string $action_name     Action name to search for.
	 * @param array  $request_params  Parameters of current HTTP request to compare in search process.
	 * @param bool   $expand          Add 'is-expanded' class for selected submenus.
	 *
	 * @return bool  True, if menu item was selected.
	 */
	public function setSelectedByAction(string $action_name, array $request_params, bool $expand = false): bool {
		if (array_key_exists($action_name, $this->aliases)) {
			foreach ($this->aliases[$action_name] as $alias_params) {
				$no_unacceptable_params = true;
				$unacceptable_params = [];
				foreach ($alias_params as $name => $value) {
					if ($name[0] === '!') {
						$unacceptable_params[substr($name, 1)] = $value;
						unset($alias_params[$name]);
					}
				}

				if ($unacceptable_params) {
					$unacceptable_params_existing = array_intersect_assoc($unacceptable_params, $request_params);
					foreach ($unacceptable_params as $name => $value) {
						if ($value === '*' && array_key_exists($name, $request_params)) {
							$unacceptable_params_existing[$name] = '*';
						}
					}

					$no_unacceptable_params = array_diff_assoc($unacceptable_params, $unacceptable_params_existing)
						? true
						: false;
				}

				$alias_params_diff = array_diff_assoc($alias_params, $request_params);
				foreach ($alias_params_diff as $name => $value) {
					if ($value === '*') {
						unset($alias_params_diff[$name]);
					}
				}

				if ($no_unacceptable_params && !$alias_params_diff) {
					$this->setSelected();

					return true;
				}
			}
		}

		if ($this->sub_menu !== null && $this->sub_menu->setSelectedByAction($action_name, $request_params, $expand)) {
			$this->setSelected();

			return true;
		}

		return false;
	}

	/**
	 * Get submenu of menu item or create new one, if not exists.
	 *
	 * @return CMenu
	 */
	public function getSubMenu(): CMenu {
		if ($this->sub_menu === null) {
			$this->setSubMenu(new CMenu());
		}

		return $this->sub_menu;
	}

	/**
	 * Set submenu for menu item.
	 *
	 * @param CMenu $sub_menu
	 *
	 * @return CMenuItem
	 */
	public function setSubMenu(CMenu $sub_menu): self {
		$this->sub_menu = $sub_menu->addClass('submenu');
		$this->addClass('has-submenu');

		return $this;
	}

	/**
	 * Check if menu item has submenu.
	 *
	 * @return bool
	 */
	public function hasSubMenu(): bool {
		return ($this->sub_menu !== null);
	}



	/**
	 * Set title attribute for the menu item link.
	 *
	 * @param string $title
	 *
	 * @return CMenuItem
	 */


	/**
	 * Get url of the menu item link.
	 *
	 * @return CUrl|null
	 */
	public function getUrl(): ?CUrl {
		return $this->url;
	}

	/**
	 * Set url for the menu item link.
	 *
	 * @param CUrl        $url
	 * @param string|null $action_name  Associate action name to be matched by setSelected method.
	 *
	 * @return CMenuItem
	 */
	public function setUrl(CUrl $url, string $action_name = null): self {
		$action = null;

		if ($action_name !== null) {
			$this->setAliases([$action_name]);
			['path' => $action] = parse_url($action_name);
		}

		$this->url = $url;
		$this->action = $action;

		return $this;
	}


}
