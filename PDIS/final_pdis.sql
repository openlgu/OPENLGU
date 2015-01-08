-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2015 at 06:39 AM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `final pdis`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE IF NOT EXISTS `tbl_request` (
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `service` varchar(100) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) NOT NULL,
  `mailing_address` text NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `company_name` varchar(300) DEFAULT NULL,
  `company_address` text,
  `designation` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '4',
  `remarks` text,
  PRIMARY KEY (`code`,`service`),
  KEY `fk_tbl_request_tbl_service_service_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`code`, `service`, `first_name`, `middle_name`, `last_name`, `mailing_address`, `email`, `company_name`, `company_address`, `designation`, `status`, `remarks`) VALUES
('4GERp1PCBx', 'Information Extension Service', 'Princess Maria Urduja', 'Vinoya', 'Torres', 'sdffsfs', 'email@email.com', 'University of the Philippines Los Banos', 'dasd', '', 0, ''),
('cDn2KutfQT', 'Zoning/Locational Clearance', 'Briar Rose', 'Baldoza', 'Nuestro', 'Los Banos, Laguna', 'brnuestro@gmail.com', '', '', '', 4, NULL),
('hA0E3c41o6', 'Site Zoning Classification', 'Briar Rose', 'Baldoza', 'Nuestro', 'Laguna', 'brnuestro@gmail.com', '', '', '', 4, NULL),
('PlOFbejcCh', 'Site Zoning Classification', 'Briar Rose', 'Baldoza', 'Nuestro', 'Blk. 15 Lot 1, Carissa 3A, Palmera Kaypian, City of San Jose del Monte, Bulacan', 'brnuestro@gmail.com', '', '', '', 4, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_fees_checklist`
--

CREATE TABLE IF NOT EXISTS `tbl_request_fees_checklist` (
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `service` varchar(100) NOT NULL,
  `_number` int(11) NOT NULL,
  `accomplished` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`,`service`,`_number`),
  KEY `fk_tbl_request_fees_checklist_code_idx` (`code`),
  KEY `fk_tbl_request_fees_checklist_service_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request_fees_checklist`
--

INSERT INTO `tbl_request_fees_checklist` (`code`, `service`, `_number`, `accomplished`) VALUES
('cDn2KutfQT', 'Zoning/Locational Clearance', 0, '0'),
('cDn2KutfQT', 'Zoning/Locational Clearance', 1, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 0, '0'),
('PlOFbejcCh', 'Site Zoning Classification', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_files`
--

CREATE TABLE IF NOT EXISTS `tbl_request_files` (
  `service` varchar(100) NOT NULL,
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `filename` varchar(200) NOT NULL,
  `_number` int(11) NOT NULL,
  `extension` varchar(5) NOT NULL,
  PRIMARY KEY (`service`,`code`,`filename`,`extension`),
  KEY `fk_tbl_request_files_code_idx` (`code`),
  KEY `fk_tbl_request_files_service_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request_files`
--

INSERT INTO `tbl_request_files` (`service`, `code`, `filename`, `_number`, `extension`) VALUES
('Site Zoning Classification', 'hA0E3c41o6', 'SP', 0, 'docx'),
('Site Zoning Classification', 'PlOFbejcCh', 'filipino-food-calorie-2', 3, 'jpg'),
('Site Zoning Classification', 'PlOFbejcCh', 'Greetings my friend', 1, 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request_requirements_checklist`
--

CREATE TABLE IF NOT EXISTS `tbl_request_requirements_checklist` (
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `service` varchar(100) NOT NULL,
  `_number` int(11) NOT NULL,
  `accomplished` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`code`,`service`,`_number`),
  KEY `fk_tbl_request_requirements_checklist_code_idx` (`code`),
  KEY `fk_tbl_request_requirements_checklist_service_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_request_requirements_checklist`
--

INSERT INTO `tbl_request_requirements_checklist` (`code`, `service`, `_number`, `accomplished`) VALUES
('4GERp1PCBx', 'Information Extension Service', 0, '0'),
('cDn2KutfQT', 'Zoning/Locational Clearance', 0, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 0, '1'),
('hA0E3c41o6', 'Site Zoning Classification', 1, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 2, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 3, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 4, '0'),
('hA0E3c41o6', 'Site Zoning Classification', 5, '0'),
('PlOFbejcCh', 'Site Zoning Classification', 0, '0'),
('PlOFbejcCh', 'Site Zoning Classification', 1, '1'),
('PlOFbejcCh', 'Site Zoning Classification', 2, '0'),
('PlOFbejcCh', 'Site Zoning Classification', 3, '1'),
('PlOFbejcCh', 'Site Zoning Classification', 4, '0'),
('PlOFbejcCh', 'Site Zoning Classification', 5, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service`
--

CREATE TABLE IF NOT EXISTS `tbl_service` (
  `service` varchar(100) NOT NULL,
  `title` varchar(300) NOT NULL,
  `availability` text NOT NULL,
  `customers` text NOT NULL,
  PRIMARY KEY (`service`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service`
--

INSERT INTO `tbl_service` (`service`, `title`, `availability`, `customers`) VALUES
('Information Extension Service', 'Information Extension Service', 'Monday to Friday (8:00 am - 5:00 pm)', 'National Government Agencies/ Barangays/ Civil Society Organizations/ Students'),
('Preparation of Plans and Programs of Work', 'Preparation of Plans and Programs of Work', 'Monday to Friday (8:00 am - 5:00 pm)', 'Barangay and other Municipal Offices'),
('Site Zoning Classification', 'Issuance of Certificate of Site Zoning Classification', 'Monday to Friday (8:00 am - 5:00 pm)', 'Land Owners'),
('Zoning/Locational Clearance', 'Issuance of Zoning/ Locational Clearance for Business Permits', 'Monday to Friday (8:00 am - 5:00 pm)', 'Prospective Business Establishment Owners');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_fees`
--

CREATE TABLE IF NOT EXISTS `tbl_service_fees` (
  `service` varchar(100) NOT NULL,
  `fee` varchar(300) NOT NULL,
  `_number` int(11) NOT NULL,
  PRIMARY KEY (`service`,`fee`),
  KEY `fk_tbl_service_fees_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_fees`
--

INSERT INTO `tbl_service_fees` (`service`, `fee`, `_number`) VALUES
('Site Zoning Classification', 'Certification Fee of 50.00 for less than 2,500 sq.m or P0.02 for more than 2,500 sq.m', 0),
('Zoning/Locational Clearance', 'Locational Clearance Fee - based on Municipal Ordinance No. 2009 -\n	enancted December 14, 2009', 0),
('Zoning/Locational Clearance', 'Zoning Clearance Fee - based on HLURB revised schedule of fees,\n	HLURB Administrative Order No. 02, series of 2004, May 17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_forms`
--

CREATE TABLE IF NOT EXISTS `tbl_service_forms` (
  `service` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `extension` varchar(5) NOT NULL,
  `isonline` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service`,`name`),
  KEY `fk_tbl_service_forms_service_idx` (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_forms`
--

INSERT INTO `tbl_service_forms` (`service`, `name`, `filename`, `extension`, `isonline`) VALUES
('Zoning/Locational Clearance', 'Business License Application Form', 'Business License Application Form', '.pdf', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_service_requirements`
--

CREATE TABLE IF NOT EXISTS `tbl_service_requirements` (
  `service` varchar(100) NOT NULL,
  `requirement` varchar(300) NOT NULL,
  `_number` int(11) NOT NULL,
  `optional` binary(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`service`,`requirement`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_service_requirements`
--

INSERT INTO `tbl_service_requirements` (`service`, `requirement`, `_number`, `optional`) VALUES
('Information Extension Service', 'Request letter', 0, '1'),
('Preparation of Plans and Programs of Work', 'Request letter indicating the service needed', 0, '0'),
('Site Zoning Classification', 'Certificate of Real Property Tax payment', 4, '0'),
('Site Zoning Classification', 'Letter-request addressed to the MPDC/Deputized Zoning Coordinator', 0, '0'),
('Site Zoning Classification', 'Lot Plan with vicinity map drawn to scale signed by a Geodetic Engineer', 1, '0'),
('Site Zoning Classification', 'Real Property Tax Declaration', 3, '0'),
('Site Zoning Classification', 'Special Power Attorney and land owner''s authorized representative, if any', 5, '0'),
('Site Zoning Classification', 'Transfer Certificate of Title (TCT) of Deed of Sale', 2, '0'),
('Zoning/Locational Clearance', 'Business License Application/ Assesment Form', 0, '0');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_account`
--

CREATE TABLE IF NOT EXISTS `tbl_user_account` (
  `employee_number` varchar(11) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(45) NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) NOT NULL,
  `designation` varchar(45) NOT NULL,
  `sex` int(1) NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`employee_number`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_account`
--

INSERT INTO `tbl_user_account` (`employee_number`, `username`, `password`, `email`, `first_name`, `middle_name`, `last_name`, `designation`, `sex`, `role`) VALUES
('12345678902', 'brbnuestro', '1b7b57e6ff5110974020e580460ba57ad49b15e8a85c79dcea7a2bbcf72eec58', 'brnuestro@gmail.com', 'Briar Rose', 'Baldoza', 'Nuestro', 'designation', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_account_administers_tbl_request`
--

CREATE TABLE IF NOT EXISTS `tbl_user_account_administers_tbl_request` (
  `employee_number` varchar(11) NOT NULL,
  `code` varchar(45) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `service` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`employee_number`,`code`,`service`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD CONSTRAINT `fk_tbl_request_tbl_service_service` FOREIGN KEY (`service`) REFERENCES `tbl_service` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_request_fees_checklist`
--
ALTER TABLE `tbl_request_fees_checklist`
  ADD CONSTRAINT `fk_tbl_request_fees_checklist_code` FOREIGN KEY (`code`) REFERENCES `tbl_request` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_request_fees_checklist_service` FOREIGN KEY (`service`) REFERENCES `tbl_request` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_request_files`
--
ALTER TABLE `tbl_request_files`
  ADD CONSTRAINT `fk_tbl_request_files_code` FOREIGN KEY (`code`) REFERENCES `tbl_request` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_request_files_service` FOREIGN KEY (`service`) REFERENCES `tbl_request` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_request_requirements_checklist`
--
ALTER TABLE `tbl_request_requirements_checklist`
  ADD CONSTRAINT `fk_tbl_request_requirements_checklist_code` FOREIGN KEY (`code`) REFERENCES `tbl_request` (`code`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_tbl_request_requirements_checklist_service` FOREIGN KEY (`service`) REFERENCES `tbl_request` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_service_fees`
--
ALTER TABLE `tbl_service_fees`
  ADD CONSTRAINT `fk_tbl_service_fees` FOREIGN KEY (`service`) REFERENCES `tbl_service` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_service_forms`
--
ALTER TABLE `tbl_service_forms`
  ADD CONSTRAINT `fk_tbl_service_forms_service` FOREIGN KEY (`service`) REFERENCES `tbl_service` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `tbl_service_requirements`
--
ALTER TABLE `tbl_service_requirements`
  ADD CONSTRAINT `fk_tbl_service_requirements` FOREIGN KEY (`service`) REFERENCES `tbl_service` (`service`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
