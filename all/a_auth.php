<? 

if ($_POST['login_f']) {
    //captcha_valid();
    if ($_POST['login'] != $admin_login or $_POST['password'] != $admin_pass) {
    message('Доступ запрещён!');
    }
    $_SESSION['admin'] = 1;
    go('ahome');
}

 ?>