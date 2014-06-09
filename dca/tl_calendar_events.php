<?php if (!defined('TL_ROOT')) die('You can not access this file directly!');

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide rec_interval of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 *
 * This is the data container array that extends the table tl_calendar_events.
 *
 * PHP version 5
 * @copyright  Thyon Design 2005
 * @author     John Brand <john.brand@thyon.com>
 * @package    EventsAttend
 * @license    GPL 
 * @filesource
 */

$GLOBALS['TL_DCA']['tl_calendar_events']['config']['ctable'][] = 'tl_event_registrations';

$GLOBALS['TL_DCA']['tl_calendar_events']['list']['sorting']['child_record_callback'] = array('tl_simple_event_registration', 'listEvents');

/*
 Link auf Liste setzen
*/
$GLOBALS['TL_DCA']['tl_calendar_events']['list']['operations']['registrations'] = array(
	'label'               => &$GLOBALS['TL_LANG']['tl_calendar_events']['registrations'],
	'href'                => 'table=tl_event_registrations',
	'icon'                => 'system/modules/simple_event_registration/assets/reg_user_list.png',
    'button_callback'     => array('tl_simple_event_registration', 'groupButton')
);

$GLOBALS['TL_DCA']['tl_calendar_events']['list']['operations']['serrecurring'] = array(
	'label'               => &$GLOBALS['TL_LANG']['tl_calendar_events']['serrecurring'],
	'href'                => 'key=splitRecurring',
	'icon'                => 'system/modules/simple_event_registration/assets/split_recurring.png',
    'button_callback'     => array('tl_simple_event_registration', 'splitRecurringButton')
);
 
/* 
  * Palette
  */
$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['__selector__'][] = 'ser_register';
$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['__selector__'][] = 'ser_show';


$GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default'] = $GLOBALS['TL_DCA']['tl_calendar_events']['palettes']['default']. ';{legend_ser_register},ser_register;{ser_list_legend:hide},ser_show';

array_insert($GLOBALS['TL_DCA']['tl_calendar_events']['subpalettes'], 2, array
	(
			'ser_register'		=> 'ser_places,ser_maxplaces,ser_date,ser_email,ser_groups',
			'ser_show'			=> 'ser_showheadline,ser_showgroups'
	)
);


/* 
  * Felder
  */
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_register'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_register'],
	'exclude'                 => true,
	'default'                 => '0',
	'inputType'               => 'checkbox',
	'filter'                  => true,
	'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);
			
$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_places'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_places'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => 10,
	'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_maxplaces'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_maxplaces'],
	'exclude'                 => true,
	'inputType'               => 'text',
	'default'				  => 10,
	'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_email'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_email'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'friendly', 'maxlength'=>255,'tl_class'=>'clr'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_date'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_date'],
	'exclude'                 => true,
	'default'                 => (time() + 604800),
	'inputType'               => 'text',
	'eval'                    => array('rgxp'=>'datim', 'datepicker'=>$this->getDatePickerString(), 'tl_class'=>'w50 wizard'),
    'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_groups'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_groups'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_simple_event_registration','getGroups'),
	/*'foreignKey'              => 'tl_member_group.name',*/
	'eval'                    => array('multiple'=>true),
    'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_show'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_show'],
	'exclude'                 => true,
	'default'                 => '0',
	'inputType'               => 'checkbox',
	'filter'                  => true,
	'eval'                    => array('submitOnChange'=>true),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_showheadline'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_showheadline'],
	'exclude'                 => true,
	'search'                  => true,
	'inputType'               => 'text',
	'eval'                    => array('maxlength'=>255,'tl_class'=>'clr'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_calendar_events']['fields']['ser_showgroups'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_calendar_events']['ser_showgroups'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options_callback'        => array('tl_simple_event_registration','getGroups'),
	/*'foreignKey'              => 'tl_member_group.name',*/
	'eval'                    => array('multiple'=>true,'tl_class'=>''),
    'sql'                     => "blob NULL"
);

/**
 * Class tl_eventsattend
 *
 * Provide miscellaneous methods that are used by the data configuration array.
 * @copyright  Thyon Design 2005
 * @author     John Brand <john.brand@thyon.com>
 * @package    EventsAttend
 */

class tl_simple_event_registration extends tl_calendar_events
{

	public function groupButton($row, $href, $label, $title, $icon, $attributes)
	{
		if ($row['ser_register'] == 1) {
			// send to tl_form_auto editing => set formId as the id to edit 
			return '<a href="'.$this->addToUrl($href.'&id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		} else {
			return $this->generateImage('system/modules/simple_event_registration/assets/reg_user_list_inaktiv.png', $label);
		}
	}
	
	public function splitRecurringButton($row, $href, $label, $title, $icon, $attributes)
	{
		if ($row['recurring'] == 1) {
			return '<a href="'.$this->addToUrl($href.'&id='.$row['id']).'" title="'.specialchars($title).'"'.$attributes.'>'.$this->generateImage($icon, $label).'</a> ';
		} else {
			return '';
		}
	} 
	
	public function getGroups($objEvent)
	{
		$groups = false;
		
		$objCalendarGroups = $this->Database->prepare("SELECT groups FROM tl_calendar WHERE id=(SELECT pid FROM tl_calendar_events WHERE id=?)")
									->execute($objEvent->id);
		if($objCalendarGroups->groups)
		{
			$groups = unserialize($objCalendarGroups->groups);	
		}
		
		$objGroups = $this->Database->execute("SELECT * FROM tl_member_group" . ( $groups ? " WHERE id IN(" . implode(',', $groups) . ")" : "" ));
		
		$return = array();
		
		while($objGroups->next())
		{
			$return[$objGroups->id] = $objGroups->name;
		}
		
		return $return;
		
	}
	
	/**
	 * Split Events that are listet as recurring to seperate Events
	 * @param object
	 * @return string
	 */
	public function splitRecurring(DataContainer $dc)
	{
	
		$objEvent = $this->Database->prepare("SELECT * FROM tl_calendar_events WHERE id=?")->execute($dc->id);
		$arrEvent = $objEvent->fetchAssoc();
		
		$intRecurrences = $arrEvent['recurrences'];
		
		$startTime = $arrEvent['startTime'];
		$endTime = $arrEvent['endTime'];
		$startDate = $arrEvent['startDate'];
		$endDate = $arrEvent['endDate'];
		$ser_date = $arrEvent['ser_date'];
		
		$arrRange = deserialize($arrEvent['repeatEach']);
		$unit = $arrRange['unit'];
		
		unset($arrEvent['id']);
		unset($arrEvent['recurring']);
		unset($arrEvent['repeatEach']);
		unset($arrEvent['repeatEnd']);
		unset($arrEvent['recurrences']);
		unset($arrEvent['alias']);
		$arrEvent['tstamp'] = time();
		
		for($i=1;$i<$intRecurrences;$i++)
		{
			$arg = $arrRange['value'] * $i;
			$strtotime = '+ ' . $arg . ' ' . $unit;
			$arrEvent['startTime'] = strtotime($strtotime, $startTime);
			$arrEvent['endTime'] = strtotime($strtotime, $endTime);
			$arrEvent['startDate'] = strtotime($strtotime, $startDate);
			$arrEvent['endDate'] = $endDate != 0 ? strtotime($strtotime, $endDate) : '';
			$arrEvent['ser_date'] = $ser_date != 0 ? strtotime($strtotime, $ser_date) : '';
			
			$objInsert = $this->Database->prepare("INSERT INTO tl_calendar_events %s")->set($arrEvent)->execute();
			$newId=$objInsert->insertId;
			
			$strAlias = $this->generateNewAlias('',$newId,$arrEvent['title']);
			
			$this->Database->prepare("UPDATE tl_calendar_events SET alias=? WHERE id=?")->execute($strAlias,$newId);
		}
		
		$this->Database->prepare("UPDATE tl_calendar_events %s WHERE id=?")->set(array('recurring'=>'','repeatEach'=>'','repeatEnd'=>'','recurrences'=>''))->execute($dc->id);
		
		$strRedirectUrl = "contao/main.php?do=calendar&table=tl_calendar_events&id=" . $arrEvent['pid'];
		$this->redirect($strRedirectUrl);
	
	}
	
	/**
	 * Autogenerate a event alias if it has not been set yet
	 * @param mixed
	 * @param object
	 * @return string
	 */
	public function generateNewAlias($varValue,$id,$title)
	{
		$autoAlias = false;

		// Generate alias if there is none
		if (!strlen($varValue))
		{
			$autoAlias = true;
			$varValue = standardize($title);
		}

		$objAlias = $this->Database->prepare("SELECT id FROM tl_calendar_events WHERE alias=?")
								   ->execute($varValue);

		// Check whether the alias exists
		if ($objAlias->numRows > 1 && !$autoAlias)
		{
			throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
		}

		// Add ID to alias
		if ($objAlias->numRows && $autoAlias)
		{
			$varValue .= '-' . $id;
		}

		return $varValue;
	}

    public function listEvents($arrRow)
    {
        $strReturn = parent::listEvents($arrRow);

        if(!$arrRow['ser_register']) return $strReturn;

        $this->loadLanguageFile('tl_calendar_events');
        $this->loadLanguageFile('tl_calendar_events');

        $objTemplate = new BackendTemplate('be_ser_overview');

        $objTemplate->ser_places_label = $GLOBALS['TL_LANG']['tl_calendar_events']['ser_places'][0];
        $objTemplate->ser_registration_label = $GLOBALS['TL_LANG']['MSC']['ser_registration_label'];
        $objTemplate->ser_waitinglist_label = $GLOBALS['TL_LANG']['MSC']['ser_waitinglist_label'];
        $objTemplate->ser_availability_label = $GLOBALS['TL_LANG']['MSC']['ser_availability_label'][0];
        $objTemplate->ser_deadline_label = $GLOBALS['TL_LANG']['MSC']['ser_deadline_label'][0];


        $objRegistrations = $this->Database->prepare("SELECT SUM(quantity) AS count FROM tl_event_registrations WHERE pid=?")->execute($arrRow['id']);

        $objTemplate->ser_places = $arrRow['ser_places'];
        $objTemplate->ser_registrations = 0;
        $objTemplate->ser_waitinglist = 0;
        $objTemplate->ser_availability = $GLOBALS['TL_LANG']['MSC']['ser_availability_label'][1];
        $objTemplate->ser_availability_class = 'sig_green';

        $objTemplate->ser_closed = $arrRow['ser_date'] > time() ? $GLOBALS['TL_LANG']['MSC']['ser_deadline_label'][1] : $GLOBALS['TL_LANG']['MSC']['ser_deadline_label'][2];
        $objTemplate->ser_closed_class = $arrRow['ser_date'] > time() ? 'sig_green' : 'sig_red';

        if($objRegistrations->numRows > 0)
        {
            if($objRegistrations->count < $arrRow['ser_places'])
            {
                $objTemplate->ser_registrations = $objRegistrations->count;
            }
            else if($objRegistrations->count >= $arrRow['ser_places'])
            {
                $objTemplate->ser_registrations = $arrRow['ser_places'];
                $objTemplate->ser_waitinglist = $objRegistrations->count - $arrRow['ser_places'];

                $objTemplate->ser_availability = $GLOBALS['TL_LANG']['MSC']['ser_availability_label'][2];
                $objTemplate->ser_availability_class = 'sig_yello';
            }
        }

        $objTemplate->ser_places = $arrRow['ser_places'];

        $strReturn = str_replace(array(' h52'),'',$strReturn);

        $strReturn .= $objTemplate->parse();



        return $strReturn;
    }

}

?>