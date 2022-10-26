  <div class="section"></div>
  <div class="section"></div>
  <div class="section">
    <div class="wrap">
      <div class="flex alc js">
        <div class="section_title ani">
          <div>
            <h4 class="main_title"><span class="title_cont">정원 상세보기</span><?= $garden['name'] ?>.</h4>
          </div>
        </div>

        <div>
          <button class="btn" onclick="Pano.init()">파노라마</button><a style="margin-left: .5rem;"  href="/res/<?= $garden['idx'] ?>" class="btn">예약 바로가기</a>
        </div>
      </div>

      <div class="section_content garden_detail flex alc js">
        <div>
          <img src="/resources/민간정원/<?= $garden['name'] ?>2.jpg" alt="garden" title="garden">
        </div>
        <div class="detail_t">
          <p><span class="bold">정원 이름</span>: <?= $garden['name'] ?></p>
          <p><span class="bold">정원 주소</span>: <?= $garden['address'] ?></p>
          <p><span class="bold">연락처</span>: <?= $garden['phone'] ?></p>
          <p><span class="bold">관리기관</span>: <?= $garden['name'] ?></p>
          <p style="display: block;">
            <span class="bold">정원 소개</span>
            <br>
            <?= $garden['introduce'] ?>
          </p>
          <div class="detail_img">
            <img src="/resources/민간정원/<?= $garden['name'] ?>1.jpg" alt="garden" title="garden">
            <img src="/resources/민간정원/<?= $garden['name'] ?>2.jpg" alt="garden" title="garden">
            <img src="/resources/민간정원/<?= $garden['name'] ?>3.jpg" alt="garden" title="garden">
          </div>
        </div>
      </div>

      <div class="section_content">
        <h2>후기목록</h2>

        <div class="after_line"></div>

        <div class="review_list">
          <?php foreach ($review as $key => $v): ?>   
            <?php $images = image::findAll('owner_idx = ? && type = ?', [$v['idx'], "review"]) ?>
            <?php $user = user::find('idx = ?', $v['user']) ?>
          <div class="review_item">
            <div class="review_img">
              <?php foreach ($images as $key => $img): ?>
              <img src="<?= $img['src'] ?>" alt="review" title="review">
              <?php endforeach ?>
            </div>

            <div class="review_cont">
              <h2><?= $garden['name'] ?></h2>
              <p><?= mb_strlen($v['content']) > 25 ? substr($v['content'], 0, 25)."···" : $v['content'] ?></p>
              <div class="left">
                <div class="btn tlc" style="width: 30%; padding: .4rem 1.2rem;">자세히보기</div>
              </div>
  
              <div class="bottom">
                <div class="flex alc">
                  <p>별점: <?= $v['score'] ?>점</p>
                  <div class="star">
                    <p class="emp_star">☆☆☆☆☆</p>
                    <p class="full_star" style="width: calc(10% * <?= $v['score'] ?>);">★★★★★</p>
                  </div>
                </div>
  
                <div class="user flex alc">
                  <div class="user_img">
                    <img src="resources/img/캐릭터/2.jpg" alt="user" title="user">
                  </div>
                  <p><?= $user['name'] ?>(<?= $user['id'] ?>)</p>
                </div>
              </div>
            </div>
          </div>  
                
          <?php endforeach ?>
        </div>
      </div>
    </div>
  </div>
