-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Mar 26, 2021 at 04:33 AM
-- Server version: 5.7.32
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `match_up_activity`
--

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`chat_id`, `match_id`, `message`, `user_id`, `date`, `status`) VALUES
(3, 27, 'kumsta!', 17, '2021-03-24 01:21:51', 'A'),
(4, 29, 'aaa', 8, '2021-03-24 03:58:30', 'A'),
(5, 29, 'ssss', 8, '2021-03-24 04:20:16', 'A'),
(6, 29, 'I\'m fine', 13, '2021-03-25 01:20:33', 'A'),
(7, 29, 'hello', 13, '2021-03-25 02:15:06', 'A'),
(8, 31, 'Hey!', 7, '2021-03-25 04:34:26', 'A'),
(9, 31, 'Hi, kumsta?', 27, '2021-03-25 04:37:14', 'A'),
(10, 32, 'Hello', 25, '2021-03-25 23:58:48', 'A'),
(11, 32, 'MIsato san!', 25, '2021-03-25 23:59:03', 'A'),
(12, 32, 'Shinji kun!', 20, '2021-03-26 00:04:49', 'A'),
(13, 32, 'Shiji... \r\nDon\'t do anything...', 20, '2021-03-26 00:05:23', 'A'),
(14, 32, 'Are you serious? I can\'t make sense!', 25, '2021-03-26 00:06:20', 'A'),
(15, 33, 'Ayanamiiiiii!!!!!!!!', 25, '2021-03-26 00:08:31', 'A'),
(16, 33, 'If I were Ayanami Rei, what should I do?', 19, '2021-03-26 00:09:49', 'A'),
(17, 33, 'I think you should be laughing.', 25, '2021-03-26 01:31:57', 'A'),
(22, 33, 'Hello', 25, '2021-03-26 03:06:22', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `likes_skips`
--

CREATE TABLE `likes_skips` (
  `ls_id` int(11) NOT NULL,
  `ls_status` varchar(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ls_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `likes_skips`
--

INSERT INTO `likes_skips` (`ls_id`, `ls_status`, `user_id`, `ls_user_id`, `date`, `status`) VALUES
(82, 'skip', 16, 10, '2021-03-23', 'A'),
(83, 'skip', 16, 9, '2021-03-23', 'A'),
(84, 'like', 16, 17, '2021-03-23', 'A'),
(85, 'skip', 16, 1, '2021-03-23', 'A'),
(86, 'skip', 16, 12, '2021-03-23', 'A'),
(87, 'like', 16, 8, '2021-03-23', 'A'),
(88, 'skip', 13, 9, '2021-03-23', 'A'),
(89, 'skip', 13, 7, '2021-03-23', 'A'),
(90, 'skip', 13, 12, '2021-03-23', 'A'),
(91, 'skip', 13, 11, '2021-03-23', 'A'),
(92, 'skip', 13, 1, '2021-03-23', 'A'),
(93, 'skip', 13, 10, '2021-03-23', 'A'),
(94, 'like', 13, 8, '2021-03-23', 'A'),
(95, 'like', 13, 17, '2021-03-23', 'A'),
(108, 'like', 17, 16, '2021-03-23', 'A'),
(109, 'like', 17, 13, '2021-03-23', 'A'),
(113, 'like', 8, 13, '2021-03-24', 'A'),
(114, 'like', 8, 16, '2021-03-24', 'A'),
(115, 'like', 14, 7, '2021-03-25', 'A'),
(116, 'like', 14, 11, '2021-03-25', 'A'),
(117, 'like', 14, 9, '2021-03-25', 'A'),
(118, 'like', 14, 10, '2021-03-25', 'A'),
(119, 'like', 14, 17, '2021-03-25', 'A'),
(120, 'skip', 13, 21, '2021-03-25', 'A'),
(121, 'skip', 13, 19, '2021-03-25', 'A'),
(122, 'like', 20, 14, '2021-03-25', 'A'),
(123, 'like', 20, 23, '2021-03-25', 'A'),
(124, 'like', 20, 16, '2021-03-25', 'A'),
(125, 'like', 20, 15, '2021-03-25', 'A'),
(126, 'like', 20, 25, '2021-03-25', 'A'),
(127, 'like', 20, 6, '2021-03-25', 'A'),
(128, 'like', 20, 24, '2021-03-25', 'A'),
(129, 'like', 20, 13, '2021-03-25', 'A'),
(130, 'like', 20, 26, '2021-03-25', 'A'),
(131, 'skip', 27, 9, '2021-03-25', 'A'),
(132, 'like', 27, 21, '2021-03-25', 'A'),
(133, 'skip', 27, 22, '2021-03-25', 'A'),
(134, 'like', 27, 7, '2021-03-25', 'A'),
(135, 'like', 27, 10, '2021-03-25', 'A'),
(136, 'like', 7, 23, '2021-03-25', 'A'),
(137, 'skip', 7, 25, '2021-03-25', 'A'),
(138, 'skip', 7, 14, '2021-03-25', 'A'),
(139, 'like', 7, 27, '2021-03-25', 'A'),
(140, 'skip', 7, 26, '2021-03-25', 'A'),
(141, 'skip', 7, 13, '2021-03-25', 'A'),
(142, 'skip', 7, 24, '2021-03-25', 'A'),
(143, 'skip', 7, 16, '2021-03-25', 'A'),
(144, 'skip', 7, 6, '2021-03-25', 'A'),
(145, 'skip', 7, 15, '2021-03-25', 'A'),
(147, 'skip', 25, 9, '2021-03-25', 'A'),
(148, 'skip', 25, 7, '2021-03-25', 'A'),
(149, 'like', 25, 19, '2021-03-25', 'A'),
(153, 'like', 25, 20, '2021-03-25', 'A'),
(154, 'skip', 18, 15, '2021-03-26', 'A'),
(155, 'skip', 18, 6, '2021-03-26', 'A'),
(156, 'skip', 18, 24, '2021-03-26', 'A'),
(157, 'skip', 18, 23, '2021-03-26', 'A'),
(158, 'like', 18, 25, '2021-03-26', 'A'),
(159, 'skip', 18, 26, '2021-03-26', 'A'),
(160, 'skip', 19, 23, '2021-03-26', 'A'),
(161, 'skip', 19, 16, '2021-03-26', 'A'),
(162, 'skip', 19, 27, '2021-03-26', 'A'),
(163, 'skip', 19, 26, '2021-03-26', 'A'),
(164, 'skip', 19, 15, '2021-03-26', 'A'),
(165, 'skip', 19, 14, '2021-03-26', 'A'),
(166, 'skip', 19, 24, '2021-03-26', 'A'),
(167, 'skip', 19, 6, '2021-03-26', 'A'),
(168, 'like', 19, 25, '2021-03-26', 'A'),
(169, 'skip', 19, 13, '2021-03-26', 'A'),
(170, 'skip', 25, 12, '2021-03-26', 'A'),
(171, 'skip', 25, 29, '2021-03-26', 'A'),
(172, 'skip', 25, 10, '2021-03-26', 'A'),
(173, 'like', 25, 21, '2021-03-26', 'A'),
(174, 'like', 25, 18, '2021-03-26', 'A'),
(175, 'like', 25, 11, '2021-03-26', 'A'),
(176, 'like', 25, 17, '2021-03-26', 'A'),
(177, 'like', 25, 1, '2021-03-26', 'A'),
(178, 'like', 25, 8, '2021-03-26', 'A'),
(179, 'skip', 25, 22, '2021-03-26', 'A'),
(180, 'skip', 25, 28, '2021-03-26', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `match_id` int(11) NOT NULL,
  `male_user_id` int(11) NOT NULL,
  `female_user_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `matches`
--

INSERT INTO `matches` (`match_id`, `male_user_id`, `female_user_id`, `date`, `status`) VALUES
(27, 16, 17, '2021-03-23', 'A'),
(28, 13, 17, '2021-03-23', 'A'),
(29, 13, 8, '2021-03-24', 'A'),
(30, 16, 8, '2021-03-24', 'A'),
(31, 27, 7, '2021-03-25', 'A'),
(32, 25, 20, '2021-03-25', 'A'),
(33, 25, 19, '2021-03-26', 'A'),
(34, 25, 18, '2021-03-26', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `date_of_birth` date NOT NULL,
  `image` varchar(255) NOT NULL,
  `introduction` varchar(1000) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `gender`, `date_of_birth`, `image`, `introduction`, `password`, `status`) VALUES
(1, 'mikasa', '123mikasa@gmali.com', 'female', '1990-06-01', 'mikasa2.jpg', 'aaaa', '$2y$10$FksV9wxYqZohcq4n/o1wbuKsRlU5rZ7MbSisDdaGbI4oKIbr50y1i', 'A'),
(6, 'psy1', 'pshy@gmail.com', 'male', '2017-02-07', 'psy.jpg', 'oh ', '$2y$10$C1j93pLaOr1B3kfnlyx/BuvqaU4y.40RBIm9SaxWaDDiooEyM1h02', 'A'),
(7, 'annie', 'annie@gmail.com', 'female', '1997-07-24', 'annie2.jpg', 'Hello', '$2y$10$GVBJSLPnwrOvIPHX5jIs4uL9LrjmduoKn82sCLgWux.t5KvQBK3Ge', 'A'),
(8, 'sasha', 'sasha@gmail.com', 'female', '1987-06-16', 'sasha.jpg', 'I love potatoes!', '$2y$10$LU3BIU9nJkNkhJoT5tKLIOVlzDMfd6szYpq7F8BOxiXjnYo49GJYa', 'A'),
(9, 'krista', 'krista@gmail.com', 'female', '2001-10-06', 'crista.jpg', 'Hello', '$2y$10$zihJvHY3qn.22H4FhlRqWuNNcC5g40jIufMUDwbh1AHYy8aBV81qy', 'A'),
(10, 'peek', 'peek@gmail.com', 'female', '2005-01-03', 'peek.jpg', 'I am a car titan.', '$2y$10$/dWjDzID0yEeHLqnZ2wyleu10YGMJa42r5Dw.Ni/AZ1CAheSPey.G', 'A'),
(11, 'gabi', 'gabi@gmail.com', 'female', '2008-07-06', 'gabi.jpg', 'I wanna be Armored titan.', '$2y$10$cfB0OJJwZQIcYFXbdnsixO9mR0UznNIsapPaiSpH84qyEa8uMFVgW', 'A'),
(12, 'gorilla', 'gorilla@gmail.com', 'female', '1988-06-24', 'gorilla.jpg', 'PLEASE A BANANA', '$2y$10$ybY54.Gd5LGFUG7TXCxfn.SZH9iuzGMXHGC7ntdN0.vxEyTB/x4KW', 'A'),
(13, 'eren', 'eren@gmail.com', 'male', '1994-02-11', 'eren.jpg', 'I wanna destroy titans!', '$2y$10$e9s3wC.StaL62hADqZGFa.Lt8231eVd2Cw7mVGGfMr4Vb8zQdfBb6', 'A'),
(14, 'reiner', 'reiner@gmail.com', 'male', '1988-11-23', 'reiner1.jpg', 'not a soldier, but just a fighter.', '$2y$10$owOg3.B3WE7Unx0M23mgl.6TN7Ol46FTIdy.5kZTtKD0ZKxAy04yS', 'A'),
(15, 'armin123', 'armin@gmail.com', 'male', '1996-10-17', 'armin1.jpg', 'aaaaaaa', '$2y$10$/zUDsDoKThqf33e2hVppIuGp.uefmSugjiP9GR5UsHecRG8oT1Cmm', 'A'),
(16, 'testboy2', 'testboy@gmail.com', 'male', '2000-06-14', 'testboy.png', 'Hello! I am a student.', '$2y$10$b2cLHTxL2GcZc/tYZTA5z..DksCCZb7FHu6mfPBViDWnET.MHCl3y', 'A'),
(17, 'testgirl2', 'testgirl@gmail.com', 'female', '2000-04-21', 'testgirl2.png', '', 'Nice to meet you! I love JAPANESE CULTURE!2', 'A'),
(18, 'asuka', 'asuka@gmail.com', 'female', '1995-05-08', 'asuka.jpeg', 'You are an idiot?', '$2y$10$19cfySgzGyGP0ybF/6FOpe3kV.8Ae3vv9CosTnifIdMcckbjBbawe', 'A'),
(19, 'rei', 'rei@gmail.com', 'female', '1996-11-20', 'rei.jpeg', 'You won\'t die.\r\nBecause I\'ll save you.', '$2y$10$RrdNM83k0CGgjIbRYr1rb.62rJzFKban/qWXc1OLtf.KdaQRNG7Pa', 'A'),
(20, 'misato', 'misato@gmail.com', 'female', '1980-09-22', 'misato.jpeg', 'Go! Shinji!\r\nFor your future!', '$2y$10$o7X1JuPj5Fm1GfMlBHwzcuuiVqU2KV26U6P9xps.dHz0vH4gVpjJO', 'A'),
(21, 'mari', 'mari@gmail.com', 'female', '1980-04-04', 'mari.jpeg', 'This is Beast mode!', '$2y$10$J0bFgqHXB9YwZYyqGYz4x.qfRtkI2rFmRxwqaquKivar7t5NhmLb6', 'A'),
(22, 'ritsuko', 'ritsuko@gmail.com', 'female', '1980-05-29', 'rituko.png', 'You are Shinji Ikari ... right?', '$2y$10$3EjNjhfDpQIPz.IxIwmdI.2ZdRyZ9uBbBfRsU/.OX.nnOVwGr5yuO', 'A'),
(23, 'revi', 'revi@gmail.com', 'male', '1988-10-14', 'revi.jpeg', 'I have not understood yet, I should believe me or my teammates.', '$2y$10$CEhih.hiRNc3w2e2qltH4.kIU.IPi7zg0JzhbgNktFk3/NQbB0mpW', 'A'),
(24, 'elwin', 'elwin@gmail.com', 'male', '1983-02-03', 'elwin.jpeg', 'Dedicate your heart.', '$2y$10$npOSUqZUv.2OYh5WWXDQ2Oua64j6MmkLxYa5xPBk56vIM9L.Qc642', 'A'),
(25, 'shinji', 'shinji@gmail.com', 'male', '1995-07-14', 'shinji.png', 'Let me ride it!\r\nI\'m a pilot of Evangelion.', '$2y$10$3zxXH5muS9eN3spRmlZk9Oxqm/qRfXzVvLpTHebUQ8f9XZuRPDkPK', 'A'),
(26, 'kaworu', 'kaworu@gmail.com', 'male', '2000-10-18', 'kaworu.png', 'I\'ll make you happy this time!!!', '$2y$10$JnLRP9mWO/AA8mb3IV1RB.kBLNvTCzVIdCA962oQZ/jYBPMmdq9Iq', 'A'),
(27, 'kyle', 'kyle1@gmail.com', 'male', '1986-06-10', 'testboy3.png', 'salamat!', '$2y$10$6Ezrm6B/9IHDGooE8OYvQOah9LBooaKW2fS.R13TVhOeo3IkwqFbi', 'A'),
(28, 'pien', 'pien@gmail.com', 'female', '1998-10-22', 'testgirl4.png', 'I\'m pien.', '$2y$10$mIGa5NYjCWIc.twQtasIq..cCzhkNdWxGqpgbLoXHqQoN8V9zS4qi', 'A'),
(29, 'kyaryPamyu2', 'kyary@gmail.com', 'female', '1998-09-15', 'pamyu2.jpeg', 'I am a fashion monster.', '$2y$10$m3Ychto2GVVBamRnym80DenExHanADyBTsQqXk8XuU.zLarNmeVWK', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `likes_skips`
--
ALTER TABLE `likes_skips`
  ADD PRIMARY KEY (`ls_id`);

--
-- Indexes for table `matches`
--
ALTER TABLE `matches`
  ADD PRIMARY KEY (`match_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `likes_skips`
--
ALTER TABLE `likes_skips`
  MODIFY `ls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=181;

--
-- AUTO_INCREMENT for table `matches`
--
ALTER TABLE `matches`
  MODIFY `match_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
