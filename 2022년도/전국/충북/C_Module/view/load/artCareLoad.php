<div class="care_box">
  <?php foreach ($art as $key => $v): ?>
    <?php 
    $vType = $v['type'];
    $vArt = $v['art_name'];
      if (trim($search[0]) ?? '') {
        $vType = preg_replace("/($search[0])/", "<span class='high'>$1</span>", $v['type']);

        $vArt = preg_replace("/($search[0])/", "<span class='high'>$1</span>", $v['art_name']);
      }
    ?>
    <div class="care_item">
      <div><p><?= $vType ?></p></div>
      <div><p><?= $vArt ?></p></div>
      <div><p><?= $v['name'] ?></p></div>
      <div><p>￦ <?= number_format($v['price']) ?></p></div>
      <div class="flex alc">
        <button class="btn" onclick='artMod(<?= json_encode($v) ?>)'>수정</button>
        <button class="btn" onclick="artDel(<?= $v['idx'] ?>)">삭제</button>                  
      </div>
    </div>
  <?php endforeach ?>
</div>
