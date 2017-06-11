-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 11, 2017 at 07:06 AM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rakib_167636_b59_atomic_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `birthday_table`
--

CREATE TABLE `birthday_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `birthday_table`
--

INSERT INTO `birthday_table` (`id`, `name`, `birthday`, `is_trashed`) VALUES
(42, 'ghjghj', '2017-06-06', 'no'),
(8, 'Rakib', '1995-03-23', 'no'),
(36, 'sdfdsffsd', '2017-06-08', 'no'),
(41, 'ghjhgj', '2017-06-08', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `book_title`
--

CREATE TABLE `book_title` (
  `id` int(11) NOT NULL,
  `book_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `author_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_title`
--

INSERT INTO `book_title` (`id`, `book_title`, `author_name`, `is_trashed`) VALUES
(1, 'Himu', 'Humayun Ahmed', 'no'),
(20, 'sdfsdf', 'sfdsfsdf', 'no'),
(21, 'sfdsdf', 'vvsdvsdv', 'no'),
(22, 'vdsdsv s', 'sdfsdfsf', 'no'),
(10, 'Masud Rana', 'Kazi Anwar hossain', '2017-06-11 00:43:29'),
(19, 'php', 'dot net', '2017-06-11 00:43:29');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `city_name`, `is_trashed`) VALUES
(1, 'Rakib', 'Chittagong', 'no'),
(2, 'Nayan', 'Khulna', 'no'),
(4, 'Jaker Hossain', 'Chittagong', 'no'),
(5, 'sadman', 'Chittagong', '2017-06-06 02:37:24'),
(6, 'imran', 'Rajshahi', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `gender_table`
--

CREATE TABLE `gender_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `gender_table`
--

INSERT INTO `gender_table` (`id`, `name`, `gender`, `is_trashed`) VALUES
(1, 'Rakib', 'male', 'no'),
(2, 'sdsd', 'female', 'no'),
(4, 'hridoy', 'male', 'no'),
(8, 'htykyuk', 'female', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `hobbies_table`
--

CREATE TABLE `hobbies_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hobbies` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hobbies_table`
--

INSERT INTO `hobbies_table` (`id`, `name`, `hobbies`, `is_trashed`) VALUES
(1, 'Rakib', 'gaming, music, painting', '2017-06-11 00:51:13'),
(2, 'Nayan', 'gaming, reading, gardening, cooking, music, painting, photography', '2017-06-11 00:53:49'),
(4, 'Saiful', 'sleeping, sports', '2017-06-08 01:37:15'),
(7, 'Rakib', 'gaming, reading', '2017-06-08 01:37:18'),
(9, 'sdsd', 'cooking, music', '2017-06-11 00:54:04'),
(10, 'rakib', 'gaming', '2017-06-11 00:54:04'),
(11, 'rakib', 'gaming', 'no'),
(12, 'Irfanul Karim', 'painting', 'no'),
(13, 'Rakib', 'traveling', 'no'),
(14, 'sdsd', 'painting, sports', 'no'),
(15, 'rakib', 'music', 'no'),
(16, 'Rakib', 'photography', 'no'),
(17, 'Rakib', 'sports', 'no'),
(18, 'Rakib', 'painting', 'no'),
(19, 'Irfanul Karim', 'photography', 'no'),
(20, 'Rakib', 'traveling', 'no'),
(21, 'asd', 'photography', 'no'),
(22, 'sdsd', 'music', 'no'),
(23, 'Rakib', 'gaming', 'no'),
(24, 'Rakib', 'gaming, traveling, sleeping', 'no');

-- --------------------------------------------------------

--
-- Table structure for table `organization_table`
--

CREATE TABLE `organization_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `organization_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `organization_summary` text COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_table`
--

INSERT INTO `organization_table` (`id`, `name`, `organization_name`, `organization_summary`, `is_trashed`) VALUES
(1, 'Rakib', 'Google', 'Google is an American multinational technology company specializing in Internet-related services and products. These include online advertising technologies, search, cloud computing, software, and hardware. Google was founded in 1998 by Larry Page and Sergey Brin while they were Ph.D. students at Stanford University, in California. Together, they own about 14 percent of its shares, and control 56 percent of the stockholder voting power through supervoting stock. They incorporated Google as a privately held company on September 4, 1998. An initial public offering (IPO) took place on August 19, 2004, and Google moved to its new headquarters in Mountain View, California, nicknamed the Googleplex. In August 2015, Google announced plans to reorganize its various interests as a conglomerate called Alphabet Inc. Google, Alphabet\'s leading subsidiary, will continue to be the umbrella company for Alphabet\'s Internet interests. Upon completion of the restructure, Sundar Pichai became CEO of Google, replacing Larry Page, who became CEO of Alphabet.\r\n\r\nRapid growth since incorporation has triggered a chain of products, acquisitions, and partnerships beyond Google\'s core search engine (Google Search). It offers services designed for work and productivity (Google Docs, Sheets and Slides), email (Gmail/Inbox), scheduling and time management (Google Calendar), cloud storage (Google Drive), social networking (Google+), instant messaging and video chat (Google Allo/Duo/Hangouts), language translation (Google Translate), mapping and turn-by-turn navigation (Google Maps), video sharing (YouTube), notetaking (Google Keep), and photo organizing and editing (Google Photos). The company leads the development of the Android mobile operating system, the Google Chrome web browser, and Chrome OS, a lightweight operating system based on the Chrome browser. Google has moved increasingly into hardware; from 2010 to 2015, it partnered with major electronics manufacturers in the production of its Nexus devices, and in October 2016, it released multiple hardware products (including the Google Pixel smartphone, Home smart speaker, Wifi mesh wireless router, and Daydream View virtual reality headset). The new hardware chief, Rick Osterloh, stated: "a lot of the innovation that we want to do now ends up requiring controlling the end-to-end user experience". Google has also experimented with becoming an Internet carrier. In February 2010, it announced Google Fiber, a fiber-optic infrastructure that was installed in Kansas City; in April 2015, it launched Project Fi in the United States, combining Wi-Fi and cellular networks from different providers; and in 2016, it announced the Google Station initiative to make public Wi-Fi around the world, which had already been deployed in India.\r\n\r\nAlexa, a company that monitors commercial web traffic, lists Google.com as the most visited website in the world. Several other Google services also figure in the top 100 most visited websites, including YouTube and Blogger. Google has been the second most valuable brand in the world for 4 consecutive years, but has received significant criticism involving issues such as privacy concerns, tax avoidance, antitrust, censorship, and search neutrality. Google\'s mission statement, from the outset, was "to organize the world\'s information and make it universally accessible and useful", and its unofficial slogan was "Don\'t be evil". In October 2015, the motto was replaced in the Alphabet corporate code of conduct by the phrase "Do the right thing".', 'no'),
(2, 'Jaker', 'Microesoft', 'Microsoft Corporation is an American multinational technology company headquartered in Redmond, Washington, that develops, manufactures, licenses, supports and sells computer software, consumer electronics and personal computers and services. Its best known software products are the Microsoft Windows line of operating systems, Microsoft Office office suite, and Internet Explorer and Edge web browsers. Its flagship hardware products are the Xbox video game consoles and the Microsoft Surface tablet lineup. As of 2016, it is the world\'s largest software maker by revenue,[7] and one of the world\'s most valuable companies.[8]\r\n\r\nMicrosoft was founded by Paul Allen and Bill Gates on April 4, 1975, to develop and sell BASIC interpreters for the Altair 8800. It rose to dominate the personal computer operating system market with MS-DOS in the mid-1980s, followed by Microsoft Windows. The company\'s 1986 initial public offering (IPO), and subsequent rise in its share price, created three billionaires and an estimated 12,000 millionaires among Microsoft employees. Since the 1990s, it has increasingly diversified from the operating system market and has made a number of corporate acquisitions. In May 2011, Microsoft acquired Skype Technologies for $8.5 billion,[9] and in December 2016 bought LinkedIn for $26.2 billion.[10]\r\n\r\nAs of 2015, Microsoft is market-dominant in the IBM PC-compatible operating system market and the office software suite market, although it has lost the majority of the overall operating system market to Android.[11] The company also produces a wide range of other software for desktops and servers, and is active in areas including Internet search (with Bing), the video game industry (with the Xbox, Xbox 360 and Xbox One consoles), the digital services market (through MSN), and mobile phones (via the operating systems of Nokia\'s former phones[12] and Windows Phone OS). In June 2012, Microsoft entered the personal computer production market for the first time, with the launch of the Microsoft Surface, a line of tablet computers. With the acquisition of Nokia\'s devices and services division to form Microsoft Mobile, the company re-entered the smartphone hardware market, after its previous attempt, Microsoft Kin, which resulted from their acquisition of Danger Inc.[13]\r\n\r\nThe word "Microsoft" is a portmanteau of "microcomputer" and "software".[14]', 'no'),
(7, 'fhgh', 'hjgj', 'gjgjgj', '2017-06-11 13:03:12'),
(8, 'nmj', 'fzdfd', 'n', '2017-06-11 13:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `profile_picture_table`
--

CREATE TABLE `profile_picture_table` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `profile_picture` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_trashed` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profile_picture_table`
--

INSERT INTO `profile_picture_table` (`id`, `name`, `profile_picture`, `is_trashed`) VALUES
(1, 'Rakib', '149611763117492357_1379889135404562_3835424565808167382_o.jpg', 'no'),
(2, 'Shafee', '149611776017498645_1379691338757675_4850179066373656337_n.jpg', 'no'),
(4, 'Rakib', '149629693117493113_1336662653094212_1363116868235578806_o.jpg', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `birthday_table`
--
ALTER TABLE `birthday_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book_title`
--
ALTER TABLE `book_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender_table`
--
ALTER TABLE `gender_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hobbies_table`
--
ALTER TABLE `hobbies_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_table`
--
ALTER TABLE `organization_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profile_picture_table`
--
ALTER TABLE `profile_picture_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `birthday_table`
--
ALTER TABLE `birthday_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
--
-- AUTO_INCREMENT for table `book_title`
--
ALTER TABLE `book_title`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `gender_table`
--
ALTER TABLE `gender_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `hobbies_table`
--
ALTER TABLE `hobbies_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `organization_table`
--
ALTER TABLE `organization_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `profile_picture_table`
--
ALTER TABLE `profile_picture_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
