  <div class="section"></div>

  <div class="section wrap">
    <div class="section_title">
      <div>
        <div class="title_block"></div>
        <h4>쇼핑몰 페이지</h4>
      </div>
      <p>와일드 푸드 축제 상품 판매</p>
    </div>

    <div class="after_line"></div>

    <div class="store_area">
      <div class="product_list">

      </div>

      <div class="basket_area">
        <div class="basket">
          <h3>장바구니</h3>

          <div class="cart_list">
            
          </div>

          <div class="after_line"></div>

          <button class="btn" onclick='suggest(<?= json_encode($sugData, true) ?>, <?= $idx ?>)'><i class="fa fa-shopping-cart"></i> 구매</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    sugStore = true;

    function suggest(data, id) {
      if (!Cart.list.length) {
        alert('상품을 담아주세요');
        return;
      }

      const cartPrice = [...Cart.list].reduce((acc, val) => acc += val.totalCost, 0);

      if (cartPrice > (data.max * 1) + (data.priceRange * 1) || cartPrice < (data.max * 1) - (data.priceRange * 1)) {
        alert('담은 상품의 총 가격이 가격 한도와 오차범위에 일치하지 않습니다.');
        return;        
      }

      $.post('/post/sugData', { sug: Cart.list, req: id }).done((res) => {
        alert(res);
        location.href = '/suggest';
      });
    }
  </script>