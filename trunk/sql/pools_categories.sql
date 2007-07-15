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
-- Tabellenstruktur für Tabelle `pools_categories`
-- 

CREATE TABLE `pools_categories` (
  `id` int(4) unsigned NOT NULL default '0',
  `parent` int(4) unsigned NOT NULL default '0',
  `name` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- 
-- Daten für Tabelle `pools_categories`
-- 

INSERT INTO `pools_categories` (`id`, `parent`, `name`) VALUES 
(1, 0, 'things'),
(5, 1, 'furniture'),
(6, 1, 'tools'),
(28, 6, 'common'),
(29, 6, 'garden'),
(30, 6, 'kitchen'),
(31, 6, 'household'),
(32, 6, 'office'),
(7, 1, 'officematerial'),
(8, 1, 'media'),
(33, 8, 'books'),
(34, 8, 'magazines'),
(35, 8, 'cds'),
(36, 8, 'vinyl'),
(37, 8, 'video'),
(38, 8, 'dvd'),
(9, 1, 'electronic'),
(39, 9, 'video'),
(40, 9, 'computer'),
(41, 9, 'audio'),
(10, 1, 'foto'),
(11, 1, 'vehicles'),
(12, 1, 'sports'),
(13, 1, 'games'),
(2, 0, 'knowledge'),
(14, 2, 'repairing'),
(15, 2, 'handworks'),
(16, 2, 'learning'),
(42, 16, 'languages'),
(17, 2, 'advising'),
(18, 2, 'health'),
(19, 2, 'food'),
(20, 2, 'caretaking'),
(21, 2, 'helping'),
(22, 2, 'computer_knowledge'),
(23, 2, 'arts'),
(24, 2, 'other'),
(3, 0, 'infrastructure'),
(25, 3, 'technology'),
(26, 3, 'rooms'),
(43, 26, 'sleeping'),
(27, 3, 'move'),
(4, 0, 'no');
