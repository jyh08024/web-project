-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-08-16 13:35
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
-- 데이터베이스: `22_gyenggi`
--
CREATE DATABASE IF NOT EXISTS `22_gyenggi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `22_gyenggi`;

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `cate` text COLLATE utf8mb4_bin NOT NULL,
  `title` text COLLATE utf8mb4_bin NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `view` int(11) NOT NULL,
  `share_ban` text COLLATE utf8mb4_bin NOT NULL,
  `download_ban` text COLLATE utf8mb4_bin NOT NULL,
  `is_notice` text COLLATE utf8mb4_bin NOT NULL,
  `user_idx` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `cate`, `title`, `content`, `date`, `view`, `share_ban`, `download_ban`, `is_notice`, `user_idx`) VALUES
(1, '1', 'asdads', 'asdasdfasdf', '2022-08-16 01:54:03', 0, 'on', 'on', '', '1'),
(2, '1', 'ㅁㄴㅇㅁㄴㅇㅇ', 'ㄴㅁㅁㄴㅇㅁㄴㅇㅁㄴㅇ', '2022-08-16 09:42:04', 29, '', '', '', '1'),
(3, '2', '아니 근데 솔직히 겸이정도면 일베 아니지 않나', '나는 지금 이 팀에서 행복하지 않다', '2022-08-16 09:44:40', 3, '', 'on', '', '1'),
(4, '3', '에이 전남과제 별거 아니네', '골차로 패배하는 맨유', '2022-08-16 09:45:28', 2, 'on', '', '', '1'),
(5, '4', 'ㄴㅇ미ㅗㅑㅏㅇㄴ마ㅣㄴㅇ머ㅏㅣㅇㅁ너ㅏㅣㅗ', 'ㅏㅣㅗㅓㅁㄴ이ㅏㅓㅁㄴ아ㅣㅗㅓㅁㄴ아ㅣㅁㄴ아ㅣㅓㅁㄴㅇ', '2022-08-16 09:45:53', 0, 'on', 'on', '', '1'),
(6, '1', 'sdsadfsdfa', 'asdfsdfasdfa', '2022-08-16 09:46:32', 3, '', '', 'on', '23');

-- --------------------------------------------------------

--
-- 테이블 구조 `comment`
--

CREATE TABLE `comment` (
  `idx` int(11) NOT NULL,
  `board` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `user_idx` text COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `comment`
--

INSERT INTO `comment` (`idx`, `board`, `content`, `user_idx`, `date`) VALUES
(1, 2, 'ㄴㅇㄹㄴㅇㄹㄴㅇㄻㄴㅁㄹㅇ', '23', '2022-08-16 09:59:23');

-- --------------------------------------------------------

--
-- 테이블 구조 `garden`
--

CREATE TABLE `garden` (
  `idx` int(11) NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `address` text COLLATE utf8mb4_bin NOT NULL,
  `phone` text COLLATE utf8mb4_bin NOT NULL,
  `management` text COLLATE utf8mb4_bin NOT NULL,
  `introduce` text COLLATE utf8mb4_bin NOT NULL,
  `latitude` int(11) NOT NULL,
  `longitude` int(11) NOT NULL,
  `themes` text COLLATE utf8mb4_bin NOT NULL,
  `manager_id` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `garden`
--

INSERT INTO `garden` (`idx`, `name`, `address`, `phone`, `management`, `introduce`, `latitude`, `longitude`, `themes`, `manager_id`) VALUES
(1, '나폴리농원', '경상남도 통영시 산양읍 미륵산길 152', '010-3117-9030', '나폴리농원', '기존 팔각정자를 바탕으로 전통적인 느낌의 공간을 조성하여 고즈넉하고 편안한 공간 계획, 평택의 이미지와 전통적인 분위기 조성합니다.', 35, 128, '[\"\\ub4f1\\uc0b0\\uae38\",\"\\uc790\\uc5f0\\uc801\",\"\\ud734\\uc591\\uc9c0\",\"\\uc2dc\\uc6d0\"]', 'garden_01'),
(2, '사천식물랜드', '경상남도 사천시 용현면 덕곡리 82-4 일원', '010-4590-8718', '사천식물랜드', '분수를 감싸고 있는 아름다운 경사지에 거대한 분수대가 손님을 가장 먼저 맞이하는 광장입니다.', 35, 128, '[\"\\uaf43\\uae38\",\"\\uad00\\uad11\\uc9c0\",\"\\uad11\\ud65c\"]', 'garden_02'),
(3, '해솔찬정원', '경상남도 통영시 도산면 저산리 572-1', '055-643-0564', '해솔찬정원', '늘 푸른 구상나무와 초여름 연분홍 꽃을 피우는 자귀나무가 펼쳐진 잔디마당은 관람객들의 눈길을 사로잡는 곳입니다.', 35, 128, '[\"\\uccb4\\ud5d8\\ud559\\uc2b5\",\"\\ucd08\\uc6d0\",\"\\uc2dd\\ubb3c\\uc6d0\"]', 'garden_03'),
(4, '통영동백커피식물원', '경상남도 통영시 도산면 원산리 920 일원', '010-3557-9634', '통영동백커피식물원', '정원을 만드는 과정에서 죽은 참나무로 쉼터를 만들었으며 봄에는 복수초와 철쭉, 여름에는 산수국, 가을에는 꽃무릇, 구절초를 볼 수 있습니다.', 35, 128, '[\"\\uc2dd\\ubb3c\\uc6d0\",\"\\uacfc\\uc218\\uc6d0\",\"\\ucd09\\ucd09\"]', 'garden_04'),
(5, '물빛소리정원', '경상남도 통영시 도산면 수월리 655-3', '010-3588-6453', '물빛소리정원', '물빛소리정원 옆으로 길게 뻗은 벚나무길에는 아름다운 루미나리에로 장식되어있어 밤이 되면 그 아름다움을 뽐냅니다.', 35, 128, '[\"\\uaf43\\uae38\",\"\\uad00\\uad11\\uc9c0\",\"\\uad11\\ud65c\"]', 'garden_05'),
(6, '춘화의 정원', '경상남도 통영시 도산면 도산일주로 56', '010-2596-6344', '춘화의 정원', '잎이나 단풍, 꽃과 열매, 가지가 빨간색인 식물과 빨간색의 쉘터. 빨간색이 색깔 고유의 파장과 에너지를 활용해 신체와 마음을 치료합니다.', 35, 128, '[\"\\uccb4\\ud5d8\\ud559\\uc2b5\",\"\\uc0b0\\ucc45\\ub85c\"]', 'garden_06'),
(7, '농부가그린정원', '경상남도 김해시 진영읍 좌곤리 765-1', '010-3832-8430', '농부가그린정원', '빛나는 번영과 발전을 상징하는 정원으로 연속성이 있는 뫼비우스의 띠를 모티브 한 공간을 구상된 정원입니다.', 35, 129, '[\"\\uc2dd\\ubb3c\\uc6d0\"]', 'garden_07'),
(8, '엄마의정원', '경상남도 밀양시 하남읍 남전7길 41-19', '010-3884-1100', '엄마의정원', '더불어 살아가는 다채로운 무지개 조형목과 겹겹이 쌓은 나뭇가지로 비유하여 다양한 문화의 포용을 느낄 수 있습니다.', 35, 129, '[\"\\uad11\\ud65c\",\"\\uc2dd\\ubb3c\\uc6d0\"]', 'garden_08'),
(9, '녹색교육정원', '경상남도 양산시 동면 개곡로77번길', '010-5574-7176', '녹색교육정원', '사회와 시민, 자연과 사람간의 소통공간으로 서로를 이해하며 감싸주는 관계의 시작점으로 조화롭게 살아가는 화합을 상징합니다.', 35, 129, '[\"\\uccb4\\ud5d8\\ud559\\uc2b5\",\"\\ube48\\ud2f0\\uc9c0\",\"\\uc790\\uc5f0\\uc801\"]', 'garden_09'),
(10, '옥동힐링가든', '경상남도 거제시 둔덕면 청마로 665-13', '055-636-8988', '옥동힐링가든', '사이프러스 나무를 대체하여 파주지역에 월동이 가능한 은청색의 블루엔젤이라는 측백나무를 식재하여 비스타를 형성하였습니다.', 35, 129, '[\"\\uacf5\\uc6d0\",\"\\uccb4\\ud5d8\\ud559\\uc2b5\",\"\\ud3ed\\ud3ec\",\"\\ucd94\\uc5b5\"]', 'garden_10'),
(11, '새미골정원', '경상남도 양산시 동면 개곡리 564', '010-3885-1567', '새미골정원', '사계장미, 플로리분다 등 프랑스, 독일 등의 장미가 자리하고 있습니다. 봄에는 다양한 사계장미가 트렐리스 아치 등에 연출될 예정입니다.', 35, 129, '[\"\\uacf5\\uc6d0\",\"\\uc0b0\",\"\\uc2dc\\uc6d0\"]', 'garden_11'),
(12, '느티나무의 사랑', '경상남도 양산시 동면 여락리 103 일원', '055-912-5551', '느티나무의 사랑', '자수화단이 한눈에 내려다 보이는 해피가든에서는 봄부터 가을까지 매주 재즈공연이 열립니다. 라이브 공연과 함께 즐기는 맥주 한잔의 여유를 즐길 수 있습니다.', 35, 129, '[\"\\ub098\\ubb34\",\"\\uad11\\ud65c\",\"\\uacf5\\uc6d0\"]', 'garden_12'),
(13, '만년교정원', '경상남도 창녕군 영산면 원다리길 17', '010-9431-2277', '만년교정원', '‘사라진 도시의 복원’이라는 벽화가 있습니다. 폭포의 안으로 들어가면 사라진 도시를 한껏 느낄 수 있습니다.', 35, 129, '[\"\\ub18d\\ucd0c\",\"\\ub300\\ud615\",\"\\uc790\\uc5f0\\uc801\"]', 'garden_13'),
(14, '그레이스정원', '경상남도 고성군 상리면 삼상로 1312-71', '055-673-1803', '그레이스정원', '푸른 잔디밭에서는 결혼, 가정, 출산의 여신인 헤라가 여는 행복의 파티가 열리는 정원입니다.', 35, 128, '[\"\\uc790\\uc5f0\\uc801\",\"\\ud734\\uc591\\uc9c0\",\"\\uc0b0\\ub9bc\\uc695\",\"\\uad11\\ud65c\"]', 'garden_14'),
(15, '만화방초정원', '경상남도 고성군 거류면 은황길 82-91', '010-3870-1041', '만화방초', '수목한계선 아래에 자생하는 고산식물과 건조 기후에 사는 다육식물, 마름견딜성 식물들이 실개울과 연못 주변에 다양한 형식으로 연출되었습니다.', 35, 128, '[\"\\uc0b0\\ucc45\\ub85c\",\"\\uc2dc\\uc6d0\",\"\\uc790\\uc5f0\\uc801\"]', 'garden_15'),
(16, '섬이정원', '경상남도 남해군 남면 평산리 888-4번지', '010-2255-3577', '섬이정원', '작은 호수 중앙에 하트모양의 섬과 빨간색 흔들다리, 하트모양의 연못, 다양한 수변, 수생 식물과 생물 등이 서식할 수 있는 생태와 사랑을 주제로 한 정원입니다.', 35, 128, '[\"\\ub098\\ubb34\",\"\\uc0b0\\ucc45\\ub85c\",\"\\ube48\\ud2f0\\uc9c0\"]', 'garden_16'),
(17, '화계리정원', '경상남도 남해군 이동면 화계리 292-6', '010-4074-6444', '화계리정원', '푸른 잔디, 편안한 평상, 시원하게 펼쳐진 나무 그늘에서 잠시 쉬어가는 여유 시간을 즐길 수 있습니다.', 35, 128, '[\"\\uce5c\\uadfc\",\"\\ube48\\ud2f0\\uc9c0\",\"\\ub098\\ubb34\"]', 'garden_17'),
(18, '토피어리정원', '경상남도 남해군 창선면 서부로 270-106', '010-2851-2978', '토피어리정원', '지형적 제약으로 경사지를 계단형으로 만든 이탈리아의 대표적인 노단 건축식 정원입니다.', 35, 128, '[\"\\uccb4\\ud5d8\\ud559\\uc2b5\",\"\\ucd08\\uc6d0\",\"\\uc0b0\",\"\\uaf43\\uae38\",\"\\ub3d9\\ud654\"]', 'garden_18'),
(19, '하미앙정원', '경남 함양군 함양읍 삼봉로 442-14', '055-964-2500', '하미앙정원', '새들이 좋아하는 열매 식물들을 심어 놓은 정원으로 파주 운정지구 개발로 없어지게 될 나무들을 이식하여 자연 훼손방지, 자연과 공생하는 친 환경적인 정원입니다.', 35, 128, '[\"\\uacf5\\uc6d0\",\"\\ud734\\uc2dd\",\"\\uad11\\ud65c\"]', 'garden_19'),
(20, '이수미팜베리정원', '경상남도 거창군 거창읍 가지리 산250-3', '055-945-1789', '이수미팜베리정원', '남쪽지방 난대 수종과 아열대, 열대, 건조지 수종으로 남도 숲, 녹차밭, 귤원, 동백원, 향기원, 연꽃과 열대성 조류가 있는 버드가든 등 사계절 다양한 테마가 있는 정원입니다.', 36, 128, '[\"\\uc74c\\uc2dd\\uc810\",\"\\uc0b0\\ucc45\\ub85c\",\"\\uc544\\ub291\"]', 'garden_20'),
(21, '이한메미술관', '경상남도 거창군 북상면 송계로 1243-15', '010-3227-0345', '이한메미술관', '다양한 작품이 존재하고 입구에는 아름다운 꽃들과 향기가 공존하는 정원이 존재합니다.', 36, 128, '[\"\\uacf5\\uc6d0\",\"\\uad11\\ud65c\",\"\\uc2dc\\uc6d0\"]', 'garden_21'),
(22, '자연의소리정원', '경상남도 거창군 가북면 용암리 산62 일원', '055-262-2729', '자연의소리정원', '사계절 흰색 꽃과 흐니 자작이 둘러쌓고 있는 하얀 빛깔의 숲 중앙에는 달빛이 비치는 연못이 자리하고 있습니다.', 36, 128, '[\"\\uc0b0\",\"\\uc0b0\\ucc45\\ub85c\",\"\\uc5f0\\ubabb\",\"\\uc608\\uc220\"]', 'garden_22');

-- --------------------------------------------------------

--
-- 테이블 구조 `image`
--

CREATE TABLE `image` (
  `idx` int(11) NOT NULL,
  `gal` text COLLATE utf8mb4_bin NOT NULL,
  `src` text COLLATE utf8mb4_bin NOT NULL,
  `type` text COLLATE utf8mb4_bin NOT NULL,
  `owner_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `image`
--

INSERT INTO `image` (`idx`, `gal`, `src`, `type`, `owner_idx`) VALUES
(1, 'true', '/resources/upload/a40a57c13ae0e3da86a8b2c91220351c1.jpg', 'review', 3),
(2, 'true', '/resources/upload/59fc383444e9253d99bd2cff422611542.jpg', 'review', 3),
(3, 'true', '/resources/upload/dae5c93705aacc18d9d3bfb32ea2ae563.jpg', 'review', 3),
(4, 'true', '/resources/upload/c67010f46ad395c65ec31631409b3c1b4.jpg', 'review', 3),
(8, 'on', '/resources/upload/7f2d0c3c8742e1ea1852a034df8b68f21.jpg', 'news', 1),
(9, 'on', '/resources/upload/488e18a145adf8d27c2e9ef5c34fc93f2.jpg', 'news', 1),
(10, 'on', '/resources/upload/2c5434ab671b07fce5d9bebbb7bc067d3.jpg', 'news', 1),
(11, 'on', '/resources/upload/787dabdbad8a1a2797af2941c626fdf54.jpg', 'news', 1),
(12, 'on', '/resources/upload/698265914adbc56b4a6ff04e6ece70ec1.jpg', 'news', 1),
(13, 'on', '/resources/upload/c29d6e733443cd59af91a3331178e9e72.jpg', 'news', 1),
(14, 'on', '/resources/upload/c68a93a5e097011f38cefc9f895f6be33.jpg', 'news', 1),
(15, 'on', '/resources/upload/30003107c81790c74ce93e5cc9b0472e4.jpg', 'news', 1),
(16, '', '/resources/upload/bdd99a7991995eefab8d3857682af22dlogo.png', 'news', 2),
(17, 'on', '/resources/upload/b7933d5dffc708fa5cd297a926a062fb루카쿠.jpg', 'news', 3),
(18, 'on', '/resources/upload/39104a1f7c8ac715fd2d848ff86ab9f5네골차.png', 'news', 4),
(19, '', '/resources/upload/9b3f731059d85dfaadc0bc5b95986ddd네골차.png', 'news', 5),
(20, '', '/resources/upload/f9de93179d68575e2009543584cc2986루카쿠.jpg', 'news', 5),
(21, '', '/resources/upload/828b1fa717e1bcf88f89b213e84fae05네골차.png', 'news', 6);

-- --------------------------------------------------------

--
-- 테이블 구조 `no_res`
--

CREATE TABLE `no_res` (
  `idx` int(11) NOT NULL,
  `date` text COLLATE utf8mb4_bin NOT NULL,
  `month` text COLLATE utf8mb4_bin NOT NULL,
  `garden` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `no_res`
--

INSERT INTO `no_res` (`idx`, `date`, `month`, `garden`) VALUES
(3, '2022-08-16', '08', '1');

-- --------------------------------------------------------

--
-- 테이블 구조 `res`
--

CREATE TABLE `res` (
  `idx` int(11) NOT NULL,
  `date` text COLLATE utf8mb4_bin NOT NULL,
  `count` int(11) NOT NULL,
  `price` text COLLATE utf8mb4_bin NOT NULL,
  `state` text COLLATE utf8mb4_bin NOT NULL,
  `garden` text COLLATE utf8mb4_bin NOT NULL,
  `user_idx` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `res`
--

INSERT INTO `res` (`idx`, `date`, `count`, `price`, `state`, `garden`, `user_idx`) VALUES
(1, '2022-08-16', 12312, '61560000', '취소', '1', '27'),
(2, '2022-08-28', 12312, '61560000', '취소', '1', '27'),
(4, '2022-08-15', 123, '615000', '방문', '1', '27'),
(5, '2022-08-15', 123, '615000', '방문', '11', '27');

-- --------------------------------------------------------

--
-- 테이블 구조 `review`
--

CREATE TABLE `review` (
  `idx` int(11) NOT NULL,
  `content` text COLLATE utf8mb4_bin NOT NULL,
  `tag` text COLLATE utf8mb4_bin NOT NULL,
  `star` text COLLATE utf8mb4_bin NOT NULL,
  `garden` text COLLATE utf8mb4_bin NOT NULL,
  `user` text COLLATE utf8mb4_bin NOT NULL,
  `res` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `review`
--

INSERT INTO `review` (`idx`, `content`, `tag`, `star`, `garden`, `user`, `res`) VALUES
(3, 'ㄴㅁㄹㅇ', '자연적인,광활한,가족여행,관광', '7', '1', '27', '4');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `id` text COLLATE utf8mb4_bin NOT NULL,
  `pass` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `type` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`idx`, `id`, `pass`, `name`, `type`) VALUES
(1, 'garden_01', '1234', '나폴리농원', 'manager'),
(2, 'garden_02', '1234', '사천식물랜드', 'manager'),
(3, 'garden_03', '1234', '해솔찬정원', 'manager'),
(4, 'garden_04', '1234', '통영동백커피식물원', 'manager'),
(5, 'garden_05', '1234', '물빛소리정원', 'manager'),
(6, 'garden_06', '1234', '춘화의 정원', 'manager'),
(7, 'garden_07', '1234', '농부가그린정원', 'manager'),
(8, 'garden_08', '1234', '엄마의정원', 'manager'),
(9, 'garden_09', '1234', '녹색교육정원', 'manager'),
(10, 'garden_10', '1234', '옥동힐링가든', 'manager'),
(11, 'garden_11', '1234', '새미골정원', 'manager'),
(12, 'garden_12', '1234', '느티나무의 사랑', 'manager'),
(13, 'garden_13', '1234', '만년교정원', 'manager'),
(14, 'garden_14', '1234', '그레이스정원', 'manager'),
(15, 'garden_15', '1234', '만화방초정원', 'manager'),
(16, 'garden_16', '1234', '섬이정원', 'manager'),
(17, 'garden_17', '1234', '화계리정원', 'manager'),
(18, 'garden_18', '1234', '토피어리정원', 'manager'),
(19, 'garden_19', '1234', '하미앙정원', 'manager'),
(20, 'garden_20', '1234', '이수미팜베리정원', 'manager'),
(21, 'garden_21', '1234', '이한메미술관', 'manager'),
(22, 'garden_22', '1234', '자연의소리정원', 'manager'),
(23, 'admin', '1234', 'admin', 'admin'),
(26, 'b', 'b', 'b', 'normal'),
(27, 'a', 'a', 'a', 'normal');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `garden`
--
ALTER TABLE `garden`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `no_res`
--
ALTER TABLE `no_res`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `res`
--
ALTER TABLE `res`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `review`
--
ALTER TABLE `review`
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
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 테이블의 AUTO_INCREMENT `garden`
--
ALTER TABLE `garden`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- 테이블의 AUTO_INCREMENT `image`
--
ALTER TABLE `image`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- 테이블의 AUTO_INCREMENT `no_res`
--
ALTER TABLE `no_res`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `res`
--
ALTER TABLE `res`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `review`
--
ALTER TABLE `review`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
