<?


if ($_POST['enter'] && ($_FILES['file']['tmp_name'] OR $_FILES['img']['tmp_name'])) {
    //if ($_FILES['img']['type'] != 'image/jpeg' AND $_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не верный тип изображения.');
    /*$_POST['name'] = FormChars($_POST['name']);
    $_POST['text'] = FormChars($_POST['text']);
    $_POST['link'] = FormChars($_POST['link']);
    $_POST['cat'] += 0;*/


    if ($_FILES['file']['tmp_name']) {
        if ($_FILES['file']['type'] != 'application/octet-stream') MessageSend(2, 'Не верный тип файла.');
    } else $num_img = 0;

    if ($_FILES['img']['tmp_name']) {
        if ($_FILES['img']['type'] != 'image/jpeg') MessageSend(2, 'Не верный тип изображения.');
    } else $num_file = 0;

    $MaxId = mysql_fetch_row(mysql_query('SELECT max(`id`) FROM `loader`'));
    if ($MaxId[0] == 0) mysql_query('ALTER TABLE `loader` AUTO_INCREMENT = 1');
    $MaxId[0] += 1;


    if ($_FILES['img']['tmp_name']) {
        //if ($_FILES['img']['type'] == 'image/jpeg' OR $_FILES['img']['type'] == 'image/png') {
            foreach(glob('assets/img/catalog/img/*', GLOB_ONLYDIR) as $num => $Dir) {
                $num_img ++;
                $Count = sizeof(glob($Dir.'/*.*'));
                if ($Count < 250) {
                move_uploaded_file($_FILES['img']['tmp_name'], $Dir.'/'.$MaxId[0].'.jpg');
                break;
                }
            }
    MiniIMG('assets/img/catalog/img/'.$num_img.'/'.$MaxId[0].'.jpg', 'assets/img/catalog/mini/'.$num_img.'/'.$MaxId[0].'.jpg', 220, 220);
        //} else MessageSend(2, 'Не верный тип изображения.');
    }
    if ($_FILES['file']['tmp_name']) {
        foreach(glob('assets/img/catalog/file/*', GLOB_ONLYDIR) as $num => $Dir) {
            $num_file ++;
            $Count = sizeof(glob($Dir.'/*.*'));
            if ($Count < 250) {
            move_uploaded_file($_FILES['file']['tmp_name'], $Dir.'/'.$MaxId[0].'.zip');
            break;
            }
        }
    }
    $date = date("Y-m-d H:i:s");
    mysql_query('INSERT INTO loader (`id`, `added`, `dimg`, `dfile`, `date`) VALUES ("'.$MaxId[0].'", "'.$_SESSION[id].'", "'.$num_img.'", "'.$num_file.'", "'.$date.'")') or die(mysql_error());
    MessageSend(2, 'Файл добавлен', '/link/copy/id/'.$MaxId[0].'');
}

?>


<?
top('💾 Загрузка файлов на сервер');
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
                            <h2>Ссылка: </h2>
            </div>
            <div class="right_side" style="color: #fff;">
                <div class="container_full_bg">
                <form method="POST" action="/load" enctype="multipart/form-data">
                <br>(Файл)<br><input type="file" name="file"> 
                <br><br>(Изображение)<input type="file"  name="img"> 
                <br><br><input type="submit" name="enter" value="Добавить"> <input type="reset" value="Очистить">
                </form>
                </div>
        </div>
        
    </div>
<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.4.0/clipboard.min.js"></script>
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


<?
bottom();
?>