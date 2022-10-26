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
        <p class="bold">작품상세보기</p>
      </div>

      <div class="section">
        <div class="shadow b_padding flex js">
          <div class="art_img" style="height: 500px;">
            <img src="/resources/C/이미지/<?= $art['type'] ?>/<?= $art['product_img'] ?>">
          </div>
          
          <div class="art_content flex js">
            <div>
              <div>
                <h3 class="color"><?= $art['type'] ?></h3>
                <h1><?= $art['art_name'] ?></h1>
                <div class="after_line"></div>
              </div>
              
              <div>
                <p>판매가격: </p>
                <h1 class="color">￦ <?= number_format($art['price']) ?>원</h1>
                <div class="after_line"></div>
              </div>

              <div>
                <p>작가이름: </p>
                <h3><?= $art['name'] ?></h3>
                <div class="after_line"></div>
              </div>

              <div>
                <p>작품소개</p>
                <p style="font-size: 1.4rem"><?= $art['description'] ?></p>
                <div class="after_line"></div>
              </div>
            </div>

            <div class="flex alc">
              <form action="/post/buy" method="POST">
                <button class="btn" name="art_idx" value="<?= $art['idx'] ?>">구매하기</button>
              </form>
              <form action="/post/cart" method="POST">
                <button class="btn" name="art_idx" value="<?= $art['idx'] ?>">장바구니담기</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>