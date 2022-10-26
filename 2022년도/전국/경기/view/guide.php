  <div class="section"></div>
  <div class="section"></div>
  <div class="section">
    <div class="wrap">
      <div class="section_title ani">
        <div>
          <h4 class="main_title"><span class="title_cont">정원안내</span>이런 정원들이 있어요.</h4>
        </div>
      </div>

      <div class="section_content">
        <div class="toggle_list flex alc">
          <div class="toggle">
            <input type="radio" name="toggle" value="reserve" id="reserve" hidden>
            <label for="reserve">
              <span>예약 순</span>
            </label>
          </div>
          <div class="toggle">
            <input type="radio" name="toggle" value="review" id="review" hidden>
            <label for="review">
              <span>리뷰 순</span>
            </label>
          </div>
          <div class="toggle">
            <input type="radio" name="toggle" value="star" id="star" hidden>
            <label for="star">
              <span>별점 순</span>
            </label>
          </div>
        </div>

        <div class="after_line"></div>
        <div class="garden_list">

        <?php foreach ($garden as $key => $v): ?>
          <?php $star = review::mq("SELECT AVG(star) `star` FROM review WHERE garden = ?", $v['idx'])->fetchAll()[0]['star']; ?>
          <div class="guide_item">
            <a href="/detail/<?= $v['idx'] ?>">
              <div class="guide_img">
                <img src="/resources/민간정원/<?= $v['name'] ?>2.jpg" alt="img" title="img" onerror="Html.imgErr(this)">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3><?= $v['name'] ?></h3>
                  <p><?= $v['themes'] ?></p>
                </div>

                <div class="flex alc">
                  <p style="margin-right: .3rem;">별점: <?= $star == NULL ? 0 : $star ?>점</p>
                  <div class="star">
                    <p class="full_star" style="width: calc(10% * <?= $star == NULL ? 0 : $star ?>);">★★★★★</p>
                    <p class="emp_star">☆☆☆☆☆</p>
                  </div>
                </div>

                <p class="garden_ex">기존 팔각정자를 바탕으로 전통적인 느낌의 공간을 조성하여 고즈넉하고 편안한 공간 계획, 평택의 이미지와 전통적인 분위기 조성합니다.</p>
              </div>
            </a>
          </div>
        <?php endforeach ?>
         <!--  <div class="guide_item">
            <a href="detail.html">
              <div class="guide_img">
                <img src="resources/민간정원/사천식물랜드2.jpg" alt="img" title="img">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3>사천식물랜드</h3>
                  <p>꽃길,관광지,광활</p>
                </div>

                <div class="flex alc">
                  <p style="margin-right: .3rem;">별점: 3점</p>
                  <div class="star">
                    <p class="full_star" style="width: calc(10% * 3);">★★★★★</p>
                    <p class="emp_star">☆☆☆☆☆</p>
                  </div>
                </div>

                <p class="garden_ex">분수를 감싸고 있는 아름다운 경사지에 거대한 분수대가 손님을 가장 먼저 맞이하는 광장입니다.</p>
              </div>
            </a>
          </div>
          <div class="guide_item">
            <a href="detail.html">
              <div class="guide_img">
                <img src="resources/민간정원/해솔찬정원2.jpg" alt="img" title="img">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3>해솔찬정원</h3>
                  <p>체험학습,초원,식물원</p>
                </div>

                <div class="flex alc">
                  <p style="margin-right: .3rem;">별점: 8점</p>
                  <div class="star">
                    <p class="full_star" style="width: calc(10% * 8);">★★★★★</p>
                    <p class="emp_star">☆☆☆☆☆</p>
                  </div>
                </div>

                <p class="garden_ex">늘 푸른 구상나무와 초여름 연분홍 꽃을 피우는 자귀나무가 펼쳐진 잔디마당은 관람객들의 눈길을 사로잡는 곳입니다.</p>
              </div>
            </a>
          </div>
          <div class="guide_item">
            <a href="detail.html">
              <div class="guide_img">
                <img src="resources/민간정원/통영동백커피식물원2.jpg" alt="img" title="img">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3>통영동백커피식물원</h3>
                  <p>식물원,과수원,촉촉</p>
                </div>

                <div class="flex alc">
                  <p style="margin-right: .3rem;">별점: 5점</p>
                  <div class="star">
                    <p class="full_star" style="width: calc(10% * 5);">★★★★★</p>
                    <p class="emp_star">☆☆☆☆☆</p>
                  </div>
                </div>

                <p class="garden_ex">정원을 만드는 과정에서 죽은 참나무로 쉼터를 만들었으며 봄에는 복수초와 철쭉, 여름에는 산수국, 가을에는 꽃무릇, 구절초를 볼 수 있습니다.</p>
              </div>
            </a>
          </div>
          <div class="guide_item">
            <a href="detail.html">
              <div class="guide_img">
                <img src="resources/민간정원/물빛소리정원2.jpg" alt="img" title="img">
              </div>
              
              <div class="guide_t">
                <div class="flex alc js">
                  <h3>물빛소리정원</h3>
                  <p>꽃길,관광지,광활</p>
                </div>

                <div class="flex alc">
                  <p style="margin-right: .3rem;">별점: 1점</p>
                  <div class="star">
                    <p class="full_star" style="width: calc(10% * 1);">★★★★★</p>
                    <p class="emp_star">☆☆☆☆☆</p>
                  </div>
                </div>

                <p class="garden_ex">물빛소리정원 옆으로 길게 뻗은 벚나무길에는 아름다운 루미나리에로 장식되어있어 밤이 되면 그 아름다움을 뽐냅니다.</p>
              </div>
            </a>
          </div>
          <div class="guide_item" style="opacity: 0;"></div> -->
        </div>
      </div>
    </div>
  </div>
