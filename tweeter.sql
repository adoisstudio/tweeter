-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 12, 2018 at 10:40 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tweeter`
--

-- --------------------------------------------------------

--
-- Table structure for table `session_master`
--

CREATE TABLE `session_master` (
  `sid` int(11) NOT NULL,
  `session_id` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `expire_on` datetime NOT NULL,
  `expired` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `session_master`
--

INSERT INTO `session_master` (`sid`, `session_id`, `user_id`, `created_on`, `expire_on`, `expired`) VALUES
(101, 'YoWq2soRIfgaPco1ZtPDW5bD4y6SKXQbKJTEU9uUE82K6L88uR', 24, '2018-01-02 14:27:10', '0000-00-00 00:00:00', 1),
(102, 'S3zZwGiUHRyvlmXI9WhbLQTTg019z0Zs569NnhskwDD29syoUh', 24, '2018-01-03 14:20:44', '0000-00-00 00:00:00', 1),
(103, 'xpWjGN0ucXkttNfmtzUR6omnXnuzCSg4IxXOmeLBNEHGsMpQvB', 23, '2018-01-02 18:43:41', '0000-00-00 00:00:00', 1),
(104, 'IXa44C1y1g1clZ2y5FeP2DectUWk9tmDByW31XYZdJhTHpcxTy', 23, '2018-01-03 16:04:09', '0000-00-00 00:00:00', 1),
(105, 'taadu7PRvHsQGgTpmxdC0UBLux2DEDFj3WIPw1aBTCT6B5cx97', 24, '2018-01-03 14:20:54', '0000-00-00 00:00:00', 1),
(106, 'vX7XRySfozieAnpbveGJda8aWY1xwknbYrRjoDiQ4RLM4jH2g0', 24, '2018-01-03 16:04:09', '0000-00-00 00:00:00', 1),
(107, 'mh0z2b8FCL6GTzgcIqNQdX8zCshzM6ogOLpnGCNQsO7duWnFmW', 24, '2018-01-07 10:32:40', '0000-00-00 00:00:00', 1),
(108, 'BV51eEmAxViwHtoNlOQ8ROY28uztNVx76iluw7i4M026mt7P0d', 24, '2018-01-07 10:33:30', '0000-00-00 00:00:00', 1),
(109, 'AZ2vvBKMIfvV31H3mQDi6GHMUCB090Wcm6KpeKs945oDKGzRlK', 24, '2018-01-09 16:45:42', '0000-00-00 00:00:00', 1),
(110, 'SyyF2KFQHatpVBRjky4QqijtCmDMfQMxfYtGruGdho2zSsqhY6', 24, '2018-01-10 15:34:25', '0000-00-00 00:00:00', 1),
(111, 'xfBSIQQ7ffdWvjKHiSFpFuiJIgCZqaxuXGpvFqrYtik2N3mIEi', 24, '2018-01-10 17:36:01', '0000-00-00 00:00:00', 1),
(112, 'hu4PSC5TOmDA3f2AzDWKQs7RqskgBlqEVyUGG4vFXU0nzVYPRh', 23, '2018-01-10 17:36:09', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_comments`
--

CREATE TABLE `user_comments` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `comment` varchar(300) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  `commented_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_comments`
--

INSERT INTO `user_comments` (`comment_id`, `user_id`, `post_id`, `comment`, `deleted`, `commented_on`, `deleted_on`) VALUES
(1, 24, 77, 'very nice', 0, '2018-01-10 17:15:28', '0000-00-00 00:00:00'),
(2, 24, 77, 'nice', 0, '2018-01-10 17:15:49', '0000-00-00 00:00:00'),
(3, 24, 77, 'hi', 0, '2018-01-10 17:28:37', '0000-00-00 00:00:00'),
(4, 24, 77, 'hi', 0, '2018-01-10 17:28:41', '0000-00-00 00:00:00'),
(5, 24, 77, 'asdf', 0, '2018-01-10 17:29:34', '0000-00-00 00:00:00'),
(6, 24, 77, 'saf', 0, '2018-01-10 17:29:37', '0000-00-00 00:00:00'),
(7, 24, 77, 'adsf', 0, '2018-01-10 17:29:39', '0000-00-00 00:00:00'),
(8, 24, 76, 'hi', 0, '2018-01-10 17:32:08', '0000-00-00 00:00:00'),
(9, 24, 77, 'welcome', 0, '2018-01-10 17:33:52', '0000-00-00 00:00:00'),
(10, 24, 67, 'good name', 0, '2018-01-10 17:35:52', '0000-00-00 00:00:00'),
(11, 23, 73, 'hi', 0, '2018-01-10 17:36:28', '0000-00-00 00:00:00'),
(12, 23, 73, 'hello', 0, '2018-01-10 17:36:31', '0000-00-00 00:00:00'),
(13, 23, 69, 'good one', 0, '2018-01-11 11:24:57', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_detail`
--

CREATE TABLE `user_detail` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL DEFAULT '',
  `user_city` varchar(20) NOT NULL DEFAULT '',
  `user_dob` date DEFAULT NULL,
  `user_gender` varchar(10) NOT NULL DEFAULT '',
  `user_country` varchar(20) NOT NULL DEFAULT '',
  `user_pincode` varchar(10) NOT NULL DEFAULT '',
  `user_mobile` bigint(20) DEFAULT NULL,
  `user_dp_url` varchar(100) NOT NULL DEFAULT '../res/user.png',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_detail`
--

INSERT INTO `user_detail` (`user_id`, `user_name`, `user_city`, `user_dob`, `user_gender`, `user_country`, `user_pincode`, `user_mobile`, `user_dp_url`, `created_on`) VALUES
(25, 'Lalit Suthar', 'Sadri', NULL, '', '', '', NULL, '../res/user.png', '2018-01-02 07:13:04'),
(24, 'Rajat Sharma', 'Delhi', NULL, '', '', '', NULL, '../res/user.png', '2018-01-02 07:12:24'),
(23, 'Amit kumar', 'Sadri', NULL, '', '', '', NULL, '../res/user.png', '2018-01-02 07:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_follow`
--

CREATE TABLE `user_follow` (
  `follow_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `followed_by` int(11) NOT NULL,
  `followd_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `following` tinyint(1) NOT NULL DEFAULT '1',
  `unfollow_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_follow`
--

INSERT INTO `user_follow` (`follow_id`, `user_id`, `followed_by`, `followd_on`, `following`, `unfollow_on`) VALUES
(19, 24, 23, '2018-01-10 17:36:21', 1, '0000-00-00 00:00:00'),
(18, 23, 24, '2018-01-02 17:50:17', 1, '0000-00-00 00:00:00'),
(17, 25, 25, '2018-01-02 07:13:04', 1, '0000-00-00 00:00:00'),
(16, 24, 24, '2018-01-02 07:12:24', 1, '0000-00-00 00:00:00'),
(15, 23, 23, '2018-01-02 07:10:06', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_images`
--

CREATE TABLE `user_images` (
  `image_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image_data` mediumblob NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_likes`
--

CREATE TABLE `user_likes` (
  `like_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `liked_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `liking` tinyint(1) NOT NULL DEFAULT '1',
  `unlike_on` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_likes`
--

INSERT INTO `user_likes` (`like_id`, `user_id`, `post_id`, `liked_on`, `liking`, `unlike_on`) VALUES
(2, 24, 50, '2018-01-02 15:06:03', 0, '0000-00-00 00:00:00'),
(3, 24, 52, '2018-01-02 15:42:07', 0, '0000-00-00 00:00:00'),
(4, 24, 33, '2018-01-02 15:43:27', 0, '0000-00-00 00:00:00'),
(5, 24, 54, '2018-01-02 16:10:19', 1, '0000-00-00 00:00:00'),
(6, 24, 56, '2018-01-02 16:13:16', 1, '0000-00-00 00:00:00'),
(7, 24, 57, '2018-01-02 16:14:53', 1, '0000-00-00 00:00:00'),
(8, 24, 58, '2018-01-02 16:16:01', 1, '0000-00-00 00:00:00'),
(9, 24, 59, '2018-01-02 16:16:52', 1, '0000-00-00 00:00:00'),
(10, 24, 60, '2018-01-02 16:18:17', 1, '0000-00-00 00:00:00'),
(11, 24, 61, '2018-01-02 16:18:31', 1, '0000-00-00 00:00:00'),
(12, 24, 62, '2018-01-02 17:29:41', 1, '0000-00-00 00:00:00'),
(13, 24, 63, '2018-01-02 17:29:53', 1, '0000-00-00 00:00:00'),
(14, 24, 64, '2018-01-02 17:33:58', 0, '0000-00-00 00:00:00'),
(15, 24, 65, '2018-01-02 17:35:20', 1, '0000-00-00 00:00:00'),
(16, 23, 20, '2018-01-02 17:35:46', 1, '0000-00-00 00:00:00'),
(17, 23, 67, '2018-01-02 18:30:33', 1, '0000-00-00 00:00:00'),
(18, 24, 67, '2018-01-02 18:30:56', 1, '0000-00-00 00:00:00'),
(19, 23, 68, '2018-01-02 18:35:33', 1, '0000-00-00 00:00:00'),
(20, 23, 69, '2018-01-02 18:35:38', 1, '0000-00-00 00:00:00'),
(21, 23, 70, '2018-01-02 18:35:41', 1, '0000-00-00 00:00:00'),
(22, 23, 71, '2018-01-02 18:35:52', 1, '0000-00-00 00:00:00'),
(23, 23, 72, '2018-01-02 18:37:08', 0, '0000-00-00 00:00:00'),
(24, 24, 72, '2018-01-02 18:37:16', 0, '0000-00-00 00:00:00'),
(25, 24, 71, '2018-01-02 18:39:36', 0, '0000-00-00 00:00:00'),
(26, 23, 73, '2018-01-02 18:43:53', 0, '0000-00-00 00:00:00'),
(27, 23, 74, '2018-01-02 18:44:06', 0, '0000-00-00 00:00:00'),
(28, 24, 75, '2018-01-02 18:44:22', 1, '0000-00-00 00:00:00'),
(29, 24, 70, '2018-01-02 18:46:27', 0, '0000-00-00 00:00:00'),
(30, 24, 69, '2018-01-02 18:46:43', 1, '0000-00-00 00:00:00'),
(31, 24, 68, '2018-01-02 18:46:54', 1, '0000-00-00 00:00:00'),
(32, 24, 20, '2018-01-02 18:47:00', 0, '0000-00-00 00:00:00'),
(33, 24, 73, '2018-01-02 18:47:37', 0, '0000-00-00 00:00:00'),
(34, 24, 76, '2018-01-03 14:23:19', 0, '0000-00-00 00:00:00'),
(35, 24, 77, '2018-01-07 10:32:56', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(16) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_id`, `user_name`, `user_email`, `user_password`, `created_on`) VALUES
(25, 'lksstr', 'lalit@gmail.com', '123123', '2018-01-02 07:13:04'),
(24, 'rajat', 'rajat', 'rajat@786', '2018-01-02 07:12:24'),
(23, 'amitkumar', 'amit@gmail.com', '123123', '2018-01-02 07:10:06');

-- --------------------------------------------------------

--
-- Table structure for table `user_post`
--

CREATE TABLE `user_post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_type` int(11) NOT NULL,
  `post_text` varchar(1000) NOT NULL,
  `img_id` int(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_post`
--

INSERT INTO `user_post` (`post_id`, `user_id`, `post_type`, `post_text`, `img_id`, `created_on`) VALUES
(22, 25, 1, 'Too cold today', 0, '2018-01-02 07:38:49'),
(21, 25, 1, 'I am very happy after tweeting first time.', 0, '2018-01-02 07:38:37'),
(20, 23, 1, 'Welcome Friends.', 0, '2018-01-02 07:37:44'),
(33, 24, 1, 'welcome\nto\nmy\nblog', 0, '2018-01-02 14:27:24'),
(67, 23, 1, 'I am amit', 0, '2018-01-02 18:30:33'),
(54, 24, 1, 'i am very happy to join tweeter.', 0, '2018-01-02 16:08:13'),
(77, 24, 1, 'welcome', 0, '2018-01-07 10:32:56'),
(76, 24, 1, 'asdf', 0, '2018-01-03 14:23:19'),
(75, 24, 1, 'Pad man', 0, '2018-01-02 18:44:22'),
(74, 23, 1, 'super man', 0, '2018-01-02 18:44:06'),
(73, 23, 1, 'welcome', 0, '2018-01-02 18:43:53'),
(72, 23, 1, 'test', 0, '2018-01-02 18:37:08'),
(71, 23, 1, 'hi', 0, '2018-01-02 18:35:52'),
(70, 23, 1, 'asdf', 0, '2018-01-02 18:35:41'),
(69, 23, 1, 'sdf', 0, '2018-01-02 18:35:38'),
(64, 24, 1, 'yes', 0, '2018-01-02 17:33:58'),
(68, 23, 1, 'hi', 0, '2018-01-02 18:35:33');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `session_master`
--
ALTER TABLE `session_master`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `session_id` (`session_id`);

--
-- Indexes for table `user_comments`
--
ALTER TABLE `user_comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `user_detail`
--
ALTER TABLE `user_detail`
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `user_follow`
--
ALTER TABLE `user_follow`
  ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `user_images`
--
ALTER TABLE `user_images`
  ADD UNIQUE KEY `image_id` (`image_id`);

--
-- Indexes for table `user_likes`
--
ALTER TABLE `user_likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- Indexes for table `user_post`
--
ALTER TABLE `user_post`
  ADD UNIQUE KEY `post_id` (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `session_master`
--
ALTER TABLE `session_master`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;
--
-- AUTO_INCREMENT for table `user_comments`
--
ALTER TABLE `user_comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `user_follow`
--
ALTER TABLE `user_follow`
  MODIFY `follow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `user_images`
--
ALTER TABLE `user_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_likes`
--
ALTER TABLE `user_likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `user_post`
--
ALTER TABLE `user_post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
