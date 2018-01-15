<?
$META[title]='НАЗВАНИЕ';
//$META[type]='<meta property="og:type" content="article"/>';
$META[url]='http://mandarinshow.ru/ССЫЛКА';
$META[image]='http://mandarinshow.ru/images/картинка';
//$META[site_name]='<meta property="og:site_name" content="mandarinshow.ru"/>';
$META[description]='ОПИСАНИЕ';
$META[Keywords_ru]='КЛЮЧЕВЫЙ СЛОВА RU';
$META[Keywords_en]='КЛЮЧЕВЫЙ СЛОВА EN';
//$META[Author]='<META Name= Author Lang="ru" content="Антоненко и Co.">';
//$META[Revisit]='<META Name="Revisit" content="7">';
$META[Description]='ОПИСАНИЕ';
//$META[Compatible]='<meta http-equiv="X-UA-Compatible" content="IE=edge" />';
//$META[viewport]='<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
$META[image_src]='/images/картинка';
?>
<?$module = urldecode($module); top('🔍Поиск: '.$module.'', 0, 0, 1);?>

.<div class="container-block_white">
<h1>🔍Поиск: <?=$module?></h1>
<?


if($module) {
    
    $query_users = mysql_query("SELECT * FROM `users` WHERE `id` LIKE '%$module%' OR `nickname` LIKE '%$module%' OR `name` LIKE '%$module%' OR `sur_name` LIKE '%$module%'");
    $query_posts = mysql_query("SELECT * FROM `posts` WHERE `id` LIKE '%$module%' AND `active`=1 OR `category` LIKE '%$module%' AND `active`=1 OR `title` LIKE '%$module%' AND `active`=1 OR `text` LIKE '%$module%' AND `active`=1");
    //$query_u = mysql_query("SELECT * FROM `posts` WHERE `id` = $Param[id]");
    if($_SESSION[id]){
        if (!empty($query_users) AND mysql_num_rows($query_users)) {
            //$queryF = mysql_fetch_array($query_p);
            echo "Пользователи: ";
            while ($Row = mysql_fetch_assoc($query_users)) {
                echo '
                    <br><a href="/user/'.$Row[id].'">'.$Row[nickname].'</a>
                ';
            }
        }
    }
    if (!empty($query_posts) AND mysql_num_rows($query_posts)) {
        //$queryF = mysql_fetch_array($query_p);
        echo "<br>Статьи: ";
        while ($Row = mysql_fetch_assoc($query_posts)) {
            echo '
                <br><a href="/news/id/'.$Row[id].'">'.$Row[title].'</a>
            ';
        }
    }
    if(mysql_num_rows($query_posts)==0 AND mysql_num_rows($query_users)==0 OR mysql_num_rows($query_posts)==0 AND !$_SESSION[id]) echo "<br><h1>Ничего не найдено ☹️</h1>";
}
?>
</div>
<?bottom()?>