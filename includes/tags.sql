-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Host: 182.50.133.147
-- Generation Time: Jan 10, 2014 at 04:07 AM
-- Server version: 5.0.96
-- PHP Version: 5.1.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phpcubes`
--

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` VALUES(26, '1');
INSERT INTO `tags` VALUES(40, '1 AND 1=1');
INSERT INTO `tags` VALUES(25, '1 AND ASCII(LOWER(SUBSTRING((SELECT TOP 1 name FROM sysobjects WHERE xtype=\\''U\\'')');
INSERT INTO `tags` VALUES(31, '1 AND USER_NAME() = \\''dbo\\''');
INSERT INTO `tags` VALUES(43, '1 EXEC XP_');
INSERT INTO `tags` VALUES(42, '1 OR 1=1');
INSERT INTO `tags` VALUES(29, '1 UNI/**/ON SELECT ALL FROM WHERE');
INSERT INTO `tags` VALUES(32, '1 UNION ALL SELECT 1');
INSERT INTO `tags` VALUES(27, '1))) > 116');
INSERT INTO `tags` VALUES(44, '1\\'' AND 1=(SELECT COUNT(*) FROM tablenames); --');
INSERT INTO `tags` VALUES(28, '1\\'' AND non_existant_table = \\''1');
INSERT INTO `tags` VALUES(41, '1\\'' OR \\''1\\''=\\''1');
INSERT INTO `tags` VALUES(39, '1\\''1');
INSERT INTO `tags` VALUES(33, '2');
INSERT INTO `tags` VALUES(34, '3');
INSERT INTO `tags` VALUES(35, '4');
INSERT INTO `tags` VALUES(36, '5');
INSERT INTO `tags` VALUES(37, '6');
INSERT INTO `tags` VALUES(8, 'array');
INSERT INTO `tags` VALUES(12, 'constant');
INSERT INTO `tags` VALUES(6, 'css');
INSERT INTO `tags` VALUES(5, 'differences');
INSERT INTO `tags` VALUES(24, 'else');
INSERT INTO `tags` VALUES(10, 'file_input_output');
INSERT INTO `tags` VALUES(17, 'for');
INSERT INTO `tags` VALUES(21, 'for()');
INSERT INTO `tags` VALUES(15, 'global');
INSERT INTO `tags` VALUES(16, 'if');
INSERT INTO `tags` VALUES(9, 'introduction');
INSERT INTO `tags` VALUES(3, 'javascript');
INSERT INTO `tags` VALUES(7, 'jquery');
INSERT INTO `tags` VALUES(4, 'linux');
INSERT INTO `tags` VALUES(23, 'loops');
INSERT INTO `tags` VALUES(13, 'magical');
INSERT INTO `tags` VALUES(2, 'mysql');
INSERT INTO `tags` VALUES(38, 'name FROM sysObjects WHERE xtype = \\''U\\'' --');
INSERT INTO `tags` VALUES(20, 'pascal');
INSERT INTO `tags` VALUES(1, 'php');
INSERT INTO `tags` VALUES(19, 'series');
INSERT INTO `tags` VALUES(22, 'structure');
INSERT INTO `tags` VALUES(18, 'switch');
INSERT INTO `tags` VALUES(14, 'variable');
INSERT INTO `tags` VALUES(11, 'zip_unzip');
INSERT INTO `tags` VALUES(45, '\\'' OR username IS NOT NULL OR username = \\''');
INSERT INTO `tags` VALUES(30, '\\''; DESC users; --');
