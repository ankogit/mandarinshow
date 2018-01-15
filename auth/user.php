<? 
if ($Param) exit('error url'); 
if ($module) {
    $module += 0;
    //Главный запрос БД
    $query = mysql_query("SELECT * FROM `users` WHERE `id` = '$module'");
    $info = mysql_fetch_assoc($query);

    top('Профайл '.$info['nickname'].'');
    MessageShow();
    //если пользователь найден:
    if( mysql_num_rows($query) ) {
        if ($_SESSION['id'] != $info['id']) {
        $row_m = mysql_query("SELECT * FROM `dialog` WHERE `recive` = $module AND `send` = $_SESSION[id] or `recive` = $_SESSION[id] AND `send` = $module") ;
        
             if (empty($row_m) or !mysql_num_rows($row_m)) {
                function button_fn($id, $sub) {
                ?> <form onsubmit="return false" >
                <input type="text"  value="<?=$id?>" id="id" hidden>
                <input type="text" value="<?=$sub?>" id="subject" hidden>
                <button class="submit_v2" onclick="post_query('fsendmessage', 'firstmess', 'id.subject')">Начать Диалог</button>
                </form> 
                <?
                }
            }
            else {
            
            //$User = mysql_fetch_assoc(mysql_query("SELECT `email` FROM `users` WHERE `id` = $row[recive]"));
            function button_fn() {
                global $row_m;
                $row_m =mysql_fetch_assoc($row_m);
                if ($row_m['recive'] == $_SESSION['id']) $row_m['recive'] = $row_m['send'];
                echo '<a href="/im/'.$row_m['id'].'"><button class="submit_v2" class="submit">Продолжить диалог</button></a>';
                }
            }
    } else {
        function button_fn() {
             echo '<a href="/profile"><button class="submit_v2" class="submit">Изменить профиль</button></a>';
        }
    }
    function friend_query_fn() {
        $query = mysql_query("SELECT * FROM `friends` WHERE `sfri` = $_SESSION[id] AND `active`= 0");
        while ($Row = mysql_fetch_assoc($query)) {
            $query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Row[ffri]'"));
            $name_f = $query_user_name['nickname'];
            ?>
            <div class="friend_request container-block_white">
                <p><?=$name_f?><a href="/control/friend/type/delete/user/<?=$Row[ffri]?>"><button class="submit_v2" ><i class="fa fa-times" aria-hidden="true"></i></button></a><a href="/control/friend/type/active/user/<?=$Row[ffri]?>"><button class="submit_v2" ><i class="fa fa-check" aria-hidden="true"></i></button></a></p>
            </div>
            <?
        }
    }
    function friend_list_fn() {
        $query = mysql_query("SELECT * FROM `friends` WHERE `sfri` = $_SESSION[id] AND `active`= 1 OR `ffri` = $_SESSION[id] AND `active`= 1");
        if(mysql_num_rows($query)) {
            echo '<h4> -Список друзей:</h4>';
            while ($Row = mysql_fetch_assoc($query)) {
                if($Row[ffri]!=$_SESSION[id]) {
                    $query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Row[ffri]'"));
                    $id=$Row[ffri];
                } else {
                    $query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Row[sfri]'"));
                    $id=$Row[sfri];
                }
                //$query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Row[ffri]'"));
                $name_f = $query_user_name['nickname'];
                ?>
                <div class="friend_request container-block_white">
                    <p><a class="no_fl" href="/user/<?=$id?>"><?=$name_f?></a><a href="/control/friend/type/delete/user/<?=$id?>"><button class="submit_v2" ><i class="fa fa-times" aria-hidden="true"></i></button></a></p>
                </div>
                <?
            }
        } else echo '<div class="friend_request">В вашем списке ещё никого нет.</div>';
    }
    function friends_fn($module) {
        $query = mysql_query("SELECT * FROM `friends` WHERE `ffri` = $module AND `sfri`= $_SESSION[id] OR `sfri`= $module AND `ffri` = $_SESSION[id]");
        if (!empty($query) AND mysql_num_rows($query)) {
            $query = mysql_fetch_array($query);
            if($query[active]==0) {
                if($query[ffri]==$_SESSION[id]) {
                    echo '<button class="submit_v2">Ждём подтверждения</button>';
                } else {
                    ?>
                    <input type="text"  value="<?=$module?>" id="fid" hidden>
                    <button class="submit_v2" onclick="post_query('control', 'addfriend', 'fid')">Подтвердить</button>
                    <?
                }
            } else {
                echo '<button class="submit_v2">Вы уже друзья</button>';
            }
        } else {
            ?>
            <input type="text"  value="<?=$module?>" id="fid" hidden>
            <button class="submit_v2" onclick="post_query('control', 'addfriend', 'fid')">Добавить в друзья</button>
            <?
        }
    }

    $score_posts = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `posts` WHERE `author` = $module"));
    $score_comments = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `u_blog` WHERE `uid` = $module"));
    $score_friend = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `friends` WHERE `ffri` = $module AND `active`=1 OR `sfri` = $module AND `active`=1"));
        //если это вошедший
        ?>
        <div class="col-md-3">
            <div class="avatar_container container-block_white">
                <div class="avatar" style="background-image: url()">
                    <img src="<?u_avatar($info['avatar'])?>" alt="">
                </div>
                <?button_fn($info['id'], "--Начат диалог--");?>
                <?if($module!=$_SESSION[id]) friends_fn($module);?>
            </div>
            <?if ($_SESSION['id'] == $info['id']) {?>
            <div class="WhitePost">
                    <p>Напиши свою статью.</p>
                    <a href="/post/add">Начать</a>
                    <a id="plist" href="/post/list">-Посмотреть мои статьи</a>
                    <a id="plist" href="/link/files/">-Мои файлы</a>
                    <a id="plist" href="/load">-Загрузить файлы</a>
                    <a id="plist" href="/category/add">-Предложить категорию</a>
            </div>
            <?=friend_query_fn();?>
            <?=friend_list_fn();?>
            <?}?>
        </div>
        <div class="col-md-9">
            <div class="user_inform container-block_white">
            <h2><?u_init($info['name'], $info['sur_name']);?></h2>
            <?u_nickname($info['nickname'])?>
            <hr>
                <?
                u_email($info['email']);
                u_country($info['country']);
                u_year_birth($info['year_birth']);
                group($info['group_u']);
                ?>
                <div class="flex_inf">
                    <div class="achievement_inf one"><i class="fa fa-pencil" aria-hidden="true"></i>
                    <br><?=$score_posts[0]?></div>
                    <div class="achievement_inf two"><i class="fa fa-users" aria-hidden="true"></i>
                    <br><?=$score_friend[0]?></div>
                    <div class="achievement_inf"><i class="fa fa-comment" aria-hidden="true"></i>
                    <br><?=$score_comments[0]?></div>
                </div>
            </div>
            <?
        
    if ($_SESSION['id'] == $info['id']) {

    ?>
    <div class="container-block_white">
        <h2>Добавить пост:</h2>
        <form onsubmit="return false" >
        <p><textarea class="textarea full_size" onkeyup="schet('5', '1000')" placeholder="Текст сообщения" id="subject"></textarea></p>
        <p id="WordCounter"></p>
        <p><button class="submit_v2" onclick="post_query('addublog', 'ublog', 'subject')">Добавить</button> </p>
        </form> 
    </div>
        <?
        }
            echo '<div class="container-block_white"><h1>Личный Блог</h1>';
        //запрос к БД посты пользователей
    $query_blog = mysql_query('SELECT `id`, `text`, `uid`, `date` FROM `u_blog` WHERE `uid` = '.$info['id'].' ORDER BY `id` DESC ');

    if ( !mysql_num_rows($query_blog) ) echo '<div class="reviews">Нет ни одной записи</div>';
        //вывод в цикле
        while ( $row = mysql_fetch_assoc($query_blog) ) {
        //$user = mysql_fetch_assoc( mysql_query("SELECT `email` FROM `users` WHERE `id` = $row[uid]") );
        echo '<div class="reviews">'; 
        //если это вошедший
        if ($_SESSION['id'] == $info['id']) {
            echo '<a class="delblog" href="/control/delete/type/blog/user/'.$row[uid].'/id/'.$row[id].'">x</a>';
            }
        echo '<span>Дата: '.$row['date'].'</span>'.nl2br( htmlspecialchars($row['text']), false).'</div>';
        }echo '</div>';?>
        </div>

        <?

    
    
        //если пользователь не найден:
    } else if( !mysql_num_rows($query) ) {
        echo('<h1>Пользователь не найден!</h1>');
    }
    //если нет module в url
} else {
    top('Профайл '.$_SESSION['name'].'');
 echo('<h1>Пользователь не найден!</h1>');
}
   /* //всегда выводим
//sendmessage('mandarin.tolik.99@gmail.ru', 'Test');
echo '<div class="users"><h1>Список всех пользователей</h1>';
$allUsers = mysql_query('SELECT * FROM `users` ORDER BY `id` DESC');
while ( $users = mysql_fetch_assoc($allUsers) ) {
    echo '<div class="user"><span>Пользователь: <a href="/user/'.$users['id'].'">'.hideEmail($users['email']).'</a></span></div>';
}
echo '</div>';
*/
//ФУНКЦИИ

function u_nickname( $nickname ) {
if (!empty($nickname)) {
    echo '
    <b>Ник: '.$nickname.'</b>
    ';
    }
}
function u_email( $email ) {
if (!empty($email)) {
    echo '
    <br> <b>Email: '.hideEmail( $email ).'</b>
    ';
    }
}

function u_country( $country ) {
    if (!empty($country)) {
    echo '
    <br> <b>Страна: '.$country.'</b>
    ';
    } else {
        echo '
    <br><b>Страна: Пользователь не задал свою страну </b>
    ';
    }
}
function u_year_birth( $year_birth ) {
    if (!empty($year_birth)) {
    echo '
    <br> <b>Год рожденья: '.$year_birth.' год</b>
    ';
    } else {
        echo '
    <br><b>Год рожденья: Пользователь не задал год рожденья </b>
    ';
    }
}
function group( $group_u ) {
    if ($group_u == 0) {
    echo '<br> <b>Привилегии: Обычные</b>';
    } else if ($group_u == 1) {
        echo '<br> <b>Привилегии: Расширенные</b>';
    } else if ($group_u == 2) {
        echo '<br> <b>Привилегии: Администратор</b>';
    } else {
        '<br> <b>Привилегии: ???</b>';
    }
}
function u_avatar( $avatar ) {
    if (!empty($avatar)) {
    echo '/assets/img/avatars'.$avatar.'.jpg';
    } else {
        echo '/assets/img/avatars/avatar.jpeg';
    }
}
function u_init($name, $sur_name) {
    if (!empty($name) OR !empty($sur_name)) {
    echo '
    '.$name.' '.$sur_name.'
    ';
    } else {
        echo '
    Пользователь не задал имя или фамилию
    ';
    }
} 

bottom();
?>
