<link rel="stylesheet" href="resources/css/sub.css">

<div class="visual">
    <div class="banner">
      <div class="sub_page_title rap">
        <h1>REGISTER</h1>
      </div>
      <div class="banner_img">
        <img src="resources/img/more_img_2.jpg" alt="title" title="title">
      </div>
    </div>
  </div>

  <div class="login_content rap">
  	<div class="contentImg">
  		<img src="/resources/img/more_img_7.jpeg" alt="배경" title="배경">
  	</div>

  	<form action="/join/post" method="POST" class="login_form" enctype="multipart/form-data">
  		<div class="form_top">
  			<h1>REGISTER</h1>
  		</div>

  		<ul>
  			<li><label for="userid">아이디</label></li>
  			<li><input type="text" class="form_input" id="userid" name="id" placeholder="아이디"></li>
  		</ul>
  		<ul>
  			<li><label for="userpass">비밀번호</label></li>
  			<li><input type="text" class="form_input" id="userpass" name="password" placeholder="비밀번호"></li>
  		</ul>
  		<ul>
  			<li><label for="name">배급사이름</label></li>
  			<li><input type="text" class="form_input" id="name" name="name" placeholder="배급사이름"></li>
  		</ul>
  		<ul>
  			<li><label for="img">배급사 이미지</label></li>
  			<li><input type="file" class="form_input" id="img" name="img" placeholder="배급사 이미지를 선택해주세요."></li>
  		</ul>

  		<div class="form_footer">
  			<button class="btn">회원가입</button>
  		</div>
  	</form>
  </div>