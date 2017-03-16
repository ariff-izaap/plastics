-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2017 at 01:01 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

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
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `length` decimal(10,2) NOT NULL,
  `width` decimal(10,2) NOT NULL,
  `height` decimal(10,2) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `in_stock` enum('1','0') NOT NULL,
  `enabled` enum('1','0') NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `purchase_order_number` varchar(50) NOT NULL,
  `purchase_transportation_identifier` varchar(50) NOT NULL,
  `sales_transportation_identifier` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `parent_id`, `category_id`, `sku`, `name`, `form_id`, `package_id`, `color_id`, `product`, `notes`, `item_type`, `equivalent`, `row`, `units`, `quantity`, `available_qty`, `retail_price`, `wholesale_price`, `shipping_cost`, `ref_no`, `internal_lot_no`, `vendor_lot_no`, `certification_files`, `warehouse_id`, `intransit_to_warehouse`, `intransit_to_customer`, `received_at_customer`, `received_in_warehouse`, `length`, `width`, `height`, `weight`, `in_stock`, `enabled`, `created_id`, `updated_id`, `created_date`, `updated_date`, `purchase_order_number`, `purchase_transportation_identifier`, `sales_transportation_identifier`) VALUES
(5, NULL, 1, 'dg', 'Tdd', 1, 1, 2, 0, '', '', '', '', 0, 23, 0, '15.00', '2112.00', '54.00', '54', '12', '12', '', 0, 'No', 'No', '', '', '0.00', '0.00', '0.00', '0.00', '1', '1', 1, 0, '2017-02-17 08:39:11', '2017-02-17 03:09:11', '', '', 0),
(6, NULL, 1, 'fh', 'ddf', 3, 1, 2, 0, '', '', '', '', 0, 5, 0, '216.00', '65.00', '12.00', '5', '6', '2112', '', 0, 'No', 'No', '', '', '0.00', '0.00', '0.00', '0.00', '1', '1', 1, 1, '2017-02-17 09:44:09', '2017-02-17 04:19:24', '', '', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
