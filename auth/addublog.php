<? 

if ($_POST['ublog_f']) {
    if ($_SESSION["id"]) {
    if ( strlen($_POST['subject']) < 5 or strlen($_POST['subject']) > 1000 )
        message("Длина сообшения должна быть от 5 до 1000 символов!");

    $date = date("d.m.y");

    mysql_query('INSERT INTO u_blog (`uid`, `text`, `date`) VALUES ("'.$_SESSION['id'].'", "'.mysql_real_escape_string($_POST['subject']).'", "'.$date.'")') or die(mysql_error());

    go('user/'.$_SESSION["id"].'');
    } else go('login');
} 
/*
else if ($_POST['delblog_f']) {
    $id = intval($_POST["id"]); 

    function pagedel($id){ // функция удаления страниц 
    $sql = "DELETE FROM u_blog WHERE id='$id'"; 
    mysql_query($sql) or die (mysql_error()); 
    }
    
    pagedel($id); 
    $URL_old = parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH);
    $url_parse = explode('/', trim($URL_old, ' /'));
    $old_url = array_shift($url_parse);
    go(''.$old_url.'/'.$url_parse[0].'');
}*/

 ?>
