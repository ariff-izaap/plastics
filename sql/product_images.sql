-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 24, 2017 at 07:20 AM
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
(1, 0, '', 'budget-cal_popup2228.png', 0),
(2, 0, '', 'budget-cal_popup1234.png', 0),
(3, 0, '', 'budget-cal_popup2229.png', 0),
(4, 0, '', 'budget-cal_popup1235.png', 0),
(5, 15, 'TesdfTIle', 'budget-cal_popup1236.png', 0),
(6, 0, 'Title', 'budget-cal_popup15.png', 0),
(7, 0, 'DFdsfdf', 'budget-cal_popup16.png', 0),
(8, 0, 'Tfdfgg', 'budget-cal_popup17.png', 0),
(9, 0, 'Tfdfgg', 'budget-cal_popup1237.png', 0),
(10, 0, 'fdffd', 'budget-cal_popup18.png', 0),
(11, 0, 'fdffd', 'budget-cal_popup22210.png', 0),
(12, 0, 'dsfds', 'budget-cal_popup22211.png', 0),
(13, 0, 'dsfds', 'budget-cal_popup19.png', 0),
(16, 16, 'Title', 'budget-cal_popup22213.png', 0),
(17, 26, 'Test Image', 'budget-cal_popup123.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
