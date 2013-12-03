-- phpMyAdmin SQL Dump
-- version 3.2.0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 29, 2011 at 10:33 PM
-- Server version: 5.1.36
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `test`
--

-- --------------------------------------------------------

--
-- Table structure for table `wsfinal_status`
--

CREATE TABLE IF NOT EXISTS `wsfinal_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(42) NOT NULL,
  `status_modifier` decimal(2,1) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `wsfinal_status`
--

INSERT INTO `wsfinal_status` (`status_id`, `status_name`, `status_modifier`) VALUES
(1, 'is sea-sick!', '-0.6'),
(2, 'ate too many hotdogs.', '-0.4'),
(3, 'is ready to race.', '0.0'),
(4, 'ate Cheerios for breakfast.', '0.4'),
(5, 'just bought new running shoes.', '0.2'),
(6, 'stayed up all night working on the final.', '-0.2'),
(7, 'feels like lightning!', '0.6');

-- --------------------------------------------------------

--
-- Table structure for table `wsfinal_wallet`
--

CREATE TABLE IF NOT EXISTS `wsfinal_wallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `wsfinal_wallet`
--

INSERT INTO `wsfinal_wallet` (`id`, `money`) VALUES
(1, 500);
