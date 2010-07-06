<?php

/**
 * ORM subclass to return context-aware objects instead of raw strings.
 */
class Context_ORM extends ORM {
	// Return an instance of Context_ORM_Value for database column values.
	public function __get($column) {
		if (array_key_exists($column, $this->object)) {
			return new Context_ORM_Value($this->object[$column]);
		}

		// Pass on up to the parent class.
		return parent::__get($column);
	}
}
