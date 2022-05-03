const Template = {
  header: () => `
    <header>
      <div class="header_rap wrap flex alc js">
        <div class="logo">
          <a href="#">
            <img src="../resources/logo.png" alt="logo" title="logo">
          </a>
        </div>
    
        <ul class="menu">
          <li class="link"><a href="#">Menu1</a></li>
          <li class="link"><a href="#">Menu2</a></li>
          <li class="link"><a href="#">Menu3</a></li>
        </ul>
      </div>
    </header>
  `,

  visual_1: () => `
    <div class="visual_section visual_1 flex alc js" style="position: relative;">
      <div class="emp_box"></div>
    
      <div class="visual_text">
        <div class="small_text">
          <h3>부산국제매직페스티벌</h3>
        </div>
    
        <div class="visual_main">
          <p class="visual_ex"><span>Lorem ipsum dolor sit amet, <br>
            Neque maxime error fugiat, non,accusantium atque.
          </span></p>
          <p class="color bold visual_title"><span>부산국제매직페스티벌</span></p>
        </div>
    
        <div class="visual_line"></div>
    
        <h3 class="link visual_link"><a href="#">LEARN MORE</a></h3>
      </div>
    
      <div class="visual_slide">
        <div class="visual_img slide_1">
          <div><img src="../resources/img/visual/5.jpg" alt="visual" title="visual"></div>
          <div><img src="../resources/img/visual/2.jpg" alt="visual" title="visual"></div>
          <div><img src="../resources/img/visual/4.jpg" alt="visual" title="visual"></div>
        </div>
      </div>    
    </div>
  `,

  visual_2: () => `
    <div class="visual_section visual_2 flex alc js" style="position: relative;">

      <div class="visual_text">
        <div class="visual_main visual_2_main">
          <p class="color bold visual_title"><span>부산국제매직페스티벌</span></p>
        </div>

        <div class="visual_line"></div>

        <p class="visual_ex" style="font-size: 1.2rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque maxime error fugiat, non, accusantium atque. Dolores
        velit, reiciendis repellendus odit illo unde. Qui error labore perferendis quos veritatis, voluptatibus itaque.</p>

        <h3 class="link visual_link"><a href="#">LEARN MORE</a></h3>
      </div>

      <div class="visual_slide">
        <div class="visual_img slide_2">
          <div><img src="../resources/img/visual/5.jpg" alt="visual" title="visual"></div>
          <div><img src="../resources/img/visual/2.jpg" alt="visual" title="visual"></div>
          <div><img src="../resources/img/visual/4.jpg" alt="visual" title="visual"></div>
        </div>
      </div>    
    </div>
  `,

  feature_1: () => `
    <div class="feature_section wrap flex alc js">
      <div class="feature_back">
        <img src="../resources/img/visual/6.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Features</span>
        </h1>
        <h2>Features</h2>
      </div>

      <div class="feature_content">
        <div class="feature_item">
          <div class="feature_item_title flex alc">
            <div class="icon_box icon_box_1 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>

            <h1 class="feature_title">Lorem ipsum1</h1>
          </div>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>

        <div class="feature_item">
          <div class="feature_item_title flex alc">
            <div class="icon_box icon_box_2 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>

            <h1 class="feature_title">Lorem ipsum1</h1>
          </div>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>

        <div class="feature_item">
          <div class="feature_item_title flex alc">
            <div class="icon_box icon_box_3 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>

            <h1 class="feature_title">Lorem ipsum1</h1>
          </div>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>
      </div>
    </div>
  `,

  feature_2: () => `
    <div class="feature_section wrap">
      <div class="feature_back">
        <img src="../resources/img/visual/6.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Features</span>
        </h1>
        <h2>Features</h2>
      </div>

      <div class="feature_content flex alc js">
        <div class="feature_item feature_item_2 tlc">
          <div class="feature_item_title flex alc jc">
            <div class="icon_box icon_box_1 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>
          </div>

          <h1 class="feature_title">Lorem ipsum1</h1>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>

        <div class="feature_item feature_item_2 tlc">
          <div class="feature_item_title flex alc jc">
            <div class="icon_box icon_box_2 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>
          </div>

          <h1 class="feature_title">Lorem ipsum1</h1>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>

        <div class="feature_item feature_item_2 tlc">
          <div class="feature_item_title flex alc jc">
            <div class="icon_box icon_box_3 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>
          </div>

          <h1 class="feature_title">Lorem ipsum1</h1>

          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur voluptate, <br>
            fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>

          <div class="after_line"></div>

          <h2 class="link feature_link"><a href="#">Read More</a></h2>
        </div>
        <div class="feature_item feature_item_2 tlc">
          <div class="feature_item_title flex alc jc">
            <div class="icon_box icon_box_4 feature_icon">
              <img src="../resources/img/features/icon.jpg" alt="feature" title="feature">
            </div>
          </div>
        
          <h1 class="feature_title">Lorem ipsum1</h1>
        
          <div class="feature_item_content feature_txt">
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam officia aspernatur nisi ut eligendi consectetur
              voluptate, <br>
              fuga magni quasi. Nisi ratione veniam id illum, facere reiciendis assumenda quis quod maxime!</p>
          </div>
        
          <div class="after_line"></div>
        
          <h2 class=" feature_linklink"><a href="#">Read More</a></h2>
        </div>
      </div>
    </div>
  `,

  gallery_1: () => `
    <div class="gallery_section wrap">
      <div class="feature_back">
        <img src="../resources/img/gallery/20.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Gallery&Slider</span>
        </h1>
        <h2>Gallery&Slider</h2>
      </div>

      <div class="gallery_slide">
        <input type="radio" name="gal_slide" id="gal_1" hidden>
        <input type="radio" name="gal_slide" id="gal_2" hidden checked>
        <input type="radio" name="gal_slide" id="gal_3" hidden>
        <input type="radio" name="gal_slide" id="gal_4" hidden>
        <input type="radio" name="gal_modal" id="gal_modal_close" hidden checked>

        <div class="slide_control">
          <div class="flex alc js">
            <label for="gal_1">이전</label>
            <label for="gal_3">다음</label>
          </div>
          <div class="flex alc js">
            <label for="gal_2">이전</label>
            <label for="gal_4">다음</label>
          </div>
          <div class="flex alc js">
            <label for="gal_3">이전</label>
            <label for="gal_1">다음</label>
          </div>
        </div>

        <div class="gal_modal">
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_1" hidden>
            <div class="g_modal_1 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/2.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_2" hidden>
            <div class="g_modal_2 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/32.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_3" hidden>
            <div class="g_modal_3 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/4.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div><div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_4" hidden>
            <div class="g_modal_4 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/10.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div><div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_5" hidden>
            <div class="g_modal_5 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/5.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div><div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_6" hidden>
            <div class="g_modal_6 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/30.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
        </div>
        
        <div class="gal_slide">

          <div class="gal_item_list">
            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_1">
                  <img src="../resources/img/gallery/2.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum1</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Tempore harum laborum eos nisi rerum ad aspernatur explicabo. Obcaecati commodi ipsa, corporis, dolores saepe
                exercitationem perspiciatis esse quos totam autem iure.</p>
              </div>
            </div>

            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_2">
                  <img src="../resources/img/gallery/32.jpg" alt="modal" title="modal">
                </label>
              </div>
            
              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum2</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Illo veniam quis praesentium alias reprehenderit modi unde amet, non, atque quo impedit laborum, tempora porro
                voluptates pariatur! Facilis neque, a sed.</p>
              </div>
            </div>

            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_3">
                  <img src="../resources/img/gallery/4.jpg" alt="modal" title="modal">
                </label>
              </div>
            
              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum3</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Nisi quos dolore, nemo unde, deserunt voluptate amet alias officia sequi eveniet autem ullam hic. Dignissimos mollitia
                soluta illum repellendus, ducimus nisi.</p>
              </div>
            </div>

            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_4">
                  <img src="../resources/img/gallery/10.jpg" alt="modal" title="modal">
                </label>
              </div>
            
              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum4</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Ex aperiam sed harum nesciunt temporibus, iusto error dicta quis neque aut, incidunt nobis quia tempore! Magnam libero
                fugit dolorum sit nesciunt?</p>
              </div>
            </div>

            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_5">
                  <img src="../resources/img/gallery/5.jpg" alt="modal" title="modal">
                </label>
              </div>
            
              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum5</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">architecto laudantium illum itaque fuga temporibus, error commodi delectus recusandae ipsa ab labore. Molestiae
                blanditiis culpa eum dolores! Voluptate, quia labore.</p>
              </div>
            </div>

            <div class="gal_item">
              <div class="gal_img">
                <label for="gal_modal_6">
                  <img src="../resources/img/gallery/30.jpg" alt="modal" title="modal">
                </label>
              </div>
            
              <div class="gal_item_cont">
                <h2 class="gallery_title">Lorem ipsum6</h2>
                <p class="gallery_sub">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Nobis delectus tempore id voluptas aliquam quisquam suscipit. Aliquid enim labore, et reprehenderit rem iure ad esse
                ullam eaque est dolores placeat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `,

  gallery_2: () => `
    <div class="gallery_section wrap">
      <div class="feature_back">
        <img src="../resources/img/gallery/20.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Gallery&Slider</span>
        </h1>
        <h2>Gallery&Slider</h2>
      </div>

      <div class="gallery_slide">
        <input type="radio" name="gal_modal" id="gal_modal_close" hidden checked>

        <div class="gal_modal">
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_1" hidden>
            <div class="g_modal_1 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/2.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_2" hidden>
            <div class="g_modal_2 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/32.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_3" hidden>
            <div class="g_modal_3 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/4.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_4" hidden>
            <div class="g_modal_4 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/10.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_5" hidden>
            <div class="g_modal_5 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/5.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
          <div>
            <input type="radio" name="gal_modal" class="modal_open" id="gal_modal_6" hidden>
            <div class="g_modal_6 gmodal">
              <div>
                <label for="gal_modal_close">X</label>
                <img src="../resources/img/gallery/30.jpg" alt="modal" title="modal">
              </div>
            </div>
          </div>
        </div>

        <div class="gal_slide">

          <div class="gal_item_list_2">
            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum1</h2>
              
              <div class="gal_img">
                <label for="gal_modal_1">
                  <img src="../resources/img/gallery/2.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_sub" style="font-size: 1rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Tempore harum laborum eos nisi rerum ad aspernatur explicabo. Obcaecati commodi ipsa, corporis, dolores
                  saepe
                  exercitationem perspiciatis esse quos totam autem iure.</p>
              </div>
            </div>

            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum2</h2>
              
              <div class="gal_img">
                <label for="gal_modal_2">
                  <img src="../resources/img/gallery/32.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_sub" style="font-size: 1rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Illo veniam quis praesentium alias reprehenderit modi unde amet, non, atque quo impedit laborum,
                  tempora porro
                  voluptates pariatur! Facilis neque, a sed.</p>
              </div>
            </div>

            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum3</h2>
              
              <div class="gal_img">
                <label for="gal_modal_3">
                  <img src="../resources/img/gallery/4.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_sub" style="font-size: 1rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Nisi quos dolore, nemo unde, deserunt voluptate amet alias officia sequi eveniet autem ullam hic.
                  Dignissimos mollitia
                  soluta illum repellendus, ducimus nisi.</p>
              </div>
            </div>

            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum4</h2>
              
              <div class="gal_img">
                <label for="gal_modal_4">
                  <img src="../resources/img/gallery/10.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_sub" style="font-size: 1rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">Ex aperiam sed harum nesciunt temporibus, iusto error dicta quis neque aut, incidunt nobis quia
                  tempore! Magnam libero
                  fugit dolorum sit nesciunt?</p>
              </div>
            </div>

            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum5</h2>
              
              <div class="gal_img">
                <label for="gal_modal_5">
                  <img src="../resources/img/gallery/5.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_sub" style="font-size: 1rem;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p class="gallery_txt">architecto laudantium illum itaque fuga temporibus, error commodi delectus recusandae ipsa ab labore.
                  Molestiae
                  blanditiis culpa eum dolores! Voluptate, quia labore.</p>
              </div>
            </div>

            <div class="gal_item">
              <h2 class="gallery_title">Lorem ipsum6</h2>
              
              <div class="gal_img">
                <label for="gal_modal_6">
                  <img src="../resources/img/gallery/30.jpg" alt="modal" title="modal">
                </label>
              </div>

              <div class="gal_item_cont">
                <p class="gallery_title">Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p>Nobis delectus tempore id voluptas aliquam quisquam suscipit. Aliquid enim labore, et reprehenderit rem
                  iure ad esse
                  ullam eaque est dolores placeat.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  `,

  contact_1: () => `
    <div class="gallery_section wrap">
      <div class="feature_back">
        <img src="../resources/img/gallery/20.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Contacts</span>
        </h1>
        <h2>Contacts</h2>
      </div>

      <div class="section_top flex alc js" style="margin-bottom: 1rem">
        <div class="area_title">
          <h1>Informations</h1>
        </div>

        <div class="icons_list flex alc js">
          <div class="informs contacts_email">
            <div class="icon_box icon_box_1">
              <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon">
            </div>
            <h2 style="margin-left: 2rem;">이메일 : webskills@skills.com</h2>
          </div>
          <div class="informs contacts_call">
            <div class="icon_box icon_box_2">
              <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon" style="left: -371px; top: -87px">
            </div>
            <h2 style="margin-left: 2rem;">전화번호 : 123-456-7890</h2>
          </div>
          <div class="informs contacts_ad">
            <div class="icon_box icon_box_3">
              <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon"  style="left: -371px; top: -229px">
            </div>
            <h2 style="margin-left: 2rem;">주소 : 부산시 해운대구 123</h2>
          </div>
        </div>
      </div>

      <div class="section_content flex alc js">
        <div class="area_title">
          <h1>Contacts Form</h1>
        </div>

        <form class="contact_form" data-color="#f8b504">
          <div class="flex alc js">
            <input type="text" name="name" placeholder="이름" required>
            <input type="text" name="email" placeholder="이메일" required>
          </div>
          
          <textarea placeholder="메시지" name="contants" cols="30" rows="10" required></textarea>

          <div class="after_line"></div>

          <button class="btn link">보내기</button>
        </form>
      </div>
    </div>
  `,

  contact_2: () => `
    <div class="gallery_section wrap">
      <div class="feature_back">
        <img src="../resources/img/gallery/20.jpg" alt="feature" title="feature">
      </div>

      <div class="section_title teasure_title">
        <h1>
          <span class="color">Contacts</span>
        </h1>
        <h2>Contacts</h2>
      </div>

      <div class="cont_form flex js">

        <div class="section_top">
          <div class="area_title">
            <h1>Informations</h1>
          </div>

          <div class="icons_list icons_list_2" style="margin-left: 0; margin-top: 1rem;">
            <div class="informs contacts_email">
              <div class="icon_box icon_box_1">
                <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon">
              </div>
              <h2 style="margin-left: 2rem;">이메일 : webskills@skills.com</h2>
            </div>
            <div class="informs contacts_call">
              <div class="icon_box icon_box_2">
                <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon" style="left: -371px; top: -87px">
              </div>
              <h2 style="margin-left: 2rem;">전화번호 : 123-456-7890</h2>
            </div>
            <div class="informs contacts_ad">
              <div class="icon_box icon_box_3">
                <img src="../resources/img/contact/icon.jpg" alt="icon" title="icon"  style="left: -371px; top: -229px">
              </div>
              <h2 style="margin-left: 2rem;">주소 : 부산시 해운대구 123</h2>
            </div>
          </div>
        </div>

        <div class="section_content" style="width: 70%;">
          <div class="area_title" style="margin-bottom: 1rem;">
            <h1>Contacts Form</h1>
          </div>

          <form class="contact_form" data-color="royalblue">
            <div class="flex alc js">
              <input type="text" name="name" placeholder="이름" required>
              <input type="text" name="email" placeholder="이메일" required>
            </div>
            
            <textarea placeholder="메시지" name="contants" cols="30" rows="10" required></textarea>

            <div class="after_line"></div>

            <button class="btn link">보내기</button>
          </form>
        </div>
      </div>
    </div>
  `,

  footer: () => `
    <footer>
      <div class="foo_rap wrap">
        <div class="after_line"></div>

        <div>
          <a href="#">
            <img src="../resources/logo.png" alt="logo" title="logo">
          </a>
        </div>

        <div class="foo_bot flex alc js">
          <p class="copy">
            부산국제매직페스티벌 | Busan International Magic Festival <br>
            부산시 해운대구 123 <br>
            TEL : 123-456-7890 | FAX : 098-765-4321 | E-mail : webskills@skills.com <br>
            <br>
            Copyrightⓒ 2019, webskills all right reserved
          </p>

          <div class="sns_icons">
            <img src="../resources/img/facebook.png" alt="sns" title="sns">
            <img src="../resources/img/kakao.png" alt="sns" title="sns">
            <img src="../resources/img/twitter.png" alt="sns" title="sns">
          </div>
        </div>
      </div>
    </footer>
  `
}