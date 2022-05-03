<?php foreach ($comment as $key => $v): ?>
<div class="comment_item">

  <div class="writer">
    <div class="writer_img">
      <img src="<?= $v['user_img'] ?>" alt="user" title="user">
    </div>
  </div>
  <div class="comment_detail">
    <div class="write_info">
      <h2><?= $v['user_name'] ?></h2>
    </div>
    <div class="comment_info">
      <p><?= $v['comment'] ?></p>
      <span class="color"><?= $v['date'] ?></span>
    </div>
  </div>
</div>

<?php endforeach ?>
