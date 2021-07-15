-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2021 at 05:57 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_med`
--

-- --------------------------------------------------------

--
-- Table structure for table `add_medicine_shop`
--

CREATE TABLE `add_medicine_shop` (
  `med_id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `added_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `add_medicine_shop`
--

INSERT INTO `add_medicine_shop` (`med_id`, `shop_id`, `quantity`, `added_time`) VALUES
(21, 2, 5, '2021-06-03 08:04:50'),
(22, 2, 5, '2021-06-03 08:05:28'),
(22, 2, 5, '2021-06-03 08:06:46'),
(22, 2, 5, '2021-06-03 08:06:47'),
(22, 2, 5, '2021-06-03 08:06:47'),
(22, 2, 5, '2021-06-03 08:06:48'),
(22, 2, 5, '2021-06-03 08:06:48'),
(22, 2, 5, '2021-06-03 08:06:49'),
(22, 2, 5, '2021-06-03 08:06:49'),
(22, 2, 5, '2021-06-03 08:06:50'),
(22, 2, 5, '2021-06-03 08:06:51'),
(22, 2, 5, '2021-06-03 08:06:51'),
(22, 2, 5, '2021-06-03 08:06:52'),
(22, 2, 5, '2021-06-03 08:06:53'),
(22, 2, 5, '2021-06-03 08:06:53'),
(22, 2, 5, '2021-06-03 08:06:54'),
(22, 2, 5, '2021-06-03 08:06:55'),
(22, 2, 5, '2021-06-03 08:06:56'),
(22, 2, 5, '2021-06-03 08:06:57'),
(22, 2, 5, '2021-06-03 08:06:57'),
(22, 2, 5, '2021-06-03 08:06:58'),
(22, 2, 5, '2021-06-03 08:07:00'),
(22, 2, 5, '2021-06-03 08:07:02'),
(22, 2, 5, '2021-06-03 08:07:04'),
(22, 2, 5, '2021-06-03 08:07:05'),
(22, 2, 5, '2021-06-03 08:07:07'),
(22, 2, 5, '2021-06-03 08:07:08'),
(22, 2, 5, '2021-06-03 08:07:09'),
(22, 2, 5, '2021-06-03 08:07:11'),
(22, 2, 5, '2021-06-03 08:07:12'),
(22, 2, 5, '2021-06-03 08:07:13'),
(22, 2, 5, '2021-06-03 08:07:13'),
(23, 2, 3, '2021-06-03 08:08:52'),
(23, 2, 3, '2021-06-03 08:08:53'),
(23, 2, 3, '2021-06-03 08:08:54'),
(23, 2, 3, '2021-06-03 08:08:54'),
(23, 2, 3, '2021-06-03 08:08:55'),
(23, 2, 3, '2021-06-03 08:08:55'),
(23, 2, 3, '2021-06-03 08:08:56'),
(23, 2, 3, '2021-06-03 08:08:57'),
(23, 2, 3, '2021-06-03 08:08:57'),
(23, 2, 3, '2021-06-03 08:08:58'),
(23, 2, 3, '2021-06-03 08:08:59'),
(19, 2, 5, '2021-06-03 08:10:57'),
(24, 2, 4, '2021-06-03 08:12:28'),
(22, 2, 3, '2021-06-03 08:39:27'),
(22, 2, 2, '2021-06-03 08:42:08'),
(9, 2, 55, '2021-06-03 08:43:14'),
(10, 2, 50, '2021-06-03 08:44:46'),
(10, 2, 50, '2021-06-03 08:46:17'),
(10, 2, 50, '2021-06-03 18:50:30'),
(23, 2, 100, '2021-06-03 18:51:51'),
(3, 1, 50, '2021-06-04 04:06:24'),
(4, 1, 10, '2021-06-04 04:06:34'),
(5, 1, 50, '2021-06-04 04:06:39'),
(21, 2, 40, '2021-06-07 08:27:43'),
(22, 2, 50, '2021-06-15 08:00:20'),
(1, 2, 500, '2021-06-22 17:54:29'),
(3, 1, 15, '2021-06-22 18:10:38'),
(4, 2, 1000, '2021-06-25 16:32:57'),
(4, 2, 100, '2021-07-02 17:13:24'),
(4, 2, 100, '2021-07-02 17:26:26'),
(18, 2, 33, '2021-07-02 18:17:51'),
(14, 2, 44, '2021-07-02 18:18:01');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `mobile` varchar(25) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `remark` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`id`, `shop_id`, `first_name`, `last_name`, `mobile`, `address`, `profile_photo`, `remark`) VALUES
(9, 1, 'Karim', 'Uddin', '0184525555', 'Malibag', '', ''),
(10, 2, 'Rahim', 'Uddin', '01752448423', 'asdfasdf;lk', '', 'sdfa'),
(11, 2, 'Milon', 'Mollah', '01845215474', 'aska;sdfj alsdjf;akjs;alskjf ', '', 'alsdj;faksdjf '),
(12, 2, 'Rafiq', 'Islam', '0175882254', 'Addressasda slkajs;dfkaj a;lskdj', '', 'no remark');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `customer_id` bigint(20) DEFAULT NULL,
  `total` double NOT NULL,
  `percent` double DEFAULT 0,
  `paid` double NOT NULL,
  `due` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `invoice_med`
--

CREATE TABLE `invoice_med` (
  `invoice_id` bigint(20) NOT NULL,
  `medicine_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `medicine`
--

CREATE TABLE `medicine` (
  `id` bigint(20) NOT NULL,
  `brand_name` text DEFAULT NULL,
  `generic_name` text DEFAULT NULL,
  `dosage_form` text DEFAULT NULL,
  `strength` text DEFAULT NULL,
  `manufactured_by` text DEFAULT NULL,
  `unit_price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `medicine`
--

INSERT INTO `medicine` (`id`, `brand_name`, `generic_name`, `dosage_form`, `strength`, `manufactured_by`, `unit_price`) VALUES
(1, '1stCef', 'Cefadroxil Monohydrate', 'Capsule', '500 mg', 'Medimet Pharmaceuticals Ltd.', 15),
(2, '3-Geocef', 'Cefixime Trihydrate', 'Capsule', '200 mg', 'Hallmark Pharmaceuticals Ltd.', 15),
(3, 'A-Fenac', 'Diclofenac Sodium', 'tablet', '50 mg', 'ACME Laboratories Ltd.', 15),
(4, 'A-Fenac', 'Diclofenac Sodium', 'IM injection', '75 mg/3 ml', 'ACME Laboratories Ltd.', 15),
(5, 'A-Fenac', 'Diclofenac Sodium', 'suppository', '12.5 mg', 'ACME Laboratories Ltd.', 15),
(6, 'A-Fenac', 'Diclofenac Sodium', 'suppository', '50 mg', 'ACME Laboratories Ltd.', 15),
(7, 'A-Fenac', 'Diclofenac Sodium', 'gel', '1.16% w/w', 'ACME Laboratories Ltd.', 15),
(8, 'A-Fenac K', 'Diclofenac Potassium', 'tablet', '50 mg', 'ACME Laboratories Ltd.', 15),
(9, 'A-Fenac Plus', 'Diclofenac Sodium + Lidocaine Hydrochloride', 'IM injection', '(75 mg+20 mg)/2 ml', 'ACME Laboratories Ltd.', 15),
(10, 'A-Fenac SR', 'Diclofenac Sodium', 'tablet', '100 mg', 'ACME Laboratories Ltd.', 15),
(11, 'A-Flox', 'Flucloxacillin Sodium', 'capsule', '250 mg', 'ACME Laboratories Ltd.', 15),
(12, 'A-Flox', 'Flucloxacillin Sodium', 'capsule', '500 mg', 'ACME Laboratories Ltd.', 15),
(13, 'A-Flox', 'Flucloxacillin Sodium', 'powder for suspension', '125 mg/5 ml', 'ACME Laboratories Ltd.', 15),
(14, 'A-Flox', 'Flucloxacillin Sodium', 'injection', '500 mg/vial', 'ACME Laboratories Ltd.', 15),
(15, 'A-Flox', 'Flucloxacillin Sodium', 'injection', '250 mg/vial', 'ACME Laboratories Ltd.', 15),
(16, 'A-Forte', 'Vitamin A', 'capsule', '50000 IU', 'Globe Pharmaceuticals Ltd.', 15),
(17, 'A-Kit', 'Mifepristone + Misoprostol', 'tablet', '200 mg+200 mcg', 'ACME Laboratories Ltd.', 15),
(18, 'A-Meb', 'Mebeverine Hydrochloride', 'tablet', '135 mg', 'ACME Laboratories Ltd.', 15),
(19, 'A-Mectin', 'Ivermectin (Oral)', 'tablet', '6 mg', 'ACME Laboratories Ltd.', 15),
(20, 'A-Mectin', 'Ivermectin (Oral)', 'tablet', '12 mg', 'ACME Laboratories Ltd.', 15),
(21, 'A-Migel', 'Miconazole Nitrate (Oral Gel)', 'cream', '2% w/w', 'ACME Laboratories Ltd.', 15),
(22, 'A-Mycin', 'Erythromycin (Lotion)', '', '3%', 'Aristopharma Ltd.', 15),
(23, 'A-Mycin', 'Erythromycin (Oral)', 'tablet', '250 mg', 'Aristopharma Ltd.', 15),
(24, 'A-Mycin', 'Erythromycin (Oral)', 'tablet', '500 mg', 'Aristopharma Ltd.', 15),
(25, 'A-Mycin', 'Erythromycin (Oral)', 'powder for suspension', '125 mg/5 ml', 'Aristopharma Ltd.', 15),
(26, ' A-Mycin', 'Erythromycin (Oral)', 'powder for suspension', '250 mg/5 ml', 'Aristopharma Ltd.', 15),
(27, ' A-Mycin', 'Erythromycin (Oral)', 'powder for suspension', '200 mg/5 ml', 'Aristopharma Ltd.', 15),
(28, ' A-One', 'Paracetamol', 'powder for suspension', '120 mg/5 ml', 'Apex Pharmaceuticals Ltd.', 15),
(29, ' A-One Plus', 'Paracetamol + Caffeine', 'tablet', '500 mg+65 mg', 'Apex Pharmaceuticals Ltd.', 15),
(30, ' A-One XR', 'Paracetamol', 'tablet', '665 mg', 'Apex Pharmaceuticals Ltd.', 15),
(31, ' A-Pak', 'Aceclofenac', 'tablet', '100 mg', 'Benham Pharmaceuticals Ltd.', 15),
(32, ' A-Phenicol', 'Chloramphenicol', 'Drops', '0.5%', 'ACME Laboratories Ltd.', 15);

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `id` bigint(20) NOT NULL,
  `shop_name` varchar(255) DEFAULT NULL,
  `shop_address` text DEFAULT NULL,
  `shop_mobile` varchar(15) DEFAULT NULL,
  `shop_logo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop`
--

INSERT INTO `shop` (`id`, `shop_name`, `shop_address`, `shop_mobile`, `shop_logo`) VALUES
(1, '', '', '', ''),
(2, 'Mizan Med Farma', 'Goshbag', '0145744144', '');

-- --------------------------------------------------------

--
-- Table structure for table `shop_medicine`
--

CREATE TABLE `shop_medicine` (
  `med_id` bigint(20) NOT NULL,
  `shop_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shop_medicine`
--

INSERT INTO `shop_medicine` (`med_id`, `shop_id`, `quantity`, `price`) VALUES
(1, 1, 50, 12),
(2, 2, 52, 16),
(2, 1, 70, 15),
(3, 1, 135, 12),
(4, 1, 62, 16),
(21, 2, 45, 0),
(22, 2, 210, 0),
(23, 2, 133, 0),
(19, 2, 5, 0),
(24, 2, 4, 0),
(9, 2, 55, 0),
(10, 2, 150, 0),
(5, 1, 50, 0),
(1, 2, 500, 0),
(4, 2, 1200, 0),
(18, 2, 33, 0),
(14, 2, 44, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `has_shop` tinyint(1) DEFAULT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `has_shop`, `hash`) VALUES
(1, 'Ruhul', 'Amin', 'redouanmasud4@gmail.com', '$2y$10$BBCpJxgPa8K.iw9ZporxzuW2Lt478RPUV/JFvKRHKzJhIwGhd1tpa', 1, 'c0b2a5de498f56562b4b1bcb2b3cac1e'),
(2, 'Md. Reduan', 'Masud', 'redouanmasud@gmail.com', '$2y$10$FLgWrT/vh1P3E70D0Y3HaOtbBZgPwHgpNMv0T2NCpux.ZbrlqtUCq', 1, '5948b42f9ea03c17be521dcdfc83fc61');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_medicine_shop`
--
ALTER TABLE `add_medicine_shop`
  ADD KEY `med_id` (`med_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shop_id` (`shop_id`),
  ADD KEY `customer_id` (`customer_id`);

--
-- Indexes for table `invoice_med`
--
ALTER TABLE `invoice_med`
  ADD KEY `invoice_id` (`invoice_id`),
  ADD KEY `medicine_id` (`medicine_id`);

--
-- Indexes for table `medicine`
--
ALTER TABLE `medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_medicine`
--
ALTER TABLE `shop_medicine`
  ADD KEY `med_id` (`med_id`),
  ADD KEY `shop_id` (`shop_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer`
--
ALTER TABLE `customer`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `medicine`
--
ALTER TABLE `medicine`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `add_medicine_shop`
--
ALTER TABLE `add_medicine_shop`
  ADD CONSTRAINT `add_medicine_shop_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `add_medicine_shop_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`);

--
-- Constraints for table `invoice`
--
ALTER TABLE `invoice`
  ADD CONSTRAINT `invoice_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`),
  ADD CONSTRAINT `invoice_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`);

--
-- Constraints for table `invoice_med`
--
ALTER TABLE `invoice_med`
  ADD CONSTRAINT `invoice_med_ibfk_1` FOREIGN KEY (`medicine_id`) REFERENCES `medicine` (`id`),
  ADD CONSTRAINT `invoice_med_ibfk_2` FOREIGN KEY (`invoice_id`) REFERENCES `invoice` (`id`);

--
-- Constraints for table `shop`
--
ALTER TABLE `shop`
  ADD CONSTRAINT `shop_ibfk_1` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shop_medicine`
--
ALTER TABLE `shop_medicine`
  ADD CONSTRAINT `shop_medicine_ibfk_1` FOREIGN KEY (`shop_id`) REFERENCES `shop` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `shop_medicine_ibfk_2` FOREIGN KEY (`med_id`) REFERENCES `medicine` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
