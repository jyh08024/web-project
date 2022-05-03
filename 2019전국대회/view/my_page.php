  <link rel="stylesheet" href="resources/css/sub.css">

  <div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>내 동영상 페이지</h1>
      </div>
      <div class="banner_img">
        <img src="resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>

  <div class="prod_detail rap">

    <div class="pro_top rap">
      <div class="pro_info">
        <img src="<?= USER['img'] ?>" alt="user" title="user">
        <div class="text_info">
          <h2><?= USER['name'] ?></h2>
          <p>follower: <span class="color"><?= number_format(USER['follows']) ?></span></p>
        </div>
      </div>
      
      <div class="detail_btn">
        <label class="toggle">
          <input type="checkbox" class="follow" id="follow">
          <span class="slider round"></span>
        </label>
        <label for="follow" class="is_follow">팔로우</label>
        <label for="follow" class="none_follow">팔로우 취소</label>
      </div>
    </div>

      <div class="pro_mini_title">
        <h3><?= USER['name'] ?> | 영화목록</h3>
      </div>
      
        
        <div class="pro_movie_list">
      <?php foreach ($video as $key => $v): ?>

          <div class="main_movie_item">
          <a href="/video_setting/<?= $v['idx'] ?>">
            <div class="item_img">
              <img src="<?= $v['thumbnail'] ?>" alt="thumb" title="thumb">
            </div>
          </a>
            <div class="item_content">
              <a href="/video/<?= $v['idx'] ?>">
              <h3><?= $v['title'] ?></h3>
              </a>
              <p class="explain">
                <?= $v['description'] ?>
              </p>
              <p class="maker">
                조회수:<?= $v['view'] ?> | 영상길이: <?= $v['duration'] ?> | 등록된 시간: <?= $v['date'] ?>
              </p>
            </div>
          </div>

      <?php endforeach ?>
        <!-- <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div>

        <div class="main_movie_item">
          <div class="item_img">
            <img src="resources/img/Thumbnail3.png" alt="thumb" title="thumb">
          </div>
          <div class="item_content">
            <h3>타이탄의 분노</h3>
            <p class="explain">
              이제 인간이 신을 구할 차례다!타이탄에 맞서라! 제우스를 구하라!크라켄과의<br>
              전투를 승리로 이끈 반신반인 '페르세우스(샘...'
            </p>
            <p class="maker">
              조회수:25,063,278회 | 영상길이: 117초 | 등록된 시간: 19-08-19:20:20
            </p>
          </div>
        </div> -->
      </div>
    
  </div>
