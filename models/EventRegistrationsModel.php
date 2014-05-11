<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2013 Leo Feyer
 *
 * @package Faq
 * @link    https://contao.org
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */


/**
 * Run in a custom namespace, so the class can be replaced
 */
namespace FelixPfeiffer\SimpleEventRegistration;


/**
 * Reads and writes FAQs
 *
 * @package   Models
 * @author    Leo Feyer <https://github.com/leofeyer>
 * @copyright Leo Feyer 2005-2013
 */
class EventRegistrationsModel extends \Model
{

	/**
	 * Table name
	 * @var string
	 */
	protected static $strTable = 'tl_event_registrations';


    /**
     * Find all registrations for one event
     *
     * @param integer $intId    The events ID
     * @param array $arrOptions An optional options array
     *
     * @return \Model\Collection|null A collection of models or null if there are no FAQs
     */
    public static function findByPid($intPid=false, array $arrOptions=array())
    {
        if (!$intPid)
        {
            return null;
        }

        $t = static::$strTable;
        $arrColumns = array("$t.pid=?");

        if (!isset($arrOptions['order']))
        {
            $arrOptions['order'] = "$t.tstamp DESC";
        }

        return static::findBy($arrColumns, array($intPid), $arrOptions);
    }

}
