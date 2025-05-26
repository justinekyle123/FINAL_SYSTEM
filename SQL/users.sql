-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 26, 2025 at 07:36 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `user_id`, `activity`, `created_at`) VALUES
(1, 1, 'Logged out', '2025-05-26 03:41:34'),
(2, 2, 'Logged in', '2025-05-26 03:41:45'),
(3, 2, 'Logged out', '2025-05-26 03:41:56'),
(4, 1, 'Logged in', '2025-05-26 03:42:09'),
(5, 1, 'Logged out', '2025-05-26 03:50:54'),
(6, 2, 'Logged in', '2025-05-26 03:51:02'),
(7, 2, 'Logged out', '2025-05-26 03:51:36'),
(8, 1, 'Logged in', '2025-05-26 03:51:45'),
(9, 1, 'Logged out', '2025-05-26 03:51:55'),
(10, 1, 'Logged in', '2025-05-26 03:52:02'),
(11, 1, 'Logged out', '2025-05-26 03:52:08'),
(12, 1, 'Logged in', '2025-05-26 03:52:15'),
(13, 1, 'Logged out', '2025-05-26 03:57:33'),
(14, 2, 'Logged in', '2025-05-26 03:57:40'),
(15, 2, 'Logged out', '2025-05-26 03:58:07'),
(16, 1, 'Logged in', '2025-05-26 04:00:46'),
(17, 1, 'Logged out', '2025-05-26 04:12:41'),
(18, 2, 'Logged in', '2025-05-26 04:12:48'),
(19, 2, 'Logged out', '2025-05-26 04:24:18'),
(20, 1, 'Logged in', '2025-05-26 04:24:25'),
(21, 1, 'Logged out', '2025-05-26 04:26:36'),
(22, 2, 'Logged in', '2025-05-26 04:26:43'),
(23, 2, 'Logged out', '2025-05-26 04:26:49'),
(24, 1, 'Logged in', '2025-05-26 04:26:57'),
(25, 1, 'Logged out', '2025-05-26 04:27:04'),
(26, 1, 'Logged in', '2025-05-26 04:27:11'),
(27, 1, 'Logged out', '2025-05-26 04:29:17'),
(28, 2, 'Logged in', '2025-05-26 04:29:26'),
(29, 2, 'Logged out', '2025-05-26 04:40:43'),
(30, 1, 'Logged in', '2025-05-26 04:40:51'),
(31, 1, 'Logged out', '2025-05-26 05:18:52'),
(32, 1, 'Logged in', '2025-05-26 05:19:41'),
(33, 1, 'Logged out', '2025-05-26 05:21:01'),
(34, 1, 'Logged in', '2025-05-26 05:22:14'),
(35, 1, 'Logged out', '2025-05-26 05:22:29'),
(36, 2, 'Logged in', '2025-05-26 05:22:55'),
(37, 2, 'Logged out', '2025-05-26 05:23:02'),
(38, 1, 'Logged in', '2025-05-26 05:28:27'),
(39, 1, 'Logged out', '2025-05-26 05:30:14'),
(40, 2, 'Logged in', '2025-05-26 05:30:21'),
(41, 2, 'Logged out', '2025-05-26 05:31:45'),
(42, 1, 'Logged in', '2025-05-26 05:31:52'),
(43, 1, 'Logged out', '2025-05-26 05:33:09'),
(44, 2, 'Logged in', '2025-05-26 05:33:16'),
(45, 2, 'Logged out', '2025-05-26 05:33:35'),
(46, 1, 'Logged in', '2025-05-26 05:33:45'),
(47, 1, 'Logged out', '2025-05-26 05:36:32'),
(48, 2, 'Logged in', '2025-05-26 05:36:39');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE `destination` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `address` varchar(65) DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`id`, `name`, `description`, `image`, `address`, `contact_number`, `created_at`) VALUES
(1, 'Conel Cave', 'Kalaja Cave is derived from the word Kalaha, which means frying pot due to the formation of the karsts made millions of years ago. Waterfalls and caves are abundant in this area. It produced waterfalls & caves Tourists can explore the Kalaja Cave in General Santos City. The cave has a pool inside that is about three meters deep and 22 meters wide.', '1748232532_cave.jpg', 'Brgy. Conel, General Santos City, South Cotabato, Philippines', '0985826549', '2025-05-26 04:08:52'),
(2, 'Danjugan Island', 'Danjugan Island, a 43-hectare protected area, is a paradise for underwater lovers. The island has 5 lagoons, 244 colourful coral reefs, and 572 diverse species of fish. Danjugan Island is accessible from Bacolod Island, about a 4-hour drive away and 30 minutes by boat away from Cauayan Mainland. To visit, you can take a 3-hour tour for PHP 1,500; a day tour for PHP 2,500; and an overnight stay starting from PHP 3,500.', '1748237577_danjuan.webp', 'Cauayan, Philippines', '09856365985', '2025-05-26 05:32:57'),
(3, ' Kiokong White Rock Wall', 'Seeking an adrenaline rush in the Philippines? Look no further than the Kiokong Eco-Tourism Project in Bukidnon. Here, the majestic Kiokong White Rock Wall offers rock climbing, rappelling, and cliffside camping 400 ft above ground! Adventure awaits with easy access from Davao City or Cagayan de Oro by car', '1748237677_kioko.webp', 'San Jose, Municipality of Quezon, Bukidnon', '06859632541', '2025-05-26 05:34:37'),
(4, 'Mausonoan Island', 'Uncovering a hidden gem in the Philippines, Maosonon Island offers clear turquoise waters and pristine white sandy beaches. This mysterious island in Linapacan, Palawan, offers snorkelling adventures amidst coral reefs and the chance to be one of the first explorers.', '1748237722_palawan.webp', ' Linapacan, Palawan', '09652365214', '2025-05-26 05:35:22'),
(5, 'Pinacanauan River', 'Immerse yourself in the beauty of the Pinacanauan River in Cagayan Valley! This long-flowing river offers thrilling adventures like rafting and kayaking, or a quiet cruise to admire its rock formations', '1748237788_Cagayan.webp', 'uguegarao, Cagayan, Philippines', '0965863254', '2025-05-26 05:36:28');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `user_id`, `message`, `created_at`) VALUES
(1, 2, 'Need more improvements, add new places', '2025-05-26 03:22:27'),
(2, 2, 'Need more practice', '2025-05-26 04:24:17');

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `plan_details` text NOT NULL,
  `travel_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`id`, `user_id`, `destination_id`, `plan_details`, `travel_date`, `created_at`) VALUES
(1, 2, 1, '', NULL, '2025-05-26 04:20:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(25) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(35) DEFAULT NULL,
  `password` varchar(25) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `phone`, `address`, `password`, `role`, `created_at`) VALUES
(1, 'kyle', 'kyle@gmail.com', '0965856325', 'Polomolok', 'kyle123', 'admin', '2025-05-26 03:13:57'),
(2, 'yanzon3', 'okay@gmail.com', '09685632369', 'Polomolok South Cotabato', 'okay123', 'user', '2025-05-26 03:15:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `destination`
--
ALTER TABLE `destination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `destination_id` (`destination_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `destination`
--
ALTER TABLE `destination`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD CONSTRAINT `activity_log_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `plan`
--
ALTER TABLE `plan`
  ADD CONSTRAINT `plan_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `plan_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destination` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
