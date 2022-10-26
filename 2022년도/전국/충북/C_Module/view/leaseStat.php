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
        <p class="bold">임대현황</p>
      </div>

      <div class="section_content layout_area">
        <div class="youth_area flex js" style="padding-bottom: 4rem;">
          <div class="drawing_box youth_draw">
            <h1 class="tlc">청년관</h1>
            
            <div class="after_line"></div>

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

          <div class="tlc">
            <h1>청년관 입주현황</h1>
          
            <div class="after_line"></div>
          
            <div class="stat_box">
              <div class="stat_top flex alc js tlc">
                <h4>색상</h4>
                <h4>호수</h4>
                <h4>이름</h4>
                <h4>임대기간</h4>
              </div>
            
              <div class="stat_list y_stat">

              </div>
            </div>
          </div>
        </div>

        <div class="future flex alc js" style="padding-bottom: 4rem;">
          <div class="drawing_box future_draw">
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

          <div class="tlc">
            <h1>미래관 입주현황</h1>
          
            <div class="after_line"></div>
          
            <div class="stat_box">
              <div class="stat_top flex alc js tlc">
                <h4>색상</h4>
                <h4>호수</h4>
                <h4>이름</h4>
                <h4>임대기간</h4>
              </div>
          
              <div class="stat_list f_stat">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(() => {
    setStat(<?= json_encode($youth) ?>, <?= json_encode($future) ?>);
  });
</script>