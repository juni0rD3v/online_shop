-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2022 at 11:26 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_kimson`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `clm_adminid` varchar(255) NOT NULL,
  `clm_username` varchar(50) NOT NULL,
  `clm_password` varchar(255) NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_status` int(1) NOT NULL DEFAULT '1',
  `clm_type` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`clm_adminid`, `clm_username`, `clm_password`, `clm_date`, `clm_status`, `clm_type`) VALUES
('ADMIN2109171206', 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-09-17 00:07:02', 1, 1),
('ADMIN210929162305', 'user', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00', 0, 0),
('ADMIN211115385609', 'staff', '81dc9bdb52d04dc20036dbd8313ed055', '2021-11-15 21:56:38', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `clm_cartid` bigint(255) NOT NULL,
  `clm_prodid` varchar(255) NOT NULL,
  `clm_customerid` varchar(255) NOT NULL,
  `clm_quantity` int(255) NOT NULL DEFAULT '1',
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `clm_catid` varchar(255) NOT NULL,
  `clm_name` varchar(255) NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_encoded_by` varchar(50) NOT NULL,
  `clm_status` int(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive | 1 = active'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`clm_catid`, `clm_name`, `clm_date`, `clm_encoded_by`, `clm_status`) VALUES
('C2109290257', 'Beverages', '2021-09-29 08:57:39', 'admin', 1),
('C2109290259', 'Canned Goods', '2021-09-29 08:59:13', 'admin', 1),
('C2109290309', 'Condiments', '2021-09-29 09:09:25', 'admin', 1),
('C2109290357', 'Bread/Grains', '2021-09-29 09:57:56', 'admin', 1),
('C2109290403', 'Snacks', '2021-09-29 10:03:07', 'admin', 1),
('C2109290404', 'Baking/Spices', '2021-09-29 10:04:11', 'admin', 1),
('C2109290405', 'Frozen foods', '2021-09-29 10:05:16', 'admin', 1),
('C210929040631', 'Dairies', '2021-09-29 10:06:31', 'admin', 1),
('C210929040641', 'Personal care', '2021-09-29 10:06:41', 'admin', 1),
('C210929040648', 'Toiletries', '2021-09-29 10:06:48', 'admin', 1),
('C210929040656', 'Paper/plastic', '2021-09-29 10:06:56', 'admin', 1),
('C210929040706', 'Laundry products', '2021-09-29 10:07:06', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customers`
--

CREATE TABLE `tbl_customers` (
  `clm_customerid` varchar(255) NOT NULL,
  `clm_fname` varchar(50) NOT NULL,
  `clm_lname` varchar(50) NOT NULL,
  `clm_email` varchar(50) NOT NULL,
  `clm_address` varchar(255) NOT NULL,
  `clm_contact` bigint(255) NOT NULL,
  `clm_username` varchar(50) NOT NULL,
  `clm_password` varchar(255) NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_status` int(1) NOT NULL DEFAULT '1',
  `clm_del_by` varchar(50) DEFAULT NULL,
  `clm_date_del` datetime DEFAULT NULL,
  `clm_remarks` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_customers`
--

INSERT INTO `tbl_customers` (`clm_customerid`, `clm_fname`, `clm_lname`, `clm_email`, `clm_address`, `clm_contact`, `clm_username`, `clm_password`, `clm_date`, `clm_status`, `clm_del_by`, `clm_date_del`, `clm_remarks`) VALUES
('CUS2102100559', 'Juan', 'Dela Cruz', 'juan@email.com', '666 Bulan', 9589658964, 'juan', '202cb962ac59075b964b07152d234b70', '2021-10-02 11:59:16', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_delivery`
--

CREATE TABLE `tbl_delivery` (
  `clm_id` bigint(255) NOT NULL,
  `clm_orderid` varchar(255) NOT NULL,
  `clm_mode` varchar(255) NOT NULL,
  `clm_remarks` varchar(255) NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_incharge` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `clm_orderid` varchar(255) NOT NULL,
  `clm_customerid` varchar(255) NOT NULL,
  `clm_delivery_fee` float NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_status` int(1) NOT NULL DEFAULT '1' COMMENT '1-pending 2-preparing 3-to receive 4-complete 5-cancelled4 - cancelled',
  `clm_remarks` varchar(255) NOT NULL DEFAULT 'Pending',
  `clm_date_preparing` datetime DEFAULT NULL,
  `clm_date_to_receive` datetime DEFAULT NULL,
  `clm_date_completed` datetime DEFAULT NULL,
  `clm_date_cancelled` datetime DEFAULT NULL,
  `clm_cancelled_remarks` varchar(255) DEFAULT NULL,
  `clm_cancelled_by` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders`
--

INSERT INTO `tbl_orders` (`clm_orderid`, `clm_customerid`, `clm_delivery_fee`, `clm_date`, `clm_status`, `clm_remarks`, `clm_date_preparing`, `clm_date_to_receive`, `clm_date_completed`, `clm_date_cancelled`, `clm_cancelled_remarks`, `clm_cancelled_by`) VALUES
('211228092234', 'CUS2102100559', 55, '2021-12-28 16:22:34', 4, 'Received Order', '2021-12-29 16:46:40', '2021-12-29 16:46:57', '2021-12-29 16:48:02', NULL, NULL, NULL),
('211229095101', 'CUS2102100559', 55, '2021-12-29 16:51:01', 5, 'Pending', NULL, NULL, NULL, '2021-12-29 16:52:03', 'Out of stock', 'admin'),
('211231012447', 'CUS2102100559', 55, '2021-12-31 08:24:47', 4, 'Received Order', '2021-12-31 08:26:04', '2021-12-31 08:26:17', '2021-12-31 08:36:57', NULL, NULL, NULL),
('211231013633', 'CUS2102100559', 55, '2021-12-31 08:36:33', 5, 'Pending', NULL, NULL, NULL, '2021-12-31 08:36:43', 'Change of mind', 'Juan Dela Cruz'),
('211231023140', 'CUS2102100559', 55, '2022-01-01 09:31:40', 4, 'Received Order', '2021-12-31 09:32:54', '2021-12-31 09:33:04', '2021-12-31 09:33:17', NULL, NULL, NULL),
('211231031633', 'CUS2102100559', 55, '2022-01-20 10:16:33', 4, 'Received Order', '2021-12-31 10:18:09', '2021-12-31 10:18:18', '2021-12-31 10:18:30', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_orders_dts`
--

CREATE TABLE `tbl_orders_dts` (
  `clm_id` bigint(255) NOT NULL,
  `clm_orderid` varchar(255) NOT NULL,
  `clm_prodid` varchar(255) NOT NULL,
  `clm_price` float NOT NULL,
  `clm_quantity` bigint(255) NOT NULL,
  `clm_date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_orders_dts`
--

INSERT INTO `tbl_orders_dts` (`clm_id`, `clm_orderid`, `clm_prodid`, `clm_price`, `clm_quantity`, `clm_date`) VALUES
(12, '211228092234', 'P102101001406', 26, 3, '2021-12-28 16:22:34'),
(13, '211229095101', 'P102101073106', 25, 1, '2021-12-29 16:51:01'),
(14, '211229095101', 'P102101505009', 55, 1, '2021-12-29 16:51:01'),
(15, '211229095101', 'P102101180705', 19, 1, '2021-12-29 16:51:01'),
(16, '211231012447', 'P102101505009', 55, 1, '2021-12-31 08:24:47'),
(17, '211231012447', 'P102101180705', 19, 1, '2021-12-31 08:24:47'),
(18, '211231012447', 'P102101053905', 45, 1, '2021-12-31 08:24:47'),
(19, '211231012447', 'P102101045209', 60, 1, '2021-12-31 08:24:47'),
(20, '211231012447', 'P102101073106', 25, 1, '2021-12-31 08:24:47'),
(21, '211231012447', 'P102101305109', 55, 1, '2021-12-31 08:24:47'),
(22, '211231012447', 'P102101361105', 19, 1, '2021-12-31 08:24:47'),
(23, '211231012447', 'P102101001406', 27, 1, '2021-12-31 08:24:47'),
(24, '211231013633', 'P102101505009', 55, 1, '2021-12-31 08:36:33'),
(25, '211231023140', 'P102101505009', 55, 1, '2021-12-31 09:31:40'),
(26, '211231023140', 'P102101180705', 19, 1, '2021-12-31 09:31:40'),
(27, '211231023140', 'P102101053905', 45, 1, '2021-12-31 09:31:40'),
(28, '211231023140', 'P102101045209', 60, 1, '2021-12-31 09:31:40'),
(29, '211231031633', 'P102101073106', 25, 5, '2021-12-31 10:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_products`
--

CREATE TABLE `tbl_products` (
  `clm_prodid` varchar(255) NOT NULL,
  `clm_catid` varchar(255) NOT NULL,
  `clm_desc` varchar(255) NOT NULL,
  `clm_price` float NOT NULL,
  `clm_quantity` bigint(255) NOT NULL,
  `clm_image` varchar(255) NOT NULL,
  `clm_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `clm_encoded_by` varchar(50) NOT NULL,
  `clm_edited_by` varchar(50) DEFAULT NULL,
  `clm_date_edited` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_products`
--

INSERT INTO `tbl_products` (`clm_prodid`, `clm_catid`, `clm_desc`, `clm_price`, `clm_quantity`, `clm_image`, `clm_date`, `clm_encoded_by`, `clm_edited_by`, `clm_date_edited`) VALUES
('P102101001406', 'C2109290403', 'Chippy', 27, 96, '1633061640_chippy.jpg', '2021-10-01 12:14:00', 'admin', 'admin', '2021-12-28 16:22:51'),
('P102101045209', 'C2109290257', 'Sprite 1.5L', 60, 98, '1633074720_p4.jpg', '2021-10-01 15:52:04', 'admin', 'admin', '2021-10-21 22:30:01'),
('P102101053905', 'C210929040706', 'Tide Detergent Long Bars', 45, 98, '1633068300_tidebar.jpg', '2021-10-01 11:39:05', 'admin', 'admin', '2021-10-01 14:05:13'),
('P102101073106', 'C2109290403', 'Clover Chips', 25, 94, '1633062660_clover.png', '2021-10-01 12:31:07', 'admin', NULL, NULL),
('P102101180705', 'C2109290259', 'Mega Sardines', 19, 98, '1633057620_mega.jpg', '2021-10-01 11:07:18', 'admin', NULL, NULL),
('P102101305109', 'C2109290257', 'RC 1.5L', 55, 99, '1633074660_p1.jpg', '2021-10-01 15:51:30', 'admin', NULL, NULL),
('P102101361105', 'C2109290259', 'Mega Sardines (SPICY)', 19, 99, '1633057860_mega_spicy.png', '2021-10-01 11:11:36', 'admin', NULL, NULL),
('P102101505009', 'C2109290257', 'Coke 1.5L', 55, 98, '1633074600_p3.png', '2021-10-01 15:50:50', 'admin', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_setup`
--

CREATE TABLE `tbl_setup` (
  `clm_id` int(1) NOT NULL,
  `clm_about_us` varchar(255) DEFAULT NULL,
  `clm_hotline` varchar(255) DEFAULT NULL,
  `clm_email` varchar(255) DEFAULT NULL,
  `clm_fb` varchar(255) DEFAULT NULL,
  `clm_twitter` varchar(255) DEFAULT NULL,
  `clm_instagram` varchar(255) DEFAULT NULL,
  `clm_payment` varchar(255) DEFAULT NULL,
  `clm_delivery_fee` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_setup`
--

INSERT INTO `tbl_setup` (`clm_id`, `clm_about_us`, `clm_hotline`, `clm_email`, `clm_fb`, `clm_twitter`, `clm_instagram`, `clm_payment`, `clm_delivery_fee`) VALUES
(1, '    Simply put, your company profile is a professional introduction and aims to inform people (primarily prospective buyers and stakeholders) your products, services, and current status. A well written company profile is a great opportunity for your compa', '588-9985698', 'kimson.support@gmail.com', 'https://www.facebook.com/', '', '', 'Cash on delivery', 55);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`clm_adminid`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`clm_cartid`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`clm_catid`),
  ADD UNIQUE KEY `clm_name` (`clm_name`);

--
-- Indexes for table `tbl_customers`
--
ALTER TABLE `tbl_customers`
  ADD PRIMARY KEY (`clm_customerid`);

--
-- Indexes for table `tbl_delivery`
--
ALTER TABLE `tbl_delivery`
  ADD PRIMARY KEY (`clm_id`);

--
-- Indexes for table `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`clm_orderid`);

--
-- Indexes for table `tbl_orders_dts`
--
ALTER TABLE `tbl_orders_dts`
  ADD PRIMARY KEY (`clm_id`);

--
-- Indexes for table `tbl_products`
--
ALTER TABLE `tbl_products`
  ADD PRIMARY KEY (`clm_prodid`),
  ADD UNIQUE KEY `clm_image` (`clm_image`);

--
-- Indexes for table `tbl_setup`
--
ALTER TABLE `tbl_setup`
  ADD PRIMARY KEY (`clm_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `clm_cartid` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_delivery`
--
ALTER TABLE `tbl_delivery`
  MODIFY `clm_id` bigint(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_orders_dts`
--
ALTER TABLE `tbl_orders_dts`
  MODIFY `clm_id` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tbl_setup`
--
ALTER TABLE `tbl_setup`
  MODIFY `clm_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
