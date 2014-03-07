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
 * @package    Language
 * @license    LGPL 
 * @filesource
 */


/**
 * Miscellaneous
 */
$GLOBALS['TL_LANG']['MSC']['ser_submit'] = 'Teilnehmen';
$GLOBALS['TL_LANG']['MSC']['ser_unregister'] = 'Teilnahme stornieren';
$GLOBALS['TL_LANG']['MSC']['ser_checkbox_label'] = 'Ja, ich möchte an diesem Event teilnehmen.';
$GLOBALS['TL_LANG']['MSC']['ser_checkbox_label_unregister'] = 'Ich möchte meine Teilnahme für dieses Event stornieren.';
$GLOBALS['TL_LANG']['MSC']['ser_av_places'] = 'Wir haben noch %s Plätze in diesem Event frei.';
$GLOBALS['TL_LANG']['MSC']['ser_regallready'] = 'Sie sind bereits für dieses Event angemeldet.';
$GLOBALS['TL_LANG']['MSC']['ser_full'] = 'Dieses Event ist leider bereits ausgebucht.';
$GLOBALS['TL_LANG']['MSC']['ser_full_reg'] = 'Sie sind bereits für dieses Event angemeldet.';

$GLOBALS['TL_LANG']['MSC']['ser_waitinglist'] = 'Das Event ist ausgebucht. Sie können sich aber auf die Warteliste setzen lassen. Sie werden informiert, wenn ein Platz frei wird und Ihre Anmeldung verbindlich wird.';
$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_reg'] = 'Sie sind bereits für dieses Event angemeldet.';

$GLOBALS['TL_LANG']['MSC']['ser_register_success'] = 'Sie haben sich erfolgreich für dieses Event angemeldet.<br />Sie erhalten nun eine Bestätigung per e-Mail.';
$GLOBALS['TL_LANG']['MSC']['ser_unregister_success'] = 'Wir haben die Stornierung Ihrer Anmeldung für dieses Event erhalten.<br />Sie erhalten nun eine Bestätigung per e-Mail.';

$GLOBALS['TL_LANG']['MSC']['ser_it_places'] = '<span class="ser_it_places">(%s von %s Plätzen verfügbar)</span>';
$GLOBALS['TL_LANG']['MSC']['ser_anonym_set'] = 'Es wurde(n) %s anonyme(r) User hinzugefügt';
$GLOBALS['TL_LANG']['MSC']['ser_anonym_max places'] = 'Sie können bis zu %s anonyme User anlegen.';
$GLOBALS['TL_LANG']['MSC']['ser_no_places'] = 'Für dieses Event sind keine weiteren Plätze verfügbar.';
$GLOBALS['TL_LANG']['MSC']['ser_to_much_places'] = 'Sie möchten zu viele User anlegen. Für dieses Event stehen nur noch %s freie Plätze zur Verfügung.';
$GLOBALS['TL_LANG']['MSC']['ser_regclosed'] = 'Die Anmeldefrist für dieses Event ist am %s abgelaufen.';

$GLOBALS['TL_LANG']['MSC']['quantity_label'] = "Wieviele Plätze möchten Sie reservieren?";

$GLOBALS['TL_LANG']['MSC']['ser_registration_label'] = 'Buchungen';
$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_label'] = 'Warteliste';
$GLOBALS['TL_LANG']['MSC']['ser_availability_label'] = 'Verfügbarkeit';
$GLOBALS['TL_LANG']['MSC']['ser_availability_label'] = array('Verfügbarkeit','Freie Plätze','Warteliste');
$GLOBALS['TL_LANG']['MSC']['ser_deadline_label'] =  array('Anmeldefrist','offen','geschlossen');

/* Label für den Insert-Tag {{serlabel::ID::[period/availability/user]}} */
$GLOBALS['TL_LANG']['MSC']['ser_label_period']['open'] = 'Anmeldefrist läuft';
$GLOBALS['TL_LANG']['MSC']['ser_label_period']['finished'] = 'Anmeldefrist abgelaufen';

$GLOBALS['TL_LANG']['MSC']['ser_label_availability']['free'] = '%s Plätze verfügbar';
$GLOBALS['TL_LANG']['MSC']['ser_label_availability']['waitinglist'] = 'Anmeldung auf Warteliste';

$GLOBALS['TL_LANG']['MSC']['ser_label_user']['booked'] = 'Sie sind bereits registriert';



/* E-Mail Anmeldebenachrichtigung Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_register_subject'] = 'Kursanmeldung für Kurs: ##event_title##';

$GLOBALS['TL_LANG']['MSC']['ser_notify_mail'] = '
<h2>Kursanmeldung</h2>
Für den ##event_title## (##event_date##) hat sich folgender User angemeldet.
<hr/>
Kursteilnehmer:<br />
<b>##user_firstname## ##user_lastname##</b><br />
Anzahl der gebuchten Plätze: ##ser_quantity##<br />
<b>Username: ##user_username##</b><br />
Adresse: {{user::street}}, {{user::postal}} {{user::city}}<br />
Klinik: {{user::Klinik}}<br />
Ordination: {{user::Ordination}}<br />
<br />
E-Mail: ##user_email##<br />
Telefon: {{user::phone}}<br />
<hr />
<h2>Kursdaten</h2>
Kurs: ##event_title##<br />
Kursdatum: ##event_date##<br />
Kurs-URL: ##event_url##<br />
Kursnummer: ##event_kursnummer##<br />
Gebühren: ##event_gebuehren##<br />
<hr />
In das Backend einloggen: http://www.craftandvalue.com/_clients/handkurse/contao/
';

/* E-Mail Anmeldebenachrichtigung (Warteliste) Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_subject'] = 'Wartelisteneintrag für Kurs: ##event_title##';

$GLOBALS['TL_LANG']['MSC']['ser_waitinglist_mail'] = '
<h2>Kursanmeldung (Warteliste)</h2>
Für den ##event_title## (##event_date##) hat sich folgender User angemeldet.
<hr/>
Kursteilnehmer:<br />
<b>##user_firstname## ##user_lastname##</b><br />
Anzahl der gebuchten Plätze: ##ser_quantity##<br />
<b>Username: ##user_username##</b><br />
Adresse: {{user::street}}, {{user::postal}} {{user::city}}<br />
Klinik: {{user::Klinik}}<br />
Ordination: {{user::Ordination}}<br />
<br />
E-Mail: ##user_email##<br />
Telefon: {{user::phone}}<br />
<hr />
<h2>Kursdaten</h2>
Kurs: ##event_title##<br />
Kursdatum: ##event_date##<br />
Kurs-URL: ##event_url##<br />
Kursnummer: ##event_kursnummer##<br />
Gebühren: ##event_gebuehren##<br />
<hr />
In das Backend einloggen: http://www.craftandvalue.com/_clients/handkurse/contao/
';

/* E-Mail Abmeldebenachrichtigung Administrator */
$GLOBALS['TL_LANG']['MSC']['ser_unregister_subject'] = 'Stornierung für Kurs: ##event_title##';
$GLOBALS['TL_LANG']['MSC']['ser_unregister_mail'] = '
<h2>Stornierung Handkurs</h2>
Für den ##event_title## (##event_date##) wurde ein Stornierung vorgenommen.
<hr/>
Kursteilnehmer:<br />
<b>##user_firstname## ##user_lastname##</b><br />
<b>Username: ##user_username##</b><br />
Adresse: {{user::street}}, {{user::postal}} {{user::city}}<br />
Klinik: {{user::Klinik}}<br />
Ordination: {{user::Ordination}}<br />
<br />
E-Mail: ##user_email##<br />
Telefon: {{user::phone}}<br />
<hr />
<h2>Kursdaten</h2>
Kurs: ##event_title##<br />
Kursdatum: ##event_date##<br />
Kurs-URL: ##event_url##<br />
Kursnummer: ##event_kursnummer##<br />
Gebühren: ##event_gebuehren##<br />
<hr />
In das Backend einloggen: http://www.craftandvalue.com/_clients/handkurse/contao/
';

$GLOBALS['TL_LANG']['MSC']['ser_showevents']['all']       = 'Alle Events anzeigen';
$GLOBALS['TL_LANG']['MSC']['ser_showevents']['future']    = 'Nur zukünftige Events anzeigen';
$GLOBALS['TL_LANG']['MSC']['ser_showevents']['past']      = 'Nur vergangene Events anzeigen';

$GLOBALS['TL_LANG']['MSC']['ser_emptylist'] = 'Für das Event "%s" gibt es noch keine Anmeldungen.';
$GLOBALS['TL_LANG']['MSC']['ser_listsummary'] = 'Auflistung aller Anmeldungen für das Event "%s".';

$GLOBALS['TL_LANG']['MSC']['ser_list_heads'] = array('no'=>'Nr.','firstname'=>'Vorname','lastname'=>'Nachname','email'=>'E-Mail');

?>