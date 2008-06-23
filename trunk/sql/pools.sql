-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 23. Juni 2008 um 15:23
-- Server Version: 5.0.51
-- PHP-Version: 5.2.5-3+lenny1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Datenbank: `pools`
-- 

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_adressbook`
-- 

CREATE TABLE `pools_adressbook` (
  `id` int(12) unsigned NOT NULL auto_increment,
  `sender_id` int(8) unsigned NOT NULL,
  `recipient_id` int(8) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_attributes`
-- 

CREATE TABLE `pools_attributes` (
  `id` int(6) unsigned NOT NULL auto_increment,
  `category_id` int(5) unsigned default NULL,
  `name` varchar(50) default NULL,
  `type` varchar(50) default NULL,
  `amount` int(1) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_attributes_select`
-- 

CREATE TABLE `pools_attributes_select` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `res_id` int(8) unsigned default NULL,
  `attribute_id` int(5) unsigned default NULL,
  `value` int(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=320 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_attributes_select_keys`
-- 

CREATE TABLE `pools_attributes_select_keys` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `attribute_id` int(8) unsigned default NULL,
  `key` int(5) unsigned default NULL,
  `value` varchar(100) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=175 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_attributes_string`
-- 

CREATE TABLE `pools_attributes_string` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `res_id` int(7) unsigned default NULL,
  `attribute_id` int(5) unsigned default NULL,
  `value` varchar(250) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5261 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_categories`
-- 

CREATE TABLE `pools_categories` (
  `id` int(4) unsigned NOT NULL default '0',
  `parent` int(4) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_collectives_time`
-- 

CREATE TABLE `pools_collectives_time` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `res_id` int(8) unsigned NOT NULL default '0',
  `user_id` int(6) unsigned NOT NULL default '0',
  `from` int(20) unsigned NOT NULL default '0',
  `until` int(20) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_forum_entries`
-- 

CREATE TABLE `pools_forum_entries` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `thread_id` int(10) unsigned NOT NULL default '0',
  `user_id` int(10) unsigned NOT NULL default '0',
  `text` mediumtext,
  `date` int(16) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_forum_threads`
-- 

CREATE TABLE `pools_forum_threads` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `pool_id` int(6) unsigned default NULL,
  `title` varchar(250) default NULL,
  `act_date` int(16) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_news`
-- 

CREATE TABLE `pools_news` (
  `id` int(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) default NULL,
  `abstract` mediumtext,
  `text` mediumtext,
  `date` int(16) unsigned default NULL,
  `lang` varchar(5) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pm`
-- 

CREATE TABLE `pools_pm` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `sender_id` int(8) unsigned NOT NULL,
  `recipient_id` int(8) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `body` mediumtext NOT NULL,
  `is_read` int(1) unsigned NOT NULL,
  `is_in_draft` int(1) unsigned NOT NULL,
  `date` int(16) unsigned NOT NULL,
  `recipient_delete` int(1) unsigned NOT NULL,
  `sender_delete` int(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools`
-- 

CREATE TABLE `pools_pools` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `description` mediumtext,
  `country` varchar(5) default NULL,
  `area` varchar(50) default NULL,
  `wait` int(1) default NULL,
  `plz` varchar(5) default NULL,
  `city` varchar(100) default NULL,
  `is_public` int(1) unsigned default NULL,
  `is_located` int(1) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools_admin`
-- 

CREATE TABLE `pools_pools_admin` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `pool_id` int(4) unsigned default NULL,
  `user_id` int(6) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools_resources`
-- 

CREATE TABLE `pools_pools_resources` (
  `id` int(8) unsigned NOT NULL default '0',
  `pool_id` int(4) unsigned default NULL,
  `res_id` int(7) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools_resources_seq`
-- 

CREATE TABLE `pools_pools_resources_seq` (
  `id` int(10) unsigned NOT NULL auto_increment,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1651 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools_user`
-- 

CREATE TABLE `pools_pools_user` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `pool_id` int(4) unsigned default NULL,
  `user_id` int(6) unsigned default NULL,
  `wait` int(1) default NULL,
  `comments` mediumtext,
  `res_to_free` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=336 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_resources`
-- 

CREATE TABLE `pools_resources` (
  `id` int(8) NOT NULL auto_increment,
  `user_id` int(6) default NULL,
  `name` varchar(250) default NULL,
  `description` mediumtext,
  `since` int(16) unsigned NOT NULL default '0',
  `cat` int(2) default NULL,
  `type` int(1) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=934 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_res_borrowed`
-- 

CREATE TABLE `pools_res_borrowed` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `user_id` int(6) unsigned NOT NULL default '0',
  `res_id` int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_res_wait`
-- 

CREATE TABLE `pools_res_wait` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `user_id` int(6) unsigned NOT NULL default '0',
  `res_id` int(8) unsigned NOT NULL default '0',
  `comments` mediumtext,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_user`
-- 

CREATE TABLE `pools_user` (
  `id` int(6) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `plz` varchar(5) default NULL,
  `city` varchar(30) default NULL,
  `street` varchar(50) default NULL,
  `house` varchar(10) default NULL,
  `country` varchar(60) default NULL,
  `plz_city_public` int(1) default NULL,
  `email` varchar(50) default NULL,
  `password` varchar(40) default NULL,
  `phone` varchar(20) default NULL,
  `phone_public` int(1) default NULL,
  `description` mediumtext,
  `email_public` int(1) unsigned default NULL,
  `main_photo` int(9) unsigned NOT NULL,
  `language` varchar(10) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=140 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_user_photos`
-- 

CREATE TABLE `pools_user_photos` (
  `id` int(9) unsigned NOT NULL auto_increment,
  `user_id` int(8) unsigned NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_user_preferences`
-- 

CREATE TABLE `pools_user_preferences` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `user_id` int(7) unsigned NOT NULL,
  `welcome_message` int(1) unsigned NOT NULL,
  `registered_message` int(1) unsigned NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;


INSERT INTO `pools_pools` (`id`, `name`, `description`, `country`, `area`, `wait`, `plz`, `city`, `is_public`, `is_located`) VALUES 
(1, 'main Pool', 'everything - everywhere\r\n\r\neveryone is a member of this pool', '0', 'everything - everywhere', 0, '', '', 1, NULL);


INSERT INTO `pools_user` (`id`, `name`, `plz`, `city`, `street`, `house`, `country`, `plz_city_public`, `email`, `password`, `phone`, `phone_public`, `description`, `email_public`, `main_photo`, `language`) VALUES 
(1, 'admin', '00000', 'Stadt', 'Strasse', '00', 'DE', 0, 'email@domain.org', 'dlE3VUk/C8DKE', ' ', 1, ' ', 1, 17, 'de');


INSERT INTO `pools_pools_admin` (`id`, `pool_id`, `user_id`) VALUES 
(5, 1, 1);


INSERT INTO `pools_pools_user` (`id`, `pool_id`, `user_id`, `wait`, `comments`, `res_to_free`) VALUES 
(2, 1, 1, 0, NULL, NULL);