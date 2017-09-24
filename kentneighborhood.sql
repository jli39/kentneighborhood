-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 24, 2017 at 08:15 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kentneighborhood`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `news_id` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `publish_time` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`news_id`, `title`, `publish_time`, `content`) VALUES
(1, 'water shut off', '2017-04-20 02:11:15', 'water will shut off at east side next week'),
(2, 'I love the capstone class', '2017-04-24 06:51:15', 'we love the capstone class, this class give us the experience on real project works.'),
(3, 'Attention!!! Tornado tomorrow.', '2017-04-24 23:14:22', 'Dear residents, there have tornado tomorrow, pay attention to safety please!');

-- --------------------------------------------------------

--
-- Table structure for table `appartment`
--

CREATE TABLE `appartment` (
  `room_num` int(11) NOT NULL,
  `date` date NOT NULL,
  `lat` float(10,6) NOT NULL,
  `lng` float(10,6) NOT NULL,
  `bed_room` text NOT NULL,
  `category` text NOT NULL,
  `rent` int(11) NOT NULL,
  `available` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `appartment`
--

INSERT INTO `appartment` (`room_num`, `date`, `lat`, `lng`, `bed_room`, `category`, `rent`, `available`) VALUES
(99, '2017-08-17', 41.155567, -81.304138, 'one bed room', '1', 0, 0),
(100, '2017-05-28', 41.156269, -81.304367, 'one bed room', '2', 0, 0),
(102, '2017-05-28', 41.153828, -81.303864, 'one bed room', '3', 0, 0),
(103, '2017-05-25', 41.155304, -81.303825, 'two bed rooms', '4', 0, 0),
(104, '2017-05-02', 41.154640, -81.303558, 'two bed rooms', '5', 0, 0),
(105, '2017-05-02', 41.154320, -81.303284, 'two bed rooms', '6', 0, 0),
(106, '2017-05-25', 41.154842, -81.302528, 'two bed rooms', '7', 0, 0),
(107, '2017-05-25', 41.154842, -81.302528, 'three bed rooms', '7', 0, 0),
(108, '2017-05-25', 41.154640, -81.303558, 'three bed room', '5', 0, 0),
(109, '2017-05-25', 41.156269, -81.304367, 'two bed room', '2', 0, 0),
(110, '2017-05-25', 41.156269, -81.304367, 'two bed room', '2', 0, 0),
(111, '2017-05-25', 41.156269, -81.304367, 'two bed room', '2', 0, 0),
(112, '2017-05-25', 41.154640, -81.303558, 'two bed room', '5', 0, 0),
(113, '2017-09-25', 41.154640, -81.303558, 'one bed room', '5', 0, 0),
(114, '2017-08-25', 41.154320, -81.303284, 'one bed room', '6', 0, 0),
(115, '2017-01-25', 41.155567, -81.304138, 'one bed room', '1', 0, 0),
(116, '2017-02-25', 41.155567, -81.304138, 'one bed room', '1', 0, 0),
(117, '2017-03-25', 41.155567, -81.304138, 'one bed room', '1', 0, 0),
(118, '0000-00-00', 0.000000, 0.000000, '', '', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `card`
--

CREATE TABLE `card` (
  `card_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `card_type` varchar(35) NOT NULL,
  `card_num` int(50) NOT NULL,
  `exp_date` varchar(10) NOT NULL,
  `cvv` int(11) NOT NULL,
  `card_name` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `card`
--

INSERT INTO `card` (`card_id`, `username`, `card_type`, `card_num`, `exp_date`, `cvv`, `card_name`) VALUES
(1, 'jli39', 'debit', 1234459123, '2020-01-15', 343, 'Jiaqi Li'),
(2, 'fxing', 'credit', 1343242313, '2019-08-31', 110, 'Fengqi Xing'),
(3, 'tzhang17', 'debit', 1324234442, '2017-12-15', 991, 'Tianzhi Zhang'),
(4, 'xlin10', 'credit', 1355346436, '2099-09-09', 888, 'Xiangxu Lin'),
(5, 'ljames1', 'debit', 1342414242, '9999-99-99', 0, 'dfdfdsf');

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `chat_id` int(11) NOT NULL,
  `chat_user_id` int(11) NOT NULL,
  `chat_text` text NOT NULL,
  `chat_date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL,
  `title` varchar(35) NOT NULL,
  `publish_time` datetime NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `title`, `publish_time`, `content`) VALUES
(0, 'hard to find a parking area', '2017-04-19 00:00:00', 'This community need more parking lot'),
(1, 'My favourite community', '2017-04-22 08:01:05', 'This is my favourite community. Highly active, highly ambitious, highly important to members.');

-- --------------------------------------------------------

--
-- Table structure for table `connectus`
--

CREATE TABLE `connectus` (
  `name` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `connectus`
--

INSERT INTO `connectus` (`name`, `email`, `phone`, `message`) VALUES
('123', '123123', '1231231231', '123123123'),
('1212', '1212', '1212', '12121'),
('1111', '111', '111', '111'),
('1111', '111', '111', '111'),
('1111', '11', '11', '11'),
('11', '11', '11', '11'),
('.sdsd.', '.sdsd.', '.234324.', '.xcxc.');

-- --------------------------------------------------------

--
-- Table structure for table `maintainance`
--

CREATE TABLE `maintainance` (
  `case_id` int(11) NOT NULL,
  `username` varchar(11) NOT NULL,
  `room_num` int(11) NOT NULL,
  `location` text NOT NULL,
  `description` text NOT NULL,
  `request_time` datetime NOT NULL,
  `finish_time` datetime NOT NULL,
  `status` varchar(35) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `maintainance`
--

INSERT INTO `maintainance` (`case_id`, `username`, `room_num`, `location`, `description`, `request_time`, `finish_time`, `status`) VALUES
(1, 'jli39', 103, 'buildingdoor', 'AC need clean', '2017-04-20 06:29:10', '2017-04-24 23:18:39', 'finished'),
(2, 'fxing', 100, 'buildingdoor', 'Bathroom no water', '2017-04-22 07:58:01', '0000-00-00 00:00:00', 'processing'),
(3, 'tzhang17', 105, 'H_bathroom', 'The front door locker need replace', '2017-04-22 10:54:32', '0000-00-00 00:00:00', 'request'),
(4, 'xlin10', 107, 'secondbedroom', 'AC doesn\'t working', '2017-04-22 10:55:13', '0000-00-00 00:00:00', 'request'),
(5, 'Kevin', 104, 'frontdoor', 'dfdsfsdf', '2017-04-22 11:03:52', '0000-00-00 00:00:00', 'processing'),
(6, 'Jason', 102, 'H_bathroom', 'dfsfsf', '2017-04-22 11:04:31', '0000-00-00 00:00:00', 'request'),
(7, 'Mark', 106, 'frontdoor', 'dsffs', '2017-04-22 11:05:30', '0000-00-00 00:00:00', 'request');

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `manager_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `password` varchar(35) NOT NULL,
  `email` varchar(35) NOT NULL,
  `social` varchar(35) NOT NULL,
  `phone` int(11) NOT NULL,
  `firstname` varchar(35) NOT NULL,
  `lastname` varchar(35) NOT NULL,
  `login_time` datetime NOT NULL,
  `logout_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`manager_id`, `username`, `password`, `email`, `social`, `phone`, `firstname`, `lastname`, `login_time`, `logout_time`) VALUES
(1, 'admin', 'admin', 'xlin10@kent.edu', '00000000', 330835688, 'Xiangxu', 'Lin', '2017-04-02 00:00:00', '2017-04-06 00:00:00'),
(2, 'admin2', 'admin2', 'fxing@kent.edu', '111111111', 330835888, 'Fengqi', 'Xing', '2017-04-21 00:00:00', '0000-00-00 00:00:00'),
(3, 'admin3', 'admin3', 'jli39@kent.edu', '22222222', 330835666, 'Jiaqi', 'Li', '2017-04-19 00:00:00', '0000-00-00 00:00:00'),
(4, 'test', 'test', 'test@kent.edu', '33333333', 333333333, 'test', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `package_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `carrier` varchar(35) NOT NULL,
  `tracking_num` varchar(35) NOT NULL,
  `room` int(11) NOT NULL,
  `arrive_time` datetime NOT NULL,
  `pickup_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`package_id`, `username`, `carrier`, `tracking_num`, `room`, `arrive_time`, `pickup_time`) VALUES
(1, 'jli39', 'UPS', '454353454', 103, '2017-04-25 13:17:10', '0000-00-00 00:00:00'),
(2, 'fxing', 'Fedex', 'qweqweqwe', 100, '2017-04-24 15:20:52', '2017-04-25 13:20:31'),
(3, 'fxing', 'USPS', '1234567890', 100, '2017-04-20 11:30:10', '0000-00-00 00:00:00'),
(4, 'xlin10', 'UPS', '423325346346', 107, '2017-04-25 13:17:10', '2017-04-25 17:05:40');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `username` varchar(35) NOT NULL,
  `payment_time` datetime NOT NULL,
  `payment_month` varchar(7) NOT NULL,
  `room_num` int(11) NOT NULL,
  `card_num` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `username`, `payment_time`, `payment_month`, `room_num`, `card_num`) VALUES
(1, 'fxing', '2017-04-15 06:29:04', '2017-04', 100, 1343242313),
(2, 'jli39', '2017-04-20 06:30:49', '2017-04', 103, 1234459123),
(3, 'xlin10', '2017-04-23 06:32:20', '2017-04', 107, 1355346436),
(4, 'ljames1', '2017-04-22 08:20:05', '2017-04', 104, 1342414242);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `name` varchar(35) NOT NULL,
  `psd` varchar(35) NOT NULL,
  `tel` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`name`, `psd`, `tel`) VALUES
('cricel', 'cricel', 123456),
('test', 'test', 123654);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(16) NOT NULL,
  `password` varchar(16) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `phone_num` int(30) NOT NULL,
  `room_num` int(15) NOT NULL,
  `lease_start` date NOT NULL,
  `lease_end` date NOT NULL,
  `add_time` datetime NOT NULL,
  `update_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `firstname`, `lastname`, `email`, `phone_num`, `room_num`, `lease_start`, `lease_end`, `add_time`, `update_time`) VALUES
('fxing', 'fxing', 'Fengqi', 'Xing', 'fxing@kent.edu', 330835888, 100, '2014-05-01', '2017-05-01', '2014-05-01 00:00:00', '0000-00-00 00:00:00'),
('jli39', 'jli39', 'Jiaqi', 'Li', 'jli39@kent.edu', 99999999, 103, '2012-08-31', '2013-08-31', '2012-08-03 00:00:00', '0000-00-00 00:00:00'),
('test', 'test', 'test', 'test', 'test@kent.edu', 2147483647, 99, '2017-06-08', '2017-08-17', '2017-05-05 21:08:27', '2017-05-05 21:08:27'),
('tzhang17', 'tzhang17', 'Tianzhi', 'Zhang', 'tzhang17@kent.edu', 330835886, 105, '2015-02-11', '2016-02-11', '2015-02-11 00:00:00', '0000-00-00 00:00:00'),
('xlin10', 'xlin10', 'Xiangxu', 'Lin', 'xlin10@kent.edu', 330835688, 107, '2016-12-01', '2016-12-01', '2016-12-01 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `appartment`
--
ALTER TABLE `appartment`
  ADD PRIMARY KEY (`room_num`);

--
-- Indexes for table `card`
--
ALTER TABLE `card`
  ADD PRIMARY KEY (`card_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD UNIQUE KEY `comment_id` (`comment_id`);

--
-- Indexes for table `maintainance`
--
ALTER TABLE `maintainance`
  ADD PRIMARY KEY (`case_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`manager_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `appartment`
--
ALTER TABLE `appartment`
  MODIFY `room_num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `card`
--
ALTER TABLE `card`
  MODIFY `card_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintainance`
--
ALTER TABLE `maintainance`
  MODIFY `case_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `manager_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
