<div class="section"></div>
  <div class="section wrap">
    <div class="flex">
      <div class="section_title ani">
        <p>Garden</p>
        <h2><?= $garden['name'] ?></h2>
        <h2>정원 상세 페이지</h2>
      </div>
    </div>
  </div>

  <div class="section wrap cal_sec">
    <div class="cal_top tlc">
      <h1><?= date("Y") ?>년 <?= date("m") ?>월</h1>
    </div>
    
    <div class="cal_date_list cal_grid">
      <div>일</div>
      <div>월</div>
      <div>화</div>
      <div>수</div>
      <div>목</div>
      <div>금</div>
      <div>토</div>
    </div>

    <div class="cal_day_list cal_grid">
      <?= $calendar ?>
    </div>
  </div>