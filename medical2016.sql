-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 28, 2016 at 01:19 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `medical2016`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `AppointmentID` int(11) NOT NULL,
  `ScheduleDate` date NOT NULL,
  `ScheduleTime` time(6) DEFAULT NULL,
  `Duration` tinyint(4) NOT NULL DEFAULT '30',
  `DoctorID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `CaseID` int(11) DEFAULT NULL,
  `Description` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- --------------------------------------------------------

--
-- Table structure for table `casecommunication`
--

CREATE TABLE `casecommunication` (
  `CaseID` int(11) NOT NULL,
  `ReportDate` date NOT NULL,
  `Sickness` varchar(256) DEFAULT NULL,
  `ResposeDate` date DEFAULT NULL,
  `Remedies` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `CaseID` int(11) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Sickness` varchar(256) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `CaseStatus` varchar(20) NOT NULL DEFAULT 'OPEN',
  `CreateDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--

CREATE TABLE `doctab` (
  `DocID` bigint(20) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CaseID` int(11) NOT NULL,
  `CreateDate` date NOT NULL,
  `FilePath` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DoctorID` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `DOB` date DEFAULT NULL,
  `Languages` varchar(50) NOT NULL,
  `Hospital` varchar(100) NOT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Phone` int(11) DEFAULT NULL,
  `Mobile` int(11) DEFAULT NULL,
  `Fax` int(11) DEFAULT NULL,
  `SpecilityID` tinyint(4) DEFAULT NULL,
  `Profile` varchar(100) DEFAULT NULL,
  `SkypeID` varchar(50) NOT NULL,
  `D_No` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZIP` varchar(10) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'REGISTERED',
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  `IDCardNumber` varchar(20) DEFAULT NULL,
  `PhotoIDUploaded` tinyint(1) DEFAULT NULL,
  `RejectReasons` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `CreateDate` date NOT NULL,
  `DoctorID` int(50) NOT NULL,
  `Overallsatiesfaction` varchar(40) NOT NULL,
  `Suggestion` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `LangID` tinyint(4) NOT NULL,
  `Lang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`LangID`, `Lang`) VALUES
(1, 'English'),
(2, 'Chinees'),
(3, 'Fench'),
(4, 'Hindi'),
(5, 'Kannada'),
(6, 'Telugu'),
(7, 'Tamil');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `IDCardNumber` varchar(20) NOT NULL,
  `DOB` date NOT NULL,
  `Status` varchar(20) DEFAULT 'REGISTERED',
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  `Gender` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Phone` int(11) DEFAULT NULL,
  `SkypeID` varchar(50) NOT NULL,
  `Mobile` int(11) DEFAULT NULL,
  `Fax` int(11) DEFAULT NULL,
  `PlanID` int(11) NOT NULL,
  `EmergencyContactName` varchar(50) DEFAULT NULL,
  `EmergencyContactPhone` int(11) DEFAULT NULL,
  `D_No` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZIP` varchar(10) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `RejectReasons` varchar(265) DEFAULT NULL,
  `PhotoIDUploaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
--
-- Table structure for table `patientdoctor`
--

CREATE TABLE `patientdoctor` (
  `PatientID` int(11) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Treatment` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `PlanID` int(11) NOT NULL,
  `PlanDetails` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `specility`
--

CREATE TABLE `specility` (
  `SpecilityID` tinyint(4) NOT NULL,
  `SpecilityName` varchar(90) NOT NULL,
  `Status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `specility`
--

INSERT INTO `specility` (`SpecilityID`, `SpecilityName`, `Status`) VALUES
(1, 'Cardiovascular Health', 1),
(2, 'Family Medicine', 1),
(3, 'Orthopedic Surgery', 1),
(4, 'Dermatology', 1),
(5, 'Pediatrics', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int(11) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPass` varchar(100) NOT NULL,
  `userStatus` enum('Y','N') NOT NULL DEFAULT 'N',
  `tokenCode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`AppointmentID`);

--
-- Indexes for table `cases`
--
ALTER TABLE `cases`
  ADD PRIMARY KEY (`CaseID`);

--
-- Indexes for table `doctab`
--
ALTER TABLE `doctab`
  ADD PRIMARY KEY (`DocID`),
  ADD KEY `DocID` (`DocID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DoctorID`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`LangID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`PlanID`);

--
-- Indexes for table `specility`
--
ALTER TABLE `specility`
  ADD PRIMARY KEY (`SpecilityID`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userEmail` (`userEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `CaseID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `doctab`
--
ALTER TABLE `doctab`
  MODIFY `DocID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LangID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `plan`
--
--
-- AUTO_INCREMENT for table `specility`
--
ALTER TABLE `specility`
  MODIFY `SpecilityID` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
