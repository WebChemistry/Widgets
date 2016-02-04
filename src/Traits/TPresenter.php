<?php

namespace WebChemistry\Widgets\Traits;

use Nette\Application\UI\ITemplate;
use WebChemistry\Widgets\Manager;

/**
 * @property-read Manager $widgets
 */
trait TPresenter {

	/** @var Manager */
	private $widgets;

	/**
	 * @return Manager
	 */
	public function getWidgets() {
		return $this->getComponent('widgets');
	}

	/**
	 * @return Manager
	 */
	protected function createComponentWidgets() {
		return $this->widgets;
	}

	/**
	 * @return ITemplate
	 */
	protected function createTemplate($template = NULL) {
		$template = $template ? : parent::createTemplate();
		$template->widgets = $this->getWidgets();

		return $template;
	}

}
