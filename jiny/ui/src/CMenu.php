<?php declare(strict_types = 1);

namespace Jiny\UI;

use \Jiny\Html\CTag;

class CMenu extends CTag {

	/**
	 * @var CMenuItem[]
	 */
	private $menu_items = [];

	/**
	 * Create menu.
	 *
	 * @param CMenuItem[] $menu_items  Array of menu items.
	 */
	public function __construct(array $menu_items = []) {
		parent::__construct('ul', true);

		foreach ($menu_items as $item) {
			$this->add($item);
		}
	}

	/**
	 * Return all menu items.
	 *
	 * @return CMenuItem[]
	 */
	public function getMenuItems(): array {
		return $this->menu_items;
	}

	/**
	 * Add menu item.
	 *
	 * @param CMenuItem $menu_item  Menu item object.
	 *
	 * @return CMenu
	 */
	public function add(CMenuItem $menu_item): self {
		$this->menu_items[] = $menu_item;

		return $this;
	}

	public function toString($destroy = true) {
		$this->addItem($this->menu_items);

		return parent::toString($destroy);
	}







	




	/**
	 * Find menu item by label.
	 *
	 * @param string $label  Visual label.
	 *
	 * @return CMenuItem|null
	 */
	public function find(string $label): ?CMenuItem {
		foreach ($this->menu_items as $item) {
			if ($item->getLabel() === $label) {
				return $item;
			}
		}

		return null;
	}

	/**
	 * Find menu item by label or add new one, if not exists.
	 *
	 * @param string $label  Visual label.
	 *
	 * @return CMenuItem
	 */
	public function findOrAdd(string $label): CMenuItem {
		$item = $this->find($label);

		if ($item === null) {
			$item = new CMenuItem($label);
			$this->add($item);
		}

		return $item;
	}

	/**
	 * Find selected menu item.
	 *
	 * @return CMenuItem|null
	 */
	public function findSelected(): ?CMenuItem {
		foreach ($this->menu_items as $item) {
			if ($item->isSelected()) {
				return $item;
			}
		}

		return null;
	}

	/**
	 * Insert new menu item after the one with specified label, or insert as the last item, if not found.
	 *
	 * @param string    $label      Visual label to insert item after.
	 * @param CMenuItem $menu_item  Menu item object.
	 *
	 * @return CMenu
	 */
	public function insertAfter(string $label, CMenuItem $menu_item): self {
		return $this->insert($label, $menu_item, true);
	}

	/**
	 * Insert new menu item before the one with specified label, or insert as the first item, if not found.
	 *
	 * @param string    $label      Visual label to insert item before.
	 * @param CMenuItem $menu_item  Menu item object.
	 *
	 * @return CMenu
	 */
	public function insertBefore(string $label, CMenuItem $menu_item): self {
		return $this->insert($label, $menu_item);
	}

	/**
	 * Remove menu item by label.
	 *
	 * @param string $label  Visual label.
	 *
	 * @return CMenu
	 */
	public function remove(string $label): self {
		foreach ($this->menu_items as $index => $item) {
			if ($item->getLabel() === $label) {
				array_splice($this->menu_items, $index, 1);
				break;
			}
		}

		return $this;
	}

	/**
	 * Deep find menu item by action name and mark the whole chain as selected.
	 *
	 * @param string $action_name     Action name to search for.
	 * @param array  $request_params  Parameters of current HTTP request to compare in search process.
	 * @param bool   $expand          Add 'is-expanded' class for selected submenus.
	 *
	 * @return bool  True, if menu item was selected.
	 */
	public function setSelectedByAction(string $action_name, array $request_params, bool $expand = false): bool {
		foreach ($this->menu_items as $item) {
			if ($item->setSelectedByAction($action_name, $request_params)) {
				if ($expand && $item->hasSubMenu()) {
					$item->addClass('is-expanded');
				}
				return true;
			}
		}

		return false;
	}

	private function insert(string $label, CMenuItem $menu_item, $after = false): self {
		$count = count($this->menu_items);

		for ($i = 0; $i < $count; $i++) {
			if ($this->menu_items[$i]->getLabel() === $label) {
				break;
			}
		}

		$position = ($count == $i && !$after) ? 0 : $i + (($i < $count && $after) ? 1 : 0);
		array_splice($this->menu_items, $position, 0, [$menu_item]);

		return $this;
	}


}
