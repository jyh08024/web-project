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
        <div class="flex alc js">
          <div>
            <input type="text" class="input search_input" name="search_input" style="width: 70%;" placeholder="검색어를 입력해주세요.">
            <button class="btn search_btn">검색</button>
          </div>
          <select class="view_cate_sel input" style="width: 15%">
            <option value="all">전체</option>
            <option value="type">카테고리</option>
            <option value="art_name">작품명</option>
            <option value="name">작가</option>
            <option value="price">가격</option>
          </select>
        </div>
      </div>

      <div class="section_content">
        <div class="care_list">
          <div class="care_top flex alc js">
            <h3>카테고리</h3>
            <h3>작품명</h3>
            <h3>작가</h3>
            <h3>가격</h3>
            <h3>비고</h3>
          </div>

          <div class="care_box">
            <?php foreach ($art as $key => $v): ?>
              <div class="care_item">
                <div><p><?= $v['type'] ?></p></div>
                <div><p><?= $v['art_name'] ?></p></div>
                <div><p><?= $v['name'] ?></p></div>
                <div><p>￦ <?= number_format($v['price']) ?></p></div>
                <div class="flex alc">
                  <button class="btn" onclick='artMod(<?= json_encode($v) ?>)'>수정</button>
                  <button class="btn" onclick="artDel(<?= $v['idx'] ?>)">삭제</button>                  
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
      </div>

    </div>
  </div>

  <script>
    setInterval(() => {
      $(() => artLoad());
    }, 500);
  </script>