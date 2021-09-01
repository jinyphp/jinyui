<?php

namespace App\Html\Widget;

use App\Html\CTag;
use App\Html\CDiv;
use App\Html\CList;
use App\Html\CButton;
use App\Html\CLinkAction;

class CWidget {

	private const ZBX_STYLE_HEADER_NAVIGATION = 'header-navigation';
	private const ZBX_STYLE_HEADER_CONTROLS = 'header-controls';



	private $title_submenu;

	private $kiosk_mode_controls;

	/**
	 * Navigation, displayed exclusively in ZBX_LAYOUT_NORMAL mode.
	 *
	 * @var mixed
	 */
	private $navigation;

	/**
	 * The contents of the body of the widget.
	 *
	 * @var array
	 */
	protected $body = [];



	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	public function setTitleSubmenu($title_submenu) {
		$this->title_submenu = $title_submenu;

		return $this;
	}

	public function setControls($controls) {
		$this->controls = $controls;

		return $this;
	}

	public function setKioskModeControls($kiosk_mode_controls) {
		$this->kiosk_mode_controls = $kiosk_mode_controls;

		return $this;
	}

	/**
	 * Set layout mode.
	 *
	 * @param integer $web_layout_mode
	 *
	 * @return CWidget
	 */
	public function setWebLayoutMode($web_layout_mode) {
		$this->web_layout_mode = $web_layout_mode;

		return $this;
	}

	/**
	 * Set navigation for displaying exclusively in ZBX_LAYOUT_NORMAL mode.
	 *
	 * @param mixed $navigation
	 *
	 * @return CWidget
	 */
	public function setNavigation($navigation) {
		$this->navigation = $navigation;

		return $this;
	}

	public function addItem($items = null) {
		if (!is_null($items)) {
			$this->body[] = $items;
		}

		return $this;
	}






}
