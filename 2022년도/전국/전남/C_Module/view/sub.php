  <div class="section"></div>
  <div class="section wrap">
    <div class="flex">
      <div class="section_title ani">
        <p>Sub</p>
        <h2>다양한</h2>
        <h2>관람/체험 페이지</h2>
      </div>
    </div>

    <div class="intro_items sub_intro">
      <h2>정원 버스킹 안내</h2>

      <div class="after_line"></div>

      <div class="intro_list">
        <div class="intro_item">
          <div class="intro_top flex alc js">
            <h2 class="color">1. 소개</h2>
            <p>Lorem Ipsum</p>
          </div>

          <div class="intro_text">
            <p class="bold">"2022 경남 정원 버스킹!" </p>
            <p class="small">2022년부터 시작하는 각 정원의 색다르고 다양한 버스킹!</p>
            <p class="read_more">Read More</p>
          </div>
        </div>
        <div class="intro_item">
          <div class="intro_top flex alc js">
            <h2 class="color">2. 정보</h2>
            <p>Lorem Ipsum</p>
          </div>

          <div class="intro_text">
            <p class="bold">볼거리와 정원의 풍경을 동시에 누릴 수 있는  아름다운 정원으로 당신을 초대합니다.  </p>
            <p class="small">기타, 피아노, 보컬 등 여러 분야의 다양한 버스킹을 신청 또는 관람 하세요! 자세한 일정은 각 정원의 상세페이지에서 확인 바랍니다.</p>
            <p class="read_more">Read More</p>
          </div>
        </div>
        <div class="intro_item intro_img">
          <img src="/resources/img/40.jpg" alt="intro" title="intro">
        </div>
      </div>
    </div>
  </div>

  <div class="section wrap">
    <div class="sub_visual">
      <div class="sub_visual_text">
        <h2>정원 리스트 영역</h2>
        <p>원하는 정원을 리스트에서 찾아보세요.</p>

        <div class="search_box flex alc js">
          <form action="/post/search" method="POST" class="flex alc js">
            <div class="search_input">
              <i class="fa fa-search"></i>
              <input type="text" id="search" name="search" placeholder="검색어를 입력해주세요.">
            </div>
            
            <button class="btn search_btn">검색</button>
          </form>
        </div> 
      </div>
      <img src="/resources/img/25.jpg" alt="sub" title="sub">
    </div>

    <div class="garden_list">
      <?php if (!count($garden)): ?>
        <h2>검색된 정원이 없습니다.</h2>
      <?php endif ?>
      <?php foreach ($garden as $key => $v): ?>
      <div class="garden_item">
        <a href="/garden/<?= $v['id'] ?>">
          <div class="garden_img">
            <img src="/resources/C/gardens/<?= $v['image'] ?>" alt="garden" title="garden">
          </div>
  
          <div class="garden_text">
            <h3>[<?= htmlspecialchars($v['name']) ?>]</h3>
  
            <div class="garden_bot">
              <p><span>[전화번호]</span> <?= htmlspecialchars($v['connect']) ?></p>
              <p><span>[정원 위치]</span> <?= htmlspecialchars($v['location']) ?></p>
            </div>
          </div>
        </a>
      </div>
      <?php endforeach ?>
    </div>
  </div>