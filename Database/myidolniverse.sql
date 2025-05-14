-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2022 at 04:17 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `myidolniverse`
--

-- --------------------------------------------------------

--
-- Table structure for table `bandinfo`
--

CREATE TABLE `bandinfo` (
  `band_id` int(11) NOT NULL,
  `band` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bandlogo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ytnewsongkey` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `daterelease` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bandinfo`
--

INSERT INTO `bandinfo` (`band_id`, `band`, `bandlogo`, `ytnewsongkey`, `daterelease`) VALUES
(1, 'BNK48', 'BNK48Logo.jpg', '6mZagYSymB4', '2022-08-28'),
(2, 'CGM48', 'CGM48Logo.jpg', 'Wb_4uhAEaSc', '2022-05-28'),
(3, 'Last Idol TH', 'LastIdolTHLogo.jpg', 'tt5QEyOVywA', '2022-10-28'),
(4, 'The Glass Girls', 'TheGlassGirlsLogo.jpg', 'tiJXMTnGT20', '2022-10-19'),
(5, 'Sora Sora', 'SoraSoraLogo.jpg', 'dSPAHzFTsWY', '2022-10-04'),
(6, 'Daisy Daisy', 'DaisyDaisyLogo.jpg', 'SaZYMrjWZ0s', '2022-09-30'),
(7, 'Peach You', 'PeachYouLogo.jpg', 'O7tZVVtCz4M', '2022-09-08'),
(8, 'Kaibutsu', 'KaibutsuLogo.jpg', 'FmJQASvMXSo', '2022-05-26'),
(9, 'Sumomo', 'SumomoLogo.jpg', '3GXHC1yD8p0', '2022-08-30'),
(10, 'Siam Dream', 'SiamDreamLogo.jpg', 'KC2D9_uiM4A', '2022-05-30'),
(11, 'HatoBito', 'HatoBitoLogo.jpg', 'doepbvCcxHI', '2022-06-17'),
(12, 'HAPPYTAIL', 'HappyTailLogo.png', '_YgJ8LIDdug', '2022-09-02');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `band_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `band_id`, `username`, `comment`, `comment_time`) VALUES
(15, 2, 'NoonTNS', 'เพลงเพราะมาก ๆ เลย', '2022-11-04 02:55:50'),
(16, 3, 'NoonTNS', 'เพลงกอดเลยล่ะกัน เพราะมากเลยครับ', '2022-11-10 07:21:44'),
(19, 1, 'toey', 'Believers!!!!', '2022-11-15 07:27:51'),
(20, 2, 'toey', 'น่ารักทุกคนเลยย', '2022-11-15 08:02:57'),
(21, 2, 'toey', 'CGM48!!!!', '2022-11-15 08:03:09'),
(22, 1, 'toey', ' vvv', '2022-11-16 00:26:28'),
(23, 3, 'P', 'แต่ละคนเสียงหวานมากก', '2022-11-16 05:00:52');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `event_id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `eventname` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `eventdetail` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`event_id`, `username`, `eventname`, `place`, `lat`, `lng`, `start_date`, `end_date`, `eventdetail`) VALUES
(1, 'NoonTNS', '☁️ 𝗕𝗡𝗞𝟰𝟴 𝟭𝟮𝘁𝗵 𝗦𝗶𝗻𝗴𝗹𝗲 “𝗕𝗲𝗹𝗶𝗲𝘃𝗲𝗿𝘀” 🌟\r\n🎙 𝗖𝗚𝗠𝟰𝟴 𝟰𝘁𝗵 𝗦𝗶𝗻𝗴𝗹𝗲 \"𝗠𝗮𝗲𝘀𝗵𝗶𝗸𝗮 𝗠𝘂𝗸𝗮𝗻𝗲𝗲\" 🎙\r\n𝗥𝗼𝗮𝗱𝘀𝗵𝗼𝘄 𝗠𝗶𝗻𝗶 𝗖𝗼𝗻𝗰𝗲𝗿𝘁 & 𝗚𝗿𝗼𝘂𝗽 𝗛𝗶-𝗧𝗼𝘂𝗰𝗵 ', '1st Floor, The Promenade', '13.826713479028161', '100.67675763642978', '2022-11-05', '2022-11-06', NULL),
(3, 'NoonTNS', 'BNK48 Team BⅢ 2nd Stage「Saishuu Bell ga Naru」', 'BNK48 The Campus, The Mall Bangkapi', '13.766212947998156', '100.64249809202407', '2022-11-05', '2022-11-06', NULL),
(4, 'NoonTNS', 'ลอยกระทง ลอยกับเธอ', 'ลานน้ำพุชมดอยหน้า Chiangmai Hall, Central Chiangmai Airport', '18.76796882519132', '98.97527144241725', '2022-11-08', '2022-11-08', NULL),
(5, 'NoonTNS', 'Chicken Idol Party', 'Donki Mall Thonglor 4th Floor', '13.730743506656456', '100.586081650617', '2022-11-05', '2022-11-05', NULL),
(6, 'NoonTNS', '🎙CGM48 4th SINGLE 🎙\r\n⇢ MAESHIKA MUKANEE - สุดเส้นทาง⇠ Road Show', 'ลานกิจกรรมชั้น 1, Central Chiangmai', '18.80656750632086', '99.01819366173372', '2022-11-12', '2022-11-13', 'https://www.facebook.com/cgm48official/posts/pfbid0fWcHcuTapQtDdFcyqFHXcqugMx7tVWAxxTF3tZqA8hiGAusR3ojiwYWuVYt97nXql'),
(7, 'NoonTNS', 'The Paseo Park Cosplay & Idol Matsuri', 'The Paseo กาญจนาภิเษก', '13.76750929504584', '100.4064571932458', '2022-11-13', '2022-11-13', NULL),
(8, 'NoonTNS', 'Yami No Kage', 'Union Mall', '13.813370350704801', '100.56185180378209', '2022-12-10', '2022-12-10', NULL),
(9, 'NoonTNS', 'Niji No Sora 「虹の空」', 'Union Mall', '13.813370350704801', '100.56185180378209', '2022-12-11', '2022-12-11', 'https://www.facebook.com/sorasora.idol/posts/pfbid02nkk3HE9DYHS9NVr1HfAt6ZvnqpfyLz2boCoTXfBDEnhZ9E55yYeZyxyiyEBfs9mBl'),
(10, 'NoonTNS', ' LAST AI ยังหวานอยู่ ✨ ', 'M SPACE ชั้น 3 เมเจอร์ ซีนีเพล็กซ์ รัชโยธิน  ', '13.82857851064133', '100.5684808620336', '2022-11-13', '2022-11-13', NULL),
(11, 'NoonTNS', 'Kaew Natruja \"Dear You\" Concert', 'Union Hall, 6F Union Mall', '13.813370350704801', '100.56185180378209', '2022-11-27', '2022-11-27', 'https://www.facebook.com/idpd.records/posts/pfbid02Vu6Cw4dx4Yq1UPtwkoaNiU5na8jVDhfWeW32ejyo91uK8N9QUmZ6rFqRFKwHQUxXl'),
(12, 'NoonTNS', 'BNK48 Team NV 1st Stage「Theater no Megami 」', 'BNK48 The Campus, The Mall Bangkapi', '13.766212947998156', '100.64249809202407', '2022-11-11', '2022-11-13', 'https://www.facebook.com/bnk48official/posts/pfbid0vTr8mzjCX9JewU1Bod67gb3cQJ9CY4ufR5XiZ1btdTjMXbQgr9w9ttGFTnXf9C1ml'),
(13, 'NoonTNS', '☁️ 𝗕𝗡𝗞𝟰𝟴 𝟭𝟮𝘁𝗵 𝗦𝗶𝗻𝗴𝗹𝗲 “𝗕𝗲𝗹𝗶𝗲𝘃𝗲𝗿𝘀” 🌟\r\n𝗥𝗼𝗮𝗱𝘀𝗵𝗼𝘄 𝗠𝗶𝗻𝗶 𝗖𝗼𝗻𝗰𝗲𝗿𝘁 & 𝗚𝗿𝗼𝘂𝗽 𝗛𝗶-𝗧𝗼𝘂𝗰𝗵 ', 'Central Rama 3', '13.697998957469865', '100.53743249812968', '2022-11-12', '2022-11-13', 'https://www.facebook.com/bnk48official/posts/pfbid0NYJLhxxAwcAZpnRXLPYtzaJSZimDqbz35a9PtgLU21coUFEjy8goZfMMKrLpap4sl'),
(24, 'NoonTNS', '𝐁𝐍𝐊𝟒𝟖 𝟏𝐬𝐭 𝐆𝐄𝐍𝐄𝐑𝐀𝐓𝐈𝐎𝐍 𝐂𝐎𝐍𝐂𝐄𝐑𝐓 「DanD1ion」', 'BITEC Bangna Hall EH98', '13.669656', '100.609722', '2022-12-18', '2022-12-18', 'https://www.facebook.com/bnk48official/posts/pfbid02KndrBrU7GefZatXs4DXqSwPJVX4ZG9HbRRwqfUPZDBE4hqrjSNBs4tU4JG232XE6l'),
(25, 'NoonTNS', '☁️ 𝗕𝗡𝗞𝟰𝟴 𝟭𝟮𝘁𝗵 𝗦𝗶𝗻𝗴𝗹𝗲 “𝗕𝗲𝗹𝗶𝗲𝘃𝗲𝗿𝘀” 🌟 𝗥𝗼𝗮𝗱𝘀𝗵𝗼𝘄 𝗠𝗶𝗻𝗶 𝗖𝗼𝗻𝗰𝗲𝗿𝘁 & 𝗚𝗿𝗼𝘂𝗽 𝗛𝗶-𝗧𝗼𝘂𝗰𝗵  19 NOV 2022 | Seacon Bangkae', 'Seacon บางแค', '13.711763', '100.434132', '2022-11-19', '2022-11-19', 'https://www.facebook.com/bnk48official/posts/pfbid0uWbD86JweFsvw1hGmamYkhUZMW7KF94EWftubXLuxbZyK7TiH3AVRM6Q5YjG9s5Ul'),
(26, 'NoonTNS', 'BNK48 Team BⅢ 2nd Stage「Saishuu Bell ga Naru」Yayee’s Birthday Stage', 'BNK48 The Campus, The Mall Bangkapi', '13.765932', '100.642723', '2022-11-18', '2022-11-18', 'https://www.facebook.com/bnk48official/posts/pfbid05CNMB5CtT168sC5eh3b7PYDafSZ5ZbDd2wzUykkR711nKGoQKvz6MzLWpy9UiLUfl'),
(27, 'NoonTNS', 'BNK48 1st GENERATION Special Single “Jiwaru DAYS” FIRST PERFORMANCE', 'River Square, Terminal 21 Rama 3', '13.689354', '100.505755', '2022-11-20', '2022-11-20', 'https://www.facebook.com/bnk48official/posts/pfbid02WVc9zQ69BKLEpvreQboXBb4m5UnH4k97sfpkzuNomQPmXK4QtYc7Qo4TFs3zAdBVl');

-- --------------------------------------------------------

--
-- Table structure for table `memlive`
--

CREATE TABLE `memlive` (
  `live_id` int(11) NOT NULL,
  `band` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `platform` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `memlive`
--

INSERT INTO `memlive` (`live_id`, `band`, `member`, `date`, `time`, `platform`) VALUES
(1, 'BNK48', 'Piam', '2022-11-06', '20:30:00', 'iAM48 Application'),
(8, 'Last Idol TH', 'Saonoi', '2022-11-07', '19:00:00', 'SMO Live'),
(9, 'Last Idol TH', 'Centre', '2022-11-07', '20:00:00', 'SMO Live'),
(10, 'Last Idol TH', 'Chacha', '2022-11-07', '21:00:00', 'SMO Live'),
(11, 'Last Idol TH', 'My', '2022-11-07', '22:00:00', 'SMO Live'),
(12, 'Last Idol TH', 'Grace', '2022-11-08', '20:00:00', 'SMO Live'),
(13, 'Last Idol TH', 'Preme', '2022-11-08', '21:00:00', 'SMO Live'),
(14, 'Last Idol TH', 'Highway', '2022-11-08', '22:00:00', 'SMO Live'),
(15, 'Last Idol TH', 'Kae', '2022-11-09', '19:00:00', 'SMO Live'),
(16, 'Last Idol TH', 'Minnie', '2022-11-09', '20:00:00', 'SMO Live'),
(17, 'Last Idol TH', 'Eye', '2022-11-09', '21:00:00', 'SMO Live'),
(18, 'Last Idol TH', 'Nall', '2022-11-09', '22:00:00', 'SMO Live'),
(19, 'Last Idol TH', 'Saonoi', '2022-11-10', '19:00:00', 'SMO Live'),
(20, 'Last Idol TH', 'Yodnam', '2022-11-10', '20:00:00', 'SMO Live'),
(21, 'Last Idol TH', 'Fa', '2022-11-10', '21:00:00', 'SMO Live'),
(22, 'Last Idol TH', 'Meemie', '2022-11-10', '22:00:00', 'SMO Live'),
(23, 'Last Idol TH', 'Runma', '2022-11-11', '20:00:00', 'SMO Live'),
(24, 'Last Idol TH', 'Mahnmook', '2022-11-11', '21:00:00', 'SMO Live'),
(25, 'BNK48', 'Peak', '2022-11-08', '21:21:00', 'iAM48 Application'),
(26, 'BNK48', 'Khamin', '2022-11-09', '21:30:00', 'iAM48 Application'),
(28, 'CGM48', 'Kaiwan', '2022-11-09', '22:30:00', 'iAM48 Application'),
(29, 'BNK48', 'Yoghurt', '2022-11-09', '23:00:00', 'iAM48 Application'),
(31, 'CGM48', 'Parima', '2022-11-10', '14:00:00', 'iAM48 Application'),
(32, 'CGM48', 'Jayda', '2022-11-10', '19:00:00', 'iAM48 Application'),
(33, 'BNK48', 'Nine', '2022-11-10', '23:00:00', 'iAM48 Application'),
(34, 'CGM48', 'Ping', '2022-11-17', '16:50:00', 'iAM48 Application'),
(35, 'BNK48', 'Kaofrang', '2022-11-15', '21:20:00', 'iAM48 Application'),
(36, 'BNK48', 'Popper', '2022-11-14', '20:00:00', 'iAM48 Application'),
(37, 'BNK48', 'Yayee', '2022-11-14', '21:30:00', 'iAM48 Application'),
(38, 'Last Idol TH', 'Fa', '2022-11-15', '19:00:00', 'SMO Live'),
(39, 'Last Idol TH', 'Tonnam', '2022-11-15', '20:00:00', 'SMO Live'),
(40, 'Last Idol TH', 'Runma', '2022-11-15', '21:00:00', 'SMO Live'),
(41, 'Last Idol TH', 'Remy', '2022-11-15', '22:00:00', 'SMO Live'),
(42, 'Last Idol TH', 'Knomwhan', '2022-11-16', '19:00:00', 'SMO Live'),
(43, 'Last Idol TH', 'Minnie', '2022-11-16', '20:00:00', 'SMO Live'),
(44, 'Last Idol TH', 'Grace', '2022-11-16', '21:00:00', 'SMO Live'),
(45, 'Last Idol TH', 'Nall', '2022-11-16', '22:00:00', 'SMO Live'),
(46, 'Last Idol TH', 'Saonoi', '2022-11-17', '19:00:00', 'SMO Live'),
(47, 'Last Idol TH', 'Yodnam', '2022-11-17', '20:00:00', 'SMO Live'),
(48, 'Last Idol TH', 'My', '2022-11-17', '21:00:00', 'SMO Live'),
(49, 'Last Idol TH', 'Highway', '2022-11-17', '22:00:00', 'SMO Live'),
(50, 'Last Idol TH', 'Gigy', '2022-11-18', '19:00:00', 'SMO Live'),
(51, 'Last Idol TH', 'Pim', '2022-11-18', '20:00:00', 'SMO Live'),
(54, 'BNK48', 'Nine', '2022-11-15', '20:00:00', '48TH Game Caster'),
(55, 'BNK48', 'Pakwan', '2022-11-15', '22:30:00', '48TH Game Caster'),
(56, 'BNK48', 'Panda', '2022-11-16', '15:00:00', '48TH Game Caster'),
(57, 'BNK48', 'Popper', '2022-11-16', '20:00:00', '48TH Game Caster'),
(58, 'CGM48', 'Izurina', '2022-11-16', '22:30:00', '48TH Game Caster'),
(59, 'BNK48', 'Khamin', '2022-11-17', '20:00:00', '48TH Game Caster'),
(60, 'BNK48', 'Eve', '2022-11-17', '22:30:00', '48TH Game Caster'),
(61, 'BNK48', 'Hoop', '2022-11-18', '20:00:00', '48TH Game Caster'),
(62, 'CGM48', 'Kaning', '2022-11-18', '22:30:00', '48TH Game Caster'),
(63, 'BNK48', 'Pampam', '2022-11-19', '20:00:00', '48TH Game Caster'),
(64, 'BNK48', 'Nine', '2022-11-19', '22:30:00', '48TH Game Caster'),
(65, 'CGM48', 'Kaning', '2022-11-20', '20:00:00', '48TH Game Caster'),
(66, 'CGM48', 'Milk', '2022-11-20', '22:30:00', '48TH Game Caster'),
(67, 'bnk', 'fd', '2022-11-15', '15:30:00', 'FB'),
(70, 'CGM48', 'Nenie', '2022-11-16', '17:00:00', 'iAM48 Application');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`) VALUES
(4, 'NoonTNS', 'tanissorn.thanawich@g.swu.ac.th', '$2y$10$cKIJI890hEMI2lo8bMc/EuGyJgG57Jxogfn2KvfQp0un3XFFLclyi'),
(5, 'NoonTNS1', 'noon_tanissorn@outlook.com', '$2y$10$cKIJI890hEMI2lo8bMc/EuGyJgG57Jxogfn2KvfQp0un3XFFLclyi'),
(6, 'Test1234', 'test@hi.com', '$2y$10$cKIJI890hEMI2lo8bMc/EuGyJgG57Jxogfn2KvfQp0un3XFFLclyi'),
(8, 'user', 'user@gmail.com', '$2y$10$D4Ztr3qY6mAi/mpXwf14FeKtCBdX40PaAGHmgHoHEzR8fiDPEEaq6'),
(9, 'Test123456', 'no_hi@yahoo.com', '$2y$10$TGdyqw40q36OBJIUz6U3Q.zHsmlvsdPIM1utTqC94ka0b0CPFomey'),
(10, 'toey', 'mac101010@gmail.com', '$2y$10$3UDvijZZvLEhbUVty/qUu.BLD9JVXAnZC8wKr1RGw0dWc74/wJvW2'),
(11, 'P', 'patranit.pch@g.swu.ac.th', '$2y$10$geDL6y6OHz8NP31Thh0ifO7ze5oeZ0lXpu0iMgABcfshYszflqT.y'),
(12, '111', '111@jj.com', '$2y$10$S0rfCZDEivrT.kXXxFlz4eg1cFjbbcdcnO3maVwQHGIvbvN9VyCcy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bandinfo`
--
ALTER TABLE `bandinfo`
  ADD PRIMARY KEY (`band_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `memlive`
--
ALTER TABLE `memlive`
  ADD PRIMARY KEY (`live_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bandinfo`
--
ALTER TABLE `bandinfo`
  MODIFY `band_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `memlive`
--
ALTER TABLE `memlive`
  MODIFY `live_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
