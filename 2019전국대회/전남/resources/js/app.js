// 디버깅용
const dd = console.log;
// 로딩애니메이션
const loading = () => {
  const ss = sessionStorage['loading'];

  if (ss) {
    return;
  } else {
    sessionStorage['loading'] = true;
  }

  $(`body`).css('overflow', 'hidden');
  $(`.load_animation`).css('display', 'flex').animate({
    'top': 0,
  }, 500, 'linear');

  setTimeout(() => {
    $(`.load_animation`).animate({
      [Math.random()]: .7
    }, {
      duration: 700,
      step: (now, fx) => {
        $(fx.elem).css({ top: `${0 - now * 200}%` });
      },

      complete: () => {
        $(`.load_animation`).css('display', 'none');
        $(`body`).css('overflow', 'auto');
      }
    })
  }, 3000);
}
// 기본객체
const App = {
  init() {
    loading();
    App.hook();
    Slide.init();
    Partner.init();
  },

  hook() {
    $(document)
      .on(`click`, ".visual_slide_con > div", (e) => Slide.move(e))
      .on(`click`, ".movie_slide_box .slide_control > div", (e) => Slide.infSlide(e))
      .on(`mousewheel`, "body", (e) => AnimteE.scrollE(e))
      .on(`mousemove`, "body", (e) => AnimteE.move(e))
  }
}

// 슬라이드 관리
const Slide = {
  autoSlide: true,
  cur: 1,
  nowDur: false,
  infDur: false,

  init() {
    Slide.autoMove();
  },

  autoMove() {
    if (!Slide.autoSlide || Slide.nowDur) {
      return;
    }

    setInterval(() => {
      Slide.cur += Slide.cur < 3 ? 1 : -2;
      Slide.animation();
    }, 4000);
  },

  animation() {
    $(`.slide_grade > div`).removeClass('now_slide');
    $(`.slide_grade > div:nth-child(${Slide.cur})`).addClass('now_slide');

    $(`.visual_img`).css({
      marginLeft: -((Slide.cur - 1) * 100) + "%",
    });

    Slide.autoSlide = true;
    Slide.nowDur = false;
  },

  move(e) {
    Slide.autoSlide = false;
    Slide.nowDur = true;

    const dir = $(e.currentTarget).data('dir');

    if (Slide.cur + dir <= 0 || Slide.cur + dir > 3) {
      return;
    }

    Slide.cur += dir;
    Slide.animation();
  },
  
  infSlide(e) {
    if (Slide.infDur) {
      return;
    }

    Slide.infDur = true;

    const target = $(e.currentTarget).data('slide');
    const dir = $(e.currentTarget).data('dir') * 1;

    const slide = $(`.${target}`);
    const befItem = dir == 1
      ? slide.find('.movie_item').first()
      : slide.find('.movie_item').last();
    const clone = befItem.clone();

    const left = dir == 1 ? -23.2 : 0;

    if (dir == -1) {
      befItem.remove();
      slide.prepend(clone);

      slide.css('left', '-23.2%');
    }

    slide.animate({
      left: left + "%",
    }, 600, () => {
      Slide.infDur = false;

      if (dir == 1) {
        befItem.remove();
        slide.append(clone);
        slide.css('left', '0');
      }
    })
  }
}

// 파트너
const Partner = {
  play: '',
  left: 0,

  init() {
    $(`.partner_section`)
      .on(`mouseover`, () => {
        clearInterval(Partner.play);
      })
      .on(`mouseleave`, () => {
        Partner.move();
      });
    
    Partner.move();
  },

  move() {
    Partner.play = setInterval(() => {
      const slide = $(`.partner_slide`);
      Partner.left += -1;

      if (Partner.left <= -364) {
        Partner.left = 0;
        slide.append(slide.find('div:nth-child(1)'));
      }

      slide.css('left', Partner.left + 'px');
    });
  }
}

// 스크롤 및 마우스 반응 
const AnimteE = {
  scrollE(e) {
    const windowSize = $(window).scrollTop() + $(window).height();

    $(`.movie_slide`).each((i, v) => {
      const itemPos = $(v).offset().top + $(v).height() - 550;
      $(v)[(windowSize >= itemPos ? "add" : "remove") + "Class"]('movie_item_view');
    })
  },

  move(e) {
    $(`.movie_slide`).css({ margin: `-${e.clientY / 100 + 2}px ${e.clientX / 100 + 2}px` });
  }
}

// 페이지 온로드
$(() => {
  App.init();
})