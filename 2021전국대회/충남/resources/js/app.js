const dd = console.log;

const ls = localStorage;

const setOffset = (offset, targets) => {
  const len = targets.length

  targets.map((i, v) => {
    $(v).css({
      position: 'absolute',
      left: offset.left + (len - i) * 20,
      top: offset.top + (len - i) * 20
    });
  })
}

const callForm = (call) => {
  let val = call.value.replace(/[^0-9]/g, "");

  if (val.length > 11) {
    val = val.slice(0, 11);
  }

  let repVal = val.replace(/^(\d{2,3})(\d{3,4})(\d{4})$/, "$1-$2-$3");

  call.value = repVal;
}

const ajax = (url, form) => {
  const formData = new FormData($(`${form}`)[0]);

  if (form == ".join_form") {
    formData.append('id_ck', App.idCk);
  }

  $.ajax({
    url: `${url}`,
    contentType: false,
    processData: false,
    data: formData,
    type: "post",
  }).done((e) => {
    const res = JSON.parse(e);
    let msg = "";

    switch (res.type) {
      case "join":
        if (res.err) {
          res.msg.map(v => {
            msg += v + "\n";
          });

          return alert(msg);
        }

        if (!res.err) {
          alert(res.msg);
          Modal.close();
          Modal.open('login_popup');
        }
        break;
      
        case "login":
          if (res.err) {
            return alert(res.msg);
          }

          if (!res.err) {
            alert(res.msg);
            Modal.close();

            $("#page_header").load(`${window.location.href} #page_header`, (response, status, xhr) => {
              $("#page_header").html($("#page_header").html().replace(`<header id="page_header">`, "").replace(`</header>`, ""))
            });
          }
          break;

        case "review":
          if (res.vali) {
            alert(res.vali);
            return;
          }

          dd(res);
          alert(res.msg);
          Modal.close();
          $(`.btn[data-idx="${res.order_index}"]`).attr('disabled', 'true').css('opacity', '.7');
          break;
    }
    
  });
}

const App = {
  bakerData: [],
  idCk: true,

  init() {
    App.hook();
    BakerMap.init();
    App.getData();
    KeyPad.init();
  },

  hook() {
    $(document)
      .on(`click`, ".modal_close", Modal.close)
      .on(`click`, ".join_btn", () => Modal.open('join_popup'))
      .on(`input`, ".star_change", function(e) {
        $(e.target).closest('span').find('.star_on').css('width', `${10 * e.target.value}%`);
      })
      .on(`submit`, ".review_form", function(e) {
        e.preventDefault();
        ajax('/post/reviewEnr', '.review_form');
      })
  },
  
  async getData() {
    App.bakerData = await $.post(`/getBaker`);
    StList.menuList = await $.post('/getMenu');

    if (window.location.pathname.includes("storeList")) {
      StList.init();
    }

    if (window.location.pathname.includes("detail")) {
      ViewPage.init();
    }

    if (window.location.pathname.includes("basket") || window.location.pathname.includes("order")) {
      Basket.init();
    }
  },

  async idOverlap() {
    $.post(`/post/idCk`, { id: $(`#user_id`).val() }).done((e) => {
      const res = JSON.parse(e);

      if (res.err) {
        $(`.overlap`).html(res.msg);
        $(`.overlap`).css('color', '#d62527');

        App.idCk = true;
      } else {
        $(`.overlap`).html(res.msg);
        $(`.overlap`).css('color', 'green');

        App.idCk = false;
      }
    })
  }
}

const BakerMap = {
  locData: [],
  nowTool: "",
  mouseHold: false,
  color: "#000",
  mag: 1,
  zoom: 1,
  mousePos: {
    x: 0,
    y: 0,
  },

  init() {
    BakerMap.getData();
    BakerMap.hook();
  },

  async getData() {
    BakerMap.locData = await $.getJSON('/resources/json/location.json');
  },

  hook() {
    $(document)
      // 모달 열고 지도 그림
      .on(`click`, ".show_baker_map", function (e) {
        Modal.open('map_popup');
        BakerMap.drawMap();
      })

      //버튼 박스 선택
      .on(`click`, ".button_box", function (e) {
        const type = $(e.target).data('type');

        if (!type) {
          return;
        }

        BakerMap.nowTool = type;

        if (type == "draw_line") {
          $(`.color_picker`).css('display', "block");
          $(`.font_size_set`).css('display', "none");
          $(`.text_able`).remove();
        }

        if (type == "write_text") {
          $(`.font_size_set`).css('display', "block");
          $(`.color_picker`).css('display', "none");
        }

        if ($(e.target).attr('class') == "button_box" && (type == "enlarge" || type == "reduce")) {
          BakerMap.event(e);
        }
      })

      //지도에 마우스 여부 판단
      .on(`mousedown`, "#draw_cv", function (e) {
        BakerMap.mouseHold = true;
      })

      //마우스 이벤트 총관리
      .on('mousedown mousemove mouseup mouseout', `#draw_cv`, BakerMap.event)

      .on(`mousedown mousemove mouseup mouseout`, ".baker_map_div", BakerMap.move)
      //색깔 변경
      .on(`change`, "#line_color", function () {
        BakerMap.color = $(this).val();
      })

      //텍스트 관리
      .on(`click`, "#draw_cv", function (e) {
        if (BakerMap.nowTool == "write_text") {
          $(`.text_able`).remove();

          $(`.baker_map_div`).append(`
            <div class="text_able" style="position: absolute; z-index: 8; top: ${e.offsetY}px; left: ${e.offsetX}px;">
              <input type="text" id="cv_text">
            </div>
          `)

          BakerMap.inputPos = [e.offsetX, e.offsetY];
        }
      })

      //글씨 적용
      .on(`focusout`, "#cv_text", function () {
        BakerMap.writeText($(this).val());
      })

      .on(`click`, ".share_map", function () {
        let newWindow = window.open(``, "", "width = 970, height = 800");
        const map = $(`#map_cv`)[0].toDataURL();
        const draw = $(`#draw_cv`)[0].toDataURL();

        newWindow.postMessage({ "map": map, "draw": draw, "zoom": BakerMap.mag, "pos": BakerMap.mousePos });

        newWindow.addEventListener('message', function (e) {
          const body = $(e.path[0].document).find('body');
          const imgset = $(`
          <div>
            <img src="${e.data.draw}" style="z-index: 99; position:absolute; transform: scale(${e.data.zoom}); top: ${e.data.pos.y * -1}px; left: ${e.data.pos.x * -1}px;">
            <img src="${e.data.map}" style="position:absolute; transform: scale(${e.data.zoom}); top: ${e.data.pos.y * -1}px; left: ${e.data.pos.x * -1}px;">
          </div>
          `).css({
            "position": "relative",
            "overflow": "hidden",
            "width": "900px",
            "height": "650px",
          })

          body.append(imgset).append(`<input type="text" class="input">`).append(`<button class="btn">공유하기</button>`);
        });
      })
  },

  drawMap() {
    const c = $(`#map_cv`)[0];
    const ctx = c.getContext('2d');

    const img = new Image();
    const pin = new Image();

    img.onload = (e) => {
      ctx.drawImage(img, 0, 0);

      pin.onload = (e) => {
        BakerMap.locData.forEach(v => {
          ctx.drawImage(e.target, v.X, v.Y, 15, 30);
        });
      }

      pin.src = `/resources/위치아이콘.png`;
    }

    img.src = `/resources/map.jpg`;
  },

  event(e) {
    switch (BakerMap.nowTool) {
      case "draw_line":
        BakerMap.drawLine(e);
        break;

      case "enlarge":
        if (e.type != "click") {
          return;
        }
        BakerMap.controlMag(BakerMap.nowTool, .1);
        break;

      case "reduce":
        if (e.type != "click") {
          return;
        }
        BakerMap.controlMag(BakerMap.nowTool, -.1);
        break;
    }
  },

  drawLine(e) {
    const ctx = $(`#draw_cv`)[0].getContext('2d');

    if (e.type == "mousedown") {
      BakerMap.pos = [e.offsetX, e.offsetY];
    }

    if (e.type == "mouseup" || e.type == "mouseout") {
      BakerMap.mouseHold = false;
    }

    if (e.type == "mousemove" && BakerMap.mouseHold) {
      let x = e.offsetX;
      let y = e.offsetY;

      ctx.strokeStyle = BakerMap.color;
      ctx.lineJoin = "round";
      ctx.lineCap = "round";
      ctx.lineWidth = 2;

      ctx.beginPath();
      ctx.moveTo(...BakerMap.pos);
      ctx.lineTo(x, y);
      ctx.stroke();
      ctx.closePath();

      BakerMap.pos = [x, y];
    }
  },

  writeText(text) {
    const ctx = $(`#draw_cv`)[0].getContext('2d');

    ctx.fillStyle = "#000";
    ctx.font = `${$(`#font-size`).val()}px Malgun Gothic`;

    ctx.beginPath();
    ctx.fillText(text, ...BakerMap.inputPos);
    ctx.closePath();
  },

  controlMag(type, num) {
    if ((type == "enlarge" && BakerMap.mag > 2) || (type == "reduce" && BakerMap.mag <= 1)) {
      return;
    }

    BakerMap.mag = BakerMap.mag + num;
    BakerMap.zoom = BakerMap.zoom + num * 10;

    $(`.baker_map_div canvas`).css({
      transform: `scale(${BakerMap.mag})`,
    });

    BakerMap.overflowCk();
    $(`.mag`).html(`<div>${Math.floor(BakerMap.mag * 100)}%</div>`)
  },

  move(e) {
    if (BakerMap.nowTool != "mouse_move") {
      return;
    }

    if (e.type == "mousedown") {
      BakerMap.movePrev = { x: e.offsetX, y: e.offsetY };
    }

    if (e.type == "mouseout" || e.type == "mouseup") {
      BakerMap.mouseHold = false;
    }

    if (BakerMap.mouseHold && BakerMap.mag > 1 && e.type == "mousemove") {
      BakerMap.mousePos.x += BakerMap.movePrev.x - e.offsetX;
      BakerMap.mousePos.y += BakerMap.movePrev.y - e.offsetY;

      BakerMap.movePrev = { x: e.offsetX, y: e.offsetY };

      BakerMap.overflowCk();
    }
  },

  overflowCk() {
    if (-BakerMap.mousePos.x > 44 * (BakerMap.zoom - 1)) {
      BakerMap.mousePos.x = -44 * (BakerMap.zoom - 1);
    }

    if (-BakerMap.mousePos.y > 31 * (BakerMap.zoom - 1)) {
      BakerMap.mousePos.y = -31 * (BakerMap.zoom - 1);
    }

    if (-BakerMap.mousePos.x < -44 * (BakerMap.zoom - 1)) {
      BakerMap.mousePos.x = 44 * (BakerMap.zoom - 1);
    }

    if (-BakerMap.mousePos.y < -31 * (BakerMap.zoom - 1)) {
      BakerMap.mousePos.y = 31 * (BakerMap.zoom - 1);
    }

    $(`.baker_map_div canvas`).css({ left: -BakerMap.mousePos.x, top: -BakerMap.mousePos.y })
  },
}

const StList = {
  menuList: [],
  clones: [],

  init() {
    StList.hook();
    StList.setBaker();
    StList.setMenuList(StList.menuList);
    Cart.init();
  },

  hook() {
    $(document)
      .on(`click`, ".view_only_pro", StList.targetMenu)
      .on(`click`, ".move_view_page", function(e) {
        const menuName = $(e.target).data('name');
        location.href = `/detail/${menuName}`;
      })
  },

  setBaker() {
    $(`.baker_list`).html(App.bakerData.map(v => Html.bakerListHtml(v)));
  },

  targetMenu(e) {
    const name = $(e.target).data('name');
    const data = StList.menuList.filter(v => v.name == name);

    StList.setMenuList(data);
  },

  setMenuList(data) {
    $(`.product_list`).html(data.map(v => Html.productItem(v)));
    $(`.drag_item`).draggable({
      revert: true,
      zIndex: 99999,
      helper: `clone`,

      start(e, ui) {
        $('.cloneItems').remove();

        if (!$(ui.helper).hasClass('selItems') && (Cart.selItems.length >= 5 || !Cart.keyPress)) {
          return alert('잘못된 선택입니다');
        }

        if (!$(ui.helper).hasClass('selItems') && Cart.selItems.length <= 4 && Cart.keyPress) {
          $(e.target).addClass('selItems');
          $(ui.helper).addClass('selItems');
          Cart.selItems.push($(e.target));
        }

        const selItems = $('.selItems:not(.ui-draggable-dragging)')
          .not(`[data-name='${$(ui.helper).data('name')}']`)
          .not(`.cart_item`)
          .clone()
          .addClass('cloneItems');

        setOffset(ui.offset, selItems);

        $('body').append(selItems);

        $(ui.helper).off().on('mouseup', function() {
          $('.cloneItems').remove();
        })
      },

      drag(e, ui) {
        setOffset(ui.offset, $(`.cloneItems:not([data-name='${$(ui.helper).data('name')}'])`));
      },
    });
  }
}

const Cart = {
  cartList: new Map(),
  keyPress: false,
  selItems: [],
  cartSel: [],
  cartOver: false,

  init() {
    Cart.hook();
  },

  hook() {
    $(document)
      .on(`keydown keyup`, "body", function(e) {
        switch (e.originalEvent.type) {
          case "keydown":
            if (e.originalEvent.keyCode == 16) {
              Cart.keyPress = true;
            }
            break;

          case "keyup":
              Cart.keyPress = false;
            break;
        }
      })

      .on(`click`, ".product_item", (e) => Cart.selItem(e, "product"))

      .on(`click`, ".cart_item", (e) => Cart.selItem(e, "cart"))

      .on(`mouseover mouseleave`, ".cart_box", function(e) {
        Cart.cartOver = e.type == "mouseleave" ? false : true;
      })

      .on(`mouseover mouseleave`, ".cart_item", function(e) {
        if ($(e.target).hasClass('selItems')) {
          Cart.cartOver = e.type == "mouseleave" ? false : true;
        }
      })
      
      $(`.cart_drop`).droppable({
        drop(e, ui) {
          if (!$(ui.helper).attr('class').includes("product_item")) {
            return;
          }

          let cartCk = 0;

          Cart.selItems.forEach(v => {
            const itemName = v.data('name');
            const itemInfo = StList.menuList.find(v => v.menuname == itemName);
            const itemCk = Cart.cartList.get(itemInfo.menuname);

            if (itemCk) {
              cartCk ++;
            }

            if (!itemCk) {
              Cart.cartList.set(itemInfo.menuname, itemInfo);
            }
          })
          
          Cart.setCart([...Cart.cartList.values()].reverse(), cartCk);
        }
      })
  },

  selItem(e, type) {
    if (!Cart.keyPress) {
      return;
    }

    const targetArr = type == "product" ? Cart.selItems : Cart.cartSel;

    if (targetArr.length >= 5) {
      return alert('한번에 선택가능한 수량은 최대 5개입니다.');
    }

    const target = $(e.currentTarget);

    const arrCk = targetArr.find(v => $(v).data('name') == target.data('name'));

    if (arrCk) {
      return alert('이미 선택된 상품입니다');
    }

    target.addClass('selItems');

    targetArr.push(target);
  },

  setCart(data, ck) {
    if (ck > 0) {
      alert(`${ck}개의 중복된 상품을 제외하고 상품이 찜하기에 추가되었습니다.`);
    } else {
      alert(`${Cart.selItems.length}개의 상품이 찜하기에 추가되었습니다.`);
    }

    $(`.cart_list`).html(data.map(v => Html.cartItem(v)));

    Cart.cartSel.map(v => {
      $(`.cart_item[data-name="${v.data('name')}"]`).addClass('selItems')
    });

    $(`.cart_item`).draggable({
      revert: true,
      zIndex: 99999,
      helper: `clone`,
    })

    $(`body`).droppable({
      drop(e, ui) {
        if (!$(ui.helper).attr('class').includes("cart_item") || Cart.cartOver) {
          return;
        }

        Cart.cartSel.forEach(v => {
          const itemName = v.data('name');
          Cart.cartList.delete(itemName);

          $(`.cart_item[data-name="${itemName}"]`).remove();
        })
      }
    })

    Cart.selItems = [];
    $(`.product_item`).removeClass('selItems');
  }
}

const ViewPage = {
  basket: [],
  revLength: 5,

  async init() {
    const url = location.pathname.split("/");

    ViewPage.pageMenu = StList.menuList.find(v => v.idx == url[url.length - 1]);
    ViewPage.reviewList = await $.post('/get/review', { idx: url[url.length - 1] });

    ViewPage.pageMenu.totalPrice = 0;
    ViewPage.pageMenu.count = 0;

    ViewPage.hook();
    ViewPage.setPage(ViewPage.pageMenu);
    ViewPage.setReview(ViewPage.reviewList);
  },

  hook() {
    $(document)
      .on(`input`, ".bread_count", function(e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');

        ViewPage.pageMenu.count = e.target.value;
        ViewPage.pageMenu.totalPrice = ViewPage.pageMenu.count * ViewPage.pageMenu.price;
        $(`.total_price`).html(ViewPage.pageMenu.totalPrice);
      })
      .on(`click`, ".more_review", function(e) {
        ViewPage.revLength = ViewPage.revLength + 5;

        if (ViewPage.revLength >= ViewPage.reviewList.length) {
          ViewPage.revLength = ViewPage.reviewList.length;
          $(`.more_review`).remove();
        }

        ViewPage.setReview(ViewPage.reviewList);
      })
  },

  insertCart() {
    if (ViewPage.pageMenu.totalPrice <= 0 || ViewPage.pageMenu.count <= 0) {
      return alert('수량을 1 이상 입력해주세요');
    }

    $.post('/post/insertBasket', { data: ViewPage.pageMenu }).done((e) => {
      alert('상품이 장바구니에 담겼습니다');
      location.href = '/basket';
    });
  },

  setPage(data) {
    $(`.target_bread_info`).html(`
      <div class="target_bread_img">
        <img src="/resources/빵메뉴/${data.image}" alt="bread" title="bread">
      </div>

      <div class="target_bread_detail">
        <h3 class="color">BREAD<h3>

        <div class="target_bread_main">
          <h1>${data.name}</h1>
          <h1>${data.menuname}</h1>

          <p>빵설명: ${data.etc}</p>

          <div class="target_bread_ex">
          <h1>${(data.price * 1).toLocaleString()}원</h1>
          <p>유통기한: ${data.shelf}<br>
          보관방법: ${data.keep}<br>
          영엽시간: ${data.time}</p>
          </div>

          <div class="after_line"></div>

          <div class="target_bread_res flex alc js" style="width: 550px;">
            <input type="number" class="input bread_count" placeholder="수량" style="width: 50%;" min="0">
            <div class="flex alc">
              <button class="btn insert_cart" onclick="ViewPage.insertCart()">장바구니담기</button>
              <a href="/order" class="btn">바로예약</a>
            </div>

          </div>
            <h3>총상품금액: <span class="total_price">0</span>원</h3>
        </div>
      </div>
    `)
  },

  setReview(data) {
    const viewData = [...data].splice(0, ViewPage.revLength);

    $(`.detail_review`).html(viewData.map(v => {
      return `<div class="detail_review_item">
        <div class="writer_info flex alc js">
          <div class="flex alc">
            
            <div class="writer_img">
              <i class="fa fa-user"></i>
            </div>
            <div class="writer_name">
              <h4><span class="color">[작성자]</span> ${v.user_info == "member" ? v.user_name : v.writer}</h4>
            </div>
          </div>

          <h3><span class="color">★</span>${v.rev_grade}점</h3>
        </div>

        <div class="after_line"></div>

        <div class="rev_content">
          <div>
            <h3>리뷰내용</h3>
            <h4>${v.review_con}</h4>
          </div>
        </div>
      </div>`
    }))
   }
}

const Basket = {
  basketList: [],

  async init() {
    Basket.basketList = await $.post(`/getBasket`);
    
    Basket.hook();
    Basket.setBasket();
  },

  save() {
    ls['basket'] = JSON.stringify(Basket.basketList);
  },

  hook() {
    $(document)
      .on(`input`, ".basket_count", function (e) {
        e.target.value = e.target.value.replace(/[^0-9]/g, '');
        const dataName = $(e.target).data('name');

        const targetData = Basket.basketList.find(v => v.menuname == dataName);

        targetData.count = e.target.value;
        targetData.subtotal = targetData.price * targetData.count;

        $(`.subtotal`)
        Basket.setPrice(targetData);
        Basket.save();
      })
  },

  setBasket() {
    $(`.basket_list`).html(Basket.basketList.map(v => Html.basketHtml(v)));
    Basket.setPrice();
  },

  setPrice(data = "") {
    Basket.totalOrderPrice = Basket.basketList.reduce((acc, val) => {
      return acc += val.subtotal * 1;
    }, 0);

    $(`.total_count_price`).html(`${Basket.totalOrderPrice.toLocaleString()}원`);
    
    if (data) {
      $(`.subtotal[data-name="${data.menuname}"]`).html(`${data.subtotal.toLocaleString()}원`);
    }
  }
}

const KeyPad = {
  init() {
    KeyPad.hook();
  },

  hook() {
    let over = false;
    let reset = false;

    $(document)
      .on(`focus`, ".code_input, .key_pad", function(e) {
        $(`.key_pad`).css('display', 'flex');

        if (!reset) {
          KeyPad.setPad();
          reset = true;
        }
      })
      
      .on(`mouseover mouseleave`, ".key_pad", function(e) {
        over = e.type == "mouseleave" ? false : true;
        reset = e.type == "mouseleave" ? false : true;
      })

      .on(`blur`, ".code_input", function(e) {
        if (over) {
          $(`.code_input`).focus();
          return;
        }

        $(`.key_pad`).css('display', 'none');
        reset = false;
      })

      .on(`click`, ".key_pad_key > div", function(e) {
        const nowVal = $(`.code_input`).val();

        if (nowVal.length >= 6) {
          return;
        }

        const addVal = $(e.target).data('key');
        const resVal = nowVal + addVal;

        $(`.code_input`).val(resVal);
      })

      .on(`click`, ".key_pad_control div button", KeyPad.control)
  },

  control(e) {
    const type = $(e.target).data('type');
    switch (type) {
      case "back":
        const befVal = $(`.code_input`).val();
        const val = befVal.slice(0, befVal.length - 1);

        $(`.code_input`).val(val);
        break;

      case "reset":
        KeyPad.setPad();
        break;
     }
  },

  setPad() {
    const arr = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9].sort((a, b) => Math.random() - Math.random());
    $(`.key_pad_key`).html(arr.map(v => `<div data-key="${v}">${v}</div>`));
  },
}

const Modal = {
  open(target, adition = "") {
    $(`.modal, #${target}`).addClass('open');

    if (target == "baker_info_popup") {
      let timer;
      let timeout = 400;

      let targetName = adition.data('name');
      const bakerInfo = App.bakerData.find(v => v.name == targetName);

      $(`.popup_baker_info`).html(Html.bakerInfoHtml(bakerInfo));

      Object.keys(bakerInfo.images[0]).forEach(v => {
        let imgInfo = bakerInfo.images[0][v];
        const img = $(`<img src = "/resources/빵메뉴/${imgInfo}" alt = "bread" title = "bread">`);
        
        $(`.popup_baker_menu`).append(img);
      })

      $(`.popup_baker_menu img`).each((idx, el) => {
        timer = setTimeout(() => {
          $(el).animate({
            "width": "100%",
            "height": "100%",
            "opacity": "1",
          }, 400)
        }, timeout);
        
        timeout = timeout + 400;
      })

      clearTimeout(timer);
    }
  },

  close() {
    $(`.popup`).find('input, textarea, select').val('');

    $(`.modal, .popup`).removeClass('open');
  }
}

const Html = {
  bakerListHtml(data) {
    return `
      <div class="baker_item" data-name="${data.name}">
        <div class="back_img">
          <img src="resources/빵집/${data.name}/1.jpg" alt="baker" title="baker">
        </div>

        <div class="baker_name">
          <h2><span class="color">${data.name}</span></h2>
          <div class="flex alc">
            <button class="btn" data-name="${data.name}" onclick="Modal.open('baker_info_popup', $(this))">빵집보기</button>
            <button class="btn view_only_pro" data-name="${data.name}">상품보기</button>
          </div>
        </div>
      </div>
    `
  },

  bakerInfoHtml(data) {
    return `
      <div>
          <h2><span class="color">${data.name}</span> - <span style="font-size: 1.2rem;">${data.location}</span></h2>
          <h4><span class="color">[영업시간]</span>- ${data.time}</h4>
          <h4><span class="color">[누적예약판매개수]</span> - ${data.sale}개</h4>
          <h5>${data.etc}<h5>
        </div>

        <div class="after_line" style="background: #ff8400;"></div>

        <div class="popup_baker_menu">
        </div>
    `
  },

  productItem(data) {
    dd(data)
    return `
    <div>
        <div class="product_item drag_item" data-name="${data.menuname}">
          <div class="product_img">
            <img src="resources/빵메뉴/${data.image}" alt="product" title="product">
          </div>

          <div class="product_info">
            <h4>${data.name} - <span class="color">${data.menuname}</span></h4>
            <h3>${(data.price * 1).toLocaleString()}원</h3>
            <button class="btn move_view_page" data-name="${data.idx}">선택</button>
          </div>
        </div>
      </div>
    `
  },

  cartItem(data) {
    return `
      <div class="cart_item flex alc" data-name="${data.menuname}">
        <div class="cart_img">
          <img src="resources/빵메뉴/${data.image}" alt="product" title="product">
        </div>

        <div class="cart_info">
          <h3>${data.name}</h3>
          <h3><span class="color">${data.menuname}</span></h3>
          <h3>${(data.price * 1).toLocaleString()}원</h3>
            <button class="btn move_view_page" data-name="${data.idx}">선택</button>
        </div>
      </div>
    `
  },

  basketHtml(data) {
    return `
      <div class="basket_item">
            <div class="basket_img">
              <img src="resources/빵메뉴/${data.image}" alt="basket" title="basket">
            </div>
            <div>
              <div>
                <h2><span class="color">${data.menuname}(${data.name})</span></h2>
                <h4>${data.keep}</h4>
                <h4>${data.shelf}</h4>
              </div>
            </div>
            <div>
              <input type="number" class="input basket_count" min="1" style="width: 100%;" value="${data.count * 1}" data-name="${data.menuname}" ${window.location.pathname.includes('order') ? "readonly" : ""}>
            </div>
            <div>
              <h2>${(data.price * 1).toLocaleString()}원</h2>
            </div>
            <div>
              <h2><span class="color subtotal" data-name="${data.menuname}">${data.subtotal.toLocaleString()}원</span></h2>
            </div>
          </div>
    `
  },
}

$(_ => {
  App.init();
});