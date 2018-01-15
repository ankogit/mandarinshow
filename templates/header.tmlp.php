<?
echo '
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">


    <meta property="og:title" content="'.$title.'"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="http://mandarinshow.ru/ССЫЛКА"/>
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


    <title>'.$title.'</title>
    
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
    <link rel="stylesheet" href="/assets/css/main.css">
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
    <div class="loader_inner"></div>
</div>
    ' : '').'

<header>
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
<a href="/contact">Обратная связь</a>
<a href="/reviews">Отзывы</a>
 '.(($_SESSION["group_u"]>=1) ? '<a href="/ahome">Админ-Панель</a>' : '').'
 '.(isset($_SESSION["id"]) ? '
    <a href="/user/'.$_SESSION["id"].'">Мой профиль</a>
    <a href="/im">Диалоги <div id="counter"></div></a>
    <a href="/logout">Выход</a>
    ' : '
    <a href="/login">Вход</a>
    <a href="/register">Регистрация</a>
    ').'
 
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
?>