-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 18, 2017 at 02:54 PM
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
(1, 2, 2, 0, 'NEW', 1566, 0, 0, 0, 0, 2, 6, 0, 4, 'SALE', '0.00', 'dd', 'dd', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 1, 1, 0, 0, 0, 0, 1, 1, '2017-05-06 14:58:08', '2017-05-06 09:28:08'),
(2, 2, 1, 0, 'NEW', 42, 0, 0, 0, 2, 1, 2, 0, 0, 'SALE', '0.00', 'dsdsds', 'dsdssd', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 0, 2, 0, 0, 0, 0, 1, 0, '2017-05-10 16:48:04', '2017-05-10 11:18:04'),
(3, 2, 1, 0, 'NEW', 42, 0, 0, 0, 2, 1, 5, 0, 0, 'SALE', '0.00', '', '', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 0, 2, 0, 0, 0, 0, 1, 0, '2017-05-10 16:48:34', '2017-05-10 11:18:34'),
(4, 2, 1, 0, 'NEW', 42, 0, 0, 0, 2, 2, 5, 0, 0, 'SALE', '0.00', '', '', 'Yes', 'Yes', 'Yes', 'RETURN', 0, 2, 2, 0, 0, 0, 0, 1, 0, '2017-05-10 16:50:37', '2017-05-10 11:20:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sales_order`
--
ALTER TABLE `sales_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
