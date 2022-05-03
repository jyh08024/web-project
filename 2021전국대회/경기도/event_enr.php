<?php require "view/header.php" ?>
    <link rel="stylesheet" href="resources/css/sub.css">

    <?php $bakeryList = bakery_list::allData(); ?>

    <div class="section event_enr_section wrap">
      <div class="section_title">
        <p class="main_title">이벤트 등록<span class="color">페이지</span></p>
        <p>이벤트를 등록하는 페이지입니다.</p>
      </div>

      <div class="event_enr flex alc jc">
        <form class="event_enr_form">
          <h2>이벤트 등록</h2>
          
          <div class="event_input">
            <ul>
              <li><label for="">이벤트 기간</label></li>
              <li class="flex alc js event_time">
                <input type="date" class="input" name="event_start" min="<?= date('Y-m-d') ?>">
                <input type="date" class="input" name="event_end" min="<?= date('Y-m-d') ?>">
              </li>
            </ul>
            <ul>
              <li><label for="">이벤트 명</label></li>
              <li><input type="text" class="input" name="event_name" placeholder="이벤트 명을 입력해주세요."></li>
            </ul>
            <ul>
              <li><label for="">빵집 선택</label></li>
              <li class="bakery_check flex alc js">
                <?php foreach ($bakeryList as $key => $v): ?>
                  <label for="<?= $v['name'] ?>">
                    <?= $v['name'] ?>
                    <input type="checkbox" name="<?= $v['idx'] ?>" id="<?= $v['name'] ?>">
                  </label>
                <?php endforeach ?>
              </li>
            </ul>
            <ul>
              <li><label for="">배너 이미지 업로드</label></li>
              <li><input type="file" class="input" name="banner_img"></li>
            </ul>
          </div>

          <button class="btn event_enr" type="button" onclick="ajax(`../app/eventEnr.php`, ``, `event_enr_form`, `등록이 완료되었습니다.`)">이벤트 등록</button>
        </form>
      </div>
    </div>

    <?php require "view/footer.php"; ?>