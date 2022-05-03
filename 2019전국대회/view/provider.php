  <link rel="stylesheet" href="/resources/css/sub.css">

  <div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>영화 배급사</h1>
      </div>
      <div class="banner_img">
        <img src="/resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>

  <div class="prod_detail rap">

    <div class="pro_top rap">
      <div class="pro_info">
        <img src="<?= $userData['img'] ?>" alt="user" title="user">
        <div class="text_info">
          <h2><?= $userData['name'] ?></h2>
          <p>follower: <span class="color"><?= number_format($userData['follows']) ?></span></p>
        </div>
      </div>
      
      <div class="detail_btn">
        <label class="toggle">
          <input type="checkbox" class="follow" id="follow" value="<?= $userData['idx'] ?>">
          <span class="slider round"></span>
        </label>
        <label for="follow" class="is_follow">팔로우</label>
        <label for="follow" class="none_follow">팔로우 취소</label>
      </div>
    </div>

      <div class="pro_mini_title">
        <h3><?= $userData['name'] ?> | 영화목록</h3>

        <div class="sort_btn">
          <button class="wait_btn prov_movie_sort" data-idx="<?= $userData['idx'] ?>" data-type="ORDER BY view ASC">조회수 오름차순</button>
          <button class="wait_btn prov_movie_sort" data-idx="<?= $userData['idx'] ?>" data-type="ORDER BY view DESC">조회수 내림차순</button>
          <button class="wait_btn prov_movie_sort" data-idx="<?= $userData['idx'] ?>" data-type="ORDER BY date ASC">업로드 날짜 오름차순</button>
          <button class="wait_btn prov_movie_sort" data-idx="<?= $userData['idx'] ?>" data-type="ORDER BY date DESC">업로드 날짜 내림차순</button>
        </div>
      </div>
      
      <div class="pro_movie_list">

        <?php foreach ($data as $key => $v): ?>

        <div class="main_movie_item">
          <a href="/video/<?= $v['idx'] ?>"><div class="item_img">
            <img src="<?= $v['thumbnail'] ?>" alt="thumb" title="thumb">
          </div></a>
          <div class="item_content">
            <a href="/video/<?= $v['idx'] ?>"></a><h3><?= $v['title'] ?></h3>
            <p class="explain">
              <?= $v['description'] ?>
            </p>
            <p class="maker">
              조회수:<?= number_format($v['view']) ?>회 | 영상길이: <?= floor($v['duration']) ?> | 등록된 시간: <?= $v['date'] ?>
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
        </div> -->

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