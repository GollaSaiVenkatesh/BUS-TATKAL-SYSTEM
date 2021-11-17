-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 01, 2020 at 03:55 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_no` varchar(6) NOT NULL,
  `bus_type` char(10) NOT NULL,
  `source_city` char(15) NOT NULL,
  `dst_city` char(15) NOT NULL,
  `no_of_seats` int(2) NOT NULL,
  `driver_id` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_no`, `bus_type`, `source_city`, `dst_city`, `no_of_seats`, `driver_id`) VALUES
('A1', 'luxury', 'kavali', 'bengaluru', 36, 'saivenky123'),
('A2', 'luxury', 'kavali', 'bengaluru', 36, 'samba123'),
('A3', 'luxury', 'bengaluru', 'kavali', 36, 'venky123'),
('A4', 'luxury', 'kavali', 'guntur', 36, 'ajay123'),
('A5', 'luxury', 'bengaluru', 'markapur', 36, 'seenu123');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `username` varchar(15) DEFAULT NULL,
  `name` char(15) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`username`, `name`, `password`) VALUES
('saivenky', 'saivenky', '$2y$10$LhkFHRvPY5i5hiaYxEAWx.eVRc613gTxCjxAJX15ve4fn4JaI6LF2'),
('saivenkatesh', 'GOLLA SAI VENKA', '$2y$10$yLlwO9xs73vM5MOo0/hrleFKl/mmg55tLo4Jor8QMsSiyTGE/C3Lu'),
('sai123', 'sai', '$2y$10$GzBfHkz4IW.QDpS725nnY.RMR7wR.pkjS0ff0CK3HBjzm47d.2Mqu'),
('sai1234', 'sai', '$2y$10$l10rpgOEyEVlbDvPyvNquOi.DZtstfM1.Ca2vVcGN81eC1T61kCgq'),
('sumala123', 'sumala', '$2y$10$uZfOAyBp3Psz/dg9lnCmEeSIxWyXrgIUeO2KZnGrn8YhGnF3uJ1/O');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `booking_id` int(11) NOT NULL,
  `c_name` char(20) NOT NULL,
  `gender` char(1) DEFAULT NULL CHECK (`gender` = 'F' or `gender` = 'M'),
  `age` int(3) NOT NULL,
  `cst_mailid` varchar(30) DEFAULT NULL CHECK (`cst_mailid` like '%_@__%.__%'),
  `j_date` varchar(10) DEFAULT NULL CHECK (`j_date` like '____-__-__'),
  `source_city` char(15) DEFAULT NULL,
  `dst_city` char(15) DEFAULT NULL,
  `bus_no` varchar(6) DEFAULT NULL,
  `seat_no` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`booking_id`, `c_name`, `gender`, `age`, `cst_mailid`, `j_date`, `source_city`, `dst_city`, `bus_no`, `seat_no`) VALUES
(7, 'suji', 'F', 45, 'suji@gmail.com', '2020-11-26', 'kavali', 'nellore', 'A1', 9),
(8, 'sai', 'M', 18, 'sai@gmail.com', '2020-11-24', 'kavali', 'tirupathi', 'A2', 10),
(9, 'sai', 'M', 18, 'sai@gmail.com', '2020-11-26', 'kavali', 'tirupathi', 'A2', 12),
(10, 'sai', 'M', 18, 'sai@gmail.com', '2020-11-27', 'kavali', 'tirupathi', 'A2', 12),
(11, 'sai', 'M', 18, 'sai@gmail.com', '2020-11-29', 'kavali', 'tirupathi', 'A1', 18),
(12, 'venky', 'M', 19, 'venky@gmail.com', '2020-11-29', 'kavali', 'tirupathi', 'A1', 19),
(13, 'srihan', 'M', 1, 'srihan@gmail.com', '2020-12-02', 'bengaluru', 'markapur', 'A5', 6),
(14, 'satyanarayana', 'M', 60, 'satyanarayana@gmail.com', '2020-12-02', 'bengaluru', 'markapur', 'A5', 7),
(15, 'sumala', 'F', 35, 'sumal@gmail.com', '2020-12-02', 'bengaluru', 'kadapa', 'A5', 11),
(16, 'chaithu', 'F', 25, 'chaithu@gmail.com', '2020-12-01', 'kavali', 'tirupathi', 'A2', 16),
(17, 'lucky', 'M', 18, 'lucky@gmail.com', '2020-12-01', 'kavali', 'tirupathi', 'A2', 17);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `driver_id` varchar(15) NOT NULL,
  `driver_name` char(20) NOT NULL,
  `driver_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `driver`
--

INSERT INTO `driver` (`driver_id`, `driver_name`, `driver_password`) VALUES
('ajay123', 'ajay', '$2y$10$dwAB0Og.WFk/cM8Liqf.7e7zkSy3bsqsW2HTNFaPQUBhd7OUrxnte'),
('saivenky123', 'saivenkatesh', '$2y$10$y3hpdEXbcYmAq35KMm/JCe0ajxMuGZZDRoTQ.hUYcadUisHZACRYi'),
('samba123', 'samba', '$2y$10$tz8D2msKgnS4FZyizq1I7.MULLACxZKyls0YOHxXyH0Qv1NyuzshO'),
('seenu123', 'seenu', '$2y$10$0H/9IbcMeRUgZI3rv.CG/u812x8iEWbmrPBIHwX/E1dHU5cvcD07q'),
('venky123', 'venky', '$2y$10$M.dFQeT0Y7mG0/eKctVlaOMyCUlEuHTbiYLsfccEdWPFjYfgSpxpi');

-- --------------------------------------------------------

--
-- Table structure for table `seats`
--

CREATE TABLE `seats` (
  `bus_no` varchar(6) NOT NULL,
  `seat_no` int(2) NOT NULL,
  `seat_type` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `seats`
--

INSERT INTO `seats` (`bus_no`, `seat_no`, `seat_type`) VALUES
('A1', 1, 'w'),
('A1', 2, 'nw'),
('A1', 3, 'w'),
('A1', 4, 'w'),
('A1', 5, 'nw'),
('A1', 6, 'nw'),
('A1', 7, 'w'),
('A1', 8, 'w'),
('A1', 9, 'nw'),
('A1', 10, 'nw'),
('A1', 11, 'w'),
('A1', 12, 'w'),
('A1', 13, 'nw'),
('A1', 14, 'nw'),
('A1', 15, 'w'),
('A1', 16, 'w'),
('A1', 17, 'nw'),
('A1', 18, 'nw'),
('A1', 19, 'w'),
('A1', 20, 'w'),
('A1', 21, 'nw'),
('A1', 22, 'nw'),
('A1', 23, 'w'),
('A1', 24, 'w'),
('A1', 25, 'nw'),
('A1', 26, 'nw'),
('A1', 27, 'w'),
('A1', 28, 'w'),
('A1', 29, 'nw'),
('A1', 30, 'nw'),
('A1', 31, 'w'),
('A1', 32, 'w'),
('A1', 33, 'nw'),
('A1', 34, 'nw'),
('A1', 35, 'nw'),
('A1', 36, 'w'),
('A2', 1, 'w'),
('A2', 2, 'nw'),
('A2', 3, 'w'),
('A2', 4, 'w'),
('A2', 5, 'nw'),
('A2', 6, 'nw'),
('A2', 7, 'w'),
('A2', 8, 'w'),
('A2', 9, 'nw'),
('A2', 10, 'nw'),
('A2', 11, 'w'),
('A2', 12, 'w'),
('A2', 13, 'nw'),
('A2', 14, 'nw'),
('A2', 15, 'w'),
('A2', 16, 'w'),
('A2', 17, 'nw'),
('A2', 18, 'nw'),
('A2', 19, 'w'),
('A2', 20, 'w'),
('A2', 21, 'nw'),
('A2', 22, 'nw'),
('A2', 23, 'w'),
('A2', 24, 'w'),
('A2', 25, 'nw'),
('A2', 26, 'nw'),
('A2', 27, 'w'),
('A2', 28, 'w'),
('A2', 29, 'nw'),
('A2', 30, 'nw'),
('A2', 31, 'w'),
('A2', 32, 'w'),
('A2', 33, 'nw'),
('A2', 34, 'nw'),
('A2', 35, 'nw'),
('A2', 36, 'w'),
('A3', 1, 'w'),
('A3', 2, 'nw'),
('A3', 3, 'w'),
('A3', 4, 'w'),
('A3', 5, 'nw'),
('A3', 6, 'nw'),
('A3', 7, 'w'),
('A3', 8, 'w'),
('A3', 9, 'nw'),
('A3', 10, 'nw'),
('A3', 11, 'w'),
('A3', 12, 'w'),
('A3', 13, 'nw'),
('A3', 14, 'nw'),
('A3', 15, 'w'),
('A3', 16, 'w'),
('A3', 17, 'nw'),
('A3', 18, 'nw'),
('A3', 19, 'w'),
('A3', 20, 'w'),
('A3', 21, 'nw'),
('A3', 22, 'nw'),
('A3', 23, 'w'),
('A3', 24, 'w'),
('A3', 25, 'nw'),
('A3', 26, 'nw'),
('A3', 27, 'w'),
('A3', 28, 'w'),
('A3', 29, 'nw'),
('A3', 30, 'nw'),
('A3', 31, 'w'),
('A3', 32, 'w'),
('A3', 33, 'nw'),
('A3', 34, 'nw'),
('A3', 35, 'nw'),
('A3', 36, 'w'),
('A4', 1, 'w'),
('A4', 2, 'nw'),
('A4', 3, 'w'),
('A4', 4, 'w'),
('A4', 5, 'nw'),
('A4', 6, 'nw'),
('A4', 7, 'w'),
('A4', 8, 'w'),
('A4', 9, 'nw'),
('A4', 10, 'nw'),
('A4', 11, 'w'),
('A4', 12, 'w'),
('A4', 13, 'nw'),
('A4', 14, 'nw'),
('A4', 15, 'w'),
('A4', 16, 'w'),
('A4', 17, 'nw'),
('A4', 18, 'nw'),
('A4', 19, 'w'),
('A4', 20, 'w'),
('A4', 21, 'nw'),
('A4', 22, 'nw'),
('A4', 23, 'w'),
('A4', 24, 'w'),
('A4', 25, 'nw'),
('A4', 26, 'nw'),
('A4', 27, 'w'),
('A4', 28, 'w'),
('A4', 29, 'nw'),
('A4', 30, 'nw'),
('A4', 31, 'w'),
('A4', 32, 'w'),
('A4', 33, 'nw'),
('A4', 34, 'nw'),
('A4', 35, 'nw'),
('A4', 36, 'w'),
('A5', 1, 'w'),
('A5', 2, 'nw'),
('A5', 3, 'w'),
('A5', 4, 'w'),
('A5', 5, 'nw'),
('A5', 6, 'nw'),
('A5', 7, 'w'),
('A5', 8, 'w'),
('A5', 9, 'nw'),
('A5', 10, 'nw'),
('A5', 11, 'w'),
('A5', 12, 'w'),
('A5', 13, 'nw'),
('A5', 14, 'nw'),
('A5', 15, 'w'),
('A5', 16, 'w'),
('A5', 17, 'nw'),
('A5', 18, 'nw'),
('A5', 19, 'w'),
('A5', 20, 'w'),
('A5', 21, 'nw'),
('A5', 22, 'nw'),
('A5', 23, 'w'),
('A5', 24, 'w'),
('A5', 25, 'nw'),
('A5', 26, 'nw'),
('A5', 27, 'w'),
('A5', 28, 'w'),
('A5', 29, 'nw'),
('A5', 30, 'nw'),
('A5', 31, 'w'),
('A5', 32, 'w'),
('A5', 33, 'nw'),
('A5', 34, 'nw'),
('A5', 35, 'nw'),
('A5', 36, 'w');

-- --------------------------------------------------------

--
-- Table structure for table `stops`
--

CREATE TABLE `stops` (
  `bus_no` varchar(6) NOT NULL,
  `stop_id` int(10) NOT NULL,
  `stop_name` char(15) NOT NULL,
  `stop_time` varchar(8) DEFAULT NULL CHECK (`stop_time` like '__:__:__'),
  `stop_amnt` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stops`
--

INSERT INTO `stops` (`bus_no`, `stop_id`, `stop_name`, `stop_time`, `stop_amnt`) VALUES
('A1', 1, 'kavali', '06:00:00', 0),
('A1', 2, 'nellore', '07:30:00', 150),
('A1', 3, 'tirupathi', '10:30:00', 200),
('A1', 4, 'bengaluru', '15:30:00', 300),
('A2', 1, 'kavali', '18:00:00', 0),
('A2', 2, 'nellore', '20:30:00', 150),
('A2', 3, 'tirupathi', '22:30:00', 200),
('A2', 4, 'bengaluru', '23:30:00', 300),
('A3', 1, 'bengaluru', '06:00:00', 0),
('A3', 2, 'tirupathi', '07:30:00', 100),
('A3', 3, 'nellore', '10:30:00', 50),
('A3', 4, 'kavali', '15:30:00', 75),
('A4', 1, 'kavali', '07:00:00', 0),
('A4', 2, 'ongole', '08:00:00', 100),
('A4', 3, 'chilkaluripeta', '10:30:00', 50),
('A4', 4, 'guntur', '15:30:00', 75),
('A5', 1, 'bengaluru', '06:00:00', 0),
('A5', 2, 'kadapa', '12:00:00', 300),
('A5', 3, 'porumamilla', '15:00:00', 100),
('A5', 4, 'markapur', '18:00:00', 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_no`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`driver_id`);

--
-- Indexes for table `seats`
--
ALTER TABLE `seats`
  ADD PRIMARY KEY (`bus_no`,`seat_no`);

--
-- Indexes for table `stops`
--
ALTER TABLE `stops`
  ADD PRIMARY KEY (`bus_no`,`stop_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
