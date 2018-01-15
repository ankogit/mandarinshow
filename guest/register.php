<?
$META[title]='Вход/Логинизация';

$META[url]='/ad';
$META[image]='http://mandarinshow.ru/assets/img/login_bg.jpg';
$META[description]='Войти в';
$META[Keywords_ru]='Mandarin, show, регистрация, войти';
$META[Keywords_en]='Mandarin, show, sign in, sign in, sign in';
$META[image_src]='/assets/img/login_bg.jpg';

 top('Регистрация') ?>
<div class="maineer">
    <div class="auth-wrap-background visible">
        <div class="auth-tiling-bg" id="sovet" >
        </div>
        <div class="auth-wrap-background visible">
            <div class="auth-background" id="sovet1" >
            </div>
        </div>
        
            <div class="auth-center">
                <div class="auth-blur border_r_block block400px" >
                    <div class="auth-wrap-background visible">
                        <div class="auth-background" id="sovet2" >
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
        <div class="center_block block400px">
            <div class="left_side">
                            <img src="/assets/img/main_iconv2.png" alt="">
                            <h2>Регистрация</h2>
            </div>
            <div class="right_side">
                <div class="container_full_bg">
                    <form onsubmit="return false">
                    <p><input class="s2_input" type="text" placeholder="Введите никнейм" id="nickname"></p>
                    <p><input class="s2_input" type="text" placeholder="E-mail" id="email"></p>
                    <p><input class="s2_input" type="password" placeholder="Пароль" id="password"></p>
                    <p><input class="s2_input" type="password" placeholder="Повторить пароль" id="rep_password"></p>
                    <p><input class="s2_input" type="text" placeholder="<?captcha()?>" id="captcha"></p>
                    <p><button onclick="post_query('gform', 'register', 'nickname.email.password.rep_password.captcha')">Регистрация</button></p>
                    </form>
                </div>
            </div>
        </div>
        
    </div>




<script>
        $(document).ready(function () {
        //рандомное педложение
    var quotes = new Array;
    $.get('/assets/img.txt', function(data){
        quotes = data.split('\n');
        //console.log(quotes);
 
    var randno = Math.floor(Math.random() * quotes.length);
    var sovet = quotes[randno];
    $('#sovet').css({
         backgroundImage:"url(/assets/img/" + sovet + ")"
         });
    $('#sovet1').css({
         backgroundImage:"url(/assets/img/" + sovet + ")"
         });
    $('#sovet2').css({
         backgroundImage:"url(/assets/img/" + sovet + ")"
         });
    });
    });
    </script>
<? bottom() ?>