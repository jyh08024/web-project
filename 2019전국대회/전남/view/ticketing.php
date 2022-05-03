<div class="section"></div>

<div class="section wrap">
  <div class="section_title">
    <h2>BIFF<span class="color">TICKETING</span><span style="font-size: 1rem;">영화예매</span></h2>
    <p>한국 영화계의 축제, 영화예매 페이지</p>
  </div>

  <div class="ticketing">
    <div class="ticketing_sec">
      <div>
        <div class="sel_option day_sel ticketing_btn" style="grid-template-columns: repeat(5, 1fr)">

        </div>

        <div class="next_form flex alc" style="margin-top: 2rem">
          <ul class="flex alc">
            <li>좌석개수</li>
            <li><input type="number" class="input" id="seat"></li>
            <li><input type="hidden" class="select_movie"></li>
            <li><input type="hidden" class="max_seat"></li>
          </ul>

          <button class="btn sel_seat">다음</button>
        </div>

        <div class="after_line"></div>

        <div class="movie_list flex alc js">

        </div>
      </div>

      <div class="seat_select">
        <div class="section_top">
          <button class="btn payment_btn">결제하기</button>
        </div>

        <div class="seat_form flex js">
          <div class="seat_line">
            <h3>A</h3>
            <h3>B</h3>
            <h3>C</h3>
            <h3>D</h3>
            <h3>E</h3>
            <h3>F</h3>
            <h3>G</h3>
            <h3>H</h3>
            <h3>I</h3>
            <h3>J</h3>
            <h3>K</h3>
          </div>

          <div class="seat_box">
            <div class="seat_list">
              
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>

<script>
  let buttons = "";
  for (let i = 3; i <= 12; i++) {
    buttons += `<button data-type="day" data-value="${i}">10월 ${i}일</button>`
  }

  $(`.day_sel`).html(buttons);

  function makeSeat(seledSeat) {
    let seat = "";

    ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K"].map((v, i) => {
      seat += new Array(16).fill("").map((x, index) => {
        index += 1;
        const overlapCk = seledSeat.find(seat => seat.seat == v + index);

        return (v == "F" || v == "G") && (index <= 2 || index >= 15) ? `
          <div style=" border: none;">
            <div style="height: 32px;">

            </div>
          </div>
        ` : `
          <div style="${index == 4 || index == 12 ? "margin-right: 12px;" : ""} ${overlapCk ? "pointer-events: none; opacity: .7;" : ""}">
            <div>
              <p>${v}${index}</p>
              <input type="checkbox" class="seat_check" name="seat_list" value="${v}${index}" ${overlapCk ? "disabled" : ""}>
            </div>
          </div>
        `;
      })
    });

    $(`.seat_list`).html(seat.replaceAll(",", ""));
  }

  let nowDate = "";
  let disabled = [];

  $(document)
    .on(`click`, ".ticketing_btn button", (e) => {
      nowDate = $(e.currentTarget).data('value');
      $.post(`/post/ticketingData`, { day: nowDate }).done((res) => {
        $('.movie_list').html(res);
      });
    })
    .on(`click`, ".movie_item", (e) => {
      $(`.select_movie`).val("");
      $(`.movie_item`).css('border', "1px solid #ff2d31");

      $(`.select_movie`).val($(e.currentTarget).data('schedule'));
      $(`.max_seat`).val($(e.currentTarget).data('max'));
      $(e.currentTarget).css('border', "5px solid #ff2d31");
    })
    .on(`click`, ".sel_seat", (e) => {
      const valueCk = $(`#seat`).val().trim() == "" || $(`.select_movie` ).val().trim() == "" || $(`#seat`).val() <= 0 || $(`#seat`).val() * 1 > $(`.max_seat`).val() * 1;
      
      if (valueCk) {
        alert('영화를 고르고 올바른 좌석개수를 입력해주세요.');
        return;
      }

      $.post(`/html/seatList`, { schedule: $(`.select_movie`).val() }).done((res) => {
        disabled = res;
        makeSeat(res);
        $(`.ticketing_sec`).css('margin-left', '-100%');
      });
    })
    .on(`click`, ".payment_btn", (e) => {
      if ($(`.seat_check:checked`).length != $(`#seat`).val() * 1) {
        alert('입력한 좌석개수와 선택한 좌석개수가 일치하지 않습니다.')
        return;
      }

      const data = {
        "scheduleCode": $(`.select_movie`).val(),
        "cnt": $(`#seat`).val(),
        "state": "예매완료",
      };

      const seat = $(`.seat_check:checked`).toArray().map(v => {
        return $(v).val();
      });

      $.post(`/post/ticekting`, { "ticket": data, "seat": seat }).done((res) => {
        alert(res);
        location.href = '/ticketinfo';
      })
    })

    setInterval(() => {
      $.post(`/post/seatInfo`, { schedule: $(`.select_movie`).val() ?? "", day: nowDate }).done((res) => {
        if (!res.seat.length && !res.movie.length) {
          return;
        }

        if (JSON.stringify(disabled) != JSON.stringify(res.seat)) {
          makeSeat(res.seat);
        }

        res.movie.map((v, i) => {
          const movieItem = $(`.movie_item[data-schedule="${v.code}"]`);
          if (movieItem[0].dataset.max != v.seat) {
            movieItem.attr('data-max', v.seat);
            $(`.movie_item[data-schedule="${v.code}"] > .movie_info > h4:nth-child(6)`).html(`<span class="color">[남은좌석]</span>` + v.seat);
            $(`.max_seat`).val(v.seat);
          }
        })
      });
    }, 300);
</script>

<style>
  .movie_list {
    height: 36rem;
    overflow-y: scroll;
  }

  .movie_item {
    width: 100%;
    height: 18rem;
    padding: 1.2rem;
    border-radius: 20px;
    border: 1px solid #ff2d31;
    margin-bottom: 1rem;
  }

  .movie_img {
    width: 49%;
    height: 15rem;
  }

  .movie_img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .movie_info {
    width: 48%;
  }

  .movie_info h4 {
    margin-top: .3rem;
  }

  .ticketing {
    width: 100%;
    overflow: hidden;
  }

  .ticketing_sec {
    width: 200%;
    transition: .4s;
    display: flex;
    align-items: center;
  }

  .ticketing_sec > div {
    width: 50%;
  }

  .seat_form {
    margin-top: 2rem;
  }

  .seat_line {
    font-size: 1.4rem;
  }

  .seat_line h3 {
    margin-bottom: 1rem;
  }

  .seat_box {
    width: 97%;
    height: 100%;
  }

  .seat_list {
    width: 100%;
    height: 100%;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    /*display: grid;*/
    /*grid-template-columns: repeat(16, 1fr);*/
    /*grid-gap: .4rem;*/
  }

  .seat_list > div {
    width: 6%;
    height: 100%;
    border: 1px solid #000;
    margin-bottom: 7px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
</style>