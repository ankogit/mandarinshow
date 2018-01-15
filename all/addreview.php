<? 

if ($_POST['reviews_f']) {
    if ($_SESSION["id"]) {
    if ( strlen($_POST['subject']) < 10 or strlen($_POST['subject']) > 500 )
        message("Длина сообшения должна быть от 10 до 500 символов!");

    mysql_query('INSERT INTO `reviews` VALUES ("", "'.$_SESSION['id'].'", "'.mysql_real_escape_string($_POST['subject']).'")');

    go('reviews');
    } else go('login');
}
 ?>