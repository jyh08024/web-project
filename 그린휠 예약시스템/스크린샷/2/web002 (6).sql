-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 18-10-01 04:44
-- 서버 버전: 10.1.34-MariaDB
-- PHP 버전: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `web002`
--
CREATE DATABASE IF NOT EXISTS `web002` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `web002`;

-- --------------------------------------------------------

--
-- 테이블 구조 `info`
--

CREATE TABLE `info` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `image` text COLLATE utf8_bin NOT NULL,
  `price` text COLLATE utf8_bin NOT NULL,
  `category` text COLLATE utf8_bin NOT NULL,
  `distance` text COLLATE utf8_bin NOT NULL,
  `speed` text COLLATE utf8_bin NOT NULL,
  `chargTime` text COLLATE utf8_bin NOT NULL,
  `passenger` text COLLATE utf8_bin NOT NULL,
  `weight` text COLLATE utf8_bin NOT NULL,
  `quantity` text COLLATE utf8_bin NOT NULL,
  `detail` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `info`
--

INSERT INTO `info` (`idx`, `name`, `image`, `price`, `category`, `distance`, `speed`, `chargTime`, `passenger`, `weight`, `quantity`, `detail`) VALUES
(1, '24 팬텀 CITY', '24 팬텀 CITY.jpg', '10000', '전기자전거', '98', '25', '4', '1', '21.3', '10', '24 팬텀 CITY.jpg,24 팬텀 CITY_1.jpg,24 팬텀 CITY_2.jpg,24 팬텀 CITY_3.jpg'),
(2, 'YUNBIKE C1', 'YUNBIKE C1.jpg', '8000', '전기자전거', '60', '25', '3', '1', '16', '8', 'YUNBIKE C1.jpg,YUNBIKE C1_1.jpg,YUNBIKE C1_2.jpg,YUNBIKE C1_3.jpg'),
(3, '알톤 니모 에프디', '알톤 니모 에프디.jpg', '6000', '전기자전거', '30', '25', '3', '1', '17', '25', '알톤 니모 에프디.jpg,알톤 니모 에프디_1.jpg,알톤 니모 에프디_2.jpg'),
(4, '삼천리 팬텀 제로', '삼천리 팬텀 제로.jpg', '8000', '전기자전거', '70', '25', '3', '1', '17.2', '17', '삼천리 팬텀 제로.jpg,삼천리 팬텀 제로_1.jpg,삼천리 팬텀 제로_2.jpg'),
(5, '샤오미 치사이클', '샤오미 치사이클.jpg', '6000', '전기자전거', '45', '20', '3', '1', '14.5', '3', '샤오미 치사이클.jpg,샤오미 치사이클_1.jpg,샤오미 치사이클_2.jpg,샤오미 치사이클_3.jpg'),
(6, '알톤 이노젠M', '알톤 이노젠M.jpg', '8000', '전기자전거', '60', '25', '4', '1', '17.6', '5', '알톤 이노젠M.jpg,알톤 이노젠M_1.jpg,알톤 이노젠M_2.jpg'),
(7, '테일지 M7 엑스퍼트', '테일지 M7 엑스퍼트.PNG', '8000', '전기자전거', '80', '32', '3', '1', '22', '16', '테일지 M7 엑스퍼트.PNG,테일지 M7 엑스퍼트_1.jpg,테일지 M7 엑스퍼트_2.jpg'),
(8, '폴딩스타S', '폴딩스타S.jpg', '10000', '전기자전거', '90', '25', '3', '1', '18', '28', '폴딩스타S.jpg,폴딩스타S_1.jpg,폴딩스타S_2.jpg'),
(9, 'PM100', 'PM100.jpg', '35000', '미니전기자동차', '100', '80', '3', '2', '600', '3', 'PM100.jpg,PM100_1.jpg,PM100_2.jpg'),
(10, '다니고', '다니고.jpg', '35000', '미니전기자동차', '110', '77', '3', '2', '430', '5', '다니고.jpg,다니고_1.png,다니고_2.jpg,다니고_3.png,다니고_4.jpg,다니고_5.png'),
(11, '쯔더우 D2', '쯔더우 D2.jpeg', '37000', '미니전기자동차', '150', '80', '5', '2', '474', '4', '쯔더우 D2.jpeg,쯔더우 D2_1.jpg,쯔더우 D2_2.jpg,쯔더우 D2_3.jpg,쯔더우 D2_4.jpg'),
(12, '트위지', '트위지.jpg', '30000', '미니전기자동차', '60', '80', '3', '1', '474', '8', '트위지.jpg트위지_1.jpg,트위지_2.jpg,트위지_3.jpg,트위지_4.jpg,트위지_5.jpg'),
(13, 'BMW C 에볼루션', 'BMW C 에볼루션.png', '22000', '전기스쿠터', '160', '120', '4', '1', '275', '3', 'BMW C 에볼루션.png,BMW C 에볼루션_1.png,BMW C 에볼루션_2.jpg'),
(14, '고고로2', '고고로2.jpg', '20000', '전기스쿠터', '110', '90', '6', '1', '100', '6', '고고로2.jpg,고고로2_1.jpg, 고고로2_2.jpg, 고고로2_3.jpg, 고고로2_4.jpg'),
(15, '테일지 C1', '테일지 C1.jpg', '18000', '전기스쿠터', '80', '43', '7', '1', '68', '8', '테일지 C1.jpg,테일지 C1_1.jpg,테일지 C1_2.jpg'),
(16, '쉐보레 볼트 EV', '쉐보레 볼트 EV.jpg', '55000', '전기자동차', '383', '154', '10', '5', '1620', '7', '쉐보레 볼트 EV.jpg,쉐보레 볼트 EV_1.jpeg,쉐보레 볼트 EV_2.jpg,쉐보레 볼트 EV_3.jpg,쉐보레 볼트 EV_4.jpg,쉐보레 볼트 EV_5.jpg '),
(17, '아이오닉 일렉트릭', '아이오닉 일렉트릭.jpg', '45000', '전기자동차', '200', '165', '4', '5', '1445', '2', '아이오닉 일렉트릭.jpg,아이오닉 일렉트릭_1.jpg,아이오닉 일렉트릭_2.jpg,아이오닉 일렉트릭_3.jpg,아이오닉 일렉트릭_4.jpg'),
(18, '포드 포커스 일렉트릭', '포드 포커스 일렉트릭.jpg', '40000', '전기자동차', '185', '136', '4', '5', '1445', '5', '포드 포커스 일렉트릭.jpg,포드 포커스 일렉트릭_1.jpg,포드 포커스 일렉트릭_2.jpg,포드 포커스 일렉트릭_3.jpg,포드 포커스 일렉트릭_4.jpg'),
(19, '코나 일렉트릭', '코나 일렉트릭.jpg', '65000', '장거리전기자동차', '406', '167', '10', '5', '1685', '4', '코나 일렉트릭.jpg,코나 일렉트릭_1.jpg,코나 일렉트릭_2.jpg,코나 일렉트릭_3.jpg'),
(20, '테슬라 모델3', '테슬라 모델3.jpg', '70000', '장거리전기자동차', '354', '215', '9', '5', '1610', '3', '테슬라 모델3.jpg,테슬라 모델3_1.jpg,테슬라 모델3_2.jpg,테슬라 모델3_3.jpg'),
(21, '테슬라 모델S', '테슬라 모델S.jpg', '70000', '장거리전기자동차', '470', '250', '9', '5', '2240', '5', '테슬라 모델S.jpg,테슬라 모델S_1.jpg,테슬라 모델S_2.jpg,테슬라 모델S_3.jpg'),
(22, '테슬라 모델X', '테슬라 모델X.png', '65000', '장거리전기자동차', '403', '250', '9', '7', '2468', '2', '테슬라 모델X.png,테슬라 모델X_1.jpg,테슬라 모델X_2.jpg');

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE `member` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `level` text COLLATE utf8_bin NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`idx`, `name`, `pw`, `level`, `id`) VALUES
(1, '양지아', 'didwl1234', '일반회원', 'wldk123'),
(2, '이순영', 'dltns1234', '일반회원', 'tnsdud123'),
(3, '박민규', 'qkrals1234', '일반회원', 'alsrb123'),
(4, '정승철', 'wjdtmd1234', 'VIP회원', 'tmdcjf123'),
(5, '김원우', 'rladnjs1234', 'VIP회원', 'dnjsdn123'),
(6, '박정한', 'qkrwjd1234', '일반회원', 'wjdgks123'),
(7, '이우현', 'dldn1234', '멤버십회원', 'dngus123'),
(8, '김지훈', 'rlawl1234', '일반회원', 'wlgns123'),
(9, '박명호', 'qkraud1234', 'VIP회원', 'audgh123'),
(10, '김준휘', 'rlawns1234', '멤버십회원', 'wnsgnl123'),
(11, '곽현아', 'rhkrgus1234', '멤버십회원', 'gusdk123'),
(12, '최승관', 'chltmd1234', 'VIP회원', 'tmdrhks123'),
(13, '부솔찬', 'qnthf1234', '일반회원', 'thfcks123'),
(14, '부한솔', 'qngks1234', '멤버십회원', 'gksthf123'),
(15, '가정호', 'rkwjd1234', '일반회원', 'wjdgh123'),
(16, '모정수', 'ahwjd1234', '일반회원', 'wjdtn123'),
(17, '육지민', 'dbrwl1234', '일반회원', 'wlals123'),
(18, '임민지', 'dlaals1234', '일반회원', 'alswl123'),
(19, '김윤기', 'rladbs1234', '멤버십회원', 'dbsrl123'),
(20, '박인호', 'qkrdls1234', 'VIP회원', 'dlsgh123'),
(21, '관리자', '1234', 'VIP회원', 'admin');

-- --------------------------------------------------------

--
-- 테이블 구조 `memo`
--

CREATE TABLE `memo` (
  `idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `info_idx` int(11) NOT NULL,
  `start` text COLLATE utf8_bin NOT NULL,
  `end` text COLLATE utf8_bin NOT NULL,
  `start_place` text COLLATE utf8_bin NOT NULL,
  `end_place` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `reserve`
--

CREATE TABLE `reserve` (
  `idx` int(11) NOT NULL,
  `info_idx` text COLLATE utf8_bin NOT NULL,
  `user_idx` text COLLATE utf8_bin NOT NULL,
  `start` text COLLATE utf8_bin NOT NULL,
  `end` text COLLATE utf8_bin NOT NULL,
  `start_place` text COLLATE utf8_bin NOT NULL,
  `end_place` text COLLATE utf8_bin NOT NULL,
  `cur` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stat` text COLLATE utf8_bin NOT NULL,
  `card` text COLLATE utf8_bin NOT NULL,
  `cardNum` text COLLATE utf8_bin NOT NULL,
  `bank` text COLLATE utf8_bin NOT NULL,
  `sender` text COLLATE utf8_bin NOT NULL,
  `phone` text COLLATE utf8_bin NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL,
  `cancle` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `memo`
--
ALTER TABLE `memo`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `info`
--
ALTER TABLE `info`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `member`
--
ALTER TABLE `member`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 테이블의 AUTO_INCREMENT `memo`
--
ALTER TABLE `memo`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `reserve`
--
ALTER TABLE `reserve`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
