-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2023 at 12:12 PM
-- Server version: 8.0.31
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Social_Impact_Register`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `admin_Name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_Email` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Charities`
--

CREATE TABLE `Charities` (
  `cse_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `cse_OrgName` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_SpoNeeded` bigint NOT NULL,
  `cse_Type` enum('Charity','Social Enterprise','Voluntary Group') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_YearFounded` year NOT NULL,
  `cse_RegisteredNo` bigint NOT NULL,
  `cse_SERNo` bigint NOT NULL,
  `cse_Regions` enum('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_Theme` enum('Youth Development','Community Development','Environment Development','') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_CurrentSupporters` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_AIncome` bigint NOT NULL,
  `cse_referer` bigint DEFAULT NULL,
  PRIMARY KEY (`cse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CSE_MainContactdetails`
--

CREATE TABLE `CSE_MainContactdetails` (
  `cmcd_id` bigint NOT NULL AUTO_INCREMENT,
  `cse_id` bigint NOT NULL,
  `cmcd_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_jtitle` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cse_address` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`cmcd_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CSE_ProjectDetail`
--

CREATE TABLE `CSE_ProjectDetail` (
  `pro_id` bigint NOT NULL AUTO_INCREMENT,
  `cse_id` bigint NOT NULL,
  `pro_Name` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_Purpose` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_KeyObjectives` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_StartYear` year NOT NULL,
  `pro_CollectData` tinyint(1) DEFAULT NULL,
  `pro_Impact` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_RequiredSponsorship` bigint NOT NULL,
  `pro_AdditionResourcesNeeded` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`pro_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `CSE_Socials`
--

CREATE TABLE `CSE_Socials` (
  `cs_id` bigint NOT NULL AUTO_INCREMENT,
  `cse_id` bigint NOT NULL,
  `cs_Facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_Instagram` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_Website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_logo` blob,
  PRIMARY KEY (`cs_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Enablers`
--

CREATE TABLE `Enablers` (
  `ena_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `ena_OrgName` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ena_ServiceType` enum('FRS','Lord Lieutenant','LGA','NHS Trust','Police','PCC') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ena_regions` enum('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ena_theme` enum('Youth Development','Community Development','Environment Development') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`ena_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Enabler_CommunicationContacts`
--

CREATE TABLE `ENA_HPRM` (
  `epr_id` bigint NOT NULL AUTO_INCREMENT,
  `ena_id` bigint NOT NULL,
  `epr_fName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL,
  `epr_lName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epr_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`epr_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
ALTER TABLE `ENA_HPRM`
  ADD KEY `ena_hprm_fk` (`ena_id`);
ALTER TABLE `ENA_HMAR`
  ADD KEY `ena_hmar_fk` (`ena_id`);
ALTER TABLE `ENA_HPRO`
  ADD KEY `ena_hpro_fk` (`ena_id`);

CREATE TABLE `ENA_HMAR` (
  `emr_id` bigint NOT NULL AUTO_INCREMENT,
  `ena_id` bigint NOT NULL,
  `emr_fName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL,
  `emr_lName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emr_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`emr_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
CREATE TABLE `ENA_HPRO` (
  `epro_id` bigint NOT NULL AUTO_INCREMENT,
  `ena_id` bigint NOT NULL,
  `epro_fName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci  DEFAULT NULL,
  `epro_lName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epro_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`epro_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


-- --------------------------------------------------------

--
-- Table structure for table `ENA_MainContactdetails`
--

CREATE TABLE `ENA_MainContactdetails` (
  `emcd_id` bigint NOT NULL AUTO_INCREMENT,
  `ena_id` bigint NOT NULL,
  `emcd_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emcd_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `emcd_Phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emcd_JobTitle` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ena_Confirmation` tinyint(1) NOT NULL,
  PRIMARY KEY (`emcd_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ENA_Socials`
--

CREATE TABLE `ENA_Socials` (
  `es_id` bigint NOT NULL AUTO_INCREMENT,
  `ena_id` bigint NOT NULL,
  `es_Facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `es_Instagram` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `es_Website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`es_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Sponsors`
--

CREATE TABLE `Sponsors` (
  `spo_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `spo_OrgName` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Address` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Registration` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_VatNumber` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Theme` enum('Youth Development','Community Development','Environment Development') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Regions` enum('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Referer` bigint DEFAULT NULL,
  `spo_FoundPluggin` enum('Public Sector','Search Engine','Reccomendation','Direct Mail') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`spo_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SPO_Accounts`
--

CREATE TABLE `SPO_Accounts` (
  `sa_id` bigint NOT NULL AUTO_INCREMENT,
  `spo_id` bigint NOT NULL,
  `sa_fName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sa_lName` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sa_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`sa_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SPO_MainContactdetails`
--

CREATE TABLE `SPO_MainContactdetails` (
  `smcd_id` bigint NOT NULL AUTO_INCREMENT,
  `spo_id` bigint NOT NULL,
  `smcd_Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smcd_Email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `smcd_Phone` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smcd_JobTitle` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `spo_OtherAccount` tinyint(1) NOT NULL,
  PRIMARY KEY (`smcd_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `SPO_Socials`
--

CREATE TABLE `SPO_Socials` (
  `sps_id` bigint NOT NULL AUTO_INCREMENT,
  `spo_id` bigint NOT NULL,
  `sps_Facebook` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sps_Instagram` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sps_Website` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sps_Linkedin` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`sps_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Unique_Identifiers`
--

CREATE TABLE `Unique_Identifiers` (
  `ui_id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `unique_id` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`ui_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` bigint NOT NULL AUTO_INCREMENT,
  `user_type` enum('admin','charity','sponsor','enabler') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `u_status` enum('approved','submitted') COLLATE utf8mb4_general_ci NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)

) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD KEY `admin_fk` (`user_id`);

--
-- Indexes for table `Charities`
--
ALTER TABLE `Charities`
  ADD KEY `charities_fk` (`user_id`);

--
-- Indexes for table `CSE_MainContactdetails`
--
ALTER TABLE `CSE_MainContactdetails`
  ADD KEY `cse_maincontactdetails_fk` (`cse_id`);

--
-- Indexes for table `CSE_ProjectDetail`
--
ALTER TABLE `CSE_ProjectDetail`
  ADD KEY `cse_projectdetail_fk` (`cse_id`);

--
-- Indexes for table `CSE_Socials`
--
ALTER TABLE `CSE_Socials`
  ADD KEY `cse_socials_fk` (`cse_id`);

--
-- Indexes for table `Enablers`
--
ALTER TABLE `Enablers`
  ADD KEY `enablers_fk` (`user_id`);

--
-- Indexes for table `Enabler_CommunicationContacts`
--
ALTER TABLE `Enabler_CommunicationContacts`
  ADD KEY `ena_communicationcontacts_fk` (`ena_id`);



--
-- Indexes for table `ENA_MainContactdetails`
--
ALTER TABLE `ENA_MainContactdetails`
  ADD KEY `ena_maincontactdetails_fk` (`ena_id`);

--
-- Indexes for table `ENA_Socials`
--
ALTER TABLE `ENA_Socials`
  ADD KEY `ena_socials_fk` (`ena_id`);

--
-- Indexes for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD KEY `sponsor_fk` (`user_id`);

--
-- Indexes for table `SPO_Accounts`
--
ALTER TABLE `SPO_Accounts`
  ADD KEY `spo_accounts_fk` (`spo_id`);

--
-- Indexes for table `SPO_MainContactdetails`
--
ALTER TABLE `SPO_MainContactdetails`
  ADD KEY `spo_maincontactdetails_fk` (`spo_id`);

--
-- Indexes for table `SPO_Socials`
--
ALTER TABLE `SPO_Socials`
  ADD KEY `spo_socials_fk` (`spo_id`);

--
-- Indexes for table `Unique_Identifiers`
--
ALTER TABLE `Unique_Identifiers`
  ADD KEY `unique_identifiers_fk` (`user_id`);

--

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Admin`
--
ALTER TABLE `Admin`
  ADD CONSTRAINT `admin_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Charities`
--
ALTER TABLE `Charities`
  ADD CONSTRAINT `charities_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CSE_MainContactdetails`
--
ALTER TABLE `CSE_MainContactdetails`
  ADD CONSTRAINT `cse_maincontactdetails_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CSE_ProjectDetail`
--
ALTER TABLE `CSE_ProjectDetail`
  ADD CONSTRAINT `cse_projectdetail_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `CSE_Socials`
--
ALTER TABLE `CSE_Socials`
  ADD CONSTRAINT `cse_socials_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Enablers`
--
ALTER TABLE `Enablers`
  ADD CONSTRAINT `enablers_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Enabler_CommunicationContacts`
--
ALTER TABLE `Enabler_CommunicationContacts`
  ADD CONSTRAINT `ena_communicationcontacts_fk` FOREIGN KEY (`ena_id`) REFERENCES `Enablers` (`ena_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ENA_MainContactdetails`
--
ALTER TABLE `ENA_MainContactdetails`
  ADD CONSTRAINT `ena_maincontactdetails_fk` FOREIGN KEY (`ena_id`) REFERENCES `Enablers` (`ena_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ENA_Socials`
--
ALTER TABLE `ENA_Socials`
  ADD CONSTRAINT `ena_socials_fk` FOREIGN KEY (`ena_id`) REFERENCES `Enablers` (`ena_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD CONSTRAINT `sponsor_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SPO_Accounts`
--
ALTER TABLE `SPO_Accounts`
  ADD CONSTRAINT `spo_accounts_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SPO_MainContactdetails`
--
ALTER TABLE `SPO_MainContactdetails`
  ADD CONSTRAINT `spo_maincontactdetails_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `SPO_Socials`
--
ALTER TABLE `SPO_Socials`
  ADD CONSTRAINT `spo_socials_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `Unique_Identifiers`
--
ALTER TABLE `Unique_Identifiers`
  ADD CONSTRAINT `unique_identifiers_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
