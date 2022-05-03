<?php foreach ($videoData as $key => $v): ?>

<div class="main_movie_item">
  <a href="/video/<?= $v['idx'] ?>"><div class="item_img">
    <img src="<?= $v['thumbnail'] ?>" alt="thumb" title="thumb">
  </div></a>
  <div class="item_content">
    <a href="/video/<?= $v['idx'] ?>"></a><h3><?= $v['title'] ?></h3>
    <p class="explain">
      <?= $v['description'] ?>
    </p>
    <p class="maker">
      조회수:<?= number_format($v['view']) ?>회 | 영상길이: <?= floor($v['duration']) ?> | 등록된 시간: <?= $v['date'] ?>
    </p>
  </div>
</div>

<?php endforeach ?>