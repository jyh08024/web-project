  <div class="page_top" style="height: 250px;">
    <h1>이벤트 관리</h1>
  </div>

  <div class="form section wrap flex alc js">
    <form action="/search" method="POST">
      <input type="date" name="date" class="input" style="width: 70%;" value="<?= $date ?>" required>
      <button class="btn">조회</button>
    </form>

    <div class="after_line wrap"></div>
  </div>

  <div class="wrap">
    <div class="event_list">
      <?php if (!count($data)): ?>
        <h2>이벤트 참여 정보가 없습니다.</h2>
      <?php endif ?>
      <?php foreach ($data as $key => $v): ?>
        
      <div class="event_item" style="<?= $v['dur'] == 3 ? "background: #303030; color: #2eb792;" : "" ?>">
        <div class="e_title flex alc js">
          <div>
            <h2>이름 : <?= $v['name'] ?></h2>
            <p>휴대폰번호 : <?= $v['phone'] ?></p>
          </div>

          <p>점수(찾은 카드 수) : <span class="color"><?= $v['score'] ?></span>개</p>
        </div>

        <div class="after_line"></div>

        <div class="item_cont flex alc js">
          <img class="st resImg" src="/resources/stamp.png" alt="stamp" title="stamp">
          <div>
            <h3>참여일 : <?= $v['date'] ?></h3>
            <h3>연속출석일수 : <?= $v['dur'] ?>일</h3>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    </div>
    
  </div>

  <style>
    .event_list {
      width: 100%;
      height: 100%;
      display: grid;
      grid-gap: 1.2rem;
      grid-template-columns: repeat(3, 1fr);
    }

    .event_item {
      width: 100%;
      height: 100%;
      box-shadow: 0 0 70px rgba(0, 0, 0, .15);
      border: 1px solid rgba(0, 0, 0, .1);
      padding: 2rem;
      border-radius: 20px;
      overflow: hidden;
    }

    .st {
      width: 180px;
      height: 180px;
    }
  </style>
