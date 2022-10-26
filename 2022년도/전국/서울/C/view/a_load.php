  <?php foreach ($a as $key => $v): ?>
  <div class="answer_item <?= $v['issel'] ? "seld" : "" ?>">
    <div class="user_img">
      <i class="fa fa-user"></i>
    </div>
    
    <div>
      <h2 style="display: flex;"><?= $v['content'] ?></h2>
      
      <?php if (!$v['issel']): ?>
      <button class="btn issel_btn" onclick="selAnswer(<?= $v['idx'] ?>, <?= $q['idx'] ?>)">답변채택하기</button>
      <?php endif ?>
    </div>
  </div>
<?php endforeach ?>
