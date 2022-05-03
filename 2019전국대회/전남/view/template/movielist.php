<?php foreach ($movie as $key => $v): ?>
	<div data-max="<?= $v['seat'] ?>" data-schedule="<?= $v['code'] ?>" class="movie_item flex alc js">
		<div class="movie_img">
			<img src="../resources/data/poster/<?= $v['posterImage'] ?>" alt=" movie" title="movie">
		</div>

		<div class="movie_info">
			<h2><span class="color">[영화명]</span><?= $v['title'] ?></h2>
			<h4><span class="color">[예매코드]</span><?= $v['code'] ?></h4>
			<h4><span class="color">[상영관]</span><?= $v['theaterName'] ?></h4>
			<h4><span class="color">[상영일]</span>10월 <?= $v['day'] ?>일</h4>
			<h4><span class="color">[상영시간]</span><?= $v['time'] ?></h4>
			<h4><span class="color">[남은좌석]</span><?= $v['seat'] ?></h4>
		</div>
	</div>
<?php endforeach ?>