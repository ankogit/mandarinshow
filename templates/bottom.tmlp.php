<? 
top('Вход');
   MessageShow();
 ?>
<div class="maineer">
    <div class="auth-wrap-background visible">
        <div class="auth-tiling-bg" id="sovet" >
        </div>
        <div class="auth-wrap-background visible">
            <div class="auth-background" id="sovet1" >
            </div>
        </div>
        
            <div class="auth-center">
                <div class="auth-blur border_r_block" >
                    <div class="auth-wrap-background visible">
                        <div class="auth-background" id="sovet2" >
                        </div>
                    </div>
                </div>
            </div>
        
    </div>
        <div class="center_block">
            <div class="left_side">
                            <img src="/assets/img/main_iconv2.png" alt="">
                            <h2>Вход</h2>
            </div>
            <div class="right_side">
                <div class="container_full_bg">
                <form onsubmit="return false" >
                <p><input class="s2_input" type="text" placeholder="E-mail" id="email"></p>
                <p><input class="s2_input" type="password" placeholder="Пароль" id="password">
                <br><a href="/recovery">Забыли пароль?</a></p>
                <p><input class="s2_input" type="text" placeholder="<?captcha()?>" id="captcha"></p>
                <p><button onclick="post_query('gform', 'login', 'email.password.captcha')">Войти</button> <!--<button class="submit_v2" onclick="go('recovery')">Зарегистрироваться</button>-->
                <br><span id="reg_q">Ещё нет аккаунта? <a class="white" href="/register">Зарегистрироваться</a></span>
                </p>
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