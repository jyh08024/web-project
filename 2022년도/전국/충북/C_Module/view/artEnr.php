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
        <p class="bold">작품등록</p>
      </div>

      <div class="section_content">
        <div class="b_padding shadow">

          <h2>작품등록</h2>

          <div class="after_line"></div>

          <form action="/post/artEnr" enctype="multipart/form-data" method="POST" class="artEnrForm">
            <ul>
              <li>작품종류</li>
              <li>
                <select class="input" name="type">
                  <?php foreach ($cateList as $key => $v): ?>
                    <option value="<?= $v['type'] ?>"><?= $v['type'] ?></option>
                  <?php endforeach ?>
                </select>
              </li>
            </ul>
            <ul>
              <li>작가명</li>
              <li><input type="text" class="input" name="name"></li>
            </ul>
            <ul>
              <li>작품이름</li>
              <li><input type="text" class="input" name="art_name"></li>
            </ul>
            <ul>
              <li>판매가격</li>
              <li><input type="text" class="input" name="price"></li>
            </ul>
            <ul>
              <li>작품소개</li>
              <li><input type="text" class="input" name="description"></li>
            </ul>
            <ul>
              <li>작품사진</li>
              <li><input type="file" class="input" name="image"></li>
            </ul>

            <div class="after_line"></div>

            <button class="btn">작품등록</button>
          </form>

        </div>
      </div>

    </div>
  </div>