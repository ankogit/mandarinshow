<? 
$META[title]='Статьи';
//$META[type]='<meta property="og:type" content="article"/>';
$META[url]='/';
$META[image]='http://mandarinshow.ru/assets/img/image_posts.png';
$META[description]='Добро пожаловать на наш интернет журнал MandarinShow, в котором вы можете как прочитать статьи так и стать автором, и написать свою статью на любую тему.';
$META[Keywords_ru]='Mandarin, show, mandarin-show, журнал, статьи, блог, арт, новости, заказ сайтов';
$META[Keywords_en]='Mandarin, show, mandarin-show, magazine, articles, blog, art, news, order sites';
$META[Description]='Добро пожаловать на наш интернет журнал MandarinShow, в котором вы можете как прочитать статьи так и стать автором, и написать свою статью на любую тему.';
$META[image_src]='/assets/img/main_bg.png';

top('Главная', 1, 1); 
$_SESSION['loader'] = 0;
?>
<script type="text/javascript">
    
function load_posts() {
    $.get('/loader', function ( data ) {

        if( data == 'emty' ) 
            $('#post_b').text('Пусто');

        if( data != 'end' ) 
            $('#post_b').append( data );
        else $("#load_p").detach();
    })
}


 $(document).ready(function() {
    load_posts();
 });


 var loading = false;
$(window).scroll(function(){
if((($(window).scrollTop()+$(window).height())+250)>=$(document).height()){
  if(loading == false){
  loading = true;
  $('#loadingbar').css("display","block");
  $.get('/loader', function ( data ) {
    setTimeout(function(){
    if( data != 'end' ) {
    $('#post_b').append( data );
    $('#loaded_max').val(parseInt($('#loaded_max').val())+50);
    $('#loadingbar').css("display","none");
    loading = false;
    }
    else $("#load_p").detach();
    $('#loadingbar').css("display","none");
    },500);
  });
  }
}
});
$(document).ready(function() {
$('#loaded_max').val(50);
});
</script>
<div class="container">
            <div class="row">
            
                <div class="col-md-12">
                    <section class="single-item slider">
                        <div class="slide">
                            <img src="/assets/img/slide_2_hp.jpg">
                        </div>
                        <div class="slide">
                            <img src="/assets/img/slide_1_hp.jpg">
                        </div>
                        <div class="slide">
                            <img src="/assets/img/slide_3_hp.jpg">
                        </div>
                    </section>
                </div>
                <!--<div class="col-md-9">
                    <section class="single-item slider">
                        <div class="slide">
                            <img src="/assets/img/screen.png">
                        </div>
                        <div class="slide">
                            <img src="/assets/img/fon_dlya_saita.png">
                        </div>
                        <div class="slide">
                            <img src="/assets/img/prevew-project.jpg">
                        </div>
                        <div class="slide">
                            <img src="/assets/img/finn312.jpg">
                        </div>
                    </section>
                </div>
                <div class="col-md-3">
                    <section class="single-item slider mini">
                        <div class="slide">
                          <img src="/assets/img/screen.png">
                        </div>
                        <div class="slide">
                          <img src="/assets/img/fon_dlya_saita.png">
                        </div>
                        <div class="slide">
                          <img src="/assets/img/prevew-project.jpg">
                        </div>
                    </section>
                </div>-->
            </div>
        </div>
                <section class="tabs_block">
                    <div class="container">
                        <div class="row">
                            <!--<div class="col-md-9">
                                
                                  <ul class="nav nav-pills">
                                    
                                    <li class="active"><a data-toggle="pill" href="#home"><span id="carbonads"> Menu </span>1</a></li>
                                    <li><a data-toggle="tab" href="#menu1"><span id="carbonads"> Menu </span>1</a></li>
                                    <li><a data-toggle="tab" href="#menu2"><span id="carbonads"> Menu </span> 2</a></li>
                                    <li><a data-toggle="tab" href="#menu3"><span id="carbonads"> Menu </span> 3</a></li>
                                    
                                  </ul>

                                  <div class="tab-content">
                                    <div id="home" class="tab-pane fade in active">
                                      <h3>HOME</h3>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                    <div id="menu1" class="tab-pane fade">
                                      <h3>Menu 1</h3>
                                      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                    </div>
                                    <div id="menu2" class="tab-pane fade">
                                      <h3>Menu 2</h3>
                                      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                                    </div>
                                    <div id="menu3" class="tab-pane fade">
                                      <h3>Menu 3</h3>
                                      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
                                    </div>
                                  </div>
                            </div>-->
                            <div class="col-md-7">
                                <div class="desc_main_page">
                                    <!--<div id="spinner1"></div><div id="spinner2"></div><div id="spinner"></div>-->
            
                                    <img src="/assets/img/welcome_hp.png" alt="">
                                    <p>Добро пожаловать на наш интернет журнал "MandarinShow", в котором вы можете как прочитать статьи так и стать автором, и написать свою статью на любую тему.</p>
                                </div>
                            </div>
                            <div class="col-md-5">
                                  <ul class="nav nav-pills">
                                    
                                    <li class="active"><a data-toggle="pill" href="#q">Статьи</a></li>
                                    <li><a data-toggle="tab" href="#w"> Блог</a></li>
                                    
                                  </ul>

                                  <div class="tab-content">
                                    <div id="q" class="tab-pane fade in active">
                                      <p>В рамках нашего сообщества "статьями" принято считать длинные и содержательные тексты с дополнительными элементами(картинки, видео, ссылки). А не которкие новости. Наши редакторы стараются обеспечить интересный, содержательный и грамотный текст, после прочтения которого вы узнаете что-то новое.</p>
                                    </div>
                                    <div id="w" class="tab-pane fade">
                                      <p>Функция блога или другими словами "живого журнала" на нашем сайте также предусмотренна. Вы можете публиковать свои новости и заметки как у себя на странице, так и создать свою новостную колонку.</p>
                                    </div>
                                  </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="info_box_block">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-sm-6">
                            <div class="info_box">
                                <div class="icon icolor_v1"><i class="fa fa-newspaper-o" aria-hidden="true"></i></div>
                                <h2>Mandarin`s Articles</h2>
                                <p>Здесь вы можете прочитать различные статьи.</p>
                                <a href="/news"><button class="submit">Перейти</button></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info_box">
                                <div class="icon icolor_v2"><i class="fa fa-id-card-o" aria-hidden="true"></i></div>
                                <h2>Mandarin`Blog </h2>
                                <p>Astehicula ultricies. Integer venenatis mattis nisl, vitae pulvinar dui tempor non. </p>
                                <button class="submit">Comming soon</button>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info_box">
                                <div class="icon icolor_v4"><i class="fa fa-picture-o" aria-hidden="true"></i></div>
                                <h2>Anko ArtBlog </h2>
                                <p>Арт блог для ценителей искусства и не только.</p>
                                <a href="/art"><button class="submit">Перейти</button></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <div class="info_box ">
                                <div class="icon"><i class="fa fa-code" aria-hidden="true"></i></div>
                                <h2>Mandarin`s dev</h2>
                                <p>Страница где вы можете заказать сайт, а также узнать о разработке или предложить идеи для данного проекта</p>
                                <button class="submit">Comming soon</button>
                            </div>
                        </div>
                    </div>
                </div>
                </section>
                <!--
                <section class="accordion_block">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <h2>Accordion with symbols</h2>
                                <p>In this example we have added a "plus" sign to each button. When the user clicks on the button, the "plus" sign is replaced with a "minus" sign.</p>
                                <button class="accordion">Section 1</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>

                                <button class="accordion">Section 2</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>

                                <button class="accordion">Section 3</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button class="accordion">Section 1</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>

                                <button class="accordion">Section 2</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                </div>

                                <button class="accordion">Section 3</button>
                                <div class="panel">
                                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="gallery">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/finn312.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="gall_item gitem ">
                                    <img src="/assets/img/finn312.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="gall_item gitem ">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                        <hr>
                            <h1>Heading h1</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-12">
                            <h1>Заголовок h1</h1>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-6">
                            <h2>Heading h2</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-6">
                            <h2>Heading h2</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-9">
                            <h2>Heading 2</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-3">
                            <h2>Heading 2</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-3">
                            <h3>Heading 3</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-3">
                            <h3>Heading 3</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-3">
                            <h3>Heading 3</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                        <div class="col-md-3">
                            <h3>Heading 3</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Delectus saepe incidunt est aliquam, harum excepturi architecto vero nostrum. Qui pariatur, aperiam reiciendis necessitatibus reprehenderit voluptatem perspiciatis unde quisquam ea quis.</p>
                        </div>
                    </div>
                </div>
                <section class="lists">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3">
                                <h2>List font size 14px</h2>
                                <ul class="lists">
                                    <li class="arrow_red">Quisque at massa ips</li>
                                    <li class="cross_red">Quisque at massa ips</li>
                                    <li class="circle_red">Quisque at massa ips</li>
                                    <li class="check_red">Quisque at massa ips</li>
                                    <li class="plus_red">Quisque at massa ips</li>
                                    <li class="arrow_red">Quisque at massa ips</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h3>Heading 3</h3>
                                <ul class="lists">
                                    <li class="arrow_green">Quisque at massa ips</li>
                                    <li class="cross_green">Quisque at massa ips</li>
                                    <li class="circle_green">Quisque at massa ips</li>
                                    <li class="check_green">Quisque at massa ips</li>
                                    <li class="plus_green">Quisque at massa ips</li>
                                    <li class="arrow_green">Quisque at massa ips</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h3>Heading 3</h3>
                                <ul class="lists">
                                    <li class="arrow_green">Quisque at massa ips</li>
                                    <li class="cross_green">Quisque at massa ips</li>
                                    <li class="circle_green">Quisque at massa ips</li>
                                    <li class="check_green">Quisque at massa ips</li>
                                    <li class="plus_green">Quisque at massa ips</li>
                                    <li class="arrow_green">Quisque at massa ips</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <h3>Heading 3</h3>
                                <ul class="lists">
                                    <li class="arrow_red">Quisque at massa ips</li>
                                    <li class="cross_red">Quisque at massa ips</li>
                                    <li class="circle_red">Quisque at massa ips</li>
                                    <li class="check_red">Quisque at massa ips</li>
                                    <li class="plus_red">Quisque at massa ips</li>
                                    <li class="arrow_red">Quisque at massa ips</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </section>
                -->
                </div></div></div>
                <section class="faq">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h1>Ход добавления статьи:</h1>
                            </div>
                                <div class="col-sm-4"><div class="block one" id="arrow"><p><a href="/login">Авторизация</a></p></div></div>
                                <div class="col-sm-4"><div class="block two" id="arrow"><p><a href="/category">Выбор темы</a></p></div></div>
                                <div class="col-sm-4"><div class="block three"><p><a href="<?=($_SESSION[id]?"/post/add":"/login")?>">Написание статьи</a></p></div></div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="container"><div class="row"><div class="block">
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новые статьи:</h3>
                            <?
                            $new_post = mysql_query("SELECT * FROM posts WHERE `active` = 1 ORDER BY id DESC LIMIT 4");
                            while ($Row = mysql_fetch_assoc($new_post)) {

                            printf('
                                <div class="col-md-6">
                                    <a href="/news/id/'.$Row[id].'">
                                        <div class="suggest_item" style="background-image: url('.$Row[img].');">
                                            <div class="suggest_item_desc">
                                                <h3>'.$Row[title].'</h3>
                                                <span>'.$Row[date].'</span>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                ');

                            }
                            ?>
                        </div>
                        <div class="col-md-4">
                        <a class="twitter-timeline"  href="https://twitter.com/mymandarinchik" data-widget-id="708031427682701312">Твиты от @mymandarinchik</a>
                        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        </div>
                    </div>
                </div>
            
                            <hr>
                        
                            <div class="table_block">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="bg_red white"><i class="fa fa-check-circle-o" aria-hidden="true"></i> Возможности сайта:</th>
                                        <th class="bg_red white">Зарегистрированный</th>
                                        <th class="bg_red white">Гость</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Адаптивный дизайн</td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Кроссплатформенность</td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        </tr>
                                        <tr>
                                            <td>Просмотр статей</td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        </tr>
                                      <tr>
                                        <td>Написание статей</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="success">
                                        <td>Обсуждения</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr>
                                            <td>Просмотр арт галлереи</td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                            <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        </tr>
                                      <tr class="danger">
                                        <td>Личные сообщения</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="info">
                                        <td>Тех.Поддержка</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="warning">
                                        <td>Личная страница</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="warning">
                                        <td>Друзья</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="active">
                                        <td>Загрузка</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></td>
                                      </tr>
                                      <tr class="active">
                                        <td>Скачка</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                      </tr>
                                      <tr class="active">
                                        <td>Выбор личных категорий и голосование</td>
                                        <td><i class="fa fa-check" aria-hidden="true"></i></td>
                                        <td><i class="fa fa-minus" aria-hidden="true"></i></td>
                                      </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                        


                        <section class="attention_line">
                            <div class="container ">
                                <div class="row order">
                                    <div class="col-md-9">
                                        <div class="order_descr">
                                            <div class="order_descr">Стать модератором</div>
                                                <p>Если вам нравится чтение, написание, а также проверка статей, то у вас есть возможность стать модератором сайта. И если вы активный, то вам будут начисляться шекели.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <a href="/contact"><button class="submit">Подробнее...</button></a>
                                    </div>
                                </div>
                            </div>
                        </section>

                        <!--
                        <h1>Линия без описания</h1>
                        <section class="attention_line">
                            <div class="container ">
                                <div class="row order">
                                    <div class="col-md-9">
                                        <div class="order_descr">
                                            <div class="order_descr">Арты, рисунки, обработка фото</div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="submit">Заказать</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                        <h1>Линия с описанием</h1>
                        <section class="attention_line">
                            <div class="container ">
                                <div class="row order">
                                    <div class="col-md-9">
                                        <div class="order_descr">
                                            <div class="order_descr">Арты, рисунки, обработка фото</div>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Enim at autem, quae placeat dolorem accusamus, magni asperiores dicta ratione voluptas. Quos nisi veritatis quam iusto, hic a! Fugiat, minima, nisi.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <button class="submit">Заказать</button>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
                
                <section class="table">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                            <h1>Table</h1>
                            <div class="table_block">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th>Firstname</th>
                                        <th>Lastname</th>
                                        <th>Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Default</td>
                                        <td>Defaultson</td>
                                        <td>def@somemail.com</td>
                                      </tr>      
                                      <tr class="success">
                                        <td>Success</td>
                                        <td>Doe</td>
                                        <td>john@example.com</td>
                                      </tr>
                                      <tr class="danger">
                                        <td>Danger</td>
                                        <td>Moe</td>
                                        <td>mary@example.com</td>
                                      </tr>
                                      <tr class="info">
                                        <td>Info</td>
                                        <td>Dooley</td>
                                        <td>july@example.com</td>
                                      </tr>
                                      <tr class="warning">
                                        <td>Warning</td>
                                        <td>Refs</td>
                                        <td>bo@example.com</td>
                                      </tr>
                                      <tr class="active">
                                        <td>Active</td>
                                        <td>Activeson</td>
                                        <td>act@example.com</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                                
                            </div>
                            <div class="col-md-6">
                            <h1>Table</h1>
                            <div class="table_block">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="bg_green white">Firstname</th>
                                        <th class="bg_green white">Lastname</th>
                                        <th class="bg_green white">Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Default</td>
                                        <td>Defaultson</td>
                                        <td>def@somemail.com</td>
                                      </tr>      
                                      <tr class="success">
                                        <td>Success</td>
                                        <td>Doe</td>
                                        <td>john@example.com</td>
                                      </tr>
                                      <tr class="danger">
                                        <td>Danger</td>
                                        <td>Moe</td>
                                        <td>mary@example.com</td>
                                      </tr>
                                      <tr class="info">
                                        <td>Info</td>
                                        <td>Dooley</td>
                                        <td>july@example.com</td>
                                      </tr>
                                      <tr class="warning">
                                        <td>Warning</td>
                                        <td>Refs</td>
                                        <td>bo@example.com</td>
                                      </tr>
                                      <tr class="active">
                                        <td>Active</td>
                                        <td>Activeson</td>
                                        <td>act@example.com</td>
                                      </tr>
                                    </tbody>
                                  </table>
                            </div>
                                
                            </div>
                            <div class="col-md-6">
                            <h1>Table</h1>
                            <div class="table_block">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="bg_red white">Firstname</th>
                                        <th class="bg_red white">Lastname</th>
                                        <th class="bg_red white">Email</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>Default</td>
                                        <td>Defaultson</td>
                                        <td>def@somemail.com</td>
                                      </tr>      
                                      <tr class="success">
                                        <td>Success</td>
                                        <td>Doe</td>
                                        <td>john@example.com</td>
                                      </tr>
                                      <tr class="danger">
                                        <td>Danger</td>
                                        <td>Moe</td>
                                        <td>mary@example.com</td>
                                      </tr>
                                      <tr class="info">
                                        <td>Info</td>
                                        <td>Dooley</td>
                                        <td>july@example.com</td>
                                      </tr>
                                      <tr class="warning">
                                        <td>Warning</td>
                                        <td>Refs</td>
                                        <td>bo@example.com</td>
                                      </tr>
                                      <tr class="active">
                                        <td>Active</td>
                                        <td>Activeson</td>
                                        <td>act@example.com</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </section>
                        -->
<!--<div id="post_b">
    
</div>
<div id="loadingbar"></div>
<button id="load_p" onclick="load_posts()">Ещё</button>
-->
<? bottom() ?>