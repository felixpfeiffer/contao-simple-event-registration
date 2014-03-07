-- **********************************************************
-- *                                                        *
-- * IMPORTANT NOTE                                         *
-- *                                                        *
-- * Do not import this file manually but use the TYPOlight *
-- * install tool to create and maintain database tables!   *
-- *                                                        *
-- **********************************************************


-- --------------------------------------------------------

-- 
-- Table `tl_event_registrations`
-- 

CREATE TABLE `tl_event_registrations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pid` int(10) unsigned NOT NULL default '0',
  `sorting` int(10) unsigned NOT NULL default '0',
  `tstamp` int(10) unsigned NOT NULL default '0',
  `userId` int(10) unsigned NOT NULL default '0',
  `anonym` char(1) NOT NULL default '0',
  `firstname` varchar(255) NOT NULL default '',
  `lastname` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  `quantity` int(4) unsigned NOT NULL default '1',
  `waitinglist` char(1) NOT NULL default '0',
  PRIMARY KEY  (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table `tl_calendar`
--

CREATE TABLE `tl_calendar` (
  `ser_confirm_subject` varchar(164) NOT NULL default '',
  `ser_confirm_text` text NULL,
  `ser_confirm_html` text NULL,
  `ser_cancel_subject` varchar(164) NOT NULL default '',
  `ser_cancel_text` text NULL,
  `ser_cancel_html` text NULL,
  `ser_wait_subject` varchar(164) NOT NULL default '',
  `ser_wait_text` text NULL,
  `ser_wait_html` text NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_calendar_events`
-- 

CREATE TABLE `tl_calendar_events` (
  `ser_register` char(1) NOT NULL default '0',
  `ser_places` int(10) unsigned NOT NULL default '0',
  `ser_maxplaces` int(10) unsigned NOT NULL default '0',
  `ser_date` int(10) unsigned NOT NULL default '0',
  `ser_email` varchar(255) NOT NULL default '',
  `ser_groups` blob NULL,
  `ser_show` char(1) NOT NULL default '0',
  `ser_showheadline` varchar(255) NOT NULL default '',
  `ser_showgroups` blob NULL,
) ENGINE=MyISAM DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

-- 
-- Table `tl_module`
-- 

CREATE TABLE `tl_module` (
  `ser_showevents` varchar(255) NOT NULL default '',
  `ser_quantity` char(1) NOT NULL default '0',
  `ser_waitinglist` char(1) NOT NULL default '0',
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
