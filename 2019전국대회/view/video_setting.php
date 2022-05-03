<link rel="stylesheet" href="/resources/css/sub.css">
  <div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>예고편 관리 페이지</h1>
      </div>
      <div class="banner_img">
        <img src="/resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>
  <input type="radio" name="check" id="menu_btn1">
  <input type="radio" name="check" id="menu_btn2">
  <input type="radio" name="check" id="menu_btn3">
  <input type="radio" name="check" id="menu_btn4">

  <div class="select_area wrap">
    <label class="btn" for="menu_btn1" data-type="detail">상세정보</label>
    <label class="btn" for="menu_btn2" data-type="analysis">분석</label>
    <label class="btn" for="menu_btn3" data-type="editer">편집기</label>
    <label class="btn" for="menu_btn4" data-type="comment">댓글</label>
  </div>

  <div class="detail_info_section editer_page_section rap">
    <div class="info_title">
      <h2>예고편 관리 | 상세정보</h2>
    </div>

    <div class="detail_info_content">
      <form action="/video/update/detail/<?= $videoData['idx'] ?>" class="video_setting_content" method="POST">
        <ul>
          <li><label for="title_setting">제목</label></li>
          <li><input type="text" class="title_setting form_input" id="video_title_setting" name="video_title" value="<?= $videoData['title'] ?>"></li>
        </ul>

        <ul>
          <li><label for="explain_setting">설명</label></li>
          <li><textarea class="explain_setting form_input" id="explain_setting" name="video_explain"><?= $videoData['description'] ?></textarea></li>
        </ul>

        <ul>
          <li><label for="video_title_setting">다운로드</label></li>
          <li>
            <label for="download_can">허용 <input type="radio" id="download_can" name="download" value="허용" <?= $videoData['allowed'] == 1 ? "checked" : ""?>></label>
            <label for="download_cant">비허용 <input type="radio" id="download_cant" name="download" value="허용" <?= $videoData['allowed'] !== 1 ? "checked" : ""?>></label>
          </li>
        </ul>

        <div class="form_footer">
          <button class="btn mod_btn"><i class="fa fa-check"></i> 수정</button>
        </div>
      </form>
    </div>
  </div>

  <div class="graph_section editer_page_section rap">
    <div class="info_title">
      <h2>예고편 관리 | 분석</h2>
    </div>

    <div class="graph_content">
      <canvas class="cv1" width="1440" height="600"></canvas>
    </div>
  </div>

  <div class="editer_section editer_page_section rap">
    <div class="info_title">
      <h2>예고편 관리 | 편집기</h2>
    </div>

    <div class="editer_content">

      <div class="video_area">
        <div class="video_div">
          <p class="caption"></p>
          <video src="<?= $videoData['video'] ?>" id="editTarget"></video>
        </div>
      </div>

      <div class="ckBar1 bar"></div>
      <div class="ckBar2 bar"></div>

      <div class="conBtn">
        <button class="btn mod_cap">수정</button>
        <button class="btn del_cap">삭제</button>
      </div>

      <div class="editFoo">
        <form class="formArea">
          <ul>
            <li><label for="startTime" class="lb">시작시간(초)</label></li>
            <li><input type="text" class="num form_input startTime timeInput" name="startTime" id="startTime" placeholder="시작시간(초)" required></li>
          </ul>
          <ul>
            <li><label for="endTime" class="lb">끝시간(초)</label></li>
            <li><input type="text" class="num form_input endTime timeInput" name="endTime" id="endTime" placeholder="끝시간(초)" required></li>
          </ul>
          <ul>
            <li><label for="CapContent" class="lb">자막내용</label></li>
            <li><input type="text" class="form_input CapContent" name="CapContent" id="CapContent" placeholder="자막입력" required></li>
          </ul>

          <div class="editBtn">
            <label class="btn addCap"><i class="fa fa-plus"></i> 추가</label>
            <label class="btn saveCap"><i class="fa fa-save"></i> 저장</label>
            <label class="btn"><i class="fa fa-file-download "></i> 다운로드</label>
          </div>
        </form>
      </div>
    </div>
  </div>

  <div class="comment_section editer_page_section rap">
    <div class="info_title">
      <h2>예고편 관리 | 댓글</h2>
    </div>
  
    <div class="comment">

      <?php foreach ($comment as $key => $v): ?>

      <div class="comment_item">
      
        <div class="writer">
          <div class="writer_img">
            <img src="<?= $v['user_img'] ?>" alt="user" title="user">
          </div>
        </div>
        <div class="comment_detail">
          <div class="write_info">
            <h2><?= $v['user_name'] ?></h2>
          </div>
          <div class="comment_info">
            <a href="/video/<?= $v['video_idx'] ?>">
            <p><?= $v['comment'] ?></p>
          </a>
            <span class="color"><?= $v['date'] ?></span>
          </div>
        </div>

        <button class="btn del_com" data-idx="<?= $v['idx'] ?>" data-par="<?= $v['video_idx'] ?>">삭제하기</button>

      </div>

      <?php endforeach ?>

    </div>
  </div>

  <script>
    const target = $(`#editTarget`)[0];

    target.onloadedmetadata = () => {
        Editer.init();
      }

    Graph.init();
  </script>