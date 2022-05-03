// 디버깅 함수
const dd = console.log;
//로컬스토리지
const ls = localStorage;

let sugStore = false;
// 기본 객체
const App = {
  async init() {
    App.hook();
    Product.init();
    Cart.init();

    Buy.info = await $.post(`/getBuydata`);

    if (window.location.pathname.includes("admin")) {
      Table.init();
    }
  },

  hook() {
    $(document)
      .on(`click`, ".popup_close", Modal.close)
      .on(`input`, ".price_input", (e) => {
        const idx = $(e.target).data('idx');
        const val = $(e.target).val();
        const pro = Product.list.find(v => v.id == idx);

        const reg = /^[0-9]*$/;

        if (!reg.test(val)) {
          e.target.value = pro.cnt;
          return;
        }

        e.target.value = val;
        pro.cnt = val;
      })
      .on(`blur`, ".price_input", (e) => {
        const val = $(e.target).val() * 1;

        if (!val) {
          e.target.value = 1;
        }
      })
      .on(`click`, ".count_btn", (e) => Product.cntCon(e))
      .on(`click`, ".buy_open", Buy.open)
      .on(`input`, ".buy_form input[name='buy_day']", (e) => Buy.dayCk(e.target.value))
      .on(`submit`, ".buy_form", (e) => Buy.buyVali(e))
  }
}

// 상품 및 상품 개수 관리
const Product = {
  list: [],

  init() {
    Product.getData();
  },

  async getData() {
    $.ajaxSetup({
      'cache': false,
    });
    const data = await $.getJSON(`/resources/data/item.json`);

    Product.list = data.map(v => {
      v.cnt = 0;
      v.totalCost = 0;
      v.insertCnt = 1;
      v.calPrice = v.price.replace(",", "") * 1;
      return v;
    });

    Product.setList();
  },

  cntCon(e) {
    const num = $(e.currentTarget).data('count');
    const target = $(e.target).parent().parent().find(`.price_input`);

    const value = target.val() * 1 + num;

    if (value <= 0) {
      Toast.open('최소 구매 수량은 1개 입니다');
      return;
    }

    target.val(value);
  },

  setList() {
    $(`.product_list`).html(Product.list.map(v => Html.storeHtml(v)));
  }
}

// 장바구니 관리 객체
const Cart = {
  list: [],

  async init() {
    Cart.list = sugStore ? [] : await $.post('/post/cartData');
    Cart.refresh(Cart.list);
  },

  insert(id) {
    const overlap = Cart.list.find(v => v.id == id);
    const pro = overlap ? overlap : Product.list.find(v => v.id == id);
    let val = $(`.price_input[data-idx="${id}"]`).val() * 1;

    pro.cnt = pro.cnt * 1;
    pro.cnt += val;
    pro.insertCnt = val;
    pro.totalCost = (pro.cnt * 1) * (pro.calPrice * 1);

    if (!overlap) {
      Cart.list.unshift(pro);
    }

    Toast.open(overlap ? "추가 상품이 담겼습니다." : "장바구니에 담겼습니다.");
    if (!sugStore) {
      $.post(`/insertCart`, { list: Cart.list }).done((res) => {
      // ls['cart'] = JSON.stringify(Cart.list);
        Cart.refresh(Cart.list);
      })
    } else {
      Cart.refresh(Cart.list);
    }
  },

  refresh(list) {
    $(`.cart_list`).html(list.map(v => Html.cartHtml(v)));
  },
}

// 구매 기능 관리 객체
const Buy = {
  info: [],

  open() {
    if (!Cart.list.length) {
      alert('상품을 담아주세요.');
      return;
    }

    Modal.open('buy_popup');
  },

  buyVali(e) {
    e.preventDefault();
    const msg = {
      "buy_day": "배송일은 필수 입력 사항입니다.",
      "buy_time": "배송시간은 필수 입력 사항입니다.",
      "user_name": "구매자명은 필수 입력 사항입니다.",
      "user_call": "전화번호는 필수 입력 사항입니다.",
      "user_code": "우편번호는 필수 입력 사항입니다.",
      "user_ad": "주소는 필수 입력 사항입니다.",
      "user_detail_ad": "상세주소는 필수 입력 사항입니다."
    };

    const vali = [];

    $(`.buy_form`).find('input, select').toArray().forEach(x => {
      if ($.trim(x.value) == "") {
        vali.push(msg[x.name]);
      }
    });

    if (vali.length) {
      alert(vali.join("\n"));
      return;
    }

    if (!$(`.buy_form input[name="user_name"]`).val().match(/^[가-힣ㄱ-ㅎㅏ-ㅣ]{2,7}$/)) {
      vali.push("이름이 입력 조건에 일치하지 않습니다.");
    }

    if (!$(`.buy_form input[name="user_call"]`).val().match(/^\d{3}-\d{4}-\d{4}$/)) {
      vali.push("올바른 전화번호 형태는 000-0000-0000입니다.");
    }

    if (!$(`.buy_form input[name="user_code"]`).val().match(/^\d{5}$/)) {
      vali.push("우편번호는 5자리 숫자만 가능합니다.");
    }

    if (vali.length) {
      alert(vali.join("\n"));
      return;
    }

    Buy.buyComplete();
  },

  buyComplete() {
    const data = {};

    $(`.buy_form`).find('input, select').toArray().forEach(x => {
      data[x.name] = x.value;
    });

    const today = new Date();

    data['product'] = JSON.stringify(Cart.list);
    data['total'] = Cart.list.reduce((acc, val) => acc += val.totalCost * 1, 0);
    // data['buyTimestamp'] = today.getFullYear() + "-" + today.getMonth() + 1 + "-" + today.getDate();
    // data['timeStamp'] = data['buyTimestamp'] + " " + today.toLocaleTimeString();

    // ls['buy_info'] = JSON.stringify(Buy.info);

    $.post(`/post/buy`, { info: data }).done((res) => {
      Buy.info.push(data);
      alert('구매가 완료되었습니다.');

      setTimeout(() => {
        Cart.list = [];
        Cart.refresh([]);
        Modal.close();
      }, 10);
    })
  },

  dayCk(date) {
    const timeData = Buy.dateCk(date);
    $(`#buy_time_sel`).html(`<option hidden selected>배송시간을 선택해주세요.</option>`);

    const time = ["09:00", "11:00", "13:00", "15:00", "17:00"];

    $(`#buy_time_sel`).append(time.map(v => {
      const ck = timeData.find(x => x == v);

      return `<option value="${v}" ${ck ? 'disabled' : ""}>${v}</option>`;
    }));
  },

  dateCk: (date) => Buy.info.filter(v => v.buy_day == date).map(v => v.buy_time)
}

// 판매 통계 관리
const Table = {
  init() {
    const d = new Date();
    const day = d.getDate() - 7;
    const dateObj = new Array(7).fill({}).map((v, i) => {
      const date = new Date(new Date().setDate(day + i)).toISOString().split("T")[0];
      const total = Buy.info
        .filter(x => x.buyTimestamp.split(" ")[0] == date)
        .reduce((acc, val) => acc + val.total * 1, 0);
      
      return { [date]: total };
    });

    Table.graph(dateObj);
    Table.makeTable();
  },

  graph(data) {
    const c = $(`#graph_cv`)[0];
    const ctx = c.getContext('2d');

    const max = Math.max(...data.map(v => Object.values(v)));

    let x = 0;
    const ch = c.height - 10;

    const color = new Array(data.length).fill("#").map(v => v + Math.round(Math.random() * "0xffffff").toString(16));

    data.forEach((v, i) => {
      const key = Object.keys(v);
      const y = (v[key] / max) * ch - 10;

      ctx.beginPath();
      ctx.fillStyle = color[i];
      ctx.fillRect(x, ch + 10, 50, -y);

      ctx.fillStyle = "#ffa500";
      ctx.fillText(v[key].toLocaleString() + "원", x + 5, 550);
      ctx.fillText(key, x + 5, 530);
      ctx.closePath();

      x += (c.width / data.length);
    })
  },

  makeTable() {
    const data = [...Buy.info].sort((a, b) => a.buyTimestamp > b.buyTimestamp ? -1 : 1);
    $(`.order_static tbody`).html(data.map(v => Html.tableHtml(v)));
  }
}

// 토스트 메시지 관리
const Toast = {
  open(msg) {
    const id = new Date().getTime();
    $(`.toast`).append(`<div data-id="${id}">${msg}</div>`);

    let timer = setTimeout(() => {
      clearTimeout(timer);
      $(`.toast > div[data-id="${id}"]`).animate({
        bottom: "3%",
        opacity: ".2",
      }, 400, () => {
        $(`.toast > div[data-id="${id}"]`).remove();
      })
    }, 1500);
  }
}

// 모달  관리
const Modal = {
  open(target) {
    $(`body`).css('overflow', 'hidden');
    $(`.modal, #${target}`).addClass('open');
  },

  close() {
    $(`.popup:not(#buy_popup)`).find('input, select, textarea').val('');
    $(`#buy_popup input[name="buy_day"], #buy_popup select[name="buy_time"]`).val('');
    $(`body`).css('overflow', 'auto');
    $(`.modal, .popup`).removeClass('open');
  }
}

// 템플릿 관리
const Html = {
  storeHtml(v) {
    return `
      <div class="store_item">
          <h3><span class="color">[상품명]</span> ${v.product_name}</h3>
          <h4><span class="color">[정가]</span> ${v.price}원</h4>
          <h4><span class="color">[할인가]</span> ${v.price}원</h4>
          
          <input type="number" class="input price_input" min="1" value="1" data-idx="${v.id}">
          
          <div class="button_area">
            <button class="btn count_btn plus" data-count="1">더하기</button>
            <button class="btn count_btn minus" data-count="-1">빼기</button>
          </div>
          
          <button class="btn insert_btn" onclick="Cart.insert(${v.id})"><i class="fa fa-shopping-cart"></i> 장바구니</button>
        </div>
    `
  },

  cartHtml(v) {
    return `
      <div class="cart_item">
        <div>
          <p><span class="color bold">[담은 상품명]</span></p>
          <p>${v.product_name}</p>
        </div>
        <div>
          <p><span class="color bold">[담은 개수]</span></p>
          <p>${v.insertCnt}</p>
        </div>
        <div>
          <p><span class="color bold">[구매 개수]</span></p>
          <p>${v.cnt}</p>
        </div>
        <div>
          <p><span class="color bold">[정가]</span></p>
          <p>${v.price}</p>
        </div>
        <div>
          <p><span class="color bold">[할인가]</span></p>
          <p>${v.price}</p>
        </div>
        <div>
          <p><span class="color bold">[총 가격]</span></p>
          <p>${(v.totalCost * 1).toLocaleString()}</p>
        </div>
      </div>
    `
  },

  tableHtml(v) {
    dd(v)
    return JSON.parse(v.item).map(x => `
      <tr>
        <td>${v.user_name}</td>
        <td>${x.product_name} / ${(x.totalCost * 1).toLocaleString()} 원</td>
        <td>${x.cnt}개</td>
        <td>${v.buyTimestamp}</td>
      </tr>
    `)
  }
}

//페이지 로드 후 실행
$(() => {
  App.init();
})