-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 22-07-23 07:57
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
-- 데이터베이스: `22_choongbook`
--
CREATE DATABASE IF NOT EXISTS `22_choongbook` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin;
USE `22_choongbook`;

-- --------------------------------------------------------

--
-- 테이블 구조 `art`
--

CREATE TABLE `art` (
  `idx` int(11) NOT NULL,
  `art_id` text COLLATE utf8mb4_bin NOT NULL,
  `art_name` text COLLATE utf8mb4_bin NOT NULL,
  `price` int(11) NOT NULL,
  `product_img` text COLLATE utf8mb4_bin NOT NULL,
  `description` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `type` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `art`
--

INSERT INTO `art` (`idx`, `art_id`, `art_name`, `price`, `product_img`, `description`, `name`, `type`) VALUES
(1, 'KO-2653', 'ㅁㄴㅇㅁㄴㅇ', 1200001111, '5d46322f68272b8cee4e1289a30edacb여행.png', '준비중', '백신의', '한국화'),
(3, 'KO-2342', '作品 9004', 150000, '김수길_作品 9004.png', '준비중', '김수길', '한국화'),
(4, 'KO-2735', '作品 9004', 100000, '김은호_이태백 취수.jpg', '준비중', '김은호', '한국화'),
(5, 'KO-2817', '미상', 100000, '김화경, 미상.jpg', '준비중', '김화경', '한국화'),
(6, 'KO-2336', '기마도', 100000, '남정_박노수.png', '동정호에서 서쪽을 보면 초강은 나누어 있고, 남쪽을 보면 구름도 보이지 않네. 해 질 무렵 백사장엔 가을빛이 펼쳐지고 어느 곳에서 상군을 조상할까..?', '남정 박노수', '한국화'),
(7, 'KO-2469', '터널', 100000, '류회민_터널.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '류회민', '한국화'),
(8, 'KO-2726', '미상', 100000, '박노수 미상.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '박노수', '한국화'),
(9, 'KO-2818', '월하취적도', 100000, '박노수_월하취적도1.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '박노수', '한국화'),
(10, 'KO-2795', '미상', 100000, '백윤목_미상.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '백윤문', '한국화'),
(11, 'KO-2737', '오륙도 전경', 100000, '소정_변관식.jpg', '준비중', '소정 변관식', '한국화'),
(12, 'KO-2481', '아심비석불가전야', 100000, '엄성관 소.jpg', '내 마음이 둘이 아니어서 굴릴 수 없다. 의지가 굳어서 쉽게 굴리지 않는다. 즉 바위는 굴릴 수 있지만 내 마음은 워낙 단단해서 지조를 지겠다. 그 강한 힘을 황소로 비유함.', '엄성관', '한국화'),
(13, 'KO-2736', '연날리기', 100000, '유천_김화경.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '유천 김화경', '한국화'),
(14, 'KO-2334', '향원익청', 100000, '민경갑_향원익청1.png', '향기는 멀리까지 가고 맑음은 더하구나', '유산 민경갑', '한국화'),
(15, 'KO-2483', '소와 목동', 100000, '이규옥_소와 목동.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '이규옥', '한국화'),
(16, 'KO-2815', '환', 100000, '이석우_농악(19한-2815).png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '이석우', '한국화'),
(17, 'KO-2814', '호춘', 100000, '이석우_화조도.png', '봄을 노래하다.', '이석우', '한국화'),
(18, 'KO-2843', '피난길', 100000, '이석우-피난길.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '이석우', '한국화'),
(19, 'KO-2816', '풍물놀이', 100000, '이양원, 풍물놀이.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '이양원', '한국화'),
(20, 'KO-28109', '미상', 100000, '이유태, 미상.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '이유태', '한국화'),
(21, 'KO-2720', '낙조일경', 100000, '장우성_낙조일경.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '장우성', '한국화'),
(22, 'KO-2472', '청운동 기념비', 100000, '정재호 소용량.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '정재호', '한국화'),
(23, 'KO-2437', 'Conditional Planes 8308', 100000, '정재호 소용량.png', '평면조건 8308(Conditional Planes 8308)(1983)은 먹물로 한지 전면을 검게 물들인 뒤, 한지 뒤에서 솔로 두드려 화면 위에 마티에르를 표현한 작품이다.', '최명영', '한국화'),
(24, 'PA-2918', '부산 풍경', 100000, '김남배, 부산 풍경(1).png', '<부산 풍경>은 초기 부산화단의 특징인 인상주의와 표현주의적 화풍과 1950년대 말 김남배가 심취한 동양의 수묵화적 화풍을 나타낸다', '김남배', '회화'),
(25, 'PA-2887', '대안', 150000, '김동규, 대안1.png', '천과 염료를 이용한 번지기 기법을 사용했으며 전체 이미지는 인체 형상으로 서로 상호간의 무언의 대화를 상징하는 대안으로 순간 상황내면 표출이다.', '김동규', '회화'),
(26, 'PA-2920', '게임', 150000, '김미애, 게임(1).png', '준비중', '김미애', '회화'),
(27, 'PA-2896', '역사의 거울 앞에서', 100000, '김영덕, 역사의 거울 앞에서.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '김영덕', '회화'),
(28, 'PA-2924', '얼굴', 100000, '김은주, 얼굴.png', '인체를 주로 그려온 작가가 그린 자화상이다', '김은주', '회화'),
(29, 'PA-2926', '생', 100000, '김춘자, 생.png', '식물이나 동물, 곤충들이 경계 없이 혼재된 형상으로 자연의 미분화 지점에서의 원초적 생명력을 표현하고자 했다.', '김춘자', '회화'),
(30, 'PA-2928', '큰 종이호랑이', 100000, '박경인, 큰 종이호랑이(3).png', '불화의 시대와 그 땅 위에서 살아가는, 그럼에도 불구하고 강한 생명력으로 살아가는 사람들의 이야기를 형상화 한 작품이다.', '박경인', '회화'),
(31, 'PA-2929', '40계단', 100000, '박병제, 40계단.png', '낡고 오래된 작은 집들, 경사진 골목과 계단은 지정학적 문제를 넘어 도시의 내면 그리고 우리 내면의 문제가 무엇인지 묻는다.', '박병제', '회화'),
(32, 'PA-2930', '도시의 이야기1', 100000, '박춘재, 도시의 이야기1.png', '강렬한 색으로 건물의 윤곽을 두른 미세하게 굽은 선의 표현이 돋보이는 작품으로 선이 가지는 운율적 조형성을 이용하였다.', '박춘재', '회화'),
(33, 'PA-2931', '갇힌 호랑이', 100000, '예유근, 갇힌 호랑이(2).png', '우리 전통적 정신의 기반인 산신령마저도 가두어 버린 시대. 변화하는 서구의 회화 이론과 동시대에 대한 격렬한 고민을 닫힌 창을 통해 들여다보고, 열리기를 기대하는 삶의 표정으로 새로운 기법의 회화적 표현 회복에 집중했다.', '예유근', '회화'),
(34, 'PA-2932', '영도', 100000, '오영재, 영도.png', '자연이 지닌 절대적 통일성을 조형적으로 재구성함으로써 객관적 응시에 대한 자신의 자각을 표현했다.', '오영재', '회화'),
(35, ' PA-2886', '달팽이 걸음-2019', 100000, '이건용.png', '준비중', '이건용', '회화'),
(36, 'PA-2935', '고독을 소독하는 사람', 100000, '정복수, 고독을 소독하는 사람(2).png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '정복수', '회화'),
(37, 'PA-2937', '낮잠', 100000, '최석운_낮잠.png', '준비중', '최석운', '회화'),
(38, ' PA-2898', '희망', 100000, '최아자, 희망(2).png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '최아자', '회화'),
(39, 'PA-2939', '해조음', 100000, '하인두, 해조음.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '하인두', '회화'),
(40, 'PA-2916', '쌍매듭 (Ed. 2/10)', 100000, '한운성, 쌍매듭.png', '준비중', '이석우', '회화'),
(41, 'PA-2940', '작은 다윗', 100000, '허찬미, 작은 다윗.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '허찬미', '회화'),
(42, 'CR-0791', '자개함', 100000, '강창원.jpg', '뚜껑과 본체 등 2개의 단위로 분리되는 함으로 뚜껑 전면에 회화적인 느낌의 산수풍경을 자개를 사용하여 배치시킨 작업으로 안정된 구도와 함께 현대적인 미감을 조화시킨 공예작업이다.', '강창원', '공예'),
(43, 'CR-0792', '주칠석목건칠-호', 150000, '권상오.jpg', '준비중', '권상오', '공예'),
(44, 'CR-0425', '무제', 150000, '김상호.png', '세라믹을 중심기법으로 하며 그 표현성만을 고려하여 최대한 자유롭게 접근 시도한 작업이다.', '김상호', '공예'),
(45, 'CR-1745', '체스트 -2007 공존', 100000, '김성수.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '김성수', '공예'),
(46, 'CR-2054', '도시', 100000, '박무봉_도시1.png', '준비중', '박무봉', '공예'),
(47, 'CR-0406', '형성87-2', 100000, '박수철.jpg', '사각 프레임 안의 사각, 사각의 중첩과 사각의 병치, 평면과 부조적 입체감을 나타내는 등 그의 작업은 주로 사각 사이의 조형적 배려로 이루어져 있다.', '박수철', '공예'),
(48, 'CR-0404', '절망과 가능성', 100000, '송번수.jpg', '준비중', '송번수', '공예'),
(49, 'CR-2045', 'Structure & Force-Horse', 100000, '신상호-Horse_좌.jpg', '동물의 형상과 건축적인 구조를 결합시킨 작품이다.', '신상호', '공예'),
(50, 'CR-1289', '生動(생동)', 100000, '오구환.jpg', '준비중', '오구환', '공예'),
(51, 'CR-2369', '陶碑(도비)', 100000, '오천학_陶碑(도비).png', '준비중', '오천학', '공예'),
(52, 'CR-0291', '즉흥 99-02', 100000, '왕경애.jpg', '자연이 지닌 절대적 통일성을 조형적으로 재구성함으로써 객관적 응시에 대한 자신의 자각을 표현했다.', '왕경애', '공예'),
(53, 'CR-0437', '불립문자', 100000, '유재구.jpg', '고려닥을 이용해서 작픔이 바탕을 넘나들고 그 위에 다시 염색한 펄프를 올리는 방법으로, 작업의 주 과정을 삼고 있다.', '유재구', '공예'),
(54, 'CR-2060', 'beyond', 100000, '윤필남_beyond1.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '윤필남', '공예'),
(55, 'CR-0794', '과기(菓器)', 100000, '이동일_과기(菓器)1.png', '준비중', '이동일', '공예'),
(56, 'CR-0955', '밀월여행', 100000, '진영섭.jpg', '물고기형상에 성형기법이 이용된 작품이다.', '진영섭', '공예'),
(57, 'SC-2822', '새들은 더 이상 노래하지 않는다', 100000, '강태훈_새들은 더 이상 노래하지 않는다(전체 파노라마)_2010.jpg', '사회에서 일어난 문제적 사건들을 상징적 오브제로 구현한 설치작품이다', '강태훈', '조각'),
(58, 'SC-2788', 'Prototype-107B', 150000, '김성진_Prototype-107B.png', '준비중', '김성진', '조각'),
(59, 'SC-2827', '겐다로크', 150000, '김인배_겐다로크.png', '일반적인 기념비 형태의 좌대 위에 흉상이 있다. 흉상의 얼굴이 중심에서 좌우 양쪽으로 분화된 형태를 보여준다', '김인배', '조각'),
(60, 'SC-2856', '유리창을 통한 프레임만들기', 100000, '김정명.png', '초기 실험 작업부터 사용된 액자 프레임은 창문 프레임으로 확장되는데, 세상을 바라보고 관찰하기 위한 특정한 관점을 의미하는 프레임은 기존의 사물이나 현상에 대한 새로운 시각을 의미한다.', '김정명', '조각'),
(61, 'SC-2850', '거울에 머문 바람', 100000, '김정명.png', '철 육면체 틀 안에 비닐 물주머니를 매달고 바닥에 거울을 놓아 사물과 공간과의 유기적인 관계를 개념화시킨 작품이다. ', '김청정', '조각'),
(62, 'SC-2784', '솔 르윗 뒤집기- 8배로 축소된, 셋x넷x셋', 100000, '양혜규.png', '블라인드 입방체로 모형화된 본 작품은 시시각각 변화하는 빛이 백색 블라인드와 조우하며 생동감 있는 색의 울림과 해방감을 느낄 수 있게 하는 작품이다.', '양혜규', '조각'),
(63, 'SC-2783', '108', 100000, '윤석남.png', '소외된 존재들에 대한 작가의 애정과 관심이 묻어나는 조각 작품이다.', '윤석남', '조각'),
(64, 'SC-2786', 'Spherique', 100000, '윤희 소용량.png', '준비중', '윤희', '조각'),
(65, 'SC-2825', 'Prayer', 100000, '이병호_Prayer.png', '에어 컴프레셔의 공기 주입에 따라 수축과 팽창을 반복하는 실리콘으로 제작된다.', '이병호', '조각'),
(66, 'SC-2779', '공원', 100000, '이종빈.jpg', '준비중', '이종빈', '조각'),
(67, 'SC-2821', '편도여행', 100000, '이창운 (1).jpg', '레일 위에는 금방 깨질 것 같으면서도 견고한 달걀이 줄지어 움직인다. 그가 보여주는 특별할것 없는 반복된 달걀의 움직임은 보는 이로 하여금 각자의 일상을 환기한다.', '이창운', '조각'),
(68, 'SC-2936', '인형-나의 긴 붓으로', 100000, '정철교- 인형- 나의 긴 붓으로 (1).png', '준비중', '정철교', '조각'),
(69, 'SC-2787', 'Abstract time', 100000, '정혜련 소용량.png', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Ut dolorum porro eligendi odit, illo rem vel alias sint tenetur labore, modi, similique nam eaque quis natus cupiditate esse at cum.', '정혜련', '조각'),
(70, 'SC-2782', '태(placenta) 80-27 (Ed.0)', 100000, '최만린 소용량.png', '준비중', '최만린', '조각'),
(71, 'SC-2938', '공주님의자+메이드인 코리아', 100000, '최정화, 공주님의자+메이드인 코리아.png', '흔히 볼 수 있는 플라스틱 의자의 외형을 가진 작품으로, 마치 제프 쿤스의 ‘풍선 강아지’처럼 고혹적인 색상을 띄며 반짝인다.', '최정화', '조각'),
(72, 'SC-2824', '1995~2016년', 100000, '홍명섭_탈제.jpeg', '흔히 볼 수 있는 플라스틱 의자의 외형을 가진 작품으로, 마치 제프 쿤스의 ‘풍선 강아지’처럼 고혹적인 색상을 띄며 반짝인다.', '홍명섭', '조각'),
(73, 'CA-0278', '현우현현판,정각', 100000, '정기호.jpg', '석불 글, 아들 목불 새김', '(석불)정기호', '서예'),
(74, 'CA-0277', '반야심경', 150000, '해암.jpg', '준비중', '해암', '서예');

-- --------------------------------------------------------

--
-- 테이블 구조 `buy`
--

CREATE TABLE `buy` (
  `idx` int(11) NOT NULL,
  `art_idx` int(11) NOT NULL,
  `buy_num` text COLLATE utf8mb4_bin NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `buy`
--

INSERT INTO `buy` (`idx`, `art_idx`, `buy_num`, `date`, `user_idx`) VALUES
(1, 1, 'Z421', '2022-07-20 11:49:48', 2),
(2, 1, 't763', '2022-07-20 12:10:58', 2),
(3, 1, 'q035', '2022-07-20 12:11:19', 2),
(4, 1, 'g830', '2022-07-20 12:42:17', 2),
(5, 2, 'g830', '2022-07-20 12:42:17', 2),
(6, 5, 'g830', '2022-07-20 12:42:17', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `cart`
--

CREATE TABLE `cart` (
  `idx` int(11) NOT NULL,
  `user_idx` int(11) NOT NULL,
  `art_idx` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `cart`
--

INSERT INTO `cart` (`idx`, `user_idx`, `art_idx`) VALUES
(4, 2, 4);

-- --------------------------------------------------------

--
-- 테이블 구조 `lease`
--

CREATE TABLE `lease` (
  `idx` int(11) NOT NULL,
  `room` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `user_idx` text COLLATE utf8mb4_bin NOT NULL,
  `start` text COLLATE utf8mb4_bin NOT NULL,
  `end` text COLLATE utf8mb4_bin NOT NULL,
  `build` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `lease`
--

INSERT INTO `lease` (`idx`, `room`, `name`, `user_idx`, `start`, `end`, `build`) VALUES
(1, '107', '회원1', '2', '2022-07-20', '2022-07-31', 'future'),
(2, '101', '회원1', '2', '2022-07-20', '2022-07-31', 'youth'),
(3, '111,112,113,', '회원1', '2', '2022-07-20', '2022-07-31', 'future'),
(4, '102,104,106,108,110,', '회원1', '2', '2022-07-20', '2022-07-31', 'youth');

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `idx` int(11) NOT NULL,
  `id` text COLLATE utf8mb4_bin NOT NULL,
  `pass` text COLLATE utf8mb4_bin NOT NULL,
  `name` text COLLATE utf8mb4_bin NOT NULL,
  `type` text COLLATE utf8mb4_bin NOT NULL,
  `color` text COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`idx`, `id`, `pass`, `name`, `type`, `color`) VALUES
(1, 'admin', '1234', '관리자', 'admin', ''),
(2, 'user1', '1234', '회원1', 'user', '#B855D5'),
(3, 'user2', '1234', '회원2', 'user', '#F7FDC8'),
(4, 'user3', '1234', '회원3', 'user', '#CCBDDA'),
(5, 'user4', '1234', '회원4', 'user', '#DE13A0');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `art`
--
ALTER TABLE `art`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `lease`
--
ALTER TABLE `lease`
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
-- 테이블의 AUTO_INCREMENT `art`
--
ALTER TABLE `art`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- 테이블의 AUTO_INCREMENT `buy`
--
ALTER TABLE `buy`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- 테이블의 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 테이블의 AUTO_INCREMENT `lease`
--
ALTER TABLE `lease`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
