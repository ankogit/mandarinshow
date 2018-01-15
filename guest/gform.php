<?
function go_auth($data) {
    foreach ($data as $key => $value) 
        $_SESSION[$key] = $value;

    go('user/'.$_SESSION[id].'');
}

if ($_POST['login_f']) {
    email_valid();
    password_valid();
    captcha_valid();
    $result = mysql_query("SELECT * FROM users WHERE email='$_POST[email]' AND `password` = '$_POST[password]'") or die(mysql_error()); 
    if (mysql_num_rows($result) == 0 ){
    message('Аккаунт не найден');
    } 

    $row = mysql_fetch_assoc($result);

    if ( $row['protected'] == 1 ) {
        $code = random_str(5);
        $_SESSION['confirm'] = array(
            'type' => 'login',
            'data' => $row,
            'password' => $_POST['password'],
            'code' => $code,
            );
        mail($_POST['email'], 'Подтверждение входа' , "Код подтверждения входа: $code", 'From: support@mandarinshow.ru');
        go('confirm');

    }
    go_auth($row);

}

else if ($_POST['register_f']) {
    password_repeat();
    captcha_valid();
    nickname_valid();
    email_valid();
    password_valid();
    

    $result = mysql_query("SELECT * FROM users WHERE email='$_POST[email]' OR nickname ='$_POST[nickname]'") or die(mysql_error()); 
    if (mysql_num_rows($result)){
    message('Email или никнейм уже занят другим');
    }   else {
    $code = rand(1000,9999);
    $_SESSION['confirm'] = array(
        'type' => 'register',
        'nickname' => $_POST['nickname'],
        'email' => $_POST['email'],
        'password' => $_POST['password'],
        'code' => $code,
        );
    mail($_POST['email'], 'Регистрация' , "Ник: ".$_POST['nickname']." <br>Код регистрации: $code", 'From: support@mandarinshow.ru');
    go('confirm');
    }


}

else if ($_POST['recovery_f']) {
    email_valid();
    captcha_valid();
    $result = mysql_query("SELECT * FROM users WHERE email='$_POST[email]'") or die(mysql_error()); 
    if (mysql_num_rows($result) == 0 ){
    message('Аккаунт не найден');
    }   else {
        $code = random_str(5);
    $_SESSION['confirm'] = array(
        'type' => 'recovery',
        'email' => $_POST['email'],
        'code' => $code,
        );
    mail($_POST['email'], 'Востановление пароля' , "Код востановления: $code", 'From: support@mandarinshow.ru');
    go('confirm');
    message('Аккаунт не найден');
    }
}

else if ($_POST['confirm_f']) {

    


    if ( $_SESSION['confirm']['type'] == 'register') {




        if ( $_SESSION['confirm']['code'] != $_POST['code'] )
                message('Код подтверждения регистрации указан неверно');


            mysql_query('INSERT INTO `users` VALUES ("", "'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'")');
            mysql_query('INSERT INTO users (`nickname`, `email`, `password`, `reg_date`) VALUES ("'.$_SESSION['confirm']['nickname'].'", "'.$_SESSION['confirm']['email'].'", "'.$_SESSION['confirm']['password'].'", NOW())') or die(mysql_error());

            unset($_SESSION['confirm']);

            go('login');

        }


        else if ( $_SESSION['confirm']['type'] == 'recovery') {


        if ( $_SESSION['confirm']['code'] != $_POST['code'] )
                message('Код востановления указан неверно');

            $new_pass = random_str(7);

            mysql_query('UPDATE `users` SET `password` = "'.md5($new_pass).'" WHERE `email` = "'.$_SESSION['confirm']['email'].'"');
            unset($_SESSION['confirm']);
            mail($_POST['email'], 'Новый пароль' , "Ваш новый пароль: $new_pass", 'From: support@mandarinshow.ru');
            MessageSend(2, 'На вашу почту высланно письмо с новым паролем', '', 0);
            go('login');

        }

        else if ( $_SESSION['confirm']['type'] == 'login') {
            if ( $_SESSION['confirm']['code'] != $_POST['code'] )
                message('Код подтверждения входа указан неверно');

           go_auth($_SESSION['confirm']['data']);
        }

    else not_found();


}
?>