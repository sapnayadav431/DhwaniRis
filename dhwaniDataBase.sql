-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	6.0.5-alpha-community


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema dhwaniris
--

CREATE DATABASE IF NOT EXISTS dhwaniris;
USE dhwaniris;

--
-- Definition of table `childs`
--

DROP TABLE IF EXISTS `childs`;
CREATE TABLE `childs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(45) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `sex` enum('M','F') DEFAULT NULL,
  `father_name` varchar(45) DEFAULT NULL,
  `mother_name` varchar(45) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `state` varchar(45) DEFAULT NULL,
  `district` varchar(45) DEFAULT NULL,
  `profile_picture` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `childs`
--

/*!40000 ALTER TABLE `childs` DISABLE KEYS */;
INSERT INTO `childs` (`id`,`password`,`name`,`sex`,`father_name`,`mother_name`,`dob`,`state`,`district`,`profile_picture`) VALUES 
 (1,'23d42f5f3f66498b2c8ff4c20b8c5ac826e47146','Sapna ','M','Ram','Sitaa','2020-12-24 00:00:00','10','127','Desert.jpg');
/*!40000 ALTER TABLE `childs` ENABLE KEYS */;


--
-- Definition of table `module_actions`
--

DROP TABLE IF EXISTS `module_actions`;
CREATE TABLE `module_actions` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `moduleId` tinyint(2) unsigned DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `displayName` varchar(50) DEFAULT NULL,
  `actionUrl` varchar(50) DEFAULT NULL,
  `showInHeaderMenu` enum('0','1') DEFAULT '1',
  `flow` tinyint(2) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `module_actions`
--

/*!40000 ALTER TABLE `module_actions` DISABLE KEYS */;
INSERT INTO `module_actions` (`id`,`moduleId`,`name`,`displayName`,`actionUrl`,`showInHeaderMenu`,`flow`) VALUES 
 (1,2,'State','State','Master/state_listing','1',1),
 (2,2,'Add State','Add State','Master/add_state','0',2),
 (3,2,'Edit State','Edit State','Master/edit_state','0',3),
 (4,2,'View State','View State','Master/view_state','0',4),
 (5,2,'District','District','Master/district_listing','1',5),
 (6,2,'Add District','Add District','Master/add_district','0',6),
 (7,2,'Edit District','Edit District','Master/edit_district','0',7),
 (8,2,'View District','View District','Master/view_district','0',8),
 (9,2,'Child','Child','Master/child_listing','1',9),
 (10,2,'Add Child','Add Child','Master/add_child','0',10),
 (11,2,'Edit Child','Edit Child','Master/edit_child','0',11),
 (12,2,'View Child','View Child','Master/view_child','0',12),
 (13,1,'Dashboard','Dashboard','dashboard/loaddashboard','1',13);
/*!40000 ALTER TABLE `module_actions` ENABLE KEYS */;


--
-- Definition of table `modules`
--

DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` tinyint(2) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `displayName` varchar(50) DEFAULT NULL,
  `configName` varchar(50) DEFAULT NULL COMMENT 'fa fa icon',
  `moduleTag` text NOT NULL,
  `flow` tinyint(2) unsigned DEFAULT NULL COMMENT 'display order',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

/*!40000 ALTER TABLE `modules` DISABLE KEYS */;
INSERT INTO `modules` (`id`,`name`,`displayName`,`configName`,`moduleTag`,`flow`) VALUES 
 (1,'Dashboard','Dashboard','home','All links',1),
 (2,'Admin Center','Admin Center','fa fa-snowflake-o','All masters',2);
/*!40000 ALTER TABLE `modules` ENABLE KEYS */;


--
-- Definition of table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE `state` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `type` enum('S','D','C') NOT NULL COMMENT 'S-State, D-District, C-City',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

/*!40000 ALTER TABLE `state` DISABLE KEYS */;
/*!40000 ALTER TABLE `state` ENABLE KEYS */;




/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
