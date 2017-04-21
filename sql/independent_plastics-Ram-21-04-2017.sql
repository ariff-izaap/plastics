-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2017 at 04:42 PM
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
(1, 'Ramkumar Bill', 'Ram', 'Bill', '', 'Bill Address 1', 'Bill Address 2', 'Bill City', 'Arizona', 'United States of America', '58512', '58512', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00');

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
  `status` enum('1','0') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='vendors';

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `business_name`, `credit_type`, `web_url`, `ups`, `address_id`, `status`, `created_date`, `updated_date`) VALUES
(1, 'Ramkumar', 5, '', '', 1, '1', '0000-00-00 00:00:00', '2017-04-20 09:28:00');

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
(1, 1, 'Ramkumar Contact', 1, '123467890', 'ramkumar@contact.com', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00');

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
(1, 1, 'Ram Loc', 'Loc Address 1', 'Loc Address 2', '', 'Loc City', 'Texas', 'United States of America', '85554', '1,2', 2, '09:30:00', '18:30:00', 1, '0000-00-00 00:00:00', '2017-04-20 09:28:00');

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
  `invoice_status` enum('COMPLETED','PARTIALLY PAID') NOT NULL,
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

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `customer_id`, `shipment_id`, `location_id`, `billing_id`, `salesman_id`, `ship_date`, `invoice_date`, `due_date`, `invoice_status`, `credit_type`, `po_id`, `amount`, `prepaid_cod`, `fright_amt`, `additional_amt`, `total_amt`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, '6783', 1, 3, 1, 1, 1, '2017-04-20 00:00:00', '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'PARTIALLY PAID', 6, '', 298, 0, 0, 0, 298, 1, 1, '2017-04-20 13:11:12', '2017-04-20 11:12:44');

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

--
-- Dumping data for table `invoice_items`
--

INSERT INTO `invoice_items` (`id`, `invoice_id`, `so_id`, `product_id`, `quantity`, `unit_price`, `total_amt`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 16, 2, 139, 278, '0000-00-00 00:00:00', '2017-04-20 11:11:12'),
(2, 1, 1, 17, 2, 10, 20, '0000-00-00 00:00:00', '2017-04-20 11:11:12');

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
(1, 1, '<strong></strong> Sales Order has been inserted', 'Sales Order Insertion', 1, 0, '2017-04-20 11:28:53', '2017-04-20 14:58:53'),
(2, 1, '<strong></strong> Create Shipment has been inserted', 'Create Shipment Insertion', 1, 0, '2017-04-20 11:28:53', '2017-04-20 14:58:53'),
(3, 1, '<strong></strong> Sales Order Item has been inserted', 'Sales Order Item Insertion', 1, 0, '2017-04-20 11:28:53', '2017-04-20 14:58:53'),
(4, 2, '<strong></strong> Sales Order Item has been inserted', 'Sales Order Item Insertion', 1, 0, '2017-04-20 11:28:54', '2017-04-20 14:58:54'),
(17, 1, '<strong>#6783</strong> invoices has been inserted', 'invoice', 1, 0, '2017-04-20 13:11:12', '2017-04-20 16:41:12'),
(18, 1, '<strong>#6783</strong> invoice has been updated to <b>PARTIALLY PAID</b>', 'invoice', 1, 0, '2017-04-20 13:12:44', '2017-04-20 16:42:44'),
(19, 1, '<b>Need to Pay $10</b>', 'invoice_comments', 1, 0, '2017-04-20 13:12:44', '2017-04-20 16:42:44'),
(20, 1, '<strong>#1</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-20 13:38:05', '2017-04-20 17:08:05'),
(21, 4, '<strong>Warning 4</strong> warning has been inserted', 'warning', 1, 0, '2017-04-21 14:21:50', '2017-04-21 17:51:50'),
(22, 4, '<strong>Warning 4</strong> warning has been updated', 'warning', 1, 0, '2017-04-21 14:24:03', '2017-04-21 17:54:03'),
(23, 4, '<strong>Warning 4</strong> warning has been updated', 'warning', 1, 0, '2017-04-21 14:39:24', '2017-04-21 18:09:24'),
(24, 3, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 15:05:00', '2017-04-21 18:35:00'),
(25, 8, '<strong>#8</strong> purchase order has been deleted', 'purchase', 1, 0, '2017-04-21 15:05:46', '2017-04-21 18:35:46'),
(26, 3, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 15:09:27', '2017-04-21 18:39:27'),
(27, 3, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 15:12:44', '2017-04-21 18:42:44'),
(28, 2, '<strong>#2</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 15:16:34', '2017-04-21 18:46:34'),
(29, 3, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 15:56:27', '2017-04-21 19:26:27'),
(30, 2, '<strong>#2</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 16:00:04', '2017-04-21 19:30:04'),
(31, 2, '<strong>#2</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 16:01:55', '2017-04-21 19:31:55'),
(32, 2, '<strong>#2</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 16:02:49', '2017-04-21 19:32:49'),
(33, 2, '<strong>#2</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-21 16:04:54', '2017-04-21 19:34:54');

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
(3, 'Warning 3', 'Warning 3', 4, 2, 3, 4, '', '', 2, 1, 1, 0, '2017-03-21 12:00:11', '2017-03-21 11:00:11'),
(4, 'Warning 4', 'Can''t add', 17, 2, 1, 2, '', '', 3, 4, 1, 1, '2017-04-21 14:39:24', '2017-04-21 09:09:24');

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

--
-- Dumping data for table `note`
--

INSERT INTO `note` (`id`, `admin_id`, `shipment_id`, `vendor_id`, `purchase_order_id`, `sales_order_id`, `refund_id`, `return_id`, `created`, `message`) VALUES
(1, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:19:52', 'Teddsds'),
(2, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:22:01', 'Teddsds'),
(3, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:26:25', 'Dfddfdffd'),
(4, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:27:14', 'xccvcvvccv'),
(5, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:28:12', 'Tedsdsdfd'),
(6, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:29:36', 'dfvbhgbnbnnb'),
(7, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:33:23', 'cxcccxxcxccx'),
(8, 0, NULL, NULL, NULL, NULL, NULL, 0, '2017-04-06 06:34:38', 'Tffdfdf');

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
(1, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '4546', '4454156465', 'test@gmail.com'),
(2, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(3, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(4, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(5, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(6, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(7, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(8, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(9, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(10, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(11, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(12, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com');

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
(2, NULL, 1, 'dds', 'Tes', 2, 1, 2, 2, 'Tfffd', ' dffd', ' dfdf', '2', 5, 2, 0, '12.00', '25.00', '0.00', '12', '1', '12', '', 1, 'Yes', 'No', 'Yes', 'No', 12, 121, 12, '0.00', '0.00', '0.00', '15.00', '0', '1', 1, 0, '2017-03-06 13:35:35', '2017-03-06 08:05:35'),
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
(13, NULL, 2, 'df', 'ddf', 2, 1, 2, 3, ' dffd', ' fddf', ' dffd', '25', 2, 21, 0, '221.00', '21.00', '0.00', '11', '23', '56', '', 1, 'Yes', 'No', 'Yes', 'No', 235, 2, 32, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 12:53:40', '2017-03-07 07:23:40'),
(14, NULL, 1, 'sdds', 'ds', 4, 1, 2, 0, ' dsd', ' dsds', ' sdffd', '25', 54, 54, 0, '54.00', '5454.00', '0.00', '554', '54', '54', '', 1, 'Yes', 'No', 'Yes', 'No', 125, 56, 56, '0.00', '0.00', '0.00', '65.00', '0', '1', 1, 0, '2017-03-07 13:08:58', '2017-03-07 07:38:58'),
(15, NULL, 2, 'fggf', 'gfgf', 3, 1, 1, 1, ' fggf', ' ggf', ' gfgf', '1', 2, 21, 0, '21.00', '212.00', '0.00', '21', '2', '21', 'RFP_(2).docx', 1, 'Yes', 'No', 'Yes', 'No', 25, 325, 232, '0.00', '0.00', '0.00', '23.00', '0', '1', 1, 0, '2017-03-07 13:52:45', '2017-03-07 08:22:45'),
(16, NULL, 1, 'PRP3', 'Product 3', 1, 2, 1, 1, ' Product 3', ' Product 3', ' Product 3', '3', 150, 150, 0, '149.00', '139.00', '0.00', '12345', '98657', '546456', '', 1, 'Yes', 'Yes', 'Yes', 'Yes', 4, 4, 0, '0.00', '0.00', '0.00', '120.00', '0', '1', 1, 0, '2017-03-08 07:48:16', '2017-03-08 02:18:16'),
(17, NULL, 1, 'PRP4', 'Product 4', 2, 2, 1, 2, '   ', '   ', '   ', '1', 1, 12, 0, '29.00', '49.00', '0.00', '', '', '', '', 0, 'Yes', 'Yes', 'Yes', 'Yes', 0, 0, 0, '0.00', '0.00', '0.00', '12.00', '1', '1', 1, 0, '2017-03-15 07:21:04', '2017-03-15 01:51:04');

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
(3, 'Green', '1', 1, 1, '2017-03-14 12:11:21', '2017-03-14 12:11:21'),
(4, 'Yellow', '1', 1, 1, '2017-03-24 06:15:12', '2017-03-24 06:15:12');

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
(1, 'Comp', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:16:09'),
(2, 'Powder', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:16:09'),
(3, 'Parts', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:16:09'),
(4, 'Regrind', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:16:09'),
(5, 'Form 1', '1', 1, 1, '2017-03-24 06:16:14', '2017-03-24 00:46:14');

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
(1, 'Bags', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:14:45'),
(2, 'Graylord', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-25 06:54:51'),
(3, 'Tst', '0', 0, 0, '0000-00-00 00:00:00', '2017-03-25 07:02:37'),
(4, 'Test', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:14:45'),
(5, 'Test 1', '1', 1, 1, '2017-03-24 06:14:52', '2017-03-24 00:44:52');

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
(1, 'Type 2', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:17:09'),
(2, 'Pulse', '1', 0, 0, '0000-00-00 00:00:00', '2017-03-24 05:17:09'),
(3, 'Type 1', '1', 1, 1, '2017-03-24 06:17:14', '2017-03-24 00:47:14');

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
(1, 1, 'NEW', 147, 0, 0, '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'No', 'Noi', 'Noi', 'No', 'NOT PAID', 1, 1, 3, 5, 'COMPLETED', 1, 1, '2017-04-20 13:35:25', '2017-04-20 08:08:05'),
(2, 1, 'NEW', 147, 0, 0, '2017-04-21 00:00:00', '2017-04-23 00:00:00', 'No', '', '', 'No', 'NULL', 12, 2, 3, 7, 'COMPLETED', 0, 1, '0000-00-00 00:00:00', '2017-04-21 10:34:54');

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
(2, 1, 17, '', 'Product 4', 'NEW', 49, 3, 0, 1, 1, '2017-04-20 13:36:37', '2017-04-20 11:36:37'),
(22, 2, 17, 'PRP4', 'Product 4', 'NEW', 49, 3, 0, 1, 1, '2017-04-21 16:04:54', '2017-04-21 14:04:54');

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
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sales_order`
--

INSERT INTO `sales_order` (`id`, `customer_id`, `salesman_id`, `contact_id`, `order_status`, `total_amount`, `total_discount`, `total_shipping`, `total_tax`, `total_items`, `shipping_type`, `credit_type`, `cod_fee`, `carrier_id`, `type`, `total_weight`, `bol_instructions`, `so_instructions`, `so_printed`, `bol_printed`, `received_inventory`, `return_type`, `inventory_person`, `shipping_address_id`, `billing_address_id`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 0, 'NEW', 298, 0, 0, 0, 4, 1, 6, 0, 3, 'SALE', '0.00', 'BOL New', 'SO New', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 1, 1, 1, 0, '2017-04-20 11:28:53', '2017-04-20 05:58:53');

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
(1, 16, 'NEW', 139, 2, 1, 2, 1, 1, 0, '2017-04-20 11:28:53', '2017-04-20 05:58:53'),
(2, 17, 'NEW', 10, 2, 1, 1, 1, 1, 0, '2017-04-20 11:28:53', '2017-04-20 05:58:53');

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
(1, 1, 'Standard 2-6 days', 0, '', 'NEW', '', 0, '2017-04-20 14:00:00', 1, 0, '2017-04-20 11:28:53', '2017-04-20 05:58:53');

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
(4, '', 'North Carolina', '', '1', 1, 1, '2017-03-24 06:20:42', '2017-03-24 00:50:42');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `invoice_items`
--
ALTER TABLE `invoice_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `min_level`
--
ALTER TABLE `min_level`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `operator_selection`
--
ALTER TABLE `operator_selection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ordered_address`
--
ALTER TABLE `ordered_address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `product_packaging`
--
ALTER TABLE `product_packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
