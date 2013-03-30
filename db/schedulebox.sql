-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 30, 2013 at 02:31 PM
-- Server version: 5.5.24-log
-- PHP Version: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `schedulebox`
--

-- --------------------------------------------------------

--
-- Table structure for table `all_subjects`
--

CREATE TABLE IF NOT EXISTS `all_subjects` (
  `subject_code` varchar(15) NOT NULL,
  `subject_name` varchar(55) NOT NULL,
  `units` int(2) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`subject_code`),
  KEY `FK_subjects_subj_code` (`subject_code`),
  KEY `fk_all_subjects_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(80) NOT NULL,
  `department_name` varchar(45) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`course_code`),
  KEY `fk_course_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

CREATE TABLE IF NOT EXISTS `course_subjects` (
  `course_name_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(80) NOT NULL,
  `subject_name` varchar(55) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`course_name_id`),
  KEY `fk_course_subjects_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE IF NOT EXISTS `curriculum` (
  `curriculum_id` int(11) NOT NULL AUTO_INCREMENT,
  `semester` varchar(10) NOT NULL,
  `curriculum_year` int(4) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`curriculum_id`),
  KEY `fk_curriculum_users1_idx` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `semester`, `curriculum_year`, `userid`) VALUES
(1, 'First', 2012, 1),
(2, 'Second', 2012, 1),
(3, 'Summer', 2012, 1);

-- --------------------------------------------------------

--
-- Table structure for table `days`
--

CREATE TABLE IF NOT EXISTS `days` (
  `index` int(11) NOT NULL,
  `day` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `day` (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(45) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`department_id`,`department_name`),
  KEY `fk_department_users_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `instructor_id` int(11) NOT NULL,
  `instructor_name` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`instructor_id`),
  UNIQUE KEY `instructor_name` (`instructor_name`),
  KEY `fk_instructor_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE IF NOT EXISTS `room` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(45) NOT NULL,
  `room_capacity` int(4) DEFAULT NULL,
  `room_type` varchar(45) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`room_id`),
  KEY `fk_room_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_name` varchar(100) DEFAULT NULL,
  `day` varchar(10) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `section_name` varchar(45) DEFAULT NULL,
  `subject_name` varchar(55) DEFAULT NULL,
  `room_name` varchar(45) DEFAULT NULL,
  `semester` varchar(10) DEFAULT NULL,
  `curriculum_year` int(4) DEFAULT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `fk_schedules_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE IF NOT EXISTS `section` (
  `section_name` varchar(45) NOT NULL,
  `year_level` int(1) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`section_name`),
  KEY `fk_section_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE IF NOT EXISTS `semester` (
  `index` int(11) NOT NULL,
  `semester` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `semester` (`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `time`
--

CREATE TABLE IF NOT EXISTS `time` (
  `index` int(11) NOT NULL,
  `time` time DEFAULT NULL,
  PRIMARY KEY (`index`),
  UNIQUE KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `displayname` varchar(45) NOT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES
(1, 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator'),
(11, 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'Test'),
(12, 'user', '81dc9bdb52d04dc20036dbd8313ed055', 'user'),
(13, 'guest', '81dc9bdb52d04dc20036dbd8313ed055', 'Guest'),
(14, 'boni', '81dc9bdb52d04dc20036dbd8313ed055', 'boni'),
(15, 'yeah', '81dc9bdb52d04dc20036dbd8313ed055', 'yeah'),
(16, 'asdf', '81dc9bdb52d04dc20036dbd8313ed055', 'asdf'),
(17, '1234', '81dc9bdb52d04dc20036dbd8313ed055', '1234'),
(18, 'denneh', '81dc9bdb52d04dc20036dbd8313ed055', 'Dannah');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
