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
      <h2><?= $q['title'] ?></h2>

      <div class="after_line"></div>

      <?php if ($q['file']): ?>
        <?php if ($q['type'] == "image"): ?>
          <img class="resImg" style="width: 800px;" src="<?= $q['file'] ?>">
        <?php else: ?>
          <video style="width: 800px;" src="<?= $q['file'] ?>"></video>
        <?php endif ?>
      <?php endif ?>

      <div class="after_line"></div>

      <form action="/post/answer" method="POST">
        <input type="hidden" name="q_idx" value="<?= $q['idx'] ?>">
        <P>답변</P>
        <textarea type="text" class="input" name="content" rows="10" style="border-radius: 20px;"></textarea>
        <div class="after_line" style="opacity: 0;"></div>
        <button class="btn">등록</button>
      </form>

      <div class="after_line"></div>

      <h2>답변목록</h2>

      <div class="q_list a_list">
        <?php foreach ($a as $key => $v): ?>
        <div class="answer_item <?= $v['issel'] ? "seld" : "" ?>">
          <div class="user_img">
            <i class="fa fa-user"></i>
          </div>
          
          <div>
            <h2 style="display: flex;"><?= $v['content'] ?></h2>
            
            <?php if (!$v['issel']): ?>
            <button class="btn issel_btn" onclick="selAnswer(<?= $v['idx'] ?>, <?= $q['idx'] ?>)">답변채택하기</button>
            <?php endif ?>
          </div>
        </div>
      <?php endforeach ?>
      </div>
    </div>
  </div>
</div>