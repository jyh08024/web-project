<?php foreach ($userData as $key => $v): ?>
	
<div class="provide_item">
<div class="pro_top">
  <div class="pro_info">
    <img src="<?= $v['img'] ?>" alt="user" title="user">
    <div class="text_info">
      <h2><?= $v['name'] ?></h2>
      <p>follower: <span class="color"><?= $v['follows'] ? $v['follows'] : 0 ?></span>명</p>
    </div>
  </div>

  <div class="detail_btn">
    <label for="view_list" class="wait_btn"><i class="fa fa-film"></i>&nbsp; 영상보기</label>
    <a href="/provider/<?= $v['idx'] ?>"><button class="btn"><i class="fa fa-link"></i> 배급사 이동</button></a>
  </div>
</div>
<!-- <input type="radio" name="view_list" id="view_list" class="view_list2"> -->

<!-- <div class="pro_mini_title">
  <h3>주식회사 도호 | 영화목록</h3>
</div>

<div class="movie_list">
  <h2>영화가 아직 없습니다.</h2>
</div> -->

</div>

<div class="after_line"></div>

<?php endforeach ?>
