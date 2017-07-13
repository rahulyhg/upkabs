-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 31, 2017 at 06:39 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `isn_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookmark`
--

CREATE TABLE `bookmark` (
  `id` int(11) NOT NULL,
  `post` int(11) NOT NULL,
  `bookmarker` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deactive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bookmark`
--

INSERT INTO `bookmark` (`id`, `post`, `bookmarker`, `date`, `deactive`) VALUES
(151, 58, 157, '2017-03-20 01:15:33', 0),
(175, 58, 159, '2017-03-20 03:14:55', 0),
(177, 64, 157, '2017-03-22 01:24:45', 0),
(185, 59, 157, '2017-03-27 12:15:47', 0),
(186, 61, 157, '2017-03-27 15:35:30', 0);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `text` varchar(255) NOT NULL,
  `post` int(11) NOT NULL,
  `commentator` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen` int(11) NOT NULL DEFAULT '0',
  `deactive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `text`, `post`, `commentator`, `date`, `seen`, `deactive`) VALUES
(115, 'OMG, gimme me one please :(', 54, 159, '2017-03-09 02:47:24', 1, 0),
(116, 'Yes, come here...', 54, 157, '2017-03-09 14:29:01', 1, 1),
(117, 'Thanks', 54, 159, '2017-03-10 03:52:05', 1, 0),
(118, 'hei, wanna lunch with me?', 54, 159, '2017-03-10 04:44:47', 1, 0),
(119, 'halo halo', 54, 157, '2017-03-12 02:19:14', 1, 1),
(120, 'are you sure?', 55, 159, '2017-03-13 18:20:43', 1, 0),
(121, 'Kumandang', 55, 157, '2017-03-14 04:56:07', 1, 1),
(122, 'Mantap Infonya', 56, 157, '2017-03-14 11:05:43', 1, 1),
(123, 'helo', 56, 157, '2017-03-14 11:07:55', 1, 1),
(124, 'halo', 56, 157, '2017-03-14 11:08:47', 1, 1),
(125, 'helo', 56, 157, '2017-03-14 11:09:35', 1, 1),
(126, 'helo', 56, 157, '2017-03-14 11:09:48', 1, 1),
(127, 'helo', 56, 157, '2017-03-14 11:12:02', 1, 1),
(128, 'helo', 56, 157, '2017-03-14 12:00:48', 1, 1),
(129, 'helo helo', 56, 157, '2017-03-14 12:01:02', 1, 1),
(130, 'helo helo', 56, 157, '2017-03-14 12:01:14', 1, 1),
(131, 'hola', 56, 157, '2017-03-14 12:02:10', 1, 1),
(132, 'a', 56, 157, '2017-03-14 12:03:11', 1, 1),
(133, 'b', 56, 157, '2017-03-14 12:03:15', 1, 1),
(134, 'c', 56, 157, '2017-03-14 12:03:18', 1, 1),
(135, 'a', 56, 157, '2017-03-14 12:03:48', 1, 1),
(136, 'b', 56, 157, '2017-03-14 12:03:50', 1, 1),
(137, 'p', 56, 157, '2017-03-14 12:04:10', 1, 1),
(138, 'a', 56, 157, '2017-03-14 12:04:42', 1, 1),
(139, 'b', 56, 157, '2017-03-14 12:04:44', 1, 1),
(140, 'c', 56, 157, '2017-03-14 12:04:47', 1, 1),
(141, 'b', 56, 157, '2017-03-14 12:05:35', 1, 1),
(142, 'c', 56, 157, '2017-03-14 12:05:38', 1, 1),
(143, 'a', 56, 157, '2017-03-14 12:06:58', 1, 1),
(144, 'b', 56, 157, '2017-03-14 12:09:17', 1, 1),
(145, 'a', 56, 157, '2017-03-14 12:09:19', 1, 1),
(146, 'c', 56, 157, '2017-03-14 12:10:17', 1, 1),
(147, 'z', 56, 157, '2017-03-14 12:11:40', 1, 1),
(148, 'x', 56, 157, '2017-03-14 12:18:40', 1, 1),
(149, 'p', 56, 157, '2017-03-14 12:19:09', 1, 1),
(150, 'p', 56, 157, '2017-03-14 16:03:19', 1, 1),
(151, 'c', 56, 157, '2017-03-14 16:06:14', 1, 1),
(152, 'aa', 56, 157, '2017-03-14 16:07:31', 1, 1),
(153, 'p', 56, 157, '2017-03-14 16:10:22', 1, 1),
(154, 'q', 56, 157, '2017-03-14 16:10:25', 1, 1),
(155, 'Helo', 57, 159, '2017-03-18 10:12:57', 1, 1),
(156, 'pup', 57, 159, '2017-03-18 10:54:16', 1, 0),
(157, 'helo', 58, 159, '2017-03-20 03:03:59', 1, 1),
(158, 'halo', 58, 159, '2017-03-20 03:05:59', 1, 1),
(159, 'helo', 58, 159, '2017-03-20 03:12:57', 1, 0),
(160, 'apa', 58, 159, '2017-03-20 03:13:05', 1, 1),
(161, 'apa', 58, 159, '2017-03-20 03:13:16', 1, 1),
(162, 'kabs', 58, 159, '2017-03-20 03:13:19', 1, 0),
(163, 'Helo', 59, 159, '2017-03-20 07:43:09', 1, 0),
(164, 'a', 59, 159, '2017-03-20 07:43:18', 1, 1),
(165, 'Halo juga', 58, 157, '2017-03-20 07:44:30', 1, 0),
(166, 'bagus juga beritanya', 64, 159, '2017-03-20 17:57:39', 1, 0),
(167, 'apa lu', 64, 157, '2017-03-22 01:24:25', 0, 0),
(168, 'hai', 66, 159, '2017-03-23 13:32:48', 1, 0),
(169, 'helo', 66, 157, '2017-03-23 21:29:45', 0, 1),
(170, 'hai', 66, 157, '2017-03-23 21:29:53', 0, 1),
(171, 'llll', 66, 157, '2017-03-23 21:31:28', 0, 1),
(172, 'pppp', 66, 157, '2017-03-23 21:31:33', 0, 1),
(173, 'ppp', 66, 157, '2017-03-23 21:31:40', 0, 1),
(174, 'a', 66, 157, '2017-03-23 21:32:50', 0, 1),
(175, 'b', 66, 157, '2017-03-23 21:32:55', 0, 1),
(176, 'c', 66, 157, '2017-03-23 21:33:03', 0, 1),
(177, 'd', 66, 157, '2017-03-23 21:33:08', 0, 1),
(178, 'a', 66, 157, '2017-03-23 21:34:10', 0, 1),
(179, 'b', 66, 157, '2017-03-23 21:34:14', 0, 1),
(180, 'c', 66, 157, '2017-03-23 21:34:20', 0, 1),
(181, 'd', 66, 157, '2017-03-23 21:34:25', 0, 1),
(182, 'd', 66, 157, '2017-03-23 21:34:34', 0, 1),
(183, 'e', 66, 157, '2017-03-23 21:34:40', 0, 1),
(184, 'hai\n', 62, 157, '2017-03-24 03:33:19', 0, 0),
(185, 'halo', 59, 157, '2017-03-27 12:15:55', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `connection`
--

CREATE TABLE `connection` (
  `id` int(11) NOT NULL,
  `id_user_a` int(11) NOT NULL,
  `id_user_b` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `receiver` int(11) NOT NULL,
  `sender` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(140) NOT NULL,
  `text` varchar(1000) NOT NULL,
  `media` varchar(100) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `creator` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `deactive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `text`, `media`, `date`, `creator`, `category`, `deactive`) VALUES
(54, 'Food The Day', 'I call it Cireng which have a lot of taste, and Thanks God It''s from Indonesia', 'Rm9vZCBUaGUgRGF5.jpg', '2017-03-09 02:46:35', 157, 'all', 0),
(55, 'Gojeck Vs Kang Angkot', 'Beredar kabar bahwa seainya jikalau dunia bulat', 'no-media.png', '2017-03-12 04:19:11', 157, 'all', 0),
(56, 'Helo', 'Helo helo', 'SGVsbw==.png', '2017-03-14 10:52:57', 157, 'all', 1),
(57, 'Do not to offend ethnicity', 'Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding', 'RG8gbm90IHRvIG9mZmVuZCBldGhuaWNpdHk=.jpg', '2017-03-18 10:11:27', 159, 'all', 0),
(58, 'Helo', 'Helo', 'no-media.png', '2017-03-18 11:02:07', 159, 'all', 0),
(59, 'Test', 'Test', 'VGVzdA==.jpg', '2017-03-20 07:42:31', 159, 'all', 0),
(60, 'Food The Day', 'I call it Cireng which have a lot of taste, and Thanks God It''s from Indonesia', 'Rm9vZCBUaGUgRGF5.jpg', '2017-03-09 02:46:35', 157, 'all', 0),
(61, 'Gojeck Vs Kang Angkot', 'Beredar kabar bahwa seainya jikalau dunia bulat', 'no-media.png', '2017-03-12 04:19:11', 157, 'all', 0),
(62, 'Helo', 'Helo helo', 'SGVsbw==.png', '2017-03-14 10:52:57', 157, 'all', 0),
(63, 'Do not to offend ethnicity', 'Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding Put the refrence to your post for prevent any misunderstanding', 'RG8gbm90IHRvIG9mZmVuZCBldGhuaWNpdHk=.jpg', '2017-03-18 10:11:27', 159, 'all', 0),
(64, 'Test', 'Test', 'VGVzdA==.jpg', '2017-03-20 07:42:31', 159, 'all', 0),
(65, 'Helo', 'Helo', 'no-media.png', '2017-03-18 11:02:07', 159, 'all', 0),
(66, 'helo', 'helo', 'no-media.png', '2017-03-22 00:52:31', 157, 'all', 1),
(67, 'haloooo', 'hhhhh', 'no-media.png', '2017-03-23 14:26:35', 157, 'all', 1);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `leader` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `token`
--

CREATE TABLE `token` (
  `token` varchar(100) NOT NULL,
  `user` int(11) NOT NULL,
  `deactive` int(11) NOT NULL DEFAULT '0',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `token`
--

INSERT INTO `token` (`token`, `user`, `deactive`, `date`) VALUES
('0172131040d3e460d68981a3a1cfeb02', 157, 1, '2017-03-22 14:42:19'),
('060d12c56d36a6bb7af41d59b8f0d232', 157, 1, '2017-03-08 23:31:54'),
('08f5e6299db6a8d7779094729fcc8ecd', 157, 1, '2017-03-24 03:47:46'),
('0e419c228f6b4285d61c414a89c3274b', 157, 1, '2017-03-07 23:47:00'),
('10edd6099488f4bc28b2d886daa9f38a', 157, 0, '2017-03-25 22:50:22'),
('110d2df772211477a726a196602f1cfe', 159, 1, '2017-03-20 07:41:45'),
('13dbd88b41169f3fd091a08f34ee8ec2', 159, 1, '2017-03-18 10:19:53'),
('176de95576529c5238138cd477242561', 157, 1, '2017-03-07 01:43:10'),
('197e9f28fb01fd7ed78c93c0855003eb', 159, 1, '2017-03-09 02:39:32'),
('1a14e577b100611465726dbd7c31e958', 157, 1, '2017-03-22 00:28:36'),
('1af296c4165b3d71bd18380e65c45b51', 159, 1, '2017-03-07 01:26:11'),
('1cd1b9cf032f1b6b0adb161b8183b2dd', 159, 1, '2017-03-19 03:05:39'),
('1ec9ae06b8b6e2568abb91706e370b1b', 157, 0, '2017-03-27 07:53:39'),
('2110f47a1e7ae4fa8bb4b2861c14e189', 157, 0, '2017-03-29 01:59:37'),
('21795881053307b26dfd015e4815f384', 157, 1, '2017-03-14 16:45:53'),
('24f5b5ea8de4f411dd92e5a9d767ecc0', 159, 1, '2017-03-06 10:42:26'),
('278bec1aed730bc5e51b7884cb879baa', 157, 1, '2017-03-06 09:26:04'),
('27ebfc69b0c1157fc2aee11618eb3e32', 159, 1, '2017-03-20 00:24:09'),
('2ad91ca4377ea9b6c5799d7aaf787f1e', 157, 1, '2017-03-10 03:46:12'),
('2da637bb81732d38cf2e73682edadd98', 157, 1, '2017-03-13 00:32:31'),
('2f7ca99f400cca393951ff82d34af3e0', 157, 1, '2017-03-09 02:47:36'),
('3193bec1a55b764734ae56994f83035e', 157, 1, '2017-03-23 03:00:00'),
('33cf0a5191212c7abd2389ae26de14bc', 157, 1, '2017-03-08 14:29:48'),
('34a60ff55fa95a642a1b084e3badede2', 157, 1, '2017-03-22 09:53:33'),
('37006aa482f4d815e2f314c4ca53ff13', 157, 1, '2017-03-11 00:09:11'),
('370c094a545428ccaa0babb6f7a5d2aa', 157, 1, '2017-03-07 01:18:02'),
('37fd80d2ed99679dad51eb91b9d14662', 157, 1, '2017-03-25 11:45:28'),
('380b5b982721cf9bcb8174b95f5b74aa', 157, 1, '2017-03-13 00:36:39'),
('3c0bd94e67cebe44ff2242babcff9301', 157, 1, '2017-03-23 01:20:32'),
('3eb7739e027a735fdd8a693b2d727705', 159, 1, '2017-03-20 14:44:10'),
('430ab8990a8fce8013f1f4669672df2e', 157, 1, '2017-03-14 10:09:37'),
('4417c6b4e97e4d5fa95d3af7cd8467bf', 157, 1, '2017-03-22 09:53:47'),
('445363071ae411ddb43da99d6b5cf50e', 157, 1, '2017-03-22 14:47:42'),
('44cf7676f7304e20960a334899df7f60', 159, 1, '2017-03-19 12:09:44'),
('4f5e0ca0752e2ae3affbc39338bac9f6', 159, 1, '2017-03-07 01:18:39'),
('5183519a72e5b948bec5b686dbeb7c21', 159, 1, '2017-03-20 15:08:21'),
('51961d6de2ddab84e77d0bc3388e3aaf', 159, 1, '2017-03-13 18:20:24'),
('53f311ecaef953f4ebb4b91d7a4092a4', 157, 1, '2017-03-23 21:00:59'),
('54dc45787084dac6b9c4bdd2e2afb056', 159, 1, '2017-03-15 00:16:29'),
('56a800f4ded8ea55e24086b5fc2106e0', 157, 1, '2017-03-14 16:34:25'),
('5a70981b1f0afa3a07947872f7baed25', 157, 1, '2017-03-23 21:02:06'),
('5fbc2b64ddd7faf57897782160e956dc', 157, 1, '2017-03-06 11:40:04'),
('600eac2dec3b1a227eae13d027085f7d', 159, 0, '2017-03-20 17:36:23'),
('633fb84476832f797af08bdab8d6e8a1', 157, 1, '2017-03-06 09:27:14'),
('646e0c6c75700bd800a3c12ebe3d675c', 157, 1, '2017-03-22 09:59:24'),
('6a15d944c65207d6688bf343ad496386', 157, 0, '2017-03-26 10:03:13'),
('6a6def2280fa3be0b61c42c7f021b908', 157, 1, '2017-03-07 10:36:21'),
('716f7851c7f52c501225e104f932e9d0', 157, 0, '2017-03-26 15:05:50'),
('7620a47836ca2b54c4ae1594d80bd982', 157, 1, '2017-03-13 11:28:34'),
('798b2d02fe2af771ff1807445600ccf5', 157, 1, '2017-03-13 18:19:10'),
('79cfa623d6f106285ce2e2ae61fc7bb5', 157, 1, '2017-03-09 02:41:10'),
('7c3b110eecc829a3ffc328213c3f92c0', 157, 1, '2017-03-06 09:17:44'),
('800c7e9844c2b9dec2ac76a85ea80211', 159, 1, '2017-03-19 00:02:19'),
('8090b4b7ffeb8211fbc15260fb64b198', 159, 0, '2017-03-23 13:32:36'),
('826dc5dff7d866ee47259d2075d5f8c5', 157, 1, '2017-03-14 15:59:51'),
('8cb453ed4cccae139d05b4a162df6952', 159, 1, '2017-03-19 18:32:46'),
('8d30be46180b885d470da22509ac27a1', 157, 1, '2017-03-06 08:52:55'),
('937c9a44c950e5f6d426bee91f156748', 157, 1, '2017-03-06 04:50:21'),
('965d6916ba6d1a660b0f67ef8adf3c45', 157, 1, '2017-03-13 11:23:10'),
('a239f9a7e3243a00e4472dcad26e4a7a', 159, 1, '2017-03-20 12:28:16'),
('a55741ac0ff77a77b4d0be59f9c5460d', 157, 1, '2017-03-14 16:51:38'),
('a7d22adad027094078b456873706a965', 159, 0, '2017-03-20 17:30:32'),
('a9ea4db7dfffa7c249fdfbc1592011b2', 157, 1, '2017-03-06 05:16:11'),
('ac52846214bb84354cbe2bf8175d6a5f', 157, 1, '2017-03-09 14:15:54'),
('afad6933847c430cc3b2446583615adc', 157, 0, '2017-03-27 09:51:36'),
('afc5779419b37859ca844360a52a53ca', 157, 1, '2017-03-14 16:52:02'),
('b00e4804c3c9b398155f492604f21929', 159, 1, '2017-03-10 03:48:50'),
('b0fbfdca8bb4eedd16f2d283cc5b50f7', 157, 1, '2017-03-12 02:18:16'),
('b305dcbfb217100f2e34e0307a190a83', 159, 1, '2017-03-18 08:21:08'),
('b5339ae6f666abc5065a1c940e6cd8c4', 157, 1, '2017-03-15 00:30:11'),
('b576be45abc4ca523406781ea9f0ca05', 159, 1, '2017-03-18 10:33:41'),
('b8a6b54a4346ccf91b4c329ffe009129', 157, 1, '2017-03-15 00:29:49'),
('c08fd71ce0d580238d9cb9f0fd6f7d99', 157, 1, '2017-03-09 01:06:48'),
('c19fbc9ded0e20b39c0593a9362e894e', 157, 0, '2017-03-25 13:50:44'),
('c4cb6616ee0f6cd74d31ac2b1698583e', 157, 1, '2017-03-13 05:18:30'),
('c5f54f5dec62615a84340133518fdf8d', 157, 1, '2017-03-24 07:16:29'),
('c6aa4e6c8179c9adff149d9b3f8f386c', 157, 1, '2017-03-21 08:16:54'),
('c7a2e72f2f09a2b0d148625cd0e0b022', 157, 1, '2017-03-14 16:46:48'),
('c91233831fe4445f1555c4036aeff96d', 157, 1, '2017-03-23 12:58:46'),
('ce7f3c5d8ec9665a0a7da0a9302ce9e9', 157, 1, '2017-03-13 05:16:32'),
('cff811e79049e5a3c2d721557c7f4540', 157, 1, '2017-03-14 16:44:24'),
('d0b09e4d9305d626e404074024494ad1', 157, 1, '2017-03-20 00:25:03'),
('d10ecf02913f7385e090819fc0f7bffd', 157, 1, '2017-03-25 11:41:18'),
('d5b4672378998990b851a80b11be43a7', 157, 1, '2017-03-15 00:27:38'),
('e405157b257d3770521067f09069375e', 157, 0, '2017-03-27 03:43:38'),
('eb20e41dd59908b532623e66906b750e', 157, 1, '2017-03-14 00:20:51'),
('ec0647604a18fee66c24a5233babb1e3', 157, 1, '2017-03-14 04:55:49'),
('ecab0dba6381cd5af93a3f23f87c5266', 159, 1, '2017-03-09 02:46:57'),
('ed7cf6895b6e9107f381ca0af0289658', 157, 1, '2017-03-07 23:29:42'),
('ee96db8a0fa72ffa6a5c09010fd41839', 157, 1, '2017-03-20 07:44:20'),
('f78a8e0ae5a7ea8d65e0211c6c156c57', 157, 1, '2017-03-24 02:45:09'),
('f99df4aee2b75a74f5f573dd19b87bb6', 157, 1, '2017-03-13 05:04:35'),
('fa3e649bc2e9f22272e926a2d9a6ed01', 157, 1, '2017-03-07 01:17:59'),
('fb1e24c83b965df110d1c6e99613cd59', 157, 1, '2017-03-15 00:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `up`
--

CREATE TABLE `up` (
  `id` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `lover` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `avatar` varchar(100) NOT NULL DEFAULT 'no-avatar.png',
  `password` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `gender` int(1) DEFAULT NULL,
  `website` varchar(100) DEFAULT NULL,
  `bio` varchar(300) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deactive` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `name`, `avatar`, `password`, `phone`, `position`, `gender`, `website`, `bio`, `date`, `deactive`) VALUES
(157, 'tandry@syawaludin.com', 'tandry syawaludin', 'dGFuZHJ5IHN5YXdhbHVkaW4=.png', 'c0b0d5e96087558a0dea1fb99ead151b', '0812142257754', 'TRTRT', 0, 'www.tandry.id', 'kenapa why selalu always', '2017-01-16 08:53:21', 0),
(159, 'sophie@tiara.com', 'sophie tiara', 'c29waGllIHRpYXJh.jpg', '6988ec3aba1eaddf2435141bf10487ca', '090809809', 'Employee', 0, 'www.sophie.com', 'halo', '2017-03-06 00:52:54', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookmark`
--
ALTER TABLE `bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `connection`
--
ALTER TABLE `connection`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`token`);

--
-- Indexes for table `up`
--
ALTER TABLE `up`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `email_2` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookmark`
--
ALTER TABLE `bookmark`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=186;
--
-- AUTO_INCREMENT for table `connection`
--
ALTER TABLE `connection`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `up`
--
ALTER TABLE `up`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
