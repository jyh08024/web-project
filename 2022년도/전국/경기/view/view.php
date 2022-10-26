  <a href="/news/all/1" class="write_page">
    <i class="fa fa-list-alt"></i>
    <h4>목록으로</h4>
  </a>

  <style>
    .write_page {
      position: fixed;
      top: 50%;
      right: 4%;
      transform: translateY(-50%);
      width: 80px;
      height: 80px;
      border-radius: 50%;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      background: #c5e302;
      font-size: 1.2rem;
      z-index: 99999999999;
    }

  .share_ban {
    position: fixed;
    z-index: 99999999;
    opacity: .3;
    font-size: 4rem;
    user-select: none;
    pointer-events: none;
  }

  .s_1 {
    transform: rotate(6deg);
    top: 50%;
    left: 35%;
  }

  .s_2 {
    transform: rotate(6deg);
    top: 20%;
    left: 5%;
  }

  .s_3 {
    transform: rotate(6deg);
    top: 80%;
    right: 5%;
  }
  </style>

<div class="section"></div>
<div class="section"></div>
<?php if ($board['share_ban'] == "on"): ?>
  <div class="share_ban s_1">
    <h2><?= $board['title'] ?> - <?= $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'] ?></h2>
  </div>
  <div class="share_ban s_2">
    <h2><?= $board['title'] ?> - <?= $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'] ?></h2>
  </div>
  <div class="share_ban s_3">
    <h2><?= $board['title'] ?> - <?= $_SERVER['REMOTE_ADDR'] == "::1" ? "127.0.0.1" : $_SERVER['REMOTE_ADDR'] ?></h2>
  </div>
<?php endif ?>
<div class="section" style="<?= $board['share_ban'] == "on" ? "user-select: none;" : "" ?>">
  <div class="wrap">
    <div class="section_title ani">
      <div>
        <h4 class="main_title"><span class="title_cont">글보기</span></h4>
      </div>
    </div>

    <div class="after_line"></div>

    <div class="view_box">
      <div class="flex alc js">
        <h1><?= $board['title'] ?></h1>
        <div class="flex alc">
          <h4 style="margin-left: 1rem;">작성일: <?= $board['date']?></h4>
          <h4 style="margin-left: 1rem;">조회수: <?= $board['view'] ?>회</h4>
          <h4 style="margin-left: 1rem;">댓글 수: <?= count($comment) ?></h4>
        </div>

      </div>

      <div class="after_line opa1"></div>

      <div class="flex ale">
        <div class="user flex alc">
          <div class="user_img">
            <img src="/resources/img/캐릭터/2.jpg">
          </div>
          <p><?= user::find("idx = ?", $board['user_idx'])['name'] ?></p>
        </div>
      </div>

      <div class="after_line opa1"></div>
      
      <p style="font-size: 1.1rem;"><?= $board['content'] ?></p>

      <div class="img_list cont_no" style="margin-top: 2rem; margin-bottom: 6rem;">
        <?php if ($board['download_ban'] == "on"): ?>
          <?php foreach ($images as $key => $v): ?>
            <img src="/images/<?= $v['idx'] ?>">
          <?php endforeach ?>
        <?php else: ?>
          <?php foreach ($images as $key => $v): ?>
            <img src="<?= $v['src'] ?>">
          <?php endforeach ?>
        <?php endif ?>
      </div>

      <div class="after_line opa1"></div>

      <div>
        <?php if (@USER['idx'] == $board['user_idx'] || @USER['type'] == "admin"): ?>
          <a href="/delete/<?= $board['idx'] ?>" class="btn">삭제</a>
        <?php endif ?>
      </div>

      <div class="after_line opa1"></div>

      <div class="flex alc">
        <h2>이미지 목록</h2>
        <a style="margin-left: 1rem;" href="/download/<?= $board['idx'] ?>" class="btn zip_down">이미지 다운로드</a>
      </div>

      <div class="after_line"></div>

      <div class="down_img_list cont_no flex alc js">
        <?php if ($board['download_ban'] == "on"): ?>
          <?php foreach ($images as $key => $v): ?>
            <img src="/images/<?= $v['idx'] ?>">
          <?php endforeach ?>
        <?php else: ?>
          <?php foreach ($images as $key => $v): ?>
            <img src="<?= $v['src'] ?>">
          <?php endforeach ?>
        <?php endif ?>
      </div>

      <div class="after_line"></div>

      <div class="comment_box">
        <h2>댓글</h2>

        <div class="comment_form">
          <form action="/post/comment" method="POST">
            <textarea name="content" rows="10" style="width: 90%;" class="input"></textarea>
            <input type="hidden" name="board" value="<?= $board['idx'] ?>">
            <button class="btn">등록</button>
          </form>
        </div>
      </div>

      <div class="after_line"></div>

      <div class="comment_list">
        <?php foreach ($comment as $key => $v): ?>
          <div class="comment_item">
            <div class="flex alc js">
              <div class="flex alc">
                <div class="user_img flex alc jc" style="width: 65px; height: 65px; font-size: 3rem; border: 1px solid rgba(0, 0, 0, .1);">
                  <i class="fa fa-user"></i>
                </div>
                <h3><?= user::find("idx = ?", $v['user_idx'])['name'] ?></h3>
              </div>

              <div>
                <p>작성시간: <?= $v['date'] ?></p>
              </div>

            </div>
            <p style="font-size: 1.2rem;"><?= $v['content'] ?></p>
          </div>
        <?php endforeach ?>
      </div>
    </div>
  </div>
</div>

<style>
  .comment_item {
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(0,0,0,.1);
  }

  .view_box {
    width: 100%;
    padding: 2.5rem;
    box-shadow: 0 0 30px rgb(0 0 0 / 10%);
    border-radius: 20px;
    margin-bottom: 2rem;
  }

  .view_box .ale {
    align-items: flex-end;
  }

  .down_img_list img {
    width: 140px;
    height: 140px;
  }
</style>

<?php if ($board['download_ban'] == "on"): ?>
  <script>
    $(document)
      .on(`contextmenu`, ".cont_no img", (e) => {
        e.preventDefault();
      })  
      .on(`click`, ".zip_down", (e) => {
        e.preventDefault();
      })
  </script>
<?php endif ?>