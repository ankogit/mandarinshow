<?
function update_auth($data) {
    foreach ($data as $key => $value) 
        $_SESSION[$key] = $value;
}
if ( $_POST['edit_f'] ) {

if (!empty($_POST['password'])) {
if ( $_POST['password'] and md5($_POST['password']) != $_SESSION['password'] ) {

    password_valid();
    mysql_query('UPDATE `users` SET `password` = "'.$_POST['password'].'" WHERE `email` = "'.$_SESSION['email'].'"');
    
    }
} 

if ( $_POST['name'] != $_SESSION['name'] ) {

    name_valid();
    mysql_query('UPDATE `users` SET `name` = "'.$_POST['name'].'" WHERE `email` = "'.$_SESSION['email'].'"');
} 

if ( $_POST['sur_name'] != $_SESSION['sur_name'] ) {

    sur_name_valid();
    mysql_query('UPDATE `users` SET `sur_name` = "'.$_POST['sur_name'].'" WHERE `email` = "'.$_SESSION['email'].'"');
    
} 

if ( $_POST['country'] != $_SESSION['country'] ) {

    name_valid();
    mysql_query('UPDATE `users` SET `country` = "'.$_POST['country'].'" WHERE `email` = "'.$_SESSION['email'].'"');
    
} 


if ( $_POST['year'] != $_SESSION['year_birth'] ) {

    year_valid();
    mysql_query('UPDATE `users` SET `year_birth` = "'.$_POST['year'].'" WHERE `email` = "'.$_SESSION['email'].'"');
    
} 

if ( $_POST['protected'] != $_SESSION['protected'] ) {


    if ( $_POST['protected'] == 1 )
        $_SESSION['protected'] = 1;
    
    else
        $_SESSION['protected'] = 0;




    mysql_query('UPDATE `users` SET `protected` = "'.$_SESSION['protected'].'" WHERE `email` = "'.$_SESSION['email'].'"');



}


$update_s = mysql_fetch_assoc(mysql_query("SELECT * FROM `users` WHERE `id` = $_SESSION[id]"));

update_auth($update_s);
message('Сохранено');
}
if($_POST['add_category_f']) {
    if($_POST['category'] && $_POST['name']) {
        if($_SESSION[group_u]>=1){
            $category = (($_POST['category']) ? $_POST['category'] : 'none');
            mysql_query('INSERT INTO categories (`name`, `category`, `status`) VALUES ("'.$_POST['name'].'", "'.$category.'", "0")') or die(mysql_error());
        } else {
            $category = (($_POST['category']) ? $_POST['category'] : 'none');
            mysql_query('INSERT INTO categories (`name`, `category`, `status`) VALUES ("'.$_POST['name'].'", "'.$category.'", "0")') or die(mysql_error());
        }
        MessageSend(2, 'Категория вынесена на голосование', '/category/list', 0);
        go('category/vote');
    } message('Данные не заполнены.');
}





?>