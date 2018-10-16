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
namespace FelixPfeiffer\SimpleEventRegistration;

/**
 * Class ModuleSimpleEventRegistration
 *
 * Front end module "ModuleSimpleEventRegistration".
 * @copyright  2010 - 2014 Felix Pfeiffer : Neue Medien
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 */
class ModuleSimpleEventRegistration extends \ModuleEventReader
{
	/**
	 * Variable zum Testen, ob die Anmeldung erwünscht ist oder nicht.
	 **/
	protected $blnParseRegistration = true;
	protected $blnShowList = true;
	
	/**
	 * Display a wildcard in the back end
	 * @return string
	 */
	public function generate()
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new \BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### SIMPLE EVENT REGISTRATION READER ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'typolight/main.php?do=modules&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}

		return parent::generate();
	}
	
	/**
	 * Generate module
	 */
	protected function compile()
	{
		parent::compile();

		if(FE_USER_LOGGED_IN)
        {

            // Get the current event
            $objEvent = \CalendarEventsModel::findPublishedByParentAndIdOrAlias(\Input::get('events'), $this->cal_calendar);

            if($objEvent === null) return false;

			// If current event isn't a registration event, don't go on
			if(!$objEvent->ser_register) {
				$this->blnParseRegistration = false;
			}
			
			// If registrations should not be shown
			if(!$objEvent->ser_show) {
				$this->blnShowList = false;
			}
			
			// Check, if the active user is in one of the usergroups
			$this->import('FrontendUser', 'User');
			$arrRegGroups = deserialize($objEvent->ser_groups);
			$arrShowGroups = deserialize($objEvent->ser_showgroups);
			if(is_array($arrRegGroups) && count(array_intersect($this->User->groups, $arrRegGroups)) < 1)
			{
				$this->blnParseRegistration = false;
			}
			
			if((is_array($arrShowGroups) && count(array_intersect($this->User->groups, $arrShowGroups)) < 1) || (!is_array($arrShowGroups) && is_array($arrRegGroups) && count(array_intersect($this->User->groups, $arrRegGroups)) < 1))
			{
				$this->blnShowList = false;
			}
			
			
			$arrMessage = array();
			
			// If everything is OK, show the form and perform the registration
			if($this->blnParseRegistration)
			{
				
				$this->Template->event .= $this->parseRegistration($objEvent);
				
			}
			
			// If everything is OK, show the list of all registered members
			if($this->blnShowList)
			{
				
				$this->Template->event .= $this->parseList($objEvent);
				
			}
		}
		
		
	}



	protected function parseList($objEvent)
	{
		
		$objTemplate = new \FrontendTemplate('simple_events_registration_list');
		$objTemplate->blnShowList = true;
		
		$objTemplate->listHeadline = $objEvent->ser_showheadline;
		$objTemplate->listid = 'simple_event_registration_list_table';
		$objTemplate->listsummary = sprintf($GLOBALS['TL_LANG']['MSC']['ser_listsummary'],html_entity_decode($objEvent->title));

		$objRegistrations = \FelixPfeiffer\SimpleEventRegistration\EventRegistrationsModel::findByPid($objEvent->id);

		if($objRegistrations === null)
		{
			$objTemplate->blnShowList = false;
			$objTemplate->listMessage = sprintf($GLOBALS['TL_LANG']['MSC']['ser_emptylist'],html_entity_decode($objEvent->title));
		}
		else
		{
			$arrRegistrations = array();
			$arrAnonym = array();
			$i = 0;
			while($objRegistrations->next())
			{
				$arrReg = array();
				
				if($objRegistrations->userId != 0)
				{

                    $objUser = \MemberModel::findByPk($objRegistrations->userId);
					
					if($objUser !== null)
					{
					
						$arrReg['firstname'] = $objUser->firstname;
						$arrReg['lastname'] = $objUser->lastname;
						$arrReg['email'] = $objUser->email;
						$arrReg['id'] = $objRegistrations->userId;
						
						$key = $arrReg['lastname'];
						$z=0;
						do
						{
							$key = $arrReg['lastname'] . ++$z;
						} while(array_key_exists($key,$arrRegistrations));

					}	
				}
				
				if($objRegistrations->anonym == 1 && $objRegistrations->lastname != '')
				{
					$arrReg['firstname'] = $objRegistrations->firstname;
					$arrReg['lastname'] = $objRegistrations->lastname;
					$arrReg['email'] = $objRegistrations->email;
					$arrReg['id'] = false;
					
					$key = $arrReg['lastname'];
					$z=0;
					do
					{
						$key = $arrReg['lastname'] . ++$z;
					} while(array_key_exists($key,$arrRegistrations));

				}
				
				if($objRegistrations->anonym == 1 && $objRegistrations->lastname == '')
				{
					$arrReg['firstname'] = false;
					$arrReg['lastname'] = 'Anonyme Anmeldung Nr.' . ++$i;
					$arrReg['email'] = false;
					$arrReg['id'] = false;
					
					$key = $arrReg['lastname'];
				}

                $subkey = $objRegistrations->waitinglist;

                $arrRegistrations[$subkey][$key] = $arrReg;
			
			}
            foreach($arrRegistrations as $k=>$v)
            {
                ksort($v);
                $arrRegistrations[$k] = $v;

            }
			ksort($arrRegistrations);
			$arrRegistrations[0] = array_merge($arrRegistrations[0],$arrAnonym);
            foreach($arrRegistrations as $k=>$v)
            {
                $j=0;
                $count = count($v);
                foreach($v as $kk => $vv)
                {
                    $class = ($k==1 ? 'wtlist ' : '').($j++==0 ? 'first ' : '') . ($j%2==0 ? 'even ' : 'odd ') . ($j == $count ? 'last' : '');
                    $arrRegistrations[$k][$kk]['class'] = $class;
                }
            }
			
			$objTemplate->head = $GLOBALS['TL_LANG']['MSC']['ser_list_heads'];
			$objTemplate->list = $arrRegistrations;
			
		}
	
		return $objTemplate->parse();
	}
	
	protected function parseRegistration($objEvent)
	{
	
		$objTemplate = new \FrontendTemplate('simple_events_registration_form');
		$objTemplate->blnShowForm = true;
		
		$isregistered = false;
		
		// Anmeldefrist Checken
		if($objEvent->ser_date < time())
		{
			$objTemplate->blnShowForm = false;
			$arrMess['message'] = sprintf($GLOBALS['TL_LANG']['MSC']['ser_regclosed'],\Date::parse($GLOBALS['TL_CONFIG']['dateFormat'],$objEvent->ser_date));
			$arrMess['message_class'] = " closed";
			$blnEnded = true;
			$arrMessage[] = $arrMess;
			
		}

		// Is the user allready registered?
		if($this->checkRegistration($this->User->id,$objEvent->id) && !$_SESSION['TL_SER_REGISTERED'])
        {
			$objTemplate->blnShowForm = false;
            $objTemplate->blnShowDiscardForm = ($objEvent->endTime <= time()) ? $objTemplate->blnShowDiscardForm = false : true; //check endtime
			$isregistered = true;
			$arrMess['message'] = $GLOBALS['TL_LANG']['MSC']['ser_regallready'];
			$arrMess['message_class'] = " allready";
			$arrMessage[] = $arrMess;
			
		}
		
		// Perform Registration
		if($this->Input->post('FORM_SUBMIT') == 'tl_simple_event_registration' && $this->Input->post('register'))
		{
			$this->registerUser($objEvent);
		}
		
		// Perform Un-Registration
		if($this->Input->post('FORM_SUBMIT') == 'tl_simple_event_cancelation' && $this->Input->post('unregister'))
		{
			$this->unregisterUser($objEvent);
		}
		
		// Are there still places left?
		$intPlaces = $this->checkPlaces($objEvent->id,$objEvent->ser_places);
		if(!$intPlaces && !$blnEnded && !$this->ser_waitinglist && !$isregistered)
		{
			$objTemplate->blnShowForm = false;
			$objTemplate->places = $isregistered ? $GLOBALS['TL_LANG']['MSC']['ser_full_reg'] : $GLOBALS['TL_LANG']['MSC']['ser_full'];
			$objTemplate->places_class = " full";
		}
        elseif(!$intPlaces && !$blnEnded && $this->ser_waitinglist && !$isregistered)
		{
			$objTemplate->blnShowForm = true;
			$objTemplate->places = $isregistered ? $GLOBALS['TL_LANG']['MSC']['ser_waitinglist_reg'] : $GLOBALS['TL_LANG']['MSC']['ser_waitinglist'];
            $objTemplate->quantity = $objEvent->ser_maxplaces > 0 ? $objEvent->ser_maxplaces : $objEvent->ser_places;
			$objTemplate->places_class = " waitinglist";
		}
		elseif($blnEnded)
		{
		}
		elseif(!$isregistered)
		{
			$objTemplate->places = sprintf($GLOBALS['TL_LANG']['MSC']['ser_av_places'],$intPlaces);
			$objTemplate->quantity = ($objEvent->ser_maxplaces > 0 && $intPlaces >= $objEvent->ser_maxplaces) ? $objEvent->ser_maxplaces : $intPlaces;
			$objTemplate->places_class = "";
		}
		
		$objTemplate->ser_quantity = $objEvent->ser_maxplaces > 0;
		$objTemplate->quantity_label = $GLOBALS['TL_LANG']['MSC']['quantity_label'];
		
		
		// Confirmation message
		if ($_SESSION['TL_SER_REGISTERED'])
		{
			global $objPage;

			// Do not index the page
			$objPage->noSearch = 1;
			$objPage->cache = 0;

			$objTemplate->blnShowForm = false;
			$arrMess['message'] = $GLOBALS['TL_LANG']['MSC']['ser_register_success'];
			$arrMess['message_class'] = " success";
			$arrMessage[] = $arrMess;
			$_SESSION['TL_SER_REGISTERED'] = false;
		}
		
		if ($_SESSION['TL_SER_UNREGISTERED'])
		{
			global $objPage;

			// Do not index the page
			$objPage->noSearch = 1;
			$objPage->cache = 0;

			$objTemplate->blnShowForm = false;
			$objTemplate->blnShowDiscardForm = false;
			$arrMess['message'] = $GLOBALS['TL_LANG']['MSC']['ser_unregister_success'];
			$arrMess['message_class'] = " success";
			$arrMessage[] = $arrMess;
			$_SESSION['TL_SER_UNREGISTERED'] = false;
		}
		
		
		// Build the form
		$objTemplate->checkbox_label = $GLOBALS['TL_LANG']['MSC']['ser_checkbox_label'];
		$objTemplate->submit = $GLOBALS['TL_LANG']['MSC']['ser_submit'];
		
		$objTemplate->unregister_checkbox_label = $GLOBALS['TL_LANG']['MSC']['ser_checkbox_label_unregister'];
		$objTemplate->unsubmit = $GLOBALS['TL_LANG']['MSC']['ser_unregister'];
		
		$objTemplate->message = $arrMessage;
		
		return $objTemplate->parse();
			
	}
	
	protected function checkPlaces($id, $intPlaces)
	{
		
		$objPlaces = \Database::getInstance()->execute("SELECT SUM(quantity) AS reg_places FROM tl_event_registrations WHERE pid=".$id);
			
		if($objPlaces->reg_places<$intPlaces) return $intPlaces - $objPlaces->reg_places;
		else return false;
		
	}
	
	protected function checkRegistration($userId, $intEventId)
	{
		
		$objPlaces = \Database::getInstance()->prepare("SELECT * FROM tl_event_registrations WHERE userId=? AND pid=?")->execute($userId, $intEventId);
					   
		if($objPlaces->numRows>0) return true;
		else return false;
		
	}

	protected function registerUser($objEvent)
	{

        // Are there still places left?
        $intPlaces = $this->checkPlaces($objEvent->id,$objEvent->ser_places);

		$arrSet = array(
			'pid'		    => $objEvent->id,
			'tstamp'	    => time(),
			'userId'	    => $this->User->id,
            'waitinglist'   => ($intPlaces ? 0 : 1)
		);

		$intQuantity = $this->Input->post('quantity_select') ? $this->Input->post('quantity_select') : 1;
		if($this->ser_quantity)
		{
			$arrSet['quantity'] = $intQuantity;
		}

        \Database::getInstance()->prepare("INSERT INTO tl_event_registrations %s")->set($arrSet)->execute();

        $strSql = $intPlaces ? "SELECT ser_confirm_subject AS subject, ser_confirm_text AS text, ser_confirm_html AS html FROM tl_calendar WHERE id=?" : "SELECT ser_wait_subject AS subject, ser_wait_text AS text, ser_wait_html AS html FROM tl_calendar WHERE id=?";

        $objMailText = \Database::getInstance()->prepare($strSql)->execute($objEvent->pid);

		// Send notification
		$objEmail = new \Email();
		$strFrom = $GLOBALS['TL_CONFIG']['adminEmail'];
		$strNotify = $objEvent->ser_email != "" ? $objEvent->ser_email : $GLOBALS['TL_CONFIG']['adminEmail'];
		
		$span = \Calendar::calculateSpan($objEvent->startTime, $objEvent->endTime);

		// Get date
		if ($span > 0)
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG'][($objEvent->addTime ? 'datimFormat' : 'dateFormat')], $objEvent->startTime) . ' - ' . \Date::parse($GLOBALS['TL_CONFIG'][($objEvent->addTime ? 'datimFormat' : 'dateFormat')], $objEvent->endTime);
		}
		elseif ($objEvent->startTime == $objEvent->endTime)
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG']['dateFormat'], $objEvent->startTime) . ($objEvent->addTime ? ' (' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->startTime) . ')' : '');
		}
		else
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG']['dateFormat'], $objEvent->startTime) . ($objEvent->addTime ? ' (' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->startTime) . ' - ' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->endTime) . ')' : '');
		}

        $notifyText = $intPlaces ? $GLOBALS['TL_LANG']['MSC']['ser_notify_mail'] : $GLOBALS['TL_LANG']['MSC']['ser_waitinglist_mail'];
        $notifySubject = $intPlaces ? $GLOBALS['TL_LANG']['MSC']['ser_register_subject'] : $GLOBALS['TL_LANG']['MSC']['ser_waitinglist_subject'];

		$messageText = $this->replaceInserts($objEvent,html_entity_decode($objMailText->text),$intQuantity);
		$messageHTML = $this->replaceInserts($objEvent,html_entity_decode($objMailText->html),$intQuantity);
		$notifyText = $this->replaceInserts($objEvent,$notifyText,$intQuantity);
		
		$objEmail->from = $strFrom;
		$objEmail->subject = $this->replaceInserts($objEvent,html_entity_decode($objMailText->subject),$intQuantity);

		$objEmail->text = $messageText;
		$objEmail->html = $messageHTML;
		$objEmail->sendTo($this->User->email);
		
		$objEmail->subject = $this->replaceInserts($objEvent,html_entity_decode($notifySubject),$intQuantity);
		$objEmail->text = $notifyText;
		$objEmail->html = nl2br($notifyText);
		$objEmail->sendTo($strNotify);
		
		$_SESSION['TL_SER_REGISTERED'] = true;
		$this->reload();
		
	}
	
	protected function unregisterUser($objEvent)
	{
		
		\Database::getInstance()->prepare("DELETE FROM tl_event_registrations WHERE pid=? AND userId=?")->execute($objEvent->id,$this->User->id);

        $objMailerText = \Database::getInstance()->prepare("SELECT ser_cancel_subject AS subject, ser_cancel_text AS text, ser_cancel_html AS html FROM tl_calendar WHERE id=?")->execute($objEvent->pid);

		// Send notification
		$objEmail = new \Email();
		$strFrom = $GLOBALS['TL_CONFIG']['adminEmail'];
		$strNotify = $objEvent->ser_email != "" ? $objEvent->ser_email : $GLOBALS['TL_CONFIG']['adminEmail'];
		
		$span = \Calendar::calculateSpan($objEvent->startTime, $objEvent->endTime);

		// Get date
		if ($span > 0)
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG'][($objEvent->addTime ? 'datimFormat' : 'dateFormat')], $objEvent->startTime) . ' - ' . \Date::parse($GLOBALS['TL_CONFIG'][($objEvent->addTime ? 'datimFormat' : 'dateFormat')], $objEvent->endTime);
		}
		elseif ($objEvent->startTime == $objEvent->endTime)
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG']['dateFormat'], $objEvent->startTime) . ($objEvent->addTime ? ' (' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->startTime) . ')' : '');
		}
		else
		{
			$objEvent->date = \Date::parse($GLOBALS['TL_CONFIG']['dateFormat'], $objEvent->startTime) . ($objEvent->addTime ? ' (' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->startTime) . ' - ' . \Date::parse($GLOBALS['TL_CONFIG']['timeFormat'], $objEvent->endTime) . ')' : '');
		}

		$notifyText = $this->replaceInserts($objEvent,$GLOBALS['TL_LANG']['MSC']['ser_unregister_mail']);
		$notifySubject = $GLOBALS['TL_LANG']['MSC']['ser_unregister_subject'];

        $messageText = $this->replaceInserts($objEvent,html_entity_decode($objMailerText->text));
        $messageHTML = $this->replaceInserts($objEvent,html_entity_decode($objMailerText->html));
		
		$objEmail->from = $strFrom;
		$objEmail->subject = $this->replaceInserts($objEvent,html_entity_decode($objMailerText->subject));

		$objEmail->text = $messageText;
		$objEmail->html = $messageHTML;
		$objEmail->sendTo($this->User->email);
		
		$objEmail->subject = $this->replaceInserts($objEvent,html_entity_decode($notifySubject));
		$objEmail->text = $notifyText;
		$objEmail->html = nl2br($notifyText);
		$objEmail->sendTo($strNotify);
		
		$_SESSION['TL_SER_UNREGISTERED'] = true;
		$this->reload();
		
	}
	
	protected function replaceInserts($objEvent,$text='',$intQuantity=false)
	{
		global $objPage;
		
		$this->import('StringUtil');

        $strUrl = $this->generateFrontendUrl(array('id'=>$objPage->id,'alias'=>$objPage->alias), '/events/%s');
        $objEvent->url = $this->generateEventUrl($objEvent, $strUrl);

        $arrUser = $this->User->getData();

        $arrEvent = $objEvent->row();

        $arrData = array();

        foreach($arrUser as $k=>$v)
        {
            $key = 'user_'.$k;
            $arrData[$key] = $v;
        }

        foreach($arrEvent as $k=>$v)
        {
            $key = 'event_'.$k;
            $arrData[$key] = $this->StringUtil->decodeEntities($v);
        }

        if($intQuantity)
        {
            $arrData['ser_quantity'] = $intQuantity;
        }

        $text = \StringUtil::parseSimpleTokens($text, $arrData);

        $text = $this->replaceInsertTags($text);

		return $text;
	}
	
}
