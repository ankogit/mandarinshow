<?
top('');
MessageShow();
if($module=='copy' AND $Param[id]) {

    $query = mysql_query("SELECT * FROM `loader` WHERE `id` = $Param[id]");
    if (!empty($query) AND mysql_num_rows($query)) {
        $queryF = mysql_fetch_array($query);
        if($queryF[added]==$_SESSION[id] || $_SESSION[id]==2) {
            $dimg = $queryF[dimg];
            $dfile = $queryF[dfile];
            $file = $queryF[id];
            echo $file;
            if ($dimg!=0 AND $dfile==0) {
                function show_links ($id) {
                     $query = mysql_query("SELECT * FROM `loader` WHERE `id` = $id");
                     $queryF = mysql_fetch_array($query);
                     $dimg = $queryF[dimg];
                     $file = $queryF[id];
                    ?><p>Картинка: <input class="s2_input" id="post-shortlink" type="text" value="https://<?=$_SERVER[HTTP_HOST]?>/assets/img/catalog/img/<?=$dimg?>/<?=$file?>.jpg" ></p>
                   <button class="button" id="copy-button" data-clipboard-target="#post-shortlink">Копировать</button>
                    <?
                }
            } else if ($dfile!=0 AND $dimg==0) {
                function show_links ($module) {
                    $query = mysql_query("SELECT * FROM `loader` WHERE `id` = $module");
                     $queryF = mysql_fetch_array($query);
                     $dfile = $queryF[dfile];
                     $file = $queryF[id];
                    ?><p>Файл: <input class="s2_input" id="post-shortlink2" type="text" value="<?=$_SERVER[HTTP_HOST]?>/assets/img/catalog/file/<?=$dfile?>/<?=$file?>.zip" ></p>
                    <button class="button" id="copy-button2" data-clipboard-target="#post-shortlink2">Копировать</button><?
                }
            } else if ($dimg!=0 AND $dfile!=0) {
                function show_links ($id) {
                     $query = mysql_query("SELECT * FROM `loader` WHERE `id` = $id");
                     $queryF = mysql_fetch_array($query);
                     $dimg = $queryF[dimg];
                     $dfile = $queryF[dfile];
                     $file = $queryF[id];
                    ?>
                    <p>Картинка: <input class="s2_input" id="post-shortlink" type="text" value="<?=$_SERVER[HTTP_HOST]?>/assets/img/catalog/img/<?=$dimg?>/<?=$file?>.jpg" ></p>
                   <button class="button" id="copy-button" data-clipboard-target="#post-shortlink">Копировать</button>
                    <p>Файл: <input class="s2_input" id="post-shortlink2" type="text" value="<?=$_SERVER[HTTP_HOST]?>/assets/img/catalog/file/<?=$dfile?>/<?=$file?>.zip" ></p>
                    <button class="button" id="copy-button2" data-clipboard-target="#post-shortlink2">Копировать</button>
                    <?
                }
            } else {
                function show_links () {
                    ?>
                    <p>Ничего нет</p>
                    <?
                }
            }
        }
    } else {
        function show_links () {
                    ?>
                    <p>Ничего нет</p>
                    <?
        }
    }


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
                            <h2>Ссылка: </h2>
            </div>
            <div class="right_side">
                <div class="container_full_bg">
                <?if($module=='copy') if($Param[id]) show_links ($Param[id]);?>
            </div>
        </div>
        
    </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
<script>
        $(document).ready(function () {
            new Clipboard('#copy-button');
            new Clipboard('#copy-button2');

            $("#copy-button").click(function() {
                function func() {
                  $("#copy-button").text('Копировать');
                }
                $("#copy-button").text('Скопировано');
                setTimeout(func, 1500);
            });
            $("#copy-button2").click(function() {
                function func() {
                  $("#copy-button2").text('Копировать');
                }
                $("#copy-button2").text('Скопировано');
                setTimeout(func, 1500);
            });
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

<?
} else if($module=='files') {
    $query = mysql_query("SELECT * FROM `loader` WHERE `added` = $_SESSION[id]");
    if(!empty($query) AND mysql_num_rows($query)) {
        echo '<div class="container-block_white files_grid">';
        echo "<h1>Мои загрузки:</h1>";
        while ($Row = mysql_fetch_assoc($query)) {
            echo '
                <a href="/link/copy/id/'.$Row[id].'">
                '.(($Row[dimg]!=0)? '
                    <img src="/assets/img/catalog/mini/'.$Row[dimg].'/'.$Row[id].'.jpg" alt="">
                    ' : '
                    <img src="/assets/img/avatars/avatar.jpeg" alt="">
                    ').'
                '.(($Row[dfile]!=0)? '+ file' : '').'
                Запись '.$Row[id].'</a>
                <br>
            ';
        }
        echo "</div>";
    } else echo 'Ещё нет файлов';
} else echo "Ошибка";
bottom();