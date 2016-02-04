<?php

namespace WebChemistry\Widgets;

use Nette\ComponentModel\Container;
use Nette\ComponentModel\IComponent;

class Manager extends Container implements \ArrayAccess {

	/** @var array */
	private $registered = [];

	/** @var WidgetList */
	private $widgetList;

	/**
	 * @param WidgetList $widgetList
	 */
	public function __construct(WidgetList $widgetList) {
		$this->widgetList = $widgetList;
	}

	/**
	 * Component factory. Delegates the creation of components to a createComponent<Name> method.
	 *
	 * @param  string      component name
	 * @return IComponent  the created component (optionally)
	 */
	protected function createComponent($name) {
		return;
	}

	/**
	 * Returns component specified by name or path.
	 *
	 * @param  string
	 * @param  bool   throw exception if component doesn't exist?
	 * @return IComponent|NULL
	 */
	public function getComponent($name, $need = TRUE) {
		$origName = $name;
		if (($pos = strpos($name, self::NAME_SEPARATOR)) !== FALSE) {
			$name = substr($name, 0, $pos);
		}
		if (array_search($name, $this->registered) === FALSE && $this->widgetList->exists($name)) {
			$this->registered[] = $name;
			$this->addComponent($this->widgetList->get($name), $name);
		}

		return parent::getComponent($origName, $need);
	}

	/**
	 * Whether a offset exists
	 */
	public function offsetExists($offset) {
		return $this->widgetList->exists($offset);
	}

	/**
	 * Offset to retrieve
	 */
	public function offsetGet($offset) {
		return $this->getComponent($offset);
	}

	/**
	 * Offset to set
	 */
	public function offsetSet($offset, $value) {
		$this->addComponent($value, $offset);
	}

	/**
	 * Offset to unset
	 */
	public function offsetUnset($offset) {
		$this->removeComponent($this->getComponent($offset));
	}

}
