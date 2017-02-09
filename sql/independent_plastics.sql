-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2017 at 04:32 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `independent_plastics`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
`id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `email`, `password`, `role_id`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'first name', 'last name', 'email@email.com', '5f4dcc3b5aa765d61d8327deb882cf99', 1, '1', 0, 0, '0000-00-00 00:00:00', '2017-02-09 11:24:55');

-- --------------------------------------------------------

--
-- Table structure for table `callback`
--

CREATE TABLE IF NOT EXISTS `callback` (
`id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `next_callback_date` datetime NOT NULL,
  `user_to_notify` text NOT NULL COMMENT 'multiple users(salesman)',
  `cb_message` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `call_logs`
--

CREATE TABLE IF NOT EXISTS `call_logs` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL COMMENT 'person logged in when making the call',
  `call_type` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL COMMENT 'business relationship',
  `log_date` datetime NOT NULL,
  `call_log` text NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `call_type`
--

CREATE TABLE IF NOT EXISTS `call_type` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `carrier` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
`id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `category_thumb` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enabled` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contact_type`
--

CREATE TABLE IF NOT EXISTS `contact_type` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `countrty`
--

CREATE TABLE IF NOT EXISTS `countrty` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `code` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `credit_type`
--

CREATE TABLE IF NOT EXISTS `credit_type` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `days` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `credit_type`
--

INSERT INTO `credit_type` (`id`, `name`, `days`, `created_date`) VALUES
(1, 'NET10', '10 days', '2016-12-17 00:00:00'),
(2, 'NET15', '15 days', '2016-12-17 00:00:00'),
(3, 'NET30', '30 days', '2016-12-17 00:00:00'),
(4, 'NET60', '60 days', '2016-12-17 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
`id` int(11) NOT NULL,
  `business_name` varchar(150) NOT NULL,
  `credit_type` int(11) NOT NULL,
  `web_url` varchar(250) NOT NULL,
  `ups` varchar(250) NOT NULL,
  `address_id` int(11) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='vendors' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_contact`
--

CREATE TABLE IF NOT EXISTS `customer_contact` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `customer_location`
--

CREATE TABLE IF NOT EXISTS `customer_location` (
`id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `address` varchar(250) NOT NULL,
  `definition` varchar(250) NOT NULL,
  `timezone_id` int(11) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `day_of_week` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE IF NOT EXISTS `email_template` (
`id` int(11) NOT NULL,
  `type` enum('EMAIL','GLOBAL_MESSAGE','CUSTOMER','SALES','PURCHASE','ACCOUNTS') NOT NULL,
  `name` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
`id` int(11) NOT NULL,
  `action_id` int(11) NOT NULL,
  `action` text NOT NULL COMMENT 'Log message',
  `line` varchar(150) NOT NULL COMMENT 'Action type',
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE IF NOT EXISTS `menu` (
`id` int(11) NOT NULL,
  `label` varchar(150) NOT NULL,
  `link` varchar(150) NOT NULL,
  `parent` mediumint(5) NOT NULL,
  `sort` mediumint(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `min_level`
--

CREATE TABLE IF NOT EXISTS `min_level` (
`id` int(11) NOT NULL,
  `warning_name` varchar(250) NOT NULL,
  `product` int(11) NOT NULL,
  `form` int(11) NOT NULL,
  `color` int(11) NOT NULL,
  `packaging` int(11) NOT NULL,
  `type` varchar(150) NOT NULL,
  `equivqlent` varchar(150) NOT NULL,
  `quantity` int(11) NOT NULL,
  `dropdown` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `update` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `operator_selection`
--

CREATE TABLE IF NOT EXISTS `operator_selection` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `operator` varchar(5) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `operator_selection`
--

INSERT INTO `operator_selection` (`id`, `name`, `operator`) VALUES
(1, 'Greater than', '>'),
(2, 'Greater than or equal to', '>='),
(3, 'Less than', '<'),
(4, 'Less than or equal to', '<='),
(5, 'Equal', '=');

-- --------------------------------------------------------

--
-- Table structure for table `page_titles`
--

CREATE TABLE IF NOT EXISTS `page_titles` (
`id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `controller` varchar(250) NOT NULL COMMENT 'navigation namespace',
  `created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_color`
--

CREATE TABLE IF NOT EXISTS `product_color` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_form`
--

CREATE TABLE IF NOT EXISTS `product_form` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

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

CREATE TABLE IF NOT EXISTS `product_images` (
`id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `primary` tinyint(1) NOT NULL COMMENT '1=>primary,0=>none'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_packaging`
--

CREATE TABLE IF NOT EXISTS `product_packaging` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `product_type`
--

CREATE TABLE IF NOT EXISTS `product_type` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order`
--

CREATE TABLE IF NOT EXISTS `purchase_order` (
`id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL COMMENT 'purchase from(vendor)',
  `order_status` enum('NEW','ACCEPTED','PROCESSING','PENDING','SHIPPED','COMPLETE','HOLD','CANCELLED','IGNORE','RECEIVED') NOT NULL,
  `total_amount` double NOT NULL,
  `so_id` int(11) NOT NULL,
  `accounts_person_id` int(11) NOT NULL,
  `pickup_date` datetime NOT NULL,
  `estiamted_delivery` datetime NOT NULL,
  `release_to_sold` enum('Yes','No') NOT NULL DEFAULT 'No',
  `po_message` text NOT NULL,
  `note` text NOT NULL,
  `is_vendor_stock_level_updated` enum('No','Yes') NOT NULL,
  `is_paid` enum('NULL','PAID','NOT PAID') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_item`
--

CREATE TABLE IF NOT EXISTS `purchase_order_item` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `returns`
--

CREATE TABLE IF NOT EXISTS `returns` (
`id` int(11) NOT NULL,
  `so_id` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Incoming','Received','Rejected','Partially Accepted') NOT NULL,
  `is_refund` enum('0','1') NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `return_product`
--

CREATE TABLE IF NOT EXISTS `return_product` (
`id` int(11) NOT NULL,
  `return_id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `refund_qty` int(11) NOT NULL,
  `status` enum('Pending','Accepted','Rejected') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Sales'),
(3, 'Purchase'),
(4, 'Inventory'),
(5, 'Accounting'),
(6, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `role_access`
--

CREATE TABLE IF NOT EXISTS `role_access` (
`id` int(11) NOT NULL,
  `page_title_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `access-level` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE IF NOT EXISTS `sales_order` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE IF NOT EXISTS `sales_order_item` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sale_type`
--

CREATE TABLE IF NOT EXISTS `sale_type` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`id` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `name` varchar(250) NOT NULL,
  `value` varchar(250) NOT NULL,
  `autoload` enum('Y','N') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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

CREATE TABLE IF NOT EXISTS `shipment` (
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `shipping_type`
--

CREATE TABLE IF NOT EXISTS `shipping_type` (
`id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `delivery_days` int(11) NOT NULL,
  `flat_rate` decimal(10,2) NOT NULL,
  `rate_pound` decimal(10,2) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `shipping_type`
--

INSERT INTO `shipping_type` (`id`, `type`, `delivery_days`, `flat_rate`, `rate_pound`, `status`) VALUES
(1, 'Standard 2-6 days', 6, '5.00', '0.50', '1'),
(2, 'Expedited 2 days', 2, '10.00', '1.50', '1'),
(3, 'Free Shipping', 6, '0.00', '0.00', '1');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
`id` int(11) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `country_code` varchar(15) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
`id` int(11) NOT NULL,
  `country` varchar(10) NOT NULL,
  `state_code` varchar(10) NOT NULL,
  `state_name` varchar(100) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `include_shipping` tinyint(1) NOT NULL,
  `include_discount` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `timezone`
--

CREATE TABLE IF NOT EXISTS `timezone` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `offset` varchar(20) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_price_list`
--

CREATE TABLE IF NOT EXISTS `vendor_price_list` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE IF NOT EXISTS `warehouse` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `location` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `week_days_operate`
--

CREATE TABLE IF NOT EXISTS `week_days_operate` (
`id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` enum('1','0') NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
-- Indexes for table `countrty`
--
ALTER TABLE `countrty`
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carrier`
--
ALTER TABLE `carrier`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `contact_type`
--
ALTER TABLE `contact_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countrty`
--
ALTER TABLE `countrty`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `credit_type`
--
ALTER TABLE `credit_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_contact`
--
ALTER TABLE `customer_contact`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `customer_location`
--
ALTER TABLE `customer_location`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `operator_selection`
--
ALTER TABLE `operator_selection`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `page_titles`
--
ALTER TABLE `page_titles`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_form`
--
ALTER TABLE `product_form`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_packaging`
--
ALTER TABLE `product_packaging`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order`
--
ALTER TABLE `purchase_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order_item`
--
ALTER TABLE `purchase_order_item`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `role_access`
--
ALTER TABLE `role_access`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `shipment`
--
ALTER TABLE `shipment`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shipping_type`
--
ALTER TABLE `shipping_type`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax`
--
ALTER TABLE `tax`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `timezone`
--
ALTER TABLE `timezone`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_price_list`
--
ALTER TABLE `vendor_price_list`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `week_days_operate`
--
ALTER TABLE `week_days_operate`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
