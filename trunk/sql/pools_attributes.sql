-- phpMyAdmin SQL Dump
-- version 2.10.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Erstellungszeit: 15. Juli 2007 um 16:43
-- Server Version: 5.0.41
-- PHP-Version: 5.2.0-10+lenny1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- Datenbank: `pools`
-- 

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

-- 
-- Daten für Tabelle `pools_attributes`
-- 

INSERT INTO `pools_attributes` (`id`, `category_id`, `name`, `type`, `amount`) VALUES 
(1, 33, 'isbn', 'string', NULL),
(2, 33, 'authors', 'string', NULL),
(3, 33, 'keywords', 'select', 5),
(4, 33, 'title', 'string', NULL),
(5, 33, 'binding', 'string', NULL),
(6, 33, 'publication_date', 'string', NULL),
(7, 33, 'publisher', 'string', NULL),
(8, 33, 'number_of_pages', 'string', NULL),
(9, 33, 'signature', 'string', NULL),
(10, 34, 'signature', 'string', NULL);
