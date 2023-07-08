-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 20, 2022 at 06:27 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `anyshift`
--

-- --------------------------------------------------------

--
-- Table structure for table `rudra_admin`
--

CREATE TABLE `rudra_admin` (
  `id` int(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `password` varchar(200) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rudra_admin`
--

INSERT INTO `rudra_admin` (`id`, `name`, `username`, `status`, `password`, `added_on`) VALUES
(1, 'Admin', 'adminsuper', 1, '4b4e739494285f1e21c93ad201f6412ddd44644a', '2022-12-16 05:45:51');

-- --------------------------------------------------------

--
-- Table structure for table `rudra_care_giver`
--

CREATE TABLE `rudra_care_giver` (
  `id` bigint(10) NOT NULL,
  `cg_fname` varchar(100) NOT NULL,
  `cg_lname` varchar(100) NOT NULL,
  `cg_mobile` varchar(100) NOT NULL,
  `cg_fcm_token` varchar(200) NOT NULL,
  `cg_device_token` varchar(200) NOT NULL,
  `cg_profile_pic` varchar(200) NOT NULL COMMENT 'file',
  `cg_lat` varchar(100) NOT NULL,
  `cg_long` varchar(100) NOT NULL,
  `cg_address` varchar(200) NOT NULL,
  `cg_zipcode` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `hours_completed` int(10) NOT NULL DEFAULT 0,
  `total_earned` decimal(19,4) NOT NULL DEFAULT 0.0000,
  `average_rating` decimal(2,1) NOT NULL DEFAULT 1.0,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_cg_category`
--

CREATE TABLE `rudra_cg_category` (
  `id` bigint(10) NOT NULL,
  `cg_id` int(10) NOT NULL,
  `cat_id` int(10) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_crud_master_tables`
--

CREATE TABLE `rudra_crud_master_tables` (
  `id` int(100) NOT NULL,
  `tbl_name` varchar(100) DEFAULT NULL,
  `col_strc` text DEFAULT NULL,
  `list_template` text DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `rudra_crud_master_tables`
--

INSERT INTO `rudra_crud_master_tables` (`id`, `tbl_name`, `col_strc`, `list_template`, `status`) VALUES
(1, 'rudra_admin', NULL, NULL, 0),
(2, 'rudra_care_giver', '[{\"col_name\":\"id\",\"list_caption\":\"Id\",\"form_type\":\"hidden\",\"p_key\":\"1\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_fname\",\"list_caption\":\"Fname\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_lname\",\"list_caption\":\"Lname\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_mobile\",\"list_caption\":\"Mobile\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_fcm_token\",\"list_caption\":\"Cg Fcm Token\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_device_token\",\"list_caption\":\"Cg Device Token\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_profile_pic\",\"list_caption\":\"Profile Pic\",\"form_type\":\"file\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_lat\",\"list_caption\":\"Lat\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_long\",\"list_caption\":\"Long\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_address\",\"list_caption\":\"Cg Address\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"cg_zipcode\",\"list_caption\":\"Cg Zipcode\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"0\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"status\",\"list_caption\":\"Status\",\"form_type\":\"ddl\",\"p_key\":\"0\",\"ddl_options\":[\"Active\",\"Inactive\"],\"required\":\"\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"hours_completed\",\"list_caption\":\"Hours Completed\",\"form_type\":\"number\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"total_earned\",\"list_caption\":\"Total Earned\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"average_rating\",\"list_caption\":\"Average Rating\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"}]', NULL, 1),
(3, 'rudra_cg_category', NULL, NULL, 0),
(4, 'rudra_crud_master_tables', NULL, NULL, 0),
(5, 'rudra_facility', NULL, NULL, 0),
(6, 'rudra_facility_category', NULL, NULL, 0),
(7, 'rudra_facility_owner', '[{\"col_name\":\"id\",\"list_caption\":\"Id\",\"form_type\":\"hidden\",\"p_key\":\"1\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"fo_fname\",\"list_caption\":\"Fname\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"fo_lname\",\"list_caption\":\"Lname\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"fo_email\",\"list_caption\":\"Email\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"fo_mobile\",\"list_caption\":\"Mobile\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"fo_password\",\"list_caption\":\"Password\",\"form_type\":\"text\",\"p_key\":\"0\",\"ddl_options\":\"[]\",\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"},{\"col_name\":\"status\",\"list_caption\":\"Status\",\"form_type\":\"ddl\",\"p_key\":\"0\",\"ddl_options\":[\"Active\",\"Inactive\"],\"required\":\"required\",\"list\":\"1\",\"f_key\":\"0\",\"join_type\":\"\",\"small_list\":\"0\",\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\"}]', NULL, 1),
(8, 'rudra_facility_transactions', NULL, NULL, 0),
(9, 'rudra_facility_wallet', '[{\"col_name\":\"id\",\"col_type\":\"int\",\"form_type\":\"hidden\",\"required\":\"required\",\"list\":1,\"list_caption\":\"Id\",\"p_key\":1,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"fo_id\",\"col_type\":\"int\",\"form_type\":\"number\",\"required\":\"\",\"list\":1,\"list_caption\":\"Fo Id\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"fw_total_credit\",\"col_type\":\"int\",\"form_type\":\"number\",\"required\":\"\",\"list\":1,\"list_caption\":\"Fw Total Credit\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"fw_used\",\"col_type\":\"int\",\"form_type\":\"number\",\"required\":\"\",\"list\":1,\"list_caption\":\"Fw Used\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"fw_balance\",\"col_type\":\"int\",\"form_type\":\"number\",\"required\":\"\",\"list\":1,\"list_caption\":\"Fw Balance\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"status\",\"col_type\":\"enum\",\"form_type\":\"ddl\",\"required\":\"\",\"list\":0,\"list_caption\":\"Status\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[\"Active\",\"Inactive\"],\"small_list\":0}]', NULL, 1),
(10, 'rudra_fc_category', NULL, NULL, 0),
(11, 'rudra_jobs', NULL, NULL, 0),
(12, 'rudra_jobs_nurse', NULL, NULL, 0),
(13, 'rudra_job_actions', NULL, NULL, 0),
(14, 'rudra_menu', NULL, NULL, 0),
(15, 'rudra_nurse_category', '[{\"col_name\":\"id\",\"col_type\":\"int\",\"form_type\":\"hidden\",\"required\":\"required\",\"list\":1,\"list_caption\":\"Id\",\"p_key\":1,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"nc_name\",\"col_type\":\"varchar\",\"form_type\":\"text\",\"required\":\"\",\"list\":1,\"list_caption\":\"Nc Name\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[],\"small_list\":0},{\"col_name\":\"status\",\"col_type\":\"enum\",\"form_type\":\"ddl\",\"required\":\"\",\"list\":0,\"list_caption\":\"Status\",\"p_key\":0,\"f_key\":0,\"ref_table\":\"\",\"ref_key\":\"\",\"disp_col\":\"\",\"disp_col_caption\":\"\",\"join_type\":\"inner\",\"ddl_options\":[\"Active\",\"Inactive\"],\"small_list\":0}]', NULL, 1),
(16, 'rudra_nurse_earnings', NULL, NULL, 0),
(17, 'rudra_nurse_hours', NULL, NULL, 0),
(18, 'rudra_shift_manager', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `rudra_facility`
--

CREATE TABLE `rudra_facility` (
  `id` bigint(10) NOT NULL,
  `fo_id` int(10) NOT NULL,
  `fc_name` varchar(100) NOT NULL,
  `fc_lat` varchar(100) NOT NULL DEFAULT '0',
  `fc_long` varchar(100) NOT NULL DEFAULT '0',
  `fc_address` varchar(200) NOT NULL,
  `fc_landmark` varchar(200) NOT NULL,
  `fc_image` varchar(100) NOT NULL COMMENT 'file',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_facility_category`
--

CREATE TABLE `rudra_facility_category` (
  `id` int(10) NOT NULL,
  `fc_name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_facility_owner`
--

CREATE TABLE `rudra_facility_owner` (
  `id` bigint(10) NOT NULL,
  `fo_fname` varchar(100) NOT NULL,
  `fo_lname` varchar(100) NOT NULL,
  `fo_email` varchar(100) NOT NULL,
  `fo_mobile` varchar(100) NOT NULL,
  `fo_password` varchar(200) NOT NULL,
  `fo_last_login` timestamp NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_facility_transactions`
--

CREATE TABLE `rudra_facility_transactions` (
  `id` bigint(10) NOT NULL,
  `fo_id` int(10) NOT NULL,
  `fwt_amount` int(10) NOT NULL DEFAULT 0,
  `fwt_type` enum('admin','job') NOT NULL DEFAULT 'admin',
  `status` enum('Pending','Success') NOT NULL DEFAULT 'Pending',
  `ad_id` int(10) NOT NULL DEFAULT 1,
  `ad_type` enum('admin','job') NOT NULL DEFAULT 'admin',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_facility_wallet`
--

CREATE TABLE `rudra_facility_wallet` (
  `id` bigint(10) NOT NULL,
  `fo_id` int(10) NOT NULL,
  `fw_total_credit` bigint(10) NOT NULL,
  `fw_used` bigint(10) NOT NULL,
  `fw_balance` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_fc_category`
--

CREATE TABLE `rudra_fc_category` (
  `id` bigint(10) NOT NULL,
  `fc_id` int(10) NOT NULL,
  `fcat_id` int(10) NOT NULL,
  `normal_rate` int(10) NOT NULL DEFAULT 0,
  `premium_rate` int(10) NOT NULL DEFAULT 0,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_jobs`
--

CREATE TABLE `rudra_jobs` (
  `id` bigint(10) NOT NULL,
  `fo_id` int(10) NOT NULL,
  `sm_id` int(10) NOT NULL,
  `fc_cat_id` int(10) NOT NULL,
  `cg_cat_id` int(10) NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `job_description` tinytext NOT NULL,
  `shift_type` enum('day','night','any') NOT NULL DEFAULT 'day',
  `job_hours` int(10) NOT NULL DEFAULT 8,
  `is_premium` enum('yes','no') NOT NULL DEFAULT 'no',
  `job_rate` int(10) NOT NULL DEFAULT 0,
  `job_prem_rate` int(10) NOT NULL DEFAULT 0,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `status` enum('Active','Pending','Published','Draft') NOT NULL DEFAULT 'Published',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_jobs_nurse`
--

CREATE TABLE `rudra_jobs_nurse` (
  `id` bigint(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `cg_id` int(10) NOT NULL,
  `hiring_type` enum('premium','normal') NOT NULL DEFAULT 'normal',
  `hiring_rate` int(10) NOT NULL DEFAULT 0,
  `status` enum('Pending','Active','Inactive','Completed','DNR') NOT NULL DEFAULT 'Pending',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_job_actions`
--

CREATE TABLE `rudra_job_actions` (
  `id` bigint(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `cg_id` int(10) NOT NULL DEFAULT 0,
  `sm_id` int(10) NOT NULL DEFAULT 0,
  `act_type` enum('offer','applied') NOT NULL DEFAULT 'offer',
  `status` enum('Pending','Accept','Approved','Decline') NOT NULL DEFAULT 'Pending',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_menu`
--

CREATE TABLE `rudra_menu` (
  `id` int(11) NOT NULL,
  `fc_id` int(11) NOT NULL DEFAULT 0 COMMENT 'form_control_id',
  `mn_name` varchar(255) NOT NULL,
  `mn_controller` varchar(255) DEFAULT NULL,
  `mn_method` varchar(255) DEFAULT NULL,
  `mn_params` varchar(200) DEFAULT NULL,
  `mn_status` enum('Active','Deactive') NOT NULL DEFAULT 'Active',
  `mn_icon` varchar(200) DEFAULT NULL,
  `mn_order` int(11) NOT NULL DEFAULT 0,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rudra_menu`
--

INSERT INTO `rudra_menu` (`id`, `fc_id`, `mn_name`, `mn_controller`, `mn_method`, `mn_params`, `mn_status`, `mn_icon`, `mn_order`, `updated_at`) VALUES
(0, 0, ' nurse category', 'rudra_nurse_category', NULL, NULL, 'Active', NULL, 0, '2022-12-16 10:23:40'),
(0, 0, ' facility wallet', 'rudra_facility_wallet', NULL, NULL, 'Active', NULL, 0, '2022-12-16 11:11:06'),
(0, 0, ' care giver', 'rudra_care_giver', NULL, NULL, 'Active', NULL, 0, '2022-12-20 03:06:18'),
(0, 0, ' facility owner', 'rudra_facility_owner', NULL, NULL, 'Active', NULL, 0, '2022-12-20 04:50:12');

-- --------------------------------------------------------

--
-- Table structure for table `rudra_nurse_category`
--

CREATE TABLE `rudra_nurse_category` (
  `id` int(10) NOT NULL,
  `nc_name` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rudra_nurse_category`
--

INSERT INTO `rudra_nurse_category` (`id`, `nc_name`, `status`, `added_on`, `updated_on`) VALUES
(1, 'RN', 'Active', '2022-12-16 10:27:44', '2022-12-16 10:27:44'),
(2, 'CN', 'Active', '2022-12-16 10:28:47', '2022-12-16 10:28:47'),
(3, 'CRNA', 'Active', '2022-12-16 10:29:07', '2022-12-16 10:29:07');

-- --------------------------------------------------------

--
-- Table structure for table `rudra_nurse_earnings`
--

CREATE TABLE `rudra_nurse_earnings` (
  `id` bigint(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `cg_id` int(10) NOT NULL,
  `work_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_hours` float(4,2) NOT NULL,
  `total_earnings` decimal(19,4) NOT NULL,
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_nurse_hours`
--

CREATE TABLE `rudra_nurse_hours` (
  `id` bigint(10) NOT NULL,
  `job_id` int(10) NOT NULL,
  `cg_id` int(10) NOT NULL,
  `clock_in` timestamp NOT NULL DEFAULT current_timestamp(),
  `clock_out` timestamp NULL DEFAULT NULL,
  `total_seconds` int(10) NOT NULL DEFAULT 0,
  `status` enum('Approved','Decline','Pending') NOT NULL DEFAULT 'Pending',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_shift_manager`
--

CREATE TABLE `rudra_shift_manager` (
  `id` bigint(10) NOT NULL,
  `fo_id` bigint(10) NOT NULL,
  `sm_fname` varchar(200) NOT NULL,
  `sm_lname` varchar(200) NOT NULL,
  `sm_mobile` varchar(200) NOT NULL,
  `sm_email` varchar(200) NOT NULL,
  `sm_fcm_token` varchar(200) NOT NULL,
  `sm_device_token` varchar(200) NOT NULL,
  `sm_password` varchar(100) NOT NULL,
  `sm_last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_on` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `rudra_admin`
--
ALTER TABLE `rudra_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_care_giver`
--
ALTER TABLE `rudra_care_giver`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_cg_category`
--
ALTER TABLE `rudra_cg_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_crud_master_tables`
--
ALTER TABLE `rudra_crud_master_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_facility`
--
ALTER TABLE `rudra_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_facility_category`
--
ALTER TABLE `rudra_facility_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_facility_owner`
--
ALTER TABLE `rudra_facility_owner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_facility_transactions`
--
ALTER TABLE `rudra_facility_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_facility_wallet`
--
ALTER TABLE `rudra_facility_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_fc_category`
--
ALTER TABLE `rudra_fc_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_jobs`
--
ALTER TABLE `rudra_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_jobs_nurse`
--
ALTER TABLE `rudra_jobs_nurse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_job_actions`
--
ALTER TABLE `rudra_job_actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_nurse_category`
--
ALTER TABLE `rudra_nurse_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_nurse_earnings`
--
ALTER TABLE `rudra_nurse_earnings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_nurse_hours`
--
ALTER TABLE `rudra_nurse_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rudra_shift_manager`
--
ALTER TABLE `rudra_shift_manager`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rudra_admin`
--
ALTER TABLE `rudra_admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rudra_care_giver`
--
ALTER TABLE `rudra_care_giver`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_cg_category`
--
ALTER TABLE `rudra_cg_category`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_crud_master_tables`
--
ALTER TABLE `rudra_crud_master_tables`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rudra_facility`
--
ALTER TABLE `rudra_facility`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_facility_category`
--
ALTER TABLE `rudra_facility_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_facility_owner`
--
ALTER TABLE `rudra_facility_owner`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_facility_transactions`
--
ALTER TABLE `rudra_facility_transactions`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_facility_wallet`
--
ALTER TABLE `rudra_facility_wallet`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_fc_category`
--
ALTER TABLE `rudra_fc_category`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_jobs`
--
ALTER TABLE `rudra_jobs`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_jobs_nurse`
--
ALTER TABLE `rudra_jobs_nurse`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_job_actions`
--
ALTER TABLE `rudra_job_actions`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_nurse_category`
--
ALTER TABLE `rudra_nurse_category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rudra_nurse_earnings`
--
ALTER TABLE `rudra_nurse_earnings`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_nurse_hours`
--
ALTER TABLE `rudra_nurse_hours`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rudra_shift_manager`
--
ALTER TABLE `rudra_shift_manager`
  MODIFY `id` bigint(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
