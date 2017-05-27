<?php

declare(strict_types=1);

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
	 * @param string|int $name
	 * @return bool
	 */
	public function exists($name): bool {
		return isset($this->services[$name]);
	}

	/**
	 * @param string|int $name
	 * @return IComponent|NULL
	 */
	public function get($name): ?IComponent {
		if (!isset($this->services[$name])) {
			return NULL;
		}
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
