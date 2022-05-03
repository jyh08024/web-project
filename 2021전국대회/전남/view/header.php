<!DOCTYPE html>
<html lang="zxx">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>대전 브레드 투어</title>
	<link rel="stylesheet" href="/resources/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/resources/css/style.css">
	<script src="/resources/js/jquery-3.6.0.min.js"></script>
	<script src="/resources/js/app.js"></script>
</head>
<body>
	
	<input type="checkbox" name="ham_bur" id="ham_view" hidden>

	<div class="ham_menu ham_none">
		<div class="ham_inner">
			<div class="ham_logo logo">
				<a href="index.html">
					<img src="logo.png" alt="logo" title="logo">
				</a>
			</div>

			<ul class="ham_in_menu">
				<li><a href="#">대전 빵집</a></li>
				<li><a href="#">스탬프</a></li>
				<li><a href="#">할인 이벤트</a></li>
				<li><a href="#">마이페이지</a></li>
			</ul>

			<div class="user_btn">
				<div class="show_more">
					<p>로그인</p>
					<i class="fa fa-angle-right"></i>
				</div>
				<div class="show_more">
					<p>회원가입</p>
					<i class="fa fa-angle-right"></i>
				</div>
			</div>
		</div>
	</div>

	<label for="ham_view" class="other_view">

	</label>

	<div class="ham_btn ham_none">
		<label for="ham_view">
			<div></div>
			<div></div>
			<div></div>
		</label>
	</div>

	<header>
		<div class="wrap flex alc js">
			<div class="logo">
				<a href="/">
					<img src="/logo3.png" alt="logo" title="logo">
				</a>
			</div>

			<div class="header_right flex alc">
				<div class="navigation">
					<ul class="menu flex alc">
						<li><a href="/daejeon//">대전 빵집</a></li>
						<li><a href="/stamp">스탬프</a></li>
						<li><a href="/sale/">할인 이벤트</a></li>
						<li><a href="/mypage">마이페이지</a></li>
					</ul>
				</div>
				
				<div class="user_btn flex alc">
					<?php if (USER): ?>
						<div class="flex alc">
							<p style="font-size: 1.1rem">&lt;<?= USER['name'] ?>&gt;(&lt;<?= USER['type'] ?>&gt;)</p>
							<a href="/logout" class="show_more"><p class="link">로그아웃</p> <i class="fa fa-angle-right"></i></a>
						</div>
						<?php else: ?>
					<a href="/login" class="show_more"><p class="link">로그인</p> <i class="fa fa-angle-right"></i></a>
					<button class="show_more"><p class="link">회원가입</p> <i class="fa fa-angle-right"></i></button>
					<?php endif ?>
				</div>
			</div>
		</div>
	</header>

	<div class="fixed_btn show_more fix_left">
		<p>빵지순례</p>
		<i class="fa fa-angle-right"></i>
	</div>

	<div class="fixed_btn show_more fix_right">
		<p>대전 빵집 방문</p>
		<i class="fa fa-angle-right"></i>
	</div>

	<div class="fixed_btn fix_sns sns_icons">
		<div><i class="fa fa-instagram"></i></div>
		<div><i class="fa fa-facebook-square"></i></div>
	</div>

	<?php 
		$_SESSION['label'] = [
			"normal"=> [
				"order"=> ["빵집 이름", "주문 일시", "빵 종류 및 가격, 수량", "라이더 이름", "도착 예정 시간", "리뷰", "평점", "주문 상태"],
				"res"=> ["빵집 이름", "예약 일시", "예약 신청 일시", "상태"]
			],
			"owner"=> [
				"order"=> ["주문자 이름", "배달 주소", "빵 종류 및 가격, 수량", "주문 상태"],
				"res"=> ["예약자 이름", "예약 일시", "예약 신청 일시", "상태"], 
				"menu"=> ["이미지", "이름", "가격", "할인율", "할인가", "총 팔린 개수", "할인 버튼"]
			],
			"rider"=> [
				"order"=> ["빵집 이름", "빵집 주소", "배달 주소", "빵 종류 및 가격, 수량", "상태"]
			],
      "sale"=> ["빵 이름", "사진", "원가", "할인율", "할인가", "빵집 이름"],
      "order"=> ["이름", "사진", "가격", "할인율" ,"할인가", "개수"],
		];
	 ?>

	 <style>
	 	.order_table {
		  width: 100%;
		  height: 100%; 
		}

		th {
			padding-bottom: 1rem;
			border-bottom: 2px solid #000;
		}

		table {
			border-collapse: collapse;
		}

		.order_table .show_more {
			width: 100px;
		}

		tbody tr {
			border-bottom: 1px solid rgba(0, 0, 0, .1);
		}

		td {
			text-align: center;
			padding-top: 1rem;
			padding-bottom: 1rem;
		}

		.order_div {
			margin-bottom: 4rem;
		}

		.menu_img {
			width: 10rem;
			height: 10rem;
		}

		.reple_user {
			width: 40px;
			height: 40px;
			overflow: hidden;
			border-radius: 999999px;
			border: 1px solid rgba(0, 0, 0, .1);
			margin-right: 1rem;
		}

		.reple_user i {
			font-size: 3rem;
		}

		.reple_line {
			padding-bottom: 1rem;
			border-bottom: 1px solid rgba(0, 0, 0, .1);
		}

		.page_btn {
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.page_btn > a {
			width: 40px;
			height: 40px;
			border-radius: 999999999px;
			background: #f4f5fc;
			border: 1px solid rgba(0, 0, 0, .1);
		}

		.page_btn > .now_page {
			background: #ffa500 !important;
		}
	 </style>

	 <script>
	 	function load(loc) {
	 		$.post(`/html/${loc}`).done((res) => {
	 			if ($(res).html().trim() != $(`.load_div`).html().trim()) {
	 				$(`.load_div`).html('');
	 				$(`.load_div`).html($(res).html());
	 			}
	 		})
	 	}

	 	function mdSet(modal, id, val = "") {
	 		$(`.id_input`).val(id);

	 		if (val) {
		 		$(`.val_input`).val(val);
	 		}

	 		Modal.open(modal);
	 	}

	 	function ajax(loc, form) {
	 		const formData = new FormData(form);

	 		$.ajax({
	 			url: loc,
	 			contentType: false,
	 			processData: false,
	 			data: formData,
	 			type: "POST",
	 		}).done((res) => {

	 			if (res.type == "err") {
	 				return alert(res.msg);
	 			}

	 			alert(res.msg);

	 			switch (res.type) {
	 				case "sale": 
	 					Modal.close();
		 				break;

		 			case "review":
		 				Modal.close();
		 				break;

		 			case "score": 
		 				Modal.close();
		 				break;
	 			}
	 		});
	 	}

    function orderPost(store) {
      const arr = [];

      $(`.menu_count`).each((id, el) => {
        if (el.value <= 0) {
          return;
        }

        arr.push({"bread": $(el).data('bread'), "price": $(el)[0].dataset.price, "cnt": el.value});
      });

      if (!arr.length) {
        return alert('하나 이상의 상품을 골라주세요');
      }

      $.post(`/post/order/${store}`, { arr }).done((res) => {
        alert(res.msg);
        $(`.menu_count`).val('');
      });
    }

	 	$(document)
	 		.on(`submit`, ".sale_form", function(e) {
	 			e.preventDefault();
	 			ajax("/post/sale", e.target);
	 		})
	 		.on(`submit`, ".rev_form", function(e) {
	 			e.preventDefault();
	 			ajax("/post/review", e.target);
	 		})
	 		.on(`submit`, ".score_form", function(e) {
	 			e.preventDefault();
	 			ajax("/post/score", e.target);
	 		})
      .on(`input`, ".menu_count", function(e) {
        $(e.target).val(e.target.value.replace(/[^0-9]/g, ""));
      })
      .on(`blur`, ".menu_count", function(e) {
        if (e.target.value <= 0 || e.target.value.match(/[^0-9]/)) {
          e.target.value = "";
        }
      })
	 </script>