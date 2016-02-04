<?php

namespace WebChemistry\Widgets\DI;

use Nette\DI\CompilerExtension;

class WidgetsExtension extends CompilerExtension {

	/**
	 * Processes configuration data. Intended to be overridden by descendant.
	 *
	 * @return void
	 */
	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('widgetList'))
			->setClass('WebChemistry\Widgets\WidgetList', [$this->getConfig()])
			->setAutowired(FALSE);

		$builder->addDefinition($this->prefix('factory'))
			->setClass('WebChemistry\Widgets\Factory', [$this->prefix('@widgetList')]);
	}

	/**
	 * Adjusts DI container before is compiled to PHP class. Intended to be overridden by descendant.
	 *
	 * @return void
	 */
	public function beforeCompile() {
		$builder = $this->getContainerBuilder();

		$builder->getDefinition('nette.latteFactory')
			->addSetup('WebChemistry\Widgets\Macro::install(?->getCompiler())', ['@self']);
	}

}
