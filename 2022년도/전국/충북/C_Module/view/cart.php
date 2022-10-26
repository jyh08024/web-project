  <div class="visual sub_visual flex alc pr">
    <div class="wrap flex js">
      <div class="vs_text">
        <p class="vs_top">비주얼</p>
        <p class="pr bold vs_main">이한메미술관</p>
        <div class="address">
          <p><i class="fa fa-map-marker"></i> 경상남도 가창군 북상면 소정리</p>
        </div>

        <p class="vs_cont">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores atque, obcaecati libero sequi praesentium,
          voluptas perferendis ex corrupti molestias nemo eum sint adipisci, neque hic suscipit explicabo dicta ipsum
          cumque.
        </p>
      </div>
    </div>
    <img class="pa visual_back" src="resources/images/image13.jpg" alt="visual" title="visual">
  </div>

  <div style="padding-top: 6.2rem;">
    <div class="wrap">
      <div class="section_title sub_section_title pr">
        <p class="bold">장바구니</p>
      </div>

      <div class="section" style="padding-top: 3.2rem;">
        <div class="cart_area">
          <div class="cart_top flex alc js">
            <h4>선택</h4>
            <h4>이미지</h4>
            <h4>이름</h4>
            <h4>가격</h4>
          </div>

          <div class="cart_list" style="height: 500px; overflow-y:scroll;">
            <?php $total = 0; ?>
            <form action="/post/cartBuy" method="POST">

              <?php foreach ($cart as $key => $v): ?>
                <div class="stat_item">
                  <div>
                    <label for="buy_<?= $v['cart_idx'] ?>" style="margin-right: 1rem;">선택</label>
                    <input type="checkbox" name="<?= $v['cart_idx'] ?>" id="buy_<?= $v['cart_idx'] ?>">
                  </div>
                  <div>
                    <img src="/resources/C/이미지/<?= $v['type'] ?>/<?= $v['product_img'] ?>" alt="">
                  </div>
                  <div style="font-size: 1.4rem;"><?= $v['art_name'] ?></div>
                  <div style="font-size: 1.4rem;"><?= number_format($v['price']) ?></div>
                </div>

                <?php $total += $v['price'] * 1 ?>
              <?php endforeach ?>
            </div>

            <div class="after_line" style="opacity: 0;"></div>

            <div class="flex alc" style="justify-content: flex-end">
              <button class="btn">구매하기</button>
            </div>
          </form>
        </div>

        <div style="padding: 2rem;">

        </div>
        
        <div class="section_title sub_section_title pr">
          <p class="bold">구매내역</p>
        </div>
                
        <div class="after_line" style="opacity: 0;"></div>

        <div class="history_area">

          <div>
            <div class="history_item b_padding shadow">
              <div class="history_top flex alc js">
                <h4>구매날짜</h4>
                <h4>구매번호</h4>
                <h4>상품이름</h4>
                <h4>판매가격</h4>
              </div>
              <?php $totalPrice = 0; ?>
              <div class="history_list">
                <?php foreach ($buyList as $key => $v): ?>
                  <?php $height = count($v) * 50; ?>
                <div class="history_div">
                  <div style="height: <?= $height ?>px;">
                    <?= explode(" ", $v[0]['date'])[0] ?>  
                  </div>
                  <div style="height: <?= $height ?>px;">
                    <?= $key ?>  
                  </div>
                  <div class="multi_item">
                    <?php foreach ($v as $key => $item): ?>
                      <div><?= $item['art_name'] ?></div>
                    <?php endforeach ?>
                  </div>
                  <div class="multi_item">
                    <?php foreach ($v as $key => $item): ?>
                      <div>￦ <?= number_format($item['price']) ?>원</div>
                      <?php $totalPrice += $item['price'] * 1; ?>
                    <?php endforeach ?>
                  </div>
                </div>
                <?php endforeach ?>
              </div>

              <div class="flex alc" style="justify-content: flex-end; padding-top: 3rem;">
                <div class="price_box" style="margin-right: 3rem;">
                  <p>총 결제금액</p>
                  <p>
                    ￦ <?= number_format($totalPrice) ?> 원
                  </p>
                </div>
                <button class="btn csv_btn" style="transform: scale(.9)" onclick='csvDown(<?= json_encode($buyList) ?>)'>내역다운로드</button>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

  <style type="text/css">
    .history_top h4 {
      width: 25%;
    }
  </style>