<?php

declare(strict_types=1);

namespace WebChemistry\Widgets;

use Latte\Compiler;
use Latte\MacroNode;
use Latte\Macros\MacroSet;
use Latte\PhpWriter;

class Macro extends MacroSet {

	/**
	 * @param Compiler $compiler
	 */
	public static function install(Compiler $compiler): void {
		$set = new static($compiler);

		$set->addMacro('widget', [$set, 'widget']);
	}

	/**
	 * @param MacroNode $macroNode
	 * @param PhpWriter $writer
	 * @return string
	 */
	public function widget(MacroNode $macroNode, PhpWriter $writer): string {
		return $writer->write('$_l->tmp = $this->global->widgets->getComponent(%node.word);if ($_l->tmp instanceof Nette\Application\UI\IRenderable) $_l->tmp->redrawControl(NULL, FALSE); $_l->tmp->render()');
	}

}
