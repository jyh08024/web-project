<?php require "view/header.php" ?>
    <link rel="stylesheet" href="resources/css/sub.css">

    <div class="section event_enr_section wrap">
      <div class="section_title">
        <p class="main_title">이벤트 리스트<span class="color">페이지</span></p>
        <p>이벤트리스트를 확인 가능한 페이지입니다.</p>
      </div>

      <div class="event_list flex alc js">
      <?php 
        $now = date('Y-m-d');
        $eventData = event::mq("SELECT * FROM event WHERE event_end > $now ORDER BY event_end DESC")->fetchAll();
        $endEvent = event::mq("SELECT * FROM event WHERE event_end < $now ORDER BY event_end ASC")->fetchAll();

        $eventList = array_merge($endEvent, $eventData);
      ?>

        <?php foreach ($eventList as $key => $v): ?>
        
        <div class="event_item flex alc jc" style="background: url('<?= $v['banner_img'] ?>') no-repeat; background-size: 100%, 100%;" onclick="eventDetail(`<?= $v['idx'] ?>`)" data-open="<?= $v['event_start'] ?>" data-close="<?= $v['event_end'] ?>">
          <div class="event_info">
            <h1 class="event_name">이벤트 명: <?= $v['event_name'] ?></h1>
            <h1>이벤트 기간: <?= $v['event_start'] ?> ~ <?= $v['event_end'] ?></h1>
            <h1 class="timer timer<?= $v['idx'] ?>">0일 00시간 00분 00초</h1>
          </div>
        </div>

        <script>
          
        </script>

        <?php endforeach ?>

      </div>
    </div>

    <?php require "view/footer.php"; ?>

