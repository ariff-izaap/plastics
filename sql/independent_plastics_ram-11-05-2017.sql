-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2017 at 03:41 PM
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
(1, '3D Plastics INC.,', '', '', '', '2701', 'East 2nd Street', 'Newberg', 'Oregon', 'United States of America', '97132', '97132', 1, 1, '2017-05-11 08:36:03', '2017-05-11 06:36:03'),
(2, 'Next Generation Plastics/Lahrmer', '', '', '', '161 Bugger', 'Hallow Road', 'Ellenbord', 'North Carolina', 'United States of America', '28040', '28040', 1, 1, '2017-05-11 08:41:12', '2017-05-11 06:41:12'),
(3, 'Next Speciality Resins, INC.,', '', '', '', '215 N', 'Talbot Street', 'Addison', 'Michigan', 'United States of America', '49220', '49220', 1, 1, '2017-05-11 08:46:47', '2017-05-11 06:45:59'),
(4, 'Adaptive Technologies, INC.', '', '', '', '1910 E', 'Karcher Road', 'Nampa', 'Idaho', 'United States of America', '83687', '83687', 1, 1, '2017-05-11 08:49:38', '2017-05-11 06:49:38'),
(5, 'ABS Plastics', '', '', '', '2378 West', '80th Street Unit 6', 'Blaeiah', 'Florida', 'United States of America', '33016', '33016', 1, 1, '2017-05-11 08:58:44', '2017-05-11 06:58:44');

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
(1, 'Admin', 'Admin', 'admin', '1', 'admin@admin.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '1', 1, 1, '2017-05-11 11:49:04', '2017-05-11 06:19:04'),
(2, 'Michele', 'M', 'michele_sales', 'MICHELEM', 'michele@sales.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 0, '2017-05-11 08:21:08', '2017-05-11 06:21:08'),
(3, 'Chris', 'C', 'Chris', 'CHRISC', 'chris@sales.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 0, '2017-05-11 08:21:33', '2017-05-11 06:21:33'),
(4, 'George', 'GE', 'george', 'GEORGEGE', 'george@sales.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 0, '2017-05-11 08:22:09', '2017-05-11 06:22:09'),
(5, 'James', 'J', 'james', 'JAMESJ', 'james@sales.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 0, '2017-05-11 08:22:33', '2017-05-11 06:22:33'),
(6, 'Michael', 'M', 'michael', 'MICHAELM', 'michael@sales.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 0, '2017-05-11 08:23:09', '2017-05-11 06:23:09');

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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `updated_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `call_type`
--

INSERT INTO `call_type` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Product Search', '1', 0, 0, 0, 0),
(2, 'Complaint', '1', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `carrier`
--

CREATE TABLE `carrier` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrier`
--

INSERT INTO `carrier` (`id`, `name`, `location`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'USPS', 'Chennai', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:55'),
(2, 'UPS', 'Delhi', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:55'),
(3, 'Fedex', 'Mumbai', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:55'),
(4, 'Frontier', 'Bangalore', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:55'),
(5, 'Freight', 'Hyderabad', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:55'),
(6, 'Bluedart', '', '1', 1, 1, '2017-03-24 06:18:59', '2017-03-24 00:48:59');

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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_id`, `name`, `description`, `category_thumb`, `created_date`, `updated_date`, `enabled`) VALUES
(1, NULL, 'Category 1', 'Category 1 Description', '', '2017-05-11 09:04:09', '2017-05-11 03:34:09', 1),
(2, NULL, 'Category 2', 'Category 2 Description', '', '2017-05-11 09:04:17', '2017-05-11 03:34:24', 1),
(3, NULL, 'Category 3', 'Category 3 Description', '', '2017-05-11 09:04:34', '2017-05-11 03:34:34', 1),
(4, NULL, 'Category 4', 'Category 4 Description', '', '2017-05-11 09:04:45', '2017-05-11 03:34:45', 1),
(5, NULL, 'Category 5', 'Category 5 Description', '', '2017-05-11 09:04:57', '2017-05-11 03:34:57', 1);

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
(1, 'Accounts Payable', '1', 1, 1, '2017-04-08 08:46:44', '2017-04-08 03:16:44'),
(2, 'Sales', '1', 1, 1, '2017-04-08 08:46:56', '2017-04-08 03:16:56'),
(3, 'Return', '1', 1, 1, '2017-04-08 08:47:05', '2017-04-08 03:17:05'),
(4, 'Purchase', '1', 1, 1, '2017-04-08 08:47:17', '2017-04-08 03:17:17');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'India', 'IN', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:38'),
(2, 'United States of America', 'USA', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:38'),
(3, 'Canada', 'CA', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:38'),
(4, 'Australia', 'AUS', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:38'),
(5, 'United Kingdom', 'UK', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:38');

-- --------------------------------------------------------

--
-- Table structure for table `credit_type`
--

CREATE TABLE `credit_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `days` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `credit_type`
--

INSERT INTO `credit_type` (`id`, `name`, `days`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'NET10', '10 days', 0, 0, 0, '2016-12-17 00:00:00', '2017-03-24 05:18:08'),
(2, 'NET15', '15 days', 1, 0, 0, '2016-12-17 00:00:00', '2017-03-24 05:18:08'),
(5, 'NET30', '30 Days', 1, 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:08'),
(6, 'NET60', '60 Days', 1, 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:18:08'),
(7, 'NET90', '90 Days', 1, 1, 1, '2017-03-24 06:18:11', '2017-03-24 00:48:11');

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
  `comments` text NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='vendors';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `business_name`, `credit_type`, `web_url`, `ups`, `address_id`, `comments`, `status`, `created_date`, `updated_date`) VALUES
(1, '3D Plastics INC.,', 2, 'http://www.google.com', 'Nothing', 1, '', '1', '0000-00-00 00:00:00', '2017-05-11 06:36:04'),
(2, 'Next Generation Plastics/Lahrmer', 6, 'http://www.google.com', 'Nothing', 2, ';', '1', '0000-00-00 00:00:00', '2017-05-11 06:41:12'),
(3, 'Next Speciality Resins, INC.,', 2, 'http://www.google.com', 'Nothing', 3, '', '1', '0000-00-00 00:00:00', '2017-05-11 06:45:59'),
(4, 'Adaptive Technologies, INC.', 7, 'http://www.google.com', 'Nothing', 4, '', '1', '0000-00-00 00:00:00', '2017-05-11 06:49:38'),
(5, 'ABS Plastics', 5, 'http://www.google.com', 'Nothing', 5, '', '1', '0000-00-00 00:00:00', '2017-05-11 06:58:44');

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
(1, 1, 'Glenda Devross', 2, '5035370953', 'glendadevross@sales.com', 1, 1, '2017-05-11 08:36:04', '2017-05-11 06:36:04'),
(2, 2, 'Lowell Lahrmer', 2, '8284530104', 'lowell@sales.com', 1, 1, '2017-05-11 08:41:12', '2017-05-11 06:41:12'),
(3, 3, 'Rajiv Naik', 2, '5175474700', 'rajiv@sales.com', 1, 1, '2017-05-11 08:46:47', '2017-05-11 03:16:47'),
(4, 4, 'Eric Younger', 2, '2084671000', 'eric@sales.com', 1, 1, '2017-05-11 08:49:38', '2017-05-11 06:49:38'),
(5, 5, 'Frank Sanchez', 2, '7864317036', 'frank@sales.com', 1, 1, '2017-05-11 08:58:44', '2017-05-11 06:58:44');

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
  `phone` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
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

INSERT INTO `customer_location` (`id`, `customer_id`, `name`, `address_1`, `address_2`, `phone`, `city`, `state`, `country`, `zipcode`, `definition`, `timezone_id`, `start_time`, `end_time`, `day_of_week`, `created_date`, `updated_date`) VALUES
(1, 1, '3D Plastics', '2701', 'East 2nd Street', '', 'Newberg', 'Oregon', 'United States of America', '97132', '1,2', 1, '09:30:00', '18:30:00', 1, '0000-00-00 00:00:00', '2017-05-11 06:36:05'),
(2, 2, 'Next Generation Plastics/Lahrmer', '161 Bugger', 'Hallow Road', '', 'Ellenbord', 'North Carolina', 'United States of America', '28040', '1,2', 3, '09:00:00', '19:00:00', 1, '0000-00-00 00:00:00', '2017-05-11 06:41:12'),
(3, 3, 'Next Speciality Resins, INC.,', '215 N', '', '', 'Addison', 'Michigan', 'United States of America', '49220', '1,2', 4, '10:00:00', '01:00:00', 2, '0000-00-00 00:00:00', '2017-05-11 06:45:59'),
(4, 4, 'Adaptive Technologies, INC.', '1910 E', 'Karcher Road', '', 'nampa', 'Idaho', 'United States of America', '83687', '1,2', 3, '09:00:00', '19:00:00', 5, '0000-00-00 00:00:00', '2017-05-11 06:49:38'),
(5, 5, 'ABS Plastics', '2378 West', '80th Street Unit 6', '', 'Blaieah', 'Florida', 'United States of America', '33016', '1,2', 4, '09:00:00', '19:00:00', 1, '0000-00-00 00:00:00', '2017-05-11 06:58:44');

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
  `invoice_no` varchar(255) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `shipment_id` int(11) NOT NULL,
  `location_id` int(11) NOT NULL,
  `billing_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
  `ship_date` datetime NOT NULL,
  `invoice_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `invoice_status` enum('COMPLETED','PARTIALLY PAID','PENDING') NOT NULL,
  `credit_type` int(11) NOT NULL,
  `po_id` varchar(255) NOT NULL,
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
-- Table structure for table `invoice_items`
--

CREATE TABLE `invoice_items` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  `total_amt` double NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `action_id`, `action`, `line`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 0, 'user', '2', 1, 0, '2017-05-11 08:21:08', '2017-05-11 06:21:08'),
(2, 0, 'user', '3', 1, 0, '2017-05-11 08:21:33', '2017-05-11 06:21:33'),
(3, 0, 'user', '4', 1, 0, '2017-05-11 08:22:09', '2017-05-11 06:22:09'),
(4, 0, 'user', '5', 1, 0, '2017-05-11 08:22:33', '2017-05-11 06:22:33'),
(5, 0, 'user', '6', 1, 0, '2017-05-11 08:23:09', '2017-05-11 06:23:09'),
(6, 0, 'dropdown', '5', 1, 0, '2017-05-11 08:26:57', '2017-05-11 06:26:57'),
(7, 0, 'dropdown', '6', 1, 0, '2017-05-11 08:29:06', '2017-05-11 06:29:06'),
(8, 0, 'dropdown', '7', 1, 0, '2017-05-11 08:29:30', '2017-05-11 06:29:30'),
(9, 0, 'dropdown', '8', 1, 0, '2017-05-11 08:29:41', '2017-05-11 06:29:41'),
(10, 0, 'dropdown', '9', 1, 0, '2017-05-11 08:29:59', '2017-05-11 06:29:59'),
(11, 0, 'dropdown', '10', 1, 0, '2017-05-11 08:30:12', '2017-05-11 06:30:12'),
(12, 0, 'dropdown', '11', 1, 0, '2017-05-11 08:30:19', '2017-05-11 06:30:19'),
(13, 0, 'dropdown', '12', 1, 0, '2017-05-11 08:30:28', '2017-05-11 06:30:28'),
(14, 0, 'dropdown', '13', 1, 0, '2017-05-11 08:30:38', '2017-05-11 06:30:38'),
(15, 0, 'dropdown', '14', 1, 0, '2017-05-11 08:42:31', '2017-05-11 06:42:31'),
(16, 0, 'dropdown', '15', 1, 0, '2017-05-11 08:47:26', '2017-05-11 06:47:26'),
(17, 0, 'dropdown', '16', 1, 0, '2017-05-11 08:50:21', '2017-05-11 06:50:21'),
(18, 1, ' Category <b>Category 1</b> has been inserted.', 'category', 1, 0, '2017-05-11 09:04:09', '2017-05-11 07:04:09'),
(19, 2, ' Category <b>Category 1</b> has been inserted.', 'category', 1, 0, '2017-05-11 09:04:17', '2017-05-11 07:04:17'),
(20, 2, ' Category <b>Category 2</b> has been updated.', 'category', 1, 0, '2017-05-11 09:04:24', '2017-05-11 07:04:25'),
(21, 3, ' Category <b>Category 3</b> has been inserted.', 'category', 1, 0, '2017-05-11 09:04:34', '2017-05-11 07:04:34'),
(22, 4, ' Category <b>Category 4</b> has been inserted.', 'category', 1, 0, '2017-05-11 09:04:45', '2017-05-11 07:04:45'),
(23, 5, ' Category <b>Category 5</b> has been inserted.', 'category', 1, 0, '2017-05-11 09:04:57', '2017-05-11 07:04:57'),
(24, 0, 'dropdown', '1', 1, 0, '2017-05-11 09:05:53', '2017-05-11 07:05:53'),
(25, 0, 'dropdown', '2', 1, 0, '2017-05-11 09:06:05', '2017-05-11 07:06:05'),
(26, 0, 'dropdown', '3', 1, 0, '2017-05-11 09:06:14', '2017-05-11 07:06:14'),
(27, 0, 'dropdown', '4', 1, 0, '2017-05-11 09:06:21', '2017-05-11 07:06:21'),
(28, 0, 'dropdown', '1', 1, 0, '2017-05-11 09:06:31', '2017-05-11 07:06:31'),
(29, 0, 'dropdown', '2', 1, 0, '2017-05-11 09:06:36', '2017-05-11 07:06:36'),
(30, 0, 'dropdown', '3', 1, 0, '2017-05-11 09:06:51', '2017-05-11 07:06:51'),
(31, 0, 'dropdown', '4', 1, 0, '2017-05-11 09:06:59', '2017-05-11 07:06:59'),
(32, 0, 'dropdown', '1', 1, 0, '2017-05-11 09:07:08', '2017-05-11 07:07:08'),
(33, 0, 'dropdown', '2', 1, 0, '2017-05-11 09:07:14', '2017-05-11 07:07:14'),
(34, 0, 'dropdown', '3', 1, 0, '2017-05-11 09:07:22', '2017-05-11 07:07:22'),
(35, 0, 'dropdown', '4', 1, 0, '2017-05-11 09:07:29', '2017-05-11 07:07:29'),
(36, 0, 'dropdown', '1', 1, 0, '2017-05-11 09:08:42', '2017-05-11 07:08:42'),
(37, 0, 'dropdown', '2', 1, 0, '2017-05-11 09:08:58', '2017-05-11 07:08:58'),
(38, 0, 'dropdown', '3', 1, 0, '2017-05-11 09:09:15', '2017-05-11 07:09:15'),
(39, 0, 'dropdown', '5', 1, 0, '2017-05-11 09:10:02', '2017-05-11 07:10:02'),
(40, 0, 'dropdown', '17', 1, 0, '2017-05-11 09:13:11', '2017-05-11 07:13:11'),
(41, 1, 'Product <b>Product 1</b> has been inserted.', 'inventory', 1, 0, '2017-05-11 09:18:24', '2017-05-11 07:18:24'),
(42, 2, 'Product <b>Product 2</b> has been inserted.', 'inventory', 1, 0, '2017-05-11 09:21:37', '2017-05-11 07:21:37'),
(43, 3, 'Product <b>Product 3</b> has been inserted.', 'inventory', 1, 0, '2017-05-11 09:23:58', '2017-05-11 07:23:58'),
(44, 4, 'Product <b>Product 4</b> has been inserted.', 'inventory', 1, 0, '2017-05-11 09:25:13', '2017-05-11 07:25:13'),
(45, 5, 'Product <b>Product 5</b> has been inserted.', 'inventory', 1, 0, '2017-05-11 09:27:11', '2017-05-11 07:27:11'),
(46, 10001, '<b>#10001</b> Purchase Order has been created.', 'purchase_order', 1, 0, '2017-05-11 14:09:38', '2017-05-11 12:09:38'),
(47, 10001, '<b>#10001</b> Purchase Order status has been updated.', 'purchase_order', 1, 0, '2017-05-11 14:16:10', '2017-05-11 12:16:10'),
(48, 10001, '<b>#10001</b> Product Product 1 has been updated with quantity 2.', 'purchase_order', 1, 0, '2017-05-11 14:20:41', '2017-05-11 12:20:41'),
(49, 10001, '<b>#10001</b> Product <b>Product 1</b> has been updated with quantity 2.', 'purchase_order', 1, 0, '2017-05-11 15:23:18', '2017-05-11 13:23:18'),
(50, 10001, '<b>#10001</b> Product <b>Product 2</b> has been updated with quantity 3.', 'purchase_order', 1, 0, '2017-05-11 15:23:18', '2017-05-11 13:23:18'),
(51, 10001, '#10001 Product <b>Product 2</b> has been added with quantity 1.', 'purchase_order', 1, 0, '2017-05-11 15:26:37', '2017-05-11 13:26:37'),
(53, 10001, '#10001 Product <b>Product 2</b> has been added with quantity 1.', 'purchase_order', 1, 0, '2017-05-11 15:29:46', '2017-05-11 13:29:46'),
(54, 10001, '<b>#10001</b> Product <b>Product 2</b> has been deleted.', 'purchase_order', 1, 0, '2017-05-11 15:29:59', '2017-05-11 13:29:59'),
(55, 90001, '<b>#90001</b> Sales Order has been created.', 'sales_order', 1, 0, '2017-05-11 15:31:26', '2017-05-11 13:31:26'),
(56, 90001, '#90001 Product <b>Product 4</b> has been added with quantity 1.', 'sales_order', 1, 0, '2017-05-11 15:35:05', '2017-05-11 13:35:05'),
(57, 90001, '<b>#90001</b> Product <b>Product 1</b> has been updated with quantity 2.', 'sales_order', 1, 0, '2017-05-11 15:36:56', '2017-05-11 13:36:56'),
(58, 90001, '<b>#90001</b> Product <b>Product 2</b> has been updated with quantity 2.', 'sales_order', 1, 0, '2017-05-11 15:36:56', '2017-05-11 13:36:56'),
(59, 90001, '<b>#90001</b> Product <b>Product 4</b> has been updated with quantity 1.', 'sales_order', 1, 0, '2017-05-11 15:36:56', '2017-05-11 13:36:56'),
(60, 90001, '<b>#90001</b> Product <b>Product 4</b> has been deleted.', 'sales_order', 1, 0, '2017-05-11 15:37:35', '2017-05-11 13:37:35');

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

-- --------------------------------------------------------

--
-- Table structure for table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `shipment_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `sales_order_id` int(11) DEFAULT NULL,
  `refund_id` int(11) DEFAULT NULL,
  `return_id` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Table structure for table `ordered_address`
--

CREATE TABLE `ordered_address` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address1` varchar(255) NOT NULL,
  `address2` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` int(11) NOT NULL,
  `country` int(11) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ordered_address`
--

INSERT INTO `ordered_address` (`id`, `name`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `email`) VALUES
(1, 'Houston Location', '6611', '6611', 'Houston', 2, 2, '77041', '9876543210', 'purchase@independentplastics.com'),
(2, '3D Plastics', '2701', 'East 2nd Street', 'Newberg', 5, 2, '97132', '34324234', '');

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
(1, NULL, 1, 'PRP1', 'Product 1', 2, 1, 1, 1, ' ', ' ', ' 10', '1', 100, 100, 100, '99.00', '79.00', '0.00', '', '', '', '', 1, 'Yes', 'Yes', 'Yes', 'Yes', 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '1', '1', 1, 0, '2017-05-11 09:18:24', '2017-05-11 03:48:24'),
(2, NULL, 2, 'PRP2', 'Product 2', 3, 2, 2, 3, ' ', ' ', ' ', '3', 10, 10, 10, '19.00', '12.00', '0.00', '', '', '', '', 3, 'No', 'No', 'No', 'No', 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '1', '1', 1, 0, '2017-05-11 09:21:37', '2017-05-11 03:51:37'),
(3, NULL, 3, 'PRP3', 'Product 3', 5, 4, 3, 3, '  ', '  ', '  ', '21', 800, 100, 100, '159.00', '129.00', '0.00', '', '', '', '', 2, 'No', 'No', 'No', 'No', 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '', '1', 1, 0, '2017-05-11 09:23:58', '2017-05-11 03:53:58'),
(4, NULL, 4, 'PRP4', 'Product 4', 1, 1, 4, 3, ' ', ' ', ' ', '15', 50, 50, 50, '69.00', '59.00', '0.00', '', '', '', '', 1, 'No', 'No', 'No', 'No', 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '', '1', 1, 0, '2017-05-11 09:25:13', '2017-05-11 03:55:13'),
(5, NULL, 5, 'PRP5', 'Product 5', 3, 2, 2, 2, ' ', ' ', ' ', '87', 1000, 1000, 1000, '399.00', '389.00', '0.00', '', '', '', '', 2, 'No', 'No', 'No', 'No', 0, 0, 0, '0.00', '0.00', '0.00', '0.00', '', '1', 1, 0, '2017-05-11 09:27:11', '2017-05-11 03:57:11');

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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_color`
--

INSERT INTO `product_color` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Natural', '1', 1, 1, '2017-05-11 09:07:08', '2017-05-11 03:37:08'),
(2, 'Clear', '1', 1, 1, '2017-05-11 09:07:14', '2017-05-11 03:37:14'),
(3, 'Black', '1', 1, 1, '2017-05-11 09:07:22', '2017-05-11 03:37:22'),
(4, 'White', '1', 1, 1, '2017-05-11 09:07:29', '2017-05-11 03:37:29');

-- --------------------------------------------------------

--
-- Table structure for table `product_form`
--

CREATE TABLE `product_form` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_form`
--

INSERT INTO `product_form` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Comp', '1', 1, 1, '2017-05-11 09:06:31', '2017-05-11 03:36:31'),
(2, 'Parts', '1', 1, 1, '2017-05-11 09:06:36', '2017-05-11 03:36:36'),
(3, 'Powder', '1', 1, 1, '2017-05-11 09:06:51', '2017-05-11 03:36:51'),
(4, 'Regrind', '1', 1, 1, '2017-05-11 09:06:58', '2017-05-11 03:36:58'),
(5, 'Virgin', '1', 1, 1, '2017-05-11 09:10:02', '2017-05-11 03:40:02');

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

-- --------------------------------------------------------

--
-- Table structure for table `product_packaging`
--

CREATE TABLE `product_packaging` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_packaging`
--

INSERT INTO `product_packaging` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Gaylord', '1', 1, 1, '2017-05-11 09:05:53', '2017-05-11 03:35:53'),
(2, 'Bags', '1', 1, 1, '2017-05-11 09:06:05', '2017-05-11 03:36:05'),
(3, 'Drums', '1', 1, 1, '2017-05-11 09:06:14', '2017-05-11 03:36:14'),
(4, 'Boxes', '1', 1, 1, '2017-05-11 09:06:21', '2017-05-11 03:36:21');

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_type`
--

INSERT INTO `product_type` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, '12', '1', 1, 1, '2017-05-11 09:08:41', '2017-05-11 03:38:41'),
(2, '16.25 Melt 12 IZOD', '1', 1, 1, '2017-05-11 09:08:58', '2017-05-11 03:38:58'),
(3, 'Pulse 2000EZ', '1', 1, 1, '2017-05-11 09:09:15', '2017-05-11 03:39:15');

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
  `ordered_address_id` int(11) NOT NULL,
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

INSERT INTO `purchase_order` (`id`, `vendor_id`, `order_status`, `total_amount`, `so_id`, `accounts_person_id`, `pickup_date`, `estimated_delivery`, `release_to_sold`, `po_message`, `note`, `is_vendor_stock_level_updated`, `is_paid`, `ordered_address_id`, `ship_type_id`, `carrier_id`, `credit_type_id`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(10001, 1, 'NEW', 158, 0, 0, '2017-05-11 00:00:00', '2017-05-23 00:00:00', 'No', 'Test', 'Test', 'No', 'NOT PAID', 1, 1, 2, 6, 'COMPLETED', 1, 1, '2017-05-11 14:09:38', '2017-05-11 08:39:38');

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
(1, 10001, 1, 'PRP1', 'Product 1', 'NEW', 79, 2, 0, 0, 1, '0000-00-00 00:00:00', '2017-05-11 08:50:41');

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
(2, 0, 2, '{"dashboard":"1","sales":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-21 13:44:08', '2017-03-21 12:44:08'),
(3, 0, 3, '{"dashboard":"1","purchase":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:51:59', '2017-03-22 06:51:59'),
(4, 0, 4, '{"dashboard":"1","inventory":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:52:10', '2017-03-22 06:52:10'),
(5, 0, 5, '{"dashboard":"1","accounting":"1","reports":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-22 07:52:22', '2017-03-22 06:52:22'),
(6, 0, 1, '{"dashboard":"1","sales":"1","purchase":"1","inventory":"1","accounting":"1","admin":"1","reports":"1"}', '{"create":"1","edit":"1","delete":"1","view":"1"}', '2017-03-25 07:51:01', '2017-03-25 02:29:03');

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `salesman_id` int(11) NOT NULL,
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
  `type` enum('SALE','PURCHASE','RETURN') NOT NULL,
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
  `freight_paid` float NOT NULL,
  `add_amount` float NOT NULL,
  `amount` float NOT NULL,
  `order_address_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `customer_id`, `salesman_id`, `contact_id`, `order_status`, `total_amount`, `total_discount`, `total_shipping`, `total_tax`, `total_items`, `shipping_type`, `credit_type`, `cod_fee`, `carrier_id`, `type`, `total_weight`, `bol_instructions`, `so_instructions`, `so_printed`, `bol_printed`, `received_inventory`, `return_type`, `inventory_person`, `shipping_address_id`, `billing_address_id`, `freight_paid`, `add_amount`, `amount`, `order_address_id`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(90001, 1, 1, 0, 'NEW', 182, 0, 0, 0, 2, 1, 2, 0, 2, 'SALE', '0.00', 'Test', 'Test', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 1, 1, 0, 0, 0, 2, 1, 1, '2017-05-11 15:31:25', '2017-05-11 10:01:25');

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

--
-- Dumping data for table `sales_order_item`
--

INSERT INTO `sales_order_item` (`id`, `product_id`, `item_status`, `unit_price`, `qty`, `so_id`, `vendor_id`, `shipment_id`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 'NEW', 79, 2, 90001, 1, 1, 1, 1, '2017-05-11 15:31:25', '2017-05-11 10:01:25'),
(2, 2, 'NEW', 12, 2, 90001, 1, 1, 1, 1, '2017-05-11 15:31:25', '2017-05-11 10:01:25');

-- --------------------------------------------------------

--
-- Table structure for table `sale_type`
--

CREATE TABLE `sale_type` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_type`
--

INSERT INTO `sale_type` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'SALE', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-28 13:33:34'),
(2, 'PURCHASE', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-28 13:33:52'),
(3, 'RETURN', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-28 13:33:52');

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
(1, 90001, '1', 2, '2', 'NEW', '', 0, '2017-05-11 15:31:25', 1, 1, '2017-05-11 15:31:25', '2017-05-11 10:01:25');

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
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`id`, `state_code`, `name`, `country_code`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'AZ', 'Arizona', 'US', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:07'),
(2, 'TX', 'Texas', 'US', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:07'),
(3, 'DC', 'Washington DC', 'US', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:20:07'),
(4, '', 'North Carolina', '', '1', 1, 1, '2017-03-24 06:20:42', '2017-03-24 00:50:42'),
(5, '', 'Oregon', '', '1', 1, 1, '2017-05-11 08:26:57', '2017-05-11 02:56:57'),
(6, '', 'Alabama', '', '1', 1, 1, '2017-05-11 08:29:06', '2017-05-11 02:59:06'),
(7, '', 'Alaska', '', '1', 1, 1, '2017-05-11 08:29:30', '2017-05-11 02:59:30'),
(8, '', 'American Samoa', '', '1', 1, 1, '2017-05-11 08:29:41', '2017-05-11 02:59:41'),
(9, '', 'Arkansas', '', '1', 1, 1, '2017-05-11 08:29:59', '2017-05-11 02:59:59'),
(10, '', 'Colorado', '', '1', 1, 1, '2017-05-11 08:30:12', '2017-05-11 03:00:12'),
(11, '', 'California', '', '1', 1, 1, '2017-05-11 08:30:19', '2017-05-11 03:00:19'),
(12, '', 'Connecticut', '', '1', 1, 1, '2017-05-11 08:30:28', '2017-05-11 03:00:28'),
(13, '', 'Delaware', '', '1', 1, 1, '2017-05-11 08:30:38', '2017-05-11 03:00:38'),
(14, '', 'Michigan', '', '1', 1, 1, '2017-05-11 08:42:31', '2017-05-11 03:12:31'),
(15, '', 'Idaho', '', '1', 1, 1, '2017-05-11 08:47:26', '2017-05-11 03:17:26'),
(16, '', 'Florida', '', '1', 1, 1, '2017-05-11 08:50:21', '2017-05-11 03:20:21'),
(17, '', 'Indiana', '', '1', 1, 1, '2017-05-11 09:13:11', '2017-05-11 03:43:11');

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
(3, 'MST', '', '1', 1, 1, '2017-03-22 13:36:48', '2017-03-22 08:06:48'),
(4, 'PST', '', '1', 1, 1, '2017-03-24 06:19:24', '2017-03-24 00:49:24');

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
(1, 1, 1, 'PRP1', '99.00', 1, 'Yes', 41, '1', '0.00', 'ups', '0.00', 0, 0, 0, '2017-05-11 07:19:29', '2017-05-11 07:19:29'),
(2, 1, 2, 'PRP3', '11.00', 1, 'Yes', 2, '1', '3.00', 'fedex', '0.00', 0, 0, 0, '2017-05-11 07:22:49', '2017-05-11 07:22:49'),
(3, 4, 3, 'PRPV3', '139.00', 1, 'Yes', 1, '1', '18.00', 'freight', '0.00', 0, 0, 0, '2017-05-11 07:24:23', '2017-05-11 07:24:23'),
(4, 2, 4, 'PRPV4', '75.00', 1, 'Yes', 1, '1', '11.00', 'usps', '0.00', 0, 0, 0, '2017-05-11 07:25:39', '2017-05-11 07:25:39'),
(5, 2, 5, 'PRPV5', '394.00', 1, 'Yes', 400, '1', '20.00', 'usps', '0.00', 0, 0, 0, '2017-05-11 07:27:44', '2017-05-11 07:27:44');

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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Houston Location', '6611', '6611', 'Houston', 2, '2', '77041', '9876543210', 'purchase@independentplastics.com', '1', '2017-05-11 09:12:44', '2017-05-11 07:12:44'),
(2, 'New Castle', '2750', '2750', 'Bloomington', 17, '2', '47401', '9876543210', 'newcastle@purchase.com', '1', '2017-05-11 09:15:48', '2017-05-11 07:15:48'),
(3, 'Pearland', '875', '875', 'Pearland', 2, '2', '77581', '1541651561', 'pearland@purchase.com', '1', '2017-05-11 09:17:24', '2017-05-11 07:17:24');

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
-- Indexes for table `invoice_items`
--
ALTER TABLE `invoice_items`
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
-- Indexes for table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_note_shipment` (`shipment_id`),
  ADD KEY `fk_note_vendor` (`vendor_id`),
  ADD KEY `fk_note_purchase` (`purchase_order_id`),
  ADD KEY `fk_note_sale` (`sales_order_id`),
  ADD KEY `fk_note_admin` (`admin_id`);

--
-- Indexes for table `operator_selection`
--
ALTER TABLE `operator_selection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ordered_address`
--
ALTER TABLE `ordered_address`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `credit_type`
--
ALTER TABLE `credit_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `customer_location`
--
ALTER TABLE `customer_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `min_level`
--
ALTER TABLE `min_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `operator_selection`
--
ALTER TABLE `operator_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ordered_address`
--
ALTER TABLE `ordered_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `page_titles`
--
ALTER TABLE `page_titles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_form`
--
ALTER TABLE `product_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_packaging`
--
ALTER TABLE `product_packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10002;
--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90002;
--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sale_type`
--
ALTER TABLE `sale_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `vendor_price_list`
--
ALTER TABLE `vendor_price_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `week_days_operate`
--
ALTER TABLE `week_days_operate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
