  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>픽업주문 - 주문하기</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <div class="sub_section_title">
      <h1>주문하기 - STEP 2.상품 선택</h1>
    </div>

    <div class="shop_info flex alc">
      <div class="shop_detail_img">
        <img src="/resources/store/<?= $nowShop['image'] ?>" alt="shop" title="shop">
      </div>

      <div class="shop_text">
        <h1><span class="color">[매장 이름]</span> <?= $nowShop['name'] ?></h1>
        <h4><span class="color">[설명]</span> <?= $nowShop['contents'] ?></h4>
      </div>
    </div>

    <div class="shop_bread_list">
      <?php foreach ($nowShop['bread'] as $key => $v): ?>
        <div class="shop_bread_item">
          <div class="shop_bread_img">
            <img src="/resources/bread/<?= $v['image'] ?>" alt="bread" title="bread">
          </div>

          <div class="bread_info">
            <h2><?= $v['name'] ?></h2>
            <div class="sale_place"><?= $nowShop['name'] ?></div>

            <div class="sale_input flex alc js">
              <form action="/post/cart" method="POST">
                <input type="number" class="input" name="count" value="1">
                <input type="hidden" name="bread_idx" value="<?= $v['idx'] ?>">
                <input type="hidden" name="order_baker" value="<?= $idx ?>">
                <button class="btn">추가</button>
              </form>
            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>

    <div class="cart_area flex alc js">
      
      <div class="cart_box">
        <table>
          <thead>
            <tr>
              <th>이름</th>
              <th>개수</th>
            </tr>
          </thead>

          <tbody>
            <?php foreach ($cartList as $key => $v): ?>
              <tr>
                <td><?= $v['name'] ?> - <?= $v['bread_name'] ?></td>
                <td><?= $v['count'] ?></td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>

      <div class="order_btn">
        <form method="POST" action="/post/updateCart/<?= $v['idx'] ?>">
          <button class="btn" name="type" value="empty" <?= !count($cartList) ? "disabled style='opacity: .5;'" : "" ?>>카트 비우기</button>
          <button class="btn" name="type" value="order" <?= !count($cartList) ? "disabled style='opacity: .5;'" : "" ?>>주문하기</button>
        </form>
      </div>

    </div>
  </div>
    
