-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2019-09-18 14:20:16
-- 伺服器版本： 10.3.16-MariaDB
-- PHP 版本： 7.1.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `guitartist`
--

-- --------------------------------------------------------

--
-- 資料表結構 `member_list`
--

CREATE TABLE `member_list` (
  `sid` int(11) NOT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `is_company` int(11) NOT NULL,
  `is_teacher` int(11) NOT NULL,
  `is_hall_owner` int(11) NOT NULL,
  `is_hire` int(11) NOT NULL,
  `is_suspended` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tel` varchar(255) NOT NULL,
  `teacher_tel` varchar(255) NOT NULL,
  `alt_tel` varchar(255) DEFAULT NULL,
  `alt_email` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `teacher_name` varchar(255) NOT NULL,
  `capital` varchar(255) DEFAULT NULL COMMENT '資本額',
  `ppl_num` varchar(225) DEFAULT NULL COMMENT '員工/樂團人數',
  `brand_1` varchar(255) DEFAULT NULL COMMENT '代理品牌_1',
  `brand_2` varchar(255) DEFAULT NULL COMMENT '代理品牌_2',
  `brand_3` varchar(255) DEFAULT NULL COMMENT '代理品牌_3',
  `bank_acc` varchar(255) DEFAULT NULL,
  `bank_num` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL COMMENT '統編',
  `fax` varchar(255) DEFAULT NULL,
  `addr_district` varchar(255) DEFAULT NULL COMMENT '地址',
  `addr` varchar(255) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `teacher_pic` varchar(255) DEFAULT NULL,
  `hall_owner_num` int(11) DEFAULT NULL COMMENT '廠商編號',
  `hall_introduce` text DEFAULT NULL COMMENT '場地介紹',
  `hall_web` text DEFAULT NULL COMMENT '官方網站',
  `teacher_birthday` varchar(225) DEFAULT NULL COMMENT '生日',
  `teacher_gender` varchar(255) NOT NULL,
  `teacher_line` varchar(255) DEFAULT NULL,
  `teacher_FB` varchar(255) DEFAULT NULL COMMENT 'FB粉專',
  `teacher_experience` text DEFAULT NULL COMMENT '教學經歷',
  `teacher_perform` text DEFAULT NULL COMMENT '表演經歷',
  `teacher_introduction` varchar(255) DEFAULT NULL COMMENT '自我介紹',
  `teacher_message` text DEFAULT NULL COMMENT '學生留言板(感謝信)',
  `teacher_specialty` text DEFAULT NULL COMMENT '專長',
  `teacher_music` varchar(255) DEFAULT NULL COMMENT '作品影音',
  `teacher_award` text DEFAULT NULL COMMENT '得獎紀錄/認證'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 傾印資料表的資料 `member_list`
--

INSERT INTO `member_list` (`sid`, `is_admin`, `is_company`, `is_teacher`, `is_hall_owner`, `is_hire`, `is_suspended`, `email`, `password`, `tel`, `teacher_tel`, `alt_tel`, `alt_email`, `name`, `teacher_name`, `capital`, `ppl_num`, `brand_1`, `brand_2`, `brand_3`, `bank_acc`, `bank_num`, `tax_id`, `fax`, `addr_district`, `addr`, `pic`, `teacher_pic`, `hall_owner_num`, `hall_introduce`, `hall_web`, `teacher_birthday`, `teacher_gender`, `teacher_line`, `teacher_FB`, `teacher_experience`, `teacher_perform`, `teacher_introduction`, `teacher_message`, `teacher_specialty`, `teacher_music`, `teacher_award`) VALUES
(108, 0, 1, 0, 0, 1, NULL, '@gmail', '13123', '14', '', NULL, NULL, '1', '', '13', '123', '14', '123123', '123', '123', '1243', '124', '124', '123', '123112', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(110, 0, 0, 1, 0, 0, NULL, '@kimo', '123', '', '123', '', '', '31', '123123', '', '', '', '', '', '', '', '', '', '', '', NULL, '81b919bd45961a5590437af73300c358e3ef45f7.jpg', NULL, NULL, NULL, '1312', 'none', NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL),
(111, 0, 0, 0, 1, 0, NULL, '@yahoo', '312-93i-2103', '', '', '', '', '312', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, '', '', '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(112, 0, 1, 0, 0, 0, NULL, '3123131', '123', '123', '', NULL, NULL, '123123', '', '123', '123', '', '', '', '123', '', '123', '1231', '123', '123123', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(113, 0, 0, 1, 1, 0, 0, '@@@@\r\n', '3123', '123', '', '', '', '123', '3', '123', '123', '', '', '', '123', '31231', '1231', '3', '123', '213', NULL, NULL, NULL, '', '', '', 'none', NULL, NULL, NULL, NULL, '', NULL, '', NULL, NULL),
(114, 0, 1, 0, 0, 0, NULL, '', '', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(115, 0, 1, 0, 0, 0, NULL, '123123', '0000', '213', '', NULL, NULL, '123', '', '123', '123', '123', '321', '', '23', '2133', '123', '123', '232', '12323', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(116, 0, 0, 1, 1, 0, NULL, '123412', '4124', '321', '', '323321', '', '412351', '', '3213123', '123', '', '', '', '', '', '', '3213', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(119, 0, 1, 1, 1, 0, NULL, 'test1@gmail.com', '1234', '321', '', '323321', '', '412351', '', '3213123', '123', '', '', '', '', '', '', '3213', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(120, 0, 1, 0, 0, 0, NULL, '1231', '1231', '', '', NULL, NULL, '1231', '', '1231', '', '1231', '', '', '', '', '1231', '', '', '1231', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(127, 0, 1, 0, 0, 0, NULL, '123112321321', '1231213214213', '1231', '', NULL, NULL, '1231123213', '', '1231', '1231', '1231', '', '123', '', '', '1231', '', '1231', '1231', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(128, 1, 1, 0, 0, 0, NULL, '123@gmail.com', '1234', '', '', NULL, NULL, '', '', '', '', '', '', '', 'AAAAAAA', '1234', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(133, 1, 0, 0, 0, 0, NULL, '456@gmail.com', '456', '', '', NULL, NULL, '', '', '', '', '', '', '', 'AAAAAAA', '1234', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(134, NULL, 1, 0, 0, 0, NULL, 'tiny@gmail.com', '1234', '', '', NULL, NULL, '', '', '', '', '', '', '', '', '', '', '', '', '', NULL, NULL, NULL, NULL, NULL, '', 'none', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `member_list`
--
ALTER TABLE `member_list`
  ADD PRIMARY KEY (`sid`),
  ADD UNIQUE KEY `email_` (`email`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `member_list`
--
ALTER TABLE `member_list`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
