<div class="section"></div>
  <div class="section"></div>
  <div class="section">
    <div class="wrap">
      <div class="section_title ani">
        <div>
          <h4 class="main_title"><span class="title_cont">예약내역</span>예약내역을 확인해보세요.</h4>
        </div>
      </div>

      <div class="section_content">
        <?php if (USER['type'] == "manager"): ?>
          <h2>예약내역</h2>

          <div class="board_top man_board_top">
            <div>방문날짜</div>
            <div>방문인원</div>
            <div>결제금액</div>
            <div>상태</div>
            <div>예약취소</div>
          </div>

          <div class="board_list">
            <?php foreach ($resList as $key => $v): ?>
              <?php $garden = garden::find('idx = ?', $v['garden']) ?>
            <div class="board_item man_board_item nor">
              <div><?= $v['date'] ?></div>
              <div><?= $v['count'] ?></div>
              <div><?= number_format($v['price']) ?></div>
              <div><?= $v['state'] ?></div>
              <div>
                <?php if ($v['state'] == "대기"): ?>
                  <form action="/post/ownerCancel" method="POST">
                    <input type="hidden" name="idx" value="<?= $v['idx'] ?>">
                    <input type="hidden" name="date" value="<?= $v['date'] ?>">
                    <div class="flex alc"><button class="btn">예약 취소</button></div>
                  </form>
                <?php endif ?>
              </div>
            </div>
            <?php endforeach ?>
          </div>

          <div class="after_line"></div>

          <div class="flex alc">
            <h2>예약불가 날짜 리스트</h2>
            <p style="margin-left: 1rem; font-size: 1.4rem;"><?= date("Y") ?>년 <?= date("m") ?>월</p>
          </div>

          <div class="after_line"></div>

          <div class="form_box">
            <div class="form_left">
              <div class="no_list">
                <?php foreach ($noList as $key => $v): ?>
                  <h3><?= $v['date'] ?></h3>
                <?php endforeach ?>
              </div>
            </div>
            <div class="form_right">
              <h2>예약관리</h2>
              <div class="after_line opa1"></div>

              <form action="/post/noRes" method="POST">
                <ul>
                  <li>날짜</li>
                  <li><input type="date" class="input" name="date" min="<?= date("Y-m-d") ?>" required></li>
                </ul>

                <input type="hidden" name="garden" value="<?= MANAGER['idx'] ?>">
                <div class="after_line opa1"></div>

                <button class="btn">저장</button>
              </form>
            </div>
          </div>
        <?php endif ?>

        <?php if (USER['type'] == "normal"): ?>
          <h2>예약내역</h2>

          <div class="board_top res_board_top">
            <div>방문날짜</div>
            <div>방문할 정원</div>
            <div>방문인원</div>
            <div>결제금액</div>
            <div>예약취소</div>
            <div>입장권 발권</div>
          </div>

          <div class="board_list">
            <?php foreach ($resList as $key => $v): ?>
              <?php $garden = garden::find('idx = ?', $v['garden']) ?>
            <div class="board_item res_board_item nor">
              <div><?= $v['date'] ?></div>
              <div><?= $garden['name'] ?></div>
              <div><?= $v['count'] ?></div>
              <div><?= number_format($v['price']) ?></div>
              <div>
                <form action="/post/cancel" method="POST">
                  <input type="hidden" value="<?= $v['date'] ?>" name="date">
                  <input type="hidden" value="<?= $v['idx'] ?>" name="idx">
                  <button class="btn">예약취소</button>
                </form>
              </div>
              <div><button class="btn">입장권 발권</button></div>
            </div>
            <?php endforeach ?>
          </div>

          <div class="after_line"></div>

          <h2>종료된 예약내역</h2>

          <div class="board_top res_board_top">
            <div>방문날짜</div>
            <div>방문한 정원</div>
            <div>방문인원</div>
            <div>결제금액</div>
            <div>방문여부</div>
            <div>후기작성</div>
          </div>

          <div class="board_list">
            <?php foreach ($endList as $key => $v): ?>
              <?php $garden = garden::find('idx = ?', $v['garden']) ?>
              <?php $revCk = review::find('res = ?', $v['idx']) ?>
            <div class="board_item res_board_item nor">
              <div><?= $v['date'] ?></div>
              <div><?= $garden['name'] ?></div>
              <div><?= $v['count'] ?></div>
              <div><?= number_format($v['price']) ?></div>
              <div><?= $v['state'] ?></div>
              <div>
                <button class="btn rev_btn" data-idx="<?= $v['idx'] ?>" onclick="revModal(<?= $v['idx'] ?>, <?= $garden['idx'] ?>)"
                style="<?= !$revCk && $v['state'] == "방문" ? "" : "opacity: 0; pointer-events:none;" ?>">후기 작성</button>
              </div>
            </div>
            <?php endforeach ?>
          </div>
        <?php endif ?>
      </div>
    </div>
  </div>