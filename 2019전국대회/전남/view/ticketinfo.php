<div class="section"></div>

<div class="section wrap">
  <div class="section_title">
    <h2>BIFF<span class="color">TICKETING</span><span style="font-size: 1rem;">예매내역</span></h2>
    <p>한국 영화계의 축제, 영화예매 정보</p>
  </div>

  <div class="section_content">
    <div class="section_content_title">
      <h1>예매내역</h1>
    </div>

    <div class="after_line"></div>

    <div class="ticketing_list">
      <?php foreach ($ticketInfo as $key => $v): ?>
        <div class="ticket_item flex alc js">
          <div class="ticket_info">
            <p><span class="color">[상영일]</span> <?= $v['day'] ?>일</p>
            <p><span class="color">[상영시간]</span> <?= $v['time'] ?>시</p>
          </div>
          <div class="ticket_info">
            <p><span class="color">[영화명]</span></p>
            <h3><?= $v['title'] ?></h3>
          </div>
          <div class="ticket_info">
            <p><span class="color">[상영관]</span> <?= $v['theater'] ?></p>
            <p><span class="color">[예매권]</span> <?= $v['cnt'] ?>매</p>
          </div>
          <div class="ticket_info">
            <p><span class="color">[상태]</span></p>
            <h3><?= $v['state'] ?></h3>
          </div>

          <?php if (USER['user_id'] == "admin"): ?>
						<div class="ticket_info">
						<p><span class="color">[예매한 회원 아이디]</span> <?= $v['user_id'] ?></p>
						<p><span class="color">[예매한 날짜와 시간]</span> <?= $v['timestamp'] ?></p>
					</div>
					<?php endif ?>
					<div class="ticket_info">
						<?php if (USER['user_id'] != "admin"): ?>
							<button class="btn" onclick='ticketInfo(<?= json_encode($v) ?>)'>자세히보기</button>
						<?php endif ?>
						<?php if ($v['state'] != "취소됨"): ?>
							<a href="/ticket/cancel/<?= $v['idx'] ?>" class="btn">취소하기</a>
						<?php endif ?>
          </div>
        </div>
      <?php endforeach ?>
    </div>

    <?php if (USER['user_id'] != "admin"): ?>
			

			<div class="after_line"></div>

			<div class="section_content_title">
				<h1>자세히보기</h1>
			</div>

			<div class="after_line"></div>

			<div class="ticketing_list ticket_detail_list">
				
			</div>
		<?php endif ?>
  </div>
</div>

<style>
  .ticketing_list {
    width: 100%;
    height: 20rem;
    overflow-y: scroll;
  }

  .ticket_item {
    margin-bottom: .7rem;
    width: 100%;
    padding: 2rem;
    border: 1px solid #ff2d31;
  }
</style>

<script>
  const ticketInfo = (ticket) => {
    $.post(`/data/ticket/detail`, { data: ticket }).done((res) => {
      $(`.ticket_detail_list`).html(res.seat.map(v => {
        const seatText = `${v.seat.split("")[0]}열${v.seat.split("")[1]}번`;
        return `
					<div class="ticket_item flex alc js">
						<div class="ticket_info">
							<p><span class="color">[상영일]</span> ${res.day}일</p>
							<p><span class="color">[상영시간]</span> ${res.time}</p>
						</div>
						<div class="ticket_info">
							<p><span class="color">[영화명]</span></p>
							<h3>${res.title}</h3>
						</div>
						<div class="ticket_info">
							<p><span class="color">[상영관]</span> ${res.theater}</p>
							<p><span class="color">[좌석]</span> ${seatText}</p>
						</div>
						<div class="ticket_info">
							<label for="ticket_view" class="btn" onclick='ticketCheck(${JSON.stringify(res)}, ${JSON.stringify(v)})' style="${res.state == "취소됨" ? "display:none;" : ""}">예매권확인</label>
						</div>
					</div>
				`;
      }))
    })
  }

  const ticketCheck = (data, seat) => {
    const c = $(`#ticket_cv`)[0];
    const ctx = c.getContext('2d');

    ctx.clearRect(0, 0, c.width, c.height);

    ctx.fillStyle = "#ff2d31";
    ctx.fillRect(0, 0, c.width, c.height);

    ctx.beginPath();
      ctx.font = "bold 48px Microsoft Phagspa";
      ctx.fillStyle = "#fff";

      ctx.fillText("TICKET", 20, 60);
      ctx.font = "13px arial";
      ctx.fillText('영화명', 20, 110);
      ctx.fillText('상영일시', 20, 180);
      ctx.fillText('상영관', 20, 240);
      ctx.fillText('좌석', 250, 240);

      ctx.fillText(data.title, 20, 135);
      ctx.fillText("10월 " + data.day + "일" + data.time, 20, 200);
			ctx.fillText(data.theater, 80, 240);
			ctx.fillText(`${seat.seat.split("")[0]}열${seat.seat.split("")[1]}번`, 290, 240);
		ctx.closePath();
  }

  const downloadTicket = () => {
    const c = $(`#ticket_cv`)[0];
		const download = $(`<a href="${c.toDataURL()}" download="ticket.png"></a>`);
		download[0].click();
		download.remove();
  }
</script>