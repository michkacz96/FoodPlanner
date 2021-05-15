-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 14, 2021 at 10:57 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `foodlist`
--

-- --------------------------------------------------------

--
-- Table structure for table `mealplans`
--

CREATE TABLE `mealplans` (
  `mealplanID` int(11) NOT NULL,
  `planName` varchar(255) NOT NULL,
  `userID` int(11) NOT NULL,
  `kcalgoal` decimal(6,2) NOT NULL,
  `protgoal` decimal(5,2) NOT NULL,
  `fatgoal` decimal(5,2) NOT NULL,
  `carbsgoal` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `mealID` int(11) NOT NULL,
  `mealName` varchar(255) NOT NULL,
  `mealMass` decimal(5,2) NOT NULL,
  `kcal` decimal(5,2) NOT NULL,
  `prot` decimal(5,2) NOT NULL,
  `fat` decimal(5,2) NOT NULL,
  `carbs` decimal(5,2) NOT NULL,
  `day` int(1) NOT NULL,
  `mealplanID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mealsdetails`
--

CREATE TABLE `mealsdetails` (
  `mealsdetailsID` int(11) NOT NULL,
  `mealplanID` int(11) NOT NULL,
  `mealID` int(11) NOT NULL,
  `mealType` int(11) NOT NULL,
  `weekDay` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user-weight`
--

CREATE TABLE `user-weight` (
  `weightID` int(11) NOT NULL,
  `weightDate` date NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `userID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userID` int(11) NOT NULL,
  `username` varchar(40) NOT NULL,
  `userEmail` varchar(255) NOT NULL,
  `userPdw` varchar(255) NOT NULL,
  `userPwd2` varchar(255) NOT NULL,
  `userGender` int(2) NOT NULL,
  `bornYear` int(4) NOT NULL,
  `userHeight` decimal(5,2) NOT NULL,
  `mealplan` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mealplans`
--
ALTER TABLE `mealplans`
  ADD PRIMARY KEY (`mealplanID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`mealID`);

--
-- Indexes for table `mealsdetails`
--
ALTER TABLE `mealsdetails`
  ADD PRIMARY KEY (`mealsdetailsID`),
  ADD KEY `mealplanID` (`mealplanID`),
  ADD KEY `mealID` (`mealID`);

--
-- Indexes for table `user-weight`
--
ALTER TABLE `user-weight`
  ADD PRIMARY KEY (`weightID`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`),
  ADD KEY `mealplan` (`mealplan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `mealplans`
--
ALTER TABLE `mealplans`
  MODIFY `mealplanID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `mealID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mealsdetails`
--
ALTER TABLE `mealsdetails`
  MODIFY `mealsdetailsID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user-weight`
--
ALTER TABLE `user-weight`
  MODIFY `weightID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mealplans`
--
ALTER TABLE `mealplans`
  ADD CONSTRAINT `mealplans_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `mealplans_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `mealsdetails`
--
ALTER TABLE `mealsdetails`
  ADD CONSTRAINT `mealsdetails_ibfk_1` FOREIGN KEY (`mealplanID`) REFERENCES `mealplans` (`mealplanID`),
  ADD CONSTRAINT `mealsdetails_ibfk_2` FOREIGN KEY (`mealID`) REFERENCES `meals` (`mealID`);

--
-- Constraints for table `user-weight`
--
ALTER TABLE `user-weight`
  ADD CONSTRAINT `user-weight_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`mealplan`) REFERENCES `mealplans` (`mealplanID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
