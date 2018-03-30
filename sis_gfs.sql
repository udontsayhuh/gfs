-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2018 at 11:52 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sis_gfs`
--

-- --------------------------------------------------------

--
-- Table structure for table `r_acc_admin`
--

CREATE TABLE `r_acc_admin` (
  `ADMIN_ID` int(11) NOT NULL,
  `ADMIN_UID` varchar(100) DEFAULT NULL,
  `ADMIN_PASS` varchar(100) DEFAULT NULL,
  `ADMIN_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_acc_principal`
--

CREATE TABLE `r_acc_principal` (
  `PRIN_ID` int(11) NOT NULL,
  `PRIN_NAME` varchar(100) DEFAULT NULL,
  `PRIN_UID` varchar(100) NOT NULL,
  `PRIN_PASS` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_acc_registrar`
--

CREATE TABLE `r_acc_registrar` (
  `R_ID` int(11) NOT NULL,
  `R_UID` varchar(100) DEFAULT NULL,
  `R_PASS` varchar(100) DEFAULT NULL,
  `R_NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_announcement`
--

CREATE TABLE `r_announcement` (
  `ANN_ID` int(11) NOT NULL,
  `ANN_USERTYPE` varchar(100) NOT NULL,
  `ANN_SUBJECT` varchar(100) DEFAULT NULL,
  `ANN_DATE` date NOT NULL,
  `DELETE_FLAG` bit(1) DEFAULT b'0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_building`
--

CREATE TABLE `r_building` (
  `BLDG_ID` int(11) NOT NULL,
  `BLDG_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_building_floor`
--

CREATE TABLE `r_building_floor` (
  `FLR_ID` int(11) NOT NULL,
  `FLR_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_building_room`
--

CREATE TABLE `r_building_room` (
  `ROOM_ID` int(11) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_classroom`
--

CREATE TABLE `r_classroom` (
  `CR_ID` int(11) NOT NULL,
  `CR_NAME` varchar(100) DEFAULT NULL,
  `BLDG_FK` int(11) NOT NULL,
  `FLOOR_FK` int(11) NOT NULL,
  `ROOM_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_curriculum`
--

CREATE TABLE `r_curriculum` (
  `C_ID` int(11) NOT NULL,
  `C_NAME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_curriculum`
--

INSERT INTO `r_curriculum` (`C_ID`, `C_NAME`) VALUES
(1, 'K-12 Education Curriculum');

-- --------------------------------------------------------

--
-- Table structure for table `r_grade_level`
--

CREATE TABLE `r_grade_level` (
  `GL_ID` int(11) NOT NULL,
  `L_NAME` varchar(100) NOT NULL,
  `CURRICULUM_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_grade_level`
--

INSERT INTO `r_grade_level` (`GL_ID`, `L_NAME`, `CURRICULUM_FK`) VALUES
(25, 'None', 1),
(26, 'Kinder', 1),
(27, 'Grade 1', 1),
(28, 'Grade 2', 1),
(29, 'Grade 3', 1),
(30, 'Grade 4', 1),
(31, 'Grade 5', 1),
(32, 'Grade 6', 1),
(33, 'Grade 7', 1),
(34, 'Grade 8', 1),
(35, 'Grade 9', 1),
(36, 'Grade 10', 1),
(37, 'NULL', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_learner`
--

CREATE TABLE `r_learner` (
  `L_ID` int(11) NOT NULL,
  `LEARNER_FK` int(11) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASS` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_learner`
--

INSERT INTO `r_learner` (`L_ID`, `LEARNER_FK`, `USERNAME`, `PASS`) VALUES
(1, 9, '', 'generatePassword();');

-- --------------------------------------------------------

--
-- Table structure for table `r_learner_status`
--

CREATE TABLE `r_learner_status` (
  `LS_ID` int(11) NOT NULL,
  `LEARNER_FK` int(11) NOT NULL,
  `status` varchar(100) DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_learner_status`
--

INSERT INTO `r_learner_status` (`LS_ID`, `LEARNER_FK`, `status`) VALUES
(1, 5, 'Active'),
(2, 6, 'Active'),
(3, 7, 'Active'),
(4, 8, 'Inactive'),
(5, 9, 'Inactive');

-- --------------------------------------------------------

--
-- Table structure for table `r_policy`
--

CREATE TABLE `r_policy` (
  `P_ID` int(11) NOT NULL,
  `DESCRIPT` varchar(10000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_quarter`
--

CREATE TABLE `r_quarter` (
  `Q_ID` int(11) NOT NULL,
  `Q_DESC` varchar(100) NOT NULL,
  `Q_STATUS` varchar(100) DEFAULT 'Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_school_year`
--

CREATE TABLE `r_school_year` (
  `SY_ID` int(11) NOT NULL,
  `START` varchar(100) DEFAULT NULL,
  `END` varchar(100) DEFAULT NULL,
  `SY_STATUS` varchar(100) DEFAULT NULL,
  `CURRICULUM_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_school_year`
--

INSERT INTO `r_school_year` (`SY_ID`, `START`, `END`, `SY_STATUS`, `CURRICULUM_FK`) VALUES
(1, '2018', '2019', 'Active', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_section`
--

CREATE TABLE `r_section` (
  `S_ID` int(11) NOT NULL,
  `ACADLEVEL_FK` int(11) NOT NULL,
  `SECTION_NAME` varchar(100) DEFAULT NULL,
  `T_FK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_section`
--

INSERT INTO `r_section` (`S_ID`, `ACADLEVEL_FK`, `SECTION_NAME`, `T_FK`) VALUES
(1, 26, 'Sampaguita', 1),
(2, 27, 'Manga', 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_section_class_details`
--

CREATE TABLE `r_section_class_details` (
  `SD_ID` int(11) NOT NULL,
  `SECTION_FK` int(11) NOT NULL,
  `LEARNER_FK` int(11) NOT NULL,
  `SY_FK` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_section_class_details`
--

INSERT INTO `r_section_class_details` (`SD_ID`, `SECTION_FK`, `LEARNER_FK`, `SY_FK`) VALUES
(3, 1, 5, 1),
(4, 1, 6, 1),
(5, 2, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `r_subject`
--

CREATE TABLE `r_subject` (
  `SUB_ID` int(11) NOT NULL,
  `ACADLEVEL_FK` int(11) NOT NULL,
  `SUBJECT_NAME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `r_teacher`
--

CREATE TABLE `r_teacher` (
  `T_ID` int(11) NOT NULL,
  `T_NAME` varchar(100) NOT NULL,
  `SUBJECT_DEPT` varchar(100) DEFAULT NULL,
  `T_UID` varchar(100) DEFAULT NULL,
  `T_PASS` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_teacher`
--

INSERT INTO `r_teacher` (`T_ID`, `T_NAME`, `SUBJECT_DEPT`, `T_UID`, `T_PASS`) VALUES
(1, 'Lelouch vi Britannia', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `r_transaction_date`
--

CREATE TABLE `r_transaction_date` (
  `TD_ID` int(11) NOT NULL,
  `START` date NOT NULL,
  `END` date NOT NULL,
  `DESCRIPT` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `r_transaction_date`
--

INSERT INTO `r_transaction_date` (`TD_ID`, `START`, `END`, `DESCRIPT`) VALUES
(1, '2018-03-25', '2018-03-30', 'Online Application');

-- --------------------------------------------------------

--
-- Table structure for table `t_application`
--

CREATE TABLE `t_application` (
  `A_ID` int(11) NOT NULL,
  `A_DATE` date NOT NULL,
  `A_STATUS` varchar(100) DEFAULT 'Pending',
  `LRN` varchar(100) DEFAULT NULL,
  `FNAME` varchar(100) NOT NULL,
  `MNAME` varchar(100) DEFAULT NULL,
  `LNAME` varchar(100) DEFAULT NULL,
  `BDATE` varchar(100) NOT NULL,
  `SEX` varchar(100) NOT NULL,
  `MTONGUE` varchar(100) NOT NULL,
  `IP` varchar(100) DEFAULT NULL,
  `RELIGION` varchar(100) DEFAULT NULL,
  `CONTACT` varchar(100) NOT NULL,
  `PBIRTH` varchar(100) DEFAULT NULL,
  `STREET` varchar(100) DEFAULT NULL,
  `BRGY` varchar(100) DEFAULT NULL,
  `MUNICIPAL` varchar(100) DEFAULT NULL,
  `CITY` varchar(100) NOT NULL,
  `MARITAL` varchar(100) DEFAULT NULL,
  `NATIONALITY` varchar(100) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `MOTHER` varchar(100) DEFAULT NULL,
  `MOTHER_PHONE` varchar(100) DEFAULT NULL,
  `MOTHER_OCCU` varchar(100) DEFAULT NULL,
  `FATHER` varchar(100) DEFAULT NULL,
  `FATHER_PHONE` varchar(100) DEFAULT NULL,
  `FATHER_OCCU` varchar(100) DEFAULT NULL,
  `GUARD` varchar(100) NOT NULL,
  `GUARD_REL` varchar(100) NOT NULL,
  `GUARD_CONTACT` varchar(100) NOT NULL,
  `PREV_SCHOOL` varchar(100) DEFAULT NULL,
  `GWA` decimal(10,0) DEFAULT NULL,
  `PREV_GRADE_LEVEL` int(11) DEFAULT NULL,
  `REQ_NSO` bit(1) NOT NULL DEFAULT b'0',
  `REQ_PIC` bit(1) NOT NULL DEFAULT b'0',
  `REQ_EXAM` bit(1) NOT NULL DEFAULT b'0',
  `REQ_PASS` bit(1) NOT NULL DEFAULT b'0',
  `REQ_F137` bit(1) DEFAULT b'0',
  `REQ_GMC` bit(1) NOT NULL DEFAULT b'0',
  `REQ_CERT` bit(1) NOT NULL DEFAULT b'0',
  `DELETE_FLAG` bit(1) DEFAULT b'0',
  `A_APPLY_LEVEL` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_application`
--

INSERT INTO `t_application` (`A_ID`, `A_DATE`, `A_STATUS`, `LRN`, `FNAME`, `MNAME`, `LNAME`, `BDATE`, `SEX`, `MTONGUE`, `IP`, `RELIGION`, `CONTACT`, `PBIRTH`, `STREET`, `BRGY`, `MUNICIPAL`, `CITY`, `MARITAL`, `NATIONALITY`, `EMAIL`, `MOTHER`, `MOTHER_PHONE`, `MOTHER_OCCU`, `FATHER`, `FATHER_PHONE`, `FATHER_OCCU`, `GUARD`, `GUARD_REL`, `GUARD_CONTACT`, `PREV_SCHOOL`, `GWA`, `PREV_GRADE_LEVEL`, `REQ_NSO`, `REQ_PIC`, `REQ_EXAM`, `REQ_PASS`, `REQ_F137`, `REQ_GMC`, `REQ_CERT`, `DELETE_FLAG`, `A_APPLY_LEVEL`) VALUES
(5, '2018-03-25', 'Approved', '', 'Ma. Michaela', '', 'Alejandria', '1998-06-17', 'Female', 'Tagalog', '', '', '09089598580', '', '', '', '', 'Quezon City', '', 'Filipino', 'mikaalej@gmail.com', '', '', '', '', '', '', 'Maria Cecilia Cruz', 'Cousin', '09123456789', '', '0', 25, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', 26),
(6, '2018-03-26', 'Approved', '', 'Lowie', 'Samonte', 'Catap', '1998-06-17', 'Male', 'Tagalog', '', '', '09089598580', '', '', '', '', 'Quezon City', '', 'Filipino', 'lowie@gmail.com', '', '', '', '', '', '', 'Belinda Catap', 'Spouse', '09123456789', '', '0', 25, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', 26),
(7, '2018-03-29', 'Approved', 'LRN-000001', 'Julie Ann', '', 'Resnera', '1998-06-19', 'Female', 'English', '', '', '09089598580', '', '', '', '', 'Quezon City', '', 'American', 'julieann@gmail.com', '', '', '', '', '', '', 'Spongebob Squarepants', 'Cousin', '09123456789', 'Lagro High School', '99', 26, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', 27),
(8, '2018-03-29', 'Approved', 'LRN-000002', 'Sheena Mae', '', 'Mape', '1998-05-15', 'Female', 'Tagalog', '', '', '', '', '', '', '', 'Quezon City', '', 'Filipino', 'sheena@gmail.com', '', '', '', '', '', '', 'Patrick Star', 'Cousin', '09123456789', 'Mater Carmeli School', '87', 29, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', 30),
(9, '2018-03-29', 'Approved', '', 'Anne Nicole', '', 'Cagulang', '1998-05-15', 'Female', 'Tagalog', '', '', '', '', '', '', '', 'Quezon City', '', 'Filipino', 'annenicole@gmail.com', '', '', '', '', '', '', 'Anne Kim', 'Sister', '09123456789', '', '0', 25, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'0', 26),
(10, '2018-03-30', 'Revoked', '', 'Nunally', 'Vi', 'Britannia', '1998-05-15', 'Female', 'Japanese', '', '', '091234567899', '', '', '', '', 'London', '', 'British', 'nvbritan@gmail.com', '', '', '', '', '', '', 'Lelouch Vi Britannia', 'Sibling', '09123456789', '', '0', 25, b'1', b'1', b'1', b'1', b'1', b'1', b'1', b'1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t_grade`
--

CREATE TABLE `t_grade` (
  `G_ID` int(11) NOT NULL,
  `LEARNER_FK` int(11) NOT NULL,
  `SUBJECT_FK` int(11) NOT NULL,
  `Q_FK` int(11) NOT NULL,
  `SY_FK` int(11) NOT NULL,
  `G_GRADE` decimal(10,0) NOT NULL,
  `G_REMARK` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `r_acc_admin`
--
ALTER TABLE `r_acc_admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `r_acc_principal`
--
ALTER TABLE `r_acc_principal`
  ADD PRIMARY KEY (`PRIN_ID`),
  ADD UNIQUE KEY `PRIN_UID` (`PRIN_UID`);

--
-- Indexes for table `r_acc_registrar`
--
ALTER TABLE `r_acc_registrar`
  ADD PRIMARY KEY (`R_ID`);

--
-- Indexes for table `r_announcement`
--
ALTER TABLE `r_announcement`
  ADD PRIMARY KEY (`ANN_ID`);

--
-- Indexes for table `r_building`
--
ALTER TABLE `r_building`
  ADD PRIMARY KEY (`BLDG_ID`);

--
-- Indexes for table `r_building_floor`
--
ALTER TABLE `r_building_floor`
  ADD PRIMARY KEY (`FLR_ID`);

--
-- Indexes for table `r_building_room`
--
ALTER TABLE `r_building_room`
  ADD PRIMARY KEY (`ROOM_ID`);

--
-- Indexes for table `r_classroom`
--
ALTER TABLE `r_classroom`
  ADD PRIMARY KEY (`CR_ID`),
  ADD KEY `BLDG_FK` (`BLDG_FK`),
  ADD KEY `FLOOR_FK` (`FLOOR_FK`),
  ADD KEY `ROOM_FK` (`ROOM_FK`);

--
-- Indexes for table `r_curriculum`
--
ALTER TABLE `r_curriculum`
  ADD PRIMARY KEY (`C_ID`);

--
-- Indexes for table `r_grade_level`
--
ALTER TABLE `r_grade_level`
  ADD PRIMARY KEY (`GL_ID`),
  ADD KEY `CURRICULUM_FK` (`CURRICULUM_FK`);

--
-- Indexes for table `r_learner`
--
ALTER TABLE `r_learner`
  ADD PRIMARY KEY (`L_ID`),
  ADD KEY `LEARNER_FK` (`LEARNER_FK`);

--
-- Indexes for table `r_learner_status`
--
ALTER TABLE `r_learner_status`
  ADD PRIMARY KEY (`LS_ID`),
  ADD KEY `LEARNER_FK` (`LEARNER_FK`);

--
-- Indexes for table `r_policy`
--
ALTER TABLE `r_policy`
  ADD PRIMARY KEY (`P_ID`);

--
-- Indexes for table `r_quarter`
--
ALTER TABLE `r_quarter`
  ADD PRIMARY KEY (`Q_ID`);

--
-- Indexes for table `r_school_year`
--
ALTER TABLE `r_school_year`
  ADD PRIMARY KEY (`SY_ID`),
  ADD KEY `CURRICULUM_FK` (`CURRICULUM_FK`);

--
-- Indexes for table `r_section`
--
ALTER TABLE `r_section`
  ADD PRIMARY KEY (`S_ID`),
  ADD KEY `ACADLEVEL_FK` (`ACADLEVEL_FK`),
  ADD KEY `T_FK` (`T_FK`);

--
-- Indexes for table `r_section_class_details`
--
ALTER TABLE `r_section_class_details`
  ADD PRIMARY KEY (`SD_ID`),
  ADD KEY `SECTION_FK` (`SECTION_FK`),
  ADD KEY `LEARNER_FK` (`LEARNER_FK`),
  ADD KEY `SY_FK` (`SY_FK`);

--
-- Indexes for table `r_subject`
--
ALTER TABLE `r_subject`
  ADD PRIMARY KEY (`SUB_ID`),
  ADD KEY `ACADLEVEL_FK` (`ACADLEVEL_FK`);

--
-- Indexes for table `r_teacher`
--
ALTER TABLE `r_teacher`
  ADD PRIMARY KEY (`T_ID`);

--
-- Indexes for table `r_transaction_date`
--
ALTER TABLE `r_transaction_date`
  ADD PRIMARY KEY (`TD_ID`);

--
-- Indexes for table `t_application`
--
ALTER TABLE `t_application`
  ADD PRIMARY KEY (`A_ID`),
  ADD KEY `PREV_GRADE_LEVEL` (`PREV_GRADE_LEVEL`),
  ADD KEY `A_APPLY_LEVEL` (`A_APPLY_LEVEL`);

--
-- Indexes for table `t_grade`
--
ALTER TABLE `t_grade`
  ADD PRIMARY KEY (`G_ID`),
  ADD KEY `LEARNER_FK` (`LEARNER_FK`),
  ADD KEY `SUBJECT_FK` (`SUBJECT_FK`),
  ADD KEY `Q_FK` (`Q_FK`),
  ADD KEY `SY_FK` (`SY_FK`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `r_acc_admin`
--
ALTER TABLE `r_acc_admin`
  MODIFY `ADMIN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_acc_principal`
--
ALTER TABLE `r_acc_principal`
  MODIFY `PRIN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_acc_registrar`
--
ALTER TABLE `r_acc_registrar`
  MODIFY `R_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_announcement`
--
ALTER TABLE `r_announcement`
  MODIFY `ANN_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_building`
--
ALTER TABLE `r_building`
  MODIFY `BLDG_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_building_floor`
--
ALTER TABLE `r_building_floor`
  MODIFY `FLR_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_building_room`
--
ALTER TABLE `r_building_room`
  MODIFY `ROOM_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_classroom`
--
ALTER TABLE `r_classroom`
  MODIFY `CR_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_curriculum`
--
ALTER TABLE `r_curriculum`
  MODIFY `C_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_grade_level`
--
ALTER TABLE `r_grade_level`
  MODIFY `GL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `r_learner`
--
ALTER TABLE `r_learner`
  MODIFY `L_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_learner_status`
--
ALTER TABLE `r_learner_status`
  MODIFY `LS_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `r_policy`
--
ALTER TABLE `r_policy`
  MODIFY `P_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_quarter`
--
ALTER TABLE `r_quarter`
  MODIFY `Q_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_school_year`
--
ALTER TABLE `r_school_year`
  MODIFY `SY_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_section`
--
ALTER TABLE `r_section`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `r_section_class_details`
--
ALTER TABLE `r_section_class_details`
  MODIFY `SD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `r_subject`
--
ALTER TABLE `r_subject`
  MODIFY `SUB_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `r_teacher`
--
ALTER TABLE `r_teacher`
  MODIFY `T_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `r_transaction_date`
--
ALTER TABLE `r_transaction_date`
  MODIFY `TD_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t_application`
--
ALTER TABLE `t_application`
  MODIFY `A_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `t_grade`
--
ALTER TABLE `t_grade`
  MODIFY `G_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `r_classroom`
--
ALTER TABLE `r_classroom`
  ADD CONSTRAINT `r_classroom_ibfk_1` FOREIGN KEY (`BLDG_FK`) REFERENCES `r_building` (`BLDG_ID`),
  ADD CONSTRAINT `r_classroom_ibfk_2` FOREIGN KEY (`FLOOR_FK`) REFERENCES `r_building_floor` (`FLR_ID`),
  ADD CONSTRAINT `r_classroom_ibfk_3` FOREIGN KEY (`ROOM_FK`) REFERENCES `r_building_room` (`ROOM_ID`);

--
-- Constraints for table `r_grade_level`
--
ALTER TABLE `r_grade_level`
  ADD CONSTRAINT `r_grade_level_ibfk_1` FOREIGN KEY (`CURRICULUM_FK`) REFERENCES `r_curriculum` (`C_ID`);

--
-- Constraints for table `r_learner`
--
ALTER TABLE `r_learner`
  ADD CONSTRAINT `r_learner_ibfk_1` FOREIGN KEY (`LEARNER_FK`) REFERENCES `t_application` (`A_ID`);

--
-- Constraints for table `r_learner_status`
--
ALTER TABLE `r_learner_status`
  ADD CONSTRAINT `r_learner_status_ibfk_1` FOREIGN KEY (`LEARNER_FK`) REFERENCES `t_application` (`A_ID`);

--
-- Constraints for table `r_school_year`
--
ALTER TABLE `r_school_year`
  ADD CONSTRAINT `r_school_year_ibfk_1` FOREIGN KEY (`CURRICULUM_FK`) REFERENCES `r_curriculum` (`C_ID`);

--
-- Constraints for table `r_section`
--
ALTER TABLE `r_section`
  ADD CONSTRAINT `r_section_ibfk_1` FOREIGN KEY (`ACADLEVEL_FK`) REFERENCES `r_grade_level` (`GL_ID`),
  ADD CONSTRAINT `r_section_ibfk_2` FOREIGN KEY (`T_FK`) REFERENCES `r_teacher` (`T_ID`);

--
-- Constraints for table `r_section_class_details`
--
ALTER TABLE `r_section_class_details`
  ADD CONSTRAINT `r_section_class_details_ibfk_1` FOREIGN KEY (`SECTION_FK`) REFERENCES `r_section` (`S_ID`),
  ADD CONSTRAINT `r_section_class_details_ibfk_2` FOREIGN KEY (`LEARNER_FK`) REFERENCES `t_application` (`A_ID`),
  ADD CONSTRAINT `r_section_class_details_ibfk_3` FOREIGN KEY (`SY_FK`) REFERENCES `r_school_year` (`SY_ID`);

--
-- Constraints for table `r_subject`
--
ALTER TABLE `r_subject`
  ADD CONSTRAINT `r_subject_ibfk_1` FOREIGN KEY (`ACADLEVEL_FK`) REFERENCES `r_grade_level` (`GL_ID`);

--
-- Constraints for table `t_application`
--
ALTER TABLE `t_application`
  ADD CONSTRAINT `t_application_ibfk_1` FOREIGN KEY (`PREV_GRADE_LEVEL`) REFERENCES `r_grade_level` (`GL_ID`),
  ADD CONSTRAINT `t_application_ibfk_2` FOREIGN KEY (`A_APPLY_LEVEL`) REFERENCES `r_grade_level` (`GL_ID`);

--
-- Constraints for table `t_grade`
--
ALTER TABLE `t_grade`
  ADD CONSTRAINT `t_grade_ibfk_1` FOREIGN KEY (`LEARNER_FK`) REFERENCES `t_application` (`A_ID`),
  ADD CONSTRAINT `t_grade_ibfk_2` FOREIGN KEY (`SUBJECT_FK`) REFERENCES `r_subject` (`SUB_ID`),
  ADD CONSTRAINT `t_grade_ibfk_3` FOREIGN KEY (`Q_FK`) REFERENCES `r_quarter` (`Q_ID`),
  ADD CONSTRAINT `t_grade_ibfk_4` FOREIGN KEY (`SY_FK`) REFERENCES `r_school_year` (`SY_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
