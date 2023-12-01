-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 23, 2023 at 12:32 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jeros`
--

-- --------------------------------------------------------

--
-- Table structure for table `medicines`
--

CREATE TABLE `medicines` (
  `id` bigint(200) NOT NULL,
  `med_name` varchar(200) NOT NULL,
  `batch_no` bigint(200) NOT NULL,
  `stock_in` bigint(200) NOT NULL,
  `stock_out` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medicines`
--

INSERT INTO `medicines` (`id`, `med_name`, `batch_no`, `stock_in`, `stock_out`) VALUES
(1, 'Ammoxicillin 500mg', 1, 0, 0),
(2, 'Ammoxicillin 500mg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `med_category`
--

CREATE TABLE `med_category` (
  `id` bigint(200) NOT NULL,
  `category_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_category`
--

INSERT INTO `med_category` (`id`, `category_name`) VALUES
(1, 'Antibiotic'),
(2, 'statins');

-- --------------------------------------------------------

--
-- Table structure for table `med_list`
--

CREATE TABLE `med_list` (
  `id` int(200) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `stock_in` bigint(200) NOT NULL,
  `stock_out` bigint(200) NOT NULL,
  `expired` bigint(200) NOT NULL,
  `available_stock` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `med_supplier`
--

CREATE TABLE `med_supplier` (
  `supplier_id` bigint(200) NOT NULL,
  `supplier_name` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contact` bigint(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_supplier`
--

INSERT INTO `med_supplier` (`supplier_id`, `supplier_name`, `address`, `contact`) VALUES
(1, 'La Camia General Merchandise', '629 Padre Herrera St. Tondo, Manila', 9123456787);

-- --------------------------------------------------------

--
-- Table structure for table `med_type`
--

CREATE TABLE `med_type` (
  `id` bigint(200) NOT NULL,
  `med_type` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `med_type`
--

INSERT INTO `med_type` (`id`, `med_type`) VALUES
(3, 'Capsul'),
(4, 'Tablet'),
(5, 'Inhaler');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(250) NOT NULL,
  `firstname` varchar(250) NOT NULL,
  `lastname` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `phone_number` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `role`, `firstname`, `lastname`, `email`, `phone_number`) VALUES
(3, 'ronleo', '$2y$10$u0bnMlj/CThrmfdVM1pDEu0HwHID5mD.UjhCMmZqygE2vKxmELtRO', 'admin', 'Ron', 'Leo', 'ronleo@gmail.com', 9919263888),
(4, 'group1', '$2y$10$QT1qZ68il4mI98b1xCJIyOvmFT/b6kYhJfi/871ZJILWNufcNcgvO', 'admin', 'group', 'one', 'groupone@gmail.com', 9123456789),
(6, '', '$2y$10$ZVlj5SqMFlLjED20ZZpjiOkCIc5IZ/j1klwFMyd0QSy4wXn21PkXW', '', '', '', '', 0),
(7, 'tinayy', '$2y$10$jG8QdkTJsuaaV8lV4.rafuSi/VoyQ5tEPIOWFF3447nDEmvfiWzl.', 'staff', 'Tina', 'limjoco', 'limjocotinayy@gmail.com', 931351603);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `medicines`
--
ALTER TABLE `medicines`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `med_category`
--
ALTER TABLE `med_category`
  ADD UNIQUE KEY `id` (`id`) USING BTREE;

--
-- Indexes for table `med_supplier`
--
ALTER TABLE `med_supplier`
  ADD UNIQUE KEY `supplier_id` (`supplier_id`);

--
-- Indexes for table `med_type`
--
ALTER TABLE `med_type`
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `medicines`
--
ALTER TABLE `medicines`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `med_category`
--
ALTER TABLE `med_category`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `med_supplier`
--
ALTER TABLE `med_supplier`
  MODIFY `supplier_id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `med_type`
--
ALTER TABLE `med_type`
  MODIFY `id` bigint(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
