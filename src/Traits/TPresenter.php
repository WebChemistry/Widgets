<?php

declare(strict_types=1);

namespace WebChemistry\Widgets\Traits;

use Latte\Engine;
use Nette\Application\UI\ITemplate;
use WebChemistry\Widgets\Factory;
use WebChemistry\Widgets\Manager;

/**
 * @property-read Manager $widgets
 */
trait TPresenter {

	/** @var Manager */
	private $widgets;

	public function injectWidgets(Factory $factory): void {
		$this->widgets = $factory->create();
	}

	/**
	 * @return Manager
	 */
	public function getWidgets(): Manager {
		return $this->getComponent('widgets');
	}

	/**
	 * @return Manager
	 */
	protected function createComponentWidgets(): Manager {
		return $this->widgets;
	}

	/**
	 * @return ITemplate
	 */
	protected function createTemplate($template = NULL): ITemplate {
		$template = $template ? : parent::createTemplate();

		/** @var Engine $latte */
		$latte = $template->getLatte();
		$latte->addProvider('widgets', $this->getWidgets());

		return $template;
	}

}
