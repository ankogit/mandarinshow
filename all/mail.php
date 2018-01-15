<? 

if ($_POST['contact_f']) {
    email_valid();
    captcha_valid();

    if ( strlen($_POST['subject']) < 10 or strlen($_POST['subject']) > 200 )
        message("Длина сообшения должна быть от 10 до 200 символов!");

    mail($admin_email, 'Письмо в тех.поддержку с сайта:'.$name_web_site.'', 'Почта отправителя:<b>'.$_POST['email'].'</b><br><p>'.htmlspecialchars($_POST['subject']).'</p>');
    
    cform();
    //go('contact');
} else if ($_POST['mailsubscribe_f']) {
    email_valid();
    $query = mysql_query("SELECT * FROM `mailsubscribers` WHERE `mail` = $_POST[email]");
    if (!empty($query) AND mysql_num_rows($query)) message("Вы уже оформили подписку!");
    else {
        mysql_query('INSERT INTO mailsubscribers (`mail`) VALUES ("'.$_POST[email].'")') or die(mysql_error());
        setcookie("mailsub","1",time()+86000);
        MessageSend(3, 'Вы оформили подписку на наш журнал', 'news/', 0);
        go('news/');
    }
}
 ?>
