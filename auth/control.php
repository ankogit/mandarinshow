<? 
function delete($table, $id){ // функция удаления страниц 
    $sql = "DELETE FROM $table WHERE id='$id'"; 
    mysql_query($sql) or die (mysql_error()); 
    }
if($module=='delete') {
    if($Param['type']=='comment') {
       $query = mysql_query("SELECT * FROM `comments` WHERE `id` = $Param[id] AND `uid`= $_SESSION[id] AND `pid`= $Param[post]");
        if (!empty($query) AND mysql_num_rows($query)) {
            delete('comments', $Param['id']);
            MessageSend(3, 'Коммент из статьи: '.$Param['post'].' - удален', '/news/id/'.$Param['post'], 1);
        }else {
            echo "Доступ запрещён!";
        }
    } elseif ($Param['type']=='blog'){//не comment
        $query = mysql_query("SELECT * FROM `u_blog` WHERE `id` = $Param[id] AND `uid`= $_SESSION[id]");
        if (!empty($query) AND mysql_num_rows($query)) {
            delete('u_blog', $Param['id']);
            MessageSend(3, 'Запись в блоге пользователя: '.$Param['user'].' - удалена', '/user/'.$Param['user'], 1);
        }else {
            echo "Доступ запрещён!";
        }
    } elseif ($Param['type']=='reviews'){//не blog
        $query = mysql_query("SELECT * FROM `reviews` WHERE `id` = $Param[id] AND `uid`= $_SESSION[id]");
        if (!empty($query) AND mysql_num_rows($query)) {
            delete('reviews', $Param['id']);
            MessageSend(3, 'Отзыв пользователя: '.$_SESSION[id].' - удалена', '/reviews', 1);
        }else {
            echo "Доступ запрещён!";
        }
    }elseif($Param[type]=='art' && $Param[id] && $_SESSION[group_u]==2) {
        delete('art_gallery', $Param['id']);
        MessageSend(3, 'Работа - удалена', '/ahome/pages/name/art/module/list', 1);
    }elseif($Param[type]=='category' && $_SESSION[group_u]==2) {
        delete('categories', $Param['id']);
        MessageSend(3, 'Категория удалена', '/category/vote', 1);
    }elseif($Param[type]=='user' && $Param[id] && $_SESSION[group_u]==2) {
        delete('users', $Param['id']);
        MessageSend(3, 'Пользователь - удалён', '/ahome/pages/name/account/module/list', 1);
    }
} if($module=='friend') {
    if($Param['type']=='active') {
        if($_SESSION[id]){
            $query = mysql_query("SELECT * FROM `friends` WHERE `sfri` = $_SESSION[id] AND `ffri`= $Param[user] AND `active`=0");
                if (!empty($query) AND mysql_num_rows($query)) {
                mysql_query('UPDATE `friends` SET `active` =1 WHERE `sfri` = "'.$_SESSION[id].'" AND `ffri`= "'.$Param[user].'"');
                $query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Param[user]'"));
                $name_f = $query_user_name['nickname'];
                MessageSend(3, 'Теперь вы дружите с пользователем: '.$name_f.'', '/user/'.$_SESSION[id], 1);
            } else "Ошибка";
        } echo "Ошибка";
    } else if($Param['type']=='delete') {
        $query = mysql_query("SELECT * FROM `friends` WHERE `sfri` = $_SESSION[id] AND `ffri`= $Param[user] OR `ffri` = $_SESSION[id] AND `sfri`= $Param[user]");
                if (!empty($query) AND mysql_num_rows($query)) {
                    delete('friends', mysql_fetch_array($query)[id]);
                $query_user_name = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id`='$Param[user]'"));
                $name_f = $query_user_name['nickname'];
                MessageSend(3, 'Вы отменили дружбу с пользователем: '.$name_f.'', '/user/'.$_SESSION[id], 1);
            } else "Ошибка";
    }
} else {//не delete friend
    if ( $_POST['addfriend_f'] ) {//добавлениие в друзья
        $query = mysql_query("SELECT * FROM `friends` WHERE `ffri` = $_POST[fid] AND `sfri`= $_SESSION[id] OR `sfri`= $_POST[fid] AND `ffri` = $_SESSION[id]");
        if (!empty($query) AND mysql_num_rows($query)) {
            $query = mysql_fetch_array($query);
            if($query[active]==0) {
                if($query[ffri]==$_SESSION[id]) {
                    message('Ждём подтверждения');
                } else {
                    mysql_query('UPDATE `friends` SET `active` =1 WHERE `id` = "'.$query[id].'"');
                    message('Теперь вы друзья!');
                }
            } else {
                message('Вы уже друзья');
            }
        } else {
            mysql_query('INSERT INTO friends (`ffri`, `sfri`) VALUES ("'.$_SESSION[id].'", "'.$_POST[fid].'")') or die(mysql_error());
            message('Ожидайте подтверждения дружбы');
        }
    }
} if($_SESSION[id] && $Param['type']=='category' && $module=="vote" && $Param['id']){
    $query = mysql_query("SELECT * FROM `categories` WHERE `id` = $Param[id] ");
    if(mysql_num_rows($query) !=0) {
       $vote_category = mysql_query("SELECT * FROM `vote_category` WHERE `c_id` = $Param[id] AND `u_id` = $_SESSION[id] ");
        if(mysql_num_rows($vote_category) ==0){
            $votes = mysql_fetch_array($query)['votes'];
            $votes = $votes+1;
            mysql_query('INSERT INTO vote_category (`u_id`, `c_id`) VALUES ("'.$_SESSION[id].'", "'.$Param[id].'")') or die(mysql_error());
            mysql_query('UPDATE `categories` SET `votes` = "'.$votes.'" WHERE `id` = "'.$Param[id].'"');
            MessageSend(3, 'Вы проголосовали за категорию № '.$Param[id].'', '/category/vote', 1);
        } else {
            MessageSend(3, 'Вы уже голосовали', '/category/vote', 1);
        }
    }
} 

if($module=='active') {
    if($Param['type']=='category' && $Param[id]){
        if($_SESSION[group_u]>=1) {
            mysql_query('UPDATE `categories` SET `status` = 1 WHERE `id` = "'.$Param[id].'"');
            MessageSend(3, 'Вы активировали категорию № '.$Param[id].'', '/category/list', 1);
        }
    }
}
if($module=='deactivate'){
    if($Param['type']=='category' && $Param[id]){
        if($_SESSION[group_u]>=1) {
            mysql_query('UPDATE `categories` SET `status` = 0 WHERE `id` = "'.$Param[id].'"');
            MessageSend(3, 'Вы деактивировали категорию № '.$Param[id].'', '/category/list', 1);
        }
    }
}
//echo $module.'/'.$Param['type'].'/'.$Param['post'].'/'.$Param['id'].'/'.$Param['user'];


?>
