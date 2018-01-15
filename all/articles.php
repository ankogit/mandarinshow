<?

if ($_POST['comment_f']) {
    if ($_SESSION["id"]) {
    if ( strlen($_POST['subject']) < 10 or strlen($_POST['subject']) > 200 )
        message("Длина сообшения должна быть от 10 до 200 символов!");

    mysql_query('INSERT INTO `comments` (`uid`, `pid`, `text`) VALUES ('.$_SESSION['id'].', '.$_POST['id'].', "'.mysql_real_escape_string($_POST['subject']).'")') or die(mysql_error());
    //cform();
    go('news/id/'.$_POST['id']);
    } else go('login');
} else if ($_POST['delcomm_f']) {
    message($_POST["commId"]);
} elseif ($_POST['like_f']) {

        if ($_SESSION['id']) {

            $id = $_POST['id'];
            function UserLike_f($id, $likes) {
                $user_like = mysql_query("SELECT * FROM `likes` WHERE  `post` = $id AND `uid` = $_SESSION[id]");
                if (mysql_num_rows($user_like)) {
                    $data1 = 'fa-heart';
                    $data2 = $likes;
                    $data3 = 1;
                    like($data1."_".$data2);
                } else {
                    $data1 = 'fa-heart-o';
                    $data2 = $likes;
                    $data3 = 0;
                    like($data1."_".$data2."_".$data3);
                }
            }
            $user_like = mysql_query("SELECT * FROM `likes` WHERE  `post` = $id AND `uid` = $_SESSION[id]") or die(mysql_error());
            if (mysql_num_rows($user_like)) {//лайкнули
                $sql = "DELETE FROM `likes` WHERE `uid` = '$_SESSION[id]' AND `post` = $id";
                mysql_query($sql) or die (mysql_error()); 
                $query_like = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `likes` WHERE `post` = $id"));
                //like($id,$query_like[0]);
                //UserLike_f($id, $query_like[0]);
                UserLike_f($id, $query_like[0]);
            } else {//не лайкнули
                $date = date("d.m.y");
                mysql_query('INSERT INTO `likes` VALUES ("", "'.$_SESSION['id'].'", "'.$id.'", "'.$date.'")');
                $query_like = mysql_fetch_row(mysql_query("SELECT COUNT(`id`) FROM `likes` WHERE `post` = $id"));
                UserLike_f($id, $query_like[0]);
            }
        } else go('login');
}
?>