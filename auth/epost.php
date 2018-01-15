<?
if ( $_POST['addpost_f'] ) {//Добавление
    captcha_valid();

    if (strlen($_POST['subject']) < 150 or strlen($_POST['subject']) > 50000 ) 
        message("Длина сообшения должна быть от 150 до 50000 символов!");

    $title = FormChars($_POST['title']);
    $text = FormChars($_POST['subject']);
    $category = FormChars($_POST['category']);
    $time = date("d.m.Y");
    $author = $_SESSION['id'];
    $image = FormChars($_POST['image']);
    $tags = FormChars($_POST['tags']);
    //$description = FormChars($_POST['description']);
    check_bbcode ($text);

    mysql_query('INSERT INTO posts (`category`, `title`, `text`, `author`, `img`, `tag`, `date`) VALUES ("'.$category.'", "'.$title.'", "'.$text.'", "'.$author.'", "'.$image.'", "'.$tags.'", NOW())') or die(mysql_error());
    go('post/list');

} else if ( $_POST['editpost_f'] ) {//Редактирование
    captcha_valid();

    $posts = mysql_query("SELECT * FROM `posts` WHERE `author` = $_SESSION[id] AND `id` = $_POST[id]");
    if ( !mysql_num_rows($posts) AND $_SESSION['group_u']!=2) message("Ошибка!");
    else {

    if (strlen($_POST['subject']) < 150 or strlen($_POST['subject']) > 50000 ) 
        message("Длина сообшения должна быть от 150 до 50000 символов!");

    $title = FormChars($_POST['title']);
    $text = FormChars($_POST['subject']);
    $category = FormChars($_POST['category']);
    $image = FormChars($_POST['image']);
    $tags = FormChars($_POST['tags']);

    $params = array(
        'key' => 'trnsl.1.1.20171109T212516Z.28e5eceb167b8450.6a2851a3863294a84333ac993a141e5b4fd87b02',
        'text' => $tags,
        'lang' => 'ru-en',
        'format' => 'plain',
    );
    $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
    curl_setopt($curl, CURLOPT_POST, 1);
    // передаём параметры
    curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $result = curl_exec($curl);
    curl_close($curl);
    $token = json_decode($result, true);
    $tags_en = $token[text][0];

    //$desc = FormChars($_POST['description']);
    check_bbcode ($text);

    mysql_query('UPDATE `posts` SET `category` = "'.$category.'", `title` = "'.$title.'", `text` = "'.$text.'", `tag` = "'.$tags.'", `tag_en` = "'.$tags_en.'", `img` = "'.$image.'" WHERE `id` = "'.$_POST['id'].'"');
    go('news/id/'.$_POST[id].'');
    }
} else if ($_POST['activepost_f']) {//Активация

    if($_SESSION['group_u']==2 OR $_SESSION['group_u']==1) {
        $active_post = mysql_fetch_assoc(mysql_query("SELECT `active` FROM `posts` WHERE  `id` = $_POST[id]"));
        if ($active_post[active]==0 OR $active_post[active]==2) {
        mysql_query('UPDATE `posts` SET `active` = 1 WHERE `id` = "'.$_POST['id'].'"');
        MessageSend(2, 'Статья #'.$_POST[id].' опубликованна', '', 0);
        go('post/list');
        } else {
        mysql_query('UPDATE `posts` SET `active` = 2 WHERE `id` = "'.$_POST['id'].'"');
        MessageSend(2, 'Статья #'.$_POST[id].' скрыта', '', 0);
        go('post/list');
        }
    } else message('Ошибка');

} else if ( $_POST['deletepost_f'] ) {
    $qpost = mysql_query("SELECT * FROM `posts` WHERE `author` = $_SESSION[id] AND `id` = $_POST[id]");
    if ( mysql_num_rows($qpost) OR $_SESSION['group_u']==2) {
        $sql = "DELETE FROM posts WHERE id=$_POST[id]"; 
        mysql_query($sql) or die (mysql_error()); 
        MessageSend(2, 'Статья #'.$_POST[id].' удалена', '', 0);
        go('post/list');
    } else {
        message("Ошибка");
    }
}
?>
