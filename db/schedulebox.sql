-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 05, 2013 at 02:55 AM
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
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `subject_code` varchar(15) NOT NULL,
  `subject_name` varchar(55) NOT NULL,
  `units` int(2) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`),
  KEY `FK_subjects_subj_code` (`subject_code`),
  KEY `fk_all_subjects_users1_idx` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `all_subjects`
--

INSERT INTO `all_subjects` (`subject_id`, `subject_code`, `subject_name`, `units`, `userid`) VALUES
(4, 'INTE3013', 'System Analysis and Design', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b7529d4c882e937769368816fff798a7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31', 1364698736, 'a:5:{s:9:"user_data";s:0:"";s:6:"userid";s:1:"1";s:11:"displayname";s:13:"Administrator";s:8:"username";s:5:"admin";s:12:"is_logged_in";b:1;}');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_desc` varchar(255) NOT NULL,
  `department_desc` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `fk_course_users1_idx` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_desc`, `department_desc`, `userid`, `course_code`) VALUES
(10, 'Education Major in Math', 'College of Education', 1, 'BSE MT');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `semester`, `curriculum_year`, `userid`) VALUES
(24, 'First', 2012, 12),
(35, 'First', 2011, 1),
(36, 'First', 2012, 1);

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
  `department_code` varchar(45) NOT NULL,
  `department_desc` varchar(255) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_code`, `department_desc`, `userid`) VALUES
(6, 'BSIEE', 'Industrial Engineering', 18),
(7, 'COE', 'College of Engot', 18),
(26, 'CoEd', 'College of Education', 1);

-- --------------------------------------------------------

--
-- Table structure for table `instructor`
--

CREATE TABLE IF NOT EXISTS `instructor` (
  `instructor_id` int(11) NOT NULL AUTO_INCREMENT,
  `instructor_name` varchar(100) NOT NULL,
  `userid` int(11) NOT NULL,
  PRIMARY KEY (`instructor_id`),
  UNIQUE KEY `instructor_name` (`instructor_name`),
  KEY `fk_instructor_users1_idx` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `instructor`
--

INSERT INTO `instructor` (`instructor_id`, `instructor_name`, `userid`) VALUES
(1, 'Jodi', 1),
(2, 'Ruben', 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`room_id`, `room_name`, `room_capacity`, `room_type`, `userid`) VALUES
(6, 'A69', 50, 'Laboratory Room', 1),
(7, 'B3', 45, 'Laboratory Room', 1);

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
  `section_number` int(11) NOT NULL,
  `year_level` int(1) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `userid` int(11) NOT NULL,
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`section_id`),
  KEY `fk_section_users1_idx` (`userid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_number`, `year_level`, `course_code`, `userid`, `section_id`) VALUES
(2, 3, 'BSIE', 1, 11),
(4, 1, 'BSE MT', 1, 12);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

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
(18, 'denneh', '81dc9bdb52d04dc20036dbd8313ed055', 'Dannah'),
(19, 'pjong', 'cbee5d0e698beb80b8de06feb78cf53a', 'Paul John');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
