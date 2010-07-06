<?php

/**
 * Context-aware class for wrapping the ORM database column values.
 */
class Context_ORM_Value {
	protected $value;

	public function __construct($value) {
		$this->value = $value;
	}

	// Decide which value to use based on context.
	public function __toString() {
		$context = Context_Stack::instance()->current();

		if ($context == 'view') {
			return $this->html_value();
		} else {
			return $this->raw_value();
		}
	}

	public function raw_value() {
		return $this->value;
	}

	public function html_value() {
		return html::specialchars($this->value);
	}
}
