<? //MessageSend(3, 'Bbbbb', '/login', 1); //оповещения

        $URL_Path_post = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $URL_Parts_post = explode('/', trim($URL_Path_post, ' /'));
        array_shift($URL_Parts_post);
        $type_post = array_shift($URL_Parts_post);
        $page_post = array_shift($URL_Parts_post);

        function vk_widgets() {
            echo '
            <div class="vk">
                    <script type="text/javascript" src="//vk.com/js/api/openapi.js?146"></script>

                    <!-- VK Widget -->
                    <div id="vk_groups"></div>
                    <script type="text/javascript">
                    VK.Widgets.Group("vk_groups", {mode: 3, width: "auto", color3: "587FAC"}, 85933127);
                </script>
            </div>
            ';
        }
//echo $module; echo var_dump($Param);
//if (preg_match('/^[A-z]{2,15}$/', $module) AND ctype_digit($Param['id']) && ($Param['id'] > 0)) {
if ($type_post == 'id' AND ctype_digit($page_post) && ($page_post > 0)) {
    $query = mysql_query("SELECT * FROM `posts` WHERE `id` = $page_post");
    if (!mysql_num_rows($query)) Location('/404');
    else { //вывод 1 статьи

        $query = mysql_fetch_assoc($query);
if($query['active']==1 OR $_SESSION['group_u']==1 OR $_SESSION['group_u']==2 OR $query['author']==$_SESSION['id']) {
            if($_SESSION['id']) {
                $user_view = mysql_query("SELECT * FROM `views` WHERE  `pid` = $page_post AND `uid` = $_SESSION[id]") or die(mysql_error());
                if (!mysql_num_rows($user_view)) {//если не смотрели
                    $date = date("d.m.y");
                    mysql_query('INSERT INTO `views` VALUES ("", "'.$_SESSION['id'].'", "'.$page_post.'", "'.$date.'")');
                    mysql_query("UPDATE `posts` SET views=views+1 WHERE `id` = $page_post");
                }

            } else {
                $views_temp = mysql_fetch_assoc(mysql_query("SELECT `views` FROM `posts` WHERE  `id` = $page_post "));
                $views_temp = $views_temp['views'] + 1;
                mysql_query("UPDATE `posts` SET views=$views_temp WHERE `id` = $page_post");
            }
        function UserLike($id) {
            if ($_SESSION['id']) {
            $user_like = mysql_query("SELECT * FROM `likes` WHERE  `post` = $id AND `uid` = $_SESSION[id]");
            if (mysql_num_rows($user_like)) echo '<i class="fa fa-heart" aria-hidden="true"></i>';
            else printf('<i class="fa fa-heart-o" aria-hidden="true"></i>');
            } else echo 'Войти';
        }
        function item_comments($page_post){
            $query_comment = mysql_query('SELECT `text`, `uid`, `id` FROM `comments` WHERE `pid` = '.$page_post.' ORDER BY `id` DESC');
            if ( !mysql_num_rows($query_comment) ) echo 'Список комментариев пуст';
            else {
                while ( $row = mysql_fetch_assoc($query_comment) ) {
                $user = mysql_fetch_assoc( mysql_query("SELECT `nickname` FROM `users` WHERE `id` = $row[uid]") );
                //$u_email = hideEmail( $user['email'] );

                    printf('<div class="reviews">
                        '.(($_SESSION['id'] == $row['uid']) ? '<a class="delblog red" href="/control/delete/type/comment/post/'.$page_post.'/id/'.$row[id].'">x</a>' : '').'
                    <span>Отправитель: '.$user['nickname'].'</span>'.nl2br( htmlspecialchars($row['text']), false).'</div>
                    '); 
                }
            }
        }
        /*$background_kolor = 'f3f3f3';
        top($query[title], 0, 0, 1);
        MessageShow();*/
        $post_views = mysql_fetch_assoc(mysql_query("SELECT `views` FROM `posts` WHERE  `id` = $page_post "));
        $query_like = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `likes` WHERE `post` = $page_post"));
    $query_category = mysql_fetch_assoc(mysql_query("SELECT * FROM `categories` WHERE `category`='$query[category]'"));
    $query_categories = mysql_query("SELECT * FROM `categories`");
    $query_enoutherpost = mysql_query("SELECT * FROM `posts` WHERE id<>$page_post AND active=1 ORDER BY `id` DESC LIMIT 4 ");
        $tag = $query_category['name'];
        if(empty($tag)) $tag = 'Оффтоп';
        list($year, $month, $day) = explode("-", $query[date]);

        $string_temp = bbcode($query['text']);
        $string_temp = strip_tags($string_temp);
        $string_temp = substr($string_temp, 0, 250);
        $string_temp = rtrim($string_temp, "!,.-");
        $string_temp = substr($string_temp, 0, strrpos($string_temp, ' '));

        $META[title]= $query[title];
        $META[Description]=$string_temp."… ";
        $META[image_src]=$query['img'];
        $META[Keywords_ru]=$query['tag'];
        $META[Keywords_en]=$query['tag_en'];
        $META[url]='/news/id/'.$page_post.'';

        $background_kolor = 'f3f3f3';
        top($query[title], 0, 0, 1);
        MessageShow();
        ?>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="item-link">
                        <div class="img_item_news">
                            <img src="<?=$query['img']?>" alt="Картинка">
                        </div>
                        <div class="item-content">
                            <div class="td">
                                <div class="item-date hidden-xs">
                                    <?=$day?><br><small><?=$month?>/<?=$year?></small>
                                </div>
                            </div>
                            <div class="td">
                                <h2>
                                    <span class="title-cat"><i class="fa fa-tag" aria-hidden="true"></i><?=$tag?></span>
                                    <span class="pos-title"><?=$query['title']?></span>
                                </h2>
                                <time datetime="<?=$query[date]?>"></time>
                            </div>
                            <div class="item_article_content">
                                <p><?=bbcode($query['text'])?><p>
                            </div>
                            <?
                            if($query['active']==1) {
                            ?>
                            <p>Количество лайков: <span class="LikeBlock2"><?=$query_like[0]?></span></p>
                            <p>Количество просмотров: <?= $post_views['views']?></p>
                            <form onsubmit="return false" >
                            <input type="text" value="<?=$page_post?>" id="id" hidden>
                            <button class="submit_v2" onclick="post_query('articles', 'like', 'id')"><?=UserLike($page_post)?></button>
                            </form>

                            <h2>Оставить комментарий:</h2>
                            <form onsubmit="return false" >
                            <input type="text" value="<?=$page_post?>" id="id" hidden>
                            <p><textarea onkeyup="schet('10', '200')" class="textarea cl half_size" placeholder="Текст сообщения" id="subject"></textarea></p>
                            <p id="WordCounter"></p>
                            <p><button class="submit_v2" onclick="post_query('articles', 'comment', 'id.subject')">Отправить</button></p>
                            </form>
                            <p>Комментарии:</p>
                            <?=item_comments($page_post)?>
                            <?}else echo '<div class="red">Лайки, комментарии появятся после публикации</div>';?>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3><i class="fa fa-newspaper-o" aria-hidden="true"></i> Новое:</h3>
                    
                    <?
                    while ($Row = mysql_fetch_assoc($query_enoutherpost)) {

                    printf('
                        <div class="suggest_item" style="background-image: url('.$Row[img].');">
                            <a href="/news/id/'.$Row[id].'">
                            <div class="suggest_item_desc">
                                <h3>'.$Row[title].'</h3>
                                <span>'.$Row[date].'</span>
                            </div>
                            </a>
                        </div>
                        ');

                            }
                    ?>
                    <h3><i class="fa fa-tag" aria-hidden="true"></i> Тэги</h3>

                    <?
                    while ($Row = mysql_fetch_assoc($query_categories)) {

                    printf('<a id="tag" href="/news/'.$Row['category'].'">'.$Row['name'].'</a>');

                            }
                    ?>
                    <?vk_widgets()?>
                </div>
            </div>
        </div>
<?
        
        } else echo "<h2>Нет доступа!</h2>";
    }
} else {

    if (empty($Param['page'])) $Param['page'] = 0;
    if (ctype_digit($Param['page']) OR ($Param['page'] == '0')) {
   //if ($Param['page'] == 0) $Param['page'] = 1;
    //if (ctype_digit($Param['page']) && ($Param['page'] >= 0)) {
    if (!$module OR $module == 'all') {
        $querypost = mysql_query('SELECT * FROM `posts` ');
        $total = intval(((mysql_num_rows($querypost) - 1) / 5) + 1); 
        if ($total >= $Param['page']) {
    if ($_SESSION['group_u']!=2){ $Active = 'WHERE `active` = 1'; $Active_s = '`active` = 1';}
$Param1 = 'SELECT * FROM `posts` '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT * FROM `posts` '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `posts` '.$Active.'';
$Param4 = '/news/all/page/';
    }
} else if ($module OR $module != 'all')  {
    $querypost = mysql_query("SELECT * FROM `posts` WHERE `category` = '$module'");
    $total = intval(((mysql_num_rows($querypost) - 1) / 5) + 1); 
    if ($total >= $Param['page']) {
    /*if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';*/
    if ($_SESSION['group_u']!=2){ $Active = 'WHERE `active` = 1'; $Active_s = 'AND `active` = 1';}
$Param1 = "SELECT * FROM `posts` WHERE `category` = '$module' ".$Active_s." ORDER BY `id` DESC LIMIT 0, 5";
$Param2 = "SELECT * FROM `posts` WHERE `category` = '$module' ".$Active_s." ORDER BY `id` DESC LIMIT START, 5";
$Param3 = "SELECT COUNT(`id`) FROM `posts` WHERE `category` = '$module' ".$Active_s."";
$Param4 = '/news/'.$module.'/page/';
    }
}
if ($total >= $Param['page']) {
    /*echo "Число статей";
    echo mysql_num_rows($querypost);*/
$Count = mysql_fetch_row(mysql_query($Param3));

if (!$Param['page']) {
    $Param['page'] = 1;
    $Result = mysql_query($Param1);
} else {
    $Start = ($Param['page'] - 1) * 5;
    $Result = mysql_query(str_replace('START', $Start, $Param2));
}
$META[title]='Статьи |Mandarin-Show';
//$META[type]='<meta property="og:type" content="article"/>';
$META[url]='/news';
$META[image]='http://mandarinshow.ru/assets/img/image_posts.png';
$META[description]='В рамках нашего сообщества статьями принято считать длинные и содержательные тексты с дополнительными элементами(картинки, видео, ссылки). А не которкие новости. Наши редакторы стараются обеспечить интересный, содержательный и грамотный текст, после прочтения которого вы узнаете что-то новое.';
$META[Keywords_ru]='статьи, mandarin, show, каталог, все статьи, айти, новости, оффтоп, игры';
$META[Keywords_en]='articles, mandarin, show, catalog, all articles, ai, news, offtopic, games';

$META[Description]='В рамках нашего сообщества статьями принято считать длинные и содержательные тексты с дополнительными элементами(картинки, видео, ссылки). А не которкие новости. Наши редакторы стараются обеспечить интересный, содержательный и грамотный текст, после прочтения которого вы узнаете что-то новое.';

$META[image_src]='/assets/img/image_posts.png';
    top('Статьи |Mandarin-Show', 1, 0, 1, 'f3f3f3', 0);
    MessageShow();
//PageSelector($Param4, $Param['page'], $Count);
    echo '<div class="col-md-9">';
    $count_item = 0;
    function href_white() {
        if($_SESSION['id']) return '/post/add';
        else return '/login';
    }
while ($Row = mysql_fetch_assoc($Result)) {
$score_like = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `likes` WHERE `post` = $Row[id]"));
$score_comments = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `comments` WHERE `pid` = $Row[id]"));
$scores_views = mysql_fetch_assoc(mysql_query("SELECT `views` FROM `posts` WHERE  `id` = $Row[id] "));
$query_category = mysql_fetch_assoc(mysql_query("SELECT * FROM `categories` WHERE `category`='$Row[category]'"));
$tag = $query_category['name'];
if(empty($tag)) $tag = 'Оффтоп';
$image = $Row['img'];
$author = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $Row[author] "));
list($year, $month, $day) = explode("-", $Row[date]);
if(empty($Row['category'])) $tag = 'Оффтоп';
if(empty($Row['img'])) $image = '/assets/img/fon_dlya_saita.png';
$count_item +=1;
if($count_item==5) $col_item = 12;
else $col_item = 12;
echo'
    
        <a id="link_item_news" href="/news/id/'.$Row['id'].'">
        <div class="news_item">
        '.(($Row[id]%5==0) ? '
            <div class="special"><span id="comments">'.$Row['id'].'</span></div>
        ' : '').'
            
            <div class="img_item_news">
                <img src="'.$image.'" alt="Картинка">
            </div>
            <div class="item-content">
            <div class="td">
                <div class="item-date hidden-xs">
                    '.$day.' <small>'.$month.'/'.$year.'</small>
                </div>
            </div>
            <div class="td">
                <h2>
                    <span class="title-cat"><i class="fa fa-tag" aria-hidden="true"></i> '.$tag.'</span>
                    <span class="pos-title">'.$Row['title'].'</span>
                </h2>
            </div>
        </div>
        </a>
            <div class="info_item_news">
                <p>
                <span id="comments"><i class="fa fa-comments" aria-hidden="true"></i> '.$score_comments[0].'</span>
                <span id="like"><i class="fa fa-thumbs-up" aria-hidden="true"></i> '.$score_like[0].'</span>
                <span id="watch"><i class="fa fa-eye" aria-hidden="true"></i> '.$scores_views[views].'</span>
                <span id="author"><i class="fa fa-pencil" aria-hidden="true"></i> '.$author[nickname].'</span>
                </p>
            </div>
        </div>
        
    
    ';
//if ($Row['active']==0) echo' (Ожидает модерации)';
//else echo '(Проверенно)';
        } if(mysql_num_rows($Result)==0) echo '<h2>К сожелению ничего нет :(</h2>';
    echo '</div>';
    echo '<div class="col-md-3"> <div class="nav_news">';
    echo '
    <div class="realmWhiter">
        <div class="bg_Whiter"></div>
        <p>Напиши свою статью.</p>
        <a href="'.href_white().'">Начать</a>
    </div>
    ';
    $subscriber = mysql_query("SELECT * FROM `mailsubscribers` WHERE `mail` = '$_SESSION[email]'");
    /*if (empty($mailsubscriber)) echo "Вы уже оформили подписку!";*/
    //if(empty($subscriber)) echo $subscriber;
    if ((!empty($subscriber) AND mysql_num_rows($subscriber) AND $subscriber!=0) OR $_COOKIE[mailsub]==1) {}
        else {
        ?>
        <div class="subscribe">
            <div class="bg_mailbox"></div>
            <h2>Подпишись!</h2>
            <p>Подпишись на информационную рассылку от нашего сайта, для того чтобы узнать первым самые новые статьи.</p>
            <input type="text" placeholder="| Ваша почта" id="email" value="<?=$_SESSION[email]?>">
            <button onclick="post_query('mail', 'mailsubscribe', 'email')">Подписаться</button>
        </div>
        <?
    }
    my_advertising('art', 'extended', 'https://vk.com/mg_blog');
    vk_widgets();

    echo '<div class="container-block_white box-comments">
            <h3>Последние комментарии</h3>';
    $query_comments = mysql_query("SELECT * FROM `comments` ORDER BY `id` DESC LIMIT 5");
    while ($Row = mysql_fetch_assoc($query_comments)) {
        $query_title_post = mysql_fetch_assoc(mysql_query("SELECT `title` FROM `posts` WHERE `id`=$Row[uid]"))[title];
    printf('
        <div class="dsq-widget-item">
            <a href="/user/'.$Row['uid'].'">
            <img src="'.user_avatar($Row['uid']).'" width="20" height="20" alt=""> '.user_nickname($Row['uid']).'</a><br>
            <p>'.$Row['text'].'</p>
            <p class="dsq-widget-meta"><a href="/news/id/'.$Row['pid'].'">'.$query_title_post.'</a></p>
        </div>
        ');
    }
    echo '</div>';
    $query = mysql_query("SELECT * FROM `categories` WHERE `status`=1");
    echo '<h3><i class="fa fa-tag" aria-hidden="true"></i> Тэги</h3>';
    while ($Row = mysql_fetch_assoc($query)) {

    printf('<a id="tag" href="/news/'.$Row['category'].'">'.$Row['name'].'</a>');

            }

            


            //echo '<br><br><a href="/category"><button class="submit_v2">Все категории</button></a><br><br>';
            //end right side block
    echo '</div></div>';
    echo '
        </div>
    </div>
    ';    
    } else Location('/404');
} 
}
?>

<script>
    /*$(function(){
    $(window).scroll(function() {
        if($(this).scrollTop() >= 290) {
            $('.nav_news').addClass('stickytop');
        }
        else{
            $('.nav_news').removeClass('stickytop');
        }
    });
});
  $(function(){
       // высота "шапки", px
       var h_hght = 1000;
       // высота блока с меню, px
       var h_nav = $('.nav_news').outerHeight();
       var top;
       $(window).scroll(function(){
           // отступ сверху
           top = $(this).scrollTop();
           if((h_hght-top) <= h_nav){
               $('.nav_news').css('top','0');
           }
           else if(top < h_hght && top > 0){
               $('.nav_news').css({'margin-top' : top, 'top':''});
           }
           else if(top < h_nav){
               $('.nav_news').css({'margin-top':'','bottom':'0'});
           }
       });
   });  */
</script>
<div class="container">
<div class="row">
<?PageSelector($Param4, $Param['page'], $Count);?>
</div></div>
<? bottom() ?>





            













<?
/*






   if (empty($Param)) {
    $query = mysql_query("SELECT * FROM `posts` WHERE `category` = '$module'");
    if (!mysql_num_rows($query)) echo "<h1>По данной категории нет статей</h1>";
    else {
        while ( $row = mysql_fetch_assoc($query) ) {
    printf('<h2>'.$row['title'].'</h2><p>'.$row['text'].'<p>');
            }
        }
    } else if (!empty($Param[page])) {
        if (!$module or $module == 'main') {
if ($_SESSION['USER_GROUP'] != 2) /*$Active = 'WHERE `active` = 1'*/;/*
$Param1 = 'SELECT * FROM `posts` '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT * FROM `posts` '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `posts`';
$Param4 = '/news/main/page/';
} else if ($module == 'category') {
if ($_SESSION['USER_GROUP'] != 2) $Active = 'AND `active` = 1';
$Param1 = 'SELECT * FROM `posts` WHERE `category` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT 0, 5';
$Param2 = 'SELECT * FROM `posts` WHERE `category` = '.$Param['id'].' '.$Active.' ORDER BY `id` DESC LIMIT START, 5';
$Param3 = 'SELECT COUNT(`id`) FROM `posts` WHERE `category` = '.$Param['id'];
$Param4 = '/news/category/id/'.$Param['id'].'/page/';
}

$Count = mysql_fetch_row(mysql_query($Param3));

if (!$Param['page']) {
$Param['page'] = 1;
$Result = mysql_query($Param1);
} else {
$Start = ($Param['page'] - 1) * 5;
$Result = mysql_query(str_replace('START', $Start, $Param2));
}


PageSelector($Param4, $Param['page'], $Count);
while ($Row = mysql_fetch_assoc($Result)) {
if (!$Row['active']) $Row['name'] .= ' (Ожидает модерации)';
printf('<h2>'.$Row['title'].'</h2><p>'.$Row['text'].'<p>');
echo '<a href="/news/material/id/'.$Row['id'].'"><div class="ChatBlock"><span>Добавил: '.$Row['added'].' | '.$Row['date'].'</span>'.$Row['name'].'</div></a>';


}
    } else {
        echo "Ошибка url!";
    }*/








/*


        '.(($Row['active']==0) ? '
        (Ожидает модерации)
        ' : '').'
        '.(($Row['active']==1) ? '
        (Проверенно)
        ' : '').'

*/



/*
echo '<section class="hero fullpage" style="background-image: url('.$query['img'].');">
            <div class="hero-body" style="background: linear-gradient(rgba(43, 41, 36, 0.5), rgba(15, 14, 14, 0.6), #'.$background_kolor.');">
        <div class="container">
            <div class="title is-1">
                '.$query['title'].'
            </div>
            <div class="subtitle">
                Статьи, новости и некоторые мысли.<br>
                <small>'.$query['date'].'</small>
            </div>
        </div>
    </div>
        </section>

        <div class="container">
            <div class="row">
                <div class="block">

            <gallery>
            <div style="background-image: url('.$query['img'].');">
                <a href="'.$query['img'].'" class="popup zoomable">
                    <img src="'.$query['img'].'">
                </a>
            </div>
            <div style="background-image: url('.$query['img'].');">
                <a href="'.$query['img'].'" class="popup zoomable">
                    <img src="'.$query['img'].'">
                </a>
            </div>
            <div style="background-image: url('.$query['img'].');">
                <a href="'.$query['img'].'" class="popup zoomable">
                    <img src="'.$query['img'].'">
                </a>
            </div>
            <div style="background-image: url('.$query['img'].');">
                <a href="'.$query['img'].'" class="popup zoomable">
                    <img src="'.$query['img'].'">
                </a>
            </div>
            </gallery>
        ';
        */