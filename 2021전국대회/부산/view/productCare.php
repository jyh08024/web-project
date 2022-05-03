  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>매장관리 - 상품관리</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <form method="POST" action="/post/productCare/<?= $shopInfo['idx'] ?>">
      <div class="sub_section_title flex alc js">
        <h2>상품관리</h2>
        <button class="btn">저장</button>
      </div>

      <div class="product_list">
        <?php foreach ($res as $key => $v): ?>
          <div class="product_item">
            <div class="product_img">
              <img src="/resources/bread/<?= $v['image'] ?>" alt="bread" title="bread" style="<?= $v['nowSel'] == 'not' ? 'filter: grayscale(100%);' : '' ?>">
            </div>

            <div class="product_info flex alc js">
              <input type="checkbox" name="<?= $v['idx'] ?>" <?= $v['nowSel'] == "sale" ? "checked" : "" ?>>
              <h3><?= $v['name'] ?></h3>
              <h4 class="color"><?= $v['score'] ?>점</h4>
            </div>
          </div>
        <?php endforeach ?>
      </div>      
    </form>

  </div>


