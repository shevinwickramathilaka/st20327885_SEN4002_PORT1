-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 01, 2025 at 07:31 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `explore_lk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `username`, `password`, `created_at`) VALUES
(1, 'admin', '$2y$10$M7HSQATRfJi19QFjWpbXuuaO13Yh/wuCu96Wk58laRU3QM8kVD6u.', '2025-08-23 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `destination_id` int(10) UNSIGNED NOT NULL,
  `booking_date` date NOT NULL,
  `travelers` int(11) NOT NULL DEFAULT 1,
  `special_requests` text DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `destination_id`, `booking_date`, `travelers`, `special_requests`, `status`, `created_at`) VALUES
(1, 1, 1, '2025-09-02', 2, 'Need sunrise tour', 'cancelled', '2025-08-23 13:28:52'),
(4, 3, 4, '2025-08-30', 5, 'Need a van', 'confirmed', '2025-08-24 16:57:14'),
(5, 4, 1, '2025-09-03', 1, 'Test', 'confirmed', '2025-08-24 17:27:37'),
(6, 5, 4, '2025-08-30', 1, 'sea view hotel', 'confirmed', '2025-08-24 17:31:03'),
(7, 3, 4, '2025-08-28', 7, 'test', 'cancelled', '2025-08-24 18:49:48'),
(8, 5, 4, '2025-08-27', 3, 'vehicle', 'confirmed', '2025-08-25 02:57:36'),
(9, 6, 13, '2025-08-30', 3, '', 'confirmed', '2025-08-25 18:13:52'),
(10, 7, 8, '2025-08-30', 1, '', 'confirmed', '2025-08-25 18:36:13'),
(11, 8, 8, '2025-09-09', 2, 'A/C Rooms', 'confirmed', '2025-09-01 03:22:55');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `destination_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(150) NOT NULL,
  `slug` varchar(180) DEFAULT NULL,
  `description` text NOT NULL,
  `category` varchar(80) DEFAULT NULL,
  `location_text` varchar(200) DEFAULT NULL,
  `latitude` decimal(10,7) DEFAULT NULL,
  `longitude` decimal(10,7) DEFAULT NULL,
  `price_from` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`destination_id`, `title`, `slug`, `description`, `category`, `location_text`, `latitude`, `longitude`, `price_from`, `image_path`, `created_at`) VALUES
(1, 'Sigiriya Rock Fort', 'sigiriya-rock-fortress', 'Ancient rock fortress with panoramic views.Ancient rock fortress with frescoes and lion\'s paw entrance, dating back to the 5th century. Sigiriya is a UNESCO World Heritage site and one of Sri Lanka\'s most iconic landmarks.', 'Cultural', 'Sigiriya', 7.9567000, 80.7603000, 2500.00, 'uploads/destinations/sigiriya.jpg', '2025-08-23 13:28:52'),
(4, 'Mirissa', NULL, 'a small town on the south coast of Sri Lanka, located in the Matara District of the Southern Province.', NULL, NULL, NULL, NULL, 2300.00, 'uploads/destinations/beach.jpg', '2025-08-24 16:50:49'),
(5, 'Colombo', NULL, 'Colombo City Tour,Vibrant capital city with colonial architecture, museums, and bustling markets.', NULL, NULL, NULL, NULL, 12000.00, 'uploads/destinations/colombo.jpg', '2025-08-24 17:33:07'),
(6, 'Ella', NULL, 'Scenic mountain town known for its waterfalls, hiking trails, and the famous Nine Arch Bridge.\r\nBest Time to Visit: December to March', NULL, NULL, NULL, NULL, 2000.00, 'uploads/destinations/ella.jpg', '2025-08-25 03:42:50'),
(8, 'Kandy', NULL, 'Sacred city with the Temple of the Tooth Relic and beautiful botanical gardens.', NULL, NULL, NULL, NULL, 12000.00, 'uploads/destinations/kandy.jpg', '2025-08-25 03:49:48'),
(9, 'Katharagama', NULL, 'Important pilgrimage site for Hindus, Buddhists and indigenous Vedda people.', NULL, NULL, NULL, NULL, 2900.00, 'uploads/destinations/katharagama.jpg', '2025-08-25 03:50:57'),
(10, 'Galle Fort', NULL, 'Historic fortified city with Dutch colonial architecture, now a UNESCO World Heritage Site', NULL, NULL, NULL, NULL, 5800.00, 'uploads/destinations/galle.jpg', '2025-08-25 03:51:57'),
(11, 'Weligama', NULL, 'Weligama Beach Weligama is known for its beautiful sandy beaches, ideal for surfing and relaxation, attracting both locals and tourists', NULL, NULL, NULL, NULL, 4900.00, 'uploads/destinations/waligama.jpg', '2025-08-25 04:05:52'),
(12, 'Port City', NULL, 'Port City Colombo aims to facilitate connections to the South Asian market through investment opportunities, international business environments, world-class infrastructure, and high-quality sustainable living.', NULL, NULL, NULL, NULL, 6700.00, 'uploads/destinations/portCity.jpg', '2025-08-25 04:07:24'),
(13, 'Nuwara Eliya', NULL, 'Nuwara Eliya is a city in the tea country hills of central Sri Lanka. The naturally landscaped Hakgala Botanical Gardens displays roses and tree ferns, and shelters monkeys and blue magpies.', NULL, NULL, NULL, NULL, 13000.00, 'uploads/destinations/nuwaraEliya.jpg', '2025-08-25 04:08:53');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `destination_id` int(10) UNSIGNED NOT NULL,
  `rating` tinyint(4) NOT NULL CHECK (`rating` between 1 and 5),
  `comment` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'approved',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `destination_id`, `rating`, `comment`, `status`, `created_at`) VALUES
(1, 1, 1, 5, 'Absolutely breathtaking views!', 'approved', '2025-08-23 13:28:52');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `phone`, `created_at`) VALUES
(1, 'John Doe', 'john@example.com', 'john123', '0771234567', '2025-08-23 13:28:52'),
(2, 'Jane Smith', 'jane@example.com', 'jane123', '0779876543', '2025-08-23 13:28:52'),
(3, 'Dilan Ganeshan', 'dilang760@gmail.com', '$2y$10$YaowZCY1brg0dW9W57WnTOIf1bwy4aGocPrKKdW.t2V8ae4RatHaC', NULL, '2025-08-23 18:46:55'),
(4, 'Test', 'Test@gmail.com', '$2y$10$XDqwsorg0dZDVNieq/BZQ.iKqGIFB1W5kvU6bLaZ6fw1mpLr6By5C', NULL, '2025-08-24 17:27:11'),
(5, 'shevin', 'shevin@gmail.com', '$2y$10$6h3l2b2VGFf7S0XWDVyl9evGVWUGJjOh48969tfZZs.pqK/UNMNRG', NULL, '2025-08-24 17:30:31'),
(6, 'kevin', 'kevin@gmail.com', '$2y$10$GdRVxCOVIBnDe/8yHM3KbOk1FEZVu28rX9QXDsGcxKDXEZzFwrUMq', NULL, '2025-08-25 18:12:33'),
(7, 'Nethmi Dewmini', 'nethmi@gmail.com', '$2y$10$Ole5iayuNpZlfoxQqrKqHeSrDLYznh991wyhlREI.l3CiK4.2vr/a', NULL, '2025-08-25 18:34:22'),
(8, 'ravishka', 'ravishka@gmail.com', '$2y$10$12nevontgJUuO10Y05oQ7u9cCq5TfPOsW/Rqf2NM.tTWzw1Smn9PG', NULL, '2025-09-01 03:22:24');

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_bookings_monthly`
-- (See below for the actual view)
--
CREATE TABLE `vw_bookings_monthly` (
`ym` varchar(7)
,`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vw_bookings_status_counts`
-- (See below for the actual view)
--
CREATE TABLE `vw_bookings_status_counts` (
`status` enum('pending','confirmed','cancelled')
,`total` bigint(21)
);

-- --------------------------------------------------------

--
-- Structure for view `vw_bookings_monthly`
--
DROP TABLE IF EXISTS `vw_bookings_monthly`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_bookings_monthly`  AS SELECT date_format(`bookings`.`created_at`,'%Y-%m') AS `ym`, count(0) AS `total` FROM `bookings` GROUP BY date_format(`bookings`.`created_at`,'%Y-%m') ORDER BY date_format(`bookings`.`created_at`,'%Y-%m') DESC ;

-- --------------------------------------------------------

--
-- Structure for view `vw_bookings_status_counts`
--
DROP TABLE IF EXISTS `vw_bookings_status_counts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_bookings_status_counts`  AS SELECT `bookings`.`status` AS `status`, count(0) AS `total` FROM `bookings` GROUP BY `bookings`.`status` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `idx_bookings_user` (`user_id`),
  ADD KEY `idx_bookings_destination` (`destination_id`),
  ADD KEY `idx_bookings_status` (`status`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`destination_id`),
  ADD UNIQUE KEY `uq_destinations_slug` (`slug`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `idx_reviews_destination` (`destination_id`),
  ADD KEY `idx_reviews_status` (`status`),
  ADD KEY `fk_reviews_user` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `destination_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `fk_bookings_destination` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_bookings_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_destination` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`destination_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_reviews_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
