-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 04, 2020 at 04:05 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id13054734_securecloud`
--

-- --------------------------------------------------------

--
-- Table structure for table `encrypted_files_joined`
--

CREATE TABLE `encrypted_files_joined` (
  `id` int(100) NOT NULL,
  `file_content` text NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `uname` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `encrypted_pass`
--

CREATE TABLE `encrypted_pass` (
  `id` int(100) NOT NULL,
  `pass1` varchar(50) NOT NULL,
  `pass2` varchar(50) NOT NULL,
  `pass3` varchar(50) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `uname` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `files_encrypted`
--

CREATE TABLE `files_encrypted` (
  `id` int(100) NOT NULL,
  `part1` text NOT NULL,
  `part2` text NOT NULL,
  `part3` text NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `uname` varchar(100) NOT NULL,
  `enc_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(10) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `purpose` varchar(1000) NOT NULL,
  `to_user` varchar(100) NOT NULL,
  `from_user` varchar(100) NOT NULL,
  `req_date` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uname` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phno` varchar(100) NOT NULL,
  `ipaddress` varchar(1000) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `encrypted_files_joined`
--
ALTER TABLE `encrypted_files_joined`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `encrypted_pass`
--
ALTER TABLE `encrypted_pass`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `files_encrypted`
--
ALTER TABLE `files_encrypted`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uname` (`uname`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `encrypted_files_joined`
--
ALTER TABLE `encrypted_files_joined`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `encrypted_pass`
--
ALTER TABLE `encrypted_pass`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `files_encrypted`
--
ALTER TABLE `files_encrypted`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
