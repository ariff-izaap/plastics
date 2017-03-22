-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2017 at 03:42 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `independent_plastics`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL COMMENT 'name of the address',
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  `company` varchar(150) NOT NULL,
  `address1` varchar(250) NOT NULL,
  `address2` varchar(250) NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `zipcode` varchar(10) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `name`, `first_name`, `last_name`, `company`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Test Vendor', 'Test Vendor', 'Vendor', 'Izaap', '2nd Main Road', 'CS', 'Scottsdale', 'AZ', 'US', '800051', '4454156465', 1, 1, '2017-02-24 12:20:47', '2017-02-24 06:50:47'),
(2, 'Test Vendor 2', 'Test Vendor', 'Vendor', 'Test Vendor 2', '40, Third Floor', 'Abraham Apt', 'Scottsdale', 'AZ', 'US', '82054', '4454156465', 1, 1, '2017-03-06 08:54:30', '2017-03-06 03:24:30'),
(8, 'Warehouses 1', '', '', '', '40, Third Floor', 'Suite Apt', 'Scottsdale', '1', '2', '12452', '12452', 1, 1, '2017-03-22 15:30:55', '2017-03-22 14:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_code` varchar(255) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `username`, `user_code`, `email`, `password`, `role_id`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Admin', 'Adminsitrator', 'admin', 'ADMINADMINSITRATOR', 'email@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '1', 1, 1, '2017-02-11 08:58:35', '2017-02-11 03:28:35'),
(13, 'Ramkumar', 'Izaap', 'ramkumar', 'RAMKUMARIZAAP', 'ramkumar.izaap@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 1, '2017-03-22 08:25:13', '2017-03-22 02:55:13');

-- --------------------------------------------------------

--
-- Table structure for table `callback`
--

CREATE TABLE `callback` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `next_callback_date` datetime NOT NULL,
  `user_to_notify` text NOT NULL COMMENT 'multiple users(salesman)',
  `cb_message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE `call_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'person logged in when making the call',
  `call_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL COMMENT 'business relationship',
  `log_date` datetime NOT NULL,
  `call_log` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `call_type`
--

CREATE TABLE `call_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_type`
--

INSERT INTO `call_type` (`id`, `name`, `status`) VALUES
(1, 'Product Search', '1'),
(2, 'Complaint', '1');

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `location`, `status`) VALUES
(1, 'USPS', 'Chennai', '1'),
(2, 'UPS', 'Delhi', '1'),
(3, 'Fedex', 'Mumbai', '1'),
(4, 'Frontier', 'Bangalore', '1'),
(5, 'Freight', 'Hyderabad', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `category_thumb` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `description`, `category_thumb`, `created_date`, `updated_date`, `enabled`) VALUES
(1, NULL, 'Test', 'Test', '', '2017-02-24 06:46:36', '2017-02-24 06:46:36', 1),
(2, NULL, 'Demo', 'Demo', '', '2017-03-06 09:04:16', '2017-03-06 09:04:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE `contact_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact_type`
--

INSERT INTO `contact_type` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Mobile', '1', 1, 1, '2017-03-22 12:56:30', '2017-03-22 07:26:30'),
(2, 'Fax', '1', 1, 1, '2017-03-22 12:56:39', '2017-03-22 07:26:39');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `status`) VALUES
(1, 'India', 'IN', '1'),
(2, 'United States of America', 'USA', '1'),
(3, 'Canada', 'CA', '1'),
(4, 'Australia', 'AUS', '1'),
(5, 'United Kingdom', 'UK', '1');

-- --------------------------------------------------------

--
-- Table structure for table `credit_type`
--

CREATE TABLE `credit_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `days` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_type`
--

INSERT INTO `credit_type` (`id`, `name`, `days`, `status`, `created_date`) VALUES
(1, 'NET10', '10 days', 0, '2016-12-17 00:00:00'),
(2, 'NET15', '15 days', 1, '2016-12-17 00:00:00'),
(5, 'NET30', '30 Days', 1, '0000-00-00 00:00:00'),
(6, 'NET60', '60 days', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `business_name` varchar(150) NOT NULL,
  `credit_type` int(11) NOT NULL,
  `web_url` varchar(250) NOT NULL,
  `ups` varchar(250) NOT NULL,
  `address_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='vendors';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `business_name`, `credit_type`, `web_url`, `ups`, `address_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Test 1', 0, 'http://www.google.com', '1', 1, '1', '2017-02-24 06:41:12', '2017-02-24 01:11:12'),
(2, 'Test Vendor 2', 0, 'http://www.google.com', '2', 2, '1', '2017-03-06 08:59:15', '2017-03-06 03:29:15');

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE `customer_contact` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `contact_type` int(11) NOT NULL,
  `contact_value` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer_contact`
--

INSERT INTO `customer_contact` (`id`, `customer_id`, `name`, `contact_type`, `contact_value`, `email`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 'Test', 1, '9875655', 'test@gmail.comn', 1, 1, '2017-02-24 12:09:25', '2017-02-24 06:39:25'),
(2, 2, 'Test Vendor 2', 1, '151561', 'test@gmail.comn', 1, 1, '2017-03-06 18:01:02', '2017-03-06 12:31:02'),
(4, 5, 'Warehouses', 2, '23423', 'test@gmail.com', 0, 0, '0000-00-00 00:00:00', '2017-03-22 14:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `customer_location`
--

CREATE TABLE `customer_location` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `definition` varchar(250) NOT NULL,
  `timezone_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer_location`
--

INSERT INTO `customer_location` (`id`, `customer_id`, `name`, `address_1`, `address_2`, `city`, `state`, `country`, `zipcode`, `definition`, `timezone_id`, `start_time`, `end_time`, `day_of_week`, `created_date`, `updated_date`) VALUES
(1, 5, 'Houston Location', '1601 Purdue Drive', '', 'Fayetteville', 1, 2, '28304-3674', '1,2', 3, '01:00:00', '01:00:00', 2, '0000-00-00 00:00:00', '2017-03-22 14:30:55');

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `id` int(11) NOT NULL,
  `type` enum('EMAIL','GLOBAL_MESSAGE','CUSTOMER','SALES','PURCHASE','ACCOUNTS') NOT NULL,
  `name` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `ship_date` datetime NOT NULL,
  `invoice_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `credit_type` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `prepaid_cod` double NOT NULL,
  `fright_amt` double NOT NULL,
  `additional_amt` double NOT NULL,
  `total_amt` double NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `action` text NOT NULL COMMENT 'Log message',
  `line` varchar(150) NOT NULL COMMENT 'Action type',
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action_id`, `action`, `line`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 31, 'Product Packaging <strong>Test</strong> has been created', 'Dropdown Creation', 1, 0, '2017-02-20 11:17:03', '2017-02-20 15:47:03'),
(2, 31, 'Product Packaging has been updated to <strong>Test</strong>', 'Dropdown Updation', 1, 0, '2017-02-20 11:18:10', '2017-02-20 15:48:10'),
(3, 31, 'Product Packaging has been updated to <strong>Test2</strong>', 'Dropdown Updation', 1, 0, '2017-02-20 11:18:27', '2017-02-20 15:48:27'),
(11, 12, '<strong>Ramkumar(ramkumar.izaap@gmail.com)</strong> User has been created', 'User Creation', 1, 0, '2017-02-20 11:38:24', '2017-02-20 16:08:24'),
(12, 12, '<strong>Ramkumar( ramkumar.izaap@gmail.com )</strong> User has been updated', 'User Updation', 1, 0, '2017-02-20 11:38:35', '2017-02-20 16:08:35'),
(13, 12, '<strong>Ramkumar(ramkumar.izaap@gmail.com)</strong> User has been deleted', 'User Deletion', 1, 0, '2017-02-20 11:38:42', '2017-02-20 16:08:42'),
(15, 1, '<strong>Test</strong> Category has been created', 'Category Creation', 1, 0, '2017-02-20 12:38:59', '2017-02-20 17:08:59'),
(16, 1, 'Category has been updated to <strong>Test2</strong>', 'Category Updation', 1, 0, '2017-02-20 12:40:33', '2017-02-20 17:10:33'),
(17, 1, '<strong>Test2</strong> Category has been deleted', 'Category Deletion', 1, 0, '2017-02-20 12:41:18', '2017-02-20 17:11:18'),
(18, 13, '<strong>Ramkumar(ramkumar.izaap@gmail.com)</strong> User has been created', 'User Creation', 1, 0, '2017-02-20 13:34:06', '2017-02-20 18:04:06'),
(19, 6, '<strong>Customer</strong> role has been updated.', 'Role Updation', 1, 0, '2017-02-21 08:13:30', '2017-02-21 12:43:30'),
(20, 6, '<strong>Customers</strong> role has been updated.', 'Role Updation', 1, 0, '2017-02-21 08:13:38', '2017-02-21 12:43:38'),
(21, 7, '<strong>Test</strong> role has been created', 'Role Creation', 1, 0, '2017-02-21 08:14:27', '2017-02-21 12:44:27'),
(22, 8, '<strong>Test</strong> role has been created', 'Role Creation', 1, 0, '2017-02-21 08:14:54', '2017-02-21 12:44:54'),
(23, 8, '<strong>Tests</strong> role has been updated.', 'Role Updation', 1, 0, '2017-02-21 08:14:59', '2017-02-21 12:44:59'),
(24, 8, '<strong></strong> role has been deleted', 'Role Deletion', 1, 0, '2017-02-21 08:16:45', '2017-02-21 12:46:45'),
(25, 9, '<strong>Test</strong> role has been created', 'Role Creation', 1, 0, '2017-02-21 08:17:16', '2017-02-21 12:47:16'),
(26, 9, '<strong></strong> role has been deleted', 'Role Deletion', 1, 0, '2017-02-21 08:17:18', '2017-02-21 12:47:18'),
(27, 10, '<strong>Tesd</strong> role has been created', 'Role Creation', 1, 0, '2017-02-21 08:18:29', '2017-02-21 12:48:29'),
(28, 10, '<strong>Tesd</strong> role has been deleted', 'Role Deletion', 1, 0, '2017-02-21 08:18:41', '2017-02-21 12:48:41'),
(29, 6, '<strong>Customer</strong> role has been updated.', 'Role Updation', 1, 0, '2017-02-21 11:31:58', '2017-02-21 16:01:58'),
(30, 6, '<strong>Customers</strong> role has been updated.', 'Role Updation', 1, 0, '2017-02-21 11:32:02', '2017-02-21 16:02:02'),
(34, 11, '<strong>Customers</strong> role has been inserted', 'Role Insertion', 1, 0, '2017-02-21 14:35:59', '2017-02-21 19:05:59'),
(35, 11, '<strong>Customer</strong> role has been updated', 'Role Updation', 1, 0, '2017-02-21 14:37:02', '2017-02-21 19:07:02'),
(36, 3, '<strong>Tst</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-02-24 16:01:46', '2017-02-24 20:31:46'),
(37, 4, '<strong>Test</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-02-24 16:04:55', '2017-02-24 20:34:55'),
(38, 1, '<strong>#1</strong> purchase has been deleted', 'Purchase Deletion', 1, 0, '2017-03-01 13:00:23', '2017-03-01 17:30:23'),
(39, 4, '<strong>#4</strong> purchase order has been created', 'Purchase Insertion', 1, 0, '2017-03-07 08:26:51', '2017-03-07 12:56:51'),
(40, 1, '<strong>#1</strong> purchase order has been created', 'Purchase Insertion', 1, 0, '2017-03-07 08:32:46', '2017-03-07 13:02:46'),
(41, 1, '<strong>#1</strong> purchase order has been deleted', 'Purchase Deletion', 1, 0, '2017-03-07 11:23:36', '2017-03-07 15:53:36'),
(42, 1, '<strong>#1</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-07 11:24:30', '2017-03-07 15:54:30'),
(43, 1, '<strong>12</strong> dropdown has been updated', 'Dropdown Updation', 1, 0, '2017-03-08 08:55:42', '2017-03-08 13:25:42'),
(44, 1, '<strong>12</strong> dropdown has been updated', 'Dropdown Updation', 1, 0, '2017-03-08 08:56:03', '2017-03-08 13:26:03'),
(45, 1, '<strong>12</strong> dropdown has been updated', 'Dropdown Updation', 1, 0, '2017-03-08 08:56:12', '2017-03-08 13:26:12'),
(46, 2, '<strong>Pulse</strong> dropdown has been updated', 'Dropdown Updation', 1, 0, '2017-03-08 08:56:19', '2017-03-08 13:26:19'),
(47, 1, '<strong>#1</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-08 11:48:23', '2017-03-08 16:18:23'),
(48, 2, '<strong>#2</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-09 11:10:55', '2017-03-09 15:40:55'),
(49, 4, '<strong>#4</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-09 11:14:29', '2017-03-09 15:44:29'),
(50, 5, '<strong>Test Form</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-13 13:17:20', '2017-03-13 17:47:20'),
(51, 6, '<strong>Test</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-13 13:18:01', '2017-03-13 17:48:01'),
(52, 2, '<strong></strong> warning has been deleted', 'Warning Deletion', 1, 0, '2017-03-13 13:52:34', '2017-03-13 18:22:34'),
(53, 4, '<strong></strong> warning has been inserted', 'Warning Insertion', 1, 0, '2017-03-13 14:24:08', '2017-03-13 18:54:08'),
(54, 5, '<strong></strong> warning has been inserted', 'Warning Insertion', 1, 0, '2017-03-13 14:27:24', '2017-03-13 18:57:24'),
(55, 5, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-13 14:30:28', '2017-03-13 19:00:28'),
(56, 5, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-13 14:34:09', '2017-03-13 19:04:09'),
(57, 1, '<strong></strong> warning has been deleted', 'Warning Deletion', 1, 0, '2017-03-14 11:27:14', '2017-03-14 15:57:14'),
(58, 4, '<strong></strong> warning has been deleted', 'Warning Deletion', 1, 0, '2017-03-14 11:27:20', '2017-03-14 15:57:20'),
(59, 5, '<strong></strong> warning has been deleted', 'Warning Deletion', 1, 0, '2017-03-14 11:27:23', '2017-03-14 15:57:23'),
(60, 1, '<strong></strong> warning has been inserted', 'Warning Insertion', 1, 0, '2017-03-14 11:29:20', '2017-03-14 15:59:20'),
(61, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 11:32:33', '2017-03-14 16:02:33'),
(62, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 11:52:47', '2017-03-14 16:22:47'),
(63, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 11:55:18', '2017-03-14 16:25:18'),
(64, 2, '<strong></strong> warning has been inserted', 'Warning Insertion', 1, 0, '2017-03-14 11:55:46', '2017-03-14 16:25:46'),
(65, 2, '<strong>#Warning 2</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 11:59:38', '2017-03-14 16:29:38'),
(66, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 11:59:58', '2017-03-14 16:29:58'),
(67, 2, '<strong>Blue</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-14 12:09:22', '2017-03-14 16:39:22'),
(68, 3, '<strong>Green</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-14 12:11:21', '2017-03-14 16:41:21'),
(69, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 12:22:42', '2017-03-14 16:52:42'),
(70, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 13:29:24', '2017-03-14 17:59:24'),
(71, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 13:32:31', '2017-03-14 18:02:31'),
(72, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 13:33:28', '2017-03-14 18:03:28'),
(73, 1, '<strong>Warning 1</strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-14 13:41:33', '2017-03-14 18:11:33'),
(74, 6, '<strong>#6</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-14 13:44:56', '2017-03-14 18:14:56'),
(75, 13, '<strong>#13</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-16 07:54:14', '2017-03-16 12:24:14'),
(76, 18, '<strong>#18</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-17 10:53:51', '2017-03-17 15:23:51'),
(77, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-17 12:40:00', '2017-03-17 17:10:00'),
(78, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-17 12:40:30', '2017-03-17 17:10:30'),
(79, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-17 12:40:50', '2017-03-17 17:10:50'),
(80, 18, '<strong>#18</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-18 10:18:57', '2017-03-18 14:48:57'),
(81, 18, '<strong>#18</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-18 10:28:11', '2017-03-18 14:58:11'),
(82, 19, '<strong>#19</strong> purchase order has been inserted', 'Purchase Insertion', 1, 0, '2017-03-18 10:35:39', '2017-03-18 15:05:39'),
(83, 2, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-21 11:43:06', '2017-03-21 16:13:06'),
(84, 1, '<strong></strong> warning has been updated', 'Warning Updation', 1, 0, '2017-03-21 11:43:24', '2017-03-21 16:13:24'),
(85, 3, '<strong></strong> warning has been inserted', 'Warning Insertion', 1, 0, '2017-03-21 12:00:11', '2017-03-21 16:30:11'),
(86, 13, '<strong>Ramkumar (ramkumar.izaap@gmail.com) </strong> user has been updated', 'User Updation', 1, 0, '2017-03-22 08:05:14', '2017-03-22 12:35:14'),
(87, 13, '<strong>Ramkumar (ramkumar.izaap@gmail.com) </strong> user has been updated', 'User Updation', 1, 0, '2017-03-22 08:25:13', '2017-03-22 12:55:13'),
(88, 1, '<strong>Mobile</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-22 12:56:30', '2017-03-22 17:26:30'),
(89, 2, '<strong>Fax</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-22 12:56:39', '2017-03-22 17:26:39'),
(90, 1, '<strong>ES</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-22 13:36:27', '2017-03-22 18:06:27'),
(91, 2, '<strong>IST</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-22 13:36:41', '2017-03-22 18:06:41'),
(92, 3, '<strong>MST</strong> dropdown has been inserted', 'Dropdown Insertion', 1, 0, '2017-03-22 13:36:48', '2017-03-22 18:06:48'),
(93, 5, '<strong></strong> customer has been deleted', 'Customer Deletion', 1, 0, '2017-03-22 15:40:07', '2017-03-22 20:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `parent` mediumint(5) NOT NULL,
  `sort` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `min_level`
--

CREATE TABLE `min_level` (
  `id` int(11) NOT NULL,
  `warning_name` varchar(250) NOT NULL,
  `message` text NOT NULL,
  `product` int(11) NOT NULL,
  `form` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `packaging` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `equivalent` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dropdown` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `min_level`
--

INSERT INTO `min_level` (`id`, `warning_name`, `message`, `product`, `form`, `color`, `packaging`, `type`, `equivalent`, `quantity`, `dropdown`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Warning 1', 'Quantity should be less than 5.', 16, 1, 1, 2, '', '', 5, 3, 1, 1, '2017-03-21 11:43:24', '2017-03-21 06:13:24'),
(2, 'Warning 2', 'Quantity should not be greater than 20.', 1, 1, 1, 1, '', '', 20, 2, 1, 1, '2017-03-21 11:43:06', '2017-03-21 06:13:06'),
(3, 'Warning 3', 'Warning 3', 4, 2, 3, 4, '', '', 2, 1, 1, 0, '2017-03-21 12:00:11', '2017-03-21 11:00:11');

-- --------------------------------------------------------

--
-- Table structure for table `operator_selection`
--

CREATE TABLE `operator_selection` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `operator` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `operator_selection`
--

INSERT INTO `operator_selection` (`id`, `name`, `operator`) VALUES
(1, 'Less than', '<'),
(2, 'Less than or equal to', '<='),
(3, 'Greater than', '>'),
(4, 'Greater than or equal to', '>='),
(5, 'Equal', '==');

-- --------------------------------------------------------

--
-- Table structure for table `page_titles`
--

CREATE TABLE `page_titles` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `controller` varchar(250) NOT NULL COMMENT 'navigation namespace',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `sku` varchar(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `form_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `product` int(11) NOT NULL COMMENT 'product information type',
  `notes` longtext NOT NULL,
  `item_type` text NOT NULL COMMENT 'Another Desc of Item',
  `equivalent` varchar(250) NOT NULL,
  `row` varchar(250) NOT NULL COMMENT 'Where the product is placed',
  `units` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `available_qty` int(11) NOT NULL,
  `retail_price` decimal(10,2) NOT NULL,
  `wholesale_price` decimal(10,2) NOT NULL,
  `shipping_cost` decimal(10,2) NOT NULL,
  `ref_no` varchar(100) NOT NULL,
  `internal_lot_no` varchar(255) NOT NULL,
  `vendor_lot_no` varchar(255) NOT NULL,
  `certification_files` varchar(255) NOT NULL,
  `warehouse_id` int(11) NOT NULL COMMENT 'warehouse location',
  `intransit_to_warehouse` enum('No','Yes') NOT NULL DEFAULT 'No',
  `intransit_to_customer` enum('No','Yes') NOT NULL DEFAULT 'No',
  `received_at_customer` enum('No','Yes') NOT NULL DEFAULT 'No',
  `received_in_warehouse` enum('No','Yes') NOT NULL DEFAULT 'No',
  `purchase_order_number` int(11) NOT NULL,
  `purchase_transportation_identifier` int(11) NOT NULL,
  `sales_transportation_identifier` int(11) NOT NULL,
  `length` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `in_stock` enum('1','0') NOT NULL,
  `enabled` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `parent_id`, `category_id`, `sku`, `name`, `form_id`, `package_id`, `color_id`, `product`, `notes`, `item_type`, `equivalent`, `row`, `units`, `quantity`, `available_qty`, `retail_price`, `wholesale_price`, `shipping_cost`, `ref_no`, `internal_lot_no`, `vendor_lot_no`, `certification_files`, `warehouse_id`, `intransit_to_warehouse`, `intransit_to_customer`, `received_at_customer`, `received_in_warehouse`, `purchase_order_number`, `purchase_transportation_identifier`, `sales_transportation_identifier`, `length`, `width`, `height`, `weight`, `in_stock`, `enabled`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, NULL, 1, 'dds', 'Tes', 2, 1, 2, 12, 'Tfffd', ' dffd', ' dfdf', '2', 5, 2, 0, '12.00', '25.00', '0.00', '12', '1', '12', '', 1, 'Yes', 'No', 'Yes', 'No', 12, 121, 12, '0.00', '0.00', '0.00', '15.00', '0', '1', 1, 0, '2017-03-06 13:34:23', '2017-03-06 08:04:23'),
(2, NULL, 1, 'dds', 'Tes', 2, 1, 2, 12, 'Tfffd', ' dffd', ' dfdf', '2', 5, 2, 0, '12.00', '25.00', '0.00', '12', '1', '12', '', 1, 'Yes', 'No', 'Yes', 'No', 12, 121, 12, '0.00', '0.00', '0.00', '15.00', '0', '1', 1, 0, '2017-03-06 13:35:35', '2017-03-06 08:05:35'),
(3, NULL, 1, 'g', 'fdgf', 2, 1, 1, 1, ' ggf', ' fg', ' fggf', 'gg', 0, 0, 0, '125.00', '145.00', '0.00', '45', '12', '212', '', 2, 'Yes', 'No', 'Yes', 'Yes', 250, 221, 2, '0.00', '0.00', '0.00', '112.00', '1', '1', 1, 0, '2017-03-06 13:36:35', '2017-03-06 08:06:35'),
(4, NULL, 1, 'g', 'fdgf', 2, 1, 2, 0, ' ggf', ' fg', ' fggf', 'gg', 0, 0, 0, '125.00', '145.00', '0.00', '45', '12', '212', '', 2, 'Yes', 'No', 'Yes', 'Yes', 250, 221, 2, '0.00', '0.00', '0.00', '112.00', '1', '1', 1, 0, '2017-03-06 14:55:12', '2017-03-06 09:25:12'),
(5, NULL, 1, 'df', 'TEds', 4, 1, 2, 0, ' dfdf', ' dfdf', 'dfdf', '2', 2, 1, 0, '2.00', '21.00', '0.00', '12', '1', '12', '', 1, 'No', 'Yes', 'No', 'Yes', 3256, 2332, 23, '0.00', '0.00', '0.00', '2323.00', '1', '1', 1, 0, '2017-03-07 10:02:01', '2017-03-07 04:32:01'),
(6, NULL, 2, 'fd', 'fd', 2, 1, 2, 0, 'dfdf ', ' dfdf', ' df', '2', 2, 2, 0, '23.00', '3.00', '0.00', '3', '32', '23', '', 2, 'Yes', 'Yes', 'No', 'Yes', 2, 2, 2, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 10:38:15', '2017-03-07 05:08:15'),
(7, NULL, 2, 'fd', 'fd', 2, 1, 2, 0, 'dfdf ', ' dfdf', ' df', '2', 2, 2, 0, '23.00', '3.00', '0.00', '3', '32', '23', '', 2, 'Yes', 'Yes', 'No', 'Yes', 2, 2, 2, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 10:39:56', '2017-03-07 05:09:56'),
(8, NULL, 2, 'fg', 'fgg', 2, 1, 2, 0, ' fgfg', ' gf', ' gf', '12', 2, 221, 0, '121.00', '2112.00', '0.00', '21', '12', '21', '', 2, 'Yes', 'No', 'Yes', 'No', 25, 22, 2121, '0.00', '0.00', '0.00', '21.00', '0', '1', 1, 0, '2017-03-07 10:40:48', '2017-03-07 05:10:48'),
(9, NULL, 1, 'fd', 'df', 2, 1, 2, 0, ' teds', ' d', ' 1', '2', 5, 54, 0, '2.00', '12.00', '0.00', '21', '21', '12', '', 2, 'Yes', 'No', 'Yes', 'No', 21, 54, 87, '0.00', '0.00', '0.00', '87.00', '0', '1', 1, 0, '2017-03-07 11:00:15', '2017-03-07 05:30:15'),
(10, NULL, 1, 'fd', 'df', 2, 1, 2, 0, ' teds', ' d', ' 1', '2', 5, 54, 0, '2.00', '12.00', '0.00', '21', '21', '12', '', 2, 'Yes', 'No', 'Yes', 'No', 21, 54, 87, '0.00', '0.00', '0.00', '87.00', '0', '1', 1, 0, '2017-03-07 11:08:00', '2017-03-07 05:38:00'),
(11, NULL, 2, 'f', 'xcv', 2, 1, 2, 0, ' df', ' fd', ' fd', '12', 21, 5, 0, '54.00', '3.00', '0.00', '7', '421', '21', '', 2, 'Yes', 'No', 'Yes', 'No', 1, 12, 12, '0.00', '0.00', '0.00', '12.00', '0', '1', 1, 0, '2017-03-07 11:08:56', '2017-03-07 05:38:56'),
(12, NULL, 2, 'sdsd', 'Tesd', 3, 1, 2, 0, ' sd', ' s', ' sd', '2', 5, 12, 0, '54.00', '45.00', '0.00', '54', '2154', '221', '', 1, 'Yes', 'No', 'Yes', 'No', 23, 45, 4, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 11:18:55', '2017-03-07 05:48:55'),
(13, NULL, 2, 'df', 'ddf', 2, 1, 2, 0, ' dffd', ' fddf', ' dffd', '25', 2, 21, 0, '221.00', '21.00', '0.00', '11', '23', '56', '', 1, 'Yes', 'No', 'Yes', 'No', 235, 2, 32, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 12:53:40', '2017-03-07 07:23:40'),
(14, NULL, 1, 'sdds', 'ds', 4, 1, 2, 0, ' dsd', ' dsds', ' sdffd', '25', 54, 54, 0, '54.00', '5454.00', '0.00', '554', '54', '54', '', 1, 'Yes', 'No', 'Yes', 'No', 125, 56, 56, '0.00', '0.00', '0.00', '65.00', '0', '1', 1, 0, '2017-03-07 13:08:58', '2017-03-07 07:38:58'),
(15, NULL, 2, 'fggf', 'gfgf', 3, 1, 2, 0, ' fggf', ' ggf', ' gfgf', '1', 2, 21, 0, '21.00', '212.00', '0.00', '21', '2', '21', 'RFP_(2).docx', 1, 'Yes', 'No', 'Yes', 'No', 25, 325, 232, '0.00', '0.00', '0.00', '23.00', '0', '1', 1, 0, '2017-03-07 13:52:45', '2017-03-07 08:22:45'),
(16, NULL, 1, 'PRP3', 'Product 3', 1, 2, 1, 1, ' Product 3', ' Product 3', ' Product 3', '3', 150, 150, 0, '149.00', '139.00', '0.00', '12345', '98657', '546456', '', 1, 'Yes', 'Yes', 'Yes', 'Yes', 4, 4, 0, '0.00', '0.00', '0.00', '120.00', '0', '1', 1, 0, '2017-03-08 07:48:16', '2017-03-08 02:18:16'),
(17, NULL, 1, 'PRP4', 'Product 4', 2, 2, 1, 2, '   ', '   ', '   ', '1', 1, 12, 0, '0.00', '0.00', '0.00', '', '', '', '', 0, 'Yes', 'Yes', 'Yes', 'Yes', 0, 0, 0, '0.00', '0.00', '0.00', '12.00', '1', '1', 1, 0, '2017-03-15 07:21:04', '2017-03-15 01:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE `product_color` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Red', '1', 1, 0, '2017-02-24 06:50:01', '2017-02-24 06:50:01'),
(2, 'Blue', '1', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Green', '1', 1, 1, '2017-03-14 12:11:21', '2017-03-14 12:11:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_form`
--

CREATE TABLE `product_form` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_form`
--

INSERT INTO `product_form` (`id`, `name`, `status`) VALUES
(1, 'Comp', '1'),
(2, 'Powder', '1'),
(3, 'Parts', '1'),
(4, 'Regrind', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `image_title` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `primary` tinyint(1) NOT NULL COMMENT '1=>primary,0=>none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_title`, `file_name`, `primary`) VALUES
(1, 1, 'Test', 'material3.jpg', 0),
(4, 1, 'Test 2', 'material22.jpg', 0),
(5, 16, 'Image 1', '4493378-hd-wallpapers-1080p.jpg', 0),
(6, 16, 'Image 1', '6928982-orange-and-black-wallpaper-free.jpg', 0),
(7, 17, '', '4493378-hd-wallpapers-1080p1.jpg', 0),
(8, 17, '', '6862346-call-of-duty-ghosts.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_packaging`
--

CREATE TABLE `product_packaging` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_packaging`
--

INSERT INTO `product_packaging` (`id`, `name`, `status`) VALUES
(1, 'Bags', '1'),
(2, 'Graylord', '1'),
(3, 'Tst', '1'),
(4, 'Test', '1');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `status`, `created_id`) VALUES
(1, '12', '0', 0),
(2, 'Pulse', '1', 0);

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE `purchase_order` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL COMMENT 'purchase from(vendor)',
  `order_status` enum('NEW','ACCEPTED','PROCESSING','PENDING','SHIPPED','COMPLETE','HOLD','CANCELLED','IGNORE','RECEIVED') NOT NULL,
  `total_amount` double NOT NULL,
  `so_id` int(11) NOT NULL,
  `accounts_person_id` int(11) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `estimated_delivery` datetime NOT NULL,
  `release_to_sold` enum('Yes','No') NOT NULL DEFAULT 'No',
  `po_message` text NOT NULL,
  `note` text NOT NULL,
  `is_vendor_stock_level_updated` enum('No','Yes') NOT NULL,
  `is_paid` enum('NULL','PAID','NOT PAID') NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `ship_type_id` int(11) NOT NULL,
  `carrier_id` int(11) NOT NULL,
  `credit_type_id` int(11) NOT NULL,
  `status` enum('INCOMPLETE','COMPLETED') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `purchase_order`
--

INSERT INTO `purchase_order` (`id`, `vendor_id`, `order_status`, `total_amount`, `so_id`, `accounts_person_id`, `pickup_date`, `estimated_delivery`, `release_to_sold`, `po_message`, `note`, `is_vendor_stock_level_updated`, `is_paid`, `warehouse_id`, `ship_type_id`, `carrier_id`, `credit_type_id`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 2, 'NEW', 139, 0, 0, '2017-03-17 00:00:00', '2017-03-22 00:00:00', 'Yes', '', '', 'No', 'NOT PAID', 1, 3, 2, 2, 'COMPLETED', 1, 1, '2017-03-08 11:48:07', '2017-03-08 06:18:23'),
(2, 2, 'NEW', 429, 0, 0, '2017-03-08 00:00:00', '2017-03-17 00:00:00', 'Yes', '', '', 'No', 'NOT PAID', 2, 3, 3, 5, 'COMPLETED', 1, 1, '2017-03-09 11:08:54', '2017-03-09 05:40:55'),
(3, 1, 'NEW', 0, 0, 0, '2017-03-08 00:00:00', '2017-03-23 00:00:00', 'Yes', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-09 11:11:34', '2017-03-09 10:11:34'),
(4, 2, 'NEW', 417, 0, 0, '2017-03-25 00:00:00', '2017-03-31 00:00:00', 'No', '', '', 'No', 'NOT PAID', 2, 2, 2, 5, 'COMPLETED', 1, 1, '2017-03-09 11:14:03', '2017-03-09 05:44:29'),
(5, 2, 'NEW', 0, 0, 0, '2017-03-07 00:00:00', '2017-03-16 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'COMPLETED', 1, 1, '2017-03-14 12:12:21', '2017-03-14 11:12:21'),
(6, 2, 'NEW', 1136, 0, 0, '2017-03-22 00:00:00', '2017-03-31 00:00:00', 'No', '', '', 'No', 'NOT PAID', 3, 2, 3, 6, 'COMPLETED', 1, 1, '2017-03-14 12:21:49', '2017-03-14 08:14:56'),
(7, 1, 'NEW', 0, 0, 0, '2017-03-21 00:00:00', '2017-03-18 00:00:00', 'Yes', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-14 14:53:43', '2017-03-14 13:53:43'),
(8, 2, 'NEW', 0, 0, 0, '2017-03-22 00:00:00', '2017-03-23 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-14 14:57:26', '2017-03-14 13:57:26'),
(9, 2, 'NEW', 0, 0, 0, '2017-03-13 00:00:00', '2017-03-23 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-15 07:10:29', '2017-03-15 06:10:29'),
(11, 1, 'NEW', 0, 0, 0, '2017-02-27 00:00:00', '2017-03-17 00:00:00', 'Yes', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-16 06:53:42', '2017-03-16 05:53:42'),
(12, 1, 'NEW', 0, 0, 0, '2017-03-14 00:00:00', '2017-03-31 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-16 07:03:31', '2017-03-16 06:03:31'),
(13, 2, 'NEW', 145, 0, 0, '2017-03-06 00:00:00', '2017-03-30 00:00:00', 'No', '', '', 'No', 'NOT PAID', 2, 2, 2, 5, 'COMPLETED', 1, 1, '2017-03-16 07:31:12', '2017-03-16 02:24:14'),
(14, 2, 'NEW', 0, 0, 0, '2017-03-07 00:00:00', '2017-03-07 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-16 13:47:53', '2017-03-16 12:47:53'),
(15, 1, 'NEW', 0, 0, 0, '2017-03-14 00:00:00', '2017-03-14 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-16 13:49:25', '2017-03-16 12:49:26'),
(16, 1, 'NEW', 0, 0, 0, '2017-02-27 00:00:00', '2017-03-24 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-16 14:03:24', '2017-03-16 13:03:24'),
(17, 1, 'NEW', 0, 0, 0, '2017-03-05 00:00:00', '2017-04-01 00:00:00', 'No', '', '', 'No', 'NOT PAID', 0, 0, 0, 0, 'INCOMPLETE', 1, 1, '2017-03-17 10:48:21', '2017-03-17 09:48:21'),
(18, 2, 'PROCESSING', 417, 0, 0, '2017-03-29 00:00:00', '2017-03-10 00:00:00', 'Yes', 'hello', 'hi', 'No', 'NOT PAID', 2, 2, 2, 6, 'COMPLETED', 1, 1, '2017-03-18 08:26:48', '2017-03-18 04:58:11'),
(19, 2, 'PENDING', 979, 0, 0, '2017-03-18 00:00:00', '2017-03-24 00:00:00', 'Yes', 'PO - 19', 'PO - 19 Note', 'No', 'NOT PAID', 2, 2, 3, 6, 'COMPLETED', 1, 1, '2017-03-18 10:34:34', '2017-03-18 05:05:39');

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_item`
--

CREATE TABLE `purchase_order_item` (
  `id` int(11) NOT NULL,
  `po_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `code` varchar(150) NOT NULL,
  `name` varchar(250) NOT NULL,
  `item_status` enum('NEW','ACCEPTED','PROCESSING','PENDING','SHIPPED','COMPLETE','HOLD','CANCELLED','IGNORE','RECEIVED') NOT NULL,
  `unit_price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `qty_received` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `purchase_order_item`
--

INSERT INTO `purchase_order_item` (`id`, `po_id`, `product_id`, `code`, `name`, `item_status`, `unit_price`, `qty`, `qty_received`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 16, '', '', 'NEW', 139, 1, 0, 1, 1, '2017-03-08 11:48:10', '2017-03-08 10:48:10'),
(2, 2, 3, '', '', 'NEW', 145, 2, 0, 1, 1, '2017-03-09 11:09:02', '2017-03-09 05:39:08'),
(3, 2, 16, '', '', 'NEW', 139, 1, 0, 1, 1, '2017-03-09 11:09:11', '2017-03-09 10:09:11'),
(4, 4, 16, '', '', 'NEW', 139, 3, 0, 1, 1, '2017-03-09 11:14:12', '2017-03-09 10:14:12'),
(5, 5, 16, '', '', 'NEW', 139, 1, 0, 1, 1, '2017-03-14 12:12:38', '2017-03-14 11:12:38'),
(6, 5, 3, '', '', 'NEW', 145, 1, 0, 1, 1, '2017-03-14 12:13:06', '2017-03-14 11:13:06'),
(7, 6, 16, '', '', 'NEW', 139, 4, 0, 1, 1, '2017-03-14 13:28:51', '2017-03-14 08:05:33'),
(8, 6, 3, '', '', 'NEW', 145, 4, 0, 1, 1, '2017-03-14 13:40:38', '2017-03-14 08:11:49'),
(9, 10, 3, '', '', 'NEW', 145, 2, 0, 1, 1, '2017-03-16 06:50:46', '2017-03-16 01:21:45'),
(11, 13, 3, '', '', 'NEW', 145, 1, 0, 1, 1, '2017-03-16 07:39:10', '2017-03-16 06:39:10'),
(12, 18, 16, '', '', 'NEW', 139, 3, 0, 1, 1, '2017-03-17 10:49:15', '2017-03-17 09:49:15'),
(13, 19, 16, '', '', 'NEW', 139, 6, 0, 1, 1, '2017-03-18 10:34:49', '2017-03-18 09:34:49'),
(14, 19, 3, '', '', 'NEW', 145, 1, 0, 1, 1, '2017-03-18 10:34:56', '2017-03-18 09:34:56');

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE `returns` (
  `id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Incoming','Received','Rejected','Partially Accepted') NOT NULL,
  `is_refund` enum('0','1') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE `return_product` (
  `id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `refund_qty` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Sales'),
(3, 'Purchase'),
(4, 'Inventory'),
(5, 'Accounting');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE `role_access` (
  `id` int(11) NOT NULL,
  `page_title_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` varchar(255) NOT NULL,
  `access_level` varchar(255) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_access`
--

INSERT INTO `role_access` (`id`, `page_title_id`, `role_id`, `menu_id`, `access_level`, `created_date`, `updated_date`) VALUES
(1, 0, 1, '{"dashboard":"1","sales":"1","purchase":"1","inventory":"1","accounting":"1","admin":"1","reports":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-18 11:46:05', '2017-03-22 02:23:01'),
(2, 0, 2, '{"dashboard":"1","sales":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-21 13:44:08', '2017-03-21 12:44:08'),
(3, 0, 3, '{"dashboard":"1","purchase":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:51:59', '2017-03-22 06:51:59'),
(4, 0, 4, '{"dashboard":"1","inventory":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:52:10', '2017-03-22 06:52:10'),
(5, 0, 5, '{"dashboard":"1","accounting":"1","reports":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:52:22', '2017-03-22 06:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `order_status` enum('NEW','PROCESSING','PENDING','COMPLETED','SHIPPED','RETURNED','CANCELLED') NOT NULL,
  `total_amount` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_shipping` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_items` int(11) NOT NULL,
  `shipping_type` int(11) NOT NULL,
  `credit_type` int(11) NOT NULL,
  `cod_fee` double NOT NULL,
  `carrier_id` int(11) NOT NULL,
  `type` enum('SALE''PURCHASE','RETURN') NOT NULL,
  `total_weight` decimal(5,2) NOT NULL,
  `bol_instructions` text NOT NULL,
  `so_instructions` text NOT NULL,
  `so_printed` enum('Yes','No') NOT NULL,
  `bol_printed` enum('Yes','No') NOT NULL,
  `received_inventory` enum('Yes','No') NOT NULL,
  `return_type` enum('RETURN','RESALE','DISPOSED') NOT NULL,
  `inventory_person` int(11) NOT NULL,
  `shipping_address_id` int(11) NOT NULL,
  `billing_address_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `customer_id`, `salesman_id`, `location_id`, `contact_id`, `order_status`, `total_amount`, `total_discount`, `total_shipping`, `total_tax`, `total_items`, `shipping_type`, `credit_type`, `cod_fee`, `carrier_id`, `type`, `total_weight`, `bol_instructions`, `so_instructions`, `so_printed`, `bol_printed`, `received_inventory`, `return_type`, `inventory_person`, `shipping_address_id`, `billing_address_id`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 0, 0, 0, 'NEW', 500, 20, 10, 7, 2, 1, 1, 0, 1, 'SALE''PURCHASE', '100.00', '', '', 'No', 'No', 'Yes', '', 1, 1, 1, 1, 1, '2017-02-16 00:00:00', '2017-02-16 06:35:48');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `item_status` enum('NEW','PROCESSING','PENDING','COMPLETED','SHIPPED','RETURNED','CANCELLED') NOT NULL,
  `unit_price` double NOT NULL,
  `qty` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sale_type`
--

CREATE TABLE `sale_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `autoload` enum('Y','N') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `type`, `name`, `value`, `autoload`) VALUES
(1, 'general', 'site_name', 'http://independentplastics.com', 'Y'),
(2, 'general', 'info_email', 'info@independentplastics.com', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `shipment`
--

CREATE TABLE `shipment` (
  `id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `shipping_type` varchar(250) NOT NULL,
  `total_items` int(11) NOT NULL,
  `ship_company` varchar(150) NOT NULL,
  `order_status` enum('NEW','PENDING','ACCEPTED','SHIPPED','COMPLETE','HOLD','CANCELLED') NOT NULL,
  `tracking` varchar(60) NOT NULL,
  `back_orderr` tinyint(1) NOT NULL,
  `ship_date` datetime NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipment`
--

INSERT INTO `shipment` (`id`, `so_id`, `shipping_type`, `total_items`, `ship_company`, `order_status`, `tracking`, `back_orderr`, `ship_date`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 'Road', 2, 'ADDas', 'NEW', '234234', 0, '2017-02-16 06:00:00', 1, 1, '2017-02-16 00:00:00', '2017-02-16 06:34:20');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_type`
--

CREATE TABLE `shipping_type` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `delivery_days` int(11) NOT NULL,
  `flat_rate` decimal(10,2) NOT NULL,
  `rate_pound` decimal(10,2) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shipping_type`
--

INSERT INTO `shipping_type` (`id`, `type`, `delivery_days`, `flat_rate`, `rate_pound`, `status`) VALUES
(1, 'Standard 2-6 days', 6, '5.00', '0.50', '1'),
(2, 'Delivery 2 days', 2, '10.00', '1.50', '1'),
(3, 'Free Shipping', 6, '0.00', '0.00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `id` int(11) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_code`, `name`, `country_code`, `status`) VALUES
(1, 'AZ', 'Arizona', 'US', '1'),
(2, 'TX', 'Texas', 'US', '1'),
(3, 'DC', 'Washington DC', 'US', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE `tax` (
  `id` int(11) NOT NULL,
  `country` varchar(10) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `include_discount` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE `timezone` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `offset` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `timezone`
--

INSERT INTO `timezone` (`id`, `name`, `offset`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'ES', '', '1', 1, 1, '2017-03-22 13:36:27', '2017-03-22 08:06:27'),
(2, 'IST', '', '1', 1, 1, '2017-03-22 13:36:41', '2017-03-22 08:06:41'),
(3, 'MST', '', '1', 1, 1, '2017-03-22 13:36:48', '2017-03-22 08:06:48');

-- --------------------------------------------------------

--
-- Table structure for table `vendor_price_list`
--

CREATE TABLE `vendor_price_list` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(150) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `priority` int(11) NOT NULL COMMENT 'prefered vendor',
  `in_stock` enum('No','Yes') NOT NULL,
  `stock_level` int(11) NOT NULL COMMENT 'inventory stock level',
  `enabled` enum('1','0') NOT NULL,
  `shipping_cost` decimal(5,2) NOT NULL,
  `shipping_service` varchar(50) NOT NULL,
  `dropship_fee` decimal(5,2) NOT NULL,
  `in_bound` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vendor_price_list`
--

INSERT INTO `vendor_price_list` (`id`, `vendor_id`, `product_id`, `sku`, `cost`, `priority`, `in_stock`, `stock_level`, `enabled`, `shipping_cost`, `shipping_service`, `dropship_fee`, `in_bound`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 1, '12', '50.00', 1, 'Yes', 10, '1', '5.00', 'usps', '1.00', 1, 0, 0, '2017-02-24 06:01:57', '2017-02-24 06:01:57'),
(2, 2, 3, 'PRP2', '50.00', 1, 'Yes', 50, '1', '5.00', 'usps', '1.00', 1, 0, 0, '2017-02-24 06:01:57', '2017-02-24 06:01:57'),
(3, 2, 16, '20', '142.00', 1, 'Yes', 1, '1', '5.00', 'usps', '5.00', 1, 0, 0, '2017-03-08 06:49:39', '2017-03-08 06:49:39'),
(4, 1, 17, 'PTP2', '147.00', 1, 'Yes', 200, '1', '5.00', 'usps', '5.00', 0, 0, 0, '2017-03-21 12:48:08', '2017-03-21 12:48:08');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `status`, `created_date`, `updated_date`) VALUES
(2, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, '2', '1514', '4454156465', 'test@gmail.com', '1', '2017-03-17 08:49:03', '2017-03-17 08:49:03');

-- --------------------------------------------------------

--
-- Table structure for table `week_days_operate`
--

CREATE TABLE `week_days_operate` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `week_days_operate`
--

INSERT INTO `week_days_operate` (`id`, `name`, `status`) VALUES
(1, 'Monday through Friday', '1'),
(2, 'Monday through Thursday', '1'),
(3, 'Wednesday and Friday only', '1'),
(4, 'Monday and Wednesday only', '1'),
(5, 'Thursday only', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `callback`
--
ALTER TABLE `callback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_logs`
--
ALTER TABLE `call_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `call_type`
--
ALTER TABLE `call_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carrier`
--
ALTER TABLE `carrier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_type`
--
ALTER TABLE `contact_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_type`
--
ALTER TABLE `credit_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_contact`
--
ALTER TABLE `customer_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_location`
--
ALTER TABLE `customer_location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `min_level`
--
ALTER TABLE `min_level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `operator_selection`
--
ALTER TABLE `operator_selection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_titles`
--
ALTER TABLE `page_titles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_color`
--
ALTER TABLE `product_color`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_form`
--
ALTER TABLE `product_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_packaging`
--
ALTER TABLE `product_packaging`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_type`
--
ALTER TABLE `product_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order`
--
ALTER TABLE `purchase_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `returns`
--
ALTER TABLE `returns`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `return_product`
--
ALTER TABLE `return_product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_access`
--
ALTER TABLE `role_access`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_type`
--
ALTER TABLE `sale_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipment`
--
ALTER TABLE `shipment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shipping_type`
--
ALTER TABLE `shipping_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax`
--
ALTER TABLE `tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `timezone`
--
ALTER TABLE `timezone`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_price_list`
--
ALTER TABLE `vendor_price_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `week_days_operate`
--
ALTER TABLE `week_days_operate`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `callback`
--
ALTER TABLE `callback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `call_type`
--
ALTER TABLE `call_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `credit_type`
--
ALTER TABLE `credit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer_location`
--
ALTER TABLE `customer_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `min_level`
--
ALTER TABLE `min_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `operator_selection`
--
ALTER TABLE `operator_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_titles`
--
ALTER TABLE `page_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `product_form`
--
ALTER TABLE `product_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_packaging`
--
ALTER TABLE `product_packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `returns`
--
ALTER TABLE `returns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `return_product`
--
ALTER TABLE `return_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sale_type`
--
ALTER TABLE `sale_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `shipping_type`
--
ALTER TABLE `shipping_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `vendor_price_list`
--
ALTER TABLE `vendor_price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `week_days_operate`
--
ALTER TABLE `week_days_operate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
