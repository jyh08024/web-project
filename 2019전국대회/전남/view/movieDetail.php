<div class="section"></div>

<div class="section wrap">
  <div class="section_title">
    <h2>BIFF<span class="color">MOVIEINFO</span><span style="font-size: 1rem;">상세보기</span></h2>
    <p>한국 영화계의 축제, 영화정보</p>
  </div>

  <div class="section_content">
    <div class="movie_info_top flex alc js">
      <div class="movie_img">
        <img src="/resources/data/poster/<?= $movie['posterImage'] ?>" alt="">
      </div>

      <div class="movie_info">
        <h1><?= $movie['title'] ?></h1>
        <h3><span class="color">[감독]</span> <?= $movie['director'] ?></h3>
        <h3><span class="color">[제작국가]</span> <?= $movie['country'] ?></h3>
        <h3><span class="color">[섹션]</span> <?= $movie['section'] ?></h3>
        <h3><span class="color">[러닝타임]</span> <?= $movie['runningTime'] ?>분</h3>

        <div class="theater_info">
          <div class="after_line"></div>

          <div class="theater_list">
            <?php foreach ($info as $key => $v): ?>
              <h3><span class="color">[상영정보]</span> <?= $v['name']  ?> - 10월 <?= $v['day'] ?>일 <?= $v['time'] ?></h3>
            <?php endforeach ?>
          </div>
        </div>
      </div>
    </div>

    <?php if (USER): ?>
      <div class="after_line"></div>

      <form action="/commentWrite" method="POST">
        <textarea name="comment" class="input" cols="30" rows="10"></textarea>
        <input type="hidden" name="movieCode" value="<?= $movie['code'] ?>">
        <button class="btn">댓글작성</button>
      </form>
    <?php endif ?>

    <div class="after_line"></div>

    <div class="comment_list">
      <?php foreach ($comment as $key => $v): ?>
        <div class="comment_item">
          <div class="writer_info flex alc">
            <div class="user_img">
              <i class="fa fa-user"></i>
            </div>

            <h2><?= $v['user_name'] ?></h2>
            <h3 style="margin-left: .5rem;"><?= $v['timestamp'] ?></h3>
            <?php if (@USER['idx'] == $v['user'] || @USER['user_id'] == "admin"): ?>
              <a href="/delete/comment/<?= $v['com_idx'] ?>" class="btn">삭제</a>
            <?php endif ?>
          </div>

          <div class="comment_cont">
            <h3><?= $v['comment'] ?></h3>
          </div>

          <div class="after_line"></div>
        </div>
      <?php endforeach ?>
    </div>
  </div>
</div>

<style>
	.movie_img {
		width: 45%;
		height: 25rem;
		overflow: hidden; 
	}

	.movie_img img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.movie_info {
		width: 50%;
		height: 100%;
	}

	.movie_info h1 {
		margin-bottom: .5rem;
	}

	.movie_info h3 {
		margin-bottom: .3rem;
	}

	.comment_item .user_img {
		width: 60px;
		height: 60px;
		border-radius: 50%;
		overflow: hidden; 
		display: flex;
		align-items: center;
		justify-content: center;
		background: #ff2d31;
		color: #fff;
		margin-bottom: 1rem;
	}

	.user_img i {
		font-size: 4rem;
	}
</style>