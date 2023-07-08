-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 05:23 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webc_evento`
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
  `added_on` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Dumping data for table `rudra_admin`
--

INSERT INTO `rudra_admin` (`id`, `name`, `username`, `status`, `password`, `added_on`, `updated_on`) VALUES
(1, 'admin', 'admin', 1, '7c4a8d09ca3762af61e59520943dc26494f8941b', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `rudra_app_setting`
--

CREATE TABLE `rudra_app_setting` (
  `id` int(100) NOT NULL,
  `meta_key` varchar(200) DEFAULT NULL,
  `meta_value` text DEFAULT NULL,
  `meta_group` varchar(100) DEFAULT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_on` timestamp NOT NULL DEFAULT current_timestamp
) ;

-- --------------------------------------------------------

--
-- Table structure for table `rudra_menu`
--

CREATE TABLE `rudra_menu` (
  `mn_id` int(11) NOT NULL,
  `fc_id` int(11) NOT NULL DEFAULT 0 COMMENT 'form_control_id',
  `mn_name` varchar(255) NOT NULL,
  `mn_controller` varchar(255) DEFAULT NULL,
  `mn_method` varchar(255) DEFAULT NULL,
  `mn_params` varchar(200) DEFAULT NULL,
  `mn_status` enum('Active','Deactive') NOT NULL DEFAULT 'Active',
  `mn_icon` varchar(200) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp
) ;

--
-- Dumping data for table `rudra_menu`
--

INSERT INTO `rudra_menu` (`mn_id`, `fc_id`, `mn_name`, `mn_controller`, `mn_method`, `mn_params`, `mn_status`, `mn_icon`, `updated_at`, `created_at`) VALUES
(1, 0, 'Users Management', 'mgmt_users', NULL, NULL, 'Active', NULL, '2020-12-15 03:57:45', '2020-12-15 03:57:45'),
(2, 1, 'All Users', 'mgmt_users', 'user_list', '["user_list","list"]', 'Active', NULL, '2020-12-15 06:36:22', '2020-12-15 05:05:37');

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `rudra_admin`
--
ALTER TABLE `rudra_admin`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rudra_app_setting`
--
ALTER TABLE `rudra_app_setting`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rudra_menu`
--
ALTER TABLE `rudra_menu`
  MODIFY `mn_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
