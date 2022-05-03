  <div class="page_top" style="height: 250px;">
    <h1>특산품 안내</h1>
  </div>

  <div class="section wrap">
    <div class="section_top intro_top">
      <div class="intro_item">
        <div class="intro_img">
          <img src="resources/지도/map.png" alt="photo" title="photo">
        </div>
        <div class="intro_cont">
          <h2>경상남도 소개</h2>
          <p>
            <span class="bold">경상남도는</span> 대한민국 동남쪽에 위치한 도입니다. <br> 
            경상남도는 18개 시군으로 이루어져 있습니다 <br>
          </p>
        </div>
      </div>
      <div class="intro_item">
        <div class="intro_img">
          <img src="resources/img/photo(3).jpg" alt="photo" title="photo">
        </div>
        <div class="intro_cont">
          <h2>특산품 소개</h2>
          <p>
            <span class="bold">특산품 소개</span>페이지에서 여러 지역의. <br>
            특산품을 만나보세요!<br>
          </p>
        </div>
      </div>
      <div class="intro_item">
        <div class="intro_img">
          <img src="resources/people.png" alt="photo" title="photo">
        </div>
        <div class="intro_cont">
          <h2>경상남도 특산품</h2>
          <p>
            <span class="bold">특산품은</span> 여러 지역에서 직접 생산합니다.<br>
            대표적으로 거제 유자, 통영 굴 등이 있습니다.
          </p>
        </div>
      </div>
    </div>
    <div class="map_area flex alc jc">
      <object id="map" data="resources/지도/map.svg" type="image/svg+xml"></object>
    </div>
  </div>

  <script>
    let prev = [];

    window.onload = () => {
      setInterval(() => {
        $.post(`/productAll`).done((res) => {
          if (JSON.stringify(res) == JSON.stringify(prev)) {
            return;
          }

          res.map(v => {
            let loc = v.location;
            const title = $(`#map`).contents().find('g > text').toArray().find(v => $(v).text() == loc);
            const group = $(title).parent();
            const id = group.attr('id');
            const target = group.parent().find(`#${id}_b`);
            dd(v)
            target.find(`.cls-3`).text(v.itemList);
            target.find('image').attr('xlink:href', v.image);
          });
        })
      }, 300)
    }
  </script>