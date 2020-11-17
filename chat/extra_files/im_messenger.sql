-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2018 at 11:13 AM
-- Server version: 5.7.20-log
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `im_messenger`
--
CREATE DATABASE IF NOT EXISTS `im_messenger` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `im_messenger`;

-- --------------------------------------------------------

--
-- Table structure for table `admingroup`
--

CREATE TABLE `admingroup` (
  `id` int(10) UNSIGNED NOT NULL,
  `adminType` int(11) DEFAULT NULL,
  `adminInfo` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `admingroup`
--

TRUNCATE TABLE `admingroup`;
--
-- Dumping data for table `admingroup`
--

INSERT INTO `admingroup` (`id`, `adminType`, `adminInfo`) VALUES(1, 0, 'superUser');
INSERT INTO `admingroup` (`id`, `adminType`, `adminInfo`) VALUES(2, 1, 'subUser');
INSERT INTO `admingroup` (`id`, `adminType`, `adminInfo`) VALUES(3, 2, 'supersuperUser');

-- --------------------------------------------------------

--
-- Table structure for table `admintype`
--

CREATE TABLE `admintype` (
  `id` int(10) UNSIGNED NOT NULL,
  `adminId` int(11) DEFAULT NULL,
  `adminType` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `admintype`
--

TRUNCATE TABLE `admintype`;
--
-- Dumping data for table `admintype`
--

INSERT INTO `admintype` (`id`, `adminId`, `adminType`) VALUES(4, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `admin_contactinfo`
--

CREATE TABLE `admin_contactinfo` (
  `id` int(10) UNSIGNED NOT NULL,
  `email` varchar(500) DEFAULT NULL,
  `phone` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `friend_list`
--

CREATE TABLE `friend_list` (
  `userId` bigint(11) UNSIGNED DEFAULT NULL,
  `friendId` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `im_blocklist`
--

CREATE TABLE `im_blocklist` (
  `u_id` bigint(11) UNSIGNED NOT NULL,
  `g_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `im_group`
--

CREATE TABLE `im_group` (
  `g_id` bigint(11) UNSIGNED NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `createdBy` bigint(11) UNSIGNED DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '1=personal,0=group',
  `block` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'unblock=0,block=1',
  `lastActive` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `im_group_members`
--

CREATE TABLE `im_group_members` (
  `g_id` bigint(11) UNSIGNED DEFAULT NULL,
  `u_id` bigint(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `im_message`
--

CREATE TABLE `im_message` (
  `m_id` bigint(11) UNSIGNED NOT NULL,
  `sender` bigint(11) UNSIGNED DEFAULT NULL,
  `receiver` bigint(11) UNSIGNED DEFAULT NULL,
  `message` longtext,
  `onlyemoji` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'check string contains only emoji',
  `type` varchar(20) DEFAULT NULL COMMENT 'audio,video,image,document',
  `fileName` longtext COMMENT 'real file Name for audio,video,image,document',
  `link` varchar(500) DEFAULT NULL,
  `linkData` longtext,
  `receiver_type` varchar(255) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `time` varchar(100) DEFAULT NULL,
  `date_time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `im_mutelist`
--

CREATE TABLE `im_mutelist` (
  `u_id` bigint(11) UNSIGNED NOT NULL,
  `g_id` bigint(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `im_receiver`
--

CREATE TABLE `im_receiver` (
  `g_id` bigint(11) UNSIGNED NOT NULL,
  `m_id` bigint(11) UNSIGNED NOT NULL,
  `r_id` bigint(11) UNSIGNED NOT NULL,
  `received` int(1) NOT NULL,
  `announced` int(1) NOT NULL DEFAULT '0',
  `time` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `im_usersocket`
--

CREATE TABLE `im_usersocket` (
  `userId` bigint(11) UNSIGNED NOT NULL,
  `socketId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `version` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `migrations`
--

TRUNCATE TABLE `migrations`;
--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`version`) VALUES(11);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userId` bigint(11) UNSIGNED NOT NULL,
  `userSecret` varchar(255) NOT NULL,
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `userEmail` varchar(100) NOT NULL,
  `userPassword` varchar(255) NOT NULL,
  `userMobile` varchar(30) DEFAULT NULL,
  `userDateOfBirth` timestamp NULL DEFAULT NULL,
  `userGender` varchar(15) DEFAULT NULL,
  `userStatus` int(11) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=inactive,1=active',
  `userVerification` int(11) DEFAULT NULL,
  `userAddress` varchar(255) DEFAULT NULL,
  `userProfilePicture` varchar(255) DEFAULT NULL,
  `userResetToken` varchar(255) DEFAULT NULL,
  `userType` int(11) NOT NULL,
  `lastModified` varchar(100) NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Truncate table before insert `users`
--

TRUNCATE TABLE `users`;
--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userId`, `userSecret`, `firstName`, `lastName`, `userEmail`, `userPassword`, `userMobile`, `userDateOfBirth`, `userGender`, `userStatus`, `active`, `userVerification`, `userAddress`, `userProfilePicture`, `userResetToken`, `userType`, `lastModified`) VALUES(5, 'fX5mHGD7UW', 'anisul', 'hoque', 'anis@gmail.com', '$2y$10$.qRXVQTWkTe2oJTOb/UJbeI9DqcfXyTE4VURlFwrOWuk0u68otW3S', NULL, NULL, NULL, 1, 0, 1, NULL, NULL, NULL, 1, '2017-04-05 20:47:40');
INSERT INTO `users` (`userId`, `userSecret`, `firstName`, `lastName`, `userEmail`, `userPassword`, `userMobile`, `userDateOfBirth`, `userGender`, `userStatus`, `active`, `userVerification`, `userAddress`, `userProfilePicture`, `userResetToken`, `userType`, `lastModified`) VALUES(7, 'MdE9UegmMV', 'admin', '', 'admin@admin.com', '$2y$10$.qRXVQTWkTe2oJTOb/UJbeI9DqcfXyTE4VURlFwrOWuk0u68otW3S', NULL, NULL, NULL, 1, 0, 1, NULL, NULL, NULL, 0, '2017-04-05 20:48:20');
INSERT INTO `users` (`userId`, `userSecret`, `firstName`, `lastName`, `userEmail`, `userPassword`, `userMobile`, `userDateOfBirth`, `userGender`, `userStatus`, `active`, `userVerification`, `userAddress`, `userProfilePicture`, `userResetToken`, `userType`, `lastModified`) VALUES(10, 'btZSmNftbZ', 'Simon', 'hasan', 'simon@gmail.com', '$2y$10$.qRXVQTWkTe2oJTOb/UJbeI9DqcfXyTE4VURlFwrOWuk0u68otW3S', NULL, '0000-00-00 00:00:00', NULL, 1, 1, 1, NULL, NULL, NULL, 1, '2018-03-13 14:09:59');
INSERT INTO `users` (`userId`, `userSecret`, `firstName`, `lastName`, `userEmail`, `userPassword`, `userMobile`, `userDateOfBirth`, `userGender`, `userStatus`, `active`, `userVerification`, `userAddress`, `userProfilePicture`, `userResetToken`, `userType`, `lastModified`) VALUES(11, 'gsdkUwg5Er', 'Hasan', 'Zaman', 'hasan@gmail.com', '$2y$10$CN7oFFzwps4llUCculFz5ungWhdN91LTvrfXVZA0ydkVNnPz/s66W', NULL, NULL, NULL, 1, 0, 1, NULL, NULL, NULL, 1, '2017-10-29 20:49:55');

-- --------------------------------------------------------

--
-- Table structure for table `users_roles`
--

CREATE TABLE `users_roles` (
  `type` int(2) UNSIGNED NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Truncate table before insert `users_roles`
--

TRUNCATE TABLE `users_roles`;
--
-- Dumping data for table `users_roles`
--

INSERT INTO `users_roles` (`type`, `role`) VALUES(0, 'ROLE_ADMIN');
INSERT INTO `users_roles` (`type`, `role`) VALUES(1, 'ROLE_USER');

-- --------------------------------------------------------

--
-- Table structure for table `user_device`
--

CREATE TABLE `user_device` (
  `userId` bigint(11) UNSIGNED NOT NULL,
  `deviceId` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `im_usersessions`
--

CREATE TABLE `im_usersessions` (
  `u_id` bigint(11) NOT NULL,
  `token` longtext NOT NULL,
  `socketId` longtext NOT NULL,
  `lastActiveTime` varchar(100) DEFAULT NULL,
  `validity` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Indexes for table `admingroup`
--
ALTER TABLE `admingroup`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admintype`
--
ALTER TABLE `admintype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_contactinfo`
--
ALTER TABLE `admin_contactinfo`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `im_group`
--
ALTER TABLE `im_group`
  ADD PRIMARY KEY (`g_id`),
  ADD KEY `createdBy` (`createdBy`);

--
-- Indexes for table `im_message`
--
ALTER TABLE `im_message`
  ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Indexes for table `users_roles`
--
ALTER TABLE `users_roles`
  ADD PRIMARY KEY (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admingroup`
--
ALTER TABLE `admingroup`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `admintype`
--
ALTER TABLE `admintype`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admin_contactinfo`
--
ALTER TABLE `admin_contactinfo`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `im_group`
--
ALTER TABLE `im_group`
  MODIFY `g_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `im_message`
--
ALTER TABLE `im_message`
  MODIFY `m_id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userId` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
