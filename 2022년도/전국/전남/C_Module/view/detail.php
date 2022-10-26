<div class="section"></div>
<div class="section wrap">
  <div class="flex">
    <div class="section_title ani">
      <p>Community</p>
      <h2>함께해요</h2>
      <h2>버스커 모집 상세</h2>
    </div>
  </div>

  <div class="after_line"></div>

  <div class="section_content">
    <div class="flex alc js">
      <h1><?= $rec['title'] ?></h1>

      <div class="flex alc bus_info">
        <p class="now_p"><span class="bold">모집인원:</span> <?= $rec['accept_person'] + 1 ?> / <?= $rec['personnel'] + 1 ?></p>
        <p><span class=bold">작성자: <?= $rec['user_name'] ?></span></p>
      </div>
    </div>
      
    <div class="after_line"></div>

    <p class="rec_cont"><?= $rec['contents'] ?></p>

    <div class="other_cont">
      <p><span class="bold">분야 :</span> <?= $rec['category'] ?></p>
    </div>

    <div class="after_line"></div>
    <div class="after_line"></div>
    <div class="after_line"></div>

    <h2>버스커 명단 영역</h2>


  </div>
</div>

<div class="section"></div>