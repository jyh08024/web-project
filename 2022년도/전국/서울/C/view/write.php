<div class="section"></div>
<div class="section"></div>
<div class="section wrap">
  <div class="section_title ani">
    <div>
      <h2>Q&A</h2>
    </div>
  </div>

  <div class="section_content flex rest_section">
    <div class="top_tab">
      <a class="tab" href="/restaurant"><i class="fa fa-pencil-square-o"></i> 예약정보 입력</a>
      <a class="tab" href="/restRead"><i class="fa fa-search-plus"></i> 예약 조회</a>
      <a class="tab now_tab" href="/qna"><i class="fa fa-book"></i> Q&A</a>
    </div>

    <div class="sb">
      <form action="/post/write" method="POST" enctype="multipart/form-data">
        <div class="flex alc js">
          <h2>글작성</h2>
          
          <select name="store" class="input store_input" style="width: 30%;">
            <option value="서동한식당">서동한식당</option>
            <option value="서동전통찻집">서동전통찻집</option>
            <option value="서동한두">서동한우</option>
          </select>
        </div>
  
        <div class="after_line"></div>

        <ul>
          <li>제목</li>
          <li>
            <input type="text" class="input" name="title">
          </li>
        </ul>
        <ul>
          <li>파일</li>
          <li>
            <input type="file" name="file" class="input file_input">
          </li>
        </ul>

        <div class="after_line"></div>

        <button class="btn">작성</button>
      </form>
    </div>
  </div>
</div>

  <script>
  $(document)
    .on(`input`, ".file_input", (e) => {
      const file = Object.values(e.target.files);

      if (!["jpeg", "png", "jpg", "gif", "mp4", "mpeg", "avi"].includes(file[0].type.split("/")[1])) {
        alert('올바른 확장자를 입력해 주세요.');
        e.target.value = "";
        return;
      }

      if (file[0].type.split("/")[0] == "video" && file[0].size > 10000000) {
        alert('업로드 용량 제한은 10MB입니다.');
        e.target.value = "";
        return;
      }

      $(`.file_type`).val(file[0].type.split("/")[0]);
    })
</script>