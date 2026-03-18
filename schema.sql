-- MySQL dump 10.19  Distrib 10.3.39-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: Social_Impact_Register
-- ------------------------------------------------------
-- Server version	10.3.39-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admin` (
  `admin_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `admin_Name` varchar(500) NOT NULL,
  `admin_Email` varchar(500) NOT NULL,
  PRIMARY KEY (`admin_id`),
  KEY `admin_fk` (`user_id`),
  CONSTRAINT `admin_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSE_MainContactdetails`
--

DROP TABLE IF EXISTS `CSE_MainContactdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSE_MainContactdetails` (
  `cmcd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cse_id` bigint(20) NOT NULL,
  `cmcd_name` varchar(100) NOT NULL,
  `cmcd_email` varchar(100) NOT NULL,
  `cmcd_phone` varchar(100) NOT NULL,
  `cmcd_jtitle` varchar(500) NOT NULL,
  `cse_address` varchar(1000) NOT NULL,
  PRIMARY KEY (`cmcd_id`),
  KEY `cse_maincontactdetails_fk` (`cse_id`),
  CONSTRAINT `cse_maincontactdetails_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSE_MainContactdetails`
--

LOCK TABLES `CSE_MainContactdetails` WRITE;
/*!40000 ALTER TABLE `CSE_MainContactdetails` DISABLE KEYS */;
INSERT INTO `CSE_MainContactdetails` VALUES (9,17,'adsfa asdfass','ads@email.com','0800','job','al;j daslfj lewe kkj le2 6dg'),(10,18,'Umar Riaz','umarriaz@gmail.com','090061500','Job Title','111 Heather Road Leicester Leicester Leicestershire le2 6DG'),(11,19,'Umar Riaz','umar@email.com','090078601','Job Title','111 Heather Road Leicester Leicester Leicestershire LE2 6DG'),(12,20,'mcfName mclName','mc@email.com','090078601','MC Job Title','First line of address City County P23 C32 ');
/*!40000 ALTER TABLE `CSE_MainContactdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSE_ProjectDetail`
--

DROP TABLE IF EXISTS `CSE_ProjectDetail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSE_ProjectDetail` (
  `pro_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cse_id` bigint(20) NOT NULL,
  `pro_Name` varchar(500) NOT NULL,
  `pro_Purpose` varchar(500) NOT NULL,
  `pro_KeyObjectives` varchar(500) NOT NULL,
  `pro_StartYear` year(4) NOT NULL,
  `pro_CollectData` tinyint(1) DEFAULT NULL,
  `pro_Impact` varchar(1000) DEFAULT NULL,
  `pro_RequiredSponsorship` bigint(20) NOT NULL,
  `pro_AdditionResourcesNeeded` varchar(1000) NOT NULL,
  PRIMARY KEY (`pro_id`),
  KEY `cse_projectdetail_fk` (`cse_id`),
  CONSTRAINT `cse_projectdetail_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSE_ProjectDetail`
--

LOCK TABLES `CSE_ProjectDetail` WRITE;
/*!40000 ALTER TABLE `CSE_ProjectDetail` DISABLE KEYS */;
INSERT INTO `CSE_ProjectDetail` VALUES (8,17,'Name of the project','adsf','k hdfak ',1995,NULL,'0',13,'dsa'),(9,18,'Project Name ','ajsdfjadhkf kashflksdhf as adsflakhdfklah ','kdhfkah, akha fhakhfkasdfh a, hkadshfa khfa, hasdkfha fakhd,',1950,NULL,'0',31,'hklashdf akhdfkahdf klahd'),(10,19,'Name of the Project','Brief description of the impact project has','objective1 , objective2 , objective3',1950,NULL,'1',8500,'Brief details of Resources needed'),(11,20,'Project Name','Impact the project had please be brief','Objectives1 , Objective2 , Objective3',2000,NULL,'1',350000,'Additinal Resources Needed');
/*!40000 ALTER TABLE `CSE_ProjectDetail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CSE_Socials`
--

DROP TABLE IF EXISTS `CSE_Socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CSE_Socials` (
  `cs_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `cse_id` bigint(20) NOT NULL,
  `cs_Facebook` varchar(100) DEFAULT NULL,
  `cs_Instagram` varchar(100) DEFAULT NULL,
  `cs_Website` varchar(100) DEFAULT NULL,
  `cs_logo` blob DEFAULT NULL,
  PRIMARY KEY (`cs_id`),
  KEY `cse_socials_fk` (`cse_id`),
  CONSTRAINT `cse_socials_fk` FOREIGN KEY (`cse_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CSE_Socials`
--

LOCK TABLES `CSE_Socials` WRITE;
/*!40000 ALTER TABLE `CSE_Socials` DISABLE KEYS */;
INSERT INTO `CSE_Socials` VALUES (8,17,'','','',NULL),(9,18,'','','',NULL),(10,19,'','','',NULL),(11,20,'https://www.facebook.com','https://www.instagram.com','https://www.example.com',NULL);
/*!40000 ALTER TABLE `CSE_Socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Charities`
--

DROP TABLE IF EXISTS `Charities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Charities` (
  `cse_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `cse_OrgName` varchar(500) NOT NULL,
  `cse_Type` enum('Charity','Social Enterprise','Voluntary Group') NOT NULL,
  `cse_YearFounded` year(4) NOT NULL,
  `cse_RegisteredNo` bigint(20) NOT NULL,
  `cse_SERNo` bigint(20) NOT NULL,
  `cse_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') NOT NULL,
  `cse_Theme` enum('Youth Development','Community Development','Environment Development','') NOT NULL,
  `cse_CurrentSupporters` text NOT NULL,
  `cse_AIncome` bigint(20) NOT NULL,
  `cse_referer` bigint(20) DEFAULT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`cse_id`),
  KEY `charities_fk` (`user_id`),
  CONSTRAINT `charities_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Charities`
--

LOCK TABLES `Charities` WRITE;
/*!40000 ALTER TABLE `Charities` DISABLE KEYS */;
INSERT INTO `Charities` VALUES (17,105,'CSE Name','',1986,0,0,'','Youth Development','aoj',41,0,0),(18,107,'CSE Name','',1950,0,0,'','Community Development','aa;bb;cc;dd;ee;ff;gg;hh;jj;kk;ll;mm;',95000,0,0),(19,111,'CSE Name','Social Enterprise',1958,0,0,'London,North West,South East','Community Development','cr1;cr2;cr3;',150000,0,0),(20,117,'CSE Name Here ','',1958,0,0,'East of England,North East,South East','Environment Development','cs1;cs2;cs3;',25000,0,0);
/*!40000 ALTER TABLE `Charities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENA_HMAR`
--

DROP TABLE IF EXISTS `ENA_HMAR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENA_HMAR` (
  `emr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ena_id` bigint(20) NOT NULL,
  `emr_fName` varchar(100) DEFAULT NULL,
  `emr_lName` varchar(100) DEFAULT NULL,
  `emr_Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`emr_id`),
  KEY `ena_hmar_fk` (`ena_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENA_HMAR`
--

LOCK TABLES `ENA_HMAR` WRITE;
/*!40000 ALTER TABLE `ENA_HMAR` DISABLE KEYS */;
INSERT INTO `ENA_HMAR` VALUES (3,3,'Umar','RIaz','uma1@email.com'),(4,4,'hmarfname','hmarlname','hmar@email.com'),(5,5,'Sam','worth','sw@enaOrg.com');
/*!40000 ALTER TABLE `ENA_HMAR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENA_HPRM`
--

DROP TABLE IF EXISTS `ENA_HPRM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENA_HPRM` (
  `epr_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ena_id` bigint(20) NOT NULL,
  `epr_fName` varchar(100) DEFAULT NULL,
  `epr_lName` varchar(100) DEFAULT NULL,
  `epr_Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`epr_id`),
  KEY `ena_hprm_fk` (`ena_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENA_HPRM`
--

LOCK TABLES `ENA_HPRM` WRITE;
/*!40000 ALTER TABLE `ENA_HPRM` DISABLE KEYS */;
INSERT INTO `ENA_HPRM` VALUES (3,3,'Umar',NULL,NULL),(4,4,'hprmfname',NULL,NULL),(5,5,'Aly',NULL,NULL);
/*!40000 ALTER TABLE `ENA_HPRM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENA_HPRO`
--

DROP TABLE IF EXISTS `ENA_HPRO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENA_HPRO` (
  `epro_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ena_id` bigint(20) NOT NULL,
  `epro_fName` varchar(100) DEFAULT NULL,
  `epro_lName` varchar(100) DEFAULT NULL,
  `epro_Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`epro_id`),
  KEY `ena_hpro_fk` (`ena_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENA_HPRO`
--

LOCK TABLES `ENA_HPRO` WRITE;
/*!40000 ALTER TABLE `ENA_HPRO` DISABLE KEYS */;
INSERT INTO `ENA_HPRO` VALUES (3,3,'Umar','Riaz','umar3@email.com'),(4,4,'hmarfname','hplname','hp@email.com'),(5,5,'Sam','Dep','jd@enaOrg.com');
/*!40000 ALTER TABLE `ENA_HPRO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENA_MainContactdetails`
--

DROP TABLE IF EXISTS `ENA_MainContactdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENA_MainContactdetails` (
  `emcd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ena_id` bigint(20) NOT NULL,
  `emcd_Name` varchar(100) NOT NULL,
  `emcd_Email` varchar(100) NOT NULL,
  `emcd_Phone` varchar(100) DEFAULT NULL,
  `emcd_JobTitle` varchar(250) NOT NULL,
  `ena_Confirmation` tinyint(1) NOT NULL,
  PRIMARY KEY (`emcd_id`),
  KEY `ena_maincontactdetails_fk` (`ena_id`),
  CONSTRAINT `ena_maincontactdetails_fk` FOREIGN KEY (`ena_id`) REFERENCES `Enablers` (`ena_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENA_MainContactdetails`
--

LOCK TABLES `ENA_MainContactdetails` WRITE;
/*!40000 ALTER TABLE `ENA_MainContactdetails` DISABLE KEYS */;
INSERT INTO `ENA_MainContactdetails` VALUES (3,5,'enmcf Name enmcl Name','ene@mail.com','090078601','Testing',1),(4,6,'mcFname mcLname','mc@email.com','090078601','JobTitle',1),(5,7,'Jacob Shah','jsh@enaOrg.com','0900','JobTitle',1);
/*!40000 ALTER TABLE `ENA_MainContactdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ENA_Socials`
--

DROP TABLE IF EXISTS `ENA_Socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ENA_Socials` (
  `es_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ena_id` bigint(20) NOT NULL,
  `es_Facebook` varchar(100) DEFAULT NULL,
  `es_Instagram` varchar(100) DEFAULT NULL,
  `es_Website` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`es_id`),
  KEY `ena_socials_fk` (`ena_id`),
  CONSTRAINT `ena_socials_fk` FOREIGN KEY (`ena_id`) REFERENCES `Enablers` (`ena_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ENA_Socials`
--

LOCK TABLES `ENA_Socials` WRITE;
/*!40000 ALTER TABLE `ENA_Socials` DISABLE KEYS */;
INSERT INTO `ENA_Socials` VALUES (3,5,'https://www.facebook.com',NULL,NULL),(4,6,'https://www.example.com',NULL,NULL),(5,7,'https://www.facebook.com/ena321',NULL,NULL);
/*!40000 ALTER TABLE `ENA_Socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Enablers`
--

DROP TABLE IF EXISTS `Enablers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Enablers` (
  `ena_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `ena_OrgName` varchar(500) NOT NULL,
  `ena_ServiceType` enum('FRS','Lord Lieutenant','LGA','NHS Trust','Police','PCC') NOT NULL,
  `ena_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') NOT NULL,
  `ena_theme` enum('Youth Development','Community Development','Environment Development') NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`ena_id`),
  KEY `enablers_fk` (`user_id`),
  CONSTRAINT `enablers_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Enablers`
--

LOCK TABLES `Enablers` WRITE;
/*!40000 ALTER TABLE `Enablers` DISABLE KEYS */;
INSERT INTO `Enablers` VALUES (5,101,'Enabler OrgName','Lord Lieutenant','','Youth Development',0),(6,118,'ORG Name','NHS Trust','London,North East,North West','Community Development',0),(7,119,'Enabler Name','FRS','East of England,London,North East','Environment Development',0);
/*!40000 ALTER TABLE `Enablers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SPO_Accounts`
--

DROP TABLE IF EXISTS `SPO_Accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SPO_Accounts` (
  `sa_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `spo_id` bigint(20) NOT NULL,
  `sa_fName` varchar(100) DEFAULT NULL,
  `sa_lName` varchar(100) DEFAULT NULL,
  `sa_Email` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sa_id`),
  KEY `spo_accounts_fk` (`spo_id`),
  CONSTRAINT `spo_accounts_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SPO_Accounts`
--

LOCK TABLES `SPO_Accounts` WRITE;
/*!40000 ALTER TABLE `SPO_Accounts` DISABLE KEYS */;
INSERT INTO `SPO_Accounts` VALUES (10,10,'fname','lname','email@rm.com'),(11,11,'aCFName','aCLName','ac@email.com');
/*!40000 ALTER TABLE `SPO_Accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SPO_MainContactdetails`
--

DROP TABLE IF EXISTS `SPO_MainContactdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SPO_MainContactdetails` (
  `smcd_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `spo_id` bigint(20) NOT NULL,
  `smcd_Name` varchar(100) NOT NULL,
  `smcd_Email` varchar(100) NOT NULL,
  `smcd_Phone` varchar(100) DEFAULT NULL,
  `smcd_JobTitle` varchar(250) NOT NULL,
  `spo_OtherAccount` tinyint(1) NOT NULL,
  PRIMARY KEY (`smcd_id`),
  KEY `spo_maincontactdetails_fk` (`spo_id`),
  CONSTRAINT `spo_maincontactdetails_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SPO_MainContactdetails`
--

LOCK TABLES `SPO_MainContactdetails` WRITE;
/*!40000 ALTER TABLE `SPO_MainContactdetails` DISABLE KEYS */;
INSERT INTO `SPO_MainContactdetails` VALUES (10,10,'fName lName','umar@umar.gmail.com','090078601','JobTitle',0),(11,11,'FNAme LName','sp@email.com','090078601','JobTitle',1);
/*!40000 ALTER TABLE `SPO_MainContactdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SPO_Socials`
--

DROP TABLE IF EXISTS `SPO_Socials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SPO_Socials` (
  `sps_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `spo_id` bigint(20) NOT NULL,
  `sps_Facebook` varchar(100) DEFAULT NULL,
  `sps_Instagram` varchar(100) DEFAULT NULL,
  `sps_Website` varchar(100) NOT NULL,
  `sps_Linkedin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`sps_id`),
  KEY `spo_socials_fk` (`spo_id`),
  CONSTRAINT `spo_socials_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SPO_Socials`
--

LOCK TABLES `SPO_Socials` WRITE;
/*!40000 ALTER TABLE `SPO_Socials` DISABLE KEYS */;
INSERT INTO `SPO_Socials` VALUES (10,10,'','','https://www.e.com',''),(11,11,'https://www.facebool.com','https://www.instagram.com','https://www.example.com','https://linken.com');
/*!40000 ALTER TABLE `SPO_Socials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Sponsors`
--

DROP TABLE IF EXISTS `Sponsors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Sponsors` (
  `spo_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `spo_OrgName` varchar(500) NOT NULL,
  `spo_Address` varchar(500) NOT NULL,
  `spo_Registration` varchar(250) NOT NULL,
  `spo_VatNumber` varchar(250) NOT NULL,
  `spo_Theme` enum('Youth Development','Community Development','Environment Development') NOT NULL,
  `spo_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') NOT NULL,
  `spo_Referer` varchar(500) NOT NULL,
  `spo_FoundPluggin` enum('Public Sector','Search Engine','Reccomendation','Direct Mail') NOT NULL,
  `approved` tinyint(1) NOT NULL,
  PRIMARY KEY (`spo_id`),
  KEY `sponsor_fk` (`user_id`),
  CONSTRAINT `sponsor_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Sponsors`
--

LOCK TABLES `Sponsors` WRITE;
/*!40000 ALTER TABLE `Sponsors` DISABLE KEYS */;
INSERT INTO `Sponsors` VALUES (10,115,'Spo Name','DDeadflj Derby Derbishire LE2 6DG','East Midlands,London,North East','Vat321123','Youth Development','East Midlands,London,North East','ref123','Public Sector',0),(11,116,'Sponsor Organisation Name here','Sponsor street Address City goes here county here SP12 O32','Reg321123123','vat123321123','Community Development','East Midlands,East of England,North East','ena123321123','Reccomendation',0);
/*!40000 ALTER TABLE `Sponsors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Unique_Identifiers`
--

DROP TABLE IF EXISTS `Unique_Identifiers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Unique_Identifiers` (
  `ui_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `unique_id` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`ui_id`),
  KEY `unique_identifiers_fk` (`user_id`),
  CONSTRAINT `unique_identifiers_fk` FOREIGN KEY (`user_id`) REFERENCES `Users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Unique_Identifiers`
--

LOCK TABLES `Unique_Identifiers` WRITE;
/*!40000 ALTER TABLE `Unique_Identifiers` DISABLE KEYS */;
/*!40000 ALTER TABLE `Unique_Identifiers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `user_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_type` enum('admin','charity','sponsor','enabler') NOT NULL,
  `u_status` enum('approved','submitted') NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=120 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (99,'enabler','submitted','2023-10-06 16:35:01'),(100,'enabler','submitted','2023-10-06 16:50:19'),(101,'enabler','submitted','2023-10-06 17:03:26'),(102,'charity','submitted','2023-10-09 12:59:46'),(103,'charity','submitted','2023-10-09 13:00:06'),(104,'charity','submitted','2023-10-09 13:00:21'),(105,'charity','submitted','2023-10-09 13:05:13'),(106,'charity','submitted','2023-10-09 13:24:28'),(107,'charity','submitted','2023-10-09 14:00:29'),(108,'charity','submitted','2023-10-09 15:46:28'),(109,'charity','submitted','2023-10-09 15:51:59'),(110,'charity','submitted','2023-10-09 15:52:36'),(111,'charity','submitted','2023-10-09 15:53:16'),(112,'sponsor','submitted','2023-10-09 16:49:58'),(113,'sponsor','submitted','2023-10-09 16:50:22'),(114,'sponsor','submitted','2023-10-09 17:03:02'),(115,'sponsor','submitted','2023-10-09 17:04:20'),(116,'sponsor','submitted','2023-10-10 11:08:21'),(117,'charity','submitted','2023-10-10 14:54:58'),(118,'enabler','submitted','2023-10-10 16:27:00'),(119,'enabler','submitted','2023-10-10 19:52:14');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-10 21:05:12
