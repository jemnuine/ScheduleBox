--
-- MySQL 5.5.24
-- Sun, 31 Mar 2013 03:01:24 +0000
--

CREATE TABLE `all_subjects` (
   `subject_code` varchar(15) not null,
   `subject_name` varchar(55) not null,
   `units` int(2) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`subject_code`),
   KEY `FK_subjects_subj_code` (`subject_code`),
   KEY `fk_all_subjects_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `all_subjects` is empty]

CREATE TABLE `ci_sessions` (
   `session_id` varchar(40) not null default '0',
   `ip_address` varchar(45) not null default '0',
   `user_agent` varchar(120) not null,
   `last_activity` int(10) unsigned not null default '0',
   `user_data` text not null,
   PRIMARY KEY (`session_id`),
   KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES ('b7529d4c882e937769368816fff798a7', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.31 (KHTML, like Gecko) Chrome/26.0.1410.43 Safari/537.31', '1364698736', 'a:5:{s:9:\"user_data\";s:0:\"\";s:6:\"userid\";s:1:\"1\";s:11:\"displayname\";s:13:\"Administrator\";s:8:\"username\";s:5:\"admin\";s:12:\"is_logged_in\";b:1;}');

CREATE TABLE `course` (
   `course_code` varchar(10) not null,
   `course_name` varchar(80) not null,
   `department_name` varchar(45) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`course_code`),
   KEY `fk_course_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `course` is empty]

CREATE TABLE `course_subjects` (
   `course_name_id` int(11) not null auto_increment,
   `course_name` varchar(80) not null,
   `subject_name` varchar(55) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`course_name_id`),
   KEY `fk_course_subjects_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

-- [Table `course_subjects` is empty]

CREATE TABLE `curriculum` (
   `curriculum_id` int(11) not null auto_increment,
   `semester` varchar(10) not null,
   `curriculum_year` int(4) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`curriculum_id`),
   KEY `fk_curriculum_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=20;

INSERT INTO `curriculum` (`curriculum_id`, `semester`, `curriculum_year`, `userid`) VALUES ('17', 'First', '2012', '1');
INSERT INTO `curriculum` (`curriculum_id`, `semester`, `curriculum_year`, `userid`) VALUES ('18', 'Second', '2013', '1');

CREATE TABLE `days` (
   `index` int(11) not null,
   `day` varchar(15),
   PRIMARY KEY (`index`),
   UNIQUE KEY (`day`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `days` is empty]

CREATE TABLE `department` (
   `department_id` int(11) not null auto_increment,
   `department_name` varchar(45) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`department_id`,`department_name`),
   KEY `fk_department_users_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `department` is empty]

CREATE TABLE `instructor` (
   `instructor_id` int(11) not null,
   `instructor_name` varchar(100) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`instructor_id`),
   UNIQUE KEY (`instructor_name`),
   KEY `fk_instructor_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `instructor` is empty]

CREATE TABLE `room` (
   `room_id` int(11) not null auto_increment,
   `room_name` varchar(45) not null,
   `room_capacity` int(4),
   `room_type` varchar(45),
   `userid` int(11) not null,
   PRIMARY KEY (`room_id`),
   KEY `fk_room_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `room` is empty]

CREATE TABLE `schedules` (
   `schedule_id` int(11) not null auto_increment,
   `instructor_name` varchar(100),
   `day` varchar(10),
   `start_time` time,
   `end_time` time,
   `section_name` varchar(45),
   `subject_name` varchar(55),
   `room_name` varchar(45),
   `semester` varchar(10),
   `curriculum_year` int(4),
   `userid` int(11) not null,
   PRIMARY KEY (`schedule_id`),
   KEY `fk_schedules_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `schedules` is empty]

CREATE TABLE `section` (
   `section_name` varchar(45) not null,
   `year_level` int(1) not null,
   `course_code` varchar(10) not null,
   `userid` int(11) not null,
   PRIMARY KEY (`section_name`),
   KEY `fk_section_users1_idx` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `section` is empty]

CREATE TABLE `semester` (
   `index` int(11) not null,
   `semester` varchar(20),
   PRIMARY KEY (`index`),
   UNIQUE KEY (`semester`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `semester` is empty]

CREATE TABLE `time` (
   `index` int(11) not null,
   `time` time,
   PRIMARY KEY (`index`),
   UNIQUE KEY (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `time` is empty]

CREATE TABLE `users` (
   `userid` int(11) not null auto_increment,
   `username` varchar(10) not null,
   `password` varchar(255) not null,
   `displayname` varchar(45) not null,
   PRIMARY KEY (`userid`),
   UNIQUE KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=19;

INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('1', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', 'Administrator');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('11', 'test', '81dc9bdb52d04dc20036dbd8313ed055', 'Test');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('12', 'user', '81dc9bdb52d04dc20036dbd8313ed055', 'user');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('13', 'guest', '81dc9bdb52d04dc20036dbd8313ed055', 'Guest');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('14', 'boni', '81dc9bdb52d04dc20036dbd8313ed055', 'boni');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('15', 'yeah', '81dc9bdb52d04dc20036dbd8313ed055', 'yeah');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('16', 'asdf', '81dc9bdb52d04dc20036dbd8313ed055', 'asdf');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('17', '1234', '81dc9bdb52d04dc20036dbd8313ed055', '1234');
INSERT INTO `users` (`userid`, `username`, `password`, `displayname`) VALUES ('18', 'denneh', '81dc9bdb52d04dc20036dbd8313ed055', 'Dannah');