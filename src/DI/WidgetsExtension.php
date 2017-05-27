<?php

declare(strict_types=1);

namespace WebChemistry\Widgets\DI;

use Nette\DI\CompilerExtension;
use WebChemistry\Widgets\Factory;
use WebChemistry\Widgets\Macro;
use WebChemistry\Widgets\WidgetList;

class WidgetsExtension extends CompilerExtension {

	/**
	 * Processes configuration data. Intended to be overridden by descendant.
	 *
	 * @return void
	 */
	public function loadConfiguration() {
		$builder = $this->getContainerBuilder();

		$builder->addDefinition($this->prefix('widgetList'))
			->setClass(WidgetList::class, [$this->getConfig()])
			->setAutowired(FALSE);

		$builder->addDefinition($this->prefix('factory'))
			->setClass(Factory::class, [$this->prefix('@widgetList')]);
	}

	/**
	 * Adjusts DI container before is compiled to PHP class. Intended to be overridden by descendant.
	 *
	 * @return void
	 */
	public function beforeCompile() {
		$builder = $this->getContainerBuilder();

		$builder->getDefinition('nette.latteFactory')
			->addSetup(Macro::class . '::install(?->getCompiler())', ['@self']);
	}

}
