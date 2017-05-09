-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2017 at 07:18 AM
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
(1, 'Ramkumar Bill', 'Ram', 'Bill', '', 'Bill Address 1', 'Bill Address 2', 'Bill City', 'Arizona', 'United States of America', '58512', '58512', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00'),
(2, 'Punitha Bill', 'Punitha', 'Bill', '', 'Bill Address 1', 'Bill Address 2', 'Bill City', 'Texas', 'United States of America', '58512', '58512', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00');

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
(2, 'Ramkumar', 'Izaap', 'ramkumar', 'RAMKUMARIZAAP', 'ramkumar.izaap@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', 2, '1', 1, 1, '2017-03-22 08:25:13', '2017-03-22 02:55:13');

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

--
-- Dumping data for table `call_logs`
--

INSERT INTO `call_logs` (`id`, `user_id`, `call_type`, `customer_id`, `log_date`, `call_log`, `created_date`, `updated_date`) VALUES
(1, 1, 1, 1, '2017-05-02 00:00:00', 'ASFDSF', '2017-05-02 18:13:15', '2017-05-02 12:43:15'),
(4, 2, 2, 1, '2017-05-08 03:00:00', 'sadasdsvfxfv', '2017-05-08 09:41:24', '2017-05-08 04:11:24');

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
(1, NULL, 'Test', 'Test', '', '2017-02-24 06:46:36', '2017-02-24 01:16:36', 1),
(2, NULL, 'Demo', 'Demo', '', '2017-03-06 09:04:16', '2017-03-06 03:34:16', 1);

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
(1, 'Ramkumar', 5, 'asd', '', 1, 'asdsad;sadsad;adasd;adsad;gfnvnvn;sadad;', '1', '0000-00-00 00:00:00', '2017-04-20 09:28:00'),
(2, 'Punitha', 5, '', '', 2, 'fdfds;;;;', '1', '0000-00-00 00:00:00', '2017-04-20 09:28:00');

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
(1, 1, 'Ramkumar Contact', 1, '123467890', 'ramkumar@contact.com', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00'),
(2, 2, 'Punitha Contact', 1, '123467890', 'punitha@contact.com', 1, 1, '2017-04-20 11:28:00', '2017-04-20 09:28:00');

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
(1, 1, 'Ram Loc', 'Loc Address 1', 'Loc Address 2', '4546', 'Loc City', 'Texas', 'United States of America', '85554', '1,2', 2, '09:30:00', '18:30:00', 1, '0000-00-00 00:00:00', '2017-04-20 09:28:00'),
(2, 2, 'Pun Loc', '40, Third Floor', 'Suite Apt', '4454156465', 'Scottsdale', 'Scottsdale', 'United States of America', '12452', '1,2', 2, '09:30:00', '18:30:00', 1, '2017-04-27 06:26:47', '2017-04-27 00:56:47');

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

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_no`, `customer_id`, `shipment_id`, `location_id`, `billing_id`, `salesman_id`, `ship_date`, `invoice_date`, `due_date`, `invoice_status`, `credit_type`, `po_id`, `amount`, `prepaid_cod`, `fright_amt`, `additional_amt`, `total_amt`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, '24769', 2, 1, 2, 2, 1, '2017-04-25 00:00:00', '2017-04-26 00:00:00', '2017-04-26 00:00:00', 'PENDING', 2, '', 2120, 0, 0, 0, 2120, 1, 1, '2017-04-26 13:00:17', '2017-04-27 15:21:48');

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
(1, 1, 2, 15, 10, 212, 2120, '0000-00-00 00:00:00', '2017-04-26 11:00:17');

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
(1, 3, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-22 14:06:49', '2017-04-22 12:06:49'),
(2, 24, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-22 14:12:28', '2017-04-22 12:12:28'),
(3, 25, '<strong>#</strong> purchase order has been inserted', 'purchase', 1, 0, '2017-04-22 15:03:02', '2017-04-22 13:03:02'),
(4, 4, 'Purchase Order Status has been changed to <b>PROCESSING</b>', 'purchase_status', 1, 0, '2017-04-24 07:58:05', '2017-04-24 05:58:05'),
(5, 4, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-24 08:45:43', '2017-04-24 06:45:43'),
(6, 4, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-24 08:46:31', '2017-04-24 06:46:31'),
(7, 4, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-24 08:47:17', '2017-04-24 06:47:17'),
(8, 4, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-24 08:48:17', '2017-04-24 06:48:17'),
(9, 1, 'Received Quantity <b>2</b>', 'purchase_qty', 1, 0, '2017-04-24 08:50:00', '2017-04-24 06:50:00'),
(10, 4, 'Purchase Order Status has been changed to <b>ACCEPTED</b>', 'purchase_status', 1, 0, '2017-04-24 09:23:45', '2017-04-24 07:23:45'),
(11, 4, 'Purchase Order Status has been changed to <b>NEW</b>', 'purchase_status', 1, 0, '2017-04-24 09:23:55', '2017-04-24 07:23:55'),
(12, 5, 'Purchase Order Status has been changed to <b>ACCEPTED</b>', 'purchase_status', 1, 0, '2017-04-24 14:22:24', '2017-04-24 12:22:24'),
(13, 5, 'Received Quantity <b>0</b>', 'purchase_qty', 1, 0, '2017-04-24 15:04:45', '2017-04-24 13:04:45'),
(14, 5, 'Purchase Order Status has been changed to <b>ACCEPTED</b>', 'purchase_status', 1, 0, '2017-04-24 15:17:40', '2017-04-24 13:17:40'),
(15, 5, 'Purchase Order Status has been changed to <b>NEW</b>', 'purchase_status', 1, 0, '2017-04-24 15:22:19', '2017-04-24 13:22:19'),
(16, 5, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-24 15:34:30', '2017-04-24 13:34:30'),
(18, 5, '<strong>#5</strong> purchase order has been updated', 'purchase', 1, 0, '2017-04-25 08:16:10', '2017-04-25 06:16:10'),
(19, 5, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-25 08:40:47', '2017-04-25 06:40:47'),
(20, 5, 'Received Quantity <b>1</b>', 'purchase_qty', 1, 0, '2017-04-25 08:40:47', '2017-04-25 06:40:47'),
(21, 5, 'Received Quantity for Product 4 <b>1</b>', 'purchase_order', 1, 0, '2017-04-25 09:06:14', '2017-04-25 07:06:14'),
(22, 5, 'Quantity #<b>2</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:11:53', '2017-04-25 07:11:53'),
(23, 5, 'Quantity #<b>2</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:12:03', '2017-04-25 07:12:03'),
(24, 5, 'Quantity #<b>1</b> received for gfgf', 'purchase_order', 1, 0, '2017-04-25 09:12:03', '2017-04-25 07:12:03'),
(25, 5, 'Quantity #<b>1</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:12:31', '2017-04-25 07:12:31'),
(26, 5, 'Quantity #<b>1</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:12:56', '2017-04-25 07:12:56'),
(27, 5, 'Quantity #<b>1</b> received for gfgf', 'purchase_order', 1, 0, '2017-04-25 09:12:57', '2017-04-25 07:12:57'),
(28, 5, 'Quantity #<b>2</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:13:34', '2017-04-25 07:13:34'),
(29, 5, 'Quantity #<b>1</b> received for gfgf', 'purchase_order', 1, 0, '2017-04-25 09:13:34', '2017-04-25 07:13:34'),
(30, 5, 'Quantity #<b>1</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:17:41', '2017-04-25 07:17:41'),
(31, 5, 'Quantity #<b>1</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:17:49', '2017-04-25 07:17:49'),
(32, 5, 'Quantity #<b>1</b> received for gfgf', 'purchase_order', 1, 0, '2017-04-25 09:19:11', '2017-04-25 07:19:11'),
(33, 5, 'Quantity #<b>2</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 09:35:51', '2017-04-25 07:35:51'),
(34, 0, 'purchase', '5', 1, 0, '2017-04-25 09:55:13', '2017-04-25 07:55:13'),
(35, 0, 'purchase', '5', 1, 0, '2017-04-25 09:55:19', '2017-04-25 07:55:19'),
(36, 5, 'Quantity #<b>2</b> added for Product 4', 'purchase_order', 1, 0, '2017-04-25 10:18:20', '2017-04-25 08:18:20'),
(37, 0, 'purchase', '30', 1, 0, '2017-04-25 13:05:33', '2017-04-25 11:05:33'),
(38, 7, '#7 Purchase Order has been created.', 'purchase_order', 1, 0, '2017-04-25 15:42:19', '2017-04-25 13:42:19'),
(39, 7, 'Quantity #<b>1</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-25 15:59:19', '2017-04-25 13:59:19'),
(40, 6, 'Quantity #<b>1</b> received for fdgf', 'purchase_order', 1, 0, '2017-04-26 09:30:10', '2017-04-26 07:30:10'),
(41, 4, 'Quantity #<b>2</b> received for Product 4', 'purchase_order', 1, 0, '2017-04-26 09:31:41', '2017-04-26 07:31:41'),
(47, 1, 'Invoice <b>#24769</b> has been created.', 'invoice', 1, 0, '2017-04-26 13:00:17', '2017-04-26 11:00:17'),
(48, 1, 'Invoice #1 has been updated.', 'invoice', 1, 0, '2017-04-26 13:01:59', '2017-04-26 11:01:59'),
(49, 1, 'Yes', 'invoice', 1, 0, '2017-04-26 13:01:59', '2017-04-26 11:01:59'),
(50, 2, 'Shipping Address <b>#2</b> has been updated.', 'Shipping Address', 1, 0, '2017-04-27 08:26:38', '2017-04-27 06:26:38'),
(51, 2, 'Shipping Address <b>#2</b> has been updated.', 'Shipping Address', 1, 0, '2017-04-27 08:26:47', '2017-04-27 06:26:47'),
(52, 3, 'Order <b>#3</b> has been created.', 'Sales Order', 1, 0, '2017-04-27 12:56:08', '2017-04-27 10:56:08'),
(53, 4, 'Shipment <b>#4</b> has been created.', 'Create Shipment', 1, 0, '2017-04-27 12:56:08', '2017-04-27 10:56:08'),
(54, 8, '#8 Purchase Order has been created.', 'purchase_order', 1, 0, '2017-04-27 13:02:37', '2017-04-27 11:02:37'),
(55, 7, 'Product <b>gfgf</b> added with quantity #<b>2</b>', 'purchase_order', 1, 0, '2017-04-27 16:47:08', '2017-04-27 14:47:08'),
(56, 7, 'Product <b>gfgf</b> added with quantity #<b>3</b>', 'purchase_order', 1, 0, '2017-04-27 17:04:34', '2017-04-27 15:04:34'),
(57, 1, 'Invoice #1 has been updated.', 'invoice', 1, 0, '2017-04-27 17:21:48', '2017-04-27 15:21:48');

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
(12, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(13, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(14, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(15, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(16, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(17, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(18, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(19, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com'),
(20, 'Pun Loc', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '12452', '', ''),
(21, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, 2, '', '4454156465', 'test@gmail.com');

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
(15, NULL, 2, 'fggf', 'gfgf', 3, 1, 1, 1, ' fggf', ' ggf', ' gfgf', '1', 2, 21, 11, '21.00', '212.00', '0.00', '21', '2', '21', 'RFP_(2).docx', 1, 'Yes', 'No', 'Yes', 'No', 25, 325, 232, '0.00', '0.00', '0.00', '23.00', '0', '1', 1, 0, '2017-03-07 13:52:45', '2017-03-07 08:22:45'),
(16, NULL, 1, 'PRP3', 'Product 3', 1, 2, 1, 1, ' Product 3', ' Product 3', ' Product 3', '3', 150, 150, 0, '149.00', '139.00', '0.00', '12345', '98657', '546456', '', 1, 'Yes', 'Yes', 'Yes', 'Yes', 4, 4, 0, '0.00', '0.00', '0.00', '120.00', '0', '1', 1, 0, '2017-03-08 07:48:16', '2017-03-08 02:18:16'),
(17, NULL, 1, 'PRP4', 'Product 4', 2, 1, 3, 2, '   ', '   ', '   ', '1', 1, 12, 0, '29.00', '49.00', '0.00', '', '', '', '', 0, 'Yes', 'Yes', 'Yes', 'Yes', 0, 0, 0, '0.00', '0.00', '0.00', '12.00', '1', '1', 1, 0, '2017-03-15 07:21:04', '2017-03-15 01:51:04');

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
(1, 'Red', '1', 1, 1, '2017-02-24 06:50:01', '2017-05-02 13:50:00'),
(2, 'Blue', '1', 1, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Green', '1', 1, 1, '2017-03-14 12:11:21', '2017-03-14 06:41:21'),
(4, 'Yellow', '1', 1, 1, '2017-03-24 06:15:12', '2017-03-24 00:45:12');

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
(1, 1, 'NEW', 1044, 0, 0, '2017-04-20 00:00:00', '2017-04-20 00:00:00', 'No', 'Noi', 'Noi', 'No', 'NOT PAID', 1, 1, 3, 5, 'COMPLETED', 1, 1, '2017-04-17 13:35:25', '2017-04-20 08:08:05'),
(2, 1, 'SHIPPED', 147, 0, 0, '2017-04-21 00:00:00', '2017-04-23 00:00:00', 'No', '', '', 'No', 'NOT PAID', 12, 2, 3, 7, 'COMPLETED', 0, 1, '2017-04-19 00:00:00', '2017-04-21 10:34:54'),
(4, 1, 'NEW', 49, 0, 0, '2017-04-22 00:00:00', '2017-04-22 00:00:00', 'No', '', '', 'No', 'NOT PAID', 16, 2, 2, 6, 'COMPLETED', 0, 1, '2017-04-20 00:00:00', '2017-04-22 08:42:28'),
(5, 1, 'NEW', 310, 0, 0, '2017-04-22 00:00:00', '2017-04-22 00:00:00', 'No', '', '', 'No', 'NOT PAID', 17, 2, 2, 6, 'COMPLETED', 0, 1, '2017-04-21 00:00:00', '2017-04-22 09:33:01'),
(6, 2, 'NEW', 145, 0, 0, '2017-04-25 00:00:00', '2017-04-25 00:00:00', 'No', '', '', 'No', 'NOT PAID', 18, 2, 3, 5, 'COMPLETED', 1, 1, '2017-04-25 00:00:00', '2017-04-25 07:35:33'),
(7, 1, 'NEW', 897, 0, 0, '2017-04-25 00:00:00', '2017-04-25 00:00:00', 'No', 'asdad', 'asd', 'No', 'NOT PAID', 19, 2, 3, 7, 'COMPLETED', 1, 1, '2017-04-25 15:42:19', '2017-04-25 10:12:19'),
(8, 2, 'NEW', 985, 0, 0, '2017-04-27 00:00:00', '2017-04-27 00:00:00', 'No', '', '', 'No', 'NOT PAID', 21, 1, 3, 6, 'COMPLETED', 1, 1, '2017-04-27 13:02:37', '2017-04-27 07:32:37'),
(13, 1, 'NEW', 424, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'Test', 'Testr', 'No', 'NOT PAID', 2, 1, 3, 6, 'COMPLETED', 1, 1, '2017-05-04 16:35:30', '2017-05-04 11:05:30'),
(14, 1, 'NEW', 636, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'Test again', 'Test again', 'No', 'NOT PAID', 2, 1, 4, 6, 'COMPLETED', 1, 1, '2017-05-04 16:38:32', '2017-05-04 11:08:32'),
(15, 1, 'NEW', 212, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'Test againTest again', 'Test againTest again', 'No', 'NOT PAID', 2, 2, 3, 2, 'COMPLETED', 1, 1, '2017-05-04 16:40:54', '2017-05-04 11:10:54'),
(16, 1, 'NEW', 261, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'AddNewPOAddNewPOAddNewPOAddNewPOAddNewPOAddNewPOAddNewPOAddNewPO', 'AddNewPOAddNewPOAddNewPOAddNewPOAddNewPOAddNewPO', 'No', 'NOT PAID', 2, 3, 2, 2, 'COMPLETED', 1, 1, '2017-05-04 16:42:34', '2017-05-04 11:12:34'),
(17, 1, 'NEW', 196, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'AddNewPOAddNewPOAddNewPO', 'AddNewPOAddNewPOAddNewPO', 'No', 'NOT PAID', 2, 2, 4, 2, 'COMPLETED', 1, 1, '2017-05-04 16:47:17', '2017-05-04 11:17:17'),
(18, 1, 'NEW', 1484, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', 'AddNewPOAddNewPOAddNewPO', 'AddNewPOAddNewPOAddNewPO', 'No', 'NOT PAID', 2, 1, 3, 5, 'COMPLETED', 1, 1, '2017-05-04 16:49:08', '2017-05-04 11:19:08'),
(19, 1, 'NEW', 490, 0, 0, '2017-05-04 00:00:00', '2017-05-04 00:00:00', 'No', '$("#AddNewPO")$("#AddNewPO")$("#AddNewPO")', '$("#AddNewPO")$("#AddNewPO")$("#AddNewPO")', 'No', 'NOT PAID', 2, 2, 4, 6, 'COMPLETED', 1, 1, '2017-05-04 16:51:51', '2017-05-04 11:21:51'),
(20, 2, 'NEW', 435, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'Test AgainTest Again', 'Test AgainTest Again', 'No', 'NOT PAID', 2, 2, 2, 6, 'COMPLETED', 1, 1, '2017-05-05 07:45:22', '2017-05-05 02:15:22'),
(21, 2, 'NEW', 556, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'Test Again', 'Test Again', 'No', 'NOT PAID', 2, 2, 3, 7, 'COMPLETED', 1, 1, '2017-05-05 07:48:53', '2017-05-05 02:18:53'),
(22, 2, 'NEW', 435, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'Test Again', 'Test Again', 'No', 'NOT PAID', 2, 3, 4, 6, 'COMPLETED', 1, 1, '2017-05-05 07:49:56', '2017-05-05 02:19:56'),
(23, 2, 'NEW', 701, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'Test Again', 'Test Again', 'No', 'NOT PAID', 2, 3, 6, 7, 'COMPLETED', 1, 1, '2017-05-05 07:53:12', '2017-05-05 02:23:12'),
(24, 2, 'NEW', 290, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'vf', 'gfd', 'No', 'NOT PAID', 2, 1, 3, 6, 'COMPLETED', 1, 1, '2017-05-05 07:56:29', '2017-05-05 02:26:29'),
(25, 2, 'NEW', 278, 0, 0, '2017-05-05 00:00:00', '2017-05-05 00:00:00', 'No', 'sdfs', 'fdsf', 'No', 'NOT PAID', 2, 2, 4, 1, 'COMPLETED', 1, 1, '2017-05-05 07:56:55', '2017-05-05 02:26:55'),
(26, 1, 'NEW', 261, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'Testasd', 'Testasd', 'No', 'NOT PAID', 2, 2, 4, 5, 'COMPLETED', 1, 1, '2017-05-06 09:53:23', '2017-05-06 04:23:23'),
(27, 1, 'NEW', 49, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', '', '', 'No', 'NOT PAID', 2, 3, 2, 5, 'COMPLETED', 1, 1, '2017-05-06 09:54:48', '2017-05-06 04:24:48'),
(28, 1, 'NEW', 49, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'f', 'sdfsdf', 'No', 'NOT PAID', 2, 1, 4, 5, 'COMPLETED', 1, 1, '2017-05-06 09:55:40', '2017-05-06 04:25:40'),
(29, 1, 'NEW', 212, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', '', '', 'No', 'NOT PAID', 2, 2, 3, 6, 'COMPLETED', 1, 1, '2017-05-06 09:57:13', '2017-05-06 04:27:13'),
(30, 1, 'NEW', 212, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'cv', 'bcvb', 'No', 'NOT PAID', 2, 2, 4, 7, 'COMPLETED', 1, 1, '2017-05-06 10:01:00', '2017-05-06 04:31:00'),
(31, 1, 'NEW', 636, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'asdsadsadsadsadsa', 'dsadasd', 'No', 'NOT PAID', 2, 2, 1, 6, 'COMPLETED', 1, 1, '2017-05-06 11:13:46', '2017-05-06 05:43:46'),
(32, 1, 'NEW', 914, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'sss', 'sss', 'No', 'NOT PAID', 2, 2, 4, 5, 'COMPLETED', 1, 1, '2017-05-06 11:14:35', '2017-05-06 05:44:35'),
(33, 1, 'NEW', 261, 0, 0, '2017-05-06 00:00:00', '2017-05-06 00:00:00', 'No', 'gvnhnj', 'bvhmn', 'No', 'NOT PAID', 2, 2, 3, 5, 'COMPLETED', 1, 1, '2017-05-06 11:15:02', '2017-05-06 05:45:02');

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
(2, 1, 17, '', 'Product 4', 'NEW', 49, 4, 2, 1, 1, '2017-04-20 13:36:37', '2017-05-03 07:06:25'),
(22, 2, 17, 'PRP4', 'Product 4', 'NEW', 49, 3, 0, 1, 1, '2017-04-21 16:04:54', '2017-04-21 14:04:54'),
(23, 3, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 1, 1, '2017-04-22 14:06:48', '2017-04-22 12:06:48'),
(24, 4, 17, 'PRP4', 'Product 4', 'NEW', 49, 2, 2, 1, 1, '2017-04-22 14:12:28', '2017-04-24 08:23:17'),
(27, 5, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 1, 1, '2017-04-25 10:13:18', '2017-04-25 04:43:18'),
(29, 5, 17, 'PRP4', 'Product 4', 'NEW', 49, 2, 0, 1, 1, '2017-04-25 10:18:20', '2017-04-25 04:48:20'),
(30, 6, 3, 'g', 'fdgf', 'NEW', 145, 1, 1, 1, 1, '2017-04-25 13:05:33', '2017-04-25 11:05:33'),
(31, 7, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 1, 1, 1, '2017-04-25 15:42:19', '2017-04-25 13:42:19'),
(32, 8, 16, 'PRP3', 'Product 3', 'NEW', 139, 5, 0, 1, 1, '2017-04-27 13:02:37', '2017-04-27 11:02:37'),
(33, 8, 3, 'g', 'fdgf', 'NEW', 145, 2, 0, 1, 1, '2017-04-27 13:02:37', '2017-04-27 11:02:37'),
(35, 7, 15, 'fggf', 'gfgf', 'NEW', 212, 4, 0, 1, 1, '2017-04-27 17:04:34', '2017-04-27 11:34:34'),
(54, 1, 15, 'fggf', 'gfgf', 'NEW', 212, 4, 0, 1, 1, '2017-05-03 12:30:16', '2017-05-03 07:06:48'),
(58, 13, 15, 'fggf', 'gfgf', 'NEW', 212, 2, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:35:30'),
(59, 14, 15, 'fggf', 'gfgf', 'NEW', 212, 3, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:38:32'),
(60, 15, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:40:54'),
(61, 16, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:42:34'),
(62, 16, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:42:34'),
(63, 17, 17, 'PRP4', 'Product 4', 'NEW', 49, 4, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:47:18'),
(64, 18, 15, 'fggf', 'gfgf', 'NEW', 212, 7, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:49:09'),
(65, 19, 17, 'PRP4', 'Product 4', 'NEW', 49, 10, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-04 14:51:51'),
(66, 20, 3, 'g', 'fdgf', 'NEW', 145, 3, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:45:22'),
(67, 21, 16, 'PRP3', 'Product 3', 'NEW', 139, 4, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:48:53'),
(68, 22, 3, 'g', 'fdgf', 'NEW', 145, 3, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:49:56'),
(69, 23, 16, 'PRP3', 'Product 3', 'NEW', 139, 4, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:53:12'),
(70, 23, 3, 'g', 'fdgf', 'NEW', 145, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:53:12'),
(71, 24, 3, 'g', 'fdgf', 'NEW', 145, 2, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:56:29'),
(72, 25, 16, 'PRP3', 'Product 3', 'NEW', 139, 2, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-05 05:56:55'),
(73, 26, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 07:53:23'),
(74, 26, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 07:53:23'),
(75, 27, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 07:54:48'),
(76, 28, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 07:55:40'),
(77, 29, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 07:57:13'),
(78, 30, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 08:01:00'),
(79, 31, 15, 'fggf', 'gfgf', 'NEW', 212, 3, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 09:13:46'),
(80, 32, 17, 'PRP4', 'Product 4', 'NEW', 49, 10, 0, 0, 0, '0000-00-00 00:00:00', '2017-05-06 09:14:35'),
(81, 33, 15, 'fggf', 'gfgf', 'NEW', 212, 1, 0, 0, 1, '0000-00-00 00:00:00', '2017-05-08 01:49:29'),
(82, 33, 17, 'PRP4', 'Product 4', 'NEW', 49, 1, 0, 0, 1, '0000-00-00 00:00:00', '2017-05-08 01:54:48'),
(85, 32, 15, 'fggf', 'gfgf', 'NEW', 212, 2, 0, 1, 1, '2017-05-06 16:03:25', '2017-05-06 10:33:25');

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
(1, 2, 2, 0, 'NEW', 1566, 0, 0, 0, 0, 2, 6, 0, 4, 'SALE', '0.00', 'dd', 'dd', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 1, 1, 1, 1, '2017-05-06 14:58:08', '2017-05-06 09:28:08');

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
(1, 17, 'NEW', 49, 6, 1, 1, 1, 1, 1, '2017-05-06 14:58:08', '2017-05-08 01:59:19'),
(2, 15, 'NEW', 212, 6, 1, 1, 1, 1, 1, '2017-05-06 14:58:08', '2017-05-08 02:00:03');

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
(1, 1, '2', 2, '4', 'NEW', '', 0, '2017-05-06 00:00:00', 1, 1, '2017-05-06 14:58:08', '2017-05-06 09:28:08');

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
(1, 1, 15, '12', '50.00', 1, 'Yes', 10, '1', '5.00', 'usps', '1.00', 1, 0, 0, '2017-02-24 06:01:57', '2017-02-24 06:01:57'),
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
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `address1`, `address2`, `city`, `state`, `country`, `zipcode`, `phone`, `email`, `status`, `created_date`, `updated_date`) VALUES
(2, 'Warehouses 1', '40, Third Floor', 'Suite Apt', 'Scottsdale', 1, '2', '1514', '4454156465', 'test@gmail.com', '1', '2017-03-17 08:49:03', '2017-03-17 03:19:03');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `callback`
--
ALTER TABLE `callback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `call_logs`
--
ALTER TABLE `call_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `customer_location`
--
ALTER TABLE `customer_location`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
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
