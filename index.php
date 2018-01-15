<?
$name_web_site = "mandarinshow.ru"; //Название сайта
$admin_email = "ya.tolik-a@yandex.ru"; //Почта админа
$admin_login = "root"; //Логин админа
$admin_pass = ""; //Пароль админа

if ( $_SERVER['REQUEST_URI'] == '/') {
    $page = "home";
    $module = "home";
}
else {
        $URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $URL_Parts = explode('/', trim($URL_Path, ' /'));
        $page = array_shift($URL_Parts);
        $module = array_shift($URL_Parts);


        if (!empty($module)) {
        $Param = array();
        for ($i = 0; $i < count($URL_Parts); $i++) {
        $Param[$URL_Parts[$i]] = $URL_Parts[++$i];
        }
        
        }
    if ( !preg_match('/^[A-z0-9]{2,15}$/', $page) ) exit('error url');
}

$CONNECT = mysql_connect("127.0.0.1","root","") or die(mysql_error());
 mysql_select_db("phprun") or die(mysql_error());

session_start();

if ($_SESSION['id']) {
    $_SESSION['logged'] = 'TRUE';
}
else $_SESSION['logged'] = 'FALSE';

if ( file_exists('all/'.$page.'.php') ) include 'all/'.$page.'.php';
else if ( $_SESSION['id'] and file_exists('auth/'.$page.'.php') ) include 'auth/'.$page.'.php';
else if ( !$_SESSION['id'] and file_exists('guest/'.$page.'.php') ) include 'guest/'.$page.'.php';
else if ( $_SESSION['group_u']>=2 and file_exists('admin/'.$page.'.php') ) include 'admin/'.$page.'.php';
else if ( $_SERVER['REQUEST_URI'] == '/') include 'all/index.php';
else include 'error/page-404.php';

function message($text) {
    exit ('{"message" : "'.$text.'"}');
}

function like($data) {
    exit ('{"like" : "'.$data.'"}');
}

function go( $url ) {
    exit ('{"go" : "'.$url.'"}');
}

function cform() {
    exit ('{"select" : ":input"}');
}

function random_str( $num = 30 ) {
    return substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, $num);
}

function captcha() {
    $questions = array(
        1 => 'Фамилия Толстого?',
        2 => 'Фамилия Чехова?',
        3 => 'Фамилия Достоевского?',
        4 => 'Фамилия Гололя?',
        5 => 'Фамилия Тургенева?',
        );
    $num = mt_rand(1, count($questions) );
    $_SESSION['captcha'] = $num;

    echo $questions[$num];
}

function captcha_valid() {
    $answers = array(
        1 => 'толстой',
        2 => 'чехов',
        3 => 'достоевский',
        4 => 'гоголь',
        5 => 'тургенев',
        );
    $strtolower = mb_strtolower($_POST['captcha'], 'UTF-8');
    if ( $_SESSION['captcha'] != array_search( $strtolower, $answers) )
        message('Ответ на капчу не верен! Попробуйте в другой раз..');
}

function MessageSend($p1, $p2, $p3 = '', $p4 = 1) {
if ($p1 == 1) $p1 = 'Ошибка';
else if ($p1 == 2) $p1 = 'Подсказка';
else if ($p1 == 3) $p1 = 'Информация';
$_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
if ($p4)  Location($p3);
}
function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
unset($_SESSION['message']);
}

function Location ($p1) {
if (!$p1) $p1 = $_SERVER['HTTP_REFERER'];
exit(header('Location: '.$p1));
}

function PageSelector($p1, $p2, $p3, $p4 = 5) {
/*
$p1 - URL (Например: /news/main/page)
$p2 - Текущая страница (из $Param['page'])
$p3 - Кол-во новостей
$p4 - Кол-во записей на странице
*/
$num = 5;
//общее число страниц
$total = intval((($p3[0] - 1) / $p4) + 1); 
/*echo "Всего страниц";
echo $total; 
echo "Мы на странице";
echo $p2;*/
//if($p2 > $total OR $p2 < 0) not_found();
if($p3 > $total) $page = $total;
$Page = ceil($p3[0] / $p4); //делим кол-во новостей на кол-во записей на странице.
    if ($Page > 1) { //А нужен ли переключатель?
        echo '<div class="col-xs-12">
                <div class="navigator">';
            if ($p2 > 2) {
                echo '<a href="'.$p1.'1" class="hidden-xs"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a>';
            }
            if ($p2 > 1) {
                echo '<a href="'.$p1.($p2 - 1).'"><i class="fa fa-angle-left" aria-hidden="true"></i></a>';
            }
            for($i = ($p2 - 1); $i < ($Page + 1); $i++) {
                if ($i > 0 and $i <= ($p2 + 1)) {
                    if ($p2 == $i) $Swch = 'active';
                else $Swch = 'SwchItem';
                echo '<a class="'.$Swch.'" href="'.$p1.$i.'">'.$i.'</a>';
                }
            }
            if ($p2 < $total - 2) {
                echo '<p class="hidden-xs"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></p><a href="'.$p1.$total.'" class="hidden-xs">'.$total.'</a>';
            }
            if ($p2 != $total) {
                echo '<a href="'.$p1.($p2 + 1).'"><i class="fa fa-angle-right" aria-hidden="true"></i></a>';
            }
            if ($p2 < ($total - 1)) {
                echo '<a href="'.$p1.$total.'" class="hidden-xs"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a>';
            }
        echo '</div>
            </div>';
        }
}

function sendmessage($sender, $subj) {
global $CONNECT;
//$sender = FormChars($p1, 1);
//$recipient = FormChars($p2);

if ($sender == $_SESSION['email']) message('Вы не можете отправить сообщение самому себе');

$m_q_user = mysql_fetch_assoc(mysql_query("SELECT `id` FROM `users` WHERE `email` = '$sender'"));

if (!$m_q_user) message('Пользователь не найден');

$m_q_dialog = mysql_fetch_assoc(mysql_query("SELECT `id` FROM `dialog` WHERE `recive` = $m_q_user[id] AND `send` = $_SESSION[id] OR `recive` = $_SESSION[id] AND `send` = $m_q_user[id]"));

if ($m_q_dialog) {

    $DID = $m_q_dialog['id'];
    mysql_query("UPDATE `dialog` SET `status` = 0, `send` = $_SESSION[id], `recive` = $m_q_user[id] WHERE `id` = $m_q_dialog[id]");
printf('обновили');
    } else {
    mysql_query("INSERT INTO `dialog` VALUES ('', 0, $_SESSION[id], $m_q_user[id])");
    $DID = mysql_insert_id();
    printf('создали');
    }
    mysql_query("INSERT INTO `message` VALUES ('', $DID, $_SESSION[id], '$subj', NOW())");
    //$DID = mysql_insert_id();
    echo $m_q_user['id'];
    echo $_SESSION['id'];
    echo $m_q_dialog['id']; 
    echo 'did'; 
    echo $DID;
        
}

function MiniIMG($p1, $p2, $p3, $p4, $p5 = 50) {
    /*
    $p1 - Путь к изображению, которое нужно уменьшить.
    $p2 - Директория, куда будет сохранена уменьшенная копия.
    $p3 - Ширина уменьшенной копии.
    $p4 - Высота уменьшенной копии.
    $p5 - Качество уменьшенной копии.
    */
    $Scr = imagecreatefromjpeg($p1);
    $Size = getimagesize($p1);
    $Tmp = imagecreatetruecolor($p3, $p4);
    imagecopyresampled($Tmp, $Scr, 0, 0, 0, 0, $p3, $p4, $Size[0], $Size[1]);
    imagejpeg($Tmp, $p2, $p5);
    imagedestroy($Scr);
    imagedestroy($Tmp);
}

function my_avatar() {
    if (!empty($_SESSION['avatar'])) {
    echo '<img src="/assets/img/avatars'.$_SESSION['avatar'].'.jpg" alt="avatar">';
    } else {
        echo '<img src="/assets/img/avatars/avatar.jpeg" alt="avatar">';
    }
}

function check_admin () {
    if ($_SESSION['group_u']!=2) MessageSend(1, 'Нет доступа', '/404', 1);
}

function email_valid() {
    if ( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
        message('E-mail указан неверно');
}

function password_valid() {
    if (!preg_match('/^[A-z0-9]{6,15}$/', $_POST['password']) )
        message('Пароль указан неверно. Критерии: A-z0-9, и от 6 до 15 символов');
    $_POST['password'] = md5($_POST['password']);
}
function nickname_valid() {
    if (!preg_match('/^[A-z0-9_-]{5,15}$/', $_POST['nickname']) )
        message('Ник указан неверно. Критерии: A-z0-9 и от 5 до 15 символов');
}
function url_valid() {
    //if (!preg_match('/^(http|https|ftp)://([A-Z0-9][A-Z0-9_-]*(?:.[A-Z0-9][A-Z0-9_-]*)+):?(d+)?/?/i', $_POST['url'])) 
        message('Url указан не верно!');
}
function name_valid() {
    if (!preg_match( '/^([а-яА-ЯЁёa-zA-Z]+)$/u', $_POST['name']) )
        message('Имя или Фамилия указано неверно');
}
function sur_name_valid() {
    if (!preg_match( '/^([а-яА-ЯЁёa-zA-Z]+)$/u', $_POST['sur_name']) )
        message('Имя или Фамилия указано неверно');
}
function country_valid() {
    if (!preg_match( '/^([а-яА-ЯЁёa-zA-Z]+)$/u', $_POST['country']) )
        message('Страна указана неверно');
}
function year_valid() {
    if (!preg_match( '/^([0-9]{4})$/', $_POST['year']) )
        message('Год рожденья указан неверно. 4 цифры');
}
function password_repeat() {
    if ($_POST['password']!=$_POST['rep_password']) message('Пароли не совпадают!');
}

function hideEmail ( $email ) {
    $explode = explode('@', $email);
    return $explode[0].'@******';
}

function FormChars($p1, $p2 = 0) {
if ($p2) return mysql_real_escape_string($p1);
else return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}

function bbcode ($text) {
    $search = array(
        '[header]',
        '[/header]',
        '[quote]',
        '[/quote]',
        '[b]',
        '[/b]',
        '[i]',
        '[/i]',
        '[u]',
        '[/u]',
        '[url=',
        ']name=',//[url=irer.qwe]name=dawew.ew][/url]
        '[/url]',//[url=http://phprun1/post/edit/id/2]name=123[/url]
        '[audio]',
        '[/audio]',
        '[video]',
        '[/video]',
        '[slider]',
        '[/slider]',
        '[slide]',
        '[/slide]',
        '[img]',
        '[/img]',
        '[list]',
        '[/list]',
        '[list=1]',
        '[/list=1]',
        '[*]',
        '[/*]'
        );
    $replace = array(
        '<h2>',
        '</h2>',
        '<blockquote>',
        '</blockquote>',
        '<b>',
        '</b>',
        '<i>',
        '</i>',
        '<u>',
        '</u>',
        '<a href="',
        '">',
        '</a>',
        '<audio src"',
        '" controls></audio>',
        '<iframe src="https://www.youtube.com/embed/',
        '" width="640" height="480" frameborder="0"></iframe>',
        '<section class="single-item slider">',
        '</section>',
        '<div class="slide">',
        '</div>',
        '<img src="',
        '" />',
        '<ul>',
        '</ul>',
        '<ol>',
        '</ol>',
        '<li>',
        '</li>'
        );
    return str_replace($search, $replace, $text);
}
function check_bbcode($text) {
    $arr = array('b', 'i', 'u', 'audio', 'video', 'slider', 'slide', 'img', 'list', 'list=1', '*', 'header');
    foreach ($arr as $val) {
        if ( substr_count($text, "[$val]") != substr_count($text, "[/$val]") )
            message('Один или более BB кодов не закрыто');
    }
}
function check_active($p1) {
                if($p1==1) echo 'checked';
}
function my_advertising($type, $format, $link) {
    //--------------------
    //formats:
    //extended
    //square
    //rectangle
    //--------------------
    if($type=='art') {
        if($format=='extended') {
            printf('<a href="'.$link.'" target="_blank"><div class="advertising_art '.$format.' hidden-xs"></div></a>');
        }
    }
}

function user_nickname($uid) {
    return mysql_fetch_assoc( mysql_query("SELECT `nickname` FROM `users` WHERE `id`= $uid ") )[nickname];
}

function user_avatar($uid) {
    $avatar = mysql_fetch_assoc( mysql_query("SELECT `avatar` FROM `users` WHERE `id`= $uid ") )[avatar];
    if($avatar) {
        return '/assets/img/avatars'.$avatar.'.jpg';
    } else return '/assets/img/avatars/avatar.jpeg';
}

function not_found() {
    echo 'Page 404';
}

function top( $title, $preloader = 1, $enable_header = 0, $disenable_container = 1) {
    global $META;
echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">


    <meta property="og:title" content="'.$title.'"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="https://mandarinshow.ru'.$META[url].'"/>
    <meta property="og:image" content="'.$META[image_src].'"/>
    <meta property="og:site_name" content="mandarinshow.ru"/>
    <meta property="og:description" content="'.$META[Description].'"/>
    <META Name="Keywords" lang="ru" content="'.$META[Keywords_ru].' | Статьи | Сайты на заказ | Блог">
    <META Name="Keywords" lang="en-us" content="'.$META[Keywords_en].' | Posts | Web Develop | Blog">
    <META Name= Author Lang="ru" content="Антоненко и Co.">
    <META Name="Revisit" content="7">
    <META Name="description" content= "'.$META[Description].' | Статьи | Сайты на заказ | Блог">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="image_src" href="'.$META[image_src].'"/>


    <title>'.$title.' |Mandarin-Show</title>
    
    <script src="/assets//libs/pace/pace.min.js"></script>
    <script src="https://use.fontawesome.com/c40b7447b3.js"></script>

    <link rel="shortcut icon" href="/assets/img/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="/assets/img/favicon/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/img/favicon/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/img/favicon/apple-touch-icon-114x114.png">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" href="/assets/libs/bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="/assets/libs/animate/animate.css">
    
    <link rel="stylesheet" href="/assets/css/fonts.css">
    <link rel="stylesheet" href="/assets/css/preloader.css">
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/404.css">
    <link rel="stylesheet" href="/assets/css/media.css">
    
    <link rel="stylesheet" href="/assets/libs/wysibb/theme/default/wbbtheme.css" type="text/css" />

    <link rel="stylesheet" type="text/css" href="/assets/libs/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/assets/libs/slick/slick-theme.css">

    <link rel="stylesheet" href="/assets/libs/Magnific-Popup/magnific-popup.css" />
    <script src="/assets/libs/modernizr/modernizr.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js" crossorigin="anonymous"></script>
    <script src="/assets/scripts.js"></script>
    <script src="/assets/libs/Magnific-Popup/jquery.magnific-popup.min.js"></script>
    
    <script src="/assets/libs/jscroll/jquery.jscroll.min.js" type="text/javascript"></script>
    <script src="https://use.fontawesome.com/c40b7447b3.js"></script>
    <style type="text/css">
    html, body {
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
      font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    }

    .slider {
        width: 100%;
        margin: 0 auto;
    }

    .slick-slide {
      /*margin: 0px 20px;*/
    }

    .slick-slide img {
      width: 100%;
      
    }

    .slick-prev:before,
    .slick-next:before {
        color: black;
    }
    .slide {
        width:100px;
        /*max-height: 550px;*/
        overflow:hidden; 
        
         }
        header {
            background-color: #2980B9;
            width: 100%;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 120;
            height: 70px;
        }
        .top_line {
            /*background-color: #33414e;*/
            margin: 25px 0 25px 0;
            color: #fff;
        }


        
        table {
        font-size: 14px;
        border-radius: 10px;
        border-spacing: 0;
        text-align: center;
        width: 100%;
        }
        th {
        background: #ececec;
        color: #7f8c8c;
        padding: 10px 20px;
        border-bottom: 4px solid #e5e6e6;
        }
        th, td {
        border-style: solid;
        border-width: 0 1px 1px 0;
        border-color: #dddddd;
        color: #7f8c8c;
        }
        th.bg_green{
        border-bottom: 4px solid #e5e6e6 !important;
        border-color: #4e948d;
        }
        th.bg_blue{
            border-bottom: 4px solid #1d5477 !important;
            border-color: #1d5477;
            }
        th.bg_red{
        border-bottom: 4px solid #e5e6e6 !important;
        border-color: #b5423c;
        }
        th:first-child, td:first-child {
        text-align: left;
        }
        th:first-child {
        border-top-left-radius: 7px;
        }
        th:last-child {
        border-top-right-radius: 7px;
        border-right: none;
        }
        td {
        padding: 10px 20px;
        background: #f8f8f8;
        }/*
        tr:last-child td:first-child {
        border-radius: 0 0 0 7px;
        }
        tr:last-child td:last-child {
        border-radius: 0 0 7px 0;
        }*/
        tr td:last-child {
        border-right: none;
        }
        .table_block {
            border-radius: 6px;
            border-bottom: 4px solid #e5e6e6 !important;
        }
  </style>
  <link rel="stylesheet" href="/assets/css/bootstrap.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&amp;subset=cyrillic" rel="stylesheet">
  
    

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body class="bg_noise">
'.(($preloader==1) ? '
<div class="loader">
    <div class="preloader"></div>
    
</div>
    ' : '').'

<header id="header-nav" class="header-dark fixed">
    <canvas id="c" ></canvas>
    
    <a class="btn-hamburger js-slideout-toggle slide_menu_button" id="toggle"><span></span></a>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top_menu">
                        <ul>
                            <li class="active"><a href="/">Главная</a></li>
                            <li><a href="/news" >Статьи</a></li>
                            <li><a href="/art" >Арт</a></li>
                            <li><a href="/blog" >Блог</a></li>
                            <li><a href="/ad" >О нас</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
</header>
<nav id="menu" class="slideout-menu slideout-menu-left">
    <div class="menu">
    
    <div class="search_input">
        <form onsubmit="return false">
            <input type="search" id="search" placeholder="поиск">
            <button type="submit" onclick="submit_search()" class="btn_search" type="button"><i class="fa fa-search" aria-hidden="true"></i></button>
        </form>
    </div>
    
        '.(isset($_SESSION["id"]) ? '
    <p>Добро пожаловать <br><span>'.$_SESSION["nickname"].'</span></p>
    ' : '').'
<a class="visible-xs" href="/">Главная</a>
<a class="visible-xs" href="/news">Статьи</a>
<a class="visible-xs" href="/art">Арт</a>
<a href="/category/list">Категории</a>
 '.(($_SESSION["group_u"]>=1) ? '<a href="/ahome">Админ-Панель</a>' : '').'
 '.(isset($_SESSION["id"]) ? '
    <a href="/im">Диалоги <div id="counter"></div></a>
    <a href="/user/'.$_SESSION["id"].'">Мой профиль</a>
    <a href="/post/add">Написать статью</a>
    ' : '
    <a href="/login">Вход</a>
    <a href="/register">Регистрация</a>
    ').'
    <a href="/reviews">Отзывы</a>
    <a href="/contact">Обратная связь</a>
    <a class="visible-xs" href="/ad">О нас</a>
 '.(isset($_SESSION["id"]) ? '
    <a href="/logout">Выход</a>
    ' : '').'
    </div>
</nav>

<main id="panel">

  '.(($enable_header==1) ? '
<section class="mainer full-scroll">
          <span class="scroll-btn">
            <a href="#">
                <span class="mouse">
                    <span>
                    </span>
                </span>
            </a>
          <p>Листай вниз</p>
        </span>
</section>
    ' : '').'

<section class="main_content '.(($enable_header==1) ? 'full-scroll' : '').'" style="background-color: #'.$background.';">

                                '.(($disenable_container==1) ? '
                                    <div class="container">
                                        <div class="row">
                                            <div class="block">
                                            ' : '').'
';

}




function bottom() {
include 'assets/script-count.php';
echo '
                                </div>
                            </div>
                        </div>

</section>

<footer>
        <div class="container">
            <div class="row">
                
            
            <div class="col-md-2 col-sm-3">
                    <div class="footer_logo"></div>
                </div>
            <div class="col-md-8">
                    <!--<p class="red"">
                        Проект mandarinshow является социальной сетью, предназначенной для лиц, достигших совершеннолетнего возраста. Наша команда скрупулезно работает над тем, чтобы пользователи наконец-то смогли абстрагироваться от всего этого регресса в обществе, поглотившего все социальные сети. Для этого все публичные комментарии и посты будут модерироваться с блокировкой тех пользователей, которые будут мешать комфортно наслаждаться общению, с действительно умными и интересными людьми.
                    </p>-->
                </div>
            <div class="col-md-3 col-sm-3">
                                <h3 class="yellow">Основное</h3>
                                <ul class="lists">
                                    <li class="arrow_red"><a href="/">Главная</a></li>
                                    <li class="arrow_red"><a href="/">Статьи</a></li>
                                    <li class="arrow_red"><a href="/">Арт блог</a></li>
                                    <li class="arrow_red"><a href="/">Заказать сайт</a></li>
                                    <li class="arrow_red"><a href="/">Блог</a></li>
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <h3 class="red">Статьи</h3>
                                <ul class="lists">
                                    <li class="arrow_red"><a href="/news">Все статьи</li>
                                    <li class="arrow_red"><a href="/category">Категории</li>
                                    <li class="arrow_red"><a href="/search">Поиск</li>
                                    '.(($_SESSION[id]) ? '
                                    <li class="arrow_red"><a href="/post/add">Добавить статью</li>
                                    <li class="arrow_red"><a href="/category/add">Добавить категорию</li>
                                    ' : '').'
                                </ul>
                            </div>
                            <div class="col-md-3 col-sm-3">
                                <h3 class="blue">Связь</h3>
                                <ul class="lists">
                                    <li class="arrow_red"><a href="/contact">Обратная связь</a></li>
                                    <li class="arrow_red"><a href="/reviews">Отзывы</a></li>
                                    <li class="arrow_red"><a href="/ad">Кто мы?</a></li>
                                </ul>
                            </div>
                            
            </div>
        </div>
        <div class="footer_line">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-3 hidden-xs">
                        <p><i class="fa fa-code" aria-hidden="true"></i> by Anko</p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <div id="gotop" class="center_wh">
                            <a><h1><i class="fa fa-arrow-up" aria-hidden="true"></i> НАВЕРХ</h1></a>
                        </div>
                    </div>
                    <div class="col-xs-3 hidden-xs">
                        <p>(c)All rights reserved/2017</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</main>
<div class="hidden"></div>

    

    <!--[if lt IE 9]>
    <script src="libs/html5shiv/es5-shim.min.js"></script>
    <script src="libs/html5shiv/html5shiv.min.js"></script>
    <script src="libs/html5shiv/html5shiv-printshiv.min.js"></script>
    <script src="libs/respond/respond.min.js"></script>
    <![endif]-->

    <script src="/assets/libs/jquery/jquery-1.11.2.min.js"></script>
    <script src="/assets/libs/waypoints/waypoints.min.js"></script>
    <script src="/assets/libs/animate/animate-css.js"></script>
    <script src="/assets/libs/plugins-scroll/plugins-scroll.js"></script>
    <script src="/assets/libs/plugins-scroll/plugins-scroll.js"></script>
    <script src="/assets/libs/animate/animate-css.js"></script>
    <script src="/assets/libs/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/assets/libs/imagefill/jquery-imagefill.js"></script>
    <script src="/assets/libs/masonry/masonry.pkgd.min.js"></script>
    <script src="/assets/libs/Magnific-Popup/jquery.magnific-popup.min.js"></script>
    <script src="/assets/libs/scrollify/jquery.scrollify.js"></script>

    <script src="/assets/libs/wysibb/jquery.wysibb.js"></script>
    <script src="/assets/libs/wysibb/lang/ru.js"></script>

    <script src="/assets/libs/dist/slideout.min.js"></script>
 <script src="//production-assets.codepen.io/assets/common/stopExecutionOnTimeout-b2a7b3fe212eaa732349046d8416e00a9dec26eb7fd347590fbced3ab38af52e.js"></script><script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/1.0.0/anime.min.js"></script>

    <script src="/assets/js/common.js"></script>
     <script src="/assets/js/beanie.js"></script>
  <script src="/assets/libs/slick/slick.js" type="text/javascript" charset="utf-8"></script>
    <script src="/assets/imageupload.js"></script>
    
</body>
</html>';
}

?>

