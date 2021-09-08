-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 29, 2021 at 07:51 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clms`
--

-- --------------------------------------------------------

--
-- Table structure for table `expire`
--

CREATE TABLE `expire` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `expiredate` text NOT NULL,
  `cat` text NOT NULL,
  `qu` text NOT NULL,
  `price` text NOT NULL,
  `serial` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expire`
--

INSERT INTO `expire` (`id`, `name`, `expiredate`, `cat`, `qu`, `price`, `serial`) VALUES
(5, ' CaCo3', '2021-06-23', 'crystal chemical', '20', '3000', 'NAbntA');

-- --------------------------------------------------------

--
-- Table structure for table `itemhistory`
--

CREATE TABLE `itemhistory` (
  `id` int(11) NOT NULL,
  `i_serial_no` varchar(300) NOT NULL,
  `i_name` varchar(300) NOT NULL,
  `i_quantity` varchar(300) NOT NULL,
  `i_date` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `itemhistory`
--

INSERT INTO `itemhistory` (`id`, `i_serial_no`, `i_name`, `i_quantity`, `i_date`) VALUES
(1, 'N-Abnt', ' colicla', '50', '2021/06/24');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `i_id` int(11) NOT NULL,
  `i_serial_no` varchar(300) NOT NULL,
  `i_expire_date` varchar(300) NOT NULL,
  `i_name` text NOT NULL,
  `i_category` varchar(300) NOT NULL,
  `i_quantity` varchar(300) NOT NULL,
  `i_description` varchar(300) NOT NULL,
  `i_images` varchar(300) NOT NULL,
  `i_price` varchar(300) NOT NULL,
  `i_status` varchar(300) NOT NULL,
  `i_time_added` varchar(300) NOT NULL,
  `whoAddItem` varchar(300) NOT NULL,
  `whoUpdate` varchar(200) NOT NULL,
  `unit` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`i_id`, `i_serial_no`, `i_expire_date`, `i_name`, `i_category`, `i_quantity`, `i_description`, `i_images`, `i_price`, `i_status`, `i_time_added`, `whoAddItem`, `whoUpdate`, `unit`) VALUES
(3, 'N-Abnt', '2021-06-30', ' colicla', 'crystal chemical', '48', 'blue color ', 'coppersulphate.jpg', '99000', 'New', '2021/06/24', 'Seth12', 'Seth12', 'Kg'),
(4, 'NAbntA', '2021-06-23', ' CaCo3', 'crystal chemical', '20', 'expire', 'potassiumu.jfif', '3000', 'Old', '2021/06/25', 'Seth12', '', 'Gr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `type` varchar(300) NOT NULL,
  `status` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `type`, `status`) VALUES
(1, 'ombeni', 'admin', '1234', 'admin', 'ad'),
(2, 'Seth', 'Seth12', '123', 'Staff assistance', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `expire`
--
ALTER TABLE `expire`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `itemhistory`
--
ALTER TABLE `itemhistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`i_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `expire`
--
ALTER TABLE `expire`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `itemhistory`
--
ALTER TABLE `itemhistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `i_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
