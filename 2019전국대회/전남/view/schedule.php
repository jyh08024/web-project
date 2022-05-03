<div class="section"></div>

<div class="section wrap">
  <div class="section_title">
    <h2>BIFF<span class="color">SCHEDULE</span><span style="font-size: 1rem;">상영시간표</span></h2>
    <p>한국 영화계의 축제, 상영시간표</p>
  </div>

  <div class="after_line"></div>

  <div class="option_sel_area">
    <div class="first_option sel_option" style="grid-template-columns: repeat(3, 1fr)">
      <button data-type="day">날짜별</button>
      <button data-type="theater">극장별</button>
      <button data-type="section">섹션별</button>
    </div>

    <div class="option_detail">
      <!-- <div class="after_line"></div> -->

      <div class="sel_option day_sel" style="grid-template-columns: repeat(5, 1fr)">

      </div>

      <div class="sel_option theater_sel" style="grid-template-columns: repeat(5, 1fr)">
        
      </div>

      <div class="sel_option section_sel" style="grid-template-columns: repeat(5, 1fr)">
        
      </div>

      <div class="theater_detail">
        <!-- <div class="after_line"></div> -->

        <div class="sel_option th_detail_sel" style="grid-template-columns: repeat(5, 1fr)">

        </div>

        <!-- <div class="after_line"></div> -->
      </div>
    </div>
  </div>

  <div class="after_line"></div>

  <div class="movie_section" style="height: 600px; overflow-y: scroll;">
    <?php foreach ($movieList as $key => $val): ?>
      <div class="movie_box">
        <h1 class="box_title">10월 <?= $key ?>일</h1>
        <div class="movie_list">
          <?php foreach ($val as $key => $v): ?>
            <div class="movie_item">
              <div class="movie_img">
                <img src="../resources/data/poster/<?= $v['posterImage'] ?>" alt="movie" title="movie">
              </div>

              <div class="movie_info">
                <h2><a href="/movieDetail/<?= $v['movieCode'] ?>"><span class="color">[영화명]</span> <?= $v['title'] ?></a></h2>
                <h4><span class="color">[예매코드]</span> <?= $v['code'] ?></h4>
                <h4><span class="color">[상영시간]</span> <?= $v['time'] ?></h4>
                <h4><span class="color">[상영관]</span> <?= $v['theaterName'] ?></h4>
                <h4><span class="color">[상영일]</span> 10월 <?= $v['day'] ?>일</h4>
              </div>
            </div>
          <?php endforeach ?>
        </div>
      </div>
    <?php endforeach ?>
  </div>
</div>

<script>
  const makeSelect = () => {
    let buttons = "";

    for (let i = 3; i <= 12; i++) {
      buttons += `<button data-type="day" data-value="${i}">10월 ${i}일</button>`;
    }

    $(`.day_sel`).html(buttons);

    const theaterList = ["CGV", "영화의전당", "롯데시네마", "소향씨어터", "메가박스"];

    $(`.theater_sel`).html(theaterList.map(v => {
    	return `
    		<button data-type="theater" data-value="${v}">${v}</button>
    	`;
    }));

    const sectionList = ["개폐막작", "월드 시네마", "와이드 앵글", "갈라 프레젠테이션", "아시아 영화의 창", "뉴 커런츠", "미드나잇 패션", "플래시 포워드", "오픈 시네마"];

    $(`.section_sel`).html(sectionList.map(v => {
    	return `
    		<button data-type="section" data-value="${v}">${v}</button>
    	`;
    }))
  }

  makeSelect();
</script>