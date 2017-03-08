-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2017 at 07:34 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

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

INSERT INTO `product` (`id`, `parent_id`, `category_id`, `sku`, `name`, `form_id`, `package_id`, `color_id`, `product`, `notes`, `item_type`, `equivalent`, `row`, `units`, `quantity`, `retail_price`, `wholesale_price`, `shipping_cost`, `ref_no`, `internal_lot_no`, `vendor_lot_no`, `certification_files`, `warehouse_id`, `intransit_to_warehouse`, `intransit_to_customer`, `received_at_customer`, `received_in_warehouse`, `purchase_order_number`, `purchase_transportation_identifier`, `sales_transportation_identifier`, `length`, `width`, `height`, `weight`, `in_stock`, `enabled`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, NULL, 1, 'dds', 'Tes', 2, 1, 2, 12, 'Tfffd', ' dffd', ' dfdf', '2', 5, 2, '12.00', '25.00', '0.00', '12', '1', '12', '', 1, 'Yes', 'No', 'Yes', 'No', 12, 121, 12, '0.00', '0.00', '0.00', '15.00', '0', '1', 1, 0, '2017-03-06 13:34:23', '2017-03-06 08:04:23'),
(2, NULL, 1, 'dds', 'Tes', 2, 1, 2, 12, 'Tfffd', ' dffd', ' dfdf', '2', 5, 2, '12.00', '25.00', '0.00', '12', '1', '12', '', 1, 'Yes', 'No', 'Yes', 'No', 12, 121, 12, '0.00', '0.00', '0.00', '15.00', '0', '1', 1, 0, '2017-03-06 13:35:35', '2017-03-06 08:05:35'),
(3, NULL, 1, 'g', 'fdgf', 2, 1, 2, 0, ' ggf', ' fg', ' fggf', 'gg', 0, 0, '125.00', '145.00', '0.00', '45', '12', '212', '', 2, 'Yes', 'No', 'Yes', 'Yes', 250, 221, 2, '0.00', '0.00', '0.00', '112.00', '1', '1', 1, 0, '2017-03-06 13:36:35', '2017-03-06 08:06:35'),
(4, NULL, 1, 'g', 'fdgf', 2, 1, 2, 0, ' ggf', ' fg', ' fggf', 'gg', 0, 0, '125.00', '145.00', '0.00', '45', '12', '212', '', 2, 'Yes', 'No', 'Yes', 'Yes', 250, 221, 2, '0.00', '0.00', '0.00', '112.00', '1', '1', 1, 0, '2017-03-06 14:55:12', '2017-03-06 09:25:12'),
(5, NULL, 1, 'df', 'TEds', 4, 1, 2, 0, ' dfdf', ' dfdf', 'dfdf', '2', 2, 1, '2.00', '21.00', '0.00', '12', '1', '12', '', 1, 'No', 'Yes', 'No', 'Yes', 3256, 2332, 23, '0.00', '0.00', '0.00', '2323.00', '1', '1', 1, 0, '2017-03-07 10:02:01', '2017-03-07 04:32:01'),
(6, NULL, 2, 'fd', 'fd', 2, 1, 2, 0, 'dfdf ', ' dfdf', ' df', '2', 2, 2, '23.00', '3.00', '0.00', '3', '32', '23', '', 2, 'Yes', 'Yes', 'No', 'Yes', 2, 2, 2, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 10:38:15', '2017-03-07 05:08:15'),
(7, NULL, 2, 'fd', 'fd', 2, 1, 2, 0, 'dfdf ', ' dfdf', ' df', '2', 2, 2, '23.00', '3.00', '0.00', '3', '32', '23', '', 2, 'Yes', 'Yes', 'No', 'Yes', 2, 2, 2, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 10:39:56', '2017-03-07 05:09:56'),
(8, NULL, 2, 'fg', 'fgg', 2, 1, 2, 0, ' fgfg', ' gf', ' gf', '12', 2, 221, '121.00', '2112.00', '0.00', '21', '12', '21', '', 2, 'Yes', 'No', 'Yes', 'No', 25, 22, 2121, '0.00', '0.00', '0.00', '21.00', '0', '1', 1, 0, '2017-03-07 10:40:48', '2017-03-07 05:10:48'),
(9, NULL, 1, 'fd', 'df', 2, 1, 2, 0, ' teds', ' d', ' 1', '2', 5, 54, '2.00', '12.00', '0.00', '21', '21', '12', '', 2, 'Yes', 'No', 'Yes', 'No', 21, 54, 87, '0.00', '0.00', '0.00', '87.00', '0', '1', 1, 0, '2017-03-07 11:00:15', '2017-03-07 05:30:15'),
(10, NULL, 1, 'fd', 'df', 2, 1, 2, 0, ' teds', ' d', ' 1', '2', 5, 54, '2.00', '12.00', '0.00', '21', '21', '12', '', 2, 'Yes', 'No', 'Yes', 'No', 21, 54, 87, '0.00', '0.00', '0.00', '87.00', '0', '1', 1, 0, '2017-03-07 11:08:00', '2017-03-07 05:38:00'),
(11, NULL, 2, 'f', 'xcv', 2, 1, 2, 0, ' df', ' fd', ' fd', '12', 21, 5, '54.00', '3.00', '0.00', '7', '421', '21', '', 2, 'Yes', 'No', 'Yes', 'No', 1, 12, 12, '0.00', '0.00', '0.00', '12.00', '0', '1', 1, 0, '2017-03-07 11:08:56', '2017-03-07 05:38:56'),
(12, NULL, 2, 'sdsd', 'Tesd', 3, 1, 2, 0, ' sd', ' s', ' sd', '2', 5, 12, '54.00', '45.00', '0.00', '54', '2154', '221', '', 1, 'Yes', 'No', 'Yes', 'No', 23, 45, 4, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 11:18:55', '2017-03-07 05:48:55'),
(13, NULL, 2, 'df', 'ddf', 2, 1, 2, 0, ' dffd', ' fddf', ' dffd', '25', 2, 21, '221.00', '21.00', '0.00', '11', '23', '56', '', 1, 'Yes', 'No', 'Yes', 'No', 235, 2, 32, '0.00', '0.00', '0.00', '2.00', '0', '1', 1, 0, '2017-03-07 12:53:40', '2017-03-07 07:23:40'),
(14, NULL, 1, 'sdds', 'ds', 4, 1, 2, 0, ' dsd', ' dsds', ' sdffd', '25', 54, 54, '54.00', '5454.00', '0.00', '554', '54', '54', '', 1, 'Yes', 'No', 'Yes', 'No', 125, 56, 56, '0.00', '0.00', '0.00', '65.00', '0', '1', 1, 0, '2017-03-07 13:08:58', '2017-03-07 07:38:58'),
(15, NULL, 2, 'fggf', 'gfgf', 3, 1, 2, 0, ' fggf', ' ggf', ' gfgf', '1', 2, 21, '21.00', '212.00', '0.00', '21', '2', '21', 'RFP_(2).docx', 1, 'Yes', 'No', 'Yes', 'No', 25, 325, 232, '0.00', '0.00', '0.00', '23.00', '0', '1', 1, 0, '2017-03-07 13:52:45', '2017-03-07 08:22:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
