-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 07, 2012 at 03:49 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `heartweb`
--

-- --------------------------------------------------------

--
-- Table structure for table `affiliations`
--

CREATE TABLE IF NOT EXISTS `affiliations` (
  `affiliation_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Affiliation id',
  `affiliation_name` varchar(25) NOT NULL COMMENT 'Affiliation name',
  PRIMARY KEY (`affiliation_id`),
  KEY `location_id` (`affiliation_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `affiliations`
--

INSERT INTO `affiliations` (`affiliation_id`, `affiliation_name`) VALUES
(1, 'affiliaion1'),
(2, 'affiliation2');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE IF NOT EXISTS `content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `content` text NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `name`, `content`, `added_date`) VALUES
(1, 'privacy', 'lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet ', '0000-00-00 00:00:00'),
(2, 'terms', 'lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet ', '0000-00-00 00:00:00'),
(3, 'disclaimer', 'lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet lorem ipsum dolar sit amet ', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `countries_list`
--

CREATE TABLE IF NOT EXISTS `countries_list` (
  `country_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Country id',
  `country_name` varchar(25) NOT NULL COMMENT 'Country name',
  `country_iso` char(3) NOT NULL,
  PRIMARY KEY (`country_id`),
  KEY `country_id` (`country_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `countries_list`
--

INSERT INTO `countries_list` (`country_id`, `country_name`, `country_iso`) VALUES
(1, 'India', 'ind'),
(3, 'Ameriaca', 'usa');

-- --------------------------------------------------------

--
-- Table structure for table `event_log`
--

CREATE TABLE IF NOT EXISTS `event_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userid` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `event_master`
--

CREATE TABLE IF NOT EXISTS `event_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_name` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(100) NOT NULL,
  `specialzation_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`id`, `faculty_name`, `specialzation_id`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`) VALUES
(1, 'XRay', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '1'),
(2, 'MRI', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `faqs`
--

CREATE TABLE IF NOT EXISTS `faqs` (
  `question` varchar(500) NOT NULL,
  `answer` text NOT NULL,
  `added_by` int(11) NOT NULL,
  `added_date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faqs`
--

INSERT INTO `faqs` (`question`, `answer`, `added_by`, `added_date`) VALUES
('this is question two', 'this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two this is answer two ', 0, '0000-00-00 00:00:00'),
('this is question one', 'this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one this is answer one ', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE IF NOT EXISTS `forms` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ur` varchar(255) NOT NULL,
  `patient_dob` varchar(25) NOT NULL COMMENT 'Patient DOB',
  `patient_age` int(3) NOT NULL COMMENT 'Patient Age',
  `patient_sex` varchar(6) NOT NULL COMMENT 'Patient Sex',
  `patient_surname` varchar(15) NOT NULL,
  `patient_firstname` varchar(25) NOT NULL,
  `patient_address` varchar(225) NOT NULL,
  `patient_suburb` varchar(50) NOT NULL,
  `patient_state` varchar(25) NOT NULL,
  `patient_postcode` int(10) NOT NULL,
  `patient_email` varchar(25) NOT NULL,
  `patient_tel` varchar(15) NOT NULL,
  `patient_mob` varchar(15) NOT NULL,
  `study_examid` varchar(10) NOT NULL,
  `study_date` datetime NOT NULL,
  `study_institution` varchar(150) NOT NULL,
  `study_operator` varchar(50) NOT NULL,
  `study_indication` varchar(5) NOT NULL,
  `study_tte_toe` tinyint(4) NOT NULL COMMENT '1 - TTE, 2- TOE',
  `study_quality_td` tinyint(4) NOT NULL COMMENT '1 - Good Quality, 2 - Technically Difficult',
  `study_height` decimal(5,2) NOT NULL,
  `study_weight` decimal(5,0) NOT NULL,
  `study_bsa` varchar(225) NOT NULL,
  `study_bmi` varchar(225) NOT NULL,
  `study_bp` varchar(225) NOT NULL,
  `study_hr` varchar(225) NOT NULL,
  `vv_leftventricule` tinyint(4) NOT NULL COMMENT '1 - Empty , 2 - Normal , 3 - Dilated',
  `vv_rightventricule` tinyint(4) NOT NULL COMMENT '1 - Normal, 2 - Increased',
  `sf_leftventricule` tinyint(4) NOT NULL COMMENT '1 - Empty , 2 - Normal , 3 - Dilated',
  `sf_rightventricule` tinyint(4) NOT NULL COMMENT '1 - Normal, 2 - Increased',
  `ef_lvedd` varchar(255) NOT NULL,
  `ef_lveda` varchar(255) NOT NULL,
  `ef_lvesd` varchar(255) NOT NULL,
  `ef_lvesa` varchar(255) NOT NULL,
  `ef_fs` varchar(255) NOT NULL,
  `ef_fac` varchar(255) NOT NULL,
  `co_lvotd` varchar(255) NOT NULL,
  `co_lvotvti` varchar(255) NOT NULL,
  `co_hr` varchar(255) NOT NULL,
  `co_co` varchar(255) NOT NULL,
  `co_ci` varchar(255) NOT NULL,
  `lafp` tinyint(4) NOT NULL COMMENT '1 - Low LA Pressure, 2 - Normal LA Pressure, 3 - High LA Pressure',
  `haemodynamic_state` varchar(255) NOT NULL COMMENT '1 - Normal , 2 - Empty, 3 - Vasodilated, 4 - Primary Systolic Failure,  5 - Primary Diastolic Failure, 6 - Systolic & Diastolic Failure, 7 - RV Failure',
  `pap_lvotd` varchar(255) NOT NULL,
  `pap_lvotvti` varchar(255) NOT NULL,
  `pap_avvti` varchar(255) NOT NULL,
  `pap_ava` varchar(255) NOT NULL,
  `pap_avpg` varchar(255) NOT NULL,
  `pap_avgm` varchar(255) NOT NULL,
  `pap_dimindex` varchar(255) NOT NULL,
  `pap_aljet` varchar(255) NOT NULL,
  `pap_alpl` varchar(255) NOT NULL,
  `pap_aoroot` varchar(255) NOT NULL,
  `pap_aseao` varchar(255) NOT NULL,
  `pap_mvradius` varchar(255) NOT NULL,
  `pap_mvscale` varchar(255) NOT NULL,
  `pap_ero` varchar(255) NOT NULL,
  `pap_mvpl2t` varchar(255) NOT NULL,
  `pap_mvgp` varchar(255) NOT NULL,
  `pap_mvgm` varchar(255) NOT NULL,
  `pap_pa` varchar(255) NOT NULL,
  `pap_cwmr` varchar(255) NOT NULL,
  `pap_mva` varchar(255) NOT NULL,
  `df_e` varchar(255) NOT NULL,
  `df_a` varchar(255) NOT NULL,
  `df_dt` varchar(255) NOT NULL,
  `df_s` varchar(255) NOT NULL,
  `df_padur` varchar(255) NOT NULL,
  `df_ad_e` varchar(255) NOT NULL,
  `df_ee` varchar(255) NOT NULL,
  `df_ivrt` varchar(255) NOT NULL,
  `df_adur` varchar(255) NOT NULL,
  `df_sd` varchar(255) NOT NULL,
  `df_ea` varchar(255) NOT NULL,
  `lv_lvh` tinyint(4) NOT NULL COMMENT '1 - Mild, 2 - Moderate, 3 - Severe',
  `lv_ivswt` varchar(255) NOT NULL,
  `lv_pwt` varchar(255) NOT NULL,
  `lv_lvmass` varchar(255) NOT NULL,
  `lv_lvimass` varchar(255) NOT NULL,
  `va_examined` varchar(255) NOT NULL,
  `va_stenosys` varchar(255) NOT NULL,
  `va_regurgitation` varchar(255) NOT NULL,
  `va_pericardial_effusion` varchar(255) NOT NULL,
  `atria_la_diam` varchar(255) NOT NULL,
  `atria_ra_diam` varchar(255) NOT NULL,
  `atria_la_area` varchar(255) NOT NULL,
  `atria_ra_area` varchar(255) NOT NULL,
  `atria_trv_max` varchar(255) NOT NULL,
  `atria_tvgr` varchar(255) NOT NULL,
  `atria_rap` varchar(255) NOT NULL,
  `atria_rsvp` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `added_date` datetime NOT NULL COMMENT 'The Date and Time the form was saved as complete',
  `form_complete` tinyint(4) NOT NULL COMMENT 'Whether the form is set as complete.',
  `created_by` int(11) NOT NULL,
  `form_media` int(1) NOT NULL COMMENT 'Defines whether there is any media attached to form',
  `pdffile` varchar(255) NOT NULL,
  `study_rhythm` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `forms_log`
--

CREATE TABLE IF NOT EXISTS `forms_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `formid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `date_accessed` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_groupshares`
--

CREATE TABLE IF NOT EXISTS `form_groupshares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_media_details`
--

CREATE TABLE IF NOT EXISTS `form_media_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(5) NOT NULL COMMENT 'created by',
  `media_type` enum('IMAGE','VIDEO') NOT NULL,
  `path` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_shares`
--

CREATE TABLE IF NOT EXISTS `form_shares` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `form_user_data`
--

CREATE TABLE IF NOT EXISTS `form_user_data` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created_by` int(5) NOT NULL,
  `patient_detail_ur` varchar(255) NOT NULL,
  `patient_detail_dob` varchar(25) NOT NULL COMMENT 'Patient DOB',
  `patient_detail_age` int(3) NOT NULL COMMENT 'Patient Age',
  `patient_detail_sex` varchar(6) NOT NULL DEFAULT '' COMMENT 'Patient Sex',
  `patient_detail_surname` varchar(15) NOT NULL,
  `patient_detail_firstname` varchar(25) NOT NULL,
  `patient_detail_address` varchar(225) NOT NULL,
  `patient_detail_suburb` varchar(50) NOT NULL,
  `patient_detail_state` varchar(25) NOT NULL,
  `patient_detail_postcode` int(10) NOT NULL,
  `patient_detail_email` varchar(25) NOT NULL,
  `patient_detail_tel` int(15) NOT NULL,
  `patient_detail_mob` int(15) NOT NULL,
  `study_detail_examid` varchar(10) NOT NULL,
  `study_detail_date` datetime NOT NULL,
  `study_detail_institution` varchar(150) NOT NULL,
  `study_detail_operator` varchar(50) NOT NULL,
  `study_detail_indication` varchar(5) NOT NULL,
  `study_detail_quality` varchar(15) NOT NULL,
  `study_detail_height` decimal(5,0) NOT NULL,
  `study_detail_weight` decimal(5,0) NOT NULL,
  `study_detail_bsa` varchar(225) NOT NULL,
  `study_detail_bmi` varchar(225) NOT NULL,
  `study_detail_bp` varchar(225) NOT NULL,
  `study_detail_hrrytham` varchar(225) NOT NULL,
  `form_date_time` datetime NOT NULL COMMENT 'The Date and Time the form was saved as complete',
  `form_complete` int(11) NOT NULL COMMENT 'Whether the form is set as complete.',
  `form_url` varchar(50) NOT NULL,
  `form_media` int(1) NOT NULL COMMENT 'Defines whether there is any media attached to form',
  `form_key` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `group_subject` text NOT NULL,
  `group_owner` int(11) NOT NULL,
  `group_owner_faculty` int(11) NOT NULL,
  `group_location` varchar(50) NOT NULL,
  `group_image` int(11) NOT NULL,
  `image_data` text NOT NULL,
  `affiliation` int(11) NOT NULL,
  `messageboard` text NOT NULL,
  `privacy` enum('public','private') NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `group_users`
--

CREATE TABLE IF NOT EXISTS `group_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_requested` datetime NOT NULL,
  `date_responded` datetime NOT NULL,
  `status` enum('PENDING','APPROVED','REJECTED') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `inapp_error_codes`
--

CREATE TABLE IF NOT EXISTS `inapp_error_codes` (
  `id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `error_message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inapp_error_codes`
--

INSERT INTO `inapp_error_codes` (`id`, `status`, `error_message`) VALUES
(1, 21000, 'The App Store could not read the JSON object you provided.'),
(2, 21002, 'The data in the receipt-data property was malformed.'),
(3, 21003, 'The receipt could not be authenticated.'),
(4, 21004, 'The shared secret you provided does not match the shared secret on file for your account.'),
(5, 21005, 'The receipt server is not currently available.'),
(6, 21006, 'This receipt is valid but the subscription has expired. When this status code is returned to your server, the receipt data is also decoded and returned as part of the response.'),
(7, 21007, 'This receipt is a sandbox receipt, but it was sent to the production service for verification.'),
(8, 21008, 'This receipt is a production receipt, but it was sent to the sandbox service for verification.');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(5) NOT NULL AUTO_INCREMENT COMMENT 'Location id',
  `location_name` varchar(25) NOT NULL COMMENT 'Location name',
  PRIMARY KEY (`location_id`),
  KEY `location_id` (`location_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`) VALUES
(1, 'location1'),
(2, 'location2');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_from` int(11) NOT NULL,
  `message_to` varchar(800) NOT NULL,
  `message_cc` varchar(800) NOT NULL,
  `message_subject` varchar(500) NOT NULL,
  `message_body` text NOT NULL,
  `added_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `messages_to`
--

CREATE TABLE IF NOT EXISTS `messages_to` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `to` int(11) NOT NULL,
  `type` enum('USER','GROUP') NOT NULL,
  `message_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `news_heading` varchar(255) NOT NULL,
  `news_content` text NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `news_heading`, `news_content`, `date_added`, `added_by`, `status`) VALUES
(1, 'test', 'test news test news test news test news test news test news test news test news test news test news test news test news test news test news ', '0000-00-00 00:00:00', 0, 1),
(2, 'test2', 'test news test news test news test news test news test news test news test news test news test news test news 22', '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE IF NOT EXISTS `specializations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `specialization_name` varchar(100) NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `specialization_name`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`) VALUES
(1, 'SP1', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1),
(2, 'SP2', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `states_list`
--

CREATE TABLE IF NOT EXISTS `states_list` (
  `state_id` int(5) NOT NULL AUTO_INCREMENT,
  `country_id` int(5) NOT NULL,
  `state_name` varchar(25) NOT NULL,
  PRIMARY KEY (`state_id`),
  KEY `state_id` (`state_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `subscription_types`
--

CREATE TABLE IF NOT EXISTS `subscription_types` (
  `id` int(11) NOT NULL,
  `subscription_type` varchar(50) NOT NULL,
  `subscription_duration` int(11) NOT NULL COMMENT 'in months',
  `subscription_amount` int(11) NOT NULL COMMENT 'amount in $',
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subscription_types`
--

INSERT INTO `subscription_types` (`id`, `subscription_type`, `subscription_duration`, `subscription_amount`, `date_added`, `added_by`, `date_modified`, `modified_by`, `status`) VALUES
(1, '50', 6, 24, '2011-06-02 15:51:45', 0, '0000-00-00 00:00:00', 0, 1),
(2, '100', 12, 48, '2011-06-02 15:52:03', 0, '0000-00-00 00:00:00', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL COMMENT 'username or email',
  `password` varchar(100) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `subject` varchar(250) NOT NULL,
  `affiliation` int(11) NOT NULL,
  `faculty` int(11) NOT NULL,
  `speciality` int(11) NOT NULL,
  `country` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `image` varchar(255) NOT NULL,
  `image_data` text NOT NULL,
  `privacy` enum('private','public') NOT NULL,
  `user_type` enum('TRIAL USER','PAID USER','GATE KEEPER','SUPER USER') NOT NULL DEFAULT 'TRIAL USER',
  `device_os` varchar(50) NOT NULL,
  `app_version_number` varchar(25) NOT NULL,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT '1',
  `date_terms_accepted` datetime NOT NULL,
  `date_registered` datetime NOT NULL,
  `device_type` varchar(100) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `udid` varchar(255) NOT NULL,
  `device_token` varchar(255) NOT NULL,
  `push_notification` int(11) NOT NULL,
  `location` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 - inactive, 1- active, 2 - delete',
  `userkey` varchar(50) DEFAULT NULL,
  `expiry` datetime NOT NULL,
  `receipt` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `userkey` (`userkey`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=162 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `first_name`, `last_name`, `subject`, `affiliation`, `faculty`, `speciality`, `country`, `state`, `image`, `image_data`, `privacy`, `user_type`, `device_os`, `app_version_number`, `terms_accepted`, `date_terms_accepted`, `date_registered`, `device_type`, `ip_address`, `udid`, `device_token`, `push_notification`, `location`, `status`, `userkey`, `expiry`, `receipt`) VALUES
(1, 'admin@heartweb.com', '123456', 'admin', '', '', 0, 1, 2, 'india', 'ap', '', '', 'public', 'SUPER USER', 'MAC', '1.1v', 1, '2011-06-01 14:21:05', '2011-06-01 14:21:12', 'Blackberry', '172.20.0.23', 'udid', 'token', 0, 0, 1, '8811c1f86b703cda4a886080b61295fb', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_subscriptions`
--

CREATE TABLE IF NOT EXISTS `user_subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `subscription_id` int(11) NOT NULL,
  `expiry_date` datetime NOT NULL,
  `date_added` datetime NOT NULL,
  `added_by` int(11) NOT NULL,
  `date_modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
