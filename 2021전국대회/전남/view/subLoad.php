<div class="load_div">
    
  <div class="section rap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>빵집베스트5 영역</h4>
      </div>
      <p>대전 최고의 빵집 베스트5를 선정했습니다.</p>
    </div>

    <div class="after_line"></div>

    <div class="dajeon_bread_list">

<?php if (!count($rank)): ?>
    <h2>검색 결과가 없습니다.</h2>
    <?php else: ?>
    <?php foreach ($rank as $key => $v): ?>

        <a href="/order/<?= $v['store_index'] ?>//">
      <div class="dajeon_bread_item no_type1">
        <div class="dajeon_img">
          <img src="<?= $v['image'] ?>" alt="best" title="best">
        </div>

        <div class="dajeon_text">
          <h3><span class="color">[빵집 이름 / 순위]</span> <?= $v['store_name'] ?> (<?= $key + 1 ?>등)</h3>
          <h3><span class="color">[전화번호]</span> <?= $v['connect'] ?></h3>
          <h3><span class="color">[평점]</span> <?= round($v['score']) ?>점</h3>
          <h3><span class="color">[리뷰]</span> <?= $v['rev_cnt'] ?>개</h3>
          <h3><span class="color">[지역]</span> <?= $v['borough'] ?> <?= $v['loc_name'] ?></h3>
        </div>
      </div>
        </a>

    <?php endforeach ?>      
<?php endif ?>

    </div>
  </div>

  <div class="section rap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>빵집리스트 영역</h4>
      </div>
      <p>대전의 여러 빵집들의 정보입니다.</p>
    </div>

    <div class="after_line"></div>

    <div class="dajeon_bread_list">
    <?php if (!count($normal)): ?>
    <h2>검색 결과가 없습니다.</h2>
      
      <?php else: ?>
      <?php foreach ($normal as $key => $v): ?>
      
        <a href="/order/<?= $v['store_index'] ?>//">
      <div class="dajeon_bread_item no_type1">
        <div class="dajeon_img">
          <img src="<?= $v['image'] ?>" alt="best" title="best">
        </div>

        <div class="dajeon_text">
          <h3><span class="color">[빵집 이름 / 순위]</span> <?= $v['store_name'] ?></h3>
          <h3><span class="color">[전화번호]</span> <?= $v['connect'] ?></h3>
          <h3><span class="color">[평점]</span> <?= round($v['score']) ?>점</h3>
          <h3><span class="color">[리뷰]</span> <?= $v['rev_cnt'] ?>개</h3>
          <h3><span class="color">[지역]</span> <?= $v['borough'] ?> <?= $v['loc_name'] ?></h3>
        </div>
      </div>
        </a>

    <?php endforeach ?>   
    <?php endif ?>

    </div>
  </div>

  </div>