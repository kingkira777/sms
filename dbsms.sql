-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2019 at 05:32 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbsms`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `an_id` int(11) NOT NULL,
  `an_userid` varchar(50) NOT NULL,
  `an_title` varchar(400) NOT NULL,
  `an_content` text NOT NULL,
  `an_date` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`an_id`, `an_userid`, `an_title`, `an_content`, `an_date`) VALUES
(15, 'admin', 'from admin', 'hello ', '02/11/2019 10:13:58 pm'),
(16, '11021', 'From teacher bote', 'hello ', '02/11/2019 10:51:34 pm');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`c_id`, `c_name`) VALUES
(6, 'stem'),
(7, 'cStudies');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `f_id` int(11) NOT NULL,
  `f_studno` varchar(50) NOT NULL,
  `f_section` varchar(50) NOT NULL,
  `f_name` varchar(200) NOT NULL,
  `f_path` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `g_id` int(11) NOT NULL,
  `g_studno` varchar(50) NOT NULL,
  `g_subject` varchar(100) NOT NULL,
  `g_semester` varchar(100) NOT NULL,
  `g_quarter` varchar(100) NOT NULL,
  `g_grade` varchar(50) NOT NULL,
  `g_teacher` varchar(50) NOT NULL,
  `g_isveryfied` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`g_id`, `g_studno`, `g_subject`, `g_semester`, `g_quarter`, `g_grade`, `g_teacher`, `g_isveryfied`) VALUES
(58, '2019-02112', '16', 'sem1', 'q1', '89', '11021', ''),
(59, '2019-02112', '16', 'sem1', 'q2', '89', '11021', ''),
(60, '2019-02112', '16', 'sem2', 'q3', '91', '11021', ''),
(68, '2019-02112', '17', 'sem1', 'q1', '90', '11021', ''),
(69, '2019-02112', '17', 'sem1', 'q2', '90', '11021', ''),
(70, '2019-02112', '17', 'sem2', 'q3', '90', '11021', ''),
(74, '2019-02112', '16', 'sem2', 'q4', '89', '11021', ''),
(75, '2019-02134', '18', 'sem1', 'q1', '70', '11021', ''),
(76, '2019-02134', '18', 'sem1', 'q2', '75', '11021', ''),
(77, '2019-02134', '18', 'sem2', 'q3', '74', '11021', ''),
(78, '2019-02134', '19', 'sem1', 'q1', '74', '11021', ''),
(79, '2019-02134', '19', 'sem1', 'q2', '75', '11021', ''),
(80, '2019-02134', '20', 'sem1', 'q1', '75', '11021', ''),
(81, '2019-02134', '20', 'sem1', 'q2', '75', '11021', ''),
(82, '2019-02134', '20', 'sem2', 'q3', '75', '11021', ''),
(83, '2019-02134', '20', 'sem2', 'q4', '74', '11021', ''),
(84, '2019-02134', '18', 'sem2', 'q4', '74', '11021', ''),
(85, '2019-02134', '19', 'sem2', 'q3', '74', '11021', ''),
(86, '2019-02134', '19', 'sem2', 'q4', '75', '11021', '');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `m_id` int(11) NOT NULL,
  `m_name` varchar(100) NOT NULL,
  `m_from` varchar(50) NOT NULL,
  `m_sendto` varchar(50) NOT NULL,
  `m_message` text NOT NULL,
  `m_isread` varchar(20) NOT NULL,
  `m_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`m_id`, `m_name`, `m_from`, `m_sendto`, `m_message`, `m_isread`, `m_date`) VALUES
(72, '', 'ricky bote s', 'admin', 'adminhello', 'true', '2019-02-11 10:53:31 '),
(73, '', 'camille ancheta d', 'admin', 'from student camille', 'true', '2019-02-11 11:07:32 ');

-- --------------------------------------------------------

--
-- Table structure for table `overalremarks`
--

CREATE TABLE `overalremarks` (
  `or_id` int(11) NOT NULL,
  `or_studno` varchar(50) NOT NULL,
  `or_remark` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `r_id` int(11) NOT NULL,
  `r_studno` varchar(50) NOT NULL,
  `r_subject` varchar(100) NOT NULL,
  `r_year` varchar(50) NOT NULL,
  `r_average` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `remarks`
--

INSERT INTO `remarks` (`r_id`, `r_studno`, `r_subject`, `r_year`, `r_average`) VALUES
(23, '2019-02112', 'stem102', '2019-2020', '91.75'),
(24, '2019-02112', 'stem101', '2019-2020', '89.5'),
(25, '2019-02134', 'cs12', '2019-2020', '74.75'),
(26, '2019-02134', 'cs10', '2019-2020', '73.25'),
(27, '2019-02134', 'cs11', '2019-2020', '74.5');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `sched_id` int(11) NOT NULL,
  `sched_course` varchar(50) NOT NULL,
  `sched_subject` varchar(50) NOT NULL,
  `sched_day` varchar(200) NOT NULL,
  `sched_timef` varchar(50) NOT NULL,
  `sched_timet` varchar(50) NOT NULL,
  `sched_section` varchar(100) NOT NULL,
  `sched_room` varchar(200) NOT NULL,
  `sched_teacher` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`sched_id`, `sched_course`, `sched_subject`, `sched_day`, `sched_timef`, `sched_timet`, `sched_section`, `sched_room`, `sched_teacher`) VALUES
(61, '6', 'stem101', 'tuesday', '08:00', '12:00', '24', '101', '11021'),
(63, '6', 'stem101', 'tuesday', '06:00', '08:30', '24', '101', '11022');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `sec_id` int(11) NOT NULL,
  `sec_courseid` varchar(25) NOT NULL,
  `sec_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`sec_id`, `sec_courseid`, `sec_name`) VALUES
(24, '6', 'rizal'),
(26, '7', 'ae41'),
(27, '7', 'ae42'),
(28, '6', 'sample');

-- --------------------------------------------------------

--
-- Table structure for table `studentcode`
--

CREATE TABLE `studentcode` (
  `scode_id` int(11) NOT NULL,
  `scode_studno` varchar(50) NOT NULL,
  `scode_codeno` varchar(50) NOT NULL,
  `scode_isverify` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(11) NOT NULL,
  `stud_no` varchar(50) NOT NULL,
  `stud_firstname` varchar(200) NOT NULL,
  `stud_lastname` varchar(200) NOT NULL,
  `stud_middlename` varchar(200) NOT NULL,
  `stud_dob` varchar(50) NOT NULL,
  `stud_gender` varchar(50) NOT NULL,
  `stud_citizenship` varchar(80) NOT NULL,
  `stud_contactno` varchar(50) NOT NULL,
  `stud_email` varchar(100) NOT NULL,
  `stud_address` varchar(400) NOT NULL,
  `stud_course` varchar(100) NOT NULL,
  `stud_section` varchar(100) NOT NULL,
  `stud_year` varchar(50) NOT NULL,
  `stud_ylevel` varchar(50) NOT NULL,
  `stud_isregistered` varchar(50) NOT NULL,
  `stud_approved` varchar(50) NOT NULL,
  `stud_emName` varchar(200) NOT NULL,
  `stud_emContact` varchar(100) NOT NULL,
  `stud_active` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `stud_no`, `stud_firstname`, `stud_lastname`, `stud_middlename`, `stud_dob`, `stud_gender`, `stud_citizenship`, `stud_contactno`, `stud_email`, `stud_address`, `stud_course`, `stud_section`, `stud_year`, `stud_ylevel`, `stud_isregistered`, `stud_approved`, `stud_emName`, `stud_emContact`, `stud_active`) VALUES
(18, '2019-02111', 'driz', 'joel', 'f', '1996-11-11', 'male', 'f', '09165890998', 'joel driz f', 'makati', '6', 'rizal', '2019-2020', 'Grade 11', 'true', 'true', 'lily', '09876544332', 'false'),
(19, '2019-02112', 'ancheta', 'camille', 'd', '1999-02-11', 'female', 'f', '09876544332', 'camille ancheta d', 'makati', '6', 'rizal', '2019-2020', 'Grade 11', 'true', 'true', 'lily', '09876555443', ''),
(20, '2019-02113', 'cuizon', 'berna', 'd', '1989-02-11', 'male', 'f', '09878900998', 'berna cuizon d', 'taguig', '7', 'ae42', '2019-2020', 'Grade 12', 'true', 'true', 'fer', '09876555443', 'false'),
(21, '2019-02134', 'Jessie', 'Velarde', 'S', '1995-10-24', 'male', 'F', '12345678900', 'h@gmail.com', 'sample', '7', 'ae41', '2019-2020', 'Grade 12', 'true', 'true', 'sample', '12345678900', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `sub_id` int(11) NOT NULL,
  `sub_courseid` varchar(50) NOT NULL,
  `sub_code` varchar(50) NOT NULL,
  `sub_description` varchar(300) NOT NULL,
  `sub_units` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`sub_id`, `sub_courseid`, `sub_code`, `sub_description`, `sub_units`) VALUES
(16, '6', 'stem101', 'english', '2'),
(17, '6', 'stem102', 'math2', '2'),
(18, '7', 'cs10', 'elective', '2'),
(19, '7', 'cs11', 'essential', '2'),
(20, '7', 'cs12', 'elective', '2');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `t_id` int(11) NOT NULL,
  `t_no` varchar(50) NOT NULL,
  `t_lastname` varchar(300) NOT NULL,
  `t_firstname` varchar(300) NOT NULL,
  `t_middlename` varchar(300) NOT NULL,
  `t_dob` varchar(50) NOT NULL,
  `t_gender` varchar(300) NOT NULL,
  `t_citizenship` varchar(300) NOT NULL,
  `t_contactno` varchar(300) NOT NULL,
  `t_email` varchar(300) NOT NULL,
  `t_address` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`t_id`, `t_no`, `t_lastname`, `t_firstname`, `t_middlename`, `t_dob`, `t_gender`, `t_citizenship`, `t_contactno`, `t_email`, `t_address`) VALUES
(8, '11021', 'bote', 'ricky', 's', '1996-02-11', 'male', 'f', '09165800996', 'fff@gmail.com', 'taguig'),
(9, '11022', 'bayot', 'myra', 'e', '1995-02-11', 'male', 'f', '09876555667', 'myra@gmail.com', 'makati');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_idno` varchar(50) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_privilage` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_idno`, `user_password`, `user_privilage`) VALUES
(1, 'admin', 'admin1234', 'admin'),
(20, '2019-02111', 'admin1', 'student'),
(21, '2019-02112', 'admin1', 'student'),
(22, '2019-02113', 'admin1', 'student'),
(23, '11021', 'admin', 'teacher'),
(24, '11022', 'ja1sbu86', 'teacher'),
(26, '2019-02134', 'admin12345', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `yr_id` int(11) NOT NULL,
  `yr_year` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`yr_id`, `yr_year`) VALUES
(5, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `_messages`
--

CREATE TABLE `_messages` (
  `mm_id` int(11) NOT NULL,
  `mm_mid` varchar(50) NOT NULL,
  `mm_name` varchar(200) NOT NULL,
  `mm_message` text NOT NULL,
  `mm_datetime` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_messages`
--

INSERT INTO `_messages` (`mm_id`, `mm_mid`, `mm_name`, `mm_message`, `mm_datetime`) VALUES
(82, '72', 'ricky bote s', 'adminhello', '2019-02-11 10:53:31 pm'),
(83, '73', 'camille ancheta d', 'from student camille', '2019-02-11 11:07:33 pm'),
(84, '73', 'Admin', 'oh cams', '2019-02-12 10:51:48 pm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`an_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`g_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `overalremarks`
--
ALTER TABLE `overalremarks`
  ADD PRIMARY KEY (`or_id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`sched_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `studentcode`
--
ALTER TABLE `studentcode`
  ADD PRIMARY KEY (`scode_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`sub_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`yr_id`);

--
-- Indexes for table `_messages`
--
ALTER TABLE `_messages`
  ADD PRIMARY KEY (`mm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `an_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `g_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `overalremarks`
--
ALTER TABLE `overalremarks`
  MODIFY `or_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `sched_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `studentcode`
--
ALTER TABLE `studentcode`
  MODIFY `scode_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `sub_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `_messages`
--
ALTER TABLE `_messages`
  MODIFY `mm_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
