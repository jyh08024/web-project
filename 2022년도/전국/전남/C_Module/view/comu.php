<div class="section"></div>
<div class="section wrap">
  <div class="flex">
    <div class="section_title ani">
      <p>Community</p>
      <h2>함께해요</h2>
      <h2>버스킹 커뮤니티 페이지</h2>
    </div>
  </div>

  <div class="after_line"></div>

  <div class="tab_list">
    <a href="/comu/all/<?= $page ?>" class="tab_item <?= $nowCate == "all" ? "now_cate" : "" ?>">
      전체
    </a>
    <?php foreach ($cate as $key => $v): ?>
      <a href="/comu/<?= $v['id'] ?>/1" class="tab_item <?= $nowCate == $v['id'] ? "now_cate" : "" ?>">
        <?= htmlspecialchars($v['category']) ?>
      </a>
    <?php endforeach ?>
  </div>

  <div class="after_line"></div>

  <div class="rec_list">
    <?php foreach ($recruit as $key => $v): ?>
      <div class="rec_item">
        <a href="/recDetail/<?= $v['id'] ?>">
          <div>
            <div class="bold"><?= htmlspecialchars($v['title']) ?></div>
          </div>
          <div>
            <div><?= htmlspecialchars($v['user_name']) ?></div>
          </div>
          <div>
            <div><?= htmlspecialchars($v['create_dt']) ?></div>
          </div>
          <div>
            <div><?= htmlspecialchars($cate[array_search($v['category_id'], array_column($cate, "id"))]['category']) ?></div>
          </div>
        </a>
      </div>
    <?php endforeach ?>
  </div>

  <div class="after_line"></div>

  <div class="page_list">
    <div>
      <?php $before = $page == 1 ? 1 : $page - 1; ?>
      <?php $next = $page == $end ? $end : $page + 1; ?>
      <a href="/comu/<?= $nowCate ?>/1"><i class="fa fa-angle-double-left"></i></a>
      <a href="/comu/<?= $nowCate ?>/<?= $before ?>"><i class="fa fa-angle-left"></i></a>
      <?php foreach ($btnBlock[$now - 1] as $key => $v): ?>
      <a class="<?= $page == $key + 1 ? "now_page" : "" ?>" href="/comu/<?= $nowCate ?>/<?= $key + 1 ?>"><?= $key + 1 ?></a>
      <?php endforeach ?>
      <!-- <?php for($i = 1; $i <= count($block); $i++): ?> -->
        <!-- <a class="<?= $page == $i ? "now_page" : "" ?>" href="/review/<?= $i ?>"><?= $i ?></a> -->
      <!-- <?php endfor ?> -->
      <a href="/comu/<?= $nowCate ?>/<?= $next ?>"><i class="fa fa-angle-right"></i></a>
      <a href="/comu/<?= $nowCate ?>/<?= $end ?>"><i class="fa fa-angle-double-right"></i></a>
    </div>
  </div>
</div>

<div class="section"></div>

<div class="side_btn" onclick="Modal.open('busking_enr')">
  <i class="fa fa-users"></i>
  <p>버스커 모집</p>
</div>