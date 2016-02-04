<?php

namespace WebChemistry\Widgets;

use Nette\Application\UI\Multiplier;
use Nette\ComponentModel\IComponent;

class WidgetList {

	/** @var array */
	private $services;

	/**
	 * @param array $services
	 */
	public function __construct(array $services) {
		$this->services = $services;
	}

	/**
	 * @param string $name
	 * @return bool
	 */
	public function exists($name) {
		return isset($this->services[$name]);
	}

	/**
	 * @param string $name
	 * @return IComponent
	 */
	public function get($name) {
		if (is_object($this->services[$name])) {
			return $this->services[$name];
		}
		$multiplier = FALSE;
		$service = $this->services[$name];
		if (is_array($service)) {
			$multiplier = isset($service['multiplier']) ? $service['multiplier'] : FALSE;
			$service = $service['class'];
		}
		if (!is_object($service)) {
			$service = new $service;
		}
		if ($multiplier) {
			$service = new Multiplier(function () use($service) {
				return clone $service;
			});
		}

		return $this->services[$name] = $service;
	}

}
