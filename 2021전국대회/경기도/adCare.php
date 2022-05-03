<?php require "view/header.php" ?>
    <link rel="stylesheet" href="resources/css/sub.css">

    <div class="section event_enr_section wrap">
      <div class="section_title">
        <p class="main_title">광고 관리<span class="color">페이지</span></p>
        <p>광고를 등록, 관리하는 페이지입니다.</p>
      </div>

      <div class="ad_enr flex alc jc">
        <form class="ad_enr_form form_style">
          <div class="form_title">
            <h2>광고 등록</h2>
          </div>

          <div class="ad_care form_inputs">
            <ul>
              <li><label for="ad_upload" class="btn">업로드</label></li>
              <li><input type="file" hidden="" name="ad_img" id="ad_upload" oninput="ajax('../app/adDB.php', ``, `ad_enr_form`, `배너가 업로드 되었습니다.`)"></li>
            </ul>
          </div>

          <div class="after_lin"></div>

          <h2>광고 배너 리스트</h2>

          <div class="ad_banner_list flex alc js">
            <?php $adData = ad::allData(); ?>
            <?php foreach ($adData as $key => $v): ?>
            <div>
              <img src="<?= $v['ad_img'] ?>" alt="adimg" title="adimg">
              <div class="del_ad" data-idx="<?= $v['idx'] ?>">
                <h1>X</h1>
              </div>
            </div>
            <?php endforeach ?>
          </div>
        </form>
      </div>
    </div>

    <?php require "view/footer.php"; ?>