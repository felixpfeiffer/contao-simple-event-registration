<?php if (!defined('TL_ROOT')) die('You cannot access this file directly!');

/**
 * Contao Open Source CMS
 * Copyright (C) 2005-2012 Leo Feyer
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
 * @copyright  Leo Feyer 2005-2012
 * @author     Leo Feyer <http://www.contao.org>
 * @package    Calendar
 * @license    LGPL
 * @filesource
 */

/**
 * Palettes
 */
$GLOBALS['TL_DCA']['tl_calendar']['palettes']['default'] .= ';{ser_confirm_legend},ser_confirm_subject,ser_confirm_text,ser_confirm_html;{ser_wait_legend},ser_wait_subject,ser_wait_text,ser_wait_html;{ser_cancel_legend},ser_cancel_subject,ser_cancel_text,ser_cancel_html;';

/**
 * Fields
 */

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_confirm_subject']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_confirm_subject'],
    'exculde'   => true,
    'inputType' => 'text',
    'eval'      => array('decodeEntities'=>false,'tl_class'=>'long'),
    'sql'                     => "varchar(164) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_confirm_text']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_confirm_text'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('style'=>'height:140px;'),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_confirm_html']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_confirm_html'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('rte'=>'tinyMCE','tl_class'=>''),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_cancel_subject']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_cancel_subject'],
    'exculde'   => true,
    'inputType' => 'text',
    'eval'      => array('decodeEntities'=>false,'tl_class'=>'long'),
    'sql'                     => "varchar(164) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_cancel_text']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_cancel_text'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('style'=>'height:140px;'),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_cancel_html']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_cancel_html'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('rte'=>'tinyMCE','tl_class'=>''),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_wait_subject']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_wait_subject'],
    'exculde'   => true,
    'inputType' => 'text',
    'eval'      => array('decodeEntities'=>false,'tl_class'=>'long'),
    'sql'                     => "varchar(164) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_wait_text']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_wait_text'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('style'=>'height:140px;'),
    'sql'                     => "text NULL"
);

$GLOBALS['TL_DCA']['tl_calendar']['fields']['ser_wait_html']  = array(
    'label'     => &$GLOBALS['TL_LANG']['tl_calendar']['ser_wait_html'],
    'exculde'   => true,
    'inputType' => 'textarea',
    'eval'      => array('rte'=>'tinyMCE','tl_class'=>''),
    'sql'                     => "text NULL"
);