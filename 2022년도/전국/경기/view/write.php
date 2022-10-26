<div class="section"></div>
<div class="section"></div>
<div class="section">
  <div class="wrap">
    <div class="section_title ani">
      <div>
        <h4 class="main_title"><span class="title_cont">글쓰기</span></h4>
      </div>
    </div>

    <div class="after_line"></div>

    <div class="form_box">
      <div class="form_left">
        <img src="/resources/img/캐릭터/1.jpg" alt="">
      </div>
      <div class="form_right">
        <h2>글 쓰기</h2>
        <div class="after_line opa1"></div>
        <form action="/post/write" method="POST" enctype="multipart/form-data">
          <ul>
            <li>글 제목</li>
            <li><input type="text" class="input" name="title"></li>
          </ul>
          <ul>
            <li>내용</li>
            <li><textarea name="content" class="input" rows="5" style="width: 100%;"></textarea></li>
          </ul>
          <ul>
            <li>사진</li>
            <li><input type="file" name="images[]" class="input" multiple></li>
          </ul>
          <ul>
            <li>게시글 등록 옵션</li>
            <li class="flex alc">
              <label class="flex alc" for="share_ban">
                <p>퍼가기 금지</p>
                <input type="checkbox" name="share_ban" id="share_ban">
              </label>
              <label class="flex alc" for="download_ban">
                <p>이미지 다운로드 금지</p>
                <input type="checkbox" name="download_ban" id="download_ban">
              </label>
              <?php if (USER['type'] == "manager"): ?>
              <label class="flex alc" for="gal_view">
                <p>갤러리에 등록</p>
                <input type="checkbox" name="gal_view" id="gal_view">
              </label>
              <?php endif ?>
              <?php if (USER['type'] == "admin"): ?>
              <label class="flex alc" for="is_notice">
                <p>공지사항으로 등록</p>
                <input type="checkbox" name="is_notice" id="is_notice">
              </label>
              <?php endif ?>
              <input type="hidden" name="cate" value="<?= $garden ?>">
            </li>
          </ul>
            
          <div class="after_line"></div>
  
          <button class="btn"><i class="fa fa-plus"></i> 등록</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  label input {
    margin-left: .5rem;
  }

  label {
    margin-right: 1rem;
  }
</style>