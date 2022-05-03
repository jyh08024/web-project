  <div class="sub_page_visual">
    <div class="sub_page_title flex alc wrap">
      <h1>매장관리 - 기본 정보관리</h1>
    </div>
  </div>

  <div class="sub_page_section section wrap">
    <div class="sub_section_title">
      <h2>기본 정보관리</h2>
    </div>

    <form method="POST" action="/post/storeUpdate/<?= $shopInfo['idx'] ?>" enctype="multipart/form-data" class="shop_info flex">
      <div class="shop_detail_img">
        <img src="/resources/store/<?= $shopInfo['image'] ?>" class="store_image" alt="shop" title="shop">
      </div>

      <div class="shop_text">
        <h1><span class="color">[매장 이름]</span> <?= $shopInfo['name'] ?></h1>
        <textarea rows="10" cols="50" class="input" name="contents"><?= $shopInfo['contents'] ?></textarea>

        <div class="button_area">
          <label for="image_upload" class="btn">이미지 변경</label>
          <input type="file" name="image" id="image_upload" hidden>
          <button type="button" class="btn update_cancel" onclick="clearForm(this)">수정 취소</button>
          <button class="btn update_success">수정 완료</button>
        </div>
      </div>
    </form>
  </div>


<script>
  $(document)
    .on(`input`, "#image_upload", function(e) {
      if (e.target.files[0] == undefined && !e.target.files[0].type.includes("image")) {
        return;
      }

      const reader = new FileReader();
      reader.onload = function(e) {
        $(`.store_image`).attr('src', e.target.result);
      }

      reader.readAsDataURL(this.files[0]);
    })

  function clearForm(target) {
    $(target).closest('form').find('textarea').val('<?= $shopInfo['contents'] ?>');
    $(target).closest('form').find('.store_image').attr('src', '/resources/store/<?= $shopInfo['image'] ?>');
  }

  function imageUpload(target) {
    
  }
</script>