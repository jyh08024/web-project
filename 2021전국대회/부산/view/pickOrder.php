  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>픽업주문 - 주문하기</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <div class="sub_section_title">
      <h1>주문하기 - STEP 1.매장선택</h1>
    </div>

    <div class="shop_list">

      <?php foreach ($shopList as $key => $v): ?>
      <div class="shop_item">
        <?php if ($v['winCount'] > 0): ?>
          <h1 class="rank_star">★</h1>
        <?php endif ?>
        <a href="/shop/detail/<?= $v['idx'] ?>">
          <div class="shop_img">
            <img src="/resources/store/<?= $v['image'] ?>" alt="shop" title="shop">
          </div>
        </a>

        <div class="shop_name tlc">
          <h3><span class="color">[매장 이름]</span><?= $v['name'] ?></h3>
        </div>
      </div>

      <?php endforeach ?>

    </div>
  </div>
    
