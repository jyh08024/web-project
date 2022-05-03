-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 21-10-15 14:55
-- 서버 버전: 10.4.11-MariaDB
-- PHP 버전: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `18_chungnam`
--
CREATE DATABASE IF NOT EXISTS `18_chungnam` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `18_chungnam`;

-- --------------------------------------------------------

--
-- 테이블 구조 `pro`
--

CREATE TABLE `pro` (
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
-- 테이블의 덤프 데이터 `pro`
--

INSERT INTO `pro` (`idx`, `name`, `image`, `price`, `category`, `distance`, `speed`, `chargTime`, `passenger`, `weight`, `quantity`, `detail`) VALUES
(1, '24 팬텀 CITY', '24 팬텀 CITY.jpg', '10000', '전기자전거', '98', '25', '4', '1', '21.3', '10', '24 팬텀 CITY.jpg,24 팬텀 CITY_1.jpg,24 팬텀 CITY_2.jpg,24 팬텀 CITY_3.jpg,0.91604700 1634111996기간별 매출관리 현황.PNG,0.43393000 1634112114상세이미지.PNG'),
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
-- 테이블 구조 `reserve`
--

CREATE TABLE `reserve` (
  `idx` int(11) NOT NULL,
  `start` text COLLATE utf8_bin NOT NULL,
  `end` text COLLATE utf8_bin NOT NULL,
  `begin` text COLLATE utf8_bin NOT NULL,
  `arrive` text COLLATE utf8_bin NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `card` text COLLATE utf8_bin NOT NULL,
  `card_num` int(11) NOT NULL,
  `bank` text COLLATE utf8_bin NOT NULL,
  `send_user` text COLLATE utf8_bin NOT NULL,
  `phone` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `state` text COLLATE utf8_bin NOT NULL,
  `reason` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `res_pro`
--

CREATE TABLE `res_pro` (
  `idx` int(11) NOT NULL,
  `product_idx` int(11) NOT NULL,
  `res_idx` int(11) NOT NULL,
  `pay_price` text COLLATE utf8_bin NOT NULL,
  `rental_count` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8_bin NOT NULL,
  `id` text COLLATE utf8_bin NOT NULL,
  `pw` text COLLATE utf8_bin NOT NULL,
  `level` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`idx`, `name`, `id`, `pw`, `level`) VALUES
(1, 'admin', 'admin', '1234', 'admin'),
(2, '양지아', 'wldk123', 'didwl1234', '일반회원'),
(3, '이순영', 'tnsdud123', 'dltns1234', '일반회원'),
(4, '박민규', 'alsrb123', 'qkrals1234', '일반회원'),
(5, '정승철', 'tmdcjf123', 'wjdtmd1234', 'VIP회원'),
(6, '김원우', 'dnjsdn123', 'rladnjs1234', 'VIP회원'),
(7, '박정한', 'wjdgks123', 'qkrwjd1234', '일반회원'),
(8, '이우현', 'dngus123', 'dldn1234', '멤버십회원'),
(9, '김지훈', 'wlgns123', 'rlawl1234', '일반회원'),
(10, '박명호', 'audgh123', 'qkraud1234', 'VIP회원'),
(11, '김준휘', 'wnsgnl123', 'rlawns1234', '멤버십회원'),
(12, '곽현아', 'gusdk123', 'rhkrgus1234', '멤버십회원'),
(13, '최승관', 'tmdrhks123', 'chltmd1234', 'VIP회원'),
(14, '부솔찬', 'thfcks123', 'qnthf1234', '일반회원'),
(15, '부한솔', 'gksthf123', 'qngks1234', '멤버십회원'),
(16, '가정호', 'wjdgh123', 'rkwjd1234', '일반회원'),
(17, '모정수', 'wjdtn123', 'ahwjd1234', '일반회원'),
(18, '육지민', 'wlals123', 'dbrwl1234', '일반회원'),
(19, '임민지', 'alswl123', 'dlaals1234', '일반회원'),
(20, '김윤기', 'dbsrl123', 'rladbs1234', '멤버십회원'),
(21, '박인호', 'dlsgh123', 'qkrdls1234', 'VIP회원'),

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `res_pro`
--
ALTER TABLE `res_pro`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `pro`
--
ALTER TABLE `pro`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `reserve`
--
ALTER TABLE `reserve`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `res_pro`
--
ALTER TABLE `res_pro`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
