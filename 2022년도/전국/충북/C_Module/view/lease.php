<div class="visual sub_visual flex alc pr">
    <div class="wrap flex js">
      <div class="vs_text">
        <p class="vs_top">비주얼</p>
        <p class="pr bold vs_main">이한메미술관</p>
        <div class="address">
          <p><i class="fa fa-map-marker"></i> 경상남도 가창군 북상면 소정리</p>
        </div>

        <p class="vs_cont">
          Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores atque, obcaecati libero sequi praesentium,
          voluptas perferendis ex corrupti molestias nemo eum sint adipisci, neque hic suscipit explicabo dicta ipsum
          cumque.
        </p>
      </div>
    </div>
    <img class="pa visual_back" src="resources/images/image13.jpg" alt="visual" title="visual">
  </div>

  <div style="padding-top: 6.2rem;">
    <div class="wrap">
      <div class="section_title sub_section_title pr">
        <p class="bold">임대등록</p>
      </div>

      <div class="section_content flex alc js">
        <div class="b_padding shadow" style="width: 44%">
          <h2>임대차계약</h2>

          <div class="after_line"></div>

          <form class="lease_form" action="/post/lease" method="POST">
            <ul>
              <li>작업실호수</li>
              <li><input type="text" class="input" name="room" readonly></li>
            </ul>
            <ul>
              <li>이름</li>
              <li><input type="text" class="input" name="name" value="<?= USER['name'] ?>" readonly></li>
            </ul>
            <ul>
              <li>임차기간</li>
              <li class="flex alc js">
                <input type="date" class="input" name="start" style="width: 48%;" min="<?= date("Y-m-d") ?>">
                <p>~</p>
                <input type="date" class="input" name="end" style="width: 48%;" min="<?= date("Y-m-d") ?>">
              </li>

              <div class="after_line"></div>

              <input type="hidden" name="build">

              <div class="flex alc">
                <button type="button" class="btn" style="margin-right: 1rem;" onclick="searchRoom()">조회</button>
                <button type="submit" class="btn enr_btn disable">등록</button>
              </div>
            </ul>
          </form>
        </div>

        <div class="b_padding shadow" style="width: 54%">
          <div>
            <h1 class="tlc">청년관</h1>

            <div class="after_line"></div>

            <div class="flex alc">
              <div>
                <div class="layout_box">
                  <?php foreach ($youthLayout as $key => $v): ?>
                    <?= $v ?>
                  <?php endforeach ?>
                </div>

                <p class="tlc" style="font-size: 2rem; padding: 1rem 0;">복도</p>
                
                <div class="layout_box">
                  <?php foreach (array_reverse($reverse) as $key => $v): ?>
                    <?= $v ?>
                  <?php endforeach ?>
                </div>
              </div>

            </div>
          </div>

          <div>
            <h1 class="tlc">미래관</h1>

            <div class="after_line"></div>
  
            <div class="flex alc">
              <div>
                <div class="layout_box">
                  <?php foreach ($futureLayout as $key => $v): ?>
                    <?= $v ?>
                  <?php endforeach ?>
                </div>
              
                <p class="tlc" style="font-size: 2rem; padding: 1rem 0;">복도</p>
              
                <div class="layout_box">
                  <?php foreach (array_reverse($futureRe) as $key => $v): ?> 
                    <?= $v ?>
                  <?php endforeach ?>
                </div>
              </div>

              <div class="layout_box" style="display: block;">
                <!-- <div style="height: 98.87px;" class="flex alc jc">107</div> -->
                <!-- <div style="height: 98.87px;" class="flex alc jc">108</div> -->
                <?php foreach ($fuVert as $key => $v): ?>
                  <?= $v ?>
                <?php endforeach ?>
              </div>
            </div>

          </div>

        </div>

      </div>
    </div>
  </div>