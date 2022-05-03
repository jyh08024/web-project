<link rel="stylesheet" href="/resources/css/sub.css">

  <div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>예고편 업로드</h1>
      </div>
      <div class="banner_img">
        <img src="resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>
  <div class="upload_content rap">
    <div class="content_title">
      <h3>업로드</h3>
    </div>
      <canvas class="t_cv" width="660", height="370"></canvas>
    <div class="upload_detail">
      <form action="/upload/post" method="POST" enctype="multipart/form-data" class="video_info_write">
        <video class="videoBox"></video>
        <img class="thumbBox" alt="tumb" title="tumb">
        <label for="upload" class="file_upload_box" id="upload_box">
          <p>파일을 선택해주세요.</p>
          <input type="file" class="upload" id="upload" name="video" hidden>
        </label>

      <div class="detail_info">
          <ul>
            <li><label>썸네일 삭제</label></li>
            <li><button type="button" class="del_thum_up btn">삭제</button></li>
          </ul>
          <ul>
            <li><label for="thumb_input">예고편 썸네일</label></li>
            <li><input type="file" class="form_input" id="thumb_input" name="thumbnail" disabled></li>
            <input type="hidden" id="tu" name="tu">
          </ul>
          
          <ul>
            <li><label for="running_time">러닝타임</label></li>
          <li><input type="number" class="form_input" id="running_time" value="0" disabled></li>
        </ul>
        
        <ul>
          <li><label for="video_title">영상 제목</label></li>
          <li><input type="text" class="form_input" id="video_title" name="title" disabled></li>
        </ul>
        
        <ul>
          <li><label for="video_info">영상 설명</label></li>
          <li><input type="text" class="form_input" id="video_info" name="description" disabled></li>
        </ul>
        
        <ul>
          <li><label for="">다운로드</label></li>
          <li>허용<input type="radio" id="can" value="1" name="allowed" checked disabled>&nbsp;&nbsp;&nbsp; 비허용<input type="radio" name="allowed" value="" disabled></li>
          <input type="hidden" class="duration_input" name="duration">
        </ul>
        <div class="form_footer">
          <button class="btn upload_Btn"><i class="fa fa-check"></i> 업로드</button>
        </div>
      </form>
      </div>
    </div>
  </div>