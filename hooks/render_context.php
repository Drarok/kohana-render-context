<?php

// Automatically push the controller context just before one is instantiated.
Event::add(
	'system.pre_controller',
	array(Context_Stack::instance(), 'push_controller_context')
);
