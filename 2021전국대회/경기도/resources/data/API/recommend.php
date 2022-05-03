<?php
	session_start();

	try {
		if (@!$_SESSION['timer']) {
			$_SESSION['timer'] = 0;
		}

    $methodArray = $_GET;

    if (count($_POST)) {
			http_response_code(405);
			header("Content-type: application/json");
			echo json_encode([
				"httpCode" => 405,
				"msg" => "요청 메서드는 GET 요청만 가능합니다."
			]);
      exit;
    }

    $json = [
		  "bakeries" => [
		    [
		      "idx" => 1,
		      "name" => "슬로우브레드",
		      "mainImage" => "1.jpg",
		      "subImage" => [
		          "sub_1.jpg",
		          "sub_2.jpg"
		      ],
		      "openTime" => "07:30",
		      "endTime" => "22:00",
		      "grade" => 1,
		      "reviewCnt" => 259,
		      "visitant" => 273,
		      "sales" => 2421923,
		      "intro" => "고객분들의 신뢰성을 잃는다면 그것은 바로 빵을 만들 자격이 없다는 뜻입니다. 저희는 그 신뢰성을 배신하지 않도록 항상 노력합니다.",
		      "location" => "대전광역시 유성구 전민동 303-13"
		    ],
		    [
		      "idx" => 2,
		      "name" => "라프레즈",
		      "mainImage" => "2.jpg",
		      "subImage" => [
		          "sub_3.jpg",
		          "sub_4.jpg"
		      ],
		      "openTime" => "06:00",
		      "endTime" => "22:30",
		      "grade" => 3,
		      "reviewCnt" => 97,
		      "visitant" => 371,
		      "sales" => 2629340,
		      "intro" => "흔히들 빵에 안 좋은 성분이 들어있다고 생각하시곤 하죠. 하지만 저 라프 레즈의 빵을 드셔보시면 생각이 달라지실 겁니다.",
		      "location" => "대전광역시 유성구 지족동 1093"
		    ],
		    [
		      "idx" => 3,
		      "name" => "성심당 본점",
		      "mainImage" => "3.jpg",
		      "subImage" => [
		          "sub_5.jpg",
		          "sub_6.jpg"
		      ],
		      "openTime" => "06:30",
		      "endTime" => "20:00",
		      "grade" => 2,
		      "reviewCnt" => 84,
		      "visitant" => 569,
		      "sales" => 1982577,
		      "intro" => "성심당은 대전의 문화입니다. '맛있는 빵, 경이로운 빵, 생명의 빵'을 통해 사랑의 문화를 이루고자 합니다.",
		      "location" => "대전시 중구 은행동 145"
		    ],
		    [
		      "idx" => 4,
		      "name" => "하레하레",
		      "mainImage" => "4.jpg",
		      "subImage" => [
		          "sub_7.jpg",
		          "sub_8.jpg"
		      ],
		      "openTime" => "10:20",
		      "endTime" => "21:20",
		      "grade" => 3,
		      "reviewCnt" => 31,
		      "visitant" => 449,
		      "sales" => 1120000,
		      "intro" => "저희 가게는 카페까지 준비가 되어있어 맛있는 빵과 조용한 티타임을 가지실 수 있습니다.",
		      "location" => "대전광역시 서구 둔산1동 1509"
		    ],
		    [
		      "idx" => 5,
		      "name" => "가또앤브레드",
		      "mainImage" => "5.jpg",
		      "subImage" => [
		          "sub_9.jpg",
		          "sub_10.jpg"
		      ],
		      "openTime" => "07:50",
		      "endTime" => "23:10",
		      "grade" => 4,
		      "reviewCnt" => 56,
		      "visitant" => 271,
		      "sales" => 1442548,
		      "intro" => "맛있는 빵과 디저트를 만들어 고객분들에게 대접하는 게 가또앤브레드의 큰 행복입니다. 항상 최선을 다하는 가또앤브레드가 되겠습니다.",
		      "location" => "대전광역시 대덕구 송촌동 496-7"
		    ],
		    [
		      "idx" => 6,
		      "name" => "콜마르브레드",
		      "mainImage" => "6.jpg",
		      "subImage" => [
		          "sub_11.jpg",
		          "sub_12.jpg"
		      ],
		      "openTime" => "09:20",
		      "endTime" => "22:30",
		      "grade" => 2,
		      "reviewCnt" => 285,
		      "visitant" => 26,
		      "sales" => 2321806,
		      "intro" => " 매일 신선한 재료를 공수해오고 있습니다. 맛있고 달콤한 빵을 드실 수 있습니다.",
		      "location" => "대전광역시 유성구 어은동 110-9"
		    ],
		    [
		      "idx" => 7,
		      "name" => "이봉구케익과자점",
		      "mainImage" => "7.jpg",
		      "subImage" => [
		          "sub_13.jpg",
		          "sub_14.jpg"
		      ],
		      "openTime" => "11:00",
		      "endTime" => "23:50",
		      "grade" => 2,
		      "reviewCnt" => 27,
		      "visitant" => 83,
		      "sales" => 675918,
		      "intro" => "대전을 대표하는 빵집, 가족과 함께 오고 가도 최고의 가성비로 여러분들을 모시겠습니다. 항상 맛있고 건강한 빵을 만들겠습니다.",
		      "location" => "대전광역시 중구 유천2동 204-1"
		    ],
		    [
		      "idx" => 8,
		      "name" => "마인츠돔",
		      "mainImage" => "8.jpg",
		      "subImage" => [
		          "sub_15.jpg",
		          "sub_16.jpg"
		      ],
		      "openTime" => "07:00",
		      "endTime" => "20:00",
		      "grade" => 0,
		      "reviewCnt" => 178,
		      "visitant" => 124,
		      "sales" => 1457497,
		      "intro" => "'맛을 소중히하는 저희, 사람을 소중히 하는 저희, 빵을 향한 마음은 항상 진심인 대를 잇는 명장 家 마인츠 돔입니다.",
		      "location" => "대전광역시 유성구 원신흥동 558-1"
		    ],
		    [
		      "idx" => 9,
		      "name" => "파리바게뜨 송촌점",
		      "mainImage" => "9.png",
		      "subImage" => [
		          "sub_17.jpg",
		          "sub_18.jpg"
		      ],
		      "openTime" => "09:30",
		      "endTime" => "21:00",
		      "grade" => 3,
		      "reviewCnt" => 19,
		      "visitant" => 86,
		      "sales" => 2930000,
		      "intro" => "건강하지만 맛있어야, 맛있지만, 건강해야, 매일 먹을 수 잇다는 평범한 원칙으로 부터 파리바게뜨의 오늘은 시작됩니다.",
		      "location" => "대전광역시 대덕구 송촌동 495-4"
		    ],
		    [
		      "idx" => 10,
		      "name" => "마들렌과자점",
		      "mainImage" => "10.jpg",
		      "subImage" => [
		          "sub_19.jpg",
		          "sub_20.jpg"
		      ],
		      "openTime" => "06:00",
		      "endTime" => "19:00",
		      "reviewCnt" => 10,
		      "visitant" => 143,
		      "sales" => 1902278,
		      "intro" => "100% 식물성 재료만으로 맛있는 건강하고 맛있는 빵은 좋은 재료에서부터 시작됩니다. 미들렌과자점에서 맛보고 즐겨보실 수 있습니다.",
		      "location" => "대전시 유성구 지족동 910-14번지",
		      "grade" => 4
		    ],
		    [
		      "idx" => 11,
		      "name" => "파리바게트",
		      "mainImage" => "11.jpg",
		      "subImage" => [
		          "sub_21.jpg",
		          "sub_22.jpg"
		      ],
		      "openTime" => "07:00",
		      "endTime" => "19:00",
		      "grade" => 2,
		      "reviewCnt" => 61,
		      "visitant" => 401,
		      "sales" => 3724110,
		      "intro" => "정직하게 짓는 맛, 언제나 좋은 빵을 만든다는 변함없는 약속입니다. 정성으로 쌓은 맛 항상 여러분들에게 보답드리겠습니다.",
		      "location" => "대전광역시 동구 자양동 190-2"
		    ],
		    [
		      "idx" => 12,
		      "name" => "에이스 베이커리",
		      "mainImage" => "12.jpg",
		      "subImage" => [
		          "sub_23.jpg",
		          "sub_1.jpg"
		      ],
		      "openTime" => "08:00",
		      "endTime" => "23:00",
		      "grade" => 3,
		      "reviewCnt" => 60,
		      "visitant" => 281,
		      "sales" => 1766489,
		      "intro" => "빵으로 고객과 가족의 행복을 빚는다. 맛있게 품질 일등주의에 바탕을 두어 맛있게 만듭니다. 깨끗하게 안전하고 신뢰할 수 있게 깨끗하게 만듭니다.",
		      "location" => "대전광역시 동구 홍도동 59-3"
		    ],
		    [
		      "idx" => 13,
		      "name" => "뚜레쥬르",
		      "mainImage" => "13.jpg",
		      "subImage" => [
		          "sub_2.jpg",
		          "sub_3.jpg"
		      ],
		      "openTime" => "07:00",
		      "endTime" => "21:00",
		      "grade" => 0,
		      "reviewCnt" => 78,
		      "visitant" => 381,
		      "sales" => 1022634,
		      "intro" => "빵은 행복을 빚습니다. 여러분들의 소망을 담을 수 있습니다. 맛있는 빵들은 하나씩의 여러분들의 소망을 담아 세계 곧곧을 누벼다닙니다. 여러분들도 소망을 세계로 퍼트려보세요!",
		      "location" => "대전광역시 중구 태평1동 평촌로 111"
		    ],
		    [
		      "idx" => 14,
		      "name" => "빵장수단팥빵",
		      "mainImage" => "14.jpg",
		      "subImage" => [
		          "sub_4.jpg",
		          "sub_14.jpg",
		          "sub_5.jpg"
		      ],
		      "openTime" => "06:00",
		      "endTime" => "22:00",
		      "grade" => 4,
		      "reviewCnt" => 47,
		      "visitant" => 150,
		      "sales" => 175603,
		      "intro" => "단팥빵 그것이 저희의 모든 것입니다. 모든 것을 담고 세계 제일의 맛을 내기 위해 항상 노력하고 인정받는 '빵장수단팥빵'이 되겠습니다.",
		      "location" => "대전광역시 동구 가오동 607"
		    ],
		    [
		      "idx" => 15,
		      "name" => "빵뜨레",
		      "mainImage" => "15.jpg",
		      "subImage" => [
		          "sub_6.jpg",
		          "sub_7.jpg"
		      ],
		      "openTime" => "10:00",
		      "endTime" => "18:00",
		      "grade" => 2,
		      "reviewCnt" => 7,
		      "visitant" => 234,
		      "sales" => 74193,
		      "intro" => "유기농의 모든 것 모든 빵재료는 유기농이며 국내산입니다. 이 모든 것이 저희가 빵에 바치는 노력을 보여준다 생각합니다. 맛있는 빵을 만들겠습니다.",
		      "location" => "대전광역시 대덕구 석봉동 194-4"
		    ],
		    [
		      "idx" => 16,
		      "name" => "비건바닐라",
		      "mainImage" => "16.jpg",
		      "subImage" => [
		          "sub_8.jpg",
		          "sub_9.jpg"
		      ],
		      "openTime" => "09:00",
		      "endTime" => "15:00",
		      "grade" => 2,
		      "reviewCnt" => 20,
		      "visitant" => 117,
		      "sales" => 710000,
		      "intro" => "건강하고 신선하게 그리고 맛있게.. 맛있고 정직한 빵, 최상의 원료로 건강한 재료로 마음까지 따뜻하게 가족의 건강을 생각하며 건강한 빵을 만들기 위해 유기농 재료를 선택한 저희입니다.",
		      "location" => "대전광역시 서구 갈마동 781"
		    ],
		    [
		      "idx" => 17,
		      "name" => "롤링핀",
		      "mainImage" => "17.jpg",
		      "subImage" => [
		          "sub_10.jpg",
		          "sub_3.jpg",
		          "sub_16.jpg",
		          "sub_7.jpg"
		      ],
		      "openTime" => "02:00",
		      "endTime" => "24:00",
		      "grade" => 5,
		      "reviewCnt" => 229,
		      "visitant" => 289,
		      "sales" => 3427554,
		      "intro" => "대한민국 프리미엄 식빵은 어느 누구에게 뒤쳐지지 않을 남다른 기술로 만듭니다. 맛과 안전한 제품을 만들기 위해 항상 노력합니다. 오늘도 행복한 맛, 그것이 평생 목표입니다.",
		      "location" => "대전광역시 유성구 관평동 931"
		    ],
		    [
		      "idx" => 18,
		      "name" => "레시피 제과",
		      "mainImage" => "18.png",
		      "subImage" => [
		          "sub_12.jpg",
		          "sub_13.jpg"
		      ],
		      "openTime" => "09:10",
		      "endTime" => "22:30",
		      "grade" => 0,
		      "reviewCnt" => 72,
		      "visitant" => 151,
		      "sales" => 1050000,
		      "intro" => "고객의 입맛을 맞추기 위해 노력, 또 노력합니다. 저희의 빵은 믿음을 보장하기 위해 레시피를 공개하고 있습니다. 그만큼 빵에 대한 신뢰도 만큼은 누구보다 자신 있습니다.",
		      "location" => "대전광역시 대덕구 중리동 245-21"
		    ],
		    [
		      "idx" => 19,
		      "name" => "보보로 베이커리",
		      "mainImage" => "19.jpg",
		      "subImage" => [
		          "sub_14.jpg",
		          "sub_15.jpg"
		      ],
		      "openTime" => "08:30",
		      "endTime" => "16:00",
		      "grade" => 2,
		      "reviewCnt" => 81,
		      "visitant" => 131,
		      "sales" => 1930000,
		      "intro" => "모든 빵에는 제각각의 사연이 존재합니다. 누군가에게는 미래의 사연이, 어느 누군가에겐 사랑의 고민이 빵에 담깁니다. 맛있는 빵으로 그 사연을 뻥 날려드리겠습니다.",
		      "location" => "대전광역시 대덕구 송촌동 계족산로81번길 96"
		    ],
		    [
		      "idx" => 20,
		      "name" => "성심당 대전역점",
		      "mainImage" => "20.jpg",
		      "subImage" => [
		          "sub_16.jpg",
		          "sub_17.jpg",
		          "sub_12.jpg"
		      ],
		      "openTime" => "07:40",
		      "endTime" => "21:40",
		      "grade" => 1,
		      "reviewCnt" => 63,
		      "visitant" => 190,
		      "sales" => 2300000,
		      "intro" => "대전을 대표하는 빵집 성심당입니다. 질이 높고, 양이 풍부한, 보기 좋은, 건강한 빵을 만들기 위해 항상 노력하며 발전하는 성심당이 되도록 노력하겠습니다.",
		      "location" => "대전시 동구 정동 1-1 대전역사내 2층"
		    ],
		    [
		      "idx" => 21,
		      "name" => "파이한모금",
		      "mainImage" => "21.jpeg",
		      "subImage" => [
		          "sub_18.jpg",
		          "sub_19.jpg"
		      ],
		      "openTime" => "06:00",
		      "endTime" => "17:00",
		      "grade" => 4,
		      "reviewCnt" => 91,
		      "visitant" => 175,
		      "sales" => 1648553,
		      "intro" => "저희 빵집의 빵은 신선하고 담백한 빵들이 엄청나게 많습니다. 새롭고 흥미로운 맛을 이끌기 위해 노력중이며, 선보이기 위한 개발을 멈추지 않으니 기대해주세요!",
		      "location" => "대전광역시 동구 자양동 197-8"
		    ],
		    [
		      "idx" => 22,
		      "name" => "베이크오프",
		      "mainImage" => "22.jpg",
		      "subImage" => [
		          "sub_20.jpg",
		          "sub_21.jpg"
		      ],
		      "openTime" => "06:40",
		      "endTime" => "23:10",
		      "grade" => 0,
		      "reviewCnt" => 41,
		      "visitant" => 251,
		      "sales" => 2130500,
		      "intro" => "해외에서 직접 배워온 베이킹 기술을 모두에게 선보일 기회라 생각됩니다. 건강한 빵을 만들기 위해 유기농 식품을 사용하며 매일 빵을 만들때 신중한 노력을 기울입니다.",
		      "location" => "대전광역시 서구 관저동 1554-4"
		    ],
		    [
		      "idx" => 23,
		      "name" => "뚠뚠제과",
		      "mainImage" => "23.jpg",
		      "subImage" => [
		          "sub_22.jpg",
		          "sub_23.jpg"
		      ],
		      "openTime" => "06:00",
		      "endTime" => "20:00",
		      "grade" => 1,
		      "reviewCnt" => 6,
		      "visitant" => 61,
		      "sales" => 206172,
		      "intro" => "건강한 빵을 위하여 오래 걸리더라도 열정을 담아 정성스럽게 만듭니다. 뚠뚠제과가 드리는 일상 속의 작은 행복, 누구나 일상 속의 담콤한을 누릴 자격이 있습니다.",
		      "location" => "대전광역시 대덕구 비래동 557-12"
		    ],
		    [
		      "idx" => 24,
		      "name" => "극동제과",
		      "mainImage" => "24.jpg",
		      "subImage" => [
		          "sub_1.jpg",
		          "sub_2.jpg"
		      ],
		      "openTime" => "04:00",
		      "endTime" => "18:00",
		      "grade" => 4,
		      "reviewCnt" => 14,
		      "visitant" => 250,
		      "sales" => 1489211,
		      "intro" => "나와 내 가족이 먹는다는 생각으로 엄선한 재료로 매일 신선한 빵을 제공하고, 제품을 개발하고 연구할 때 깊이 생각하고 진심을 다 할 것을 약속 드립니다. 매일 이 세상을 조금 더 달콤하게 만들어 갈 수 있기를 희망합니다.",
		      "location" => "대전광역시 중구 대사동 99-1"
		    ],
		    [
		      "idx" => 25,
		      "name" => "그린베이커리",
		      "mainImage" => "25.jpg",
		      "subImage" => [
		          "sub_3.jpg",
		          "sub_4.jpg"
		      ],
		      "openTime" => "07:00",
		      "endTime" => "17:50",
		      "grade" => 3,
		      "reviewCnt" => 13,
		      "visitant" => 25,
		      "sales" => 580917,
		      "intro" => "건강하고 맛있는 빵은 좋은 재료에서부터 시작됩니다. 그린베이커리는 믿고 먹을 수 있는 안전한 먹거리만을 제공한다는 신념으로 제조과정에서 일체의 화학 식품 첨가물을 넣지 않으며 쌀눈유, 두유, 콩 단백질 등의 건강한 식물성 재료만을 사용합니다.",
		      "location" => "대전광역시 유성구 관평동 816 평원오피스텔 101호"
		    ],
		    [
		      "idx" => 26,
		      "name" => "정성을다하는베이커리",
		      "mainImage" => "26.jpg",
		      "subImage" => [
		          "sub_5.jpg",
		          "sub_6.jpg",
		          "sub_7.jpg"
		      ],
		      "openTime" => "08:40",
		      "endTime" => "23:00",
		      "grade" => 1,
		      "reviewCnt" => 7,
		      "visitant" => 51,
		      "sales" => 2187788,
		      "intro" => "정성을다하는베이커리의 노하우로 탄생한 천연발효종 빵을 만나보세요. 천연발효종이란 인공 이스트가 아닌 자연에서 배양한 발효종을 오랜 시간 발효 시켜 얻어지는 천연 효모를 의미하는데 더브레드블루에서는 자사 노하우로 직접 배양한 천연발효종을 사용하여 건강하고 맛있는 빵을 매일 정성스레 구워 냅니다.",
		      "location" => "대전광역시 중구 유천2동 187-9"
		    ],
		    [
		      "idx" => 27,
		      "name" => "메이드비",
		      "mainImage" => "27.jpg",
		      "subImage" => [
		          "sub_10.jpg",
		          "sub_16.jpg",
		          "sub_6.jpg"
		      ],
		      "openTime" => "07:30",
		      "endTime" => "21:00",
		      "grade" => 1,
		      "reviewCnt" => 21,
		      "visitant" => 94,
		      "sales" => 1253167,
		      "intro" => "더브레드블루는 계란, 우유, 버터 등 동물성 재료를 전혀 사용하지 않고도 맛있는 빵을 만드는 비건 베이커리 입니다. 2017년 첫 시작으로 현재까지 저희는 식물성 재료만을 사용하여 건강하고 신선한 간식과 디저트를 제공하고 있습니다.",
		      "location" => "대전광역시 서구 둔산동 1016"
		    ],
		    [
		      "idx" => 28,
		      "name" => "바이러브하니",
		      "mainImage" => "28.jpg",
		      "subImage" => [
		        "sub_20.jpg",
		        "sub_17.jpg",
		        "sub_11.jpg",
		        "sub_1.jpg"
		      ],
		      "openTime" => "08:00",
		      "endTime" => "15:30",
		      "grade" => 2,
		      "reviewCnt" => 36,
		      "visitant" => 47,
		      "sales" => 2765000,
		      "intro" => "나와 내 가족이 먹는다는 생각으로 엄선한 재료로 매일 신선한 빵을 제공하고, 제품을 개발하고 연구할 때 깊이 생각하고 진심을 다 할 것을 약속 드립니다. 바이러브하니가 드리는 일상 속의 작은 행복이 매일 이 세상을 조금 더 달콤하게 만들어 갈 수 있기를 희망합니다.",
		      "location" => "대전광역시 서구 용문동 244-60"
		    ],
		    [
		      "idx" => 29,
		      "name" => "그린브라우니",
		      "mainImage" => "29.jpg",
		      "subImage" => [
		          "sub_12.jpg",
		          "sub_19.jpg",
		          "sub_2.jpg"
		      ],
		      "openTime" => "09:00",
		      "endTime" => "21:30",
		      "reviewCnt" => 77,
		      "visitant" => 33,
		      "sales" => 1930200,
		      "intro" => "세계 여러 나라의 빵을 맛보고 선진 기술을 찾아내는 것은 큰 즐거움이다. 그 노력으로 인해 사람들이 더 맛있는 빵을 먹을 수 있는 계기가 되기 때문이다.",
		      "location" => "대전광역시 동구 가오동 194",
		      "grade" => 0
		    ],
		    [
		      "idx" => 30,
		      "name" => "TEMS",
		      "mainImage" => "30.jpg",
		      "subImage" => [
		          "sub_3.jpg",
		          "sub_9.jpg"
		      ],
		      "openTime" => "10:00",
		      "endTime" => "21:50",
		      "grade" => 4,
		      "reviewCnt" => 51,
		      "visitant" => 177,
		      "sales" => 1732000,
		      "intro" => "가장 신선한 빵을 만들기 위해 '당일 만든 빵'을 받으실 수 있도록 하고 있으며 대량생산이 아닌 정해진 양만큼만 제작하기에 고객님들의 신뢰를 지킬 수 있습니다.",
		      "location" => "대전광역시 서구 둔산동 1248"
		    ]
		  ],

		  "menuList" => [
		    [
		      "idx" => 1,
		      "name" => "딸기 머핀",
		      "bakerIdx" => 1,
		      "image" => "8.jpg",
		      "price" => "4500",
		      "intro" => "상미종으로 느리게 발효하고 우유 풍미가 고스란히 담겨 진한 맛이 일품인 딸기 머핀",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 2,
		      "name" => "왕슈크림도넛",
		      "bakerIdx" => 1,
		      "image" => "10.jpg",
		      "price" => "5800",
		      "intro" => "더 커진 쫄깃한 도넛에 카스타드 크림이 듬뿍 샌드되어 있는 도넛",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 3,
		      "name" => "오리지널 머핀",
		      "bakerIdx" => 1,
		      "image" => "60.jpg",
		      "price" => "4200",
		      "intro" => "정통프리미엄 머핀의 맛을 느낄 수있는 오리지널 머핀",
		      "allergy" => "계란, 대두, 밀, 우유"
		    ],
		    [
		      "idx" => 4,
		      "name" => "크루아상",
		      "bakerIdx" => 1,
		      "image" => "52.jpg",
		      "price" => "3500",
		      "intro" => "최고급 고메버터의 풍미가 은은하게 퍼지는 바삭하고 담백한 크로와상",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 5,
		      "name" => "페페소세지",
		      "bakerIdx" => 1,
		      "image" => "78.jpg",
		      "price" => "4500",
		      "intro" => "육즙이 살아있는 페퍼소시지에 양파의 씹는맛이 더해진 빵선생만의 소시지빵",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 6,
		      "name" => "딸기퐁당 케이크",
		      "bakerIdx" => 2,
		      "image" => "84.jpg",
		      "price" => "19000",
		      "intro" => "딸기가 퐁당! 촉촉한 화이트스폰지에 상큼한 딸기콩포트가 어우러진 딸기생크림케이크",
		      "allergy" => "대두,계란,밀,우유"
		    ],
		    [
		      "idx" => 7,
		      "name" => "초코생크림 조각케이크",
		      "bakerIdx" => 2,
		      "image" => "83.jpg",
		      "price" => "17000",
		      "intro" => " 진한 초콜릿과 생크림을 층층이 입힌 진하고 달콤한 맛의 케이크",
		      "allergy" => "대두,계란,밀,우유"
		    ],
		    [
		      "idx" => 8,
		      "name" => "딸기생크림 컵 케이크",
		      "bakerIdx" => 2,
		      "image" => "82.jpg",
		      "price" => "19500",
		      "intro" => "육즙이 살아있는 페퍼소시지에 양파의 씹는맛이 더해진 빵선생만의 소시지빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 9,
		      "name" => "호두 연유 바게트",
		      "bakerIdx" => 2,
		      "image" => "3.jpg",
		      "price" => "8300",
		      "intro" => "고소한 호두 바게트에 달콤한 연유버터크림이 샌드 된 바게트",
		      "allergy" => "우유,대두,밀,호두"
		    ],
		    [
		      "idx" => 10,
		      "name" => "딸기마카롱도넛",
		      "bakerIdx" => 2,
		      "image" => "63.jpg",
		      "price" => "4200",
		      "intro" => "화이트초코에 딸기마카롱 후레이크를 듬뿍 얹은 달콤한 도넛",
		      "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 11,
		      "name" => "바닐라 아몬드 쿠키",
		      "bakerIdx" => 3,
		      "image" => "50.jpg",
		      "price" => "5100",
		      "intro" => "아몬드 버터의 고소함이 더해진 바닐라 쿠키",
		      "allergy" => "밀, 우유, 대두"
		    ],
		    [
		      "idx" => 12,
		      "name" => "크림치즈브레드",
		      "bakerIdx" => 3,
		      "image" => "70.jpg",
		      "price" => "6100",
		      "intro" => " 크림치즈가 들어있는 부드러운 빵에 파마산 치즈가 토핑 된 빵",
		      "allergy" => "난류,우유,대두,밀"
		    ],
		    [
		      "idx" => 13,
		      "name" => "딸기생크림 컵 케이크",
		      "bakerIdx" => 3,
		      "image" => "83.jpg",
		      "price" => "19500",
		      "intro" => "딸기 생크림이 가득 담긴 달콤한 케이크",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 14,
		      "name" => "초코 포레스트 머핀",
		      "bakerIdx" => 3,
		      "image" => "58.jpg",
		      "price" => "4800",
		      "intro" => "달콤한 2가지 초콜릿과 꾸덕한 크림치즈가 어우러진 초코덕후를 위한 머핀",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 15,
		      "name" => "치즈바게뜨",
		      "bakerIdx" => 3,
		      "image" => "75.jpg",
		      "price" => "9200",
		      "intro" => "치즈를 가득 담은 부드러운 바게트",
		      "allergy" => "밀, 우유, 대두"
		    ],
		    [
		      "idx" => 16,
		      "name" => "호두 파이",
		      "bakerIdx" => 4,
		      "image" => "69.jpg",
		      "price" => "9900",
		      "intro" => "달콤한 호두와 딸기가 들어가 있는 달콤한 파이",
		      "allergy" => "우유,밀,아황산류"
		    ],
		    [
		      "idx" => 17,
		      "name" => "모닝토스트",
		      "bakerIdx" => 4,
		      "image" => "25.jpg",
		      "price" => "7200",
		      "intro" => " 부드러운 페스츄리를 먹는 듯한 간식빵으로 아몬드 토핑으로 고소한 맛을 즐기실 수 있습니다.",
		      "allergy" => "밀,우유, 대두, 쇠고기"
		    ],
		    [
		      "idx" => 18,
		      "name" => "통밀 가득 로만밀 브레드",
		      "bakerIdx" => 4,
		      "image" => "31.jpg",
		      "price" => "3800",
		      "intro" => "통밀과 우리 토종효모로 만들어 부드럽고 건강한 로만밀 브레드",
		      "allergy" => "밀, 대두, 계란"
		    ],
		    [
		      "idx" => 19,
		      "name" => "초코생크림조각케이크",
		      "bakerIdx" => 4,
		      "image" => "47.jpg",
		      "price" => "4800",
		      "intro" => "건강한 동물성 생크림에 달콤한 가나슈크림이 더해져 부드럽고 달콤한 초코생크림 조각케이크",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 20,
		      "name" => "치즈바게뜨",
		      "bakerIdx" => 4,
		      "image" => "75.jpg",
		      "price" => "9200",
		      "intro" => "치즈를 가득 담은 부드러운 바게트",
		      "allergy" => "밀, 우유, 대두"
		    ],
		    [
		        "idx" => 21,
		        "name" => "든든한 포테이토 바게트",
		        "bakerIdx" => 5,
		        "image" => "23.jpg",
		        "price" => "7500",
		        "intro" => "삶은 감자와 달걀로 속을 채운 든든한 조리빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 22,
		        "name" => "몽블랑",
		        "bakerIdx" => 5,
		        "image" => "20.jpg",
		        "price" => "6500",
		        "intro" => "500만개가 넘게 팔린 김영모 과자점 히트 상품",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 23,
		        "name" => "마늘바게트",
		        "bakerIdx" => 5,
		        "image" => "14.jpg",
		        "price" => "6200",
		        "intro" => "버터와 달콤한 마늘소스로 만든 스테디셀러 바게트",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 24,
		        "name" => "프랑스 대통령 바게트",
		        "bakerIdx" => 5,
		        "image" => "13.jpg",
		        "price" => "4800",
		        "intro" => "프랑스 바게트 대회에서 1등을 거머쥐며엘리제궁 귀빈과 대통령에게 사랑받은 바게트",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 25,
		        "name" => "깜빠뉴트레디션",
		        "bakerIdx" => 5,
		        "image" => "22.jpg",
		        "price" => "10000",
		        "intro" => "겉은 바삭하고 속은 촉촉한고소한 맛의 정통 깜빠뉴",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 26,
		        "name" => "천연효모 갈릭치즈치아바타",
		        "bakerIdx" => 6,
		        "image" => "48.jpg",
		        "price" => "4500",
		        "intro" => "높은 온도에서 구워내 겉은 바삭하고안은 촉촉한 프랑스식 정통 치아바타",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 27,
		        "name" => "천연효모 크랜베리치아바타",
		        "bakerIdx" => 6,
		        "image" => "49.jpg",
		        "price" => "4000",
		        "intro" => "높은 온도에서 구워내 겉은 바삭하고안은 촉촉한 프랑스식 정통 치아바타",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 28,
		        "name" => "월넛 모카치노",
		        "bakerIdx" => 6,
		        "image" => "21.jpg",
		        "price" => "5500",
		        "intro" => "크림치즈와 호두가 들어간커피향이 은은한 모카빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 29,
		        "name" => "아삭 양배추빵",
		        "bakerIdx" => 6,
		        "image" => "42.jpg",
		        "price" => "3200",
		        "intro" => "담백한 빵 속에 아삭한 양배추와양파가 한가득 들어간 든든한 빵",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 30,
		        "name" => "누룩발효빵",
		        "bakerIdx" => 6,
		        "image" => "12.jpg",
		        "price" => "2800",
		        "intro" => "우리나라 천연효모 누룩으로 발효해고소한 팥앙금을 채운 빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 31,
		        "name" => "크리스피 슈크림",
		        "bakerIdx" => 7,
		        "image" => "88.jpg",
		        "price" => "3000",
		        "intro" => "달콤한 슈크림이 듬뿍들어간 부드러운 빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 32,
		        "name" => "치즈퐁듀",
		        "bakerIdx" => 7,
		        "image" => "71.jpg",
		        "price" => "2000",
		        "intro" => "진한 치즈의 풍미를 느낄 수 있는부드럽고 고소한 치즈퐁듀",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 33,
		        "name" => "크리미쿠키슈",
		        "bakerIdx" => 7,
		        "image" => "24.jpg",
		        "price" => "3900",
		        "intro" => "부드러운 크림이 들어간달콤하고 바삭한 슈",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 34,
		        "name" => "치즈듬뿍 양파빵",
		        "bakerIdx" => 7,
		        "image" => "36.jpg",
		        "price" => "6000",
		        "intro" => "고소한 체다치즈, 모짜크림치즈와양파가 어우러진 달콤한 빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 35,
		        "name" => "명장만주",
		        "bakerIdx" => 7,
		        "image" => "56.jpg",
		        "price" => "2800",
		        "intro" => "흰앙금과 공주밤을 넣어 고소하고부드러운 명장 만주",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 36,
		        "name" => "블루베리 연유빵",
		        "bakerIdx" => 8,
		        "image" => "29.jpg",
		        "price" => "6500",
		        "intro" => "달콤한 연유크림과 블루베리 쨈이환상적인 조화를 이루는 빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 37,
		        "name" => "롤크랜베리 샌드위치",
		        "bakerIdx" => 8,
		        "image" => "7.jpg",
		        "price" => "7500",
		        "intro" => "부드러운 페스트리에 특제소스와각종 견과류와 크랜베리를 넣은 샌드위치",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 38,
		        "name" => "햄치즈 샌드위치",
		        "bakerIdx" => 8,
		        "image" => "89.jpg",
		        "price" => "6000",
		        "intro" => "부드러운 식빵사이에 특제 소스와햄,치즈가 들어간 샌드위치",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 39,
		        "name" => "뺑 오 쇼콜라",
		        "bakerIdx" => 8,
		        "image" => "89.jpg",
		        "price" => "3300",
		        "intro" => "초콜릿이 들어간프랑스 정통 페이스트리",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 40,
		        "name" => "연유바게트",
		        "bakerIdx" => 8,
		        "image" => "55.jpg",
		        "price" => "5500",
		        "intro" => "달콤한 연유크림이 샌드된바삭한 통 바게트",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 41,
		        "name" => "프랑스 대통령 바게트",
		        "bakerIdx" => 9,
		        "image" => "92.jpg",
		        "price" => "4800",
		        "intro" => "프랑스 바게트 대회에서 1등을 거머쥐며엘리제궁 귀빈과 대통령에게 사랑받은 바게트",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 42,
		        "name" => "깜빠뉴트레디션",
		        "bakerIdx" => 9,
		        "image" => "74.jpg",
		        "price" => "10000",
		        "intro" => "겉은 바삭하고 속은 촉촉한고소한 맛의 정통 깜빠뉴",
		        "allergy" => "밀,계란,우유"
		    ],
		      [
		        "idx" => 43,
		        "name" => "치즈 바게트",
		        "bakerIdx" => 9,
		        "image" => "91.jpg",
		        "price" => "8100",
		        "intro" => "치즈가 다량 첨가된 부드러운 바게트",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 44,
		        "name" => "딸기 생크림 크루아상",
		        "bakerIdx" => 9,
		        "image" => "53.jpg",
		        "price" => "4000",
		        "intro" => "달콤한 딸기와 부드러운 생크림의 화합",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 45,
		        "name" => "로건브레드",
		        "bakerIdx" => 9,
		        "image" => "25.jpg",
		        "price" => "5000",
		        "intro" => "호밀, 호두를 넣은 반죽을 저온숙성 발효법으로 만든 건강빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 46,
		        "name" => "프랑스바게트",
		        "bakerIdx" => 10,
		        "image" => "93.jpg",
		        "price" => "3700",
		        "intro" => "자연 발효종으로 24시간 숙성시켜 만든프랑스 정통 방식의 고소한 바게트",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 47,
		        "name" => "요구르트브레드",
		        "bakerIdx" => 10,
		        "image" => "22.jpg",
		        "price" => "4000",
		        "intro" => "요거트와 다양한 견과류가 듬뿍들어간 고소하고 맛있는 스콘",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 48,
		        "name" => "오트밀바게트",
		        "bakerIdx" => 10,
		        "image" => "3.jpg",
		        "price" => "5500",
		        "intro" => "유산균 발효종으로 숙성,반죽 후오트밀을 토핑하여 구워낸 독일십 잡곡빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 49,
		        "name" => "레드와인 크랜베리",
		        "bakerIdx" => 10,
		        "image" => "31.jpg",
		        "price" => "5500",
		        "intro" => "오랜기간 숙성한 레드와인을 끓여알콜성분을 제거한 후 저온숙성을 한 빵",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 50,
		        "name" => "검정깨치즈빵",
		        "bakerIdx" => 10,
		        "image" => "19.jpg",
		        "price" => "4500",
		        "intro" => "유산균발효종 반죽에 검정깨와롤치즈를 넣어 만든 프랑스식 에뻬빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 51,
		        "name" => "트러플 치아바타",
		        "bakerIdx" => 11,
		        "image" => "39.jpg",
		        "price" => "4300",
		        "intro" => "향긋한 트러플냄새가 은은하게퍼지는 고소하고 담백한 치아바타",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 52,
		        "name" => "햄치즈 치아바타",
		        "bakerIdx" => 11,
		        "image" => "48.jpg",
		        "price" => "4300",
		        "intro" => "햄과 고소한 치즈가 든담백한 치아바타 ",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 53,
		      "name" => "카시스마카롱",
		      "bakerIdx" => 11,
		      "image" => "97.jpg",
		      "price" => "2500",
		      "intro" => "상큼한 카시스베리맛의 부드럽고 달콤한 마카롱",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 54,
		      "name" => "스트로베리요거트",
		      "bakerIdx" => 11,
		      "image" => "38.jpg",
		      "price" => "35000",
		      "intro" => "상큼한 생딸기와 요거트가 어울린 깔끔한 요거트 생크림 케이크",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 55,
		      "name" => "샹티코코",
		      "bakerIdx" => 11,
		      "image" => "79.jpg",
		      "price" => "38000",
		      "intro" => "코코넛퓨레를 넣은 무스와 진한 초코무스가 어우러진 무스케이크",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 56,
		      "name" => "카라멜마카롱",
		      "bakerIdx" => 12,
		      "image" => "95.jpg",
		      "price" => "38000",
		      "intro" => "달콤한 카라멜맛의 부드럽고 달콤한 마카롱",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 57,
		      "name" => "초코칩 머핀",
		      "bakerIdx" => 12,
		      "image" => "60.jpg",
		      "price" => "3300",
		      "intro" => "달콤한 초코칩이 박힌 머핀",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 58,
		      "name" => "쇼카롱 마카롱",
		      "bakerIdx" => 12,
		      "image" => "96.jpg",
		      "price" => "38000",
		      "intro" => "진한 초콜릿맛의 부드럽고 달콤한 마카롱",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 59,
		      "name" => "크리스피 슈크림",
		      "bakerIdx" => 12,
		      "image" => "88.jpg",
		      "price" => "3000",
		      "intro" => "달콤한 슈크림이 듬뿍들어간 부드러운 빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 60,
		      "name" => "오트밀바게트",
		      "bakerIdx" => 12,
		      "image" => "3.jpg",
		      "price" => "5500",
		      "intro" => "유산균 발효종으로 숙성,반죽 후오트밀을 토핑하여 구워낸 독일십 잡곡빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 61,
		      "name" => "월넛 모카치노",
		      "bakerIdx" => 13,
		      "image" => "21.jpg",
		      "price" => "5500",
		      "intro" => "크림치즈와 호두가 들어간커피향이 은은한 모카빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 62,
		      "name" => "크루아상",
		      "bakerIdx" => 13,
		      "image" => "52.jpg",
		      "price" => "3500",
		      "intro" => "최고급 고메버터의 풍미가 은은하게 퍼지는 바삭하고 담백한 크로와상",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 63,
		      "name" => "연유 식빵",
		      "bakerIdx" => 13,
		      "image" => "1.jpg",
		      "price" => "4800",
		      "intro" => "연유의 부드러움을 느낄 수 있는 식빵",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 64,
		      "name" => "요구르트브레드",
		      "bakerIdx" => 13,
		      "image" => "22.jpg",
		      "price" => "4000",
		      "intro" => "요거트와 다양한 견과류가 듬뿍들어간 고소하고 맛있는 스콘",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 65,
		      "name" => "검정깨치즈빵",
		      "bakerIdx" => 13,
		      "image" => "19.jpg",
		      "price" => "4500",
		      "intro" => "유산균발효종 반죽에 검정깨와롤치즈를 넣어 만든 프랑스식 에뻬빵",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 66,
		      "name" => "치즈듬뿍 양파빵",
		      "bakerIdx" => 14,
		      "image" => "36.jpg",
		      "price" => "6000",
		      "intro" => "고소한 체다치즈, 모짜크림치즈와양파가 어우러진 달콤한 빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 67,
		      "name" => "든든한 포테이토 바게트",
		      "bakerIdx" => 14,
		      "image" => "23.jpg",
		      "price" => "7500",
		      "intro" => "삶은 감자와 달걀로 속을 채운 든든한 조리빵",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 68,
		      "name" => "천연효모 크랜베리치아바타",
		      "bakerIdx" => 14,
		      "image" => "49.jpg",
		      "price" => "4000",
		      "intro" => "높은 온도에서 구워내 겉은 바삭하고안은 촉촉한 프랑스식 정통 치아바타",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 69,
		      "name" => "초코 케이크",
		      "bakerIdx" => 14,
		      "image" => "45.jpg",
		      "price" => "26500",
		      "intro" => "초콜릿이 들어간 정통 케이크",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 70,
		      "name" => "크리미쿠키슈",
		      "bakerIdx" => 14,
		      "image" => "24.jpg",
		      "price" => "3900",
		      "intro" => "부드러운 크림이 들어간달콤하고 바삭한 슈",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 71,
		      "name" => "마늘바게트",
		      "bakerIdx" => 15,
		      "image" => "14.jpg",
		      "price" => "6200",
		      "intro" => "버터와 달콤한 마늘소스로 만든 스테디셀러 바게트",
		      "allergy" => "난류, 우유, 대두, 밀"
		  	],
		    [
		      "idx" => 72,
		      "name" => "연유바게트",
		      "bakerIdx" => 15,
		      "image" => "55.jpg",
		      "price" => "5500",
		      "intro" => "달콤한 연유크림이 샌드된바삭한 통 바게트",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 73,
		      "name" => "명장만주",
		      "bakerIdx" => 15,
		      "image" => "56.jpg",
		      "price" => "2800",
		      "intro" => "흰앙금과 공주밤을 넣어 고소하고부드러운 명장 만주",
		      "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 74,
		      "name" => "오트밀바게트",
		      "bakerIdx" => 15,
		      "image" => "3.jpg",
		      "price" => "5500",
		      "intro" => "유산균 발효종으로 숙성,반죽 후오트밀을 토핑하여 구워낸 독일십 잡곡빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 75,
		      "name" => "바닐라 아몬드 쿠키",
		      "bakerIdx" => 15,
		      "image" => "50.jpg",
		      "price" => "5100",
		      "intro" => "아몬드 버터의 고소함이 더해진 바닐라 쿠키",
		      "allergy" => "밀, 우유, 대두"
		    ],
		    [
		      "idx" => 76,
		      "name" => "딸기 크림빵",
		      "bakerIdx" => 16,
		      "image" => "62.jpg",
		      "price" => "5500",
		      "intro" => "딸기의 상큼함과 크림의 부드러움이 가득찬 빵",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 77,
		      "name" => "오리지널 머핀",
		      "bakerIdx" => 16,
		      "image" => "60.jpg",
		      "price" => "4200",
		      "intro" => "정통프리미엄 머핀의 맛을 느낄 수있는 오리지널 머핀",
		      "allergy" => "계란, 대두, 밀, 우유"
		    ],
		    [
		      "idx" => 78,
		      "name" => "프랑스바게트",
		      "bakerIdx" => 16,
		      "image" => "93.jpg",
		      "price" => "3700",
		      "intro" => "자연 발효종으로 24시간 숙성시켜 만든프랑스 정통 방식의 고소한 바게트",
		      "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 79,
		      "name" => "딸기 머핀",
		      "bakerIdx" => 16,
		      "image" => "8.jpg",
		      "price" => "4500",
		      "intro" => "상미종으로 느리게 발효하고 우유 풍미가 고스란히 담겨 진한 맛이 일품인 딸기 머핀",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 80,
		      "name" => "왕슈크림도넛",
		      "bakerIdx" => 16,
		      "image" => "10.jpg",
		      "price" => "5800",
		      "intro" => "더 커진 쫄깃한 도넛에 카스타드 크림이 듬뿍 샌드되어 있는 도넛",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 81,
		      "name" => "트러플 치아바타",
		      "bakerIdx" => 17,
		      "image" => "39.jpg",
		      "price" => "4300",
		      "intro" => "향긋한 트러플냄새가 은은하게퍼지는 고소하고 담백한 치아바타",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 82,
		      "name" => "롤크랜베리 샌드위치",
		      "bakerIdx" => 17,
		      "image" => "7.jpg",
		      "price" => "7500",
		      "intro" => "부드러운 페스트리에 특제소스와각종 견과류와 크랜베리를 넣은 샌드위치",
		      "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 83,
		      "name" => "스트로베리요거트",
		      "bakerIdx" => 17,
		      "image" => "38.jpg",
		      "price" => "35000",
		      "intro" => "상큼한 생딸기와 요거트가 어울린 깔끔한 요거트 생크림 케이크",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 84,
		      "name" => "오리지널 머핀",
		      "bakerIdx" => 17,
		      "image" => "60.jpg",
		      "price" => "4200",
		      "intro" => "정통프리미엄 머핀의 맛을 느낄 수있는 오리지널 머핀",
		      "allergy" => "계란, 대두, 밀, 우유"
		    ],
		    [
		      "idx" => 85,
		      "name" => "초코 포레스트 머핀",
		      "bakerIdx" => 17,
		      "image" => "58.jpg",
		      "price" => "4800",
		      "intro" => "달콤한 2가지 초콜릿과 꾸덕한 크림치즈가 어우러진 초코덕후를 위한 머핀",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 86,
		      "name" => "샹티코코",
		      "bakerIdx" => 18,
		      "image" => "79.jpg",
		      "price" => "38000",
		      "intro" => "코코넛퓨레를 넣은 무스와 진한 초코무스가 어우러진 무스케이크",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 87,
		      "name" => "천연효모 갈릭치즈치아바타",
		      "bakerIdx" => 18,
		      "image" => "48.jpg",
		      "price" => "4500",
		      "intro" => "높은 온도에서 구워내 겉은 바삭하고안은 촉촉한 프랑스식 정통 치아바타",
		      "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 88,
		      "name" => "크루아상",
		      "bakerIdx" => 18,
		      "image" => "52.jpg",
		      "price" => "3500",
		      "intro" => "최고급 고메버터의 풍미가 은은하게 퍼지는 바삭하고 담백한 크로와상",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 89,
		      "name" => "소고기 샌드위치",
		      "bakerIdx" => 18,
		      "image" => "90.jpg",
		      "price" => "5700",
		      "intro" => "단백질이 가득찬 소고기가 들어간 건강 가득 샌드위치",
		      "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		      "idx" => 90,
		      "name" => "치즈 식빵",
		      "bakerIdx" => 18,
		      "image" => "28.jpg",
		      "price" => "5800",
		      "intro" => "곳곳에 치즈가 박혀 치즈의 맛을 느낄 수 있는 식빵",
		      "allergy" => "밀,대두,계란"
		    ],
		    [
		        "idx" => 91,
		        "name" => "크림치즈브레드",
		        "bakerIdx" => 19,
		        "image" => "70.jpg",
		        "price" => "6100",
		        "intro" => " 크림치즈가 들어있는 부드러운 빵에 파마산 치즈가 토핑 된 빵",
		        "allergy" => "난류,우유,대두,밀"
		    ],
		    [
		        "idx" => 92,
		        "name" => "몽블랑",
		        "bakerIdx" => 19,
		        "image" => "20.jpg",
		        "price" => "6500",
		        "intro" => "500만개가 넘게 팔린 김영모 과자점 히트 상품",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 93,
		        "name" => "모닝토스트",
		        "bakerIdx" => 19,
		        "image" => "25.jpg",
		        "price" => "7200",
		        "intro" => " 부드러운 페스츄리를 먹는 듯한 간식빵으로 아몬드 토핑으로 고소한 맛을 즐기실 수 있습니다.",
		        "allergy" => "밀,우유, 대두, 쇠고기"
		    ],
		    [
		        "idx" => 94,
		        "name" => "쇼카롱 마카롱",
		        "bakerIdx" => 19,
		        "image" => "96.jpg",
		        "price" => "38000",
		        "intro" => "진한 초콜릿맛의 부드럽고 달콤한 마카롱",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 95,
		        "name" => "아몬드 마카롱",
		        "bakerIdx" => 19,
		        "image" => "94.jpg",
		        "price" => "2000",
		        "intro" => "아몬드의 맛을 함유한 부드러운 마카롱",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 96,
		        "name" => "모닝토스트",
		        "bakerIdx" => 20,
		        "image" => "25.jpg",
		        "price" => "7200",
		        "intro" => " 부드러운 페스츄리를 먹는 듯한 간식빵으로 아몬드 토핑으로 고소한 맛을 즐기실 수 있습니다.",
		        "allergy" => "밀,우유, 대두, 쇠고기"
		    ],
		    [
		        "idx" => 97,
		        "name" => "딸기 생크림 크루아상",
		        "bakerIdx" => 20,
		        "image" => "53.jpg",
		        "price" => "4000",
		        "intro" => "달콤한 딸기와 부드러운 생크림의 화합",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 98,
		        "name" => "통밀 가득 로만밀 브레드",
		        "bakerIdx" => 20,
		        "image" => "26.jpg",
		        "price" => "3800",
		        "intro" => "통밀과 우리 토종효모로 만들어 부드럽고 건강한 로만밀 브레드",
		        "allergy" => "밀, 대두, 계란"
		    ],
		    [
		        "idx" => 99,
		        "name" => "초코생크림조각케이크",
		        "bakerIdx" => 20,
		        "image" => "47.jpg",
		        "price" => "4800",
		        "intro" => "건강한 동물성 생크림에 달콤한 가나슈크림이 더해져 부드럽고 달콤한 초코생크림 조각케이크",
		        "allergy" => "밀,우유,계란,대두"
		    ],
		    [
		        "idx" => 100,
		        "name" => "초코 롤케이크",
		        "bakerIdx" => 20,
		        "image" => "29.jpg",
		        "price" => "5200",
		        "intro" => "달콤한 초코가 함유 된 부드러운 롤케이크",
		        "allergy" => "밀, 우유, 대두"
		    ],
		      [
		        "idx" => 101,
		        "name" => "딸기 크림 도넛",
		        "bakerIdx" => 21,
		        "image" => "61.jpg",
		        "price" => "3700",
		        "intro" => "상큼한 딸기 크림이 듬끈 발린 도넛",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 102,
		        "name" => "바닐라 아몬드 쿠키",
		        "bakerIdx" => 21,
		        "image" => "50.jpg",
		        "price" => "5100",
		        "intro" => "아몬드 버터의 고소함이 더해진 바닐라 쿠키",
		        "allergy" => "밀, 우유, 대두"
		    ],
		    [
		        "idx" => 103,
		        "name" => "카라멜마카롱",
		        "bakerIdx" => 21,
		        "image" => "95.jpg",
		        "price" => "38000",
		        "intro" => "달콤한 카라멜맛의 부드럽고 달콤한 마카롱",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 104,
		      "name" => "페페소세지",
		      "bakerIdx" => 21,
		      "image" => "78.jpg",
		      "price" => "4500",
		      "intro" => "육즙이 살아있는 페퍼소시지에 양파의 씹는맛이 더해진 빵선생만의 소시지빵",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 105,
		        "name" => "햄치즈 샌드위치",
		        "bakerIdx" => 21,
		        "image" => "89.jpg",
		        "price" => "6000",
		        "intro" => "부드러운 식빵사이에 특제 소스와햄,치즈가 들어간 샌드위치",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 106,
		        "name" => "블루베리 연유빵",
		        "bakerIdx" => 22,
		        "image" => "29.jpg",
		        "price" => "6500",
		        "intro" => "달콤한 연유크림과 블루베리 쨈이환상적인 조화를 이루는 빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 107,
		        "name" => "레드와인 크랜베리",
		        "bakerIdx" => 22,
		        "image" => "31.jpg",
		        "price" => "5500",
		        "intro" => "오랜기간 숙성한 레드와인을 끓여알콜성분을 제거한 후 저온숙성을 한 빵",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		      "idx" => 108,
		      "name" => "호두 파이",
		      "bakerIdx" => 22,
		      "image" => "69.jpg",
		      "price" => "9900",
		      "intro" => "달콤한 호두와 딸기가 들어가 있는 달콤한 파이",
		      "allergy" => "우유,밀,아황산류"
		    ],
		    [
		        "idx" => 109,
		        "name" => "카시스마카롱",
		        "bakerIdx" => 22,
		        "image" => "97.jpg",
		        "price" => "2500",
		        "intro" => "상큼한 카시스베리맛의 부드럽고 달콤한 마카롱",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		      "idx" => 110,
		      "name" => "소고기 샌드위치",
		      "bakerIdx" => 22,
		      "image" => "90.jpg",
		      "price" => "5700",
		      "intro" => "단백질이 가득찬 소고기가 들어간 건강 가득 샌드위치",
		      "allergy" => "밀,우유,계란,대두"
		    ], 
		    [
		        "idx" => 111,
		        "name" => "딸기퐁당 케이크",
		        "bakerIdx" => 23,
		        "image" => "84.jpg",
		        "price" => "19000",
		        "intro" => "딸기가 퐁당! 촉촉한 화이트스폰지에 상큼한 딸기콩포트가 어우러진 딸기생크림케이크",
		        "allergy" => "대두,계란,밀,우유"
		    ],
		    [
		        "idx" => 112,
		        "name" => "아삭 양배추빵",
		        "bakerIdx" => 23,
		        "image" => "42.jpg",
		        "price" => "3200",
		        "intro" => "담백한 빵 속에 아삭한 양배추와양파가 한가득 들어간 든든한 빵",
		        "allergy" => "난류, 우유, 대두, 밀"
		    ],
		    [
		        "idx" => 113,
		        "name" => "크리스피 슈크림",
		        "bakerIdx" => 23,
		        "image" => "88.jpg",
		        "price" => "3000",
		        "intro" => "달콤한 슈크림이 듬뿍들어간 부드러운 빵",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 114,
		        "name" => "초코생크림 조각케이크",
		        "bakerIdx" => 23,
		        "image" => "83.jpg",
		        "price" => "17000",
		        "intro" => " 진한 초콜릿과 생크림을 층층이 입힌 진하고 달콤한 맛의 케이크",
		        "allergy" => "대두,계란,밀,우유"
		    ],
		    [
		        "idx" => 115,
		        "name" => "뺑 오 쇼콜라",
		        "bakerIdx" => 23,
		        "image" => "89.jpg",
		        "price" => "3300",
		        "intro" => "초콜릿이 들어간프랑스 정통 페이스트리",
		        "allergy" => "밀,계란,우유,대두"
		    ],  
		    [
		        "idx" => 116,
		        "name" => "크림치즈브레드",
		        "bakerIdx" => 24,
		        "image" => "70.jpg",
		        "price" => "6100",
		        "intro" => " 크림치즈가 들어있는 부드러운 빵에 파마산 치즈가 토핑 된 빵",
		        "allergy" => "난류,우유,대두,밀"
		    ],
		    [
		        "idx" => 117,
		        "name" => "쇼카롱 마카롱",
		        "bakerIdx" => 24,
		        "image" => "96.jpg",
		        "price" => "38000",
		        "intro" => "진한 초콜릿맛의 부드럽고 달콤한 마카롱",
		        "allergy" => "밀,계란,우유"
		    ],
		    [
		        "idx" => 118,
		        "name" => "크리미쿠키슈",
		        "bakerIdx" => 24,
		        "image" => "24.jpg",
		        "price" => "3900",
		        "intro" => "부드러운 크림이 들어간달콤하고 바삭한 슈",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		        "idx" => 119,
		        "name" => "요구르트브레드",
		        "bakerIdx" => 24,
		        "image" => "22.jpg",
		        "price" => "4000",
		        "intro" => "요거트와 다양한 견과류가 듬뿍들어간 고소하고 맛있는 스콘",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 120,
		      "name" => "초코 롤케이크",
		      "bakerIdx" => 24,
		      "image" => "29.jpg",
		      "price" => "5200",
		      "intro" => "달콤한 초코가 함유 된 부드러운 롤케이크",
		      "allergy" => "밀, 우유, 대두"
		    ],
		    [
		        "idx" => 121,
		        "name" => "든든한 포테이토 바게트",
		        "bakerIdx" => 25,
		        "image" => "23.jpg",
		        "price" => "7500",
		        "intro" => "삶은 감자와 달걀로 속을 채운 든든한 조리빵",
		        "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 122,
		      "name" => "초코칩 머핀",
		      "bakerIdx" => 25,
		      "image" => "60.jpg",
		      "price" => "3300",
		      "intro" => "달콤한 초코칩이 박힌 머핀",
		      "allergy" => "밀,계란,우유,대두"
		    ],
		    [
		      "idx" => 123,
		      "name" => "호두 연유 바게트",
		      "bakerIdx" => 25,
		      "image" => "3.jpg",
		      "price" => "8300",
		      "intro" => "고소한 호두 바게트에 달콤한 연유버터크림이 샌드 된 바게트",
		      "allergy" => "우유,대두,밀,호두"
		  ],
	    [
	        "idx" => 124,
	        "name" => "로건브레드",
	        "bakerIdx" => 25,
	        "image" => "25.jpg",
	        "price" => "5000",
	        "intro" => "호밀, 호두를 넣은 반죽을 저온숙성 발효법으로 만든 건강빵",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 125,
	        "name" => "로건브레드",
	        "bakerIdx" => 25,
	        "image" => "25.jpg",
	        "price" => "5000",
	        "intro" => "호밀, 호두를 넣은 반죽을 저온숙성 발효법으로 만든 건강빵",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 126,
	        "name" => "몽블랑",
	        "bakerIdx" => 26,
	        "image" => "20.jpg",
	        "price" => "6500",
	        "intro" => "500만개가 넘게 팔린 김영모 과자점 히트 상품",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 127,
	        "name" => "호두 연유 바게트",
	        "bakerIdx" => 26,
	        "image" => "3.jpg",
	        "price" => "8300",
	        "intro" => "고소한 호두 바게트에 달콤한 연유버터크림이 샌드 된 바게트",
	        "allergy" => "우유,대두,밀,호두"
	    ],
	    [
	        "idx" => 128,
	        "name" => "치즈바게뜨",
	        "bakerIdx" => 26,
	        "image" => "75.jpg",
	        "price" => "9200",
	        "intro" => "치즈를 가득 담은 부드러운 바게트",
	        "allergy" => "밀, 우유, 대두"
	    ],
	    [
	        "idx" => 129,
	        "name" => "치즈퐁듀",
	        "bakerIdx" => 26,
	        "image" => "43.jpg",
	        "price" => "2000",
	        "intro" => "진한 치즈의 풍미를 느낄 수 있는부드럽고 고소한 치즈퐁듀",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	      [
	        "idx" => 130,
	        "name" => "아몬드 마카롱",
	        "bakerIdx" => 27,
	        "image" => "94.jpg",
	        "price" => "2000",
	        "intro" => "아몬드의 맛을 함유한 부드러운 마카롱",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	    [
	        "idx" => 131,
	        "name" => "트러플 치아바타",
	        "bakerIdx" => 27,
	        "image" => "39.jpg",
	        "price" => "4300",
	        "intro" => "향긋한 트러플냄새가 은은하게퍼지는 고소하고 담백한 치아바타",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 132,
	        "name" => "프랑스 대통령 바게트",
	        "bakerIdx" => 27,
	        "image" => "92.jpg",
	        "price" => "4800",
	        "intro" => "프랑스 바게트 대회에서 1등을 거머쥐며엘리제궁 귀빈과 대통령에게 사랑받은 바게트",
	        "allergy" => "밀,계란,우유,대두"
	    ],
	    [
	      "idx" => 133,
	      "name" => "치즈 식빵",
	      "bakerIdx" => 27,
	      "image" => "28.jpg",
	      "price" => "5800",
	      "intro" => "곳곳에 치즈가 박혀 치즈의 맛을 느낄 수 있는 식빵",
	      "allergy" => "밀,대두,계란"
	    ],
	    [
	        "idx" => 134,
	        "name" => "햄치즈 치아바타",
	        "bakerIdx" => 27,
	        "image" => "48.jpg",
	        "price" => "4300",
	        "intro" => "햄과 고소한 치즈가 든담백한 치아바타 ",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	    [
	        "idx" => 135,
	        "name" => "연유 식빵",
	        "bakerIdx" => 27,
	        "image" => "1.jpg",
	        "price" => "4800",
	        "intro" => "연유의 부드러움을 느낄 수 있는 식빵",
	        "allergy" => "밀,계란,우유,대두"
	    ],
	    [
	        "idx" => 136,
	        "name" => "깜빠뉴트레디션",
	        "bakerIdx" => 28,
	        "image" => "22.jpg",
	        "price" => "10000",
	        "intro" => "겉은 바삭하고 속은 촉촉한고소한 맛의 정통 깜빠뉴",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 137,
	        "name" => "딸기 크림 도넛",
	        "bakerIdx" => 28,
	        "image" => "61.jpg",
	        "price" => "3700",
	        "intro" => "상큼한 딸기 크림이 듬끈 발린 도넛",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 138,
	        "name" => "초코생크림조각케이크",
	        "bakerIdx" => 28,
	        "image" => "47.jpg",
	        "price" => "4800",
	        "intro" => "건강한 동물성 생크림에 달콤한 가나슈크림이 더해져 부드럽고 달콤한 초코생크림 조각케이크",
	        "allergy" => "밀,우유,계란,대두"
	    ],
	    [
	        "idx" => 139,
	        "name" => "누룩발효빵",
	        "bakerIdx" => 28,
	        "image" => "12.jpg",
	        "price" => "2800",
	        "intro" => "우리나라 천연효모 누룩으로 발효해고소한 팥앙금을 채운 빵",
	        "allergy" => "밀,계란,우유,대두"
	    ],
	    [
	        "idx" => 140,
	        "name" => "딸기마카롱도넛",
	        "bakerIdx" => 28,
	        "image" => "63.jpg",
	        "price" => "4200",
	        "intro" => "화이트초코에 딸기마카롱 후레이크를 듬뿍 얹은 달콤한 도넛",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	    [
	        "idx" => 141,
	        "name" => "햄치즈 샌드위치",
	        "bakerIdx" => 29,
	        "image" => "89.jpg",
	        "price" => "6000",
	        "intro" => "부드러운 식빵사이에 특제 소스와햄,치즈가 들어간 샌드위치",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	    [
	        "idx" => 142,
	        "name" => "딸기 크림빵",
	        "bakerIdx" => 29,
	        "image" => "62.jpg",
	        "price" => "5500",
	        "intro" => "딸기의 상큼함과 크림의 부드러움이 가득찬 빵",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 143,
	        "name" => "프랑스바게트",
	        "bakerIdx" => 29,
	        "image" => "93.jpg",
	        "price" => "3700",
	        "intro" => "자연 발효종으로 24시간 숙성시켜 만든프랑스 정통 방식의 고소한 바게트",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ],
	    [
	        "idx" => 144,
	        "name" => "카시스마카롱",
	        "bakerIdx" => 29,
	        "image" => "97.jpg",
	        "price" => "2500",
	        "intro" => "상큼한 카시스베리맛의 부드럽고 달콤한 마카롱",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 145,
	        "name" => "뺑 오 쇼콜라",
	        "bakerIdx" => 29,
	        "image" => "89.jpg",
	        "price" => "3300",
	        "intro" => "초콜릿이 들어간프랑스 정통 페이스트리",
	        "allergy" => "밀,계란,우유,대두"
	    ],
	    [
	        "idx" => 146,
	        "name" => "딸기생크림 컵 케이크",
	        "bakerIdx" => 30,
	        "image" => "82.jpg",
	        "price" => "19500",
	        "intro" => "육즙이 살아있는 페퍼소시지에 양파의 씹는맛이 더해진 빵선생만의 소시지빵",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 147,
	        "name" => "딸기퐁당 케이크",
	        "bakerIdx" => 30,
	        "image" => "84.jpg",
	        "price" => "19000",
	        "intro" => "딸기가 퐁당! 촉촉한 화이트스폰지에 상큼한 딸기콩포트가 어우러진 딸기생크림케이크",
	        "allergy" => "대두,계란,밀,우유"
	    ],
	    [
	      "idx" => 148,
	      "name" => "초코 케이크",
	      "bakerIdx" => 30,
	      "image" => "45.jpg",
	      "price" => "26500",
	      "intro" => "초콜릿이 들어간 정통 케이크",
	      "allergy" => "밀,계란,우유,대두"
	    ],
	    [
	        "idx" => 149,
	        "name" => "롤크랜베리 샌드위치",
	        "bakerIdx" => 30,
	        "image" => "7.jpg",
	        "price" => "7500",
	        "intro" => "부드러운 페스트리에 특제소스와각종 견과류와 크랜베리를 넣은 샌드위치",
	        "allergy" => "밀,계란,우유"
	    ],
	    [
	        "idx" => 150,
	        "name" => "치즈 바게트",
	        "bakerIdx" => 30,
	        "image" => "91.jpg",
	        "price" => "8100",
	        "intro" => "치즈가 다량 첨가된 부드러운 바게트",
	        "allergy" => "난류, 우유, 대두, 밀"
	    ]]
		];

		$data = @$json[$methodArray['type']];

		if (!$data || !$methodArray['type']) {
			http_response_code(400);
			header("Content-type: application/json");
			echo json_encode([
				"httpCode" => 400,
				"msg" => "필수 요청 값이 잘못되었거나 찾을 수 없습니다."
			]);
      exit;
    }

    shuffle($data);

		if ($methodArray['type'] === 'menuList') {
			$ran = 0;

			if ($_SESSION['timer'] == 5) {
				$_SESSION['timer'] = 0;
				$ran = 120;
			} else {
				$ran = rand(20, 25);
				$_SESSION['timer']++;
			} 
			time_sleep_until(time() + $ran);

			header("Content-type: application/json");
			echo json_encode($data);
			exit;
		}

		if (!$methodArray['area'] || !is_array($methodArray['area']) || !count($methodArray['area'])) {
			http_response_code(400);
			header("Content-type: application/json");
			echo json_encode([
				"httpCode" => 400,
				"msg" => "필수 요청 형식이 잘못되거나 값을 찾을 수 없습니다."
			]);
			exit;
		}

		$data = array_filter($data, function($v) use ($methodArray) {
			return in_array(explode(" ", $v['location'])[1], $methodArray['area']);
		});

    shuffle($data);

    $ran = 0;

    if ($_SESSION['timer'] == 5) {
      $_SESSION['timer'] = 0;
      $ran = 120;
    } else {
      $ran = rand(20, 25);
      $_SESSION['timer']++;
    } 
    time_sleep_until(time() + 3);

    header("Content-type: application/json");
    echo json_encode($data);
	} catch (Exception $e) {
		echo "401 error";
		return;	
	}
 ?>