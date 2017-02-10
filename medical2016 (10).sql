-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 25, 2017 at 04:57 AM
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
  `ReportDate` datetime NOT NULL,
  `Sickness` varchar(256) DEFAULT NULL,
  `ResposeDate` datetime DEFAULT NULL,
  `Remedies` varchar(256) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `casecommunication`
--

INSERT INTO `casecommunication` (`CaseID`, `ReportDate`, `Sickness`, `ResposeDate`, `Remedies`) VALUES
(1, '2017-01-23 20:37:03', '', NULL, NULL),
(2, '2017-01-23 20:37:20', 'hjkugh', NULL, NULL),
(3, '2017-01-23 20:37:27', 'lkk', NULL, NULL),
(4, '2017-01-23 20:39:26', 'ghygfujytgujyhtg', NULL, NULL),
(5, '2017-01-23 20:39:41', '', NULL, NULL),
(6, '2017-01-23 20:39:50', 'ghujmghukm', NULL, NULL),
(7, '2017-01-23 20:40:06', '', NULL, NULL),
(8, '2017-01-23 20:43:15', '', NULL, NULL),
(9, '2017-01-23 20:43:27', '', NULL, NULL),
(10, '2017-01-23 20:45:37', '', NULL, NULL),
(11, '2017-01-23 20:47:00', '', NULL, NULL),
(12, '2017-01-23 20:47:06', 'thtrhtryhut6ujhtyg', NULL, NULL),
(13, '2017-01-23 20:47:56', 'thtrhtryhut6ujhtyg', NULL, NULL),
(14, '2017-01-23 20:52:17', '', NULL, NULL),
(15, '2017-01-23 20:54:57', 'fghfh', NULL, NULL),
(16, '2017-01-23 21:44:56', '', NULL, NULL),
(17, '2017-01-23 21:45:02', 'regrthty6ht', NULL, NULL),
(18, '2017-01-23 21:45:20', '', NULL, NULL),
(19, '2017-01-23 21:45:23', 'yujty7juytf', NULL, NULL),
(20, '2017-01-23 21:45:55', '', NULL, NULL),
(21, '2017-01-23 21:45:57', 'trhtrsfhtrs', NULL, NULL),
(22, '2017-01-23 21:46:43', 'fgnhdtjygnt', NULL, NULL),
(23, '2017-01-23 22:25:44', 'ufruyoiguioytg', NULL, NULL),
(24, '2017-01-23 22:32:35', 'ghjmnghjmm', NULL, NULL),
(25, '2017-01-24 01:36:51', 'sasa', NULL, NULL),
(26, '2017-01-24 10:36:00', '', NULL, NULL),
(27, '2017-01-24 10:40:02', '', NULL, NULL),
(28, '2017-01-24 10:40:14', 'QQQQQQQQQQQQQQQ', NULL, NULL),
(29, '2017-01-24 10:41:57', 'wwwwwwwwwwwwwwwwwww', NULL, NULL),
(30, '2017-01-24 10:47:14', 'uuuuuuuuuuuuuuuuuuuuu', NULL, NULL),
(31, '2017-01-24 11:24:59', 'eterwytresyr5t6eyh65trh', NULL, NULL),
(32, '2017-01-24 11:25:18', 'eterwytresyr5t6eyh65trh', NULL, NULL),
(33, '2017-01-24 11:26:06', 't5erytrytr', NULL, NULL),
(34, '2017-01-24 13:41:01', 'PPPPPPPPPPPPPPPPP', NULL, NULL),
(35, '2017-01-24 13:50:46', 'fffff', NULL, NULL),
(36, '2017-01-24 14:45:48', 'aaa', NULL, NULL),
(37, '2017-01-24 22:14:19', 'FSXBHTRFBHRTFG ', NULL, NULL),
(38, '2017-01-24 22:16:35', 'FWEFWE', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cases`
--

CREATE TABLE `cases` (
  `CaseID` bigint(20) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `Sickness` varchar(256) NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `CaseStatus` varchar(20) NOT NULL DEFAULT 'OPEN',
  `CreateDate` date NOT NULL,
  `AccessFlag` tinyint(1) NOT NULL DEFAULT '0',
  `Amount` int(11) DEFAULT NULL,
  `ActiveFlag` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cases`
--

INSERT INTO `cases` (`CaseID`, `PatientID`, `Sickness`, `DoctorID`, `CaseStatus`, `CreateDate`, `AccessFlag`, `Amount`, `ActiveFlag`) VALUES
(4, 89, 'ghygfujytgujyhtg', 93, 'OPEN', '2017-01-23', 0, 1000, 1),
(6, 89, 'ghujmghukm', 0, 'OPEN', '2017-01-23', 0, 1000, 1),
(7, 89, '', 0, 'OPEN', '2017-01-23', 0, 1000, 1),
(8, 89, '', 93, 'OPEN', '2017-01-23', 0, 1000, 1),
(9, 89, '', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(10, 89, '', 93, 'OPEN', '2017-01-23', 0, 1000, 0),
(11, 89, '', 93, 'OPEN', '2017-01-23', 0, 1000, 0),
(12, 89, 'thtrhtryhut6ujhtyg', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(13, 89, 'thtrhtryhut6ujhtyg', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(14, 89, '', 72, 'OPEN', '2017-01-23', 0, 3000, 0),
(15, 89, 'fghfh', 0, 'OPEN', '2017-01-23', 1, 3000, 0),
(16, 89, '', 93, 'OPEN', '2017-01-23', 0, 1000, 0),
(17, 89, 'regrthty6ht', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(18, 89, '', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(19, 89, 'yujty7juytf', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(20, 89, '', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(21, 89, 'trhtrsfhtrs', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(22, 89, 'fgnhdtjygnt', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(23, 89, 'ufruyoiguioytg', 93, 'OPEN', '2017-01-23', 0, 1000, 0),
(24, 89, 'ghjmnghjmm', 0, 'OPEN', '2017-01-23', 0, 1000, 0),
(38, 89, 'FWEFWE', 72, 'OPEN', '2017-01-24', 1, 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `CountryID` tinyint(12) NOT NULL,
  `CountryName` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`CountryID`, `CountryName`) VALUES
(1, 'USA'),
(2, 'INDIA'),
(3, 'SINGAPORE'),
(4, 'CHINA'),
(5, 'FRANCE');

-- --------------------------------------------------------

--
-- Table structure for table `doctab`
--

CREATE TABLE `doctab` (
  `DocID` bigint(20) NOT NULL,
  `UserID` int(11) NOT NULL,
  `CaseID` int(11) NOT NULL,
  `CreateDate` date NOT NULL,
  `FilePath` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctab`
--

INSERT INTO `doctab` (`DocID`, `UserID`, `CaseID`, `CreateDate`, `FilePath`) VALUES
(1, 89, 38, '2017-01-24', 'aadhaarCardUID.png'),
(2, 89, 38, '2017-01-24', 'aadhar-card-benefits-and-modi-government1-1-e1446030335378.png');

-- --------------------------------------------------------

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
  `Phone` bigint(11) DEFAULT NULL,
  `Mobile` bigint(11) DEFAULT NULL,
  `Fax` bigint(11) DEFAULT NULL,
  `SpecilityID` tinyint(4) DEFAULT NULL,
  `Profile` varchar(100) DEFAULT NULL,
  `SkypeID` varchar(50) NOT NULL,
  `PlanID` int(11) NOT NULL,
  `D_No` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZIP` varchar(10) DEFAULT NULL,
  `CountryID` tinyint(50) DEFAULT NULL,
  `Status` varchar(20) NOT NULL DEFAULT 'REGISTERED',
  `Active` tinyint(1) NOT NULL DEFAULT '0',
  `IDCardNumber` varchar(20) DEFAULT NULL,
  `PhotoIDUploaded` tinyint(1) DEFAULT NULL,
  `RejectReasons` varchar(256) DEFAULT NULL,
  `ReferralName1` varchar(50) DEFAULT NULL,
  `ReferralContact1` bigint(11) DEFAULT NULL,
  `ReferralHospital1` varchar(100) DEFAULT NULL,
  `ReferralSpeciality1` tinyint(4) DEFAULT NULL,
  `ReferralName2` varchar(50) DEFAULT NULL,
  `ReferralContact2` bigint(11) DEFAULT NULL,
  `ReferralHospital2` varchar(100) DEFAULT NULL,
  `ReferralSpeciality2` tinyint(4) DEFAULT NULL,
  `BankName` varchar(50) NOT NULL,
  `BankAccountNo` bigint(20) NOT NULL,
  `IFSCCode` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DoctorID`, `FirstName`, `LastName`, `DOB`, `Languages`, `Hospital`, `Gender`, `Email`, `Phone`, `Mobile`, `Fax`, `SpecilityID`, `Profile`, `SkypeID`, `PlanID`, `D_No`, `Street`, `City`, `State`, `ZIP`, `CountryID`, `Status`, `Active`, `IDCardNumber`, `PhotoIDUploaded`, `RejectReasons`, `ReferralName1`, `ReferralContact1`, `ReferralHospital1`, `ReferralSpeciality1`, `ReferralName2`, `ReferralContact2`, `ReferralHospital2`, `ReferralSpeciality2`, `BankName`, `BankAccountNo`, `IFSCCode`) VALUES
(72, 'viswa', 'kuruva', '2016-12-08', '1,2', 'St. Peters Hospital', NULL, 'viswanath0541@gmail.com', 2147483647, 2147483647, 2147483647, 2, 'https://www.linkedin.com/in/manoharpitta', 'jaysonwilliams2', 3, '33', 'mainstreet', 'narsapur', 'andhrapradesh', '535591', 1, 'APPROVED', 0, '22222  ', 1, '', '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(78, NULL, NULL, '1970-01-01', '1,4,6,7', 'St. Peters Hospital', NULL, 'chris@medicall.com', 99786978, 345345555, 987593874, 4, 'https://www.linkedin.com/in/manoharpitta', 'ravisurapati', 0, '34', 'Sportwood Englishtown Rd', 'MONROE', 'NJ', '32454', 4, '       APPROVED', 0, NULL, 0, '', 'Dr. Prakash', 99967867, 'CARE', 2, 'Dr. Prakash', 94564646, 'KGH', 2, '', 0, ''),
(81, 'john', 'david', '1989-05-04', '1', '2343', 'male', 'johndavid@gmail.com', 0, 91, 234, 2, '2344', '3242', 2, ' 31', ' 56', 'Visakahapatnam', '45', '530042', 127, 'REJECTED', 0, '4582881992 ', 0, 'enter valid data', '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(84, 'Manohar', 'Pitta', '0000-00-00', '1,4', 'St. Peters Hospital', 'male', 'mpitta@jwtechinc.com', 2147483647, 2147483647, 2147483647, 2, 'https://www.linkedin.com/in/manoharpitta', 'pittasujata', 0, '    34', '    mainstreet', 'narsapur', 'andhrapradesh', '535591', 0, ' APPROVED', 0, '43564    ', 0, '', '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(86, 'Sunil', 'Pitta', '2016-12-06', '1,4,5', 'St. Peters Hospital', 'male', 'Sunil@medicall.com', 2835489, 2147483647, 234234, 4, 'https://www.linkedin.com/in/manoharpitta\r\n', '9836542134', 0, ' 233', 'mainstreet', 'narsapur', 'NJ', '535591', 0, ' REGISTERED', 0, ' 234324', 1, '', '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(88, 'Randy', 'Williams', '2016-12-09', '1,2', 'vikram hospital', 'male', 'Rany@doctor.com', 2147483647, 2147483647, 1234, 4, 'https://www.linkedin.com/in/manoharpitta', 'pittasujata', 4, '      1-1016', '     SP Road', 'HYD', 'TS', '343534', 0, 'APPROVED', 0, ' 2353254     ', 0, '', '', 0, '', 0, '', 0, '', 0, '', 0, ''),
(93, 'Abbey', 'Pitta', '1970-01-01', '1,6', 'St. Peters Hospital', 'male', 'Abby@medicall.com', 9441358635, 9441358635, 9441358635, 2, 'www.linkedin.com/in/manoharpitta', 'jaysonwilliams2', 0, '34', 'mainstreet', 'MONROE', 'NJ', '535591', 1, 'APPROVED', 0, '234324324', 1, '', 'Dr. Prakash', 99967867, 'CARE', 2, 'DR. Swathi', 94564646, 'KGH', 5, 'SBI', 999999999, 'QAZ6758Q'),
(95, 'ABC', 'XYZ', '2017-01-05', '1', 'St. Peters Hospital', NULL, 'abc@abc.com', 9441358635, 9441358635, 9441358635, 2, 'https://www.linkedin.com/in/manoharpitta', 'jaysonwilliams2', 0, '34545765', 'mainstreet', 'narsapur', 'andhrapradesh', '535591', 1, 'APPROVED', 0, '32453255', 1, '', 'Dr. Prakash', 99967867, 'CARE', 2, 'Dr. Prakash', 94564646, 'KGH', 2, '', 0, ''),
(96, 'anjali', 'devi', NULL, '', '', NULL, 'jyo@gmail.com', NULL, NULL, NULL, NULL, NULL, '', 0, NULL, NULL, NULL, NULL, NULL, NULL, 'REGISTERED', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `doctorpayment`
--

CREATE TABLE `doctorpayment` (
  `DoctorID` int(11) NOT NULL,
  `CaseID` bigint(20) NOT NULL,
  `Amount` int(11) NOT NULL,
  `PaidFlag` tinyint(1) NOT NULL DEFAULT '0',
  `PaidDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctorpayment`
--

INSERT INTO `doctorpayment` (`DoctorID`, `CaseID`, `Amount`, `PaidFlag`, `PaidDate`) VALUES
(93, 14, 3243, 0, '0000-00-00'),
(93, 6, 45645, 0, '0000-00-00'),
(93, 14, 3243, 0, '0000-00-00'),
(93, 6, 45645, 0, '0000-00-00'),
(93, 14, 46, 1, '2017-01-24'),
(93, 12, 3656, 1, '2017-01-24'),
(93, 14, 46, 1, '2017-01-24'),
(93, 12, 3656, 1, '2017-01-24');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `CreateDate` date NOT NULL,
  `DoctorID` int(11) NOT NULL,
  `Overallsatiesfaction` tinyint(1) NOT NULL,
  `Suggestion` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`FeedbackID`, `CreateDate`, `DoctorID`, `Overallsatiesfaction`, `Suggestion`) VALUES
(1, '2017-01-24', 72, 5, 'asfsasd');

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
  `Phone` bigint(11) DEFAULT NULL,
  `SkypeID` varchar(50) NOT NULL,
  `Mobile` bigint(11) DEFAULT NULL,
  `Fax` bigint(11) DEFAULT NULL,
  `PlanID` int(11) NOT NULL,
  `EmergencyContactName` varchar(50) DEFAULT NULL,
  `EmergencyContactPhone` bigint(11) DEFAULT NULL,
  `D_No` varchar(50) DEFAULT NULL,
  `Street` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `ZIP` varchar(10) DEFAULT NULL,
  `CountryID` tinyint(50) DEFAULT NULL,
  `RejectReasons` varchar(265) DEFAULT NULL,
  `PhotoIDUploaded` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `FirstName`, `LastName`, `IDCardNumber`, `DOB`, `Status`, `Active`, `Gender`, `Email`, `Phone`, `SkypeID`, `Mobile`, `Fax`, `PlanID`, `EmergencyContactName`, `EmergencyContactPhone`, `D_No`, `Street`, `City`, `State`, `ZIP`, `CountryID`, `RejectReasons`, `PhotoIDUploaded`) VALUES
(71, 'Manohar', 'Pitta', '3424244', '1998-02-03', 'SUBSCRIBED', 0, 'female', '', 23421342, '', 1242142, 23424, 0, 'Sushma', 234234, '343', 'Spotswood', 'MONROE', 'NJ', '8831', 0, '', 0),
(73, 'Sushma', 'Pitta', '345345', '1998-02-10', 'REJECTED', 0, 'female', 'ManoharPV@Gmail.com', 2147483647, '', 2147483647, 2147483647, 0, 'male', 2147483647, '45', 'mainstreet', 'Jaipur', 'TG', '53455', 0, 'Reject my Reasons', 0),
(74, 'Sushm', 'Pitta', '657657', '1998-02-10', 'REJECTED', 0, 'female', 'ManoharPV@gmail.com', 314531431, '', 234234, 23423, 0, 'MMM', 12312, '876', 'RP RD', 'Sec', 'TS', '543535', 0, 'ilusgdefuilhsdlgfidfsilughugl', 0),
(75, 'Admin', 'User', '', '0000-00-00', 'REGISTERED', 0, '', 'admin@medicall.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(76, 'Approver', 'User', '', '0000-00-00', 'REGISTERED', 0, '', 'approver@medicall.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(77, 'ravi', '', 'raj', '1970-01-01', NULL, 0, 'male', 'john@medicall.com', 9441358635, 'jaysonwilliams2', 9441358635, 9441358635, 0, 'wefre', 9441358635, '398', 'mainstreet', 'narsapur', 'AJ', '535591', 2, '', 0),
(79, 'Williams', 'Pitta', '234243', '1996-08-06', 'SUBSCRIBED', 0, 'female', 'bill@JWT.com', 23423, '', 23423, 454, 0, '', 345, '234', 'sdfs', 'sdfsdf', 'nj', '123', 0, '', 0),
(80, 'Mano', 'Pitta', '', '0000-00-00', 'REGISTERED', 0, '', 'Mano@JWTechInc.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(82, 'Dinesh', 'Amarthaluri', '', '0000-00-00', 'REGISTERED', 0, '', 'dinesh@gmail.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(83, 'Lakshmi', 'reesu', '', '0000-00-00', 'REGISTERED', 0, '', 'Lakshmi@medicall.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(85, 'vishu', 'kk', '', '0000-00-00', 'REGISTERED', 0, '', 'vishu@gmail.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(87, ' male', '   surapati', '8546 4673 7565', '1992-07-04', 'APPROVED', 0, 'male', 'ravi@medicall.com', 2147483647, 'ravisurapati', 2147483647, 2147483647, 0, 'male', 2147483647, '  51-3-230', ' mainstreet', 'narsapur', ' andhrapradesh', ' 535591', 0, '', 0),
(89, 'Patty', 'Roberts', '32453255', '1991-11-01', 'APPROVED', 0, 'female', 'Patty@doctor.com', 2147483647, 'anilicon', 2147483647, 2147483647, 0, 'Mano', 2147483647, '1-1016', 'mainstreet', 'narsapur', 'andhrapradesh', '535591', 1, '', 1),
(90, 'Laxmi', 'Sai', '', '0000-00-00', 'REGISTERED', 0, '', 'reesulaxmi@gmail.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(91, 'Roja', 'reesu', '', '0000-00-00', 'REGISTERED', 0, '', 'reesuroja27@gmail.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(92, 'Patient', 'Patient', '', '0000-00-00', 'REGISTERED', 0, '', 'Patient@patient.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(94, 'male', 'Pitta', '554654654', '2006-02-01', 'APPROVED', 0, 'male', 'dany@medicall.com', 9441358635, 'reesulaxmi', 9441358635, 9441358635, 0, 'Dady', 9441358635, '23-9', 'mainstreet', 'narsapur', 'andhrapradesh', '535591', 2, '', 1),
(97, 'Peter', 'Williams', '', '0000-00-00', 'REGISTERED', 0, '', 'Pet@medicall.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0),
(98, 'vasanth', 'siva', '', '0000-00-00', 'REGISTERED', 0, '', 'vasanthsiva143@gmail.com', NULL, '', NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

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
  `Category` varchar(50) NOT NULL,
  `Amount` smallint(6) NOT NULL,
  `PlanDetails` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`PlanID`, `Category`, `Amount`, `PlanDetails`) VALUES
(1, 'Exp Level 1', 1000, 'Experinece Level 1'),
(2, 'Exp Level 2', 2000, 'Experinece Level 2'),
(3, 'Exp Level 3', 3000, 'Experinece Level 3'),
(4, 'Exp Level 4', 4000, 'Experinece Level 4'),
(5, 'Exp Level 5', 5000, 'Experinece Level 5');

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
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `StateID` varchar(5) NOT NULL,
  `CountryID` tinyint(12) NOT NULL,
  `StateName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`StateID`, `CountryID`, `StateName`) VALUES
('BR', 2, 'Bihar'),
('DL', 2, 'Delhi'),
('MH', 2, 'Maharashtra'),
('TN', 2, 'Tamil Nadu'),
('AP', 2, 'Andhra pradesh'),
('NY', 1, 'New york'),
('CA', 1, 'colifornia'),
('IA', 1, 'lowa'),
('FL', 3, 'Florida');

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
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `firstName`, `lastName`, `userType`, `userEmail`, `userPass`, `userStatus`, `tokenCode`) VALUES
(71, 'Manohar', 'Pitta', 'patient', 'ManoharPV@Yahoo.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '19863ef9ddb2c970849d0bee03933c85'),
(72, 'viswa', 'kuruva', 'doctor', 'viswanath0541@gmail.com', 'ab129dfe38ce898f71f080166737cb70', 'Y', 'c869b8f60398b74a265b87b1b51825d4'),
(73, 'Ravi', 'surapati', 'admin', 'ravi@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '605f0bc80fae8e1781b6b54291961b49'),
(74, 'Sushm', 'pITTA', 'patient', 'ManoharPV@gmail.com', 'bbf2dead374654cbb32a917afd236656', 'Y', '407f002ac5ccaee1a2b60f9edb56e2d2'),
(75, 'Admin', 'User', 'admin', 'admin@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '380b2945b88f0e4cdd10b367803f92f4'),
(76, 'Approver', 'User', 'approver', 'approver@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '8797e0343e74556bb72e7a2efc7152eb'),
(77, 'John', 'McAn', 'patient', 'john@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '54b7b22935fbea430d2d620dcf6459c1'),
(78, 'Chris', 'User', 'doctor', 'chris@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'd85bf558b07a324dda7161f8cd0bf505'),
(79, 'Williams', 'Pitta', 'patient', 'bill@JWT.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '1398101b0e63f1bcb394231a93d4f548'),
(80, 'Mano', 'Pitta', 'patient', 'Mano@JWTechInc.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '5be541b64e9a9a9b1758d607cac2a3f5'),
(81, 'john', 'david', 'doctor', 'johndavid@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '636a550d4b2da7ea426ed9d4736e38e9'),
(82, 'Dinesh', 'Amarthaluri', 'patient', 'dinesh@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '575ce7840426a29dca40d4d921022a0c'),
(83, 'Lakshmi', 'reesu', 'patient', 'Lakshmi@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '528a1a319f645a155c7c663e44d2484f'),
(84, 'Manohar', 'Pitta', 'doctor', 'mpitta@jwtechinc.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'c105ad38c27adde463dfbaf115377aaa'),
(85, 'vishu', 'kk', 'patient', 'vishu@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'ee588fe2e09aedf39f75faa42b047994'),
(86, 'Sunil', 'Pitta', 'doctor', 'Sunil@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '630cd54a57607ae0b4803d7d0050b7db'),
(87, 'ravi', 'surapati', 'patient', 'ravi@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'f9a4f2695472b0d7f32b5326b750c2c3'),
(88, 'Randy', 'Williams', 'doctor', 'Rany@doctor.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '8ea82051e165642cffd5565ea42117be'),
(89, 'Patty', 'Roberts', 'patient', 'Patty@doctor.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'dd9b9e30fba5defd70ba44c4bc74d448'),
(90, 'Laxmi', 'Sai', 'patient', 'reesulaxmi@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'N', 'd8f8e56e3cdff70c0febcd0f3f678de8'),
(91, 'Roja', 'reesu', 'patient', 'reesuroja27@gmail.com', '1b3bcdb95f0bf904ee758218f1d8efe2', 'N', 'fe7e80024fb4c5c3997f03381ab30235'),
(92, 'Patient', 'Patient', 'patient', 'Patient@patient.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '0acaed8e1bcfd8521a0dee4b671c779b'),
(93, 'Abbey', 'Pitta', 'doctor', 'Abby@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '9af1c4cc2b43fdeb62fb600512c415b3'),
(94, 'Danny', 'Pitta', 'patient', 'dany@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'bdc549a1fdbeb8c2938093e70b015828'),
(95, 'ABC', 'XYZ', 'doctor', 'abc@abc.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '1f37b860f305cc03ec1bc46a193c2c9a'),
(96, 'anjali', 'devi', 'doctor', 'jyo@gmail.com', 'e99a18c428cb38d5f260853678922e03', 'Y', '97a9f0e0fe6cf234096a18115c0ece3e'),
(97, 'Peter', 'Williams', 'patient', 'Pet@medicall.com', 'e99a18c428cb38d5f260853678922e03', 'Y', 'f08a11966a7b5dcf708991ee670b8944'),
(98, 'vasanth', 'siva', 'patient', 'vasanthsiva143@gmail.com', '16f8a823ee0e0e15c5f3e874d8eed963', 'N', '4129da22ef30a9c4a5f8028cb0cf57cf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userEmail` varchar(60) NOT NULL,
  `userType` varchar(20) NOT NULL,
  `userPass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`CountryID`);

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
  MODIFY `AppointmentID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `cases`
--
ALTER TABLE `cases`
  MODIFY `CaseID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `CountryID` tinyint(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `doctab`
--
ALTER TABLE `doctab`
  MODIFY `DocID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `LangID` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `PlanID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `specility`
--
ALTER TABLE `specility`
  MODIFY `SpecilityID` tinyint(4) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
