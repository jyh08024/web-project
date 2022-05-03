-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-01-18 08:47
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
-- 데이터베이스: `20_gangwon`
--
CREATE DATABASE IF NOT EXISTS `20_gangwon` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `20_gangwon`;

-- --------------------------------------------------------

--
-- 테이블 구조 `request`
--

CREATE TABLE `request` (
  `idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `req_name` text COLLATE utf8mb4_bin NOT NULL,
  `max` int(11) NOT NULL,
  `priceRange` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `store`
--

CREATE TABLE `store` (
  `idx` int(11) NOT NULL,
  `buyTimestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `total` text COLLATE utf8mb4_bin NOT NULL,
  `buy_day` text COLLATE utf8mb4_bin NOT NULL,
  `buy_time` text COLLATE utf8mb4_bin NOT NULL,
  `user_idx` int(11) NOT NULL,
  `item` longtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `suggest`
--

CREATE TABLE `suggest` (
  `idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `request_idx` int(11) NOT NULL,
  `item` longtext COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `state` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `user_name` text COLLATE utf8mb4_bin NOT NULL,
  `user_call` text COLLATE utf8mb4_bin NOT NULL,
  `user_code` text COLLATE utf8mb4_bin NOT NULL,
  `user_ad` text COLLATE utf8mb4_bin NOT NULL,
  `user_detail_ad` text COLLATE utf8mb4_bin NOT NULL,
  `user_id` text COLLATE utf8mb4_bin NOT NULL,
  `user_pass` text COLLATE utf8mb4_bin NOT NULL,
  `user_type` text COLLATE utf8mb4_bin NOT NULL,
  `cart` longtext COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `suggest`
--
ALTER TABLE `suggest`
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
-- 테이블의 AUTO_INCREMENT `request`
--
ALTER TABLE `request`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `store`
--
ALTER TABLE `store`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `suggest`
--
ALTER TABLE `suggest`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
