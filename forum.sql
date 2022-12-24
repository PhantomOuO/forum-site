-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2022-12-24 16:59:19
-- 伺服器版本： 10.4.25-MariaDB
-- PHP 版本： 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `forum`
--

-- --------------------------------------------------------

--
-- 資料表結構 `articles`
--

CREATE TABLE `articles` (
  `article_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `language_id` tinyint(2) NOT NULL,
  `tag_id` tinyint(2) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='文章';

--
-- 傾印資料表的資料 `articles`
--

INSERT INTO `articles` (`article_id`, `member_id`, `language_id`, `tag_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 1, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(2, 9, 1, 1, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(3, 8, 2, 2, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(4, 9, 2, 2, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(5, 8, 3, 3, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(6, 9, 3, 3, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(7, 8, 4, 4, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(8, 9, 4, 4, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(9, 8, 5, 5, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(10, 9, 5, 5, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(11, 8, 6, 6, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(12, 9, 6, 6, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(13, 8, 7, 7, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(14, 9, 7, 7, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(15, 8, 8, 8, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(16, 9, 8, 8, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(17, 8, 9, 1, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(18, 9, 9, 1, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(19, 8, 10, 2, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(20, 9, 10, 2, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(21, 8, 11, 3, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(22, 9, 11, 3, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(23, 8, 12, 4, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(24, 9, 12, 4, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(25, 8, 13, 5, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(26, 9, 13, 5, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(27, 8, 14, 6, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(28, 9, 14, 6, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(29, 8, 15, 7, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(30, 9, 15, 7, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(31, 8, 16, 8, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(32, 9, 16, 8, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(33, 8, 17, 1, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(34, 9, 17, 1, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(35, 8, 18, 2, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(36, 9, 18, 2, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(37, 8, 19, 3, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(38, 9, 19, 3, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(39, 8, 20, 4, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(40, 9, 20, 4, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(41, 8, 21, 5, 'title1238', 'content88', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(42, 9, 21, 5, 'title1239', 'content99', '2022-12-24 15:54:27', '2022-12-24 15:54:27'),
(43, 8, 1, 1, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(44, 9, 1, 1, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(45, 8, 2, 2, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(46, 9, 2, 2, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(47, 8, 3, 3, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(48, 9, 3, 3, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(49, 8, 4, 4, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(50, 9, 4, 4, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(51, 8, 5, 5, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(52, 9, 5, 5, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(53, 8, 6, 6, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(54, 9, 6, 6, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(55, 8, 7, 7, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(56, 9, 7, 7, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(57, 8, 8, 8, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(58, 9, 8, 8, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(59, 8, 9, 1, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(60, 9, 9, 1, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(61, 8, 10, 2, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(62, 9, 10, 2, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(63, 8, 11, 3, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(64, 9, 11, 3, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(65, 8, 12, 4, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(66, 9, 12, 4, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(67, 8, 13, 5, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(68, 9, 13, 5, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(69, 8, 14, 6, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(70, 9, 14, 6, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(71, 8, 15, 7, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(72, 9, 15, 7, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(73, 8, 16, 8, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(74, 9, 16, 8, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(75, 8, 17, 1, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(76, 9, 17, 1, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(77, 8, 18, 2, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(78, 9, 18, 2, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(79, 8, 19, 3, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(80, 9, 19, 3, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(81, 8, 20, 4, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(82, 9, 20, 4, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(83, 8, 21, 5, 'titleaaa8', 'content88', '2022-12-24 15:56:37', '2022-12-24 15:56:37'),
(84, 9, 21, 5, 'titlebbb9', 'content99', '2022-12-24 15:56:37', '2022-12-24 15:56:37');

-- --------------------------------------------------------

--
-- 資料表結構 `collected_articles`
--

CREATE TABLE `collected_articles` (
  `member_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `collection_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='收藏文章';

-- --------------------------------------------------------

--
-- 資料表結構 `comments_article`
--

CREATE TABLE `comments_article` (
  `article_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='留言';

-- --------------------------------------------------------

--
-- 資料表結構 `language_type`
--

CREATE TABLE `language_type` (
  `language_id` tinyint(2) NOT NULL,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='程式語言類型';

--
-- 傾印資料表的資料 `language_type`
--

INSERT INTO `language_type` (`language_id`, `name`) VALUES
(1, 'HTML'),
(2, 'CSS'),
(3, 'PHP'),
(4, 'JavaScript'),
(5, 'JSON'),
(6, 'Node.js'),
(7, 'jQuery'),
(8, 'W3.CSS'),
(9, 'Bootstrap'),
(10, 'Python'),
(11, 'Java'),
(12, 'C++'),
(13, 'C'),
(14, 'c#'),
(15, 'RWD'),
(16, 'React'),
(17, 'ASP.NET'),
(18, 'R'),
(19, 'SQL'),
(20, 'MySQL'),
(21, 'MongoDB');

-- --------------------------------------------------------

--
-- 資料表結構 `members`
--

CREATE TABLE `members` (
  `member_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` blob DEFAULT NULL,
  `permission` tinyint(2) NOT NULL DEFAULT 1,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='會員資料';

--
-- 傾印資料表的資料 `members`
--

INSERT INTO `members` (`member_id`, `username`, `password`, `email`, `photo`, `permission`, `status`, `created_at`) VALUES
(8, '3B032104', 's3B032104', '3B032104@gmail.com', NULL, 1, 1, '2022-12-24 13:25:50'),
(9, '3B032127', 's3B032127', '3B032127@gmail.com', NULL, 1, 1, '2022-12-24 13:25:50');

-- --------------------------------------------------------

--
-- 資料表結構 `permission_type`
--

CREATE TABLE `permission_type` (
  `permission_id` tinyint(2) NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `permission_type`
--

INSERT INTO `permission_type` (`permission_id`, `name`) VALUES
(1, '會員'),
(2, '管理員');

-- --------------------------------------------------------

--
-- 資料表結構 `status_type`
--

CREATE TABLE `status_type` (
  `status_id` tinyint(2) NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='帳號狀態類型';

--
-- 傾印資料表的資料 `status_type`
--

INSERT INTO `status_type` (`status_id`, `name`) VALUES
(1, '正常'),
(2, '黑名單');

-- --------------------------------------------------------

--
-- 資料表結構 `tags_type`
--

CREATE TABLE `tags_type` (
  `tag_id` tinyint(2) NOT NULL,
  `name` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `tags_type`
--

INSERT INTO `tags_type` (`tag_id`, `name`) VALUES
(1, '學術'),
(2, 'BUG'),
(3, '分享'),
(4, '疑問'),
(5, '更新'),
(6, '求助'),
(7, '其他'),
(8, '資源');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `language_id` (`language_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- 資料表索引 `collected_articles`
--
ALTER TABLE `collected_articles`
  ADD KEY `member_id` (`member_id`,`article_id`),
  ADD KEY `article_id` (`article_id`);

--
-- 資料表索引 `comments_article`
--
ALTER TABLE `comments_article`
  ADD KEY `article_id` (`article_id`,`member_id`),
  ADD KEY `member_id` (`member_id`);

--
-- 資料表索引 `language_type`
--
ALTER TABLE `language_type`
  ADD PRIMARY KEY (`language_id`),
  ADD KEY `language_id` (`language_id`);

--
-- 資料表索引 `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`member_id`),
  ADD KEY `permission` (`permission`,`status`),
  ADD KEY `status` (`status`);

--
-- 資料表索引 `permission_type`
--
ALTER TABLE `permission_type`
  ADD PRIMARY KEY (`permission_id`);

--
-- 資料表索引 `status_type`
--
ALTER TABLE `status_type`
  ADD PRIMARY KEY (`status_id`);

--
-- 資料表索引 `tags_type`
--
ALTER TABLE `tags_type`
  ADD PRIMARY KEY (`tag_id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `members`
--
ALTER TABLE `members`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 已傾印資料表的限制式
--

--
-- 資料表的限制式 `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`language_id`) REFERENCES `language_type` (`language_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `articles_ibfk_3` FOREIGN KEY (`tag_id`) REFERENCES `tags_type` (`tag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 資料表的限制式 `collected_articles`
--
ALTER TABLE `collected_articles`
  ADD CONSTRAINT `collected_articles_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `collected_articles_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`);

--
-- 資料表的限制式 `comments_article`
--
ALTER TABLE `comments_article`
  ADD CONSTRAINT `comments_article_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `members` (`member_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `comments_article_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- 資料表的限制式 `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `permission_type` (`permission_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `members_ibfk_2` FOREIGN KEY (`status`) REFERENCES `status_type` (`status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
