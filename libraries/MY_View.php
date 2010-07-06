<?php

class View extends View_Core {
	public function render($print = FALSE, $renderer = FALSE) {
		// Get the context stack.
		$stack = Context_Stack::instance();

		// Push the view context.
		$stack->push('view');

		// Run the render method.
		$result = parent::render($print, $renderer);

		// Pop off the context.
		$stack->pop();

		// Return the value we got from the render method.
		return $result;
	}
}
