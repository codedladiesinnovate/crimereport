-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 12, 2020 at 12:13 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crimereport`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(500) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `role`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(255) NOT NULL,
  `category` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'harrassing'),
(2, 'bribery'),
(3, 'blackmail'),
(4, 'false accusation');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `users_id`, `report_id`, `comment`, `date`, `status`) VALUES
(1, 1, 1, 'This is the main thing we should think about', '765689', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `crime`
--

CREATE TABLE `crime` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `crime_subject` varchar(400) NOT NULL,
  `crime_category` varchar(400) NOT NULL,
  `crime_loc` varchar(500) NOT NULL,
  `crime_evidence` varchar(400) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crime`
--

INSERT INTO `crime` (`id`, `user_id`, `fullname`, `crime_subject`, `crime_category`, `crime_loc`, `crime_evidence`, `message`, `date`, `status`) VALUES
(1, '1', 'Ezeh Cynthia', 'ghj', 'Property Extortion', 'aaba', '', 'jhjhj\r\n                                ', '1602376945', 'Disapproved'),
(2, '1', 'Ezeh Cynthia', 'ghj', 'Sars Harrasment', 'aaba', '', '  jhjk                                \r\n                                ', '1602377040', 'Disapproved'),
(3, '1', 'Ezeh Cynthia', 'drdrdr', 'Bribery', 'yui', '', 'p]iufsdzdxfcgvbnm,                  \r\n                                ', '1602377365', 'Disapproved'),
(4, '1', 'Ezeh Cynthia', 'drdrdr', 'Blackmail', 'yui', '', 'kjhgfzd bnm,                   \r\n                                ', '1602377864', 'Disapproved'),
(5, '3', 'Obinna', 'drdrdr', 'Armed Robbery', 'abuja', '', 'hghghhhhhgh', '1602378611', 'Disapproved'),
(6, '1', 'Ezeh Cynthia', 'Bribery', 'Bribery', 'Aba', '', 'The managing director collect bribe                            \r\n                                ', '1602449903', 'Disapproved');

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE `report` (
  `id` int(255) NOT NULL,
  `users_id` varchar(255) NOT NULL,
  `fullname` varchar(300) NOT NULL,
  `category` varchar(300) NOT NULL,
  `state` varchar(500) NOT NULL,
  `lga` varchar(900) NOT NULL,
  `message` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `date` varchar(200) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `users_id`, `fullname`, `category`, `state`, `lga`, `message`, `image`, `date`, `status`) VALUES
(45, '9', 'Uche Uche', 'dfkdkl', 'Akwa Ibom', 'Itu', 'hi', 'certificate-oluakas11.jpg', '1558797791', 'Approved'),
(47, '9', 'Uche Uche', 'mee', 'Abia', 'Ukwa West', 'ji', 'certificate-oluakas11.jpg', '1558800315', 'Disapproved'),
(48, '9', 'Uche Uche', 'mee', 'Akwa Ibom', 'Mkpat-Enin', 'hi', 'images (4).jpeg', '1558800352', 'Approved'),
(49, '1', 'Joy Jioi', 'mee', 'Anambra', 'Idemili South', 'll', 'certificate-cousera11.jpg', '1559079437', 'Disapproved'),
(50, '1', 'Joy Jioi', 'mee', 'Anambra', 'Idemili South', 'll', 'certificate-cousera11.jpg', '1559079459', 'Approved'),
(51, '9', 'Uche Uche', 'blackmail', 'Akwa Ibom', 'Ikot Abasi', 'this is a blackmail isssue', 'upload251120131156.jpg', '1559214753', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `fullname` varchar(400) NOT NULL,
  `email` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `email`, `password`) VALUES
(1, 'Ezeh Cynthia', 'cynthia@gmail.com', '12345'),
(2, 'Jerry Jane', 'jerrry@gmail.com', '12345'),
(3, 'Obinna', 'oby@gmail.com', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `description` longtext NOT NULL,
  `video` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category` varchar(600) NOT NULL,
  `time` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crime`
--
ALTER TABLE `crime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crime`
--
ALTER TABLE `crime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
