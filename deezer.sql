-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jan 04, 2023 at 03:14 PM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deezer`
--

-- --------------------------------------------------------

--
-- Table structure for table `album`
--

CREATE TABLE `album` (
  `id` int NOT NULL,
  `artist_id` int DEFAULT NULL,
  `track_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `album`
--

INSERT INTO `album` (`id`, `artist_id`, `track_id`, `name`) VALUES
(1, 1, 4, 'Album Daft Punk - Veridis Quo'),
(2, 3, 1, 'Album HipHop');

-- --------------------------------------------------------

--
-- Table structure for table `artist`
--

CREATE TABLE `artist` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `artist`
--

INSERT INTO `artist` (`id`, `name`) VALUES
(1, 'daft punk'),
(2, 'pharell'),
(3, 'Balck eyed peace'),
(4, 'snoop dog'),
(5, 'Kanye west\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `content`
--

CREATE TABLE `content` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `album_id` int DEFAULT NULL,
  `playlist_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content`
--

INSERT INTO `content` (`id`, `title`, `description`, `album_id`, `playlist_id`) VALUES
(1, 'content one', 'descripption of content 1', 1, 1),
(2, 'content two', 'description of content 2', 2, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messenger_messages`
--

CREATE TABLE `messenger_messages` (
  `id` bigint NOT NULL,
  `body` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `headers` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue_name` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `available_at` datetime NOT NULL,
  `delivered_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int NOT NULL,
  `valid_from` date DEFAULT NULL,
  `valid_to` date DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `notification_type_id` int DEFAULT NULL,
  `content_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `valid_from`, `valid_to`, `is_read`, `description`, `notification_type_id`, `content_id`, `name`, `created_at`) VALUES
(1, '2022-12-31', '2023-01-31', 1, 'description of notification number 1', 1, 1, 'first notification', '2022-12-13 17:50:16'),
(2, '2023-02-10', '2023-02-25', 1, 'description of notification number 2', 3, 2, 'second notification', '2023-01-02 00:00:00'),
(3, '2023-03-23', '2023-04-22', 1, 'notification 3', 4, 1, 'notification three with content 2 and notification type 4\r\n', '1899-10-10 17:50:25'),
(5, '2023-01-02', '2023-01-14', 1, NULL, NULL, NULL, 'notification unread', '2023-01-21 18:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `notification_center`
--

CREATE TABLE `notification_center` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `notification_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_center`
--

INSERT INTO `notification_center` (`id`, `user_id`, `notification_id`) VALUES
(1, 2, 2),
(2, 2, 1),
(4, 2, 3),
(5, 2, 5);

-- --------------------------------------------------------

--
-- Table structure for table `notification_type`
--

CREATE TABLE `notification_type` (
  `id` int NOT NULL,
  `type` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_type`
--

INSERT INTO `notification_type` (`id`, `type`) VALUES
(1, 'recommendation'),
(2, 'new content'),
(3, 'sharing'),
(4, 'update');

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE `playlist` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`id`, `title`) VALUES
(1, 'Playlist hit 2022'),
(2, 'Playlist hit 2023'),
(3, 'Playlist HipHop'),
(4, 'Playlist album Daft Punk');

-- --------------------------------------------------------

--
-- Table structure for table `track`
--

CREATE TABLE `track` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `track`
--

INSERT INTO `track` (`id`, `title`, `image`) VALUES
(1, 'Vato', 'image track vato'),
(2, 'Lose yourself to dance', 'image lose yourself to dance'),
(3, 'American Boy', 'image American boy'),
(4, 'Veridis Quo', 'image Veridis Quo');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`) VALUES
(1, 'deezer_premium_user_1', 'iampremium@deezer.com'),
(2, 'deezer_premium_user_2', 'iamthesecondpremium@deezer.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `album`
--
ALTER TABLE `album`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_39986E43B7970CF8` (`artist_id`),
  ADD KEY `IDX_39986E435ED23C43` (`track_id`);

--
-- Indexes for table `artist`
--
ALTER TABLE `artist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_FEC530A91137ABCF` (`album_id`),
  ADD KEY `IDX_FEC530A96BBD148` (`playlist_id`);

--
-- Indexes for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_75EA56E0FB7336F0` (`queue_name`),
  ADD KEY `IDX_75EA56E0E3BD61CE` (`available_at`),
  ADD KEY `IDX_75EA56E016BA31DB` (`delivered_at`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_BF5476CAD0520624` (`notification_type_id`),
  ADD KEY `IDX_BF5476CA84A0A3ED` (`content_id`);

--
-- Indexes for table `notification_center`
--
ALTER TABLE `notification_center`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_84571579A76ED395` (`user_id`),
  ADD KEY `IDX_84571579EF1A9D84` (`notification_id`);

--
-- Indexes for table `notification_type`
--
ALTER TABLE `notification_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `playlist`
--
ALTER TABLE `playlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `track`
--
ALTER TABLE `track`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `album`
--
ALTER TABLE `album`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `artist`
--
ALTER TABLE `artist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `content`
--
ALTER TABLE `content`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messenger_messages`
--
ALTER TABLE `messenger_messages`
  MODIFY `id` bigint NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification_center`
--
ALTER TABLE `notification_center`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `notification_type`
--
ALTER TABLE `notification_type`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `playlist`
--
ALTER TABLE `playlist`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `track`
--
ALTER TABLE `track`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `album`
--
ALTER TABLE `album`
  ADD CONSTRAINT `FK_39986E435ED23C43` FOREIGN KEY (`track_id`) REFERENCES `track` (`id`),
  ADD CONSTRAINT `FK_39986E43B7970CF8` FOREIGN KEY (`artist_id`) REFERENCES `artist` (`id`);

--
-- Constraints for table `content`
--
ALTER TABLE `content`
  ADD CONSTRAINT `FK_FEC530A91137ABCF` FOREIGN KEY (`album_id`) REFERENCES `album` (`id`),
  ADD CONSTRAINT `FK_FEC530A96BBD148` FOREIGN KEY (`playlist_id`) REFERENCES `playlist` (`id`);

--
-- Constraints for table `notification`
--
ALTER TABLE `notification`
  ADD CONSTRAINT `FK_BF5476CA84A0A3ED` FOREIGN KEY (`content_id`) REFERENCES `content` (`id`),
  ADD CONSTRAINT `FK_BF5476CAD0520624` FOREIGN KEY (`notification_type_id`) REFERENCES `notification_type` (`id`);

--
-- Constraints for table `notification_center`
--
ALTER TABLE `notification_center`
  ADD CONSTRAINT `FK_84571579A76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`),
  ADD CONSTRAINT `FK_84571579EF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `notification` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
