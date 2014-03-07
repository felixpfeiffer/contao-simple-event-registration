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
 * @copyright  2010 Felix Pfeiffer : Neue Medien 
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 * @filesource
 */
namespace FelixPfeiffer\SimpleEventRegitration;

/**
 * Class ModuleSimpleEventAttendance
 *
 * Front end module "ModuleSimpleEventAttendance".
 * @copyright  2010 Felix Pfeiffer : Neue Medien 
 * @author     Felix Pfeiffer 
 * @package    simple_event_registration 
 */
class ModuleSimpleEventAttendance extends Events
{

	/**
	 * Template
	 * @var string
	 */
	protected $strTemplate = 'mod_simple_event_attendance';
	
	/**
	 * Get future Events
	 * @var string
	 */
	protected $blnFuture = false;
	
	/**
	 * Get recent events
	 * @var string
	 */
	protected $blnPast = false;


	/**
	 * Generate
	 * @param boolean
	 * @return string
	 */
	public function generate($blnNoMarkup=false)
	{
		if (TL_MODE == 'BE')
		{
			$objTemplate = new BackendTemplate('be_wildcard');

			$objTemplate->wildcard = '### SIMPLE EVENT ATTENDANCE ###';
			$objTemplate->title = $this->headline;
			$objTemplate->id = $this->id;
			$objTemplate->link = $this->name;
			$objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

			return $objTemplate->parse();
		}
		
		// Return if there is no logged in user
		if(!FE_USER_LOGGED_IN)
		{
			return '';
		}
		
		$this->cal_calendar = $this->sortOutProtected(deserialize($this->cal_calendar, true));

		// Return if there are no calendars
		if (!is_array($this->cal_calendar) || count($this->cal_calendar) < 1)
		{
			return '';
		}
		
		// Find the range of Events that should be found
		if($this->ser_showevents == 'all')
		{
			if($this->Input->get('s')=='future') $this->blnFuture = true;
			if($this->Input->get('s')=='past') $this->blnPast = true;
			
		}
		
		return parent::generate();
	}


	/**
	 * Compile module
	 */
	protected function compile()
	{
		$this->import('String');
		$this->import('Date');
		
		$this->strUrl = '';
		
		if($this->jumpTo != '')
		{
			// Get "jumpTo" page
			$objPage = $this->Database->prepare("SELECT id, alias FROM tl_page WHERE id=?")
									  ->limit(1)
									  ->execute($this->jumpTo);

			if ($objPage->numRows)
			{
				$this->strUrl = $this->generateFrontendUrl($objPage->row(), '/events/%s');
			}
		}

		$strStmt = "SELECT e.*, c.jumpTo AS calJumpTo, c.id AS calId FROM tl_event_registrations r, tl_calendar_events e, tl_calendar c WHERE r.userId=? AND e.id=r.pid AND c.id=e.pid";
		
		if($this->ser_showevents == 'future' || $this->blnFuture)
		{
			$strStmt .= " AND e.startTime>" . $this->Date->dayBegin;;
		}
		else if($this->ser_showevents == 'past' || $this->blnPast)
		{
			$strStmt .= " AND e.endTime<" . $this->Date->dayEnd;;
		}
		
		$objAttendance = $this->Database->prepare($strStmt)
										->execute($this->User->id);
		
		
		
		if($objAttendance->numRows<1)
		{
			$strEvents = "\n" . '<div class="empty">' . $GLOBALS['TL_LANG']['MSC']['cal_empty'] . '</div>' . "\n";
		}
		else
		{
			
			while($objAttendance->next())
			{
				$strUrl = $this->strUrl;
				
				if($objAttendance->calJumpTo != '')
				{
					// Get "jumpTo" page
					$objPage = $this->Database->prepare("SELECT id, alias FROM tl_page WHERE id=?")
											  ->limit(1)
											  ->execute($objAttendance->calJumpTo);

					if ($objPage->numRows)
					{
						$strUrl = $this->generateFrontendUrl($objPage->row(), '/events/%s');
					}
				}
				
				$this->addEvent($objAttendance, $objAttendance->startTime, $objAttendance->endTime, $strUrl, $objAttendance->startTime, $objAttendance->endTime, $objAttendance->calId);
				
			}
			
			// Sort data
			ksort($this->arrEvents);
			foreach (array_keys($this->arrEvents) as $key)
			{
				ksort($this->arrEvents[$key]);
			}
			
			$arrEvents = array();
			$arrEventIds = array();
			// Remove events outside the scope
			foreach ($this->arrEvents as $key=>$days)
			{

				foreach ($days as $day=>$events)
				{
					foreach ($events as $event)
					{
						if(in_array($event['id'],$arrEventIds)) continue;
						$event['firstDay'] = $GLOBALS['TL_LANG']['DAYS'][date('w', $day)];
						$event['firstDate'] = $this->parseDate($GLOBALS['TL_CONFIG']['dateFormat'], $day);
						$arrEventIds[] = $event['id'];
						$arrEvents[] = $event;
					}
				}
			}
			
			$total = count($arrEvents);
			$limit = $total;
			$offset = 0;

			// Pagination
			if ($this->perPage > 0)
			{
				$page = $this->Input->get('page') ? $this->Input->get('page') : 1;
				$offset = ($page - 1) * $this->perPage;
				$limit = min($this->perPage + $offset, $total);

				$objPagination = new Pagination($total, $this->perPage);
				$this->Template->pagination = $objPagination->generate("\n  ");
			}
			
			$count  = count($arrEvents);
			
			// Parse events
			for ($i=$offset; $i<$limit; $i++)
			{
				
				$event = $arrEvents[$i];
				
				$objTemplate = new FrontendTemplate($this->cal_template);
				$objTemplate->setData($event);

				// Add template variables
				$objTemplate->link = $event['href'];
				$objTemplate->classUpcoming = $objTemplate->classList = $event['class'] . ((($i % 2) == 0) ? ' even' : ' last') . (($i == $offset) ? ' first' : '') . ($i==$limit-1 ? ' last' : '') . ' cal_' . $event['parent'];
				
				$objTemplate->readMore = specialchars(sprintf($GLOBALS['TL_LANG']['MSC']['readMore'], $event['title']));
				$objTemplate->more = $GLOBALS['TL_LANG']['MSC']['more'];

				// Short view
				if ($this->cal_noSpan)
				{
					$objTemplate->day = $event['day'];
					$objTemplate->date = $event['date'];
					$objTemplate->span = (!strlen($event['time']) && !strlen($event['day'])) ? $event['date'] : '';
				}
				else
				{
					$objTemplate->day = $event['firstDay'];
					$objTemplate->date = $event['firstDate'];
					$objTemplate->span = '';
				}

				$objTemplate->addImage = false;

				// Add image
				if ($event['addImage'] && is_file(TL_ROOT . '/' . $event['singleSRC']))
				{
					if ($imgSize)
					{
						$event['size'] = $imgSize;
					}

					$this->addImageToTemplate($objTemplate, $event);
				}

				$objTemplate->enclosure = array();

				// Add enclosure
				if ($event['addEnclosure'])
				{
					$this->addEnclosuresToTemplate($objTemplate, $event);
				}
				
				$strEvents .= $objTemplate->parse();
			}
					
		}
		
		$this->Template->events = $strEvents;
		
		// Find the range of Events that should be found
		if($this->ser_showevents == 'all')
		{
		
			$strUrl = preg_replace('/\?.*$/', '', $this->Environment->request);
			
			$this->Template->select = true;
			
			$this->Template->future = array(
				'href' => ampersand($strUrl) . '?s=future',
				'title' => $GLOBALS['TL_LANG']['MSC']['ser_showevents']['future']
			);
			
			$this->Template->past = array(
				'href' => ampersand($strUrl) . '?s=past',
				'title' => $GLOBALS['TL_LANG']['MSC']['ser_showevents']['past']
			);

			$this->Template->all = array(
				'href' => ampersand($strUrl),
				'title' => $GLOBALS['TL_LANG']['MSC']['ser_showevents']['all']
			);

		
		}
		
	}

}

?>