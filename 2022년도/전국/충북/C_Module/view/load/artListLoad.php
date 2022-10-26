<div class="art_list">
  <?php foreach ($art as $key => $v): ?>
    <div class="art_item shadow flex js">
      <div class="art_img">
        <img src="/resources/C/이미지/<?= $v['type'] ?>/<?= $v['product_img'] ?>">
      </div>

      <div class="art_content flex js">
        <div>
          <h3 class="color"><?= $v['type'] ?></h3>
          <h1><?= $v['art_name'] ?></h1>
        </div>

        <div>
          <p>상품설명</p>
          <p style="font-size: 1.2rem;"><?= $v['description'] ?></p>
        </div>

        <div>
          <p>작가</p>
          <h3><?= $v['name'] ?></h3>
        </div>

        <div>
          <p class="color" style="font-size: 1.4rem;">￦ <?= number_format($v['price']) ?>원</p>
          <div class="after_line"></div>
        </div>
        
        <div>
          <a class="btn" href="/art/<?= $v['idx'] ?>">상세보기</a>
        </div>
      </div>
    </div>            
  <?php endforeach ?>
</div>