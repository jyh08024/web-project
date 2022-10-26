-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-08-24 21:00
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
-- 데이터베이스: `22_seoul_3`
--
CREATE DATABASE IF NOT EXISTS `22_seoul_3` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `22_seoul_3`;

-- --------------------------------------------------------

--
-- 테이블 구조 `a`
--

CREATE TABLE `a` (
  `idx` int(11) NOT NULL,
  `issel` text COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `q_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `a`
--

INSERT INTO `a` (`idx`, `issel`, `content`, `q_idx`) VALUES
(1, '', 'asddsadsad', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `q`
--

CREATE TABLE `q` (
  `idx` int(11) NOT NULL,
  `title` text COLLATE utf8mb4_bin NOT NULL,
  `file` text COLLATE utf8mb4_bin NOT NULL,
  `type` text COLLATE utf8mb4_bin NOT NULL,
  `email` text COLLATE utf8mb4_bin NOT NULL,
  `pw` text COLLATE utf8mb4_bin NOT NULL,
  `store` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `q`
--

INSERT INTO `q` (`idx`, `title`, `file`, `type`, `email`, `pw`, `store`) VALUES
(1, 'asdads', '/resources/upload/fd9343feb3cd094162d24ae5d728c157logo.png', 'image', 'asd@asd.asd', '12345', '서동한식당');

-- --------------------------------------------------------

--
-- 테이블 구조 `res`
--

CREATE TABLE `res` (
  `idx` int(11) NOT NULL,
  `store` text COLLATE utf8mb4_bin NOT NULL,
  `date` text COLLATE utf8mb4_bin NOT NULL,
  `time` text COLLATE utf8mb4_bin NOT NULL,
  `menu` text COLLATE utf8mb4_bin NOT NULL,
  `count` text COLLATE utf8mb4_bin NOT NULL,
  `price` text COLLATE utf8mb4_bin NOT NULL,
  `person` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `p_1` text COLLATE utf8mb4_bin NOT NULL,
  `p_2` text COLLATE utf8mb4_bin NOT NULL,
  `p_3` text COLLATE utf8mb4_bin NOT NULL,
  `email` text COLLATE utf8mb4_bin NOT NULL,
  `pw` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `res`
--

INSERT INTO `res` (`idx`, `store`, `date`, `time`, `menu`, `count`, `price`, `person`, `name`, `p_1`, `p_2`, `p_3`, `email`, `pw`) VALUES
(1, '서동한식당', '2022-08-25', '11:00', '서동한정식', '1', '40000', '1', 'asd', '123', '123', '123', 'asd@asd.asd', '12345');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `a`
--
ALTER TABLE `a`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `q`
--
ALTER TABLE `q`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `res`
--
ALTER TABLE `res`
  ADD PRIMARY KEY (`idx`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `a`
--
ALTER TABLE `a`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `q`
--
ALTER TABLE `q`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `res`
--
ALTER TABLE `res`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
