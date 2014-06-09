<?php

/**
 * TYPOlight webCMS
 *
 * The TYPOlight webCMS is an accessible web content management system that 
 * specializes in accessibility and generates W3C-compliant HTML code. It 
 * provides a wide range of functionality to develop professional websites 
 * including a built-in search engine, form generator, file and user manager, 
 * CSS engine, multi-language support and many more. For more information and 
 * additional TYPOlight applications like the TYPOlight MVC Framework please 
 * visit the project website http://www.typolight.org.
 *
 * PHP version 5
 * @copyright  2010 - 2014 Felix Pfeiffer : Neue Medien
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 * @filesource
 */
namespace FelixPfeiffer\SimpleEventRegitration;

/**
 * Class SimpleEventRegistration
 *
 * Front end module "ModuleSimpleEventRegistration".
 * @copyright  2010 - 2014 Felix Pfeiffer : Neue Medien
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 */
 
class SimpleEventRegistration extends Frontend {

    /**
     * Inserttag to show "(10 places left from 20)"
     * Example: {{ser::<?php echo $this->id ?>}} with $this->id the id of the event
     * @param $strTag
     * @return bool|string
     */
    public function showPlaces($strTag)
	{
		$elements = explode('::', $strTag);
		if($elements[0] != "ser" || !$elements[1]) return false;
		
		$objEvent = $this->Database->prepare("SELECT ser_register, ser_places FROM tl_calendar_events WHERE id=?")
									->execute($elements[1]);
		
		if($objEvent->ser_register != 1) return false;
		
		$objPlaces = $this->Database->prepare("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=? AND waitinglist=0")
									->execute($elements[1]);



		$intPlaces = sprintf($GLOBALS['TL_LANG']['MSC']['ser_it_places'],$objEvent->ser_places - $objPlaces->reg_places,$objEvent->ser_places);
		
		return $intPlaces;
		
	}

    /**
     * Enters a class that shows the state of the event, booked, free, waitinglist, open, finished
     * With:
     * booked = the user allready booked the event
     * free = the event can be booked
     * waitinglist = the event is fully booked, but you can enter the waitinglist
     * open = while the registration period
     * finished = the registration period has ended
     * Example: {{serclass::<?php echo $this->id; ?>}} with $this->id the id of the event
     * @param $strTag
     * @return bool|string
     */
    public function showClasses($strTag)
	{
		$elements = explode('::', $strTag);
		if($elements[0] != "serclass" || !$elements[1]) return false;
									
		$objEvent = $this->Database->prepare("SELECT ser_register, ser_places, ser_date FROM tl_calendar_events WHERE id=?")
									->execute($elements[1]);
		
		if($objEvent->ser_register != 1) return false;

        $arrClasses = array();

        if($objEvent->ser_date < time()) $arrClasses[] = 'finished';
        else $arrClasses[] = 'open';
		
		$objPlaces = $this->Database->prepare("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=? AND waitinglist!=1")
									->execute($elements[1]);
		

		
		if($objEvent->ser_places - $objPlaces->reg_places > 0) $arrClasses[] = 'free';
		else $arrClasses[] = 'waitinglist';
		
		if(FE_USER_LOGGEDIN)
		{
			// Get the front end user object
			$this->import('FrontendUser', 'User');
			
			$objUserPlaces = $this->Database->prepare("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=? AND userId=?")
									->execute($elements[1],$this->User->id);
			
			if($objUserPlaces->reg_places > 0) $arrClasses[] = 'booked';
		}
		
		return ' ' . implode(' ',$arrClasses);
		
	}


    /**
     * Enters a class that shows the state of the event, booked, free, waitinglist, open, finished
     * With:
     * booked = the user allready booked the event
     * free = the event can be booked
     * waitinglist = the event is fully booked, but you can enter the waitinglist
     * open = while the registration period
     * finished = the registration period has ended
     * Example: {{serclass::<?php echo $this->id; ?>}} with $this->id the id of the event
     * @param $strTag
     * @return bool|string
     */
    public function showLabel($strTag)
    {
        $elements = explode('::', $strTag);
        if($elements[0] != "serlabel" || (!$elements[1]) && !$elements[2]) return false;


        $objEvent = $this->Database->prepare("SELECT ser_register, ser_places, ser_date FROM tl_calendar_events WHERE id=?")
            ->execute($elements[1]);

        if($objEvent->ser_register != 1) return false;

        $blnClosed = $objEvent->ser_date < time() ? true : false;

        switch($elements[2])
        {
            /* Is the event still open to register? */
            case 'period':
                if($blnClosed)
                {
                    return $GLOBALS['TL_LANG']['MSC']['ser_label_period']['finished'];
                }
                else
                {
                    return $GLOBALS['TL_LANG']['MSC']['ser_label_period']['open'];
                }
                break;
            case 'availability':
                if($blnClosed) return '';
                $objPlaces = $this->Database->prepare("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=? AND waitinglist!=1")
                    ->execute($elements[1]);
                $intPlaces = $objEvent->ser_places - $objPlaces->reg_places;
                if( $intPlaces > 0)
                {
                    return sprintf($GLOBALS['TL_LANG']['MSC']['ser_label_availability']['free'],$intPlaces);
                }
                else
                {
                    return $GLOBALS['TL_LANG']['MSC']['ser_label_availability']['waitinglist'];
                }

                break;
            case 'user':
                if(FE_USER_LOGGEDIN)
                {
                    // Get the front end user object
                    $this->import('FrontendUser', 'User');

                    $objUserPlaces = $this->Database->prepare("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=? AND userId=?")
                        ->execute($elements[1],$this->User->id);

                    if($objUserPlaces->reg_places > 0)
                    {
                        return $GLOBALS['TL_LANG']['MSC']['ser_label_user']['booked'];
                    }
                }
                break;
            default:
                return '';
                break;
        }

    }



}