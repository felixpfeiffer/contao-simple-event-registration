<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 * Copyright (C) 2005-2009 Leo Feyer
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 2.1 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at http://www.gnu.org/licenses/.
 *
 * PHP version 5
 * @copyright  2010 Felix Pfeiffer : Neue Medien 
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 * @license    LGPL 
 * @filesource
 */

$GLOBALS['BE_MOD']['content']['calendar']['tables'][] = 'tl_event_registrations';
$GLOBALS['BE_MOD']['content']['calendar']['anonymregister'] = array('tl_event_registrations','anonymregister');
$GLOBALS['BE_MOD']['content']['calendar']['serexport'] = array('tl_event_registrations','exportRegisteredUsers');
$GLOBALS['BE_MOD']['content']['calendar']['splitRecurring'] = array('tl_simple_event_registration','splitRecurring');

$GLOBALS['BE_MOD']['content']['calendar']['serexportfields'] = array(
	'user' => array('firstname','lastname','email'),
	'anuser' => array('firstname','lastname','email'),
	'event'=> array('title','date','url'),
    'stylesheet' => 'system/modules/simple_event_registration/assets/be_css.css'
);

$GLOBALS['BE_MOD']['content']['calendar']['stylesheet'] = 'system/modules/simple_event_registration/assets/be_css.css';

 
$GLOBALS['FE_MOD']['events']['eventreader'] = 'SimpleEventRegistration\\ModuleSimpleEventRegistration';
$GLOBALS['FE_MOD']['events']['serattendance'] = 'SimpleEventRegistration\\ModuleSimpleEventAttendance';

$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('SimpleEventRegistration', 'showPlaces');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('SimpleEventRegistration', 'showClasses');
$GLOBALS['TL_HOOKS']['replaceInsertTags'][] = array('SimpleEventRegistration', 'showLabel');


/**
 * Das Model für die Registrierungen registrieren
 */
$GLOBALS['TL_MODELS']['tl_event_registrations'] = 'FelixPfeiffer\SimpleEventRegistration\EventRegistrationsModel';

?>