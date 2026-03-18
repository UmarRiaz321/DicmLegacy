-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 09, 2025 at 08:20 PM
-- Server version: 8.0.41-32
-- PHP Version: 8.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db3gnqvumanxmc`
--

-- --------------------------------------------------------

--
-- Table structure for table `Admin`
--

CREATE TABLE `Admin` (
  `admin_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `admin_Name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `admin_Email` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `Charities`
--

CREATE TABLE `Charities` (
  `cse_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `cse_OrgName` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `cse_YearFounded` year NOT NULL,
  `cse_RegisteredNo` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `cse_SERNo` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `cse_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') COLLATE utf8mb4_general_ci NOT NULL,
  `cse_CurrentSupporters` text COLLATE utf8mb4_general_ci NOT NULL,
  `cse_AIncome` bigint NOT NULL,
  `cse_referer` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Charities`
--

INSERT INTO `Charities` (`cse_id`, `user_id`, `cse_OrgName`, `cse_YearFounded`, `cse_RegisteredNo`, `cse_SERNo`, `cse_Regions`, `cse_CurrentSupporters`, `cse_AIncome`, `cse_referer`, `approved`) VALUES
(56, 170, 'Always An Alternative', '2022', '1201213', 'Not Registered with Companies House', 'Yorks and Humber', 'Current Support Required;', 150000, 'No Enabler', 1),
(57, 171, 'Reach for Health Centres', '2010', '1138302', '07263077', 'East Midlands', 'None;', 355000, '', 1),
(58, 172, 'PLYMOUTH ARGYLE FOOTBALL IN THE COMMUNITY TRUST', '2009', '1128906', 'n/a', 'South West', 'Premier League Foundation Trust;', 4400000, '', 1),
(59, 173, 'Elite Community Hub CIC', '2020', 'n/a', '13049432', 'North West', 'Greater Manchester Police;Bolton Council;', 75000, '', 1),
(60, 176, 'Boxing Clever MK', '2022', 'n/a', '13933003', 'East Midlands,South East', 'England Boxing;MK Community Foundation;Sport England;Leap;Hargreaves Foundation;Sport MK;Warburtons Foundation;', 28000, '', 1),
(62, 178, 'Twyford District Youth & Community Centre', '2008', '1155243', 'Not Registered with Companies House', 'South East', 'Berkshire Youth;National Youth Agency;Twyford Parish Council;', 30000, 'N/A', 1),
(63, 179, 'Together As One', '1998', '1090077', '4335784', 'South East', 'Thames Valley Violence Reduction Unit;Slough Children First;street games;', 339000, 'Thames Valley Violence Reduction Unit', 1),
(64, 180, 'Think F.A.S.T Academy', '2021', 'Not on the Charities Register', '13451527', 'North West', 'Project Medusa;', 45000, 'N/A', 1),
(65, 181, 'The Wildheart Foundation', '2023', 'Not on the Charities Register', 'Not Registered with Companies House', 'East Midlands,East of England,North East,North West,South East,South West,West Midlands,Yorks and Humber', 'Local authorities;', 100000, 'N/A', 1),
(66, 182, 'The Project PT', '2022', 'Not on the Charities Register', '14547066', 'South East', 'Thames Valley Violence Reduction Unit;Oxford City Council Schools;Oxford City Council;Active Oxfordshire;Open Schools Facilities;', 200000, 'N/A', 1),
(67, 185, 'Berkshire Youth', '1940', '1106341', 'n/a', 'South East', 'OPCC Thames Valley;Berkshire County Council;', 900000, '', 1),
(70, 188, 'The Silent Disco Project CIC ', '2025', 'N/A ', '16268489', 'East Midlands,West Midlands', 'Spring Social Prescribing;Avery Care Homes;Kingsley Care Homes;Age UK Northamptonshire;', 0, '', 1),
(72, 191, 'The Lewis Foundation', '2016', '1166405', 'CE006157', 'East Midlands,East of England,South East', 'West Northamptonshire Council - Rent for Charity Premises;will end June 2023\r\n\r\nBusinesses currently supporting us in the community with event costs;donate stock and/or fundraising as Charity of the Year:\r\n\r\nSol Retail - Northampton;Bechtle;Unimed Procurement Services;Sunbelt Rentals;Michael Jones Jewellers;CommSave;Borneo Martell Turner Coulston Solicitors;', 177003, '', 1),
(73, 192, 'The JJeffect CIC', '2021', 'Not on the Charities Register', '13077589', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber', 'Schools;police;children homes;education organisations;', 80000, '', 1),
(74, 193, 'The BERG F', '2022', 'Not on the Charities Register', '14339817', 'East Midlands', 'We are a start-up Research House for the NHS community.;', 0, '', 1),
(75, 194, 'Teach Outdoors', '2015', 'Not on the Charities Register', '9393393', 'East Midlands,South East', 'Supported by Northampton University Changemaker Incubator Hub.;', 20000, '', 1),
(77, 196, 'Starting Point (part of The Mustard Tree Foundation, Reading)', '2004', '1104631', '4986086', 'South East', 'Thames Valley Police VRU;Reading Borough Counci;Brighter Futures for Children;', 400000, '235358735', 1),
(78, 197, 'SOFEA', '2013', '1155783', 'Not Registered with Companies House', 'South East', 'Local authorities;trusts and foundations;corporate partners;local enterprise partnerships;Thames Valley Police;large education providers;', 2000000, '235358735', 1),
(79, 198, 'Shrewsbury and Oswestry Crucial Crew', '2008', '1125144', 'Not Registered with Companies House', 'West Midlands', 'West Mercia Police;', 22000, '', 1),
(80, 199, 'SAFE!', '2011', '1143532', '7630170', 'South East', 'Thames Valley Police and Crime Commissioner;The National Lottery;BBC Children in Need;The Ministry of Justice;Buckinghamshire County Council;Charles Haywood Foundation;', 1000000, '235358735', 1),
(81, 200, 'Riverside Education', '2015', 'Not on the Charities Register', '8383146', 'West Midlands', 'N/A - Self funded;', 40000, '', 1),
(82, 201, 'Ride High', '2008', '1138260', '7363597', 'South East', 'National Lottery;Community Fund;Postcode Society Trust;L&Q Foundation;Masonic Charitable Foundation;Hargreaves Foundation;Children in Need;Co-op Foundation;Milton Keynes Community Foundation;', 572888, '', 1),
(83, 202, 'Raising a Wild Child', '2021', 'Not on the Charities Register', '12617691', 'Yorks and Humber', 'Local authorities;school and families;', 80000, '', 1),
(84, 203, 'Preston North End Community and Education Trust', '1986', '1130773', '6627591', 'North West', 'Lancashire County Council;Premier League Charity Fund;Preston City Council;English Football League Foundation;Trust Vets Foundation;Armed Forces Covenant;Football Association;Lancashire Violence Reduction Network;Crime Commissioner;National Health Service;National Lottery;Preston College;National Citizen Service;University of South Wales;', 1294202, '', 1),
(85, 204, 'Hope After Harm', '1993', '1031545', '2881664', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'National Lottery;OPCC Thames Valley;MOJ;Rothschild foundation;Anson Trust;Local Authorities;Community foundations;', 2500000, '', 1),
(86, 205, 'Arematherapy CIC', '2023', 'Not on the Charities Register', '14740780', 'West Midlands', 'National Lottery.;', 0, '', 1),
(87, 206, 'Discovery Outdoors', '2024', 'Not on the Charities Register', '15753232', 'Yorks and Humber', 'Sheffield City Council (formal tender);Roots Allotments (donation of space worth 600 per year);Sheffield University (Partnership with Landscape Architecture Team);Case Evans and Care Architects (Partnership on the project);Can Studios (small sponsorship);', 10000, '', 1),
(89, 208, 'Gloucestershire Rape and Sexual Abuse Centre (GRASAC)', '1984', '1155902', 'Not Registered with Companies House', 'South West', 'Ministry of Justice;Office of Police and Crime Commissioner (OPCC);NHS Integrated Care Board (Gloucestershire);Barnwood Trust;Lloyds Bank Foundation;', 590000, '', 1),
(90, 209, 'Leicester City in the Community', '2007', '1126526', '6443209', 'East Midlands', 'Premier League Charitable Fund;National Citizens Service;Premier League and Professional Footballers? Association Community Fund;BBC Children in Need;National Grid Community Matters Fund;Amnesty International;NHS Charities Together;Leicester City Council;Football Foundation;Active Together;Hinckley and Bosworth Borough Council;St Philip?s Centre;Western Power;Sport England;Institution of Engineering and Technology;Intelligent Energy;Leicestershire & Rutland FA;Royal Society of Chemistry;Leicestershire County Council;Rutland County Council;Leicestershire Violence Reduction Network;Kellogg\'s;Street Games;VF Foundation;Prison Twinning;Active Charnwood;National Lottery Community Fund;National Lottery Heritage Fund;Walkers Replay;Leicestershire Partnership Trust;Leicestershire Virtual School;Islamic Relief UK;Leicester & Leicestershire Enterprise Partnership;Leicestershire Police;Leicester and Leicestershire partner schools;Mental Health Matters;Boost Charitable Fund;EFL Trust;Office of the Police and Crime Commissioner;', 1685833, '', 1),
(91, 210, 'Lincoln City Foundation', '1994', '1128464', '6608600', 'East Midlands', 'Lincoln City Football Club;English Football League in the Community;Premier League Charitable Fund;Lincolnshire Football Association;Football Foundation;Red Imps Community Trust;Lincoln City Former Players\' Association;City of Lincoln Council;Lincolnshire County Council;University of Lincoln;Bishop Grosseteste University;National Lottery Community Fund;Active Lincolnshire;UK Shared Prosperity Fund;Youth Investment Fund;and National Citizen\'s Service have all played pivotal roles in supporting our work. While these are the key partners;', 1151263, '', 1),
(92, 211, 'MK Breakers Basketball Club', '2020', 'Not Registered with Companies House', '12711879', 'South East', 'Self Funding;', 178333, '', 1),
(94, 213, 'Streams Learning Hub CIC', '2023', 'N/A', ' 14890192', 'South West', 'n/a;', 10000, '', 1),
(95, 214, 'In Music In Media (IMIM)', '2013', 'Not on the Charities Register', '8605027', 'East Midlands,East of England', 'Local Authorities;Schools;', 20000, '', 1),
(96, 215, 'The Albion Foundation', '1993', '1081948', 'n/a', 'West Midlands', 'The wheelchair football associastion;', 1500000, 'n/a', 1),
(97, 220, 'Educafe CIC', '2021', 'N/A', '13117301', 'South East,South West', 'The National Lottery;Greenham Trust;West Berkshire Council;', 200000, '', 1),
(98, 221, 'YMCA Heart of England', '1920', '218808', 'n/a', 'West Midlands', 'Alan Edward Higgs;Newfield Charitable trust;The Clarion Futures Charitable Foundation;The Eveson Trust;', 7181244, '', 1),
(99, 223, 'Guru Leadership and Coaching', '2011', 'n/a', 'n/a', 'West Midlands', 'National Police Chief\'s Council;West Mercia Police;', 71000, '', 1),
(103, 237, 'Guiding Young minds ', '1991', '1052219', 'N/A', 'East Midlands,North East,North West,South East,West Midlands', 'children in need;Duke of edinburgh award;Kier construction;Youth endownment fund;coventry city council;birmingham council;west midlands police;northampton police;Thames valley police;warwickshire council and police;coventry youth justice service;northamptonshire youth justice service;mcdonalds;Orbit housing;David lloyds;', 150000, '', 1),
(104, 240, '7Roadlight CIC', '2019', 'n/a', '11981872', 'East Midlands,South East', 'Thames Valley Police;Thames Valley Police & Crime Commissioner;Wycombe District Council;Community Impact Bucks;Buckinghamshire Council;', 33000, '', 1),
(105, 241, 'YMCA Milton Keynes', '1981', '1125743', '2769788', 'South East', 'A full list is available upon request;', 3000000, '', 1),
(106, 242, 'Reading Football Club Community Trust', '1992', '1125817', 'n/a', 'South East', 'list upon request;', 2000000, '', 1),
(111, 256, 'Youth Justice Service', '1998', 'n/a', 'n/a', 'West Midlands', 'Local Authorities;National Probation\r\nService;West Mercia Police;NHS;West Mercia Police and Crime Commissioner;', 1000000, '', 1),
(112, 260, 'Herefordshire Vennture', '2012', '1156851', 'N/A', 'West Midlands', 'Herefordshire Council;Alcodigital Ltd;Ascension Trust;BOSS (Border Office Supplies and Systems);BreatheHR;British Gas;EDF Energy;Hereford City Church;Lex Autolease Ltd;Microsoft;Redline Tele.com Ltd;Richard Weaver Photography;Rose Generation;Sentinel Security Systems;Ten Stories Digital Ltd;Vennture Enterprises Ltd;X-Calibre;Zen System Ltd;', 1300000, '', 1),
(113, 263, 'Special Constable (West Mercia Police)', '1967', 'N/A', 'N/A', 'West Midlands', 'Police;', 0, '252038350', 1),
(114, 266, 'Catch22', '2008', '1124127', '06577534', 'West Midlands', 'West Mercia Police and Crime Commissioner;', 150000, '', 1),
(115, 269, 'Adapt-IT Limited', '2021', 'N/A', 'Local community support', 'South West,West Midlands', 'N/A;', 100000, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `CSE_MainContactdetails`
--

CREATE TABLE `CSE_MainContactdetails` (
  `cmcd_id` bigint NOT NULL,
  `cse_id` bigint NOT NULL,
  `cmcd_name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_phone` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `cmcd_jtitle` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `cse_address` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CSE_MainContactdetails`
--

INSERT INTO `CSE_MainContactdetails` (`cmcd_id`, `cse_id`, `cmcd_name`, `cmcd_email`, `cmcd_phone`, `cmcd_jtitle`, `cse_address`) VALUES
(48, 56, 'Anthony Olaseinde', 'info@alwaysanaltrernative.org.uk', '07563 580 954', 'CEO', 'Always An Alternative, The Campus, Pack Horse Lane,  Sheffield Yorkshire S35 3HY'),
(49, 57, 'Rebecca Salisbury', 'becksta78@yahoo.co.uk', '01327 871118', 'Trustee', 'Stefen Hill, Stefen Hill Ground, Western Ave,  Daventry  Northamptonshire NN11 4UD'),
(50, 58, 'Dwain Morgan', 'dwain.morgan@pafc.co.uk', '07947 108 224', 'Head of Business and Impact', 'Home Park Stadium ,  Plymouth Devon PL2 3DQ'),
(51, 59, 'Kallum  Wallbank', 'Kallum@elitecommunityhub.co.uk', '07908 940 026', 'Community Development Manager', 'Unit C Wordsworth Mill Wordsworth Street Greater Manchester BL1 3ND'),
(52, 60, 'Claire Byrne', 'claire@boxingclever.org.uk', '07746 250464', 'Community Development Manager', '10 Burners Lane,  Milton Keynes,  Buckinghamshire,  MK11 3HB'),
(54, 62, 'Julie Barnes', 'julie.barnes@tdyc.co.uk', '0118 934 0891', 'Administrator', '3 Loddon Hall Road Reading Berkshire RG10 9JA'),
(55, 63, 'Rob Deeks', 'info@togetherasone.org.uk', '01753 574 780', 'CEO', '29 Church Street Slough Berkshire SL1 1PL'),
(56, 64, 'Martin Murray', 'info@thinkfast.academy', '07592 198 756', 'Director', 'Parr Sports Centre, St.Helens Merseyside  WA9 2LH'),
(57, 65, 'Rosalind Walker', 'rosalind@wildheartfoundation.co.uk', '07736 774 133', 'Vision and Strategy Lead', '103B Nutley Lane, Reigate Surrey  RH2 9EF'),
(58, 66, 'Kate Taylor', 'kate@theprojectpt.com', '0794 4008 469', 'Social Impact Manager', 'Magdalen Road Gym, 9 Newtec Place, Magdalen Rd Oxford Oxfordshire  OX4 1RE'),
(59, 67, 'Louisa  Merchant', 'louisa.merchant@berkshireyouth.co.uk', '07720 159989', 'Business Development Manager', 'Watlington House 44, Watlington Street, Reading, Berkshire RG1 4RJ Reading Berkshire RG1 4RJ'),
(62, 70, 'Katie Donaghue', 'hello@thesilentdiscoproject.co.uk', '01604372767', 'CEO', '26 Gayton Road Northants Northamptonshire NN12 8NG'),
(64, 72, 'Lorraine Lewis', 'lorraine.lewis@thelewisfoundation.co.uk', '‪01604 245689‬', 'CEO', '59 Samwell Lane, Upton Northampton  Northamptonshire NN5 4DB'),
(65, 73, 'Byron Highton', 'Byron@thejjeffect.co.uk', '07564 625 496', 'MD', '72 Murdock Avenue Preston Lancashire PR2 2BL'),
(66, 74, 'Neill Friedman', 'Neill.Friedman@northampton.ac.uk', '07821 145 001', 'Founder', '1 Nova Centre, Purser Road Northampton Northamptonshire  NN1 4PG'),
(67, 75, 'Jo Clanfield', 'jo@teachoutdoors.co.uk', '07961 270 883', 'Managing Director', '5 Ashton Road, Hartwell  Northampton Northamptonshire NN7 2HW'),
(69, 77, 'Zellah Barrett', 'zellah.barrett@themustardtree.org', '07512 145 130', 'Business Engagement & Fundraising Lead', '90 London Street Reading Berkshire  RG1 4SJ'),
(70, 78, 'Lauren Richardson', 'lauren.r@sofea.uk.com', '07376 867 501', 'Marketing and Social Media Assistant', '1e Trident Business Park  Didcot Oxfordshire OX11 7HJ'),
(71, 79, 'Maelor Owen', 'sandocc@hotmail.co.uk', 'tbc', 'Chair', 'Spring Gardens, Ditherington, Shrewsbury SY1 2SZ Shrewsbury Shropshire  SY1 2SZ'),
(72, 80, 'Chloe Purcell', 'chloe.purcell@safeproject.org.uk', '07419 374 272', 'CEO', 'Basement Office - Premier Place 190-196 Garsington Road Oxford Oxfordshire OX4 6FG'),
(73, 81, 'Abide Zenenga', 'head@riverside-education.co.uk', '07723 404 150', 'Head of Riverside', '2 Riverside Drive, Stechford Birmingham West Midlands B33 9BF'),
(74, 82, 'Aimee Baker', 'marketing@ridehigh.org', '01908 696 169, 07794 555 125', 'Marketing Manager', '51 Rous Road, Buckhurst Hill London London IG9 6BU'),
(75, 83, 'Lara Turner', 'lara@suzanissa.com', '07760 227 680', 'Operations Lead', '51 Rous Road, Buckhurst Hill London London IG9 6BU'),
(76, 84, 'Jack Mountain', 'jack.mountain@pne.com', '07825 964 765', 'Head of Fundraising', 'Alan Kelly Stand, Deepdale Stadium, Sir Tom Finney Way Preston Lancashire  PR16RU'),
(77, 85, 'Nikki Ross', 'nikki@thamesvalleypartnership.org.uk', '07999 527 104', 'CEO', 'Coach house, Manor Farm Aston Sandford Buckinghamshire HP17 8JB'),
(78, 86, 'Rema Bailey', 'remaba@arematherapy.co.uk', '07706 225 966', 'CEO', '22 Wood Green Road Wednesbury West Midlands WS10 9AX'),
(79, 87, 'John Bray', 'john@discoveryoutdoors.org', '07447 929 608', 'CEO', '12 Stainton Road Sheffield Yorkshire  S117AX'),
(81, 89, 'Gilli Appleby', 'ceo@glosrasac.org.uk', '07760 787 856', 'CEO', 'PO Box 3292 Gloucester Gloucestershire  GL1 9HW'),
(82, 90, 'Dan Mitchinson', 'dan.mitchinson@lcfc.co.uk', '07395 794 380', 'Senior Manager (Business Development)', 'King Power Stadium, Filbert Way Leicester Leicestershire  LE2 7FL'),
(83, 91, 'Danny Carter', 'danny.carter@lincolncityfoundation.co.uk', '077190 23751', 'Head of Sport & Physical Activity', 'LNER Stadium Lincoln Lincolnshire LN5 8LD'),
(84, 92, 'Phil Hannah', 'phil@mkbasketball.club', '07793 244 354', 'Director of Partnerships', '4 Watermill Lane, Wolverton Mill Milton Keynes  Buckinghamshire MK12 5PR'),
(86, 94, 'Joanna Sweetland', 'hello@streamslearninghub.com', '07771593863', 'Co-Founder & Hub Manager (Partnerships & Programmes)', '5 Beaufort Place Bristol Bristol BS16 1PE'),
(87, 95, 'Daniel Johnson', 'info@inmusicinmedia.com', '07762 545 275', 'Managing Director', '12 Gregory Street Northampton Northamptonshire NN1 1TA'),
(88, 96, 'Adrian  Dove ', 'adrian.dove@albionfoundation.co.uk', '07595243119', 'Head Of Sport ', 'The Albion Foundation, Ray Hall Lane Birmingham  West Midlands  B43 6JF'),
(89, 97, 'Janine Ford', 'janine@educafeuk.co.uk', '07540145785', 'Director', 'C/O Buick Mackane, 14 West Mills Newbury West Berkshire RG14 5HG'),
(90, 98, 'Julia Nolan', 'julia.nolan@ymcaheartofengland.org.uk', '07733545080', 'Head of Community and Youth Services', '301 Reservoir Road, Erdington Birmingham,  West Midlands B23 6DF'),
(91, 99, 'Dr Ranjit Manghanani', 'ranjit.manghnani@gmail.com', '0118 941 6402', 'Managing Director/PALS Director', '6 Albert Illsley Close,  Reading Surrey RG31 5PJ'),
(95, 103, 'Anton Noble', 'anton@assisttraumacare.org.uk', '07908156992', 'Founder/Programme manager ', 'Unit 17 Clock Tower Shopping Centre, Northway, Rugby, Warwickshire CV21 2JR rugby Warwickshire CV21 2RJ'),
(96, 104, 'Dwayne Jack', 'info@7roadlight.co.uk', '0800 7747127', 'Founder & CEO', '13 Mead Street,   High Wycombe,  Buckinghamshire,  HP13 7DR'),
(97, 105, 'Tayler  Tookey  ', 'Tayler.Tookey@mkymca.com', '01908 295 600', 'Youth & Community Manager', '1 NORTH SIXTH STREET,  CENTRAL MILTON KEYNES,  BUCKINGHAMSHIRE  MK9 2NR'),
(98, 106, 'Dave Evans', 'devans@readingfc.co.uk', '01904 954257‬', 'Community Development Manager', 'READING FOOTBALL CLUB PLC MADEJSKI STADIUM R Reading Berskshire RG2 0FL'),
(103, 111, 'Joanne Baggs', 'joanne.baggs@westmercia.police.uk', 'n/a', 'West Mercia Police', 'Tolladine Road Worcester Worcestershire WR4 9NB'),
(104, 112, 'Imogen Abbott', 'imogen.abbott@vennture.org.uk', '07502100567', 'Development Manager', '26 Vicarage Road Hereford England HR9 5JU'),
(105, 113, 'Recruitment  Team', 'boc.specials@westmercia.police.uk', '01905 718444', 'West Mercia Police Special Constables', 'N/A Worcester West Mercia WR1'),
(106, 114, 'Katie Greaves', 'Katie.Greaves@catch-22.org.uk', 'n/a', 'Head of Partnerships & Social Value', '27 Pear Tree Street,  London  London EC1V 3AG'),
(107, 115, 'simon ogorman', 'simon.ogorman@adapt-it.co.uk', '03300564079', 'Manging Director', 'Office 4, Basepoint Business Centre, OAKFIELD CLOSE Tewkesbury GLOUCESTERSHIRE GL208SD');

-- --------------------------------------------------------

--
-- Table structure for table `CSE_ProjectDetail`
--

CREATE TABLE `CSE_ProjectDetail` (
  `pro_id` bigint NOT NULL,
  `cse_id` bigint NOT NULL,
  `pro_Name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `pro_Purpose` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_KeyObjectives` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_StartYear` year NOT NULL,
  `pro_CollectData` tinyint(1) DEFAULT NULL,
  `pro_Impact` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_RequiredSponsorship` bigint NOT NULL,
  `pro_AdditionResourcesNeeded` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `pro_fAsk` bigint NOT NULL,
  `pro_fAskDetails` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `pro_eAsk` bigint DEFAULT NULL,
  `pro_eAskDetails` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_pAsk` bigint DEFAULT NULL,
  `pro_pAskDetails` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_pccfunding` tinyint(1) DEFAULT NULL,
  `pro_pccfundingDetails` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pro_businessBenefits` varchar(1000) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CSE_ProjectDetail`
--

INSERT INTO `CSE_ProjectDetail` (`pro_id`, `cse_id`, `pro_Name`, `pro_Purpose`, `pro_KeyObjectives`, `pro_StartYear`, `pro_CollectData`, `pro_Impact`, `pro_RequiredSponsorship`, `pro_AdditionResourcesNeeded`, `pro_fAsk`, `pro_fAskDetails`, `pro_eAsk`, `pro_eAskDetails`, `pro_pAsk`, `pro_pAskDetails`, `pro_pccfunding`, `pro_pccfundingDetails`, `pro_businessBenefits`) VALUES
(47, 56, 'Mobile Youth Club', 'We are a charity, created with the ultimate aim of challenging the mindset of young people, supporting them, to make well informed, positive life choices, both in the short term and empowering them to maintain these skills for life.\n\nOur organisations aim is to spread awareness around reducing knife crime, gun crime, gangs culture and anti-social behaviour; what we call, current risks to youths.\n\nWe achieve this by using alternative ways of education to engage the youthful minds of today; inform, mentor and support them with the challenges that they may come up against.\n<h2>HOW WE HELPSERVICES</h2>\nWe offer a wide range of educational services that challenge the mindset of young people, parents and professionals around current risks to youths: knife crime, gang culture, antisocial behaviour.\n\nCovering how to spot the risks and how to approach them. Additionally, the years of lived experience and current work allow for a thought provoking and action prominent guest speaking experience.\n<h2>WHERE</h2>\nMost of our work is focussed in and around Yorkshire. However, our reach is National with podcasts, documentaries and other projects.', 'We are raising £20,000 for a mobile youth club to travel around South Yorkshire to engage with Young People.\n\nNot only will the MYC be packed out with fun activities, it will become a hub for knowledge on topics such as knife crime, grooming, DV, heathy eating, sexual health, mental health, substance miscue and wellbeing', '2023', 1, 'We have found that this project is necessary as young people are not attending youth clubs within their area.', 20000, 'Financial Support: We are raising £20,000 for a mobile youth club to travel around South Yorkshire to engage with Young People.\nNot only will the MYC be packed out with fun activities, it will become a hub for knowledge on topics such as knife crime, grooming, DV, heathy eating, sexual health, mental health, substance miscue and wellbeing', 20000, 'We are raising £20,000 for a mobile youth club to travel around South Yorkshire to engage with Young People.\nNot only will the MYC be packed out with fun activities, it will become a hub for knowledge on topics such as knife crime, grooming, DV, heathy eating, sexual health, mental health, substance miscue and wellbeing', 0, '', 0, '', 0, NULL, 'Provide regular progress updates on the Pluggin Ecosystem for business supporters to utilise'),
(48, 57, 'Reaching For Health ', 'The Reach for Health Centre major in physical and mental health rehabilitation together with active wellness. This covers a multitude of illnesses and health conditions such as sports injuries, pre & post joint replacements to Stroke survivors, Heart issues, Diabetes, etc. Members who fall into these categories are mostly referred by their GP’s, Hospital Doctors or Health Care Professional.', 'Healthy Ageing\r\nChronic Illness Management\r\nPrehabilitation & Rehabilitation', '2010', 1, 'In 15 years we\'ve established research-based impact based around physical and mental health rehabilitation together with active wellness. This support has covered a multitude of illnesses and health conditions such as sports injuries, pre & post joint replacements to Stroke survivors, Heart issues, Diabetes, etc. Members who fall into these categories are mostly referred by their GP’s, Hospital Doctors or Health Care Professional.', 25000, 'Financial Support: As part of the Reaching For Health initiative within the Midlands, we\'re extending our centres footprint to expand the number of people we support in different areas. This amount will be put towards phases 1 and 2 of the expansion under this initiative.', 25000, 'As part of the Reaching For Health initiative within the Midlands, we\'re extending our centres footprint to expand the number of people we support in different areas. This amount will be put towards phases 1 and 2 of the expansion under this initiative.', 0, '', 0, '', 0, NULL, 'Feature business sponsors on your website and socials'),
(49, 58, 'Ability Counts', 'Create equal opportunities for everybody to enjoy sport, irrespective of a physical, mental or learning disability.\nCreate a fun and engaging space for children to make new friends whilst getting physically active.\nProvide inclusive sport opportunities that covers pan-disability, as well as hard-of-sight, hearing and power chair.\nSupport children to learn life skills (such as resilience, creativity, independence)\nCreate once-in-a-lifetime opportunities for children with disabilities to enjoy Home Park stadium.\nRemove the costs (and other barriers) that stop children with disabilities enjoying sport and exercise.', '1) Provide free weekly multi-sport and exercise sessions for children with a range of disabilities.\n2) Create a safe and consistent opportunity to make friends irrespective of a child?s needs.', '2015', 1, '- The project supports over 80 young people a week\r\n- 97% of parents agree that their child has grown in confidence since joining in the sessions\r\n- 85% of parents suggested that this is the only physical activity/sports group their child attends\r\n- 92% of players believe they\'ve made new friends since joining the club.', 24000, 'Financial Support: Additional funding would allow us to purchase more power chairs to support people with physical disabilities to play wheelchair sport.\r\nFunds would further allow us to cover the costs of staff and venue hire meaning costs can be significantly reduced/free-of-charge to parents. Lastly we\'d like to launch a boot bank/boot swap that supports children with disabilities who cannot afford suitable boots and trainers to be able to have the kit they require.', 24000, 'Additional funding would allow us to purchase more power chairs to support people with physical disabilities to play wheelchair sport.\r\nFunds would further allow us to cover the costs of staff and venue hire meaning costs can be significantly reduced/free-of-charge to parents. Lastly we\'d like to launch a boot bank/boot swap that supports children with disabilities who cannot afford suitable boots and trainers to be able to have the kit they require.', 0, '', 0, '', 0, NULL, 'Feature business sponsors on your website and socials'),
(50, 59, 'The Elite Community Hub', 'We took over an empty factory building, to create a safe space for young people and vulnerable adults in Bolton, providing them access to support and personal development whilst also helping them build awareness of local dangers and learn life skills. This, given the lack of local council run facilities, and the lack of services once provided, means that we have the scalability to replace this missing support in the town.', 'Maintain the facility 7-days a week, with the objective to make it available for all local users as an alternative to the streets and danger. In doing this, in partnership with public and private sector collaborators, expand the existing services and impact being achieved by the CIC. \n', '2020', 1, 'Data available upon request.', 30000, 'Financial Support: We are looking for multiple businesses to collaborate with us to run and expand the Hub, multiples of £10k for a year will grow-into enough for us to open, operate and maintain all activities.\r\n\r\nEquipment Support: We\'re looking for £10k to help us buy-in ICT equipment and also food ingredients as part of the life and skills development with local residents visiting us.\r\n\r\nProfessional Support: Equivalent time to money calculation, with businesses giving time to meet young people and talk about employability, life stories and mentoring if able.', 10000, 'We are looking for multiple businesses to collaborate with us to run and expand the Hub, multiples of £10k for a year will grow-into enough for us to open, operate and maintain all activities.', 10000, 'We\'re looking for £10k to help us buy-in ICT equipment and also food ingredients as part of the life and skills development with local residents visiting us.', 10000, 'Equivalent time to money calculation, with businesses giving time to meet young people and talk about employability, life stories and mentoring if able.', 0, NULL, 'Provide monthly meetings with your executive team'),
(51, 60, 'Youth Diversion Programme', 'To reduce youth violence, aggression and exploitation of young people.\nTo create a brighter future for all young people, regardless of their background or circumstances, through collaborative efforts with young people, their families, and the wider community.\nTo give young people develop a sense of belonging, learn important life skills, and build positive relationships with caring adults.\nTo provide educational workshops and training opportunities to help young people gain the skills and knowledge they need to succeed.', 'We offer psychologically informed non-contact boxing programmes. Transforming the lives of young people through boxing, mentoring, &education. To create a brighter future for all young people, regardless of their background or circumstances, through collaborative efforts with young people, their families, and the wider community.\nTo give young people develop a sense of belonging, learn important life skills, and build positive relationships with caring adults.\nTo provide educational workshops and training opportunities to help young people gain the skills and knowledge they need to succeed.', '2022', 1, '86% of participants have improved self confidence, self belief, and self esteem 81% are able to express their needs and manage their feelings more easily 88% have a stronger sense of belonging 94% can identify more risky behaviours and their consequences more easily 71% have an increased sense of purpose, and look more positively towards their future 56% feel more engaged at school 86% have increased their fitness levels 89% of participants improved their attendance at school 50% reduced their negative behaviour points in school 70% increased their positive behaviour points in school', 42000, 'Financial Support: To grow our youth diversion programme, you need several key resources. Firstly, our coaches play a vital role in providing guidance and support to the participants. They possess strong leadership and mentoring skills and are capable of facilitating engaging and educational activities. Additionally, we\'d like to hire a dedicated programme manager is essential to oversee the day-to-day operations, coordinate activities, and ensure the programme\'s smooth functioning. As head of programmes I am required to spend more time providing strategic direction, developing partnerships, and expanding the programme\'s reach. Mentors are crucial resources as they offer one-on-one guidance and support to the youth, helping them develop essential life skills. Lastly, acquiring necessary equipment such as sports gear, educational materials, and technology resources will enhance the overall program experience and enable the implementation of diverse activities.', 42000, 'To grow our youth diversion programme, you need several key resources. Firstly, our coaches play a vital role in providing guidance and support to the participants. They possess strong leadership and mentoring skills and are capable of facilitating engaging and educational activities. Additionally, we\'d like to hire a dedicated programme manager is essential to oversee the day-to-day operations, coordinate activities, and ensure the programme\'s smooth functioning. As head of programmes I am required to spend more time providing strategic direction, developing partnerships, and expanding the programme\'s reach. Mentors are crucial resources as they offer one-on-one guidance and support to the youth, helping them develop essential life skills. Lastly, acquiring necessary equipment such as sports gear, educational materials, and technology resources will enhance the overall program experience and enable the implementation of diverse activities. ', 0, '', 0, '', 0, NULL, 'Provide monthly meetings with your executive team'),
(53, 62, 'Youth Club', 'The Youth Club offers recreational activities, computer access, fitness, education, counselling and advice from trained professionals for those that attend.\nin our ask we would like to be able to offer our Young People cooking and food preparation sessions to teach them about healthy eating and develop their life skills in this area.\nOur kitchen area needs to be upgraded to allow us to do this as the drawers, cupboards and worktop are falling into disrepair and most importantly, we have to have 2 x sinks installed in the kitchen - one for food preparation and for hand-washing - in order to meet Food Hygiene Regulations', 'We provide a safe place for young people (12+) in the district to come, 3 times a week, and offer recreational activities, computer access, fitness, education, counselling and advice from trained professionals.\nWe also provide an affordable venue for local groups and residents from the district to hire for fitness and social activities', '2008', 0, 'We continue to support over 50 Young People every week at our sessions', 5000, 'Financial Support: In order for us to offer nutrition and cookery sessions our Youth Club kitchen needs to be upgraded to include an additional sink for food preparation as well as handwashing.\nWe are keen to harness support to help us with the funding or installation of this project and/or the volunteers to be able to progress grant applications on our behalf. We expect the cost of materials to be close to £5k with installation costs in addition.\nOf course once we have this in place we will change this ask to that we can do more to help the local young people, especially those struggling, to have greater experiences and show how bright the world can be and move them from the darker parts of society.\nIf you are able to help with more please call or email me so we can discuss what we may do with your kind sponsorship.', 5000, 'In order for us to offer nutrition and cookery sessions our Youth Club kitchen needs to be upgraded to include an additional sink for food preparation as well as handwashing.\r\nWe are keen to harness support to help us with the funding or installation of this project and/or the volunteers to be able to progress grant applications on our behalf. We expect the cost of materials to be close to £5k with installation costs in addition.\r\nOf course once we have this in place we will change this ask to that we can do more to help the local young people, especially those struggling, to have greater experiences and show how bright the world can be and move them from the darker parts of society.\r\nIf you are able to help with more please call or email me so we can discuss what we may do with your kind sponsorship.', 0, '', 0, '', 0, NULL, ''),
(54, 63, 'Hospital Navigators Project', 'To positively engage vulnerable young people in Emergency Department.\nTo support young people to access services which will help them tackle some of the underlying issues which caused them to present at the hospital in the first place.\nTo support young people to access positive activities in the community, reducing the likelihood of their re-attendance.', 'The purpose of this project is to engage with young people in the Emergency Department of Wexham Park Hospital, when they attend due to violence, substance misuse or mental health.', '2021', 1, 'In 2022, we received 137 referrals via the hospital. Of those 93 (68%) were signposted to new opportunities and services.\r\n27 of the young people were engaged with in the community, to provide further support.', 37930, 'Financial Support: The scheme would benefit from greater staffing levels.\r\nWe would like more of a presence at the hospital so we can talk to more young people at that reachable moment.', 37930, 'The scheme would benefit from greater staffing levels.\r\nWe would like more of a presence at the hospital so we can talk to more young people at that reachable moment.', 0, '', 0, '', 0, NULL, ''),
(55, 64, 'Community', 'We are a boxing based 10-week crime prevention programme that works with young people aged 11 - 19 who are struggling to maintain their school place and/or at risk of criminal exploitation.\nOur aim is to equip young people with the tools to make positive life choices and enrich their lives.', 'Improve physical health\nImprove mental health\nReduce crime\nEnrich lives\nImprove school behaviour\nImprove attendance\nImprove attitude to learning', '2021', 1, 'Outcomes stars at the start an end of our programmes completed by one of our recent cohorts show improvements in these areas -\r\nPhysical health - 26.4%\r\nMental health - 41%\r\nManaging emotions - 65.1%\r\nUnderstanding of County Lines - 206.7%\r\nSchool behaviour - 35.6% ? Family relationships - 25%\r\nTaking responsibility for their actions - 38.2%\r\nKnowledge around dangers of drugs and alcohol - 37.9%', 28000, 'Financial Support: It costs £7,000 to run one 10-week programme with a cohort of 12 young people.\nWe work term time so our Ask would be £21,000, which would allow us to run one programme per school term.\nCostings below -\nEmotional welfare coordinator - £200 per week x 10 = £2,000\nProgramme Manager - £200 per week x 10 = £2,000\nBoxing gym rent - £125 pw x 10 = £1,250\nBoxing coach - £30 per hour x 2 coach\'s x 10 hour sessions - £600\nStrengthening Minds programme booklets - £25 each x 12 = £300\nAcademy T-shirt\'s - £12 each x 12 = £144\nCounty Lines guest speaker - £250\nImpacts and consequences guest speaker - £150\nDrugs and Alcohol guest speaker - £100\nJoint Enterprise guest speaker - £100', 28000, 'It costs £7,000 to run one 10-week programme with a cohort of 12 young people.\r\nWe work term time so our Ask would be £21,000, which would allow us to run one programme per school term.\r\nCostings below -\r\nEmotional welfare coordinator - £200 per week x 10 = £2,000\r\nProgramme Manager - £200 per week x 10 = £2,000\r\nBoxing gym rent - £125 pw x 10 = £1,250\r\nBoxing coach - £30 per hour x 2 coach\'s x 10 hour sessions - £600\r\nStrengthening Minds programme booklets - £25 each x 12 = £300\r\nAcademy T-shirt\'s - £12 each x 12 = £144\r\nCounty Lines guest speaker - £250\r\nImpacts and consequences guest speaker - £150\r\nDrugs and Alcohol guest speaker - £100\r\nJoint Enterprise guest speaker - £100', 0, '', 0, '', 0, NULL, ''),
(56, 65, 'Mentoring and tutoring provision', 'To provide young people with complex SEND needs including ADHD, Autism and PDA social, emotional or mental health needs educational provision an inclusive multi-sensory approach to education.\nTo empower children to lead their learning so they can thrive personally and academically.', 'We are The Wildheart Foundation. Our mission is to build a new kind of tutoring and mentoring provision, where children and young people are at the centre of everything we do.', '2023', 1, 'Yes but we are in the process of analysing and presenting this data', 50000, 'Financial Support: Connections to other organisations working in this space Community and collaboration Funding Tech advise and development', 50000, 'Connections to other organisations working in this space Community and collaboration Funding Tech advise and development', 0, '', 0, '', 0, NULL, ''),
(57, 66, 'Lift Use', 'LiftYouth helps young people who are at risk of being NEET (not in Education, Employment, or Training), engaging in antisocial behaviour, or have a criminal charge, with life skills and qualifications', 'To gain life skills, such as communication, emotional regulation and resilience\nTo gain qualifications in a fitness environment, which are versatile to a number of industries\nTo gain work experience and work skills, to take into the world of work\nTo develop supportive connections with positive people', '2022', 1, 'In 2023 alone, we have achieved 1500 hours of impact, with over 100 young people engaged. This has lead to over 30 young people with qualifications, more than 10 with work experience, and numerous young people with improved school attendance.', 19000, 'Financial Support: In order for us to run a session for Lift Youth for one year (48 weeks), we require the costs for coaching, travel, venue hire, food, qualifications, equipment, and marketing to be funded. We do not charge individuals for Lift Youth as this would create a barrier these young people are unable to overcome.', 19000, 'In order for us to run a session for Lift Youth for one year (48 weeks), we require the costs for coaching, travel, venue hire, food, qualifications, equipment, and marketing to be funded. We do not charge individuals for Lift Youth as this would create a barrier these young people are unable to overcome.', 0, '', 0, '', 0, NULL, ''),
(58, 67, 'Open Access Youth Work', 'A well established support service for young people facing modern day challenges with trauma, SEN, mental health and education. Within communities, a dedicated and ongoing provision and support wrap-around.', 'Build a continuous and sustainable support within communities, in partnership with public and private sector collaborators. Embed a continuous service and presence within areas of most recognised deprivation/challenges within counties.', '1950', 1, 'Metrics and impact reports available upon request.', 20000, 'Financial Support: Funding to support the core costs of delivery, which include staffing and resourcing.', 20000, 'Funding to support the core costs of delivery, which include staffing and resourcing.', 0, '', 0, '', 1, 'Various funding awards from the OPCC for Thames Valley - both Home Office grants (violence reduction unit) and available PoC disbursements have underpinned our delivery ', ''),
(61, 70, 'Golden Hour Silent Disco Programme for Elderly Care Communities', 'The Golden Hour Silent Disco Programme delivers impactful therapeutic music experiences specifically designed for elderly communities. \r\n\r\nUsing wireless headphones with individual volume control, we provide a safe, accessible way for elderly residents to engage with nostalgic music that sparks memories, reduces isolation, and creates meaningful moments of connection. Each session encourages gentle movement, social interaction, and emotional expression, ensuring all participants can engage in th', '1) Enhance emotional wellbeing and quality of life for elderly residents through music experiences that reduce anxiety, improve mood, and create moments of pure joy.\r\n2) Combat social isolation by fostering meaningful connections between residents, staff, and families through shared musical experiences that transcend communication barriers.\r\n3) Stimulate cognitive function and memory recall through carefully curated nostalgic music that triggers positive memories and creates natural opportunitie', '2025', 1, '1) Enhanced Participation: At Avery Healthcare homes, residents typically described as \"lethargic\" and \"rarely engaging\" actively participated by tapping fingers, clapping, and showing visible excitement, particularly during familiar songs like Elvis tracks. Staff reported being amazed at the level of engagement from typically withdrawn residents.\r\n\r\n2) Memory Activation: At Spencer House Care Home, spontaneous singing and dancing led to residents sharing stories about their youth that staff had never heard before. One family member reported that their father with limited communication \"lights up, engages, and just comes back to life\" during sessions.\r\n\r\n3) Improved Social Connection: At Timken Grange, the Activities Coordinator observed residents from different floors who rarely interact \"connecting and dancing together,\" with particularly strong bonds forming during the final songs when everyone gathered together. Staff reported this connection continuing well beyond the session.\r\n\r\n', 3500, 'Financial Support: £1,000 would fund four complete Golden Hour Silent Disco sessions for elderly care communities, directly impacting approximately 120 elderly residents. Each professional session includes:\r\n\r\nHigh-quality wireless headphones with individual volume control for up to 30 participants\r\nProfessionally curated nostalgic playlists designed to spark memories and connection\r\nExpert facilitation from our trained, DBS-checked team with elderly care experience\r\nComplete setup, delivery, and support throughout each 60-minute session\r\nPost-session impact assessment and testimonial collection\r\n\r\nThis investment delivers measurable wellbeing outcomes including reduced isolation, improved mood, increased social engagement, and enhanced staff-resident relationships. Sessions can be targeted to care homes in specific geographic areas aligned with the supporter\'s community focus, and all supporting businesses receive comprehensive impact reporting with authentic stories and testimonials ', 1000, '£1,000 would fund four complete Golden Hour Silent Disco sessions for elderly care communities, directly impacting approximately 120 elderly residents. Each professional session includes:\r\n\r\nHigh-quality wireless headphones with individual volume control for up to 30 participants\r\nProfessionally curated nostalgic playlists designed to spark memories and connection\r\nExpert facilitation from our trained, DBS-checked team with elderly care experience\r\nComplete setup, delivery, and support throughout each 60-minute session\r\nPost-session impact assessment and testimonial collection\r\n\r\nThis investment delivers measurable wellbeing outcomes including reduced isolation, improved mood, increased social engagement, and enhanced staff-resident relationships. Sessions can be targeted to care homes in specific geographic areas aligned with the supporter\'s community focus, and all supporting businesses receive comprehensive impact reporting with authentic stories and testimonials demonstrating the t', 2500, 'We seek support for essential equipment to significantly expand our Golden Hour Silent Disco Programme for elderly care communities across the UK. \r\nSpecifically:\r\n100 additional wireless headphones (£2,500) - These specialised headphones feature individual volume control critical for elderly participants with varying hearing abilities and sensory sensitivities. Each headphone includes LED lights that show which channel is being enjoyed, creating visual connection points between participants.\r\nThis substantial equipment investment would transform our capacity to serve elderly care communities by:\r\n- Enabling simultaneous sessions in three different geographic areas across the region\r\n- Increasing our reach to approximately 150-200 elderly residents per week\r\n- Supporting care homes / groups in previously underserved communities\r\n- Allowing for larger group sessions where appropriate\r\n- Creating capacity for intergenerational events that connect elderly residents with younger community ', 0, '', 0, NULL, 'Provide monthly meetings with your executive team'),
(63, 72, 'The Lewis Foundation', 'The average cost of 1 gift due to our work with businesses and wholesalers is £3.60.\n\nWe help to:\n\nTo ensure the basic physical and mental needs of adult cancer patients are met when entering the hospital setting.\n\nTo minimise the isolation, loneliness and boredom experienced by adult cancer patients during appointments, treatments and hospital admissions.\n\nPrevent ‘Cancer Poverty’ by ensuring our service of our gift packs and support are free, to prevent income being a barrier.\n\nCreate volunteering opportunities for people of all ages and backgrounds, to create a community not only for the volunteers but for the cancer patients being supported.', 'At The Lewis Foundation we source, package and hand deliver gift packs for free to adult cancer patients in hospitals in the Midlands weekly. These are items that patients might find difficult to buy themselves or simply cannot afford – and that brings people happiness and comfort at a difficult time. For many people in hospital, our volunteers are their only regular visitors.\n\nHow it works in the hospital, is that patients pick a gift pack of their choice from our gift trolley and there are 29 different packs to pick from. Packs range from toiletries, puzzle books and miniature radios. Once the gift is received, we then spend time with people to reduce loneliness.', '2016', 1, 'The best way to demonstrate this is via feedback we receive on a daily basis:\r\n\r\n\'Great initiative at Northampton General Hospital. The Wordsearch gift gave mum something to do during the long wait to be seen. Thank you...\r\nPs the hand written card was a really nice touch.\'\r\nGraham Birtswistle\r\n\r\n\'I was gifted a \"The lewis foundation\" rehydration pack by by a specialist nurse. I was quite taken back when I opened it as there was a card, from a total stranger to me, that got me pretty chocked up as the chemo was going in to my arm. It was such a beautiful gesture at a very overwhelming time for me, been on my own thought treatment due to covid. Also the little pack of sweets, took me back to when my grandmother would give us these in the back of grandad van on route to\r\nCornwall, all those years ago (Chocolate limes). And the little water bottle with tiny squash STIX add to water, little drink mix was much needed for hydration. It was much needed. Thank you for caring.\'\r\nAngela Matthews', 40000, 'Financial Support: How you can be a part of making a difference through sponsorship\n\nWe currently spend around £40,000 a year funding the gift packs at the 17 hospitals we currently support.\n\nWe are seeking sponsorship support, to work in partnership with us to sponsor our gift packs at the existing hospitals that we support:\n\nNorthampton General Hospital, Kettering General Hospital, Milton Keynes University Hospital, Cambridge University Hospital, University of North Midlands Hospitals, Royal Stoke and County Hospital, Lincolnshire Hospitals, Grantham Hospital, Lincoln County and Boston Pilgrim, Sherwood Forest Hospital, Chesterfield Hospital, Nottinghamshire Hospital, Leicester Hospital, Luton & Dunstable Hospital, BMI Three Shires, Bedford Hospital\nIn addition to sponsorship to enable us to increase the number of gifts we provide meaning that we can expand to 15 others hospitals in the East of England. To enable us to do this we would need to double the current amount we are spending on our gift packs, which means we would need an additional £40,000.\n\nIf you gave us a sponsorship of:\n£2000 - Fund over 500 gifts\n£5000 - Fund over 1300 gifts\n£10000 - Fund over 3000 gifts', 40000, 'How you can be a part of making a difference through sponsorship\r\n\r\nWe currently spend around £40,000 a year funding the gift packs at the 17 hospitals we currently support.\r\n\r\nWe are seeking sponsorship support, to work in partnership with us to sponsor our gift packs at the existing hospitals that we support:\r\n\r\nNorthampton General Hospital, Kettering General Hospital, Milton Keynes University Hospital, Cambridge University Hospital, University of North Midlands Hospitals, Royal Stoke and County Hospital, Lincolnshire Hospitals, Grantham Hospital, Lincoln County and Boston Pilgrim, Sherwood Forest Hospital, Chesterfield Hospital, Nottinghamshire Hospital, Leicester Hospital, Luton & Dunstable Hospital, BMI Three Shires, Bedford Hospital\r\nIn addition to sponsorship to enable us to increase the number of gifts we provide meaning that we can expand to 15 others hospitals in the East of England. To enable us to do this we would need to double the current amount we are spending on our gif', 0, '', 0, '', 0, NULL, ''),
(64, 73, 'The JJeffect CIC', 'We had one goal to become the best at what we do setting new standards in our field of anti-knife crime and criminal activity meaning we are now multi award winning including the BBC education of the year.\nWe are honoured to work with many organisations across the Northwest and across the UK. As we develop our reputation across the region, we will continue to focus our work on our home, Preston, Lancashire and surrounding areas. More recently we have joined forces with Preston North End, Community Outreach &Network Services, amongst many other organisations across the city.\nOur style, one of the most powerful\nThe unique services we offer are that we are relatable to the young people we work with. They can see them-selves in us; they are able to talk to us and know they will be understood. We have developed our style having presented to approximately 200,000 young people. This is evidenced by the immense number of positive reviews, feedback, emails thanking us, and face to face acknowledgements after the presentations, these re-views can be found via our <a target=\'_blank\' href=\"https://www.facebook.com/TheJJeffect18/\"> Facebook Page</a>', 'The JJ Effect - Introduction\r\nI established the JJ Effect following the murder of my brother Jon-Jo in 2014.\r\nSince then, I have drawn on my experience to become the best anti knife speaker in the UK.', '2019', 1, 'We have hundreds of impact statements and Uclan reports on our work across the UK.', 24000, 'Financial Support: We have always needed a committed bit writer to help us with funding applications and this is a must so we can achieve our future plans and goals.', 24000, 'We have always needed a committed bit writer to help us with funding applications and this is a must so we can achieve our future plans and goals.', 0, '', 0, '', 0, NULL, ''),
(65, 74, '4-year establishment plan', 'The BERG F is a not-for-profit social enterprise committed to utilising your social impact funding to nurture the next generation of independent scientists and advance health science. We address this global challenge while expediting research findings for practical community-based solutions, bridging the gap between academia and healthcare.\r\nWe present three distinct opportunities for your engagement:\r\nConnect-into Research: Seamlessly support ongoing research through crowd-sponsorship ensuring your involvement is recognized and celebrated throughout the region. (£1000 - £5000)\r\nSponsor a Full PhD Studentship: Directly connect with a PhD candidate and research project, mobilizing your founding', '\"Unleash the Power of Sponsorship to Transform Health &Extend Lifespan.\r\nDiabetes, heart disease, stroke, cancers, dementia, &depression: ailments that amass substantial research funding for symptom suppression drugs, rather than prevention &cure.\r\nYour sponsorship nurtures independent science &scientists dedicated to enhancing life &extending health span.\"\r\n', '2022', 1, 'The Berg F was globally founded originally as Bioenergetics Research Group (BERG) 2011. The work has been fundamental to medical practice at a community level through partners.', 16000, 'Financial Support: The BERG F has grown out of the Bioenergetics Research Group based at The University of Northampton which was established in 2011.\r\nThe social enterprise aspect is looking to expand beyond just supporting in-house research to channelling much needed funding into health research across academic institutions in order to develop the health science and scientists of tomorrow.\r\nAt the same there is a need collate and then disseminate new understandings so that they reach beyond academic journals into real community-based health solutions.\r\nOver the next 4 years the BERG F is looking to fund 12 Studentships at a cost of £160 000 each and 4 post doctorial fellowships as a cost of £300 000 each.', 16000, 'The BERG F has grown out of the Bioenergetics Research Group based at The University of Northampton which was established in 2011.\r\nThe social enterprise aspect is looking to expand beyond just supporting in-house research to channelling much needed funding into health research across academic institutions in order to develop the health science and scientists of tomorrow.\r\nAt the same there is a need collate and then disseminate new understandings so that they reach beyond academic journals into real community-based health solutions.\r\nOver the next 4 years the BERG F is looking to fund 12 Studentships at a cost of £160 000 each and 4 post doctorial fellowships as a cost of £300 000 each.', 0, '', 0, '', 0, NULL, ''),
(66, 75, 'The Whole School Approach to Outdoor Learning', 'The objective of the project is to support schools to sustainably integrate outdoor learning whilst linking with raising standards agendas.\nFor Just £2000 per school we support that school by offering:\n-Outdoor Lead training\n-CPD including leadership, core subject training, professional support e.g. Occupational Therapists\n-Create an online community for schools to network\n-Access to a curriculum linked bank of activities.\n\nIn doing so we are supporting:\n-obesity agenda by providing more active learning opportunities\n-nature connection\n-wellbeing of children and staff\n-more opportunities for children to learn in an active, memorable way\n-school attendance\n-research into the impact of curriculum linked outdoor learning', 'Through our Teach Outdoors programme, we provide training and support to teachers, enabling them to confidently incorporate outdoor learning throughout their school community.\nWe offer training, support from professionals, and curriculum resources to support ALL children.\nProviding more opportunities for all children to access the curriculum and achieve their potential in life.\nPlease come read more about Teach Outdoors.', '2022', 1, 'We are currently collecting impact data on wellbeing and involvement on a set group of children in our initial schools. Already we are seeing a cultural change and children engaging in learning.', 40000, 'Financial Support: By partnering with us as a sponsor, you have the opportunity to help us take this initiative to the next level by continuing to support more schools, create new resources and evaluate the impact through research.\nYou can help us to reach more children and provide them with more opportunities to develop the skills and knowledge they need to succeed and feel valued in society?\nCurrently Teach Outdoors has over 12 schools interested in signing up for the whole school programme.\nNow we need sponsor to help them on their journey!?\n£2000 per school means from the most basic?\nsponsorship to multiple school you can have an effect on preventing the issues of tomorrow by helping our youngest learners today.\nWith this support we would like to continue developing the project content, CPD support and encouraging more schools to participate through fully funded places, whilst collecting research data in collaboration with Northampton University to evaluate the wider social impact.\nTeach Outdoors thanks you whether you support a single school or discuss being involved in multiple schools covering a region and assisting with our core funding, at any and all stages you are investing in our future communities.', 40000, 'By partnering with us as a sponsor, you have the opportunity to help us take this initiative to the next level by continuing to support more schools, create new resources and evaluate the impact through research.\r\nYou can help us to reach more children and provide them with more opportunities to develop the skills and knowledge they need to succeed and feel valued in society?\r\nCurrently Teach Outdoors has over 12 schools interested in signing up for the whole school programme.\r\nNow we need sponsor to help them on their journey!?\r\n£2000 per school means from the most basic?\r\nsponsorship to multiple school you can have an effect on preventing the issues of tomorrow by helping our youngest learners today.\r\nWith this support we would like to continue developing the project content, CPD support and encouraging more schools to participate through fully funded places, whilst collecting research data in collaboration with Northampton University to evaluate the wider social impact.\r\nTeach Outdo', 0, '', 0, '', 0, NULL, ''),
(68, 77, 'Starting Point', 'Starting Point offers local, long-term, 1:1, relational, tailored, and holistic support to young people who face disadvantage:\nAttain, sustain, and thrive within a job, college course or apprenticeship.\nPrevent exclusion and increase positive engagement in education.\nSteer away from crime, violence, substance abuse or misuse, or risk-taking behaviour.\nMake positive changes in their socio-emotional development and wellbeing.', 'Starting Point enables young people who face disadvantage to see transformation in their lives - we passionately believe every young person should have the chance of a brighter more hopeful future.', '2012', 1, '90% at risk of exclusion will remain in education 100% excluded will successfully integrate back into mainstream education 75% at risk of becoming NEET will transition into further education/employment 75% will access EET 25% will continue accessing support until able to achieve & sustain EET 65% will grow work-ready skills 60% will access additional opportunities (work experience/volunteering/social groups/mock interviews/young person support fund) 30% will access our young-person-led media production initiative (meaningful work experience in a creative industry)', 60000, 'Financial Support: Finance, Equipment, Training, Staff, Volunteers', 60000, 'Finance, Equipment, Training, Staff, Volunteers', 0, '', 0, '', 0, NULL, ''),
(69, 78, 'School Navigators Programme', 'Using SOFEA\'s expertise in youth work to maintain young people at risk of exclusion in education between ages of 11-16 (Secondary).\nTo develop relationships with young people that due to exclusion may be at risk of offending or becoming NEET.\nPromote positive choices through guided support and communication to the community that surrounds the young person.\nPlan and understand what life can look like if a positive opportunity and choice is taken or strived for.\nSharing this to everyone who supports the young person, increasing the possibility of success.\nPersonalising the experiences of the young people and understanding the current cause of their issues and related behaviours.', 'The School Navigators Programme is specifically designed to maintain young people in education who are at risk of exclusion.', '2022', 1, 'In year one of the project 100 young people in six schools around Milton Keynes were met regularly by the SOFEA outreach team.\r\nFeedback from parents and teachers was overwhelmingly positive. Young people felt supported and listened to increasing their engagement with individual teachers and schools.\r\nDetailed statistics on wellbeing of each individual young person are also available. The programme saw rises in all key areas of each young person.', 150000, 'Financial Support: Funding for additional staffing.', 150000, 'Funding for additional staffing.', 0, '', 0, '', 0, NULL, ''),
(70, 79, 'Shrewsbury and Oswestry Crucial Crew', 'We hold an event over a two week period in June every year. This is attended by up to 1500 children from 40 to 60 primary schools in the Shrewsbury and Oswestry area of Shropshire. The children receive social awareness and safety training as a means of teaching them essential life skills. The event has been running for  30 years during which time over 35,000 children have attended.', 'Why is this important to our community?\nCrucial Crew provides today’s children with an opportunity to acquire essential life skills at an impressionable time in their development. At Crucial Crew, children learn of the dangers of drugs, internet abuse and bullying, stranger danger, the effects of hoax calls etc. For many organisations, it is a rare and most cost-effective opportunity to raise awareness of the many dangers of the sea, water, electricity, gas, railways, poor hygiene, smoking, vaping, building sites, internet, dog awareness, alcohol abuse and farm situations. As a result of attending, they are more confident in themselves and in a better position to make a positive contribution to their communities as they mature into junior citizens. The children also take this information back to their families, and members of their communities who may not have been privileged to receive this training.', '2008', 1, 'The event has been running for 30 years during which time over 35,000 children have attended.', 10000, 'Financial Support: Please speak with Jay Baughan', 10000, 'Please speak with Jay Baughan', 0, '', 0, '', 0, NULL, ''),
(71, 80, 'Building Respectful Families', 'supporting young people to reduce and stop abusive and violent behaviours\nreduction in the number of police call-outs for domestic incidents involving children\nsupporting families to improve communication and repair relationships\nsupporting both parent/carers and young people to improve their mental health and wellbeing\nsupporting young people to recognise their strengths and grow in confidence\nreducing the likelihood of a young person going on to use abusive behaviours in adult relationships', 'BRF provides support to families experiencing Child and Adolescent on Parent Violence and Abuse (CAPVA).\nWe work with both parent/carer and young person to address behaviours and improve communication.', '2015', 1, 'In our evaluation report published in May 2022 we were able to evidence that BRF does reduce violent behaviours and improves parental mental wellbeing.', 200000, 'Financial Support: CAPVA is an underreported and heavily stigmatised issue and we are aware that there are many families around the Thames Valley who are not accessing any form of support.\nWith additional resource we would be able to reach more families at a crucial point, helping them to access the support they need to rebuild their lives.\nAdditional funding could support us to increase staffing around the region.', 200000, 'CAPVA is an underreported and heavily stigmatised issue and we are aware that there are many families around the Thames Valley who are not accessing any form of support.\r\nWith additional resource we would be able to reach more families at a crucial point, helping them to access the support they need to rebuild their lives.\r\nAdditional funding could support us to increase staffing around the region.', 0, '', 0, '', 0, NULL, ''),
(72, 81, 'Violence and Crime Reduction Through Digger and Forklift Training', 'We aim to engage young people across Birmingham and Solihull who are involved in low level crime/at risk of crime through education and personal development to gain skills and qualifications in both Digging and Forklifting to eventually leave to do either apprenticeships or full-time work. We would like to develop this programme to 20 students who will engage in the programme and leave qualified.', 'Reducing Violence, Youth Engagement, Educating Young People, Personal Development for Young People, Gaining Employability Skills, Encouraging Positive Impact', '2023', 1, 'Yes, 5 out of 7 students went onto Paid Employment, Apprenticeships or Further Education. The remaining 2 stayed at Riverside for continued development.', 1000, 'Financial Support: Folders, Tutors, Classroom Equipment (Pens, Pencils, Rulers, etc), Vehicle Maintenance, CSCS cards, and eventually, more classrooms.\nAs this is an existing program then funding per person will pay towards all existing and on-going costs.\n£1,000 per person and this is scalable.\nShould you wish to look at larger values we have other programs that we can offer as well.', 1000, 'Folders, Tutors, Classroom Equipment (Pens, Pencils, Rulers, etc), Vehicle Maintenance, CSCS cards, and eventually, more classrooms.\nAs this is an existing program then funding per person will pay towards all existing and on-going costs.\n£1,000 per person and this is scalable.\nShould you wish to look at larger values we have other programs that we can offer as well.', 0, '', 0, '', 0, NULL, '');
INSERT INTO `CSE_ProjectDetail` (`pro_id`, `cse_id`, `pro_Name`, `pro_Purpose`, `pro_KeyObjectives`, `pro_StartYear`, `pro_CollectData`, `pro_Impact`, `pro_RequiredSponsorship`, `pro_AdditionResourcesNeeded`, `pro_fAsk`, `pro_fAskDetails`, `pro_eAsk`, `pro_eAskDetails`, `pro_pAsk`, `pro_pAskDetails`, `pro_pccfunding`, `pro_pccfundingDetails`, `pro_businessBenefits`) VALUES
(73, 82, 'Equine-assisted greencare to support disadvantaged children and young people\'s (CYP) wellbeing and mental health', 'RH provides riding lessons supplemented with clubroom-based activities aimed at promoting happiness, building social skills, and engendering self-confidence.\nAll CYP have poor wellbeing on arrival at Ride High and our primary objective is to help them improve their wellbeing.\nWe define wellbeing as being comfortable, healthy and happy and look at specific characteristics to create an overall assessment of a young person\'s wellbeing. Ride High does this by:\n\n1.Helping children and young people to develop skills, capacities, and capabilities to enable them to participate in society as independent, mature, and responsible individuals\n2.Advancing education\n3.Providing sport, recreational and leisure-time activity in the interests of social welfare for CYP in need on account of social and economic circumstances and/or mental health challenges with a view to improving their conditions of life.\n4. Holding reunion events to understand how children and young people are progressing once they move on from Ride High.', 'Ride High supports at risk young people, referred by professionals, with a riding &clubroom-based programme, empowering them to develop new skills, renew hope and build greater resilience.', '2008', 1, 'Our approach measures six areas which capture the broad range of issues faced by members: emotional resilience, self-awareness and control, relationships, communication, self-esteem and confidence, and contribution.\r\nOur 2022 impact figures showed very positive results: 77% recorded an overall increase in wellbeing. 68% saw a significant increase in self-esteem & confidence. 68% improved their communication skills 75% made progress in self-awareness and control 59% enjoyed better relationships 51% were able to contribute more. Since it\'s establishment in 2008, Ride High has helped more than 1800 disadvantaged children and young people. We now aim to help 120 every week and over 300 per year, who attend a programme lasting at least 12 weeks.', 15000, 'Financial Support: Our waiting list currently stands at over 50 children and young people referred by professionals.\nWe urgently need extra funding to pay for places on our programmes to help reduce our waiting list enabling Ride High to help more vulnerable children.\nFor each 12-week programme benefiting 8 children, the costs are as follows:\nSalaries, NI, pension etc The total £1,408 per child would be £11,264 for 8 children\nThis can be broken down to: £810 per child and therefore £6,480 for 8 children\nRiding Lessons £255 per child and therefore £2,040 for 8 children\nTransport £78 per child and therefore £624 for 8 children Facilities ?259 per child and therefore £2,072 for 8 children\nClothing & resources £6 per child and therefore £48 for 8 children\nAs you can see, we have placed our \"Ask\" for batches of 8 children and an uplift to allow funds directly to core funding as well. Ride high would love your assistance have as many batches as possible of 8 children to participate and thank you in advance.', 15000, 'Our waiting list currently stands at over 50 children and young people referred by professionals.\nWe urgently need extra funding to pay for places on our programmes to help reduce our waiting list enabling Ride High to help more vulnerable children.\nFor each 12-week programme benefiting 8 children, the costs are as follows:\nSalaries, NI, pension etc The total £1,408 per child would be £11,264 for 8 children\nThis can be broken down to: £810 per child and therefore £6,480 for 8 children\nRiding Lessons £255 per child and therefore £2,040 for 8 children\nTransport £78 per child and therefore £624 for 8 children Facilities ?259 per child and therefore £2,072 for 8 children\nClothing & resources £6 per child and therefore £48 for 8 children\nAs you can see, we have placed our \"Ask\" for batches of 8 children and an uplift to allow funds directly to core funding as well. Ride high would love your assistance have as many batches as possible of 8 children to participate and thank you in advance.', 0, '', 0, '', 0, NULL, ''),
(74, 83, 'Family Support and training for private and professional organisations', 'We do this by supporting families and children through emotional regulation skills to reduce violence, self harm and other mental health challenges. We provide therapeutic, child centred, strategies to support positive mental health, reduce violence in the home and at school, reduce stress levels among family members, increase understanding and protrude training in schools and other organisations.\n\nWe exist for the children who don\'t fit the boxes, the free spirits, the wave-makers, the innovators. These are the children that cannot comply; even when they want to. Who can not do \'the thing\', even when they have chosen \'the thing\' ...  begged for the thing ... then suddenly the weight of expectation renders them incapacitated.\n\nSome of them have labels! in fact all of them have labels, just some are given by doctors and psychiatrists and others are given by society.\n\nAt some point in our evolution, somebody decided to box up \'normal\' based on traits of the vast majority. Those that did not fit those boxes were deemed sick, broken, deficient and given a label, autistic, neurodivergent, ADHD, PDA, anxious, selfish, sociopathic, disruptive, naughty, oppositional, stubborn, feral, just to name a few.\n\nBut deep down you know they are not deficient ... they are wired up differently, wired up to never forget that they are born free and that they have everything they need to thrive in this world... if only they had the autonomy, trust and independence to do so their own way.\n\nWe are also here for the parents, grandparents, friends, teachers, carers, brothers, sisters, aunts and uncles ... the ones who have been made to feel like you are just not trying hard enough, doing what you should, not setting boundaries, being too soft, being too strict, not giving enough stickers and praise, giving too many stickers, making things up, imagining things.', 'Raising a Wild Child offers therapeutic family support for neurodivergent children and their families. We allow them feel heard, understood and supported. We provide guidance, tools and solutions that enhance the lives of both children and their family in and outside the home environment.\n\nRaising a Wild Child (RAWC) is a safe and supportive space for all those wild children and those raising them!', '2020', 1, 'Yes but we are in the process of analysing and presenting the data', 3000, 'Financial Support: Connections to other organisations working in this space Community and Collaboration Funding where possible Tech advice and development.\r\n£3,000 means we allocate £2,500 for a 3 month programme for the family and £500 towards our core costs.\r\nObviously we can expand this in multiples.\r\nI will add more about what the course comprises of and how the journey runs for the family.', 3000, 'Connections to other organisations working in this space Community and Collaboration Funding where possible Tech advice and development.\n£3,000 means we allocate £2,500 for a 3 month programme for the family and £500 towards our core costs.\nObviously we can expand this in multiples.\nI will add more about what the course comprises of and how the journey runs for the family.', 0, '', 0, '', 0, NULL, NULL),
(75, 84, 'Sport in Communities', 'Premier League Kicks utilises football, sport and the power of the Preston North End badge as a tool to engage young people.\n\nThe programme consists of diversionary activity aiming to target those at risk of ASB and who may be deemed vulnerable within the community.\nStaff drop in on Multi Use Games Areas within the LSOA\'s to work with young people, giving them a focus for their time, but also allowing relationships to be built in order to support the young people in further areas of their lives.', 'Offer more opportunities to play, coach, and officiate\nEnhance physical and mental wellbeing\nCreate a culture of volunteering, social action, and positive role models\nWork with young people to reduce violent behaviour and develop pro-social attitudes and skills\nProvide pathways into education, training, and employment', '2006', 1, '2023/24 Season Total Engagements = 656\r\nNumbers of Hours delivered = 1,742 Hours Number of Sites\r\nDelivered at = 21\r\nPR1 Decrease of ASB cases by 22.69%\r\nPR2 Decrease of ASB cases by 24.44%\r\nPR7 Decrease of ASB cases by 20.43% 84%\r\n\r\ndescribed their mood as very happy after attending our PL Kicks sessions.\r\n100% of attendees are more physically active by coming to sessions weekly.\r\n93% of attendees admit they feel comfortable being themselves at PL Kicks sessions.\r\n72% of attendees feel more confident at dealing with stressful situations.\r\n81% of attendees get along better with people from different backgrounds.\r\n86% of attendees are more confident about themselves.\r\n83% of attendees feel more positive about their future.\r\n95% of attendees are more active and enjoy playing sports more.\r\n64% of participants feel safer in their community having a safe space to play.\r\n31% of participants are more aware of the dangers young people face in their community.\r\n48% of participants have a more p', 9120, 'Financial Support: 51 weeks of delivery\r\ndelivering one weekly football session in the community for up to 32 children at one venue.\r\nStaffing costs for 2 staff members for 2 hours at the venue: £6100\r\nEquipment costs (Balls, Bibs, Cones, Seasonal Equipment): £1500\r\nTotal Cost: £7600\r\n20% core running costs: £1520', 9120, '51 weeks of delivery\ndelivering one weekly football session in the community for up to 32 children at one venue.\nStaffing costs for 2 staff members for 2 hours at the venue: £6100\nEquipment costs (Balls, Bibs, Cones, Seasonal Equipment): £1500\nTotal Cost: £7600\n20% core running costs: £1520', 0, '', 0, '', 0, NULL, NULL),
(76, 85, 'Family Matters', 'Provision of support\r\nAdvocacy through the CJS\r\nConnecting and managing contact with social care, police, courts and prison\r\nHelping the non offending parent to cope and therefore be better equipped to support their children\r\nCreating peer support spaces', 'Providing support to families and children left behind after a warrant is executed and arrest made for in line child sex abuse - not classed as victims by the MOJ but in need of support from impact', '2021', 1, 'Full evaluation showed a major positive impact for families and also for police officers arresting the offending partner - knowing they could refer to support services where no other exists', 30000, 'Financial Support: £30,000 = up to 100 referrals The current funding supports service in Thames Valley and West Mercia but we want to spread this service elsewhere as there are no other 1-2-1 service in the space exists nationally.', 30000, '£30,000 = up to 100 referrals The current funding supports service in Thames Valley and West Mercia but we want to spread this service elsewhere as there are no other 1-2-1 service in the space exists nationally.', 0, '', 0, '', 0, NULL, NULL),
(77, 86, 'Reclaiming Voices - Empowerment through Creative Healing.', '1.Maximised Impact and Reach: Extend support to adult female survivors of sexual assault, ensuring a comprehensive healing experience using creative expression techniques for sexual assault, domestic (Women and children) and racial abuse survivors.\n2.Consistent Empowerment Through Tailored Support: Empower survivors through intensified, targeted sessions, fostering community resilience and inclusivity.\n3.Positive Community Perception and Collaboration: Enhance the community\'s perception of trauma support by making sessions accessible for each survivor group and fostering collaborative healing experiences.\n4.Educational Empowerment for Lasting Impact: Incorporate additional educational components into sessions, contributing to survivors? enduring positive change and personal development.\n5.Resource Optimisation and Efficient Sponsorship Use: Efficiently utilise resources for three weekly sessions, maximizing the programs impact and demonstrating efficient use of sponsorship support.\n6.Championing Empowerment for Sexual Assault Survivors: Empower sexual assault survivors on their unique healing journey, addressing specific challenges, and championing resilience through valued sponsorship.\n7.Establishing Safe Spaces and Community Support: Create safe, confidential spaces, and establish a robust support network, ensuring survivors feel respected, understood, and protected.\n8.Tailored Programs and Inclusive Community Narratives: Develop specialised support programs, challenge stereotypes through inclusive narratives, and foster understanding within the community.\n9.Community Engagement and Integration: Facilitate collaborative engagement with local authorities, organisations, and community members, reinforcing survivors? roles in community life.\n10.Advocacy for Trauma-Informed Services: Advocate for trauma-informed community services, ensuring an environment where survivors feel supported and respected.\n11.Peer Mentorship and Empowerment Workshops: Implement peer mentorship programs and empowerment workshops, fostering a sense of community, shared strength, and personal growth.', 'As a new company we intend to achieve\n1. Empowerment: - Boost self-esteem and resilience in survivors through tailored therapeutic support.\n2. Community Resilience: - Foster collaboration | reduce stigma | and encourage mutual support.\n3. Socioeconomic Upliftment: - Economic empowerment initiatives contributing to stability and financial well-being.\n4. Reduced Repeat Victimisation: - Address trauma to decrease susceptibility to repeat victimisation.\n5. Employment Opportunities: - Improve chances of employment for survivors | enhancing economic independence.\n6. Enhanced Community Perception: - Shift community perception towards understanding and empathy.\n7. Improve Mental Health Access: - Early intervention for improved mental health outcomes.\n8. Educational and Personal Development: - Empower survivors through education | fostering resilience and agency.\n9. Community Inclusivity: - Create an inclusive community challenging stereotypes.\n10. Long-Term Social and Economic Benefit: - Creating lasting benefits for survivors and the community.', '2023', 0, '', 21220, 'Financial Support:To broaden our impact:Scaling from one to three weekly sessions to empower more survivors, now including adult female survivors of sexual assault alongside domestic and racial abuse clients.', 21220, 'To broaden our impact:Scaling from one to three weekly sessions to empower more survivors, now including adult female survivors of sexual assault alongside domestic and racial abuse clients.As a new company we intend to achieve\n1. Empowerment: - Boost self-esteem and resilience in survivors through tailored therapeutic support.\n2. Community Resilience: - Foster collaboration | reduce stigma | and encourage mutual support.\n3. Socioeconomic Upliftment: - Economic empowerment initiatives contributing to stability and financial well-being.\n4. Reduced Repeat Victimisation: - Address trauma to decrease susceptibility to repeat victimisation.\n5. Employment Opportunities: - Improve chances of employment for survivors | enhancing economic independence.\n6. Enhanced Community Perception: - Shift community perception towards understanding and empathy.\n7. Improve Mental Health Access: - Early intervention for improved mental health outcomes.\n8. Educational and Personal Development: - Empower surviv', 0, '', 0, '', 0, NULL, NULL),
(78, 87, 'Space to Learn', 'Improve outdoor learning provision in Sheffield. Create an ecology of support for learning outdoors in South Yorkshire.', '1) Develop improved outdoor learning, including physical spaces in schools across Sheffield and South Yorkshire\n2) Build an ecosystem of local businesses and funding sources to enable facilitation of alternative provision in outdoor spaces\n3) Encourage a generation of environmental stewards through increasing local people\'s connection to their local natural spaces.\n4) Raise awareness of wellbeing needs in S Yorkshire\n5) Improve health and wellbeing in communities through outdoor learning, including through growing and cooking healthier foods.\n6) Create pathways for young people to training in outdoor environments\n7) Increase biodiversity significantly across school estate in South Yorkshire (10X)', '2021', 0, '', 49000, 'Financial Support: Funding of this project is in three stages. There are 151 schools in Sheffield. Our long term goal (5 years) is to create biodiverse spaces in all schools. In 50% to develop garden spaces that enable curriculum focused learning.\n\nStage 1. Pilot.\nDesign and Develop Outdoor Learning Gardens in 3 Partner Schools and at our HQ at Roots Allotments.\nRoots HQ\nWharnecliffe\nBents Green School at Gleadless\nAbbey Lane Primary\n\n£11,500 - Material Costs for 4 garden spaces. Including costs associated with oversight by Case Evans and Care Architects\n£11,500 - 1 day per week alternative provision at school sites. Inc all staffing costs.\n£22,500 -2 days community Provision at Roots HQ for local young people and community groups in collaboration with local council teams for Youth Services, Refugee engagement, Families. Inc all staffing Costs.\nDeliver Saturday workshops days for local community groups at Roots HQ\n£585 - Insurance Costs\n£1800 - Digital Footprint Costs\n£295 - Accountancy\n£640 - Volunteer Travel', 49000, 'Funding of this project is in three stages. There are 151 schools in Sheffield. Our long term goal (5 years) is to create biodiverse spaces in all schools. In 50% to develop garden spaces that enable curriculum focused learning.\r\n\r\nStage 1. Pilot.\r\nDesign and Develop Outdoor Learning Gardens in 3 Partner Schools and at our HQ at Roots Allotments.\r\nRoots HQ\r\nWharnecliffe\r\nBents Green School at Gleadless\r\nAbbey Lane Primary\r\n\r\n£11,500 - Material Costs for 4 garden spaces. Including costs associated with oversight by Case Evans and Care Architects\r\n£11,500 - 1 day per week alternative provision at school sites. Inc all staffing costs.\r\n£22,500 -2 days community Provision at Roots HQ for local young people and community groups in collaboration with local council teams for Youth Services, Refugee engagement, Families. Inc all staffing Costs.\r\nDeliver Saturday workshops days for local community groups at Roots HQ\r\n£585 - Insurance Costs\r\n£1800 - Digital Footprint Costs\r\n£295 - Accountancy\r\n£', 0, '', 0, '', 0, NULL, NULL),
(80, 89, 'Phoenix Programme', 'For these young women to:\n- Feel empowered.\n- Increase their confidence and self-esteem in everyday life.\n- Explore current topics such as healthy relationships and social media.\n- Develop positive coping strategies.\n- Understand the movement of women\'s and girls rights\n- Not feel alone and form friendships with other young women who come from a \'similar space\'.\n\nGRASAC recognises that family can be crucial to a survivors healing journey, but it can affect their own health and well-being. Therefore, alongside Phoenix, offer an informal, confidential safe space for the family of the young person attending to:\n- understand how being a victim of sexual violence can impact on an individual;\n- discover how they can best support the person they care for, whilst looking out for themselves;\n- seek and offer peer support from/to other parents attending the group;\n- ask questions and seek support from members of the GRASAC team.', 'This is an opportunity for young women aged 14 to 16, who had been affected by sexual violence to participate in positive activities and to not feel alone.\nWe would like to run the programme three pa.', '2023', 1, 'Quantitative data collection demonstrated 100% of the participants felt safe and respected in and by the group, and gave the programme an overall rating of excellent.\r\nActivities rated most highly by the group members included crafts; planting pots of seed to grow and blossom, these young women will also be learning coping strategies, creating self-care boxes; exploring the topics of empowerment, forming healthy relationships and, an opportunity for hope and reflection.\r\nFeedback from the young women included:\r\nThank you for taking the time to help us along our journey to peace and recovery. - The sessions have helped start the healing process.\r\nIt has made me realise my strength.\r\nThank you for everything this group has helped me with.\r\nI\'ve always wanted a support network of people who understand, but was unable to get it.', 5000, 'Financial Support: Per 6 week Programme Transport costs -\nsome of the clients require taxi transport in order to attend the GRASAC offices for the evening programme £475\nArt Materials £170\nBooks - You don\'t Owe Me Pretty £95\nJournals for reflection, hope, journaling £80\nRefreshments £40\nSelf-care Boxes £95\nStaffing Costs: £596', 5000, 'Per 6 week Programme Transport costs -\r\nsome of the clients require taxi transport in order to attend the GRASAC offices for the evening programme £475\r\nArt Materials £170\r\nBooks - You don\'t Owe Me Pretty £95\r\nJournals for reflection, hope, journaling £80\r\nRefreshments £40\r\nSelf-care Boxes £95\r\nStaffing Costs: £596', 0, '', 0, '', 0, NULL, NULL),
(81, 90, 'Young Carers Programme', 'Develop confidence and self esteem\r\nPromote Social Inclusion\r\nPromote positive mental health and wellbeing\r\nDevelop a sense of belonging\r\nDevelop essential life skills', 'This project supports young carers aged 5-17 in Leicester\'s most deprived areas, addressing their unique challenges through mentoring, skills workshops, and holistic family support.\n\nWeekly mentoring sessions improve school attendance and engagement, while life skills workshops teach essential skills like budgeting, cooking, and first aid. Families receive resources, food assistance, and guidance to access critical services.\nThe project provides social activities, including a youth club and enrichment opportunities, which fosters confidence, supports mental health and develops a sense of belonging.', '2022', 0, '', 50000, 'Financial Support: £1,666 - One young carer will receive 36 weeks of mentoring plus access to a youth club and enrichment opportunities. This equates to £46 per week.\r\n£50,000 will cover costs for 30 young carers to engage in the programme', 50000, '£1,666 - One young carer will receive 36 weeks of mentoring plus access to a youth club and enrichment opportunities. This equates to £46 per week.\n£50,000 will cover costs for 30 young carers to engage in the programme', 0, '', 0, '', 0, NULL, NULL),
(82, 91, 'Street Imps', 'Street Imps empowers young people by harnessing the transformative power of sport and physical activity.\n\nThe project provides free, accessible sessions in safe and inclusive environments, encouraging young participants to develop essential life skills, foster positive social behaviours, and build resilience.\n\nTargeting those at risk of anti-social behaviour, youth violence, or from high-need areas, Street Imps offers opportunities for personal growth through mentoring, structured sports, and physical activities. It aims to break down barriers, improve wellbeing, and inspire young people to achieve their full potential.', 'Building Emotional and Social Skills: Helping young people develop teamwork, leadership, and communication skills through sports and mentoring.\nReducing Anti-Social Behaviour: Providing a safe environment for positive activities to divert participants from negative influences.\nImproving Physical and Mental Wellbeing: Encouraging healthier lifestyles through regular physical activity, which supports mental health and fitness.\nInspiring Personal Development: Fostering resilience and self-confidence by setting personal goals and promoting growth beyond sports.', '2021', 1, '', 22000, 'Financial Support: We seek both financial and non-financial support to sustain and expand the Street Imps project over the next 12 months. Financial contributions would support session delivery facility hire and mentor training. Non-financial support might include venue access marketing volunteering or equipment donations. Our estimated requirement is £24000 including £20000 for direct delivery and £4,000 (20%) for core organisational costs enabling inclusive sports and mentoring for 240 young people at risk of anti-social behaviour. Contributions of any size are welcome with clear outcomes for supported participant places.', 22000, 'We seek both financial and non-financial support to sustain and expand the Street Imps project over the next 12 months. Financial contributions would support session delivery facility hire and mentor training. Non-financial support might include venue access marketing volunteering or equipment donations. Our estimated requirement is £24000 including £20000 for direct delivery and £4,000 (20%) for core organisational costs enabling inclusive sports and mentoring for 240 young people at risk of anti-social behaviour. Contributions of any size are welcome with clear outcomes for supported participant places.', 0, '', 0, '', 0, NULL, NULL),
(83, 92, 'MK Breakers Community Basketball', 'We give young people in the city of Milton Keynes the opportunity to play sport in a safe indoor space throughout the year.  Through our community basketball league we also provide a space for young people to play competitive basketball without having to leave MK.\n\nWe give young people the opportunity to be part of and influence a sports club that truly represents the people of Milton Keynes and their diversity by including them in our decision making as an organisation, as we look to develop the next generation of leaders and change makers through the vehicle of basketball.\n\nFor our members that excel at basketball we have a pathway that enables them to play in the junior national league, for those that really excel and get offered scholarships and placements in Europe and the USA we offer advice and support to them and their families, from our experienced team who have been on that journey themselves.', 'A community basketball club dedicated to developing basketball in Milton Keynes &surrounding areas.\n\nWe offer community basketball for boys and girls aged 4-18 in 6 basketball centres across the city.\n\nWe are working with the young people of Milton Keynes to create a vibrant sports club that represents the diversity and strength of our city.', '2020', 0, 'We work with circa 1000 young people a week at our community basketball sessions.\r\nThis year alone we have 33 boys and girls selected for the Basketball England Aspire ( talent) programme and Basketball England awarded the best U13 boy U16 girl in the country to players on our programme.\r\nWe have players every year leave to take up scholarships in Europe and the USA off the back of their success playing basketball | something we are hugely proud of.\r\nOur men\'s team just won the national cup final and in the squad were 4 players that have come through our age grade system and are still playing for the basketball academy at a local school.\r\nWe have an ex participant that has been drafted in the first round of the NBA and is playing at the highest level for the San Antonio Spurs\r\nWe are delivering upwards of 75 hours worth of sessions a week to boys and girls so the positive impact that must be having on the physical and mental wellbeing of our participants is priceless.', 5000, 'Financial Support: To enable us to deliver our community programme for a year to 1 young person is £500 this cost is made up of coaching time and court hire.\nFor this a young person gets access to weekly sessions out of 6 centres across the city, all of these are post 17:00 so alongside the physical/social/emotional development of participants we also know that they are occupied in the hours where youth offending is the highest due to lack of provision for young people.\n\nWe want to extend the delivery of our programme to 100 more young people so we can welcome them into the Breakers family, the cost of this for a year would be £50,000\nThis can be also seen as batches of 10 young people as £5000\n\nOf course the more money we raise the more young people we can assist.', 5000, 'To enable us to deliver our community programme for a year to 1 young person is £500 this cost is made up of coaching time and court hire.\r\nFor this a young person gets access to weekly sessions out of 6 centres across the city, all of these are post 17:00 so alongside the physical/social/emotional development of participants we also know that they are occupied in the hours where youth offending is the highest due to lack of provision for young people.\r\n\r\nWe want to extend the delivery of our programme to 100 more young people so we can welcome them into the Breakers family, the cost of this for a year would be £50,000\r\nThis can be also seen as batches of 10 young people as £5000\r\n\r\nOf course the more money we raise the more young people we can assist.', 0, '', 0, '', 0, NULL, NULL),
(85, 94, 'Providing innovative workshops for teenagers not in school', 'The Streams Learning Hub is a co-learning space for teenagers outside the school system, offering in-person workshops, online education, and a supportive community.', '1. **Empowering Young People:** We support diverse learners, including neurodivergent teenagers struggling with anxiety (often school related trauma), in shaping their own educational journey.\r\n2. **Removing Barriers:** We improve access to education by addressing gaps in awareness, technology, and viable learning options.\r\n3. **Creating a Safe Space:** The Hub provides a supportive, low-demand environment where young people can rebuild confidence and thrive.\r\n4. **Reimagining Education:** We explore personalised, well-being-focused learning models through collaboration with young people, parents, and educators.\r\n5. **Building Sustainable Hubs:** We develop affordable, flexible learning spaces that connect young people with in-person and online opportunities.\r\n6. **Research & Advocacy:** We partner with the University of Bristol to measure impact, advocate for learning outside the classroom, and contribute to national discussions on reform.', '2023', 0, 'Since September 2024 we have offered: \r\nTotal workshops: 146\r\nAverage learners per workshop: 18\r\nTotal learner attendances = 146 × 18 = 2,628\r\n - We have 137 young people on our register of which 40 attend regular sessions, others are occasional attendees. \r\n - We have a waiting list of 21 young people. \r\n\r\nWe have qualitative data available through the University of Bristol if requested. This is being presented at the https://www.bera.ac.uk BERA conference in September by Dr Lucy Wenham who undertook the qualitative research.\r\n\r\n\r\n\r\n\r\n\r\n\r\n', 11700, 'Financial Support: The cost of a learner attending the Hub for three days for a 6 week term is £540.\r\nTo match fund a low income family for a term = £270\r\nTo fund 5 families a term = £1350\r\nTo fund them for 6 terms = £8100\r\n\r\nEquipment Support: STEM Robotic equipment to learn coding skills - cost per unit = £210\r\n10 units = £2100\r\nSamsung tablet = £150\r\n10 units - £1500', 8100, 'The cost of a learner attending the Hub for three days for a 6 week term is £540.\r\nTo match fund a low income family for a term = £270\r\nTo fund 5 families a term = £1350\r\nTo fund them for 6 terms = £8100\r\n\r\n\r\n', 3600, 'STEM Robotic equipment to learn coding skills - cost per unit = £210\r\n10 units = £2100\r\nSamsung tablet = £150\r\n10 units - £1500', 0, '', 0, NULL, 'Feature business sponsors on your website and socials'),
(86, 95, 'THE MU CLUB', 'In Music In Media offers a multimedia one-stop-shop and creative social hub for young creatives, providing music and media production facilities and personal to support, train and develop marginalised young people.', 'Our Mission :\r\n\r\nIs to provide unconventional educational and career pathways for marginalised young people that struggle to fit the mainstream frameworks. We achieve this through our unique model that bridges the gap between education and the creative industries.', '2018', 1, 'Schools – Provided an early intervention for student at risk of exclusion and re-engaged them into learning which improved their behaviour and attendance.\r\nLocal Authorities – Provided alternative provision for students permanently excluded and NEETs which engaged them into productive activities, giving them a focus and guidance how to pursue a career with creative employability skills they didn\'t realised they had and steered them away from a life of crime.\r\nYoung Creatives – Provided opportunities, platform and outlet for marginalised young creatives from BAME communities that have limited resources available to them and are stigmatised because of types of music they are into.', 20000, 'Financial Support: additional resources will you need?	\r\nThe project is currently only accessible to young people who are under the supervision of youth service organisations that are able to pay for the service.\r\nWe would like to be able to offer this to young people who are not in this bracket and have no access to these types of services.\r\n\r\nOur Sponsorship Packages are based on a full day attendance\r\n\r\nPackage 1 – £1,500 – 1 student (11 – 18 Year Olds) for 1 day a week for one school term.\r\nPackage 2 – £3,500 – 1 student (11 – 18 Year Olds) for 1 day a week for a FULL School Year.\r\nPackage 3 – £4,500 – 1 Young Person (18 – 25 Year Olds) for 1 day a week for a FULL Work Year.\r\n\r\nFinally what will you help with?\r\n\r\nSupporting Young People: A Multifaceted Approach. Allow me to outline the significant benefits our programme offers to young people, encompassing personal and educational development, life skills, and overall wellbeing.\r\nThis includes:\r\nPersonal and Educational Benefits\r\nLife Skills and Post-Education Benefits\r\nWellbeing and Personal Development Benefits\r\n\r\nBy investing in our programme, you\'re directly contributing to the multifaceted development of young people, empowering them to succeed in education, future careers, and life as a whole.', 20000, ' additional resources will you need?	\r\nThe project is currently only accessible to young people who are under the supervision of youth service organisations that are able to pay for the service.\r\nWe would like to be able to offer this to young people who are not in this bracket and have no access to these types of services.\r\n\r\nOur Sponsorship Packages are based on a full day attendance\r\n\r\nPackage 1 – £1,500 – 1 student (11 – 18 Year Olds) for 1 day a week for one school term.\r\nPackage 2 – £3,500 – 1 student (11 – 18 Year Olds) for 1 day a week for a FULL School Year.\r\nPackage 3 – £4,500 – 1 Young Person (18 – 25 Year Olds) for 1 day a week for a FULL Work Year.\r\n\r\nFinally what will you help with?\r\n\r\nSupporting Young People: A Multifaceted Approach. Allow me to outline the significant benefits our programme offers to young people, encompassing personal and educational development, life skills, and overall wellbeing.\r\nThis includes:\r\nPersonal and Educational Benefits\r\nLife Skills and Pos', 0, '', 0, '', 0, NULL, NULL),
(87, 96, 'Disability Powerchair Teams ', 'The objective of this project is to offer opportunities for all wheelchair users to reach their potential, and have the opportunity to represent The Albion Foundation at a regional and national level.', 'Wellbeing, Social, Development, Raising Awareness', '2010', 1, 'A number of players over the years have gone on to play at international level. Also we have created a pathway for players to gain employability opportunities at The Albion Foundation.', 15000, 'Financial Support: We would need this financial support to uphold facility costs, maintenance, staffing, transporting equipment & continued professional development.\r\n\r\nEquipment Support: This would helps us purchase specialist equipment, power chair balls, hoists, chargers, goalposts, speed testing ramps, & cushions.', 10000, 'We would need this financial support to uphold facility costs, maintenance, staffing, transporting equipment & continued professional development.', 5000, 'This would helps us purchase specialist equipment, power chair balls, hoists, chargers, goalposts, speed testing ramps, & cushions.', 0, '', 0, NULL, NULL),
(88, 97, 'Community Cafe', 'Community mental health, early years, employability and resettlement support.', 'Community mental health, early years, employability, resettlement support', '2021', 1, '', 26000, 'Financial Support: We rely on our volunteer team and increasingly use more time to manage. We also want to offer parking expenses and thank you events to keep our volunteer team motivated and engaged\r\n\r\nEquipment Support: Laptops, printers, tablets for team and volunteers to support our visitors with language support/resources, form filling, bills advice, money saving and community navigation.\r\n\r\nProfessional Support: New business development and strategy to support us to equip other communities to adopt our model', 26000, 'We rely on our volunteer team and increasingly use more time to manage. We also want to offer parking expenses and thank you events to keep our volunteer team motivated and engaged', 0, 'Laptops, printers, tablets for team and volunteers to support our visitors with language support/resources, form filling, bills advice, money saving and community navigation.', 0, 'New business development and strategy to support us to equip other communities to adopt our model', 0, NULL, NULL),
(89, 98, 'YMA HofE Youth and Community Service', 'Our mission is to establish a one-stop-shop community hub that provides vital support, advice, guidance, education, and training to our community. By fostering opportunities that enhance wellbeing and tackle social isolation and exploitation, we aim to create a lasting community impact. Our centrally located facilities across Birmingham, Solihull, and Coventry means we really are at the Heart of England where we serve as a hub for organisations to collaborate, becoming the umbrella network for support and referrals within our stakeholder community.', 'Our key objectives focus on delivering and tackling:\r\n•	Education, Employment, and Training: Ensuring that every person engaging with the YMCA has opportunities to improve skills, secure employment, and contribute positively to their community. We address homelessness, unemployment, and educational barriers to empower individuals to live fulfilling lives.\r\n•	Providing Advice and Guidance: Actively listening to and consulting our community to provide tailored support on housing, poverty, financial stability, health and wellbeing, and family support.\r\n•	Reducing Social Isolation and Exploitation: Reducing social isolation and vulnerability in high-deprivation areas by providing a safe, welcoming space for interaction, engagement, and community cohesion.\r\n•	Supporting the next generation of young people: Offering both open access youth club provision and targeted life skills and mentoring to support positive pathways, reduce criminal exploitation and encourage alternative routes into education and employment.', '2020', 1, 'Our impact to date has been significant across the community this year.\r\nWe have supported 2,520 local residents through a wide range of services aimed at reducing hardship and building resilience. This includes employability support, access to cost-of-living essentials, a community food pantry, shared meals, family events, parent-child stay and play sessions, and warm living housing packs.\r\n\r\nIn addition, we have engaged over 500 young people through both open-access activities and targeted interventions such as mentoring, life skills development, and school-based support.\r\nCrucially, 95% of participants have reported a positive change in their lives as a direct result of engaging with our services.', 80000, 'Financial Support: •	Covers building operational costs and sustains two key staff members.\r\n•	Ensures our doors remain open for community services and collaborative initiatives.\r\n•	Supports up to 80 people in gaining qualifications or employment over one year.\r\n•	Enables local charities to deliver their services without financial barriers.\r\n•	Stay and Play Sessions – twice-weekly stay and play sessions, supporting parent development, socialisation, early childhood education, and family wellbeing.\r\n•	Belong and Brew – Weekly meetups addressing social isolation, mental health, and wellbeing through community engagement.\r\n•	Drop-in Surgeries – Offering financial advice, cost-of-living support, and employability skills training.', 80000, '•	Covers building operational costs and sustains two key staff members.\r\n•	Ensures our doors remain open for community services and collaborative initiatives.\r\n•	Supports up to 80 people in gaining qualifications or employment over one year.\r\n•	Enables local charities to deliver their services without financial barriers.\r\n•	Stay and Play Sessions – twice-weekly stay and play sessions, supporting parent development, socialisation, early childhood education, and family wellbeing.\r\n•	Belong and Brew – Weekly meetups addressing social isolation, mental health, and wellbeing through community engagement.\r\n•	Drop-in Surgeries – Offering financial advice, cost-of-living support, and employability skills training.', 0, '', 0, '', 0, NULL, NULL),
(90, 99, 'The Professional Action Learning Sets (PALS) Programme - West Mercia', 'The PALS Programme is designed to tackle barriers to career progression for ethnically diverse police officers and staff within West Mercia Police. By developing leadership skills, confidence, and self-awareness, the programme builds a talent pipeline to more senior roles, enhancing diversity and representation in police leadership. Ultimately, PALS benefits West Mercia communities by fostering a more inclusive and trusted police force that reflects the diversity of the population it serves.', 'Break down real and perceived barriers to career progression for ethnically diverse officers and staff.\r\n\r\nEquip participants with leadership skills, coaching, and self-development tools.\r\n\r\nDevelop a more inclusive, motivated, and representative police leadership.\r\n\r\nImprove engagement, trust, and service outcomes across West Mercia communities.\r\n\r\nContribute to West Mercia Police’s strategic vision, values and organisational priorities and DE&I goals.', '2024', 1, 'Details upon request (sensitivity due to beneficiary group)', 35000, 'Financial Support: The funding will directly support delivery of Cohort 4 of the PALS Programme. This includes:\r\n\r\nLeadership training and professional development sessions\r\n\r\nCoaching and mentoring provision\r\n\r\nProgramme materials such as: Course book: \"7 Habits of Highly Effective People\" by Stephen Covey, PALS Handbooks and Booklets, Graduation Certificates and Launch/Graduation Events, Certification via Skills for Justice. \r\n\r\nAdditional support may also be used for a contingency reserve to safeguard future cohorts or to broaden impact across the force, for example, cultural and community engagement events (e.g., Black History Month, South Asian Heritage Month).\r\n\r\nEquipment Support: n/a\r\n\r\nProfessional Support: n/a', 35000, 'The funding will directly support delivery of Cohort 4 of the PALS Programme. This includes:\r\n\r\nLeadership training and professional development sessions\r\n\r\nCoaching and mentoring provision\r\n\r\nProgramme materials such as: Course book: \"7 Habits of Highly Effective People\" by Stephen Covey, PALS Handbooks and Booklets, Graduation Certificates and Launch/Graduation Events, Certification via Skills for Justice. \r\n\r\nAdditional support may also be used for a contingency reserve to safeguard future cohorts or to broaden impact across the force, for example, cultural and community engagement events (e.g., Black History Month, South Asian Heritage Month).', 0, 'n/a', 0, 'n/a', 1, 'Details upon request (sensitivity due to beneficiary group)', NULL),
(94, 103, 'GYM youth Bus- Outreach', 'We would like to request your sponsorship support for our service and explain further below:\r\n\r\n \r\n\r\nAs you probably know, those of us at Guiding Young Minds (GYM) are doing everything in our power to provide support for our young people along with our community which is in fear of local Gang Violence.\r\n\r\n \r\n\r\nOur service provides many different options to support young people and communities. An important one of these is the outreach service we provide using the GYM Youth Bus, which hopefully you may have seen travelling around the city.\r\nThe bus is commissioned by the police, local councils and other Organization to reach out to different communities across the city to lower violence', '1. lower Anti-social behaviour \r\n2. steer young people away from Gangs\r\n3. Bring community together  \r\n4. Creating safe space for young people ', '2015', 1, 'Police reports about Guiding Young Minds\' Outreach Services\r\nPlease can I thank you for your incredible work over the summer.\r\n\r\nI have sent you an invite for a more formal review of the summer in terms of capturing all the learning and impact, but this morning I shared some info the police have shared with me, so I wanted to add it here so you can share with individuals who worked over the summer:\r\n\r\nAugust 2025 was the lowest month of recorded serious youth violence since December 2023.\r\nSt Michaels ward (city centre) saw a reduction of 8% in August 24 compared to last August 23.\r\nAs of today we are only 0.5% off an overall reduction YTD (x2 offences – lowest we have been)\r\nThere was 0 SYV knife used offences recorded in the City centre for August. Last time this happened was May 2023.\r\nAugust saw only 12 Robberies in St Michaels – Lowest month in 4.5 years.... Including through Covid Lockdown periods!\r\n“This is absolutely amazing.”\r\nI know we aspire to do even more, but you and your', 10000, 'Financial Support: The issue we face now is that the Van is booked every day of the week!  We regularly get requests to go to more areas or to support local events, but if the bus is fully booked – well we only have one bus!\r\n\r\n \r\n\r\nWe have therefore embarked on the ambitious project to buy a second bus!  This wont be cheap of course, but if enough local businesses can support us with only a very small amount each, we believe we can achieve this.  And the result – reduced violence in our communities – has to be worthwhile!\r\n\r\nIf you would like to support our goal of buying a second bus with  donation or sponsorship of some sort this would be greatly appreciated. We can of course explore this further and work with you on establishing what you would like to bring / offer. \r\n\r\n \r\n\r\nWe could not do the work we do for our young people/communities without the help of generous people / businesses like yours, and any support no matter how little can make a difference. \r\nBreak down:\r\nPurchase Van\r\nconvert the van and designing of van\r\nInsurance \r\nEquipment- first aid kit, bleed kit, sports and gaming\r\n\r\nEquipment Support: Kit van up with many sports, gaming and engaging activities for young people to engage with and to encourage to keep them away from anti-social behaviour and gangs', 70000, 'The issue we face now is that the Van is booked every day of the week!  We regularly get requests to go to more areas or to support local events, but if the bus is fully booked – well we only have one bus!\r\n\r\n \r\n\r\nWe have therefore embarked on the ambitious project to buy a second bus!  This wont be cheap of course, but if enough local businesses can support us with only a very small amount each, we believe we can achieve this.  And the result – reduced violence in our communities – has to be worthwhile!\r\n\r\nIf you would like to support our goal of buying a second bus with  donation or sponsorship of some sort this would be greatly appreciated. We can of course explore this further and work with you on establishing what you would like to bring / offer. \r\n\r\n \r\n\r\nWe could not do the work we do for our young people/communities without the help of generous people / businesses like yours, and any support no matter how little can make a difference. \r\nBreak down:\r\nPurchase Van\r\nconvert the van', 2000, 'Kit van up with many sports, gaming and engaging activities for young people to engage with and to encourage to keep them away from anti-social behaviour and gangs ', 0, '', 1, 'moment we are  receiving donation from community, local business and grants', NULL);
INSERT INTO `CSE_ProjectDetail` (`pro_id`, `cse_id`, `pro_Name`, `pro_Purpose`, `pro_KeyObjectives`, `pro_StartYear`, `pro_CollectData`, `pro_Impact`, `pro_RequiredSponsorship`, `pro_AdditionResourcesNeeded`, `pro_fAsk`, `pro_fAskDetails`, `pro_eAsk`, `pro_eAskDetails`, `pro_pAsk`, `pro_pAskDetails`, `pro_pccfunding`, `pro_pccfundingDetails`, `pro_businessBenefits`) VALUES
(95, 104, 'The Stoke Mandeville Hospital (Buckinghamshire NHS Trust) ', 'When in hospital, there is a reachable moment when the patient can be reflective and open to intervention.  A volunteer in a dedicated Navigator role would ask for consent to refer the patient onto a third sector organisation who can provide the specialist support. This moment could help divert the patient back out into the community on a different pathway.  The volunteer would put them in contact with a local support agency that provide support navigating them back into the community, building resilience and offer mentoring in an attempt to prevent further incidents which could lead them back into hospital. ', '1) Initial Engagement and Dialogue\r\n2) Build trust with patients who present at hospital because of existing issues including substance abuse, mental health issues, poor diet or personal care and violence itself.\r\n3) Establish a link into 3rd sector support, with a structured pathway to follow.', '2021', 1, 'Thames Valley Police and multi-agency partners have seen results and want to see this scheme - as part of wider strategic \'violence prevention\' activities and pathways - supported through social value until 2028 when a comprehensive impact assessment will take place.  ', 10000, 'Financial Support: As a contribution to the annual CIC costs of running the Navigators operation (from admin to frontline logistics).', 10000, 'As a contribution to the annual CIC costs of running the Navigators operation (from admin to frontline logistics).', 0, '', 0, '', 1, 'Details available upon request.', NULL),
(96, 105, 'Youth Work', 'There is an urgent need to see a return to regular youth work sessions in the local community that provide opportunities for young people to develop their emotional and social skills in a safe physical environment with adults they respect and trust.\r\n\r\nWe deliver 6 youth work sessions weekly (during term time), across 3 venues, delivered by experienced youth workers to young people between 11 and 18.', '1) Safe spaces where young people can visit for support.\r\n2) Empowering young people and their communities to create and lead on their own solutions to violence affecting young people.\r\n3) Play a direct role in supporting communities and public services providers under the Protecting Thames Valley plan 2024-2029. \r\n', '2016', 1, 'Available upon request', 10000, 'Financial Support: We seek a contribution per business as financial support for the running cost of our Youth Work provision within Milton Keynes each year (which includes logistics for our Hospital Navigator provision).', 10000, 'We seek a contribution per business as financial support for the running cost of our Youth Work provision within Milton Keynes each year (which includes logistics for our Hospital Navigator provision).', 0, '', 0, '', 1, 'Various past and ongoing funding with the OPCC in Thames Valley.', NULL),
(97, 106, 'Custody Coaches', 'Our Custody Coaches programme funds trained youth workers from local organisations – including professional football club community trusts – to reach out to those detained in police custody for a violence-related offence.', '1) Engage with at risk young people in custody suites breaking down the barriers through their connection to the local community and for some, through sport.  \r\n2) They go on to talk with the person about their wider life situation and what may contribute to their offending behaviour, encouraging them to reflect on what support they may need.\r\n3) Form a link/cross-over to wider 3rd sector preventative community safety/integration activities supporting the same young people.\r\n4) Directly support the strategic objectives of multi-agencies under the Police & Crime Plan 2024-2029\r\n\r\nOften, this links to substance misuse or alcohol problems and the Custody Coaches ensure they are referred into appropriate services.  They may address wider issues such as exploitation, homelessness, engagement with education, training and employment, support with bereavement, family breakdown, getting out of debt.  ', '2021', 1, 'Available through Thames Valley Violence Prevention Partnership and the Thames Valley Police crime data.', 10000, 'Financial Support: Social value contribution towards the running of the service (logistics, provision, administration).', 10000, 'Social value contribution towards the running of the service (logistics, provision, administration). ', 0, '', 0, '', 1, 'Thames Valley Violence Prevention Partnership (Custody Coaches Scheme) - Home Office ', NULL),
(102, 111, 'Supporting Youth Through Reparation Projects', 'West Mercia Youth Justice Service (YJS), delivers court-ordered reparation activities for young people involved in minor offences. These include carpentry-based projects where participants build bird boxes, wildlife homes, and other timber products for use across Wildlife Trust estates and local communities.', 'To grow this initiative regionally\r\nDirect activity to reduce re-offending\r\nHelp young people develop practical and transferable skills', '2021', 1, 'Information available upon request', 5000, 'Financial Support: No direct funding is required\r\n\r\nEquipment Support: Timber donations (e.g. pallets, offcuts, or surplus wood), Tools and equipment, workshop space or facilities.\r\n\r\nProfessional Support: Volunteer time as part of activities, or direct input to skills training', 0, 'No direct funding is required', 5000, 'Timber donations (e.g. pallets, offcuts, or surplus wood), Tools and equipment, workshop space or facilities.', 0, 'Volunteer time as part of activities, or direct input to skills training', 1, 'YJS is a funded provision, operating across 3 counties of the West Mercia Region', NULL),
(103, 112, 'Street Presence ', '\r\nVennture’s Street Presence approach has been developed with Herefordshire\'s Command Team over 12 years to deliver our highly effective, uniformed volunteer presence that provides a reassuring presence and medical triage to those most vulnerable on Herefordshire’s streets.\r\nWorking closely with West Mercia Police and local services, this programme builds trust, fosters community resilience, and offers a cost-effective alternative to crisis response, saving just over £10,000 in ambulance call outs alone in 2024. Providing opportunities for all, including our hands on volunteering for 16-18 year old\'s aspiring to a career in medicine. \r\n', 'Providing medical triage to those most vulnerable on Hereford\'s streets, Providing hands on experience for 16-18 year old\'s aspiring to a career in medicine,  reducing the unnecessary burden on emergency services whilst enhancing multi-agency working, providing a calm and reassuring presence that promotes safety and community resilience ', '2013', 1, '', 17800, 'Financial Support: £10,000 would provide 20 volunteers with extensive and thorough training to provide the highest level of care\r\nTraining included:\r\n- Emergency First Aid\r\n- Mental Health First Aid\r\n- Manual Handling\r\n- Safe ways of Working\r\n- Safeguarding \r\n- PMESHED (understanding Alcohol & Drugs and medical conditions that can present as intoxication)\r\n- Scenarios training\r\n- Bereavement training (how to engage with those struggling with bereavements) \r\n- Naloxone Training\r\n- Working with the Police.\r\nThis cost covers room hire for training specified\r\n\r\nEquipment Support: £3000 would enable the following\r\n- New laptops for two Street Presence coordinators to be able to use updated software, enabling enhanced and increased efficiency when reporting and collecting data\r\n- Recalibration of medial equipment including drugs testing machine and breathalyzers\r\n- Medical supplies inclusive of sick bags, plasters, bandages, ice packs etc\r\n\r\nProfessional Support: £4800 would enabling our safe space and volunteer hub to stay operational for a further 12 months. Providing a space for supervised recovery for those who need more thorough medical checks and a safe space for our volunteers to base themselves out of during their shifts in Hereford. This money would also cover adaption to the room to make it more functional for use including installing a running water tap within the medical assessment area.', 10000, '£10,000 would provide 20 volunteers with extensive and thorough training to provide the highest level of care\r\nTraining included:\r\n- Emergency First Aid\r\n- Mental Health First Aid\r\n- Manual Handling\r\n- Safe ways of Working\r\n- Safeguarding \r\n- PMESHED (understanding Alcohol & Drugs and medical conditions that can present as intoxication)\r\n- Scenarios training\r\n- Bereavement training (how to engage with those struggling with bereavements) \r\n- Naloxone Training\r\n- Working with the Police.\r\nThis cost covers room hire for training specified ', 3000, '£3000 would enable the following\r\n- New laptops for two Street Presence coordinators to be able to use updated software, enabling enhanced and increased efficiency when reporting and collecting data\r\n- Recalibration of medial equipment including drugs testing machine and breathalyzers\r\n- Medical supplies inclusive of sick bags, plasters, bandages, ice packs etc  ', 4800, '£4800 would enabling our safe space and volunteer hub to stay operational for a further 12 months. Providing a space for supervised recovery for those who need more thorough medical checks and a safe space for our volunteers to base themselves out of during their shifts in Hereford. This money would also cover adaption to the room to make it more functional for use including installing a running water tap within the medical assessment area.', 1, '', NULL),
(104, 113, 'Volunteer Police Special Constable', 'Our Special Constables are voluntary, part-time police officers who work in some of the most important areas of modern policing. Would you be willing to make a real difference to your community?', '(1) Responding to 999 calls\r\n(2)Patrolling on foot and in police vehicles\r\nRoads policing\r\n(3) Searching people, vehicles, and premises\r\nInvestigating crime, arresting suspects, and taking statements from witnesses\r\n(4) Policing major events such as festivals, marches, and football matches\r\n(5) Tackling local issues, including anti-social behaviour and harassment', '1967', 1, 'Information upon request', 0, 'Financial Support: There is no0 financial ask here.\r\n\r\nEquipment Support: No \'in-kind\' request here.\r\n\r\nProfessional Support: A minimum of 16 hours a month, although many people do significantly more as the hours can be flexible to fit around your work and home life commitments.', 0, 'There is no0 financial ask here.', 0, 'No \'in-kind\' request here.', 0, 'A minimum of 16 hours a month, although many people do significantly more as the hours can be flexible to fit around your work and home life commitments.', 0, NULL, NULL),
(105, 114, 'STEPS (Support Through Exploitation and Prevention Service).', 'Support within West Mercia for children aged 8-18 and young people up to the age of 24 with additional needs, who are impacted by Child Criminal Exploitation or Child Sexual Exploitation. Awareness and Prevention Practitioners to facilitate workshops and training for professionals, children and parents/carers to increase understanding around grooming and exploitation, and how to respond and safeguarding appropriately.', 'Helping Young People Be Aware of Exploitation.\r\nSupporting Young People Avoid Exploitation.\r\nTraining and Mentoring to Prevent Exploitation.\r\n', '2024', 1, 'An integrated model providing trauma-informed prevention and intervention has supported children and young people with additional needs who are at risk of, involved in, or vulnerable to Child Criminal Exploitation (CCE) or Child Sexual Exploitation (CSE).', 6000, 'Financial Support: Contributions are requested from business suppliers, which combined will cover the cost of dedicated staff over a year. This is matched to the fund in place from the Office of the Police & Crime Commissioner, and means more provision can be established within the region.\r\n\r\nEquipment Support: Equipment like stationery, ICT hardware, workshop materials are all needed.\r\n\r\nProfessional Support: Any business-related knowledge exchange in relation to skills development, employment readiness, cyber security and safety, etc. In addition, any workshop facilitation support related to the same.', 5000, 'Contributions are requested from business suppliers, which combined will cover the cost of dedicated staff over a year. This is matched to the fund in place from the Office of the Police & Crime Commissioner, and means more provision can be established within the region.', 1000, 'Equipment like stationery, ICT hardware, workshop materials are all needed.', 0, 'Any business-related knowledge exchange in relation to skills development, employment readiness, cyber security and safety, etc. In addition, any workshop facilitation support related to the same.', 1, 'Available upon request', NULL),
(106, 115, 'Technology support and Digital safeguarding for people with disabilities', 'The aim of the programme is to build Technology confident and Digitally safe communities.  Through providing individuals, charities, schools and community based support with access to technology and technology experts.  Making sure all disabled or chronically ill people get access to technology that supports independence.', 'To maximise independence for all people with disabilities and/or chronic illness through technology,\r\nTo ensure young people with disabilities and/or chronic illness have unhindered access to education through timely support and assistive technology implementation to reach their full potential, \r\nProvide a complete digital safety approach that advocates understanding and implementation of tools and techniques to stay safe online, \r\nProvide a more advanced vocational focus on digital safeguarding and cyber security to drive new skills and capabilities in the disabled community.\r\nTo build a community of disabled specialists within our business through funded apprenticeship provision and job opportunities.\r\n', '2021', 0, 'We have supported individuals of all ages and their support teams in identifying the technology and capabilities needed to provide independence in their home, recreational activities, education and working.  This has included training young people how to integrate technology into their lives and remain digitally safe.\r\n\r\nWe support businesses in achieving Cyber Security certifications to protect their data and their clients against the growing threat.  Adapt-IT are an NCSC approved Managed Service provider for Cyber Essentials as well as IASME Cyber Assurance certification body.  \r\n\r\nWe have provided mentoring to young people who were moving into Cyber Security.\r\n\r\nWe are currently working with Gloucestershire College to create a digital training structure as part of their foundation course for people with disabilities.  This is being developed to not only support the young people in embracing, enjoying and using technology but also give them a baseline in Digital/Cyber Security princi', 3450, 'Financial Support: To provide the relevant support needed to organisations moving forward will depend on the ask.  To cover costs of an advisor or technical specialist costs £600 a day.  When developing an approach the number of days for a set outcome is devised to provide fixed cost for support. consider intial 5 days.\r\n\r\nEquipment Support: This will depend on the requirements of the individuals or organisations.\r\n\r\nProfessional Support: OT support occasionally to ensure the more medical based aspects are covered.  We partner with a company called ARMS Rehab (another local business).', 3000, 'To provide the relevant support needed to organisations moving forward will depend on the ask.  To cover costs of an advisor or technical specialist costs £600 a day.  When developing an approach the number of days for a set outcome is devised to provide fixed cost for support. consider intial 5 days.', 0, 'This will depend on the requirements of the individuals or organisations.', 450, 'OT support occasionally to ensure the more medical based aspects are covered.  We partner with a company called ARMS Rehab (another local business).', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `CSE_Socials`
--

CREATE TABLE `CSE_Socials` (
  `cs_id` bigint NOT NULL,
  `cse_id` bigint NOT NULL,
  `cs_Facebook` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_Instagram` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_Website` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cs_logo` varchar(500) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `CSE_Socials`
--

INSERT INTO `CSE_Socials` (`cs_id`, `cse_id`, `cs_Facebook`, `cs_Instagram`, `cs_Website`, `cs_logo`) VALUES
(29, 56, 'https://www.facebook.com/Aaamindset/', 'https://www.linkedin.com/company/always-an-alternative-cio/', 'https://www.alwaysanalternative.org.uk', '1741955467_027fdfd4ddca943d9f0a.png'),
(30, 57, 'https://www.facebook.com/ReachforHealthDaventry#', 'https://www.linkedin.com/company/reach-for-health-centre', 'https://www.reachforhealth.co.uk/', '1741968291_ac34c7d86929cb3579bb.jpeg'),
(31, 58, 'https://www.facebook.com/ArgyleTrust', '', 'https://the-social-impact-register.org.uk/product/argyle-community-trust/', '1742206536_6f39486112d66920b8f3.png'),
(32, 59, '', 'https://www.linkedin.com/in/elitecomunityhub', 'https://www.elitecommunityhub.org.uk', '1742228259_74f5daecba181059ea26.png'),
(33, 60, 'https://www.facebook.com/BoxingCleverMK', 'https://www.linkedin.com/company/boxing-clever-mk/', 'https://www.boxingclever.org.uk', '1742304228_f96649046848f8512cf4.png'),
(35, 62, 'https://www.facebook.com/twyfordyouth', '', 'https://www.tdyc.co.uk', '1742304637_ea8518ea46967dda77f0.png'),
(36, 63, '', 'https://www.linkedin.com/company/together-as-one-aik-saath/', 'https://togetherasone.org.uk', '1742305594_2deca73bce705661e610.png'),
(37, 64, 'https://www.facebook.com/MartinMurrayBoxer', '', '', '1742309243_d95979a9db80300f818e.png'),
(38, 65, 'https://www.facebook.com/thewildheartfoundation/', 'https://www.linkedin.com/in/suzan-issa-030b98145/', 'https://wildheartfoundation.co.uk/', '1742309761_c55680da743be0cd6f27.png'),
(39, 66, 'https://www.facebook.com/theprojectptoxford/', 'https://www.linkedin.com/company/the-project-pt', 'https://www.theprojectpt.com/intervention-programs', '1742310121_26a7f5df72ae66beb564.png'),
(40, 67, 'https://www.facebook.com/berkshireyouth', 'https://www.linkedin.com/company/berkshire-youth/', 'https://www.berkshireyouth.co.uk', '1742314769_c1a9aa0a3c7ab5fdf8af.png'),
(43, 70, 'https://www.facebook.com/thesilentdiscoproject/', 'https://www.linkedin.com/company/the-silent-disco-project', 'https://www.thesilentdiscoproject.co.uk/', '1742333629_79d16d6c389874505786.png'),
(45, 72, 'https://www.facebook.com/thelewisfoundationnorthampton', 'https://www.linkedin.com/company/the-lewis-foundation-uk/', 'https://www.thelewisfoundation.co.uk', '1742469003_ba56c1e9eead1863ad8a.jpg'),
(46, 73, 'https://www.facebook.com/TheJJeffect18', 'https://www.linkedin.com/in/byron-highton-9325531b2/', '', '1742469375_e954c6c212b3c18e48a9.jpg'),
(47, 74, '', 'https://www.linkedin.com/company/the-berg-f', '', '1742471633_a715a92d8fdc7f18bbaf.png'),
(48, 75, 'https://www.facebook.com/teachoutdoors', 'https://www.linkedin.com/in/jodanna-clanfield-a56382104/', 'https://www.teachoutdoors.co.uk', '1742472041_1cd9af21259274c07ca2.png'),
(50, 77, 'https://www.facebook.com/StartingPointUK', 'https://www.linkedin.com/company/starting-point-mentoring/', 'https://www.startingpoint.org.uk', '1742478639_d9c8ae81b57bd2b8ce4d.png'),
(51, 78, 'https://www.facebook.com/SOFEAUK', 'https://www.linkedin.com/company/sofea', 'https://www.sofea.uk.com/', '1742478887_509c26c930feabb7adcf.png'),
(52, 79, '', '', 'https://shrewsburyoswestrycrucialcrew.com/about-crucial-crew/', '1742479216_37d6b584e29031fd7e81.png'),
(53, 80, 'https://www.facebook.com/aboutSAFEproject/', 'https://www.linkedin.com/company/safe-support-for-young-people-affected-by-crime-limited/', 'https://www.safeproject.org.uk', '1742480049_283408b7f5fa9d3fff01.png'),
(54, 81, 'https://www.facebook.com/profile.php?id=100088894914394', 'https://uk.linkedin.com/company/riverside-education', 'https://www.riversideeducation.co.uk', '1742480566_f6d1f4a42a2c05ba0639.png'),
(55, 82, 'https://www.facebook.com/RideHighMK/', 'https://www.linkedin.com/company/ride-high-limited/', 'https://www.ridehigh.org', '1742480955_a0e5e8e57efc7a5e012f.png'),
(56, 83, 'https://www.facebook.com/suzanissawildchild/', 'https://wwww.raisingawildchild.co.uk', '', '1742484818_a981127d7dceb5357bab.png'),
(57, 84, 'https://www.facebook.com/PNECET/?locale=en_GB', '', 'https://www.pnefc.net/pnecet', '1742485244_4c7f9cf787eaee426650.png'),
(58, 85, '', 'https://www.linkedin.com/company/hopeafterharm/about/', 'https://hopeafterharm.org.uk/', '1742486954_aec49342af589db3fa5a.jpg'),
(59, 86, '', '', 'https://arematherapy.co.uk', '1742487307_f4a6542b3716ae703b13.png'),
(60, 87, '', '', 'https://www.discoveryoutdoors.org', '1742487547_7b985d6eb977318ac649.png'),
(62, 89, 'https://www.facebook.com/glosrasac/', 'https://www.linkedin.com/company/gloucestershire-rape-and-sexual-abuse-centre/', 'https://www.glosrasac.org', '1742488217_edac9869c0a077464f3e.png'),
(63, 90, 'https://www.linkedin.com/company/leicester-city-in-the-community/', 'https://www.linkedin.com/company/leicester-city-in-the-community/', 'https://www.lcfc.com/pages/en/help', '1742489282_20c53400e91a2b92b8bf.png'),
(64, 91, 'https://www.facebook.com/LincolnCityFoundation/?locale=en_GB', 'https://www.linkedin.com/company/lincoln-city-foundation/', 'https://www.lincolncityfoundation.com/', '1742489651_388fb045196a3b1db700.png'),
(65, 92, 'https://www.facebook.com/mkbasketballclub', 'https://www.linkedin.com/company/mk-breakers/', 'https://mkbasketball.club/', '1742489958_9b5750ddfe0e2817e812.png'),
(67, 94, 'https://www.facebook.com/streamslearninghub', 'https://www.linkedin.com/company/streams-learning-hub/', 'https://www.streamslearninghub.com', '1742914007_e5ac2bd0e822a142e01c.png'),
(68, 95, 'https://www.facebook.com/inmusicinmedia', 'https://www.linkedin.com/company/in-music-in-media/', 'https://inmusicinmedia.com/', '1743071679_0ae0da65ea2a4da47dbb.png'),
(69, 96, 'https://www.facebook.com/thealbionfoundation?locale=en_GB', 'https://www.linkedin.com/company/the-albion-foundation/?viewAsMember=true', 'https://www.wba.co.uk/albion-foundation', '1743078788_972a28e2b854d7f66594.jpg'),
(70, 97, 'https://www.facebook.com/EducafeUK/', 'https://www.linkedin.com/company/educafe-cic/', 'https://www.educafeuk.co.uk', '1742830949_54c24c875aead4ab245d.jpg'),
(71, 98, 'https://www.facebook.com/YMCAHeart', 'https://www.linkedin.com/company/ymcaheart', 'https://ymcaheartofengland.org.uk/', '1744198012_c1180aed7b360eb28af7.png'),
(72, 99, '', '', '', '1744625094_1d00e9b7eb64a94418c2.png'),
(73, 103, '', 'https://uk.linkedin.com/in/anton-noble-1b6726a5', 'https://www.guidingyoungminds.org', '1748861274_c31ed3bd971b975cb525.png'),
(74, 104, '', '', 'https://www.7roadlight.co.uk/', '1749042802_6683c26b74b9e62ef55c.png'),
(75, 105, '', 'https://www.linkedin.com/company/milton-keynes-ymca-limited/about/', 'https://mkymca.com/services/youth-and-community/', '1749044847_c9355465f2a7fcbffe33.jpg'),
(76, 106, '', 'https://www.linkedin.com/company/reading-fc-community-trust', 'https://www.readingfc.co.uk/community-trust', '1749049745_0fcd5e32197914984e35.jpg'),
(78, 111, '', '', 'https://westmerciayouthjustice.org.uk/contact/', '1752415667_681e992b84df4bf2b796.png'),
(79, 112, 'https://www.facebook.com/HerefordshireVennture/', 'https://www.linkedin.com/in/vennture-herefordshire-560938300/', '', '1752589632_777d826c9a20a00afe8c.png'),
(80, 113, '', '', '', '1753121201_f34488067931cbe690ff.png'),
(81, 114, 'https://www.facebook.com/Catch22charity', 'https://www.linkedin.com/company/catch22', 'https://www.catch-22.org.uk/', '1753690977_2077b782ef5660c655e5.jpg'),
(82, 115, 'https://www.facebook.com/adaptituk/', 'https://www.linkedin.com/company/adapt-it-limited/', 'https://www.adapt-it.co.uk', '1753791098_7bbca51f80fbd7cde409.png');

-- --------------------------------------------------------

--
-- Table structure for table `Enablers`
--

CREATE TABLE `Enablers` (
  `ena_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `ena_OrgName` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `ena_ServiceType` enum('FRS','Lord Lieutenant','LGA','NHS Trust','Police','PCC') COLLATE utf8mb4_general_ci NOT NULL,
  `ena_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') COLLATE utf8mb4_general_ci NOT NULL,
  `approved` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Enablers`
--

INSERT INTO `Enablers` (`ena_id`, `user_id`, `ena_OrgName`, `ena_ServiceType`, `ena_Regions`, `approved`) VALUES
(13, 216, 'Hampshire Police', 'Police', 'South East', 1),
(15, 218, 'West Mercia Police', 'Police', 'West Midlands', 1),
(16, 219, 'Thames Valley Police', 'Police', 'South East', 1),
(18, 239, 'Worcestershire County Council', 'LGA', 'West Midlands', 1),
(19, 254, 'Durham Constabulary and on behalf of The Durham Police and Crime Commissioner. ', 'Police', 'North East', 1),
(20, 270, 'Essex Police', 'Police', 'East of England', 1),
(21, 271, 'Kent Police', 'Police', 'East of England', 1),
(22, 272, 'Cambridgeshire Police', 'Police', 'East of England', 1),
(23, 273, 'Hertfordshire Police ', 'Police', 'East of England', 1),
(24, 274, 'Bedfordshire Police', 'Police', 'East of England', 1),
(25, 275, 'Norfolk Police ', 'Police', 'East of England', 1),
(26, 276, 'Suffolk Police', 'Police', 'East of England', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ENA_HMAR`
--

CREATE TABLE `ENA_HMAR` (
  `emr_id` bigint NOT NULL,
  `ena_id` bigint NOT NULL,
  `emr_fName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emr_lName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emr_Email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ENA_HMAR`
--

INSERT INTO `ENA_HMAR` (`emr_id`, `ena_id`, `emr_fName`, `emr_lName`, `emr_Email`) VALUES
(11, 13, 'Thames', 'Valley', 'alison.jerred@thamesvalley.police.uk'),
(12, 14, 'TBC', '', ''),
(13, 15, 'Tony', 'Garner', 'tony.garner@westmercia.police.uk'),
(14, 16, '', '', ''),
(15, 17, '', '', ''),
(16, 18, 'Colin', 'Bates', 'cbates@worcestershire.gov.uk'),
(17, 19, '', '', ''),
(18, 20, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(19, 21, 'TBC', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(20, 22, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(21, 23, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(22, 24, 'TBC', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(23, 25, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(24, 26, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk');

-- --------------------------------------------------------

--
-- Table structure for table `ENA_HPRM`
--

CREATE TABLE `ENA_HPRM` (
  `epr_id` bigint NOT NULL,
  `ena_id` bigint NOT NULL,
  `epr_fName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epr_lName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epr_Email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ENA_HPRM`
--

INSERT INTO `ENA_HPRM` (`epr_id`, `ena_id`, `epr_fName`, `epr_lName`, `epr_Email`) VALUES
(12, 13, 'Thames', 'Valley', 'alison.jerred@thamesvalley.police.uk'),
(13, 14, 'TBC', '', ''),
(14, 15, 'Tony', 'Garner', 'tony.garner@westmercia.police.uk'),
(15, 16, '', '', ''),
(16, 17, '', '', ''),
(17, 18, 'n/a', 'n/a', 'cbates@worcestershire.gov.uk'),
(18, 19, 'Tony ', 'Kearney', 'Tony.Kearney@durham.police.uk'),
(19, 20, 'TBC', 'Tbc', 'Olubusola.Shotunde@kent.police.uk'),
(20, 21, 'TBC ', 'TBC', 'Olubusola.Shotunde@kent.police.uk'),
(21, 22, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(22, 23, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(23, 24, 'TBC', 'TBC', 'Olubusola.Shotunde@kent.police.uk'),
(24, 25, 'TBC', 'TBC ', 'Olubusola.Shotunde@kent.police.uk'),
(25, 26, 'TBC ', 'TBC ', 'Olubusola.Shotunde@kent.police.uk');

-- --------------------------------------------------------

--
-- Table structure for table `ENA_HPRO`
--

CREATE TABLE `ENA_HPRO` (
  `epro_id` bigint NOT NULL,
  `ena_id` bigint NOT NULL,
  `epro_fName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epro_lName` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `epro_Email` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ENA_HPRO`
--

INSERT INTO `ENA_HPRO` (`epro_id`, `ena_id`, `epro_fName`, `epro_lName`, `epro_Email`) VALUES
(11, 13, 'Thames', 'Fowles', 'alison.jerred@thamesvalley.police.uk'),
(12, 14, 'TBC', 'Levy', 'David.Levy@essex.police.uk'),
(13, 15, 'Tony', 'Strelitz', 'jon.strelitz@westmercia.police.uk'),
(14, 16, '', 'Fowles', 'richard.fowles@thamesvalley.police.uk'),
(15, 17, '', '', ''),
(16, 18, 'Colin', 'Bates', 'cbates@worcestershire.gov.uk'),
(17, 19, '', 'Dale ', 'marie.dale@durham.police.uk'),
(18, 20, 'TBC ', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(19, 21, 'TBC', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(20, 22, 'TBC ', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(21, 23, 'TBC ', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(22, 24, 'TBC', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(23, 25, 'TBC ', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk'),
(24, 26, 'TBC ', 'Shotunde ', 'Olubusola.Shotunde@kent.police.uk');

-- --------------------------------------------------------

--
-- Table structure for table `ENA_MainContactdetails`
--

CREATE TABLE `ENA_MainContactdetails` (
  `emcd_id` bigint NOT NULL,
  `ena_id` bigint NOT NULL,
  `emcd_Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `emcd_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `emcd_Phone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `emcd_JobTitle` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `ena_Confirmation` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ENA_MainContactdetails`
--

INSERT INTO `ENA_MainContactdetails` (`emcd_id`, `ena_id`, `emcd_Name`, `emcd_Email`, `emcd_Phone`, `emcd_JobTitle`, `ena_Confirmation`) VALUES
(11, 13, 'Alison Jerred', 'alison.jerred@thamesvalley.police.uk', 'n/a', 'Procurement Business Partner', 1),
(13, 15, 'Jon Strelitz', 'jon.strelitz@westmercia.police.uk', 'n/a', 'Director of Contracts & Procurement', 1),
(14, 16, 'Alison Jerred', 'alison.jerred@thamesvalley.police.uk', 'n/a', 'Business Partner', 1),
(16, 18, 'Colin Bates', 'cbates@worcestershire.gov.uk', 'n/a', 'Procurement and Commercial Category Lead', 1),
(17, 19, 'Marie  Dale', 'marie.dale@durham.police.uk', '0191 3835347 Ext 207330 ', 'Head of Procurement ', 1),
(18, 20, 'Busola Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1),
(19, 21, 'Busola Shotunde', 'Olubusola.Shotunde@kent.police.uk', '0707772221182', 'Social Value Lead', 1),
(20, 22, 'Busola Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1),
(21, 23, 'Busola Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1),
(22, 24, 'Busola Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1),
(23, 25, 'Busola  Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1),
(24, 26, 'Busola  Shotunde', 'Olubusola.Shotunde@kent.police.uk', '07772221182', 'Social Value Lead', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ENA_Socials`
--

CREATE TABLE `ENA_Socials` (
  `es_id` bigint NOT NULL,
  `ena_id` bigint NOT NULL,
  `es_Facebook` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `es_Instagram` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `es_Website` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ENA_Socials`
--

INSERT INTO `ENA_Socials` (`es_id`, `ena_id`, `es_Facebook`, `es_Instagram`, `es_Website`) VALUES
(12, 13, '', '', ''),
(14, 15, '', '', ''),
(15, 16, '', '', ''),
(17, 18, '', 'https://www.linkedin.com/company/worcestershire-county-council/', ''),
(18, 19, '', '', 'https://www.durham.police.uk'),
(19, 20, '', '', ''),
(20, 21, '', '', ''),
(21, 22, '', '', ''),
(22, 23, '', '', ''),
(23, 24, '', '', ''),
(24, 25, '', '', ''),
(25, 26, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `FAQs`
--

CREATE TABLE `FAQs` (
  `faq_id` bigint NOT NULL,
  `faq_type` enum('Charities','Businesses','Buyers') COLLATE utf8mb4_general_ci NOT NULL,
  `faq_question` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `faq_answer` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `FAQs`
--

INSERT INTO `FAQs` (`faq_id`, `faq_type`, `faq_question`, `faq_answer`, `created_at`, `updated_at`) VALUES
(6, 'Charities', 'Do we have to pay to join?', 'No. The Pluggin Ecosystem is a communities-led and community impact environment provided to you for free.', '2025-03-07 16:08:43', '2025-03-07 16:08:43'),
(7, 'Charities', 'How does this differ from other websites and fundraiser platforms?', 'We’re not a website or a fundraising platform. We are embedded into 45 parts\r\nof the UK as a live environment, you can join and operate then promote the\r\nactivities you know are making impact within communities. The ecosystem is a\r\nplace we bring businesses into to find and collaborate with you, then we help\r\nthem promote this back into public buyers - who are obliged under the\r\nProcurement Act 2023 to deliver a social return on the investment into contracts\r\nfor goods and services. So our ecosystem is like Amazon, we provide technology\r\nand support to you, so that you position what you are doing in real-time, then you\r\ncan use processes to meet and interact with businesses who supply your local\r\ncouncils, emergency services, NHS and the criminal justice service who are part of\r\nour Dual Impact Collaboration Model (DICM).', '2025-03-07 16:09:35', '2025-03-07 16:09:35'),
(8, 'Charities', 'What do we need to do?', 'You first need to set-up a digital presence within the ecosystem and then use\r\nmobile technology to market your activities and the evidence that you make\r\nimpact which supports building healthier, safer and more resilient communities.\r\nYou just need to replace the time spent searching for grants, with marketing into a\r\ndedicated audience who are there to support organisations like yours.', '2025-03-07 16:09:56', '2025-03-18 15:25:34'),
(9, 'Charities', 'How much actual money can be created this way?', 'Unlimited. By concentrating on talking to a dedicated audience of businesses,\r\nwho are in place because they are looking for organisations with the right\r\nactivities to support in your area, there is no limit. Equally, we have a limited\r\nnumber of you in your areas who are being supported by the ecosystem - lots of\r\nbusinesses can support you at the same time.\r\nYou can build lasting, valuable collaborations which sustain your organisation\r\nand activity for the medium and long-term – but your approach with us needs to\r\nbe different.', '2025-03-07 16:10:19', '2025-03-07 16:10:19'),
(10, 'Charities', 'We have limited people and time, do we now need to free team time for marketing?', 'No. Through mobile phones, your teams can share updates on the move, into the\r\necosystem and then businesses see these. Your leadership team, who spend hours each week searching for and applying for grants, can rethink how they reach a closed audience of businesses and engage them into supporting you and your activities.', '2025-03-07 16:10:35', '2025-03-18 15:26:47'),
(11, 'Businesses', 'What is your connection with public procurement and how does this help us?', 'The <a href=\"https://pluggin.org/dicm/\" target=\"_blank\">Dual Impact Collaboration Model</a> (DICM) was created by us with senior\r\nprocurement leaders and the Pluggin Ecosystem now hosts this regionally as a\r\nstrategic framework for the public contracting of social value. As a member of our\r\necosystem, you are able to support the dual impact objectives of buyers\r\nanywhere in the UK, and the DICM is your evidence of HOW &amp; WHERE your social\r\nvalue supports dual impact.', '2025-03-07 16:11:40', '2025-03-07 17:15:27'),
(12, 'Businesses', 'We already have social value and charity relations, can we bring-in these too?', 'Yes absolutely. As a business member supporting the DICM you can establish\r\n“dual impact collaboration” with charities/social enterprise within our ecosystem,\r\nbut also you can invite charities from your own established social value\r\nrelationships to align their activities to the DICM and benefit from additional\r\nsupport within the ecosystem – you can also position case studies within your\r\nDICM portfolio.', '2025-03-07 16:12:00', '2025-03-17 09:49:33'),
(13, 'Businesses', 'When you say public procurement, who is this?', 'Within 45 UK territories, the DICM is a social value framework supporting\r\nemergency service, councils, NHS Trusts and the criminal justice services. This\r\nframework provides buyers the real-time visibility of supplier social value\r\ncollaborations under the DICM within the UK.', '2025-03-07 16:12:18', '2025-03-17 09:42:59'),
(14, 'Businesses', 'What does Membership entail?', 'Membership is an annual subscription to join and operate your social value in support of the Dual Impact Collaboration Model (DICM) within our UK ecosystem. Your business membership provides teams\' access to charity & social enterprise organisations and the their activities within 45 territories, the functionality to engage and collaborate with organisations, the digital process to formalise a collaboration within a Social Purchase Order and for public buyers to see and review a collaboration in real-time. A DICM Social Value portfolio within our ecosystem, established by you through digital updates, can be seen by buyers within all 45 territories. ', '2025-03-07 16:12:40', '2025-03-17 09:48:53'),
(15, 'Businesses', 'So is this us contributing to existing activities rather than designing and delivering our own?', 'Yes. Rather than businesses developing stand-alone social value activities the\r\nobjective now is to support and sustain community-led activities known to be\r\ndelivering a dual impact as part of a strategic collaboration with public bodies.', '2025-03-07 16:13:01', '2025-03-07 16:13:01'),
(16, 'Buyers', 'Why do we need to join the ecosystem?', 'To access and utilise the DICM, your operation first needs to connect-into our\r\necosystem. We are the host environment for the DICM, providing all the digital\r\nconnectivity, processes, research and interactivity. We help you see the\r\ncollaborative links between businesses and community groups.', '2025-03-07 17:08:07', '2025-03-07 17:08:07'),
(17, 'Buyers', 'Is it easy to connect into the DICM?', 'Yes. After completing this joining process and entering our ecosystem you are\r\nautomatically connected to our <a href=\"https://pluggin.org/dicm/\" target =\"_blank\">Dual Impact Collaboration Model</a> (DICM). From\r\nthere, we work closely with you to embed the Social Purchase Order process\r\nwithin you live commissioning and procurement activities.', '2025-03-07 17:08:37', '2025-03-07 17:12:01'),
(18, 'Buyers', 'Are you looking to replace the existing ways social value is provided and reviewed within contracts?', 'Yes. The DICM has been specifically designed to collect-together the proven,\r\nlocally designed, operated and proven dual impact activities by geography and\r\nacross local providers. This enables businesses to quickly identify how they can\r\nlocally commit social value resources (financial or non-financial) to help sustain\r\nthe dual impact already established within the activities. The DICM enables a\r\nbusiness to propose this relevant social value as part of their bids, which (post-\r\ncontract award) converts to a formal (auditable) ongoing commitment which\r\ncan be locked into a supply contract.', '2025-03-07 17:08:49', '2025-03-07 17:08:49'),
(19, 'Buyers', 'Who leads the DICM strategic development in our area?', 'A: You do. All the public procurement leaders within each of the 45 UK territories of\r\nthe DICM lead on the review and shaping of the DICM within their area. Our\r\necosystem provides the detailed insights and key metrics showing how social\r\nvalue is flowing and impacting from suppliers within communities.', '2025-03-07 17:09:08', '2025-03-07 17:09:08'),
(20, 'Buyers', 'Is there any charge for us to join the ecosystem and DICM?', 'No, it’s free for you to enter and utilise the DICM within our ecosystem. Our\r\nobjective is to support the regional flow of supplier social value from within the\r\nUK’s emergency services, local authorities, NHS Trusts and the criminal justice\r\nservices. Businesses pay an annual subscription for their membership, enabling\r\nthem to operate their social value in support of the DICM across the UK – and we\r\nmake this visible to you.', '2025-03-07 17:09:27', '2025-03-07 17:09:27');

-- --------------------------------------------------------

--
-- Table structure for table `Sponsors`
--

CREATE TABLE `Sponsors` (
  `spo_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `spo_OrgName` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Address` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Registration` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `spo_VatNumber` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Regions` set('East Midlands','East of England','London','North East','North West','South East','South West','West Midlands','Yorks and Humber','Scotland','Wales','N. Ireland') COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Referer` varchar(500) COLLATE utf8mb4_general_ci NOT NULL,
  `approved` tinyint(1) NOT NULL,
  `spo_TradingName` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `spo_BusSize` enum('small business','medium/large business','social enterprise') COLLATE utf8mb4_general_ci NOT NULL,
  `spo_Clients` varchar(1000) COLLATE utf8mb4_general_ci NOT NULL,
  `spo_AccSetup` enum('yes','no') COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Sponsors`
--

INSERT INTO `Sponsors` (`spo_id`, `user_id`, `spo_OrgName`, `spo_Address`, `spo_Registration`, `spo_VatNumber`, `spo_Regions`, `spo_Referer`, `approved`, `spo_TradingName`, `spo_BusSize`, `spo_Clients`, `spo_AccSetup`) VALUES
(20, 174, 'Kyocera Document Solutions (UK) Ltd', '77 London Road Reading Berkshire RG1 5BS', '02150688', 'GB491632143', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', '', 1, 'Kyocera', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(21, 175, 'TELEFÓNICA TECH UK LIMITED', 'East House, Newpound Common, Wisborough Green Reigate Surrey RH14 0AZ', '02563193', 'GB386414672', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,N. Ireland', '', 1, 'TELEFONICA TECH', 'medium/large business', 'Police,Criminal Justice Service', 'yes'),
(22, 183, 'Mountain Healthcare Limited', 'First Floor, Station Place, Argyle Way,  Stevenage,  Herts SG1 2AD', '05578727', 'GB 444571782', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', '', 1, 'Mountain Healthcare', 'medium/large business', 'Police,NHS,Criminal Justice Service', 'yes'),
(23, 184, 'Alison Law Solicitors LLP', 'Alison House, 437-441 London Road,  Sheffield South Yorkshire S2 4HJ', 'OC378803', 'GB157 2011 39', 'East Midlands,London,North West,Yorks and Humber', '', 1, 'Alison Law Solicitors ', 'small business', 'Criminal Justice Service', 'yes'),
(27, 228, 'Maber Associates', 'St Mary\'s Hall 17 Barker Gate  Nottingham  Nottinghamshire NG1 1JU', '02007082', 'GB247160514', 'East Midlands,East of England,South East,West Midlands', 'Nottingham', 1, 'Maber', 'small business', 'Police,Councils,NHS', 'yes'),
(28, 229, 'Systems Technology Consultants Ltd', 'Unit 65 Shelton Enterprise Centre Stoke-on-Trent Staffordshire ST4 7AB', '03301898', 'GB 687 6123 02', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Wales', 'Staffordshire', 1, 'SYTECH', 'small business', 'Police,Criminal Justice Service', 'yes'),
(29, 230, 'Computacenter UK Ltd ', 'Hatfield Ave Hatfield  Hertfordshire  AL10 9TW ', '01584718', 'GB490334648', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Hatfield ', 1, 'Computacenter UK Ltd ', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(30, 231, 'Tailored Image Ltd', 'Unit 3, Granville Industrial Estate Dungannon Tyrone BT70 1NJ', 'NI034580', 'GB722696028', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Northern Ireland', 1, 'Tailored Image Ltd', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(31, 233, 'Adecco', '10 Bishop Square London Greater London E1 6EG', '00593232', 'Unknown', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Bishop Square, London', 1, '', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(32, 234, 'Softcat Plc', 'Softcat plc (Head Office), Fieldhouse Lane Marlow Buckinghamshire SL7 1LW', '02174990', 'GB 491 8485 03', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Marlow, Buckinghamshire', 1, '', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(33, 235, 'Point South Limited', 'Unit 17, Stratfield Park, Elettra Avenue, Waterlooville Hampshire PO7 7XN', '09667636', '219197685', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Hampshire', 1, '', 'small business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(34, 236, 'CDW Limited', 'One New Change London London EC4M 9AF', '02465350', 'GB902194939', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Wales,N. Ireland', 'London', 1, 'CDW Limited', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(35, 238, 'Specialist Computer Centres PLC', 'James House, Warwick Road Birmingham West Midlands B11 2LE', '01428210', '313651680', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'West Midlands', 1, 'SCC PLC', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(36, 243, 'Aon UK Ltd', '122 Leadenhall Street London London EC3V4AN', '210725', '480840148', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'london', 1, 'Maven Public Sector', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(37, 244, 'boxxe Limited', 'Artemis House, Floor 3, Eboracum Way, Heworth Green York Yorkshire YO31 7RE', '02109168', 'GB734245248', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'York', 1, 'boxxe Limited', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(38, 249, 'Mark Walker (Grounds Maintenance) Ltd', '5 Swallow End Welwyn Garden City Hertfordshire AL7 1JA', '4662268', '479145317', 'East of England,London,South East,West Midlands', 'Hertfordshire', 1, 'Mark Walker (Grounds Maintenance) Ltd', 'small business', 'Police,NHS,Fire', 'yes'),
(39, 250, 'AVR Group Limited', 'Units 16-24 Attenburys Park Estate Timperley Cheshire WA14 5QN', '01251842', '561 2984 28', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Wales,N. Ireland', 'Greater Manchester', 1, 'National Monitoring', 'small business', 'Police,Councils,Fire,Housing Associations', 'yes'),
(40, 251, 'Phoenix Software Limited', 'Blenheim House York Road, Pocklington, York, Yorkshire, United Kingdom, YO42 1NS York  Yorkshire  YO42 1NS', '02548628', 'GB 823 8182 26', 'East Midlands,East of England,London,North East,North West,West Midlands,Yorks and Humber,Scotland,Wales', 'Blenheim House Pocklington ', 1, 'Phoenix Software Limited ', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(41, 252, 'SBFM Limited', 'Unit 4, Temple Point, Bullerthorpe Lane Leeds West Yorkshire LS15 9JL', '8517137', '1909 675 65', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Harrogate, North Yorkshire', 1, 'SBFM', 'medium/large business', 'Police,Councils,Criminal Justice Service', 'yes'),
(42, 253, 'Motorola Solutions UK Ltd', 'Nova South 160 Victoria St London SW1E 5LB', '912182', 'GB260311213', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'London', 1, 'Motorola Solutions', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(43, 255, 'AXON PUBLIC SAFETY UK LIMITED', '14 Sopwith Way, Drayton Fields Industrial Estate Daventry Northamptonshire NN11 8PB', '07390059', 'GB998101590', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Northamptonshire', 1, 'Axon', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(44, 257, 'IntaForensics Limited', 'Unit 9, The Courtyard, Eliot Business Park Nuneaton Warwickshire CV10 7RJ ', '05292275', '491260395 ', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Warwickshire', 1, 'IntaForensics Limited', 'small business', 'Police,Councils,NHS,Criminal Justice Service', 'yes'),
(45, 258, 'Veolia UK Limited', '210 Pentonville Road London Greater London N1 9JY', '02664833', 'GB 530 0088 93', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Greater London', 1, 'Veolia', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(46, 259, 'QCC Global Ltd', '4th Floor, 1 Hind Court London London EC4A 3DL', '03773029', 'GB766622212', 'London,South West', '', 1, '', 'small business', 'Police,Criminal Justice Service', 'yes'),
(47, 261, 'CCL-Forensics Limited', '36 Cygnet Court Statford-upon-Avon Warwickshire CV37 9NW', '05314495', '218593487', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Wales', 'Warwickshire', 1, 'N/A', 'medium/large business', 'Police,Councils,NHS,Criminal Justice Service', 'yes'),
(48, 262, 'CY4OR LEGAL LIMITED', 'Benjarron House, Greenside Way Middleton, Manchester Manchester M24 1SW', '06295131', 'GB170268318', 'East Midlands,London,South West,West Midlands', 'CYFOR Group, Benjarron House, Greenside Way, Manchester M24 1SW', 1, 'CYFOR', 'medium/large business', 'Police,Councils,NHS,Criminal Justice Service', 'yes'),
(49, 264, 'Commissum Associates', '1 West Regent Street Glasgow Glasgow City G2 1RW', 'SC229945', '796 4661 72', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', '', 1, 'Resillion', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(50, 265, 'Virgin Media Business', '500 Brook Drive, Reading  Reading Berkshire RG2 6UU', ' 01785381', 'GB 591 8190 14', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Berkshire', 1, 'Virgin Media Business ', 'medium/large business', 'Police,Councils,NHS,Fire,Criminal Justice Service', 'yes'),
(51, 267, 'Recipero Ltd', 'Watermoor Point, Watermoor Road Cirencester Glos Gl7 1LF', '03794898', 'GB 746 4954 92', 'East Midlands,East of England,London,North East,North West,South East,South West,West Midlands,Yorks and Humber,Scotland,Wales,N. Ireland', 'Gloucestershire', 1, 'Recipero Ltd', 'small business', 'Police,Councils,NHS,Fire', 'no'),
(52, 268, 'Adapt-IT Limited', 'Office 4, Basepoint Business Centre, OAKFIELD CLOSE TEWKESBURY GLOUCESTERSHIRE GL20 8SD', '4270540', '3869398', 'South West,West Midlands', 'Gloucestershire', 1, '', 'small business', 'Councils,NHS', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `sponsorships`
--

CREATE TABLE `sponsorships` (
  `id` bigint NOT NULL,
  `spo_ref` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Auto-generated sponsorship reference',
  `status` enum('PROP','OFBP','OAAS','SIGN-U','CONF') COLLATE utf8mb4_general_ci DEFAULT 'PROP',
  `charity_id` bigint NOT NULL COMMENT 'References Charities table',
  `charity_name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name of the charity (redundant)',
  `sponsor_username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `sponsor_name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name of the sponsor (redundant)',
  `sponsor_email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `project_name` varchar(500) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Name of the project/activity',
  `project_purpose` varchar(500) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Purpose of the project/activity',
  `key_objectives` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Key objectives of the project/activity',
  `required_sponsorship` decimal(10,2) NOT NULL COMMENT 'The sponsorship ask for the project',
  `additional_resources` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Additional resources needed for the project',
  `sponsorship_offer` decimal(10,2) NOT NULL COMMENT 'Total sponsorship offer from sponsor',
  `monetary_value` decimal(10,2) NOT NULL COMMENT 'Monetary value provided by the sponsor',
  `monetary_details` text COLLATE utf8mb4_general_ci COMMENT 'Details of how monetary value will be spent',
  `goods_value` decimal(10,2) NOT NULL COMMENT 'Value of goods/services provided by the sponsor',
  `goods_details` text COLLATE utf8mb4_general_ci COMMENT 'Details of goods/services provided',
  `volunteering_value` decimal(10,2) NOT NULL COMMENT 'Volunteering value provided by the sponsor',
  `volunteering_details` text COLLATE utf8mb4_general_ci COMMENT 'Details of volunteering provided',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Record creation timestamp',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Last updated timestamp'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sponsorships`
--

INSERT INTO `sponsorships` (`id`, `spo_ref`, `status`, `charity_id`, `charity_name`, `sponsor_username`, `sponsor_name`, `sponsor_email`, `project_name`, `project_purpose`, `key_objectives`, `required_sponsorship`, `additional_resources`, `sponsorship_offer`, `monetary_value`, `monetary_details`, `goods_value`, `goods_details`, `volunteering_value`, `volunteering_details`, `created_at`, `updated_at`) VALUES
(36, 'SPO-20250619-281A6ADD', 'SIGN-U', 80, 'SAFE!', 'bus677327170', 'Softcat .', '', 'Building Respectful Families', 'supporting young people to reduce and stop abusive and violent behavioursreduction in the number of police call-outs for domestic incidents involving childrensupporting families to improve communication and repair relationshipssupporting both parent/carers and young people to improve their mental health and wellbeingsupporting young people to recognise their strengths and grow in confidencereducing the likelihood of a young person going on to use abusive behaviours in adult relationships', 'BRF provides support to families experiencing Child and Adolescent on Parent Violence and Abuse (CAPVA).\r\nWe work with both parent/carer and young person to address behaviours and improve communication.', 200000.00, 'Financial Support: CAPVA is an underreported and heavily stigmatised issue and we are aware that there are many families around the Thames Valley who are not accessing any form of support.\r\nWith additional resource we would be able to reach more families at a crucial point, helping them to access the support they need to rebuild their lives.\r\nAdditional funding could support us to increase staffing around the region.', 10000.00, 10000.00, 'If successfully awarded this contract, Softcat will donate £10,000 to SAFE Project within the first 12 months of the contract (between 01/08/2025 and 31/07/2026). \r\nAs discussed with Chloe Purcell (Director of SAFE Project) this funding will go towards running initiatives across the Thames Valley region to support young people and families affected by crime, helping them to rebuild their lives. \r\nOverall, the support provided by SAFE project enables children and young people to feel safe, thrive and achieve their potential. This aligns with the TVP Police and Crime plan by creating safer communities, reducing the risk of anti-social behaviour and preventing crime.', 0.00, '', 0.00, 'If successfully awarded this contract, Softcat will also advertise volunteering and fundraising activities (such as participation in the Oxford Half Marathon on to raise funds for SAFE Project) to all Softcat employees based at our Head Office in Marlow, Buckinghamshire. \r\nWe will work with Safe Project collaboratively to identify specialist areas where our staff can add value, such as IT training for young people and their families. ', '2025-06-19 09:30:25', '2025-07-21 10:12:10'),
(37, 'SPO-20250620-F016813E', 'SIGN-U', 103, 'Guiding Young minds ', 'bus455142701', 'CDW', '', 'GYM youth Bus- Outreach', 'We would like to request your sponsorship support for our service and explain further below: As you probably know, those of us at Guiding Young Minds (GYM) are doing everything in our power to provide support for our young people along with our community which is in fear of local Gang Violence. Our service provides many different options to support young people and communities. An important one of these is the outreach service we provide using the GYM Youth Bus, which hopefully you may have seen', '1. lower Anti-social behaviour \r\n2. steer young people away from Gangs\r\n3. Bring community together  \r\n4. Creating safe space for young people ', 10000.00, 'Financial Support: The issue we face now is that the Van is booked every day of the week!  We regularly get requests to go to more areas or to support local events, but if the bus is fully booked – well we only have one bus!\n\n \n\nWe have therefore embarked on the ambitious project to buy a second bus!  This wont be cheap of course, but if enough local businesses can support us with only a very small amount each, we believe we can achieve this.  And the result – reduced violence in our communities – has to be worthwhile!\n\nIf you would like to support our goal of buying a second bus with  donation or sponsorship of some sort this would be greatly appreciated. We can of course explore this further and work with you on establishing what you would like to bring / offer. \nWe could not do the work we do for our young people/communities without the help of generous people / businesses like yours, and any support no matter how little can make a difference. \nBreak down:\nPurchase Van\nconvert the van and designing of van\nInsurance \nEquipment- first aid kit, bleed kit, sports and gaming\n\nEquipment Support: Kit van up with many sports, gaming and engaging activities for young people to engage with and to encourage to keep them away from anti-social behaviour and gangs', 13000.00, 10000.00, '\r\nCDW has explored the proposed DCIM social value programmes listed within the Thames Valley Police carousel hosted on the Pluggin platform. Our Sustainability and Social Value Team focused the investigation on the Force’s ‘Protecting Communities’ pillar. Reviewing potential partnerships that will contribute to three of the cornerstones of the pillar; crime prevention, reducing anti-social behaviour, and building confidence.  \r\nOur specialist team have engaged with Guiding Young Minds (GYM), listed on the Pluggin Thames Valley Police carousel, as the organisation demonstrates clear alignment with Force’s ambitions of protecting communities. GYM is partner directly with local authorities and multi-agencies within Police & Crime Commissioner and Community Safety Partnership structure spanning the Midlands and Southeast, driving reduction in violent crime anti-social behaviour, whilst building confidence in communities, working directly with young people.\r\nGYM’s Youth Bus project delivers dual benefit, acting as a mobile youth club and providing mentoring and engagement support through proactive community outreach, directly engaging with young people where they are, in different settings and diverse environments.  The outreach programme focusses on raising awareness around gangs and knife crime providing young people the with support from youth workers, through either one to one or group sessions.\r\nGYM’s approach and programmes deliver tangible reductions in violence and supports Building Trust across communities, as evidenced by Coventry Police\r\n•	August 2024 was the lowest month of recorded serious youth violence since December 2023.\r\n•	St Michaels ward (city centre) saw a reduction in serious youth violence of 8% year over year.\r\n•	Zero incidents of SYV knife used offences recorded in the City centre in August 2024, the last time this happened was May 2023.\r\n•	August 2024 saw only 12 robberies in St Michaels, Lowest month in 4.5 years.\r\nCDW’s Sustainability and Social Value Team collaborated with Anton Noble founder of GYM to understand the resourcing pressures being faced and how levels of community demand require the organisation to double their current capacity for outreach activities, specifically by procuring  a second youth bus.  The current provision is already fully utilised each and every day and so GYM is not able to meet current demands for services.  To amplify the reach of the programme, CDW propose meeting the full sponsorship request of £10,000, providing funding at contract award so that Anton and his team can purchase the second bus and accelerate community outreach. CDW’s investment will provide the remaining required funds for the purchase.  Securing a second vehicle will ensure that GYM can reach twice the number of young people each year, continue to drive reductions in crime and anti-social behaviour, whilst  building confidence in communities.  \r\n', 3000.00, 'To support GYM with the fit out of the new community bus, specifically the procurement of gaming equipment CDW will supplement our financial support with a further £3,000.  The CDW Account Team will partner with Anton Noble, founder of GYM, from contract close to explore the best timing for the release of the additional funds to support the purchase of the gaming equipment.  The team will also support Anton with procurement expertise, providing access to CDW’s expansive supply chain resources to drive additional value through savings made available to CDW through our unparalleled procurement scale. \r\nCDW anticipate that the final decisions on requirements will be predicated upon the purchase of the bus and progress of the fit out.  CDW anticipate that the funds for the gaming equipment will be required within the first year of the Thames Valley Police contract.\r\n', 0.00, 'CDW’s approach to sustainability is centred upon the ethos of being purpose led and performance driven, orchestrated across 4 foundational pillars, People, Planet, Partnerships & Portfolio and Practices.  Our people pillar centres upon using our reach, scale and capabilities to create opportunities for our people and the communities we serve.  The pillar comprises a portfolio of programmes and actions spanning: talent acquisition, early year career programmes, coworker development, diversity equity and inclusion, social impact through volunteering, philanthropy and school outreach work experience.  \r\nCDW’s community engagement programme is orchestrated by our Social Impact Strategy lead and a team of 5 social impact ambassadors aligned across our campuses and providing geographic reach.   The programme spans, volunteering, philanthropy and outreach programmes.\r\n\r\nVolunteering: Together the team explore community partnerships, building and promoting a curated portfolio of volunteering opportunities, providing coworkers with a guided approach to use the 1 day of paid volunteering time off that CDW grants to every full-time coworker. These efforts resulted in CDW delivering 4,515 hours of volunteering in 2024, a 91% increase compared to 2023.\r\nTo support GYM CDW will align volunteers from the Thames Valley Police Account Management Team to provide 2 days of volunteering during each year of the contract, 10 days in total.  At contract close the team will collaborate with Anton Noble to build a programme of activities where we will deliver the greatest value to the young people served by GYM. Initial concepts include cohering and delivering a workshop programme based centred on building confidence, leveraging lived experience across early year careers, presentation skills, and interview skills. \r\n', '2025-06-20 08:32:05', '2025-07-21 10:11:32'),
(38, 'SPO-20250620-9F5CD9AC', 'SIGN-U', 77, 'Starting Point (part of The Mustard Tree Foundation, Reading)', 'bus201690846', 'Phoenix Software .', '', 'Starting Point', 'Starting Point offers local, long-term, 1:1, relational, tailored, and holistic support to young people who face disadvantage:Attain, sustain, and thrive within a job, college course or apprenticeship.Prevent exclusion and increase positive engagement in education.Steer away from crime, violence, substance abuse or misuse, or risk-taking behaviour.Make positive changes in their socio-emotional development and wellbeing.', 'Starting Point enables young people who face disadvantage to see transformation in their lives - we passionately believe every young person should have the chance of a brighter more hopeful future.', 60000.00, 'Financial Support: Finance, Equipment, Training, Staff, Volunteers', 0.00, 0.00, '', 0.00, '', 0.00, 'Phoenix Software can offer 30 hours volunteering per year of contract to young people considering or wanting to know more about careers in technology as an alternative pathway.  This could be as simple as a career talk with a specialist in a role, or an interactive group activity enabling young people to explore technology and the different career opportunities and apprenticeships within the sector.  Our offerings include, using the mixed reality headset HoloLens discussing how it is used in the workplace, repairing laptops and/ or having an AI debate (this one gets five star feedback).\r\n\r\nThe aim of the support is to enthuse young people to explore careers in high growth areas that are accessible to everyone.\r\n\r\nThe Phoenix ESG team will be in contact with Starting Point to arrange delivery at suitable times for the beneficiaries.  \r\n\r\nFeedback will be provided in quarterly updates to TVP to ensure progress and delivery.  \r\n\r\nActivity feedback will be shared and reviewed between all stakeholders for continuous improvement in following years.\r\n\r\nPAYE value will be agreed after tender award.', '2025-06-20 14:06:07', '2025-07-21 10:11:56'),
(39, 'SPO-20250620-F90D6092', 'SIGN-U', 78, 'SOFEA', 'bus201690846', 'Phoenix Software .', '', 'School Navigators Programme', 'Using SOFEA\'s expertise in youth work to maintain young people at risk of exclusion in education between ages of 11-16 (Secondary).To develop relationships with young people that due to exclusion may be at risk of offending or becoming NEET.Promote positive choices through guided support and communication to the community that surrounds the young person.Plan and understand what life can look like if a positive opportunity and choice is taken or strived for.Sharing this to everyone who supports t', 'The School Navigators Programme is specifically designed to maintain young people in education who are at risk of exclusion.', 150000.00, 'Financial Support: Funding for additional staffing.', 0.00, 0.00, '', 0.00, '', 0.00, 'Phoenix Software can offer 30 hours volunteering per year of contract to young people considering or wanting to know more about careers in technology as an alternative pathway.  This could be as simple as a career talk with a specialist in a role, or an interactive group activity enabling young people to explore technology and the different career opportunities within the sector.  Our offerings include, using the mixed reality headset HoloLens discussing how it is used in the workplace, repairing laptops and/ or having an AI debate (this one gets five star feedback).\r\nThe aim of the support is to enthuse young people to explore careers in high growth areas that are accessible to everyone.\r\nThe Phoenix ESG team will be in contact with SOFEA to arrange delivery at suitable times for the beneficiaries.  \r\nFeedback will be provided in quarterly updates to TVP to ensure progress and delivery.  \r\nActivity feedback will be shared and reviewed between all stakeholders for continuous improvement in following years.', '2025-06-20 14:34:54', '2025-07-21 10:12:21'),
(40, 'SPO-20250624-B16C1454', 'SIGN-U', 80, 'SAFE!', 'bus201690846', 'Phoenix Software .', '', 'Building Respectful Families', 'supporting young people to reduce and stop abusive and violent behavioursreduction in the number of police call-outs for domestic incidents involving childrensupporting families to improve communication and repair relationshipssupporting both parent/carers and young people to improve their mental health and wellbeingsupporting young people to recognise their strengths and grow in confidencereducing the likelihood of a young person going on to use abusive behaviours in adult relationships', 'BRF provides support to families experiencing Child and Adolescent on Parent Violence and Abuse (CAPVA).\r\nWe work with both parent/carer and young person to address behaviours and improve communication.', 200000.00, 'Financial Support: CAPVA is an underreported and heavily stigmatised issue and we are aware that there are many families around the Thames Valley who are not accessing any form of support.\r\nWith additional resource we would be able to reach more families at a crucial point, helping them to access the support they need to rebuild their lives.\r\nAdditional funding could support us to increase staffing around the region.', 1000.00, 1000.00, 'On award of contract in 2025, we will make this donation to Safe! to support them with their work in families and help to reduce the impact of crime.', 0.00, '', 0.00, '', '2025-06-24 14:19:09', '2025-07-21 10:11:42'),
(41, 'SPO-20250723-76644B66', 'OFBP', 103, 'Guiding Young minds ', 'bus467391324', 'QCC Global .', '', 'GYM youth Bus- Outreach', 'We would like to request your sponsorship support for our service and explain further below: As you probably know, those of us at Guiding Young Minds (GYM) are doing everything in our power to provide support for our young people along with our community which is in fear of local Gang Violence. Our service provides many different options to support young people and communities. An important one of these is the outreach service we provide using the GYM Youth Bus, which hopefully you may have seen', '1. lower Anti-social behaviour \r\n2. steer young people away from Gangs\r\n3. Bring community together  \r\n4. Creating safe space for young people ', 10000.00, 'Financial Support: The issue we face now is that the Van is booked every day of the week!  We regularly get requests to go to more areas or to support local events, but if the bus is fully booked – well we only have one bus!\r\n\r\n \r\n\r\nWe have therefore embarked on the ambitious project to buy a second bus!  This wont be cheap of course, but if enough local businesses can support us with only a very small amount each, we believe we can achieve this.  And the result – reduced violence in our communities – has to be worthwhile!\r\n\r\nIf you would like to support our goal of buying a second bus with  donation or sponsorship of some sort this would be greatly appreciated. We can of course explore this further and work with you on establishing what you would like to bring / offer. \r\n\r\n \r\n\r\nWe could not do the work we do for our young people/communities without the help of generous people / businesses like yours, and any support no matter how little can make a difference. \r\nBreak down:\r\nPurchase Van\r\nconvert the van and designing of van\r\nInsurance \r\nEquipment- first aid kit, bleed kit, sports and gaming\r\n\r\nEquipment Support: Kit van up with many sports, gaming and engaging activities for young people to engage with and to encourage to keep them away from anti-social behaviour and gangs', 7800.00, 5000.00, '£5k for the bus\r\nAs part of our commitment to delivering meaningful social value, we are proud to contribute £5,000 towards the purchase of a second outreach bus for a local youth charity.\r\nIt is clear that the addition of a second vehicle will significantly increase their capacity to support young people across the community. With their current van fully booked, this second bus will allow them to double their reach, enabling them to attend more events, visit more neighbourhoods, and provide consistent, positive engagement for young people.\r\nThe new bus will serve as a mobile hub for outreach, offering activities that help keep young people off the streets and away from gang involvement. It will also support new initiatives aimed at helping individuals into employment—providing a safe space for job searching, CV writing, and skills development.\r\nOur £5,000 donation will directly support the purchase of the vehicle, forming the foundation of this impactful project. We are proud to support a cause that aligns so closely with our values—creating safer communities, empowering young people, and reducing crime through early intervention and opportunity.\r\n', 1000.00, 'As part of our commitment to digital inclusion and community development, we are donating £1,000 worth of refurbished laptops to support a local youth charity’s new outreach initiative.\r\nThe laptops will be used as part of the charity’s plan to expand their services with a second outreach bus, which will not only engage young people but also provide practical support for those seeking employment. The donated devices will enable individuals to:\r\n•	Write CVs and cover letters\r\n•	Search and apply for jobs online\r\n•	Access training and educational resources\r\nThis contribution directly supports the charity’s goal of helping people—particularly young individuals—find a positive path away from gang involvement and crime, by opening up opportunities for employment and personal development.\r\nBy improving access to technology, we are helping to break down digital barriers and empower individuals to take control of their futures. This donation will have a lasting impact on the lives of those who use the service, contributing to safer, more resilient communities.\r\n', 1800.00, 'We are pledging volunteering time from two members of staff, who will each support a local youth charity twice a year through structured volunteering activities.\r\nThese sessions will be coordinated in partnership with the charity and are expected to include:\r\n•	Delivering online safety workshops for both young people and older community members, helping to raise awareness of cyber threats and reduce the risk of cybercrime.\r\n•	Supporting outreach events run from the charity’s new second bus, engaging directly with young people and contributing to activities that promote positive choices and community safety.\r\nThis volunteering commitment will enhance the charity’s capacity to deliver impactful, face-to-face support and education. It also aligns with our social value goals by:\r\n•	Improving digital literacy and online safety awareness\r\n•	Strengthening intergenerational community engagement\r\n•	Contributing to crime prevention through education and early intervention\r\nBy sharing our time and expertise, we aim to support the charity’s mission of creating safer, more resilient communities and offering young people a positive path forward\r\nIf the contract is to be extended, we will we commit to our staff volunteering for each additional year.\r\n', '2025-07-23 08:56:20', '2025-07-23 12:16:48'),
(42, 'SPO-20250728-CD54BD95', 'OFBP', 80, 'SAFE!', 'bus940313044', 'CY4OR LEGAL', '', 'Building Respectful Families', 'supporting young people to reduce and stop abusive and violent behavioursreduction in the number of police call-outs for domestic incidents involving childrensupporting families to improve communication and repair relationshipssupporting both parent/carers and young people to improve their mental health and wellbeingsupporting young people to recognise their strengths and grow in confidencereducing the likelihood of a young person going on to use abusive behaviours in adult relationships', 'BRF provides support to families experiencing Child and Adolescent on Parent Violence and Abuse (CAPVA).\r\nWe work with both parent/carer and young person to address behaviours and improve communication.', 200000.00, 'Financial Support: CAPVA is an underreported and heavily stigmatised issue and we are aware that there are many families around the Thames Valley who are not accessing any form of support.\r\nWith additional resource we would be able to reach more families at a crucial point, helping them to access the support they need to rebuild their lives.\r\nAdditional funding could support us to increase staffing around the region.', 7500.00, 1000.00, '(CY4OR Legal Limited) CYFOR will provide a £1,000 cash donation to SAFE to help fund two group based ‘Repairing Relationships’ sessions in Reading and Oxford. This will cover facilitation costs, printed resources, venue hire, and participant transport support, enabling engagement with vulnerable families who might otherwise be unable to attend. The sessions support early intervention and family cohesion.', 2000.00, 'We propose to donate up to £2,000 in refurbished tech equipment per annum which will support SAFE to deliver more accessible, digitally supported sessions under its ‘Repairing Relationships’ programme. These devices help practitioners reach vulnerable families remotely, support young people’s engagement through interactive tools, and improve staff efficiency across the Thames Valley.', 4500.00, 'We will provide up to 30 hours (£150/hour x 30 hours = £4,500 annually) per year of skilled volunteering to SAFE led by Digital Forensic experts. Activities will include digital safety workshops and mentoring sessions.', '2025-07-28 12:16:30', '2025-07-28 12:53:21'),
(43, 'SPO-20250728-84994D4D', 'OFBP', 67, 'Berkshire Youth', 'bus940313044', 'CY4OR LEGAL', '', 'Open Access Youth Work', 'A well established support service for young people facing modern day challenges with trauma, SEN, mental health and education. Within communities, a dedicated and ongoing provision and support wrap-around.', 'Build a continuous and sustainable support within communities, in partnership with public and private sector collaborators. Embed a continuous service and presence within areas of most recognised deprivation/challenges within counties.', 20000.00, 'Financial Support: Funding to support the core costs of delivery, which include staffing and resourcing.', 7500.00, 1000.00, ' CYFOR (CY4OR Legal Limited) will provide £1,000 per year in financial support to Berkshire Youth, helping sustain core staffing and programme delivery across priority communities in Slough, Reading, and Newbury. This will fund youth workers, session resources, and outreach activities tackling trauma, mental health, and exclusion.', 2000.00, 'CYFOR will donate surplus and professionally refurbished IT equipment valued at up to £2,000 per year to Berkshire Youth. This contribution will provide essential laptops, monitors, and accessories to support the charity’s youth centres and outreach programmes across Berkshire. The equipment will help staff deliver digital learning, wellbeing sessions, and virtual mentoring to young people facing barriers due to trauma, mental health challenges, or social exclusion. All devices will be securely wiped and prepared in line with ISO 27001 standards, supporting Berkshire Youth’s mission to build resilience and opportunity in the region’s most disadvantaged communities.', 4500.00, 'CYFOR will contribute up to 30 hours per year of skilled volunteering by our Digital Forensic experts, supporting BY youth programmes through digital safety workshops and mentoring. This represents a social value contribution of approximately £4,500 per year, based on an average specialist rate of £150/hour.', '2025-07-28 12:25:09', '2025-07-28 12:53:32'),
(44, 'SPO-20250728-E34F2861', 'OFBP', 65, 'The Wildheart Foundation', 'bus297754705', 'Intaforensics .', '', 'Mentoring and tutoring provision', 'To provide young people with complex SEND needs including ADHD, Autism and PDA social, emotional or mental health needs educational provision an inclusive multi-sensory approach to education.To empower children to lead their learning so they can thrive personally and academically.', 'We are The Wildheart Foundation. Our mission is to build a new kind of tutoring and mentoring provision, where children and young people are at the centre of everything we do.', 50000.00, 'Financial Support: Connections to other organisations working in this space Community and collaboration Funding Tech advise and development', 6000.00, 0.00, '', 0.00, '', 6000.00, '\r\nIntaForensics is proud to support the Wildheart Foundation through a structured outreach programme focused on early intervention, digital resilience, and career readiness for young people. \r\n\r\nPlanned Delivery \r\n\r\nWe will deliver two full-day outreach sessions annually, facilitated by two senior professionals from IntaForensics. These sessions will include: \r\n\r\nDigital Awareness & Online Safety \r\n\r\nOnline safety and safeguarding \r\n\r\nResponsible use of social media \r\n\r\nCyberbullying and digital harassment \r\n\r\nUnderstanding and preventing stalking online \r\n\r\nCareer Pathways in Digital Forensics and Cyber Security \r\n\r\nIntroduction to careers in cyber security and digital forensics \r\n\r\nNavigating professional opportunities and education pathways \r\n\r\nAll sessions are co-designed with educators to align with PSHE and IT curriculum standards and comply with Gatsby Benchmarks for career guidance. \r\n\r\nSocial Value Investment \r\n\r\nPersonnel Involved: 2 senior professionals \r\n\r\nFrequency: 2 full-day sessions per year \r\n\r\nValue of Investment: £6,000 annually (£1,500 per day, per professional) \r\n\r\nDelivery Oversight \r\n\r\nContract Manager: Leah Reeves \r\n\r\nSocial Value Lead: Toni Peat \r\n\r\nMonitoring & Reporting \r\n\r\nAnnual delivery is documented via case studies \r\n\r\nCase studies shared with the Wildheart Foundation to demonstrate impact ', '2025-07-28 13:06:55', '2025-07-28 13:59:56'),
(45, 'SPO-20250728-70BA9B52', 'OFBP', 77, 'Starting Point (part of The Mustard Tree Foundation, Reading)', 'bus297754705', 'Intaforensics .', '', 'Starting Point', 'Starting Point offers local, long-term, 1:1, relational, tailored, and holistic support to young people who face disadvantage:Attain, sustain, and thrive within a job, college course or apprenticeship.Prevent exclusion and increase positive engagement in education.Steer away from crime, violence, substance abuse or misuse, or risk-taking behaviour.Make positive changes in their socio-emotional development and wellbeing.', 'Starting Point enables young people who face disadvantage to see transformation in their lives - we passionately believe every young person should have the chance of a brighter more hopeful future.', 60000.00, 'Financial Support: Finance, Equipment, Training, Staff, Volunteers', 6000.00, 0.00, '', 0.00, '', 6000.00, 'IntaForensics supports Starting Point by delivering quarterly workshops designed to equip individuals with the tools needed for careers in digital and forensic science. \r\n\r\nWorkshop Content \r\n\r\nEach session will focus on: \r\n\r\nTailored CV reviews \r\n\r\nMock interview practice \r\n\r\nOne-to-one career coaching \r\n\r\nTarget participants include jobseekers, career changers, and individuals re-entering the workforce. \r\n\r\nSocial Value Investment \r\n\r\nPersonnel Involved: 1 IntaForensics professional per session \r\n\r\nFrequency: 1 session per quarter (4 annually) \r\n\r\nValue of Investment: £6,000 annually (£1,500 per day) \r\n\r\nDelivery Oversight \r\n\r\nSingle Point of Contact: Leah Reeves (Contract Manager) and Toni Peat (Social Value Lead) \r\n\r\nMonitoring & Reporting \r\n\r\nQuarterly documentation of activities and outcomes \r\n\r\nAnnual case study shared with Starting Point to demonstrate impact \r\n\r\n ', '2025-07-28 13:09:15', '2025-07-28 14:00:18'),
(46, 'SPO-20250728-D550230B', 'OFBP', 97, 'Educafe CIC', 'bus297754705', 'Intaforensics .', '', 'Community Cafe', 'Community mental health, early years, employability and resettlement support.', 'Community mental health, early years, employability, resettlement support', 26000.00, 'Financial Support: We rely on our volunteer team and increasingly use more time to manage. We also want to offer parking expenses and thank you events to keep our volunteer team motivated and engaged\r\n\r\nEquipment Support: Laptops, printers, tablets for team and volunteers to support our visitors with language support/resources, form filling, bills advice, money saving and community navigation.\r\n\r\nProfessional Support: New business development and strategy to support us to equip other communities to adopt our model', 1000.00, 0.00, '', 1000.00, 'To address digital deprivation in local schools, IntaForensics donates refurbished IT hardware as part of our commitment to educational equity. \r\n\r\nInitiative Details \r\n\r\nDonation of refurbished laptops and computers, repurposed from our IT asset lifecycle \r\n\r\nEquipment prepared by our internal IT team to ensure secure data wiping and full functionality \r\n\r\n \r\n\r\n \r\n\r\nSocial Value Investment \r\n\r\nAnnual Value of Donations: £1,000 (equivalent to 8–9 refurbished laptops) \r\n\r\nDelivery Oversight \r\n\r\nResponsible Lead: Chris Nelson (Head of Technology) \r\n\r\nInternal Resources \r\n\r\nManaged by our internal IT team \r\n\r\nEmbedded into our annual hardware lifecycle management and disposal process \r\n\r\nImpact \r\n\r\nThis initiative supports Educate CIC’s mission to promote inclusive economic development and improve mental health outcomes for young people. \r\n\r\n ', 0.00, '', '2025-07-28 13:10:36', '2025-07-28 14:00:10'),
(47, 'SPO-20250728-76ED39DB', 'OFBP', 82, 'Ride High', 'bus474439423', 'Resillion .', '', 'Equine-assisted greencare to support disadvantaged children and young people\'s (CYP) wellbeing and mental health', 'RH provides riding lessons supplemented with clubroom-based activities aimed at promoting happiness, building social skills, and engendering self-confidence.All CYP have poor wellbeing on arrival at Ride High and our primary objective is to help them improve their wellbeing.We define wellbeing as being comfortable, healthy and happy and look at specific characteristics to create an overall assessment of a young person\'s wellbeing. Ride High does this by:1.Helping children and young people to dev', 'Ride High supports at risk young people, referred by professionals, with a riding &clubroom-based programme, empowering them to develop new skills, renew hope and build greater resilience.', 15000.00, 'Financial Support: Our waiting list currently stands at over 50 children and young people referred by professionals.\r\nWe urgently need extra funding to pay for places on our programmes to help reduce our waiting list enabling Ride High to help more vulnerable children.\r\nFor each 12-week programme benefiting 8 children, the costs are as follows:\r\nSalaries, NI, pension etc The total £1,408 per child would be £11,264 for 8 children\r\nThis can be broken down to: £810 per child and therefore £6,480 for 8 children\r\nRiding Lessons £255 per child and therefore £2,040 for 8 children\r\nTransport £78 per child and therefore £624 for 8 children Facilities ?259 per child and therefore £2,072 for 8 children\r\nClothing & resources £6 per child and therefore £48 for 8 children\r\nAs you can see, we have placed our \"Ask\" for batches of 8 children and an uplift to allow funds directly to core funding as well. Ride high would love your assistance have as many batches as possible of 8 children to participate and thank you in advance.', 15000.00, 15000.00, 'Resillion propose to meet the full sponsorship ask via a donation to benefit 8 children over a 12-week programme.  Approx breakdown per child: Staff costs @ £1,408, Riding Lessons @ £255, Transport @ £78, Facilities @ £259, Clothing & resources @ £6 per child. ', 0.00, 'N/A', 0.00, 'N/A', '2025-07-28 14:49:28', '2025-07-28 16:12:17'),
(48, 'SPO-20250805-7CE69202', 'CONF', 99, 'Guru Leadership and Coaching', 'telefonicatech', 'TELEFÓNICA TECH UK LIMITED	 .', '', 'The Professional Action Learning Sets (PALS) Programme - West Mercia', 'The PALS Programme is designed to tackle barriers to career progression for ethnically diverse police officers and staff within West Mercia Police. By developing leadership skills, confidence, and self-awareness, the programme builds a talent pipeline to more senior roles, enhancing diversity and representation in police leadership. Ultimately, PALS benefits West Mercia communities by fostering a more inclusive and trusted police force that reflects the diversity of the population it serves.', 'Break down real and perceived barriers to career progression for ethnically diverse officers and staff.\r\n\r\nEquip participants with leadership skills, coaching, and self-development tools.\r\n\r\nDevelop a more inclusive, motivated, and representative police leadership.\r\n\r\nImprove engagement, trust, and service outcomes across West Mercia communities.\r\n\r\nContribute to West Mercia Police’s strategic vision, values and organisational priorities and DE&I goals.', 35000.00, 'Financial Support: The funding will directly support delivery of Cohort 4 of the PALS Programme. This includes:\r\n\r\nLeadership training and professional development sessions\r\n\r\nCoaching and mentoring provision\r\n\r\nProgramme materials such as: Course book: \"7 Habits of Highly Effective People\" by Stephen Covey, PALS Handbooks and Booklets, Graduation Certificates and Launch/Graduation Events, Certification via Skills for Justice. \r\n\r\nAdditional support may also be used for a contingency reserve to safeguard future cohorts or to broaden impact across the force, for example, cultural and community engagement events (e.g., Black History Month, South Asian Heritage Month).\r\n\r\nEquipment Support: n/a\r\n\r\nProfessional Support: n/a', 500.00, 500.00, 'To be put towards Cohort 4 of the PALS Programme', 0.00, '', 0.00, '', '2025-08-05 13:38:47', '2025-08-08 08:09:45');

-- --------------------------------------------------------

--
-- Table structure for table `SPO_Accounts`
--

CREATE TABLE `SPO_Accounts` (
  `sa_id` bigint NOT NULL,
  `spo_id` bigint NOT NULL,
  `sa_fName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sa_lName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sa_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SPO_Accounts`
--

INSERT INTO `SPO_Accounts` (`sa_id`, `spo_id`, `sa_fName`, `sa_lName`, `sa_Email`) VALUES
(20, 20, 'Accounts', 'Payable', 'AccountsPayable@duk.kyocera.com'),
(21, 21, 'Accounts', 'Payable', 'accounts@telefonika.uk'),
(22, 22, 'David', 'Allen', 'david.allen@mountainhealthcare.co.uk'),
(23, 23, 'Accounts', 'Office', 'rahman@alison-law.co.uk'),
(27, 27, 'Laura', 'MacKay', 'laura.mackay@maber.co.uk'),
(28, 28, 'Jo', 'Davies', 'jo.davies@sytech-consultants.com'),
(29, 29, 'Mark ', 'Careford ', 'mark.careford@computacenter.com'),
(30, 30, 'Brian', 'Bell', 'brian.bell@tailoredimage.com'),
(31, 31, 'Emily', 'Day', 'emily.day@adecco.co.uk'),
(32, 32, 'Public', 'Sector', 'psitq@softcat.com'),
(33, 33, 'Victoria', 'Ross', 'accounts@point-south.uk'),
(34, 34, 'Hannah', 'Gibson', 'Accountspayable@uk.cdw.com'),
(35, 35, 'Accounts', 'Payable', 'accountspayable@scc.com'),
(36, 36, 'Marie', 'Lafayette', 'enquiries@mavenps.co.uk'),
(37, 37, 'Heather', 'Gout', 'heather.gout@boxxe.com'),
(38, 38, 'Candice', 'Hume', 'accounts@markwalkergm.co.uk'),
(39, 39, 'Paul', 'Kershaw', 'accounts@monitoring.co.uk'),
(40, 40, 'Phoenix ', 'Software ', 'accounts@phoenixs.co.uk'),
(41, 41, 'Laura ', 'Carney', 'purchaseledger@sb-fm.co.uk'),
(42, 42, 'Mike', 'Guida', 'mike.guida@motorolasolutions.com'),
(43, 43, 'Accounts Payable', 'UK', 'AP.AUK@axon.com'),
(44, 44, 'Tender', 'Jagatia', 'tenders@intaforensics.com'),
(45, 45, 'Tabitha', 'Serle', 'tabitha.serle@veolia.com'),
(46, 46, 'Laura', 'Campbell', 'laura.campbell@qccglobal.com'),
(47, 47, 'Melina', 'Sapanadis', 'melina.sapanadis@cclsolutionsgroup.com'),
(48, 48, 'Paul', 'Bechinor', 'paul.beechinor@cyfor.co.uk'),
(49, 49, 'Chirag', 'Patel', 'chirag.patel@resillion.com'),
(50, 50, 'Evie', 'Metcalfe', 'evie.metcalfe@virginmediao2.co.uk'),
(51, 51, 'Liza', 'Booth', 'Liza.Booth@recipero.com'),
(52, 52, 'Jane', 'O\'Gorman', 'Jane.ogorman@adapt-it.co.uk');

-- --------------------------------------------------------

--
-- Table structure for table `SPO_MainContactdetails`
--

CREATE TABLE `SPO_MainContactdetails` (
  `smcd_id` bigint NOT NULL,
  `spo_id` bigint NOT NULL,
  `smcd_Name` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `smcd_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `smcd_Phone` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `smcd_JobTitle` varchar(250) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SPO_MainContactdetails`
--

INSERT INTO `SPO_MainContactdetails` (`smcd_id`, `spo_id`, `smcd_Name`, `smcd_Email`, `smcd_Phone`, `smcd_JobTitle`) VALUES
(20, 20, 'John  Barron', 'John.barron@duk.Kyocera.co.uk', '+447775705669', 'Head of Public Sector Sales'),
(21, 21, 'Janice Phayre', 'Janice.Phayre@telefonicatech.uk', 'n/a', 'ESG Manager'),
(22, 22, 'Jess Tennison-Hall', 'jess.tennison-hall@mountainhealthcare.co.uk', 'n/a', 'Business Development & Service Improvement Manager'),
(23, 23, 'Habib Rahman', 'rahman@alison-law.co.uk', 'n/a', 'Chairman'),
(27, 27, 'Ian  Harris', 'laura.mackay@maber.co.uk', '0115 941 5555', 'Managing Director'),
(28, 28, 'jessica clewlow', 'jessica.clewlow@sytech-consultants.com', '01782 286300', 'Director'),
(29, 29, 'Reena  Chawla ', 'reena.chawla@computacenter.com', '07900404449', 'Public Sector Social Value Director '),
(30, 30, 'Laura  Shepherd', 'laura.shepherd@tailoredimage.com', '028 8772 6876', 'Bid Manager '),
(31, 31, 'Emily Day', 'emily.day@adecco.co.uk', '01782349154', 'Social Value Manager'),
(32, 32, 'Alexandra Francis', 'alexandrafr@softcat.com', '0161 274 5193', 'Contracts Enablement Team Leader'),
(33, 33, 'Mike Ross', 'mike@point-south.uk', '01243767327', 'Director'),
(34, 34, 'Jon Steggles', 'j.steggles@uk.cdw.com', '02077916000', 'ESG Strategic Lead'),
(35, 35, 'Alexander Groves', 'alexander.groves@scc.com', '07595865806', 'Head of Sustainability'),
(36, 36, 'Fiona Litchmore', 'fiona.litchmore@mavenps.co.uk', '07341867464', 'Bid Coordinator'),
(37, 37, 'Samantha Dias', 'samantha.dias@boxxe.com', '07704552044', 'Community & Social Value Partner'),
(38, 38, 'Marco Ametrano', 'marco.ametrano@markwalkergm.co.uk', '03332205485', 'Director'),
(39, 39, 'Elaine Wood', 'accounts@monitoring.co.uk', '0333 222 3995', 'Account Manager'),
(40, 40, 'Bids  Admin ', 'Bids@phoenixs.co.uk', '01904 562200 ', 'Bid Co Ordinator '),
(41, 41, 'Jamie  Canter', 'Jamie.Canter@sb-fm.co.uk', '0750 693 9857', 'Head of Learning & Inclusion'),
(42, 42, 'Mike Guida', 'mike.guida@motorolasolutions.com', '07778631560', 'Senior Government Marketer'),
(43, 43, 'Molly O\'Byrne', 'mobyrne@axon.com', '07495505212', 'International Marketing Manager'),
(44, 44, 'Rupa Jagatia', 'tenders@intaforensics.com', '02477717780', 'Head of Bid Management '),
(45, 45, 'Tabitha Serle', 'tabitha.serle@veolia.com', '07901221414', 'Sustainability Manager'),
(46, 46, 'Adam James', 'adam.james@qccglobal.com', '07498175859', 'Project Manager'),
(47, 47, 'Samantha Ollis', 'sam.ollis@cclsolutionsgroup.com', '07534637708', 'Bid manager'),
(48, 48, 'Andrew Frowen', 'andrew.frowen@cyfor.co.uk', '07437515155', 'Chief Technical Officer'),
(49, 49, 'Alex Northwood', 'alexander.northwood@resillion.com', '07747777762', 'Cyber Bid Manager'),
(50, 50, 'Evie Metcalfe', 'evie.metcalfe@virginmediao2.co.uk', '07580483597', 'Social Value Lead'),
(51, 51, 'Andrew Kewley', 'Andrew.Kewley@recipero.com', '07880 187015', 'Head of Public Sector'),
(52, 52, 'Simon O\'Gorman', 'simon.ogorman@Adapt-IT.co.uk', '03300564079', 'Managing Director');

-- --------------------------------------------------------

--
-- Table structure for table `SPO_Marketing`
--

CREATE TABLE `SPO_Marketing` (
  `sm_id` bigint NOT NULL,
  `spo_id` bigint NOT NULL,
  `sm_fName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sm_lName` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sm_Email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SPO_Marketing`
--

INSERT INTO `SPO_Marketing` (`sm_id`, `spo_id`, `sm_fName`, `sm_lName`, `sm_Email`) VALUES
(2, 20, 'Steve', 'Pearce', ''),
(3, 21, 'TBC', 'TBC', ''),
(4, 22, 'Jess', 'Tennison-Hall', ''),
(5, 23, 'Marketing', 'Team', ''),
(9, 27, 'Laura', 'MacKay', ''),
(10, 28, 'jessica', 'clewlow', ''),
(11, 29, 'TBC', 'TBC ', ''),
(12, 30, 'Joanne ', 'Reihill', ''),
(13, 31, 'Emily', 'Day', ''),
(14, 32, 'Alexandra', 'Francis', ''),
(15, 33, 'Mike', 'Ross', ''),
(16, 34, 'Nola', 'Pocock', ''),
(17, 35, 'Marketing ', 'Marketing', ''),
(18, 36, 'Tim ', 'Boryer', ''),
(19, 37, 'Laura', 'Smith-King', ''),
(20, 38, 'Marco', 'Ametrano', ''),
(21, 39, 'Elaine', 'Wood', ''),
(22, 40, 'Ben ', 'Murden ', ''),
(23, 41, 'Kiera ', 'Gardner', ''),
(24, 42, 'Mike', 'Guida', ''),
(25, 43, 'Molly', 'O\'Byrne', ''),
(26, 44, 'Tender', 'Jagatia', ''),
(27, 45, 'Tabitha', 'Serle', ''),
(28, 46, 'Adam', 'James', ''),
(29, 47, 'Darren', 'Powney', ''),
(30, 48, 'Rebecca', 'Peace', ''),
(31, 49, 'Robert', 'Lagaso', ''),
(32, 50, 'Evie', 'Metcalfe', ''),
(33, 51, 'Allister', 'Beech', ''),
(34, 52, 'Simon', 'O\'Gorman', '');

-- --------------------------------------------------------

--
-- Table structure for table `SPO_Socials`
--

CREATE TABLE `SPO_Socials` (
  `sps_id` bigint NOT NULL,
  `spo_id` bigint NOT NULL,
  `sps_Facebook` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sps_Instagram` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sps_Website` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `sps_Linkedin` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `SPO_Socials`
--

INSERT INTO `SPO_Socials` (`sps_id`, `spo_id`, `sps_Facebook`, `sps_Instagram`, `sps_Website`, `sps_Linkedin`) VALUES
(20, 20, '', '', 'https://www.kyoceradocumentsolutions.co.uk', 'https://www.linkedin.com/company/kyocera-doc-solutions-uk'),
(21, 21, '', '', 'https://www.telefonikatech.uk', 'https://www.linkedin.com/company/telefonica-tech-en'),
(22, 22, '', '', 'https://mountainhealthcare.co.uk/', 'https://www.linkedin.com/company/mountain-healthcar'),
(23, 23, '', '', 'https://www.alison-law.co.uk/', ''),
(27, 27, '', '', 'https://www.maber.co.uk', ''),
(28, 28, '', '', 'https://sytech-consultants.com/', 'https://www.linkedin.com/company/sytech-consultants/'),
(29, 29, '', '', 'https://www.computacenter.com/en-gb', 'https://www.linkedin.com/company/computacenter/posts/?feedView=all'),
(30, 30, '', '', 'https://www.tailoredimage.com/', ''),
(31, 31, '', '', 'https://www.adecco.co.uk', ''),
(32, 32, '', '', 'https://www.softcat.com/', 'https://www.linkedin.com/company/softcat'),
(33, 33, '', '', 'https://www.point-south.uk', ''),
(34, 34, '', '', 'https://www.uk.cdw.com/', ''),
(35, 35, '', '', 'https://www.scc.com', ''),
(36, 36, '', '', 'https://www.mavenpublicsector.co.uk/public-sector/en/home', 'https://uk.linkedin.com/company/maven-public-sector'),
(37, 37, '', '', 'https://boxxe.com', ''),
(38, 38, 'https://www.facebook.com/MWGroundsMaintenanceltd', 'https://www.instagram.com/mwgroundsmaintenanceltd', 'https://www.markwalkergm.co.uk', ''),
(39, 39, '', '', 'https://monitoring.co.uk', ''),
(40, 40, '', '', 'https://www.phoenixs.co.uk/', ''),
(41, 41, '', 'https://www.instagram.com/sbfmsocial/', 'https://sb-fm.co.uk/', 'https://www.linkedin.com/company/sb-fm/'),
(42, 42, 'https://www.facebook.com/MotorolaSolutions', 'https://www.instagram.com/motorolasolutions', 'https://www.motorolasolutions.com/', 'https://www.linkedin.com/company/motorolasolutions'),
(43, 43, '', '', 'https://www.axon.com/uk', 'https://www.linkedin.com/showcase/axon-uk'),
(44, 44, '', '', 'https://www.intaforensics.com', ''),
(45, 45, '', '', 'https://www.veolia.co.uk/', 'https://www.linkedin.com/company/veolia-environmental-services-uk?originalSubdomain=uk'),
(46, 46, '', '', 'https://www.qccglobal.com', 'https://www.linkedin.com/company/qcc-global/'),
(47, 47, '', '', 'https://www.cclsolutionsgroup.com/', 'https://www.linkedin.com/company/ccl-solutions-group-ltd/posts/?feedView=all'),
(48, 48, '', '', 'https://www.cyfor.co.uk', 'https://www.linkedin.com/company/cyfor-group/'),
(49, 49, '', '', 'https://www.resillion.com/', ''),
(50, 50, '', '', 'https://www.virginmediabusiness.co.uk/', ''),
(51, 51, '', '', 'https://www.recipero.com/', ''),
(52, 52, 'https://www.facebook.com/adaptituk', 'https://www.instagram.com/adaptitonline/', 'https://www.Adapt-IT.co.uk', 'https://www.linkedin.com/company/adapt-it-limited');

-- --------------------------------------------------------

--
-- Table structure for table `Unique_Identifiers`
--

CREATE TABLE `Unique_Identifiers` (
  `ui_id` bigint NOT NULL,
  `user_id` bigint NOT NULL,
  `unique_id` varchar(500) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Unique_Identifiers`
--

INSERT INTO `Unique_Identifiers` (`ui_id`, `user_id`, `unique_id`) VALUES
(21, 170, 'CSE235937230'),
(22, 171, 'CSE320893107'),
(23, 172, 'CSE826369974'),
(24, 173, 'CSE189325387'),
(25, 174, 'BUS857617340'),
(26, 175, 'BUS340293558'),
(27, 176, 'CSE219471783'),
(28, 178, 'CSE730312355'),
(29, 182, 'CSE668044018'),
(30, 181, 'CSE837834052'),
(31, 180, 'CSE206453078'),
(32, 179, 'CSE830663812'),
(34, 183, 'BUS885832101'),
(35, 184, 'BUS116963894'),
(36, 185, 'CSE446810201'),
(40, 188, 'CSE623172354'),
(41, 201, 'CSE844012646'),
(42, 200, 'CSE987639859'),
(45, 203, 'CSE192567514'),
(46, 202, 'CSE875307414'),
(47, 202, 'CSE492467960'),
(48, 191, 'CSE133939280'),
(49, 192, 'CSE555920660'),
(50, 193, 'CSE405375218'),
(51, 199, 'CSE465540397'),
(52, 198, 'CSE769164352'),
(53, 197, 'CSE824422447'),
(54, 196, 'CSE460795780'),
(56, 194, 'CSE631427727'),
(57, 199, 'CSE280214176'),
(58, 198, 'CSE209850196'),
(59, 211, 'CSE672598514'),
(60, 210, 'CSE753519050'),
(61, 209, 'CSE840420247'),
(62, 204, 'CSE127904234'),
(63, 208, 'CSE721176957'),
(64, 205, 'CSE750384684'),
(65, 206, 'CSE779796413'),
(66, 213, 'CSE251049745'),
(67, 214, 'CSE473122480'),
(68, 215, 'CSE156216401'),
(69, 216, 'BUY197563674'),
(71, 218, 'BUY370857103'),
(72, 219, 'BUY538808221'),
(73, 220, 'CSE758769546'),
(74, 221, 'CSE297885061'),
(76, 223, 'CSE679836422'),
(80, 228, 'BUS554417291'),
(81, 230, 'BUS921051823'),
(82, 229, 'BUS673894231'),
(83, 231, 'BUS819127781'),
(84, 233, 'BUS490431322'),
(85, 234, 'BUS677327170'),
(86, 235, 'BUS633996057'),
(87, 236, 'BUS455142701'),
(88, 237, 'CSE278860843'),
(89, 238, 'BUS819620007'),
(90, 239, 'BUY712534357'),
(91, 240, 'CSE741728205'),
(92, 241, 'CSE485703064'),
(93, 242, 'CSE230799556'),
(94, 243, 'BUS662476744'),
(99, 249, 'BUS779944833'),
(100, 251, 'BUS201690846'),
(101, 252, 'BUS414505981'),
(102, 250, 'BUS344722456'),
(103, 244, 'BUS432138117'),
(104, 253, 'BUS345993807'),
(105, 254, 'BUY667376371'),
(106, 255, 'BUS232989909'),
(107, 256, 'CSE618926685'),
(108, 257, 'BUS297754705'),
(109, 260, 'CSE670593888'),
(110, 258, 'BUS804138351'),
(111, 259, 'BUS467391324'),
(112, 261, 'BUS375547499'),
(113, 262, 'BUS940313044'),
(114, 263, 'CSE113774125'),
(115, 264, 'BUS474439423'),
(116, 265, 'BUS247770983'),
(117, 266, 'CSE586612117'),
(118, 267, 'BUS404872103'),
(119, 268, 'BUS866831944'),
(120, 269, 'CSE801604996'),
(121, 270, 'BUY793281958'),
(122, 271, 'BUY395167769'),
(123, 274, 'BUY321401862'),
(124, 272, 'BUY794648682'),
(125, 273, 'BUY242221390'),
(126, 275, 'BUY962682530'),
(127, 276, 'BUY367070830');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE `Users` (
  `user_id` bigint NOT NULL,
  `user_type` enum('admin','charity','sponsor','enabler') COLLATE utf8mb4_general_ci NOT NULL,
  `u_status` enum('approved','submitted') COLLATE utf8mb4_general_ci NOT NULL,
  `date_submitted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `user_type`, `u_status`, `date_submitted`) VALUES
(170, 'charity', 'approved', '2025-03-14 12:31:07'),
(171, 'charity', 'approved', '2025-03-14 16:04:51'),
(172, 'charity', 'approved', '2025-03-17 10:15:36'),
(173, 'charity', 'approved', '2025-03-17 16:17:39'),
(174, 'sponsor', 'approved', '2025-03-18 12:24:29'),
(175, 'sponsor', 'approved', '2025-03-18 12:31:37'),
(176, 'charity', 'approved', '2025-03-18 13:23:48'),
(178, 'charity', 'approved', '2025-03-18 13:30:37'),
(179, 'charity', 'approved', '2025-03-18 13:46:34'),
(180, 'charity', 'approved', '2025-03-18 14:47:23'),
(181, 'charity', 'approved', '2025-03-18 14:56:01'),
(182, 'charity', 'approved', '2025-03-18 15:02:01'),
(183, 'sponsor', 'approved', '2025-03-18 15:43:35'),
(184, 'sponsor', 'approved', '2025-03-18 16:02:16'),
(185, 'charity', 'approved', '2025-03-18 16:19:29'),
(188, 'charity', 'approved', '2025-03-18 21:33:49'),
(191, 'charity', 'approved', '2025-03-20 11:10:03'),
(192, 'charity', 'approved', '2025-03-20 11:16:15'),
(193, 'charity', 'approved', '2025-03-20 11:53:53'),
(194, 'charity', 'approved', '2025-03-20 12:00:41'),
(196, 'charity', 'approved', '2025-03-20 13:50:38'),
(197, 'charity', 'approved', '2025-03-20 13:54:47'),
(198, 'charity', 'approved', '2025-03-20 14:00:16'),
(199, 'charity', 'approved', '2025-03-20 14:14:09'),
(200, 'charity', 'approved', '2025-03-20 14:22:46'),
(201, 'charity', 'approved', '2025-03-20 14:29:15'),
(202, 'charity', 'approved', '2025-03-20 15:33:38'),
(203, 'charity', 'approved', '2025-03-20 15:40:44'),
(204, 'charity', 'approved', '2025-03-20 16:09:14'),
(205, 'charity', 'approved', '2025-03-20 16:15:07'),
(206, 'charity', 'approved', '2025-03-20 16:19:07'),
(208, 'charity', 'approved', '2025-03-20 16:30:17'),
(209, 'charity', 'approved', '2025-03-20 16:48:02'),
(210, 'charity', 'approved', '2025-03-20 16:54:11'),
(211, 'charity', 'approved', '2025-03-20 16:59:18'),
(213, 'charity', 'approved', '2025-03-25 14:46:47'),
(214, 'charity', 'approved', '2025-03-27 10:34:38'),
(215, 'charity', 'approved', '2025-03-27 12:33:08'),
(216, 'enabler', 'approved', '2025-04-01 13:36:21'),
(218, 'enabler', 'approved', '2025-04-01 13:46:20'),
(219, 'enabler', 'approved', '2025-04-01 13:48:51'),
(220, 'charity', 'approved', '2025-04-02 14:29:47'),
(221, 'charity', 'approved', '2025-04-09 11:26:52'),
(223, 'charity', 'approved', '2025-04-14 10:04:54'),
(228, 'sponsor', 'approved', '2025-05-01 09:10:47'),
(229, 'sponsor', 'approved', '2025-05-01 16:03:17'),
(230, 'sponsor', 'approved', '2025-05-02 08:23:53'),
(231, 'sponsor', 'approved', '2025-05-07 09:11:38'),
(233, 'sponsor', 'approved', '2025-05-15 15:49:52'),
(234, 'sponsor', 'approved', '2025-05-16 09:10:21'),
(235, 'sponsor', 'approved', '2025-05-27 12:00:57'),
(236, 'sponsor', 'approved', '2025-05-30 16:08:46'),
(237, 'charity', 'approved', '2025-06-02 10:47:54'),
(238, 'sponsor', 'approved', '2025-06-02 15:46:11'),
(239, 'enabler', 'approved', '2025-06-03 23:17:23'),
(240, 'charity', 'approved', '2025-06-04 13:13:22'),
(241, 'charity', 'approved', '2025-06-04 13:47:27'),
(242, 'charity', 'approved', '2025-06-04 15:09:05'),
(243, 'sponsor', 'approved', '2025-06-10 15:41:12'),
(244, 'sponsor', 'approved', '2025-06-11 12:02:19'),
(249, 'sponsor', 'approved', '2025-06-16 11:26:31'),
(250, 'sponsor', 'approved', '2025-06-18 08:32:07'),
(251, 'sponsor', 'approved', '2025-06-19 09:51:14'),
(252, 'sponsor', 'approved', '2025-06-20 10:24:49'),
(253, 'sponsor', 'approved', '2025-06-25 09:49:24'),
(254, 'enabler', 'approved', '2025-07-01 10:59:58'),
(255, 'sponsor', 'approved', '2025-07-11 09:47:55'),
(256, 'charity', 'approved', '2025-07-13 14:07:47'),
(257, 'sponsor', 'approved', '2025-07-14 11:21:24'),
(258, 'sponsor', 'approved', '2025-07-15 12:31:40'),
(259, 'sponsor', 'approved', '2025-07-15 13:51:34'),
(260, 'charity', 'approved', '2025-07-15 14:27:12'),
(261, 'sponsor', 'approved', '2025-07-16 13:43:28'),
(262, 'sponsor', 'approved', '2025-07-17 13:42:22'),
(263, 'charity', 'approved', '2025-07-21 18:06:41'),
(264, 'sponsor', 'approved', '2025-07-22 10:27:06'),
(265, 'sponsor', 'approved', '2025-07-24 16:19:17'),
(266, 'charity', 'approved', '2025-07-28 08:22:56'),
(267, 'sponsor', 'approved', '2025-07-28 13:50:28'),
(268, 'sponsor', 'approved', '2025-07-29 08:18:50'),
(269, 'charity', 'approved', '2025-07-29 12:11:38'),
(270, 'enabler', 'approved', '2025-07-30 18:42:42'),
(271, 'enabler', 'approved', '2025-07-30 18:45:49'),
(272, 'enabler', 'approved', '2025-07-30 18:49:00'),
(273, 'enabler', 'approved', '2025-07-30 18:51:31'),
(274, 'enabler', 'approved', '2025-07-30 18:53:34'),
(275, 'enabler', 'approved', '2025-07-30 18:55:38'),
(276, 'enabler', 'approved', '2025-07-30 18:57:35');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Admin`
--
ALTER TABLE `Admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_fk` (`user_id`);

--
-- Indexes for table `Charities`
--
ALTER TABLE `Charities`
  ADD PRIMARY KEY (`cse_id`),
  ADD KEY `charities_fk` (`user_id`);

--
-- Indexes for table `CSE_MainContactdetails`
--
ALTER TABLE `CSE_MainContactdetails`
  ADD PRIMARY KEY (`cmcd_id`),
  ADD KEY `cse_maincontactdetails_fk` (`cse_id`);

--
-- Indexes for table `CSE_ProjectDetail`
--
ALTER TABLE `CSE_ProjectDetail`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `cse_projectdetail_fk` (`cse_id`);

--
-- Indexes for table `CSE_Socials`
--
ALTER TABLE `CSE_Socials`
  ADD PRIMARY KEY (`cs_id`),
  ADD KEY `cse_socials_fk` (`cse_id`);

--
-- Indexes for table `Enablers`
--
ALTER TABLE `Enablers`
  ADD PRIMARY KEY (`ena_id`),
  ADD KEY `enablers_fk` (`user_id`);

--
-- Indexes for table `ENA_HMAR`
--
ALTER TABLE `ENA_HMAR`
  ADD PRIMARY KEY (`emr_id`),
  ADD KEY `ena_hmar_fk` (`ena_id`);

--
-- Indexes for table `ENA_HPRM`
--
ALTER TABLE `ENA_HPRM`
  ADD PRIMARY KEY (`epr_id`),
  ADD KEY `ena_hprm_fk` (`ena_id`);

--
-- Indexes for table `ENA_HPRO`
--
ALTER TABLE `ENA_HPRO`
  ADD PRIMARY KEY (`epro_id`),
  ADD KEY `ena_hpro_fk` (`ena_id`);

--
-- Indexes for table `ENA_MainContactdetails`
--
ALTER TABLE `ENA_MainContactdetails`
  ADD PRIMARY KEY (`emcd_id`),
  ADD KEY `ena_maincontactdetails_fk` (`ena_id`);

--
-- Indexes for table `ENA_Socials`
--
ALTER TABLE `ENA_Socials`
  ADD PRIMARY KEY (`es_id`),
  ADD KEY `ena_socials_fk` (`ena_id`);

--
-- Indexes for table `FAQs`
--
ALTER TABLE `FAQs`
  ADD PRIMARY KEY (`faq_id`);

--
-- Indexes for table `Sponsors`
--
ALTER TABLE `Sponsors`
  ADD PRIMARY KEY (`spo_id`),
  ADD KEY `sponsor_fk` (`user_id`);

--
-- Indexes for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `spo_ref` (`spo_ref`),
  ADD KEY `charity_id` (`charity_id`);

--
-- Indexes for table `SPO_Accounts`
--
ALTER TABLE `SPO_Accounts`
  ADD PRIMARY KEY (`sa_id`),
  ADD KEY `spo_accounts_fk` (`spo_id`);

--
-- Indexes for table `SPO_MainContactdetails`
--
ALTER TABLE `SPO_MainContactdetails`
  ADD PRIMARY KEY (`smcd_id`),
  ADD KEY `spo_maincontactdetails_fk` (`spo_id`);

--
-- Indexes for table `SPO_Marketing`
--
ALTER TABLE `SPO_Marketing`
  ADD PRIMARY KEY (`sm_id`),
  ADD KEY `spo_marketing_fk` (`spo_id`);

--
-- Indexes for table `SPO_Socials`
--
ALTER TABLE `SPO_Socials`
  ADD PRIMARY KEY (`sps_id`),
  ADD KEY `spo_socials_fk` (`spo_id`);

--
-- Indexes for table `Unique_Identifiers`
--
ALTER TABLE `Unique_Identifiers`
  ADD PRIMARY KEY (`ui_id`),
  ADD KEY `unique_identifiers_fk` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Admin`
--
ALTER TABLE `Admin`
  MODIFY `admin_id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Charities`
--
ALTER TABLE `Charities`
  MODIFY `cse_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `CSE_MainContactdetails`
--
ALTER TABLE `CSE_MainContactdetails`
  MODIFY `cmcd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `CSE_ProjectDetail`
--
ALTER TABLE `CSE_ProjectDetail`
  MODIFY `pro_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `CSE_Socials`
--
ALTER TABLE `CSE_Socials`
  MODIFY `cs_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `Enablers`
--
ALTER TABLE `Enablers`
  MODIFY `ena_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `ENA_HMAR`
--
ALTER TABLE `ENA_HMAR`
  MODIFY `emr_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ENA_HPRM`
--
ALTER TABLE `ENA_HPRM`
  MODIFY `epr_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `ENA_HPRO`
--
ALTER TABLE `ENA_HPRO`
  MODIFY `epro_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ENA_MainContactdetails`
--
ALTER TABLE `ENA_MainContactdetails`
  MODIFY `emcd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `ENA_Socials`
--
ALTER TABLE `ENA_Socials`
  MODIFY `es_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `FAQs`
--
ALTER TABLE `FAQs`
  MODIFY `faq_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `Sponsors`
--
ALTER TABLE `Sponsors`
  MODIFY `spo_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `sponsorships`
--
ALTER TABLE `sponsorships`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `SPO_Accounts`
--
ALTER TABLE `SPO_Accounts`
  MODIFY `sa_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `SPO_MainContactdetails`
--
ALTER TABLE `SPO_MainContactdetails`
  MODIFY `smcd_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `SPO_Marketing`
--
ALTER TABLE `SPO_Marketing`
  MODIFY `sm_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `SPO_Socials`
--
ALTER TABLE `SPO_Socials`
  MODIFY `sps_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `Unique_Identifiers`
--
ALTER TABLE `Unique_Identifiers`
  MODIFY `ui_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `Users`
--
ALTER TABLE `Users`
  MODIFY `user_id` bigint NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=277;

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
-- Constraints for table `sponsorships`
--
ALTER TABLE `sponsorships`
  ADD CONSTRAINT `sponsorships_ibfk_1` FOREIGN KEY (`charity_id`) REFERENCES `Charities` (`cse_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
-- Constraints for table `SPO_Marketing`
--
ALTER TABLE `SPO_Marketing`
  ADD CONSTRAINT `spo_marketing_fk` FOREIGN KEY (`spo_id`) REFERENCES `Sponsors` (`spo_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
