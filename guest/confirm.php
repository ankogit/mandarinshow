<? 
if ( !$_SESSION['confirm']['code'] ) not_found();

top('Подтверждение регистрации') ?>
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
                            <h2>Подтверждение регистрации</h2>
            </div>
            <div class="right_side">
                <div class="container_full_bg">
                    <form onsubmit="return false">
                    <p><span>Введите код подтверждения:</span><br><input class="s2_input" type="text" placeholder="Код" id="code"></p>
                    <p><button onclick="post_query('gform', 'confirm', 'code')">Подтвердить</button> </p>
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