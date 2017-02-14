-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 14, 2017 at 11:54 AM
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

INSERT INTO `product` (`id`, `parent_id`, `category_id`, `sku`, `name`, `form_id`, `package_id`, `color_id`, `product`, `notes`, `item_type`, `equivalent`, `row`, `units`, `quantity`, `retail_price`, `wholesale_price`, `shipping_cost`, `ref_no`, `internal_lot_no`, `vendor_lot_no`, `certification_files`, `warehouse_id`, `intransit_to_warehouse`, `intransit_to_customer`, `received_at_customer`, `received_in_warehouse`, `length`, `width`, `height`, `weight`, `in_stock`, `enabled`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(2, NULL, 0, 'fggf', 'fgfgfg', 1, 1, 2, 0, '', '', '', '', 0, 10, '250.00', '233.00', '122.00', 'fggf', '56', '23', '', 0, 'No', 'No', 'No', 'No', '0.00', '0.00', '0.00', '0.00', '1', '1', 1, 0, '2017-02-13 08:35:14', '2017-02-13 03:05:14');

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
(2, 'Red', '1', 1, 0, '2017-02-13 08:23:23', '2017-02-13 08:23:23');

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
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_form`
--

INSERT INTO `product_form` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'Comp', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Powder', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Parts', '1', 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Regrind', '1', 0, 1, '0000-00-00 00:00:00', '2017-02-13 08:13:00');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
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
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_packaging`
--

INSERT INTO `product_packaging` (`id`, `name`, `status`, `created_id`, `updated_id`, `created_date`, `updated_date`) VALUES
(1, 'test', '1', 1, 1, '2017-02-13 07:58:37', '2017-02-13 07:59:14');

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
  `updated_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_color`
--
ALTER TABLE `product_color`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `product_form`
--
ALTER TABLE `product_form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `product_packaging`
--
ALTER TABLE `product_packaging`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `product_type`
--
ALTER TABLE `product_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
