  <div class="page_top" style="height: 250px;">
    <h1>이벤트 관리</h1>
  </div>

  <div class="form section wrap flex alc js">
    <form action="/search" method="POST">
      <input type="date" name="date" class="input" style="width: 70%; " required>
      <button class="btn">조회</button>
    </form>

    <div class="after_line wrap"></div>
  </div>

  <div class="wrap">
    <div class="event_list">
        
      
    </div>
    
  </div>

  <style>
    .event_list {
      width: 100%;
      height: 100%;
      display: grid;
      grid-gap: 1.2rem;
      grid-template-columns: repeat(2, 1fr);
    }

    .event_item {
      width: 100%;
      height: 100%;
      box-shadow: 0 0 70px rgba(0, 0, 0, .15);
      border: 1px solid rgba(0, 0, 0, .1);
      padding: 2rem;
      border-radius: 20px;
      overflow: hidden;
    }

    .st {
      width: 180px;
      height: 180px;
    }
  </style>

  <script>
    let prev = [];

    window.onload = () => {
    	setInterval(() => {

	      $.post(`/productAll`).done((res) => {
	      	if (JSON.stringify(res) == JSON.stringify(prev)) {
	      		return;
	      	}

	      	prev = res;
	      	$(`.event_list`).html(res.map(v => {
	      		return `
	      			<div class="form_area">
				        <div class="form_img" style="height: 100%;">
				          <img src="${v.image}" alt="form" title="form">
				        </div>

				        <div class="form_content">
				          <div class="popup_title">
				            <div>
				              <h2>시군명 : ${v.location}</h2>
				              <p style="font-size: .9rem;">특산품 : ${v.itemList}</p>
				            </div>

				            <button class="btn" onclick="$(this).parent().parent().find('.update_form').removeClass('none')">관리</button>
				          </div>
				        
				          <div class="after_line"></div>

				          <div class="update_form none">
				          	<form class="pro_form">
					          	<ul>
					          		<li>특산품 변경</li>
					          		<li><input type="text" class="input" name="itemList" value="${v.itemList}"></li>
					          	</ul>
					          	<ul>
					          		<li>사진 변경</li>
					          		<li><input type="file" class="input" name="image"></li>
					          	</ul>
					          	<input type="hidden" name="idx" value="${v.idx}">
					          	<div class="after_line"></div>

					          	<button class="btn">변경</button>
				          	</form>
				          </div>
				        </div>
				      </div>
	      		`
	      	}))
	      })
    	}, 300)
    }

    $(document)
    	.on(`submit`, ".pro_form", (e) => {
    		e.preventDefault();

    		const formData = new FormData(e.target);

    		$.ajax({
	        url: '/update/product',
	        processData: false,
	        contentType: false,
	        data: formData,
	        enctype: "multipart/form-data",
	        type: "POST",
	      }).done((res) => {
	      	alert(res.message);
	      });
    	})
  </script>