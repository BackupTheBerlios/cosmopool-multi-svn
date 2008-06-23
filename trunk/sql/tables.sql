-- phpMyAdmin SQL Dump
-- version 2.6.2
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 29. Mai 2006 um 00:50
-- Server Version: 4.1.18
-- PHP-Version: 5.1.1
-- 
-- Datenbank: `pools`
-- 

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
-- Tabellenstruktur für Tabelle `pools_pools`
-- 

CREATE TABLE `pools_pools` (
  `id` int(4) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `description` mediumtext,
  `country` varchar(5) default NULL,
  `area` varchar(50) default NULL,
  `wait` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_pools_admin`
-- 

CREATE TABLE `pools_pools_admin` (
  `id` int(7) unsigned NOT NULL auto_increment,
  `pool_id` int(4) unsigned default NULL,
  `user_id` int(6) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=65 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_res_borrowed`
-- 

CREATE TABLE `pools_res_borrowed` (
  `id` int(8) unsigned NOT NULL auto_increment,
  `user_id` int(6) unsigned NOT NULL default '0',
  `res_id` int(8) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

-- 
-- Tabellenstruktur für Tabelle `pools_resources`
-- 

CREATE TABLE `pools_resources` (
  `id` int(8) NOT NULL auto_increment,
  `user_id` int(6) default NULL,
  `name` varchar(100) default NULL,
  `description` mediumtext,
  `since` int(16) unsigned default NULL,
  `cat` int(2) default NULL,
  `type` int(1) unsigned default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

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
  `plz_city_public` int(1) default NULL,
  `email` varchar(50) default NULL,
  `password` varchar(40) default NULL,
  `phone` varchar(20) default NULL,
  `phone_public` int(1) default NULL,
  `description` mediumtext,
  `email_public` int(1) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=33 ;

-- 
-- Dumping data for table `pools_user`
-- 

INSERT INTO `pools_user` VALUES (1, 'Busgefahren', '34327', 'Körle', 'Herkulesstr.', '10', 1, 'busgefahren@gmx.de', 'dlbMtextJqkko', '', NULL, NULL);
