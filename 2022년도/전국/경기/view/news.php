  <?php if ($garden != "all"): ?>
  <a href="/write/<?= $garden ?>" class="write_page">
    <i class="fa fa-pen"></i>
    <h4>글쓰기</h4>
  </a>
  <?php endif ?>

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

    .board_item img {
      height: 136.66px;
    }
  </style>
  
  <div class="section"></div>
  <div class="section"></div>
  <div class="section">
    <div class="wrap">
      <div class="section_title ani">
        <div>
          <h4 class="main_title"><span class="title_cont">정원 소식지</span>다양한 이야기를 들려드려요.</h4>
        </div>
      </div>

      <div class="section_content">
        <div class="tab_list" style="overflow-x: scroll;">
          <div class="tab_rap" style="width: calc(316px * 23);">
            <div class="tab_item">
              <div class="tab_text">
                <a href="/news/all/1">
                  <h2>전체</h2>
                </a>
              </div>
              <div class="tab_img">
                <img src="/resources/image/5.jpg" alt="tab" title="tab">
              </div>
            </div>
            <?php foreach ($allGarden as $key => $v): ?>
              <div class="tab_item">
                <div class="tab_text">
                  <a href="/news/<?= $v['idx'] ?>/1">
                    <h2><?= $v['name'] ?></h2>
                  </a>
                </div>
                <div class="tab_img">
                  <img src="/resources/민간정원/<?= $v['name'] ?>2.jpg" alt="tab" title="tab">
                </div>
              </div>
            <?php endforeach ?>
          </div>
        </div>
  
        <div class="after_line"></div>
        
        <div class="board_top">
          <div></div>
          <div>게시판</div>
          <div>글 번호</div>
          <div>글 제목</div>
          <div>글쓴이</div>
          <div>작성일시</div>
          <div>조회수</div>
        </div>

        <div class="board_list">
          <?php if ($page == "1"): ?>
            <?php foreach ($notice as $key => $v): ?>
            <div class="board_item not">
              <div class="b_tpe">공지글</div>
              <div>전체</div>
              <div><?= $v['idx'] ?></div>
              <div><a href="/view/<?= $v['idx'] ?>"><?= $v['title'] ?></a></div>
              <div>총 관리자</div>
              <div><?= timeFormat($v['date']) ?></div>
              <div><?= $v['view'] ?></div>
            </div>
            <?php endforeach ?>
          <?php endif ?>
          
          <?php foreach ($normal as $key => $v): ?>
            <?php $thum = image::find("type = ? && owner_idx = ?", ["news", $v['idx']]) ?>
          <div class="board_item nor">
            <div>
              <?php if ($thum): ?>
              <img src="<?= $thum['src'] ?>" alt="notice" title="notice">
            <?php else: ?>
              <div class="flex alc jc" style="height: 136.66px;"><h2>No Image</h2></div>
              <?php endif ?>
            </div>
            <div><?= garden::find("idx = ?", $v['cate'])['name'] ?></div>
            <div><?= $v['idx'] ?></div>
            <div><a href="/view/<?= $v['idx'] ?>"><?= $v['title'] ?></a></div>
            <div><?= user::find('idx = ?', $v['user_idx'])['name'] ?></div>
            <div><?= timeFormat($v['date']) ?></div>
            <div><?= $v['view'] ?></div>
          </div>
          <?php endforeach ?>
        </div>

        <div class="after_line"></div>

        <div class="page_list">
          <?php $before = $page == 1 ? 1 : $page - 1 ?>
          <?php $next = $page == $end ? $end : $page + 1 ?>
          <div><a href="/news/<?= $garden ?>/1"><i class="fa fa-angle-double-left"></i></a></div>
          <div><a href="/news/<?= $garden ?>/<?= $before ?>"><i class="fa fa-angle-left"></i></a></div>

          <?php if ($btnBlock): ?>
          <?php foreach ($btnBlock[$now - 1] as $key => $v): ?>
            <div class="<?= $page == $key + 1 ? "now_page" : "" ?>"><a href="/news/<?= $garden ?>/<?= $key + 1 ?>"><?= $key + 1 ?></a></div>
          <?php endforeach ?>
          <?php else: ?>
          <div class="now_page"><a href="/news/<?= $garden ?>/1">1</a></div>
          <?php endif ?>


          <div><a href="/news/<?= $garden ?>/<?= $next ?>"><i class="fa fa-angle-right"></i></a></div>
          <div><a href="/news/<?= $garden ?>/<?= $end ?>"><i class="fa fa-angle-double-right"></i></a></div>
        </div>
      </div>
    </div>
  </div>
