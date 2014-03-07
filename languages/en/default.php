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


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['ser_submit'] = 'Sign Up';
$GLOBALS['TL_LANG']['MSC']['ser_unregister'] = 'Cancel sign Up';
$GLOBALS['TL_LANG']['MSC']['ser_checkbox_label'] = 'Yes, sign me up to this event.';
$GLOBALS['TL_LANG']['MSC']['ser_checkbox_label_unregister'] = 'I want to cancel my sign up for this event.';
$GLOBALS['TL_LANG']['MSC']['ser_av_places'] = 'We still have %s spaces left for this event.';
$GLOBALS['TL_LANG']['MSC']['ser_regallready'] = 'You\'ve already registered for this event.';
$GLOBALS['TL_LANG']['MSC']['ser_full'] = 'Unfortunately, this event is already fully booked.';
$GLOBALS['TL_LANG']['MSC']['ser_full_reg'] = 'This event is already fully booked.';
$GLOBALS['TL_LANG']['MSC']['ser_register_success'] = 'You\'ve successfully signed up for this event.<br />A confirmation has been sent to your email address.';
$GLOBALS['TL_LANG']['MSC']['ser_unregister_success'] = 'You\'ve successfully canceld your signed up for this event.<br />A confirmation has been sent to your email address.';

$GLOBALS['TL_LANG']['MSC']['ser_it_places'] = '<span class="ser_it_places">(%s of %s spaces available)</span>';
$GLOBALS['TL_LANG']['MSC']['ser_anonym_set'] = '%s anonymous user(s) have been added';
$GLOBALS['TL_LANG']['MSC']['ser_anonym_max places'] = 'You can create up to %s anonymous users.';
$GLOBALS['TL_LANG']['MSC']['ser_no_places'] = 'There are no more spaces available for this event.';
$GLOBALS['TL_LANG']['MSC']['ser_to_much_places'] = 'You\'ve created too many anonymous users. Only a maximum of %s users can be added.';
$GLOBALS['TL_LANG']['MSC']['ser_regclosed'] = 'The registration deadline for this event ended on %s.';

$GLOBALS['TL_LANG']['MSC']['quantity_label'] = "Select the quantity of reservations";

/* Label für den Insert-Tag {{serlabel::ID::[period/availability/user]}} */
$GLOBALS['TL_LANG']['MSC']['ser_label_period']['open'] = 'Registration is open';
$GLOBALS['TL_LANG']['MSC']['ser_label_period']['finished'] = 'Registration closed';

$GLOBALS['TL_LANG']['MSC']['ser_label_availability']['free'] = '%s places available';
$GLOBALS['TL_LANG']['MSC']['ser_label_availability']['waitinglist'] = 'Registration on waitinglist';

$GLOBALS['TL_LANG']['MSC']['ser_label_user']['booked'] = 'You are registered for this event';

/* E-Mail Anmeldebenachrichtigung Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_register_subject'] = 'Neue Anmeldung für das Event "##event_title##"';

$GLOBALS['TL_LANG']['MSC']['ser_notify_mail'] = 'Für das Event "##event_title##" (##event_date##) hat sich folgender User angemeldet.

Username: ##user_username##

Vorname: ##user_firstname##

Nachname: ##user_lastname##

E-Mail: ##user_email##


Anzahl: ##ser_quantity##


Event Adresse: ##event_url##
';

/* E-Mail Anmeldebenachrichtigung (Warteliste) Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_subject'] = 'Wartelisteneintrag für das Event "##event_title##"';

$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_mail'] = 'Für das Event "##event_title##" (##event_date##) hat sich folgender User angemeldet.

Username: ##user_username##

Vorname: ##user_firstname##

Nachname: ##user_lastname##

E-Mail: ##user_email##


Anzahl: ##ser_quantity##


Event Adresse: ##event_url##
';

/* E-Mail Abmeldebenachrichtigung Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_unregister_subject'] = 'Eine Stornierung für das Event ##event_title##';
$GLOBALS['TL_LANG']['MSC']['ser_unregister_mail'] = 'Für das Event "##event_title##" (##event_date##) hat folgender User seine Anmeldung storniert.

Username: ##user_username##

Vorname: ##user_firstname##

Nachname: ##user_lastname##

e-Mail: ##user_email##


Event Adresse: ##event_url##

';

$GLOBALS['TL_LANG']['MSC']['ser_showevents']['all']       = 'Show all events';
$GLOBALS['TL_LANG']['MSC']['ser_showevents']['future']    = 'Show only future events';
$GLOBALS['TL_LANG']['MSC']['ser_showevents']['past']      = 'Show only past events';

$GLOBALS['TL_LANG']['MSC']['ser_emptylist'] = 'There are no registrations for the event "%s".';
$GLOBALS['TL_LANG']['MSC']['ser_listsummary'] = 'Listing of all registrations for the event "%s".';

$GLOBALS['TL_LANG']['MSC']['ser_list_heads'] = array('no'=>'No.','firstname'=>'Firstname','lastname'=>'Lastname','email'=>'E-mail');

?>