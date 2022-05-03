<link rel="stylesheet" href="/resources/css/sub.css">
  
  <div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>영화 예고편 페이지</h1>
      </div>
      <div class="banner_img">
        <img src="/resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>
  <div class="warning_content rap">
    <div class="pro_top">
      <div class="pro_info">
        <img src="<?= $video['user_img'] ?>" alt="user" title="user">
        <div class="text_info">
          <h2><?= $video['user_name'] ?></h2>
          <p>follower: <span class="color"><?= $video['user_follow'] ? number_format($video['user_follow']) : 0 ?></span>명</p>
        </div>
      </div>
      <div class="detail_btn">
        <label class="toggle">
          <input type="checkbox" class="follow" id="follow" value="<?= $video['user_index'] ?>">
          <span class="slider round"></span>
        </label>
        <label for="follow" class="is_follow">팔로우</label>
        <label for="follow" class="none_follow">팔로우 취소</label>
      </div>
    </div>

    <div class="after_line"></div>

    <div class="video_detail_area">
      <div class="video_detail_top">
        <h2><?= $video['title'] ?></h2>

        <div>
          <label class="toggle">
            <input type="checkbox" class="recom" id="recom">
            <span class="slider round"></span>
          </label>
          <label for="recom">추천</label>
          <?php if ($video['allowed'] == 1): ?>
            <a href="/download/video/<?= $video['idx'] ?>" class="btn down_btn">다운로드</a>
          <?php endif ?>
        </div>
      </div>

      <div class="video_area">
        <div class="video_div">
          <p class="caption"></p>
          <video src="<?= $video['video'] ?>" data-idx="<?= $video['idx'] ?>"></video>
          <div class="video_control">
            <div class="control_top">
              <div class="play_an_time">
                <div class="play">
                  <i class="fa fa-play"></i>
                </div>
                <div class="pause">
                  <i class="fa fa-pause"></i>
                </div>
                <p class="time"><span class="nowTime">0:00</span> / <span class="fullTime">0:00</span></p>
              </div>
              <div class="etc_control">

                <i class="fa fa-volume-up "></i>

                <div class="volumeCon">
                  <input type="range" class="volumeRange" min="0" max="1" step="0.1">
                  <div class="volumeBar"></div>
                  <div class="volumeFill"></div>
                </div>

                <div class="capBtn">
                  <i class="fa fa-closed-captioning none"></i>
                  <i class="fa fa-closed-captioning"></i>
                </div>

                <i class="fa fa-expand-arrows-alt"></i>
                <!-- <i class="fa fa-expand"></i> -->
              </div>
            </div>

            <div class="play_seekbar">
              <input type="range" class="seekRange" value="0">
              <div class="seek_bar"></div>
              <div class="seekFeel"></div>
            </div>
          </div>
        </div>
      </div>
      
    </div>
    
    <div class="videoExplain">
      <p><?= $video['description'] ?></p>
    </div>
    
    <div class="after_line"></div>  
    
  </div>

  <div class="comment_area rap">
    <?php if (USER): ?>
      
    <div class="comment_form_area">
      <div class="form_area_top">
        <h3>댓글 작성</h3>
      </div>

      <div class="comment_fomm">
        <textarea name="comment_content" id="comment_content"  rows="7" placeholder="댓글을 입력해주세요."></textarea>

        <button class="btn write_comment" data-idx="<?= $video['idx'] ?>"><i class="fa fa-pen-nib"></i>&nbsp; 댓글 작성</button>
      </div>
    </div>
    <?php endif ?>

    <div class="after_line"></div>

    <div class="comment_list">
      <div class="list_area_top">
        <h3>댓글</h3>
      </div>

      <div class="comment_lists">
        <!-- <?php foreach ($comment as $key => $v): ?>
          
          <div class="comment_item">

            <div class="writer">
              <div class="writer_img">
                <img src="<?= $v['img'] ?>" alt="user" title="user">
              </div>
            </div>
            <div class="comment_detail">
              <div class="write_info">
                <h2><?= $v['name'] ?></h2>
              </div>
              <div class="comment_info">
                <p><?= $v['comment'] ?></p>
                <span class="color"><?= $v['date'] ?></span>
              </div>
            </div>
          </div>

        <?php endforeach ?> -->
      </div>
    </div>
  </div>

  <script>
    const target = $(`video`)[0];

    target.onloadedmetadata = () => {
      Video.init();
    }
  </script>