<?
 top('Вход в панель Администратора') ?>

<h1>Вход в панель Администратора</h1>
<form onsubmit="return false" >
<p><input type="text" placeholder="Логин" id="login"></p>
<p><input type="password" placeholder="Пароль" id="password"></p>
<p><input type="text" placeholder="<?captcha()?>" id="captcha"></p>
<p><button onclick="post_query('a_auth', 'login', 'login.password.captcha')">Войти</button></p>
</form>
<? bottom() ?>