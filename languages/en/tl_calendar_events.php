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
 * @copyright  2010 - 2014 Felix Pfeiffer : Neue Medien
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 * @license    LGPL 
 * @filesource
 */
 
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_register'] = array('Event registration','Do you want a registration option for this event?');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_places'] = array('Number of places','Please specify the amount of places available.');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_maxplaces'] = array('Maximum number of place per reservation','Please specify the amount of places available for each reservation.');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_date'] = array('Registration deadline (Default: today + 7 days)','Please specify the registration deadline.');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_email'] = array('Notification address','You can specify an alternate email address for the registration details to be sent to.');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_groups'] = array('Member groups','Choose one or more member group(s) that are authorised to sign up for this event.');

$GLOBALS['TL_LANG']['tl_calendar_events']['ser_show'] = array('Show attendance list','Show a list of all participants for this event under the subscription form.');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_showheadline'] = array('Headline','Enter the headline for the list (output as h2).');
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_showgroups'] = array('Member group','Select one or more member groups allowed to see the list. If you donÄt select a group, the list will be shown to all groups allowed to register for this event.');

$GLOBALS['TL_LANG']['tl_calendar_events']['legend_ser_register'] = 'Basic registration';
$GLOBALS['TL_LANG']['tl_calendar_events']['ser_list_legend'] = 'Attendance list';

 
?>
