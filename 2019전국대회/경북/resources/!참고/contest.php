
	<!-- 메인 비주얼 영역 -->
	<div class="visual sub-visual">
		<!-- 비주얼 슬라이드 -->
		<div class="visual__item vi_1">
			<div class="rap">
				<div class="vb__left">
					<h1>이벤트</h1>
				</div>
				<div class="vb__right">
					<img src="/public/images/visual.png" alt="img" title="img">
				</div>
			</div>
		</div>

		<div class="visual__item vi_2">
			<div class="rap"> 
				<div class="vb__left">
					<h1>이벤트</h1>
				</div>
				<div class="vb__right">
					<img src="/public/images/visual.png" alt="img" title="img">
				</div>
			</div>
		</div>

		<div class="visual__item vi_3">
			<div class="rap">
				<div class="vb__left">
					<h1>이벤트</h1>
				</div>
				<div class="vb__right">
					<img src="/public/images/visual.png" alt="img" title="img">
				</div>
			</div>
		</div>
	</div>
	
	<div class="contest-edit rap">
		<div class="content-title flex ac">
			<div class="content-title__left flex ac">
				<h2>BIFF <strong>OUTLINE</strong></h2>
				<h1><strong>콘테스트</strong> 참여하기</h1>
				<img src="/public/images/pet-1.png" alt="img" title="img">
			</div>
			<div class="content-title__right">
				<h3>CONTEST</h3>
				<p><mark>콘테스트</mark> 참여!</p>
			</div>
		</div>

		<div class="editer rap" style="overflow: hidden;">
	
			<div class="editer__top">
				<div class="flex ac" style="margin-bottom: 30px;">
					<h1>영화홍보영상  목록</h1>
					<p style="border-left: 1px solid #dd1e33; padding-left: 20px; margin-left: 20px;">영화 홍보영상을 선택해주세요.</p>
				</div>
				<div class="video-list">
					<div><img src="/public/movie/movie1-cover.jpg" alt="img" title="img" class="video__item"></div>
					<div><img src="/public/movie/movie2-cover.jpg" alt="img" title="img" class="video__item"></div>
					<div><img src="/public/movie/movie3-cover.jpg" alt="img" title="img" class="video__item"></div>
					<div><img src="/public/movie/movie4-cover.jpg" alt="img" title="img" class="video__item"></div>
					<div><img src="/public/movie/movie5-cover.jpg" alt="img" title="img" class="video__item"></div>
				</div>

				<div class="option">
					<div class="option-box flex ac">
						<h4 class="option-title">색상</h4>
						<div class="option-list color-list flex ac">
							<div data-val='gray' data-type='color' style="background: gray" class="active">gray</div>
							<div data-val='blue' data-type='color' style="background: blue">blue</div>
							<div data-val='green' data-type='color' style="background: green">green</div>
							<div data-val='yellow' data-type='color' style="background: yellow">yellow</div>
							<div data-val='red' data-type='color' style="background: red">red</div>
						</div>
					</div>

					<div class="option-box flex ac">
						<h4 class="option-title">폰크 크기</h4>
						<div class="option-list option-items flex ac">
							<div data-val='16' data-type='font' class="active" data-color='gray'>16px</div>
							<div data-val='18' data-type='font'>18px</div>
							<div data-val='24' data-type='font'>24px</div>
							<div data-val='32' data-type='font'>32px</div>
						</div>
					</div>

					<div class="option-box flex ac">
						<h4 class="option-title">선 굵기</h4>
						<div class="option-list option-items flex ac">
							<div data-val='1' data-type='line' class="active" data-color='gray'>1px</div>
							<div data-val='3' data-type='line'>3px</div>
							<div data-val='5' data-type='line'>5px</div>
							<div data-val='10' data-type='line'>10px</div>
						</div>
					</div>
				</div>

				<div class="video__tool">
					<div class="btn tool" data-type='Pen'><i class="fa fa-pen"></i> 자유곡선</div>
					<div class="btn tool" data-type='Square'><i class="fa fa-square"></i> 사각형</div>
					<div class="btn tool" data-type='Text'><i class="fa fa-keyboard"> 텍스트</i></div>
					<div class="btn tool" data-type='Select'><i class="fa fa-mouse-pointer"></i> 선택</div>
					<div class="btn" data-type='remove'><i class="fa fa-trash"></i> 선택삭제</div>
					<div class="btn" data-type='removeAll'><i class="fa fa-trash"></i> 초기화</div>
					<div class="btn" data-type='play'><i class="fa fa-play"></i> 재생</div>
					<div class="btn" data-type='pause'><i class="fa fa-pause"></i> 정지</div>
					<div style="display: flex; flex-direction: column; align-items: center; position: fixed; z-index: 999999; bottom: 50px; right: 50px;">
						<div style="margin-bottom: 10px;" class="btn" data-type='edit'><i class="fa fa-cloud"></i> 콘테스트 참여하기</div>
						<div class="btn" data-type='download'><i class="fa fa-cloud"></i> 다운로드</div>
						<div style="margin-top: 10px;" class="btn" data-type='merge'><i class="fa fa-box"></i> 병합하기</div>
					</div>
				</div>
			</div>
			
			<div class="view">
				<video></video>
				<svg></svg>
			</div>

			<div class="video__times flex sb" style="margin-top: 20px;">
				<div class="flex ac">
					재생시간
					<div class="video__now" style="margin-left: 10px;">00:00:00:00</div>
				</div>
				<div class="flex ac">
					총 재생 시간
					<div class="video__end" style="margin-left: 10px;">00:00:00:00</div>
				</div>
			</div>

			<div class="handle hide">
				<div class="arc"></div>
				<div class="line"></div>
			</div>

			<style>
				.handle {
					width: 1120px;
					position: relative;
					height: 30px;
					margin: 0 auto;
					margin-bottom: -40px;
				}

				.arc {
					width: 20px;
					height: 20px;
					background: #dd1e33;
					border-radius: 50%;
					top: 0 !important;
				}

				.line {
					width: 1px;
					height: 10000px;
					background: red;
					position: absolute;
					left: 0;
					top: 0;
					transform: translateX(10px);
					z-index: 99999;
					pointer-events: none;
				}

				.handle {}
			</style>

			<div class="time-area" style="margin-top: 30px;">
				<div class="time-line">
					<!-- <div class="clip-box">
						<div class="clip"></div>
						<div class="clip-time">
							<div class="flex ac">
								클립 시작 시간
								<div class="clip__start" style="margin-left: 10px;">00:00:00:00</div>
							</div>
							<div class="flex ac">
								클립 재생 시간
								<div class="clip__end" style="margin-left: 10px;">00:00:00:00</div>
							</div>
						</div>
					</div> -->
				</div>
				<div class="video-time hide">
					<div class="clip-box">
						<div class="clip"></div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<style>

		.hide {
			display: none;
		}

		.clip-box {
			background: #dd1e3330;
			height: 40px;
			padding-top: 5px;
			position: relative;
			width: 1100px;
			margin: 0 auto;
		}

		.clip-time {
			position: absolute;
			left: 0;
			top: 0;
			height: 100%;
			line-height: 40px;
			display: flex;
			width: 100%;
			justify-content: space-between;
			display: none;
			padding: 0 10px;
			pointer-events: none;
		}

		.clip.active ~ .clip-time {
			display: flex;
		}

		.clip {
			background: #222;
			height: 30px;
			top: 0 !important;
		}

		.clip.active {
			background: #dd1e33;
		}

		video {
			width: 100%;
		}

		.active[data-color='gray'] {
			background: gray;
			color: white;
		}
		.active[data-color='blue'] {
			background: blue;
			color: white;
		}
		.active[data-color='green'] {
			background: green;
			color: white;
		}
		.active[data-color='yellow'] {
			background: yellow;
		}
		.active[data-color='red'] {
			background: red;
			color: white;
		}

		.option-items > div {
			padding: 10px 20px;
			border-radius: 100px;
			box-shadow: 0 0 10px rgba(0,0,0,.2);
		}

		.option-title {
			/* width: 120px; */
			display: block;
			margin-right: 20px;
		}

		.me {
			position: absolute;
			top: 50%;
			transform: translateY(-50%);
			left: -30px;
		}

		.view {
			width: 100%;
			min-height: 650px;
			background: #000;
			position: relative;
		}

		.tool {
			filter: grayscale(1);
		}

		.tool.active {
			filter: grayscale(0);	
		}

		.option {
			padding: 20px;
			display: flex;
			align-items: center;
			border-bottom: 1px solid rgba(0,0,0,.1);
		}

		.option-box {
			/* margin-right: 30px; */
		}

		.option-box:not(:last-child) {
			border-right: 3px solid #dd1e33;
			padding-right: 20px;
			margin-right: 20px;
		}
	
		.color-list > div {
			width: 70px;
			height: 40px;
			border-radius: 100px;
			color: white;
			display: flex;
			justify-content: center;
			align-items: center;
			padding-bottom: 2px;
		}

		.option-list > div {
			margin-right: 5px;
			cursor: pointer;
		}

		.color-list > div[data-val='yellow'] {
			color: #000;
		}
		
		.video__tool {
			padding: 20px 0;
		}
		.video-list {
			border-bottom: 20px;
			padding-bottom: 20px;
			border-bottom: 1px solid rgba(0,0,0,.1);
			display: flex;
		}

		.video__item {
			width: 200px;
			height: 300px;
			object-fit: cover;
			border-radius: 14px;
			cursor: pointer;
			transition: .2s;
			box-shadow: 0 20px 40px rgba(0,0,0,.3);
			margin-right: 20px;
		}

		.video-list > div:hover .video__item {
			transform: translateY(-20px)
		}

		.view::after {
			content: 'SCREEN';
			color: white;
			font-family: 'impact';
			font-size: 10rem;
			position: absolute;
			left: 50%;
			top: 50%;
			transform: translate(-50%, -50%);
			opacity: .05;
			z-index: -10;
		}

		svg {
			position: absolute;
			width: 100%;
			height: 100%;
			left: 0;
			top: 0;
			border: none !important;
		}

		.editer__top .active {
			box-shadow: 0 20px 40px rgba(0,0,0,.5);
			transform: translateY(-10px);
			transition: .3s;
		}

		.rap {
			max-width: 1400px;
		}

		img.active {
			outline: 10px solid #dd1e33;
			border-radius: 0px;
		}
	</style>

	<!-- 푸터 영역 -->
	<footer>
		<div class="rap flex sb ac">
			<div class="footer__left">
				<div>
					<img src="/public/images/f-logo.png" alt="img" title="img" class="footer__logo">
				</div>
				<p>부산사무국(48058) 부산시 해운대구 수영강변대로 120 영화의전당 비프힐 3층 지도전화 1688-3010팩스 051-709-2299</p>
				<p>서울사무소(03131) 서울특별시 종로구 율곡로 84 가든타워 1601호 지도전화 02-3675-5097팩스 02-3675-5098</p>
				<p class="copyright">ⓒ Busan International Film Festival</p>
			</div>

			<div class="footer__sns">
				<a href="#"><img src="/public/images/footer/1.png" alt="img" title="igm"></a>
				<a href="#"><img src="/public/images/footer/2.png" alt="img" title="igm"></a>
				<a href="#"><img src="/public/images/footer/3.png" alt="img" title="igm"></a>
				<a href="#"><img src="/public/images/footer/4.png" alt="img" title="igm"></a>
				<a href="#"><img src="/public/images/footer/5.png" alt="img" title="igm"></a>
			</div>
		</div>
	</footer>
</body>
</html>

<style>
	.vb__left {
		width: auto;
		padding-right: 100px;
	}

	.sub-visual .vb__left h1::before {
		right: -120px;
		z-index: 9999;
	}
</style>
<script>App.init()</script>