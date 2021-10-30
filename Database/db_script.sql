-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2021 at 06:25 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `coursework_01`
--

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `friend_id` int(11) NOT NULL,
  `follower_user_id` int(11) NOT NULL,
  `following_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `friend`
--

INSERT INTO `friend` (`friend_id`, `follower_user_id`, `following_user_id`) VALUES
(6, 2, 15),
(9, 1, 2),
(10, 2, 4),
(11, 3, 1),
(13, 2, 8),
(15, 1, 3),
(16, 2, 25),
(17, 2, 6),
(22, 2, 3),
(101, 68, 15),
(102, 68, 1),
(114, 68, 4),
(120, 68, 2),
(121, 100, 15),
(122, 100, 101);

-- --------------------------------------------------------

--
-- Table structure for table `genre`
--

CREATE TABLE `genre` (
  `genre_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `genre`
--

INSERT INTO `genre` (`genre_id`, `name`) VALUES
(1, 'classical'),
(2, 'jazz'),
(3, 'pop'),
(4, 'rock'),
(5, 'folk'),
(6, 'country\r\n'),
(7, 'hip hop'),
(8, 'blues\r\n'),
(9, 'disco'),
(10, 'instrumental\r\n'),
(11, 'R & B');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_date` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image` varchar(2083) NOT NULL,
  `slug` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `author_name`, `author_id`, `created_date`, `title`, `content`, `image`, `slug`) VALUES
(1, 'Ert Ert', 68, 1574181626, 'kl', '<p>lkl</p>\r\n', '', 'kl'),
(2, 'Ert Ert', 68, 1574182330, 'e', '<p>ddf</p>\r\n', '', 'e'),
(3, 'Iop', 60, 1574182554, 'lk', '<p>kml</p>\r\n', '', 'lk'),
(4, 'Iop', 60, 1574182685, 'op', '<p>op</p>\r\n', 'paws.png', 'op'),
(5, 'Ert Ert', 68, 1574233318, 's', '<p>ssssssssss</p>\r\n', '', 's'),
(6, 'Ert Ert', 68, 1574270081, 'er', '<p>err</p>\r\n', '', 'er'),
(7, 'Ert Ert', 68, 1574270101, 'r', '<p>er</p>\r\n', '', 'r'),
(8, 'Ert Ert', 68, 1574270828, 'sa', '<p>sa</p>\r\n', '', 'sa'),
(9, 'Ert Ert', 68, 1574271228, 'sd', '<p>ds</p>\r\n', '', 'sd'),
(10, 'Ert Ert', 68, 1574271253, '', '<p>s</p>\r\n', '', ''),
(11, 'Ert Ert', 68, 1574271275, '', '<p>sd</p>\r\n', '', ''),
(12, 'Ert Ert', 68, 1574271353, '', '<p>s</p>\r\n', '', ''),
(13, 'Ert Ert', 68, 1574271384, '', '<p>sddasads</p>\r\n', '', ''),
(14, 'Ert Ert', 68, 1574271395, 'as', '<p>asd asd</p>\r\n', '', 'as'),
(15, 'Ert Ert', 68, 1574271477, '', '<p>dsa</p>\r\n', '', ''),
(16, 'Ert Ert', 68, 1574271488, '', '<p>z</p>\r\n', '', ''),
(17, 'Ert Ert', 68, 1574271544, 's', '<p>s</p>\r\n', '', 's'),
(18, 'Ert Ert', 68, 1574271554, '', '<p>,l;</p>\r\n', '', ''),
(19, 'Ert Ert', 68, 1574271563, '', '<p>;</p>\r\n', '', ''),
(20, 'Ert Ert', 68, 1574271780, 'l', '<p>k</p>\r\n', '', 'l'),
(21, 'Ert Ert', 68, 1574273304, '', '<p>f</p>\r\n', '', ''),
(22, 'Ert Ert', 68, 1574273344, '', '<p>d</p>\r\n', '', ''),
(23, 'Ert Ert', 68, 1574326739, 'hg', '<p>dsf</p>\r\n', '', 'hg'),
(24, 'Ert Ert', 68, 1574402913, 'new post', '<p>morning ceratel;m [o</p>\r\n', '', 'new-post'),
(25, 'Qazwsx', 99, 1574412165, 'sa', '<p>sa</p>\r\n', '', 'sa'),
(26, 'Ertert Er', 100, 1574416219, 'Hey ', '<p>My first post&nbsp;&nbsp;<a href=\'https://stackoverflow.com/questions/43263094/adding-a-table-in-phpmyadmin?rq=1\'>https://stackoverflow.com/questions/43263094/adding-a-table-in-phpmyadmin?rq=1</a> and this picture</p>\r\n\r\n<p><img src=\'https://i.imgur.com/yp3VtGgb.jpg\'></p>\r\n', '', 'Hey'),
(27, 'Qwe Qwe', 101, 1574416429, 'hey', '<p>Frist post creted by me</p>\r\n', 'pet-show.jpg', 'hey');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(2083) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `name`, `username`, `password`, `profile_picture`) VALUES
(1, 'mac', 'abc', 'abc', 'user.png'),
(2, 'Spot', 'qwe', 'qwe', 'duck.jpg\r\n'),
(3, 'Romelz', 'rom', 'abcd', 'user.png'),
(4, 'spotsi', 'MMM', 'PLM', 'user.png'),
(8, 'Romelda', 'hjk', 'lmk', 'rabbit.png'),
(9, 'asdlkj', 'oop', 'oop', 'pet-treat.jpg'),
(15, 'okp', 'u', 'u', 'https://i.imgur.com/8pTwPlXb.jpg'),
(25, 'lkmlkmlaisojp pskp', 'mkl', 'mkl', 'duck.jpg'),
(28, 'newme asoijdp opks', 'newme', 'newme', 'fb-icon.jpg'),
(59, 'Kok Kok', 'kok', '$2y$10$2AZWXiCkJ5yaHXZlOD517OwkCBvjnk/0Amu3Y4KECqMrYc58Lfd5y', 'bone.png'),
(60, 'Iop', 'iop', '$2y$10$2ly2L6Pkn1XByP/J4RkhVeFNZjVjiAddFlKRr/FQ.mQHxYbgouuUK', 'bone.png'),
(68, 'Ert Ert', 'ert', '$2y$10$uF/oZ3uiaX7IcM6xbrr9reKftQEmyTCF/fw1.TTykiYt9Wtm4pFEK', 'https://i.imgur.com/qw09M6Yb.jpg'),
(80, '', 'sdasdad', '$2y$10$U7gdk41ZeEYYREd6Wj7/m.fSExfulbvd1y7rzc2AqAq93r5mSVE.e', ''),
(81, '', 'asdfghy', '$2y$10$d.UfrdSg5MBvwGPO2MdtIOXusj59etgyAuR1Tu0AhS8yFNUMsi4Ka', ''),
(82, 'D', 'asasass', '$2y$10$wUfcVxDulpSz653DiZItruMznGRyfmdvP8Rm8ifFkqsNoHqHiYehu', 'https://i.imgur.com/A8eQsllb.jpg'),
(83, '', 'ertertrtert', '$2y$10$y7EIL9aP9J3QvevzIBgfhetfHBL3.d2AL3UzYg0nBC8mtGWq0ZXwS', ''),
(84, '', 'abcdef', '$2y$10$GSg.l5wXQ/e0kb/lne90N.HmEaJdCeUhV16SrivV8KhgXJec8s0ui', ''),
(85, '', 'abcdefg', '$2y$10$ELHkA6VtafeP6O28X4sxRuqlpZYtWpG4QizDtK2duPoTggCRvNiny', ''),
(86, '', 'plmoknijb', '$2y$10$XRc5dvkE..snb02bvjrGvua.KDxOv5aW2IxHHk5z.76Pce6CrEFHG', ''),
(87, '', 'lkmlasd', '$2y$10$1E9.iDb0PBKnElnXmgnI1OH0nQ4Zu.vNpgGoT8CmfEWHuxUtsTp0a', ''),
(88, '', 'axssxasd', '$2y$10$ZEQ4K9mtezrOXXryGPQ7jewZTNIVN3Gr.g57U4ySrKDAsjF3B4PQ.', ''),
(89, '', 'weweee', '$2y$10$CvREnRUhMrmwlss945pm4OQkzGi40hxvSupbHddekWfvQV.ZNwo.y', ''),
(90, '', 'asdawadwdw', '$2y$10$QUUT4DLTZ.8ZZ4olLoHOaemjg8IdU4REhuKPOBcvkXSYqEFC4Wx7u', ''),
(91, '', 'sdsdsd', '$2y$10$Z5yasKyti5QKmuyyUx9sremgP8.FJcpNcBHsws7cirZfrhAUc4Ns6', ''),
(92, '', 'wewewe', '$2y$10$EwfjAF1UNcJoiVidrTgOCuAFSCs7tYaGAVvji/kaIhloUgoMEJFAu', ''),
(93, '', 'assdsdsd', '$2y$10$Xjr86AX2mVAQd5LcmSiZj.fX4oA.dAXlIEppejdaV6mBhJk3w4cwi', ''),
(94, '', 'plmokn', '$2y$10$8au5.zJy.jrrfNRK5/giIuCemaM1Z6iAWdotFLgGRme4QyCQy3fU2', ''),
(95, '', 'asasas', '$2y$10$4kChHEkfqUC0keSI7yxa.eOj1Dl5W2iSFV1nSiFWL84doyl452MSm', ''),
(96, 'Sd', 'sdddfdfs', '$2y$10$Qf9RKlBG/Zw.dZ7Wz/vfbelppiJUNMbZWaOKWnCFu.FJ4j0KKmNfe', ''),
(97, 'Wedf', 'qwsxewfdwe', '$2y$10$t5EmVaw0MkSniJQAEhDcreeRDdP5mWzKCgn9/2gcLymTlJeyj/Rne', ''),
(98, 'Wer', 'poiuyt', '$2y$10$XhqpkzNxPMqy3mtBo1V27.yxbBnxBgcmGn6AybET.s5aZSnSAnrbe', ''),
(99, 'Qazwsx', 'qazwsx', '$2y$10$SM/xC8KFhYGQQSYFurVJjeXk4aOFrIBxro.5GbsL5OmPHeGglHGbm', 'duck.jpg'),
(100, 'Ertert Er', 'ertert', '$2y$10$iCv2moTOItyDEM9XSG7iTuhZGg2ifPZYLPdKp7WSFLtkv4ZI5xTEu', 'https://i.imgur.com/e14ZDTyb.jpg'),
(101, 'Qwe Qwe', 'qweqwe', '$2y$10$xp3FOB7OcaCDNWUoeNdJpuK81yn/CMsSQI7DfGmhVAfV4nhq77ubq', 'paws.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_genre`
--

CREATE TABLE `user_genre` (
  `user_genre_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_genre`
--

INSERT INTO `user_genre` (`user_genre_id`, `user_id`, `genre_id`) VALUES
(18, 15, 1),
(19, 2, 1),
(20, 2, 3),
(21, 15, 3),
(22, 4, 7),
(23, 1, 5),
(32, 61, 11),
(35, 62, 11),
(76, 67, 3),
(77, 68, 3),
(78, 96, 1),
(79, 96, 3),
(80, 97, 9),
(81, 97, 11),
(82, 98, 2),
(83, 98, 3),
(84, 98, 5),
(85, 99, 3),
(86, 99, 11),
(87, 100, 1),
(88, 100, 2),
(89, 100, 3),
(90, 100, 4),
(91, 101, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`friend_id`);

--
-- Indexes for table `genre`
--
ALTER TABLE `genre`
  ADD PRIMARY KEY (`genre_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_genre`
--
ALTER TABLE `user_genre`
  ADD PRIMARY KEY (`user_genre_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `friend_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;
--
-- AUTO_INCREMENT for table `genre`
--
ALTER TABLE `genre`
  MODIFY `genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT for table `user_genre`
--
ALTER TABLE `user_genre`
  MODIFY `user_genre_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
