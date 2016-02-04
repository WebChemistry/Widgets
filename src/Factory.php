<?php

namespace WebChemistry\Widgets;

class Factory {

	/** @var WidgetList */
	private $widgetList;

	public function __construct(WidgetList $widgetList) {
		$this->widgetList = $widgetList;
	}

	/**
	 * @return Manager
	 */
	public function create() {
		return new Manager($this->widgetList);
	}

}
