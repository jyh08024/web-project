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
        <p class="bold">작품목록</p>
      </div>

      <div class="section">
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
      </div>
    </div>
  </div>

  <script>
    setInterval(() => {
      $(() => artLoad());
    }, 500);
  </script>