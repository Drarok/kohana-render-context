<?php

/**
 * Basic class for maintaining a stack of rendering contexts.
 */
class Context_Stack {
	// Store the singleton instance.
	protected static $instance;

	// Return the singleton instance, creating it if required.
	public static function instance() {
		if (! (bool) self::$instance) {
			new Context_Stack;
		}

		return self::$instance;
	}

	// Stack of rendering contexts.
	protected $stack;

	// Constructor.
	public function __construct() {
		// Singleton class can only have a single instance!
		if ((bool) self::$instance) {
			throw new Exception('Singleton classes must only be instantiated once.');
		}

		// Store this instance as the singleton.
		self::$instance = $this;

		// Initialise the stack.
		$this->stack = array();
	}

	// Return the current rendering context.
	public function current() {
		return end($this->stack);
	}

	// Push a context onto the stack.
	public function push($context) {
		$this->stack[] = $context;
	}

	// Pop the last context off the stack and return it.
	public function pop() {
		return array_pop($this->stack);
	}

	// Method used by the hook to push a controller context on first.
	public function push_controller_context() {
		$this->push('controller');
	}
}
