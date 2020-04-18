<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2010 Leo Feyer
 *
 * Formerly known as TYPOlight Open Source CMS.
 *
 * This program is free software: you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation, either
 * version 3 of the License, or (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * Lesser General Public License for more details.
 * 
 * You should have received a copy of the GNU Lesser General Public
 * License along with this program. If not, please visit the Free
 * Software Foundation website at <http://www.gnu.org/licenses/>.
 *
 * PHP version 5
 * @copyright  Felix Pfeiffer  : Neue Medien2010
 * @author     Felix Pfeiffer <info@felixpfeiffer.com>
 * @package    simple_event_registration
 * @license    LGPL
 * @filesource
 */


/**
 * Table tl_module
 */
 
/**
 * Add palettes to tl_module
 */
$GLOBALS['TL_DCA']['tl_module']['palettes']['serattendance']    = '{title_legend},name,headline,type;{config_legend},cal_calendar,ser_showevents,perPage;{redirect_legend},jumpTo;{template_legend:hide},cal_template;{protected_legend:hide},protected;{expert_legend:hide},guests,cssID,space';

$GLOBALS['TL_DCA']['tl_module']['palettes']['eventreader'] = str_replace('cal_calendar','cal_calendar,ser_quantity,ser_waitinglist',$GLOBALS['TL_DCA']['tl_module']['palettes']['eventreader']);

/**
 Add fileds to tl_module
**/
$GLOBALS['TL_DCA']['tl_module']['fields']['ser_showevents'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['ser_showevents'],
	'exclude'                 => true,
	'inputType'               => 'select',
	'options'        		  => array('all','future','past'),
	'reference'				  => &$GLOBALS['TL_LANG']['tl_module']['ser_showevents_label'],
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ser_quantity'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['ser_quantity'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
    'sql'                     => "char(1) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['ser_waitinglist'] = array(
	'label'                   => &$GLOBALS['TL_LANG']['tl_module']['ser_waitinglist'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
    'eval'                    => array('doNotCopy'=>true),
    'sql'                     => "char(1) NOT NULL default '0'"
);



?>