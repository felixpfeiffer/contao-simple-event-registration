<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2014 Leo Feyer
 *
 * @package Simple_event_registration
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'FelixPfeiffer',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Classes
	'FelixPfeiffer\SimpleEventRegitration\SimpleEventRegistration'       => 'system/modules/simple_event_registration/classes/SimpleEventRegistration.php',

	// Models
	'FelixPfeiffer\SimpleEventRegitration\EventRegistrationModel'        => 'system/modules/simple_event_registration/models/EventRegistrationModel.php',

	// Modules
	'FelixPfeiffer\SimpleEventRegitration\ModuleSimpleEventAttendance'   => 'system/modules/simple_event_registration/modules/ModuleSimpleEventAttendance.php',
	'FelixPfeiffer\SimpleEventRegitration\ModuleSimpleEventRegistration' => 'system/modules/simple_event_registration/modules/ModuleSimpleEventRegistration.php',
));


/**
 * Register the templates
 */
TemplateLoader::addFiles(array
(
	'be_ser_overview'                 => 'system/modules/simple_event_registration/templates',
	'mod_simple_event_attendance'     => 'system/modules/simple_event_registration/templates',
	'simple_events_registration_form' => 'system/modules/simple_event_registration/templates',
	'simple_events_registration_list' => 'system/modules/simple_event_registration/templates',
));
