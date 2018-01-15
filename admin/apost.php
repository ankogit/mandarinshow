<?
if ( $_POST['addwork_f'] ) {//Добавление работы
    $title = $_POST['title_art'];
    $desc = $_POST['desc_art'];
    $date = date("d.m.Y");
    $link = $_POST['link_art'];
    $res = $_POST['res_art'];
    $size = $_POST['size_art'];
    //$description = FormChars($_POST['description']);

    mysql_query('INSERT INTO art_gallery (`title`, `description`, `size`, `link`, `resources`, `date`) VALUES ("'.$title.'", "'.$desc.'", "'.$size.'", "'.$link.'", "'.$res.'", "'.$date.'")') or die(mysql_error());
    //go('post/list');
    go ('ahome/pages/name/art/module/list');

} else if ( $_POST['editwork_f'] ) {//Редактирование работы
    $title = $_POST['title_art'];
    $desc = $_POST['desc_art'];
    //$date = date("d.m.Y");
    $link = $_POST['link_art'];
    $res = $_POST['res_art'];
    $size = $_POST['size_art'];

    mysql_query('UPDATE `art_gallery` SET `title` = "'.$title.'", `description` = "'.$desc.'", `size` = "'.$size.'", `link` = "'.$link.'", `resources` = "'.$res.'" WHERE `id` = "'.$_POST['id_art'].'"');
    //go('news/id/'.$_POST[id].'');
    go ('ahome/pages/name/art/module/list');
    } if ( $_POST['edituser_f'] ) {
        $nick = $_POST['nickname_user'];
        $email = $_POST['email_user'];
        $group = $_POST['group_user'];

        mysql_query('UPDATE `users` SET `nickname` = "'.$nick.'", `email` = "'.$email.'", `group_u` = "'.$group.'" WHERE `id` = "'.$_POST['id_user'].'"');
        //go('news/id/'.$_POST[id].'');
        go ('ahome/pages/name/account/module/list');
    }else {
        message("Ошибка");
    }

?>
