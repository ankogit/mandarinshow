<? check_admin (); MessageShow(); top('Панель управления сайтом'); ?>
<h1>Панель управления сайтом</h1>
<div class="container">
            <div class="row">
                <div class="col-md-12">
                <h2>Статьи</h2>
<table>
                 <tr>
                    <th>id</th>
                    <th>Название</th>
                    <th>Описание</th>
                    <th>Лайки</th>
                    <th>Комментарии</th>
                    <th>ФУНКЦИИ</th>
                  </tr>
<?
    $result = mysql_query("SELECT * FROM posts ") or die(mysql_error());
        //$gitem = mysql_fetch_array($result);

    while ( $items = mysql_fetch_assoc($result) ) {

                echo '
                 <tr>
                    <th>'.$items["id"].'</th>
                    <th>'.$items["title"].'</th>
                    <th>'.$items["text"].'</th>
                    <th>'.$items["like"].'</th>
                    <th>'.$items["comment"].'</th>
                    <th>
                    <a href="edit.php?id='.$items["id"].' "><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="php/delete-post.php?id='.$items["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a href="uppoto.php?id='.$items["id"].'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </th>
                  </tr>
                ';



            }
?>
</table>
<h2>Пользователи</h2>
<table>
                 <tr>
                    <th>id</th>
                    <th>Почта</th>
                    <th>Имя</th>
                    <th>Дата</th>
                    <th>Группа</th>
                    <th>ФУНКЦИИ</th>
                  </tr>
<?
    $result = mysql_query("SELECT * FROM users ") or die(mysql_error());
        //$gitem = mysql_fetch_array($result);

    while ( $items = mysql_fetch_assoc($result) ) {

                echo '
                 <tr>
                    <th>'.$items["id"].'</th>
                    <th>'.$items["email"].'</th>
                    <th>'.$items["name"].'</th>
                    <th>'.$items["reg_date"].'</th>
                    <th>'.$items["group_u"].'</th>
                    <th>
                    <a href="edit.php?id='.$items["id"].' "><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="php/delete-post.php?id='.$items["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a href="uppoto.php?id='.$items["id"].'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </th>
                  </tr>
                ';



            }
?>
</table>
<h2>Комментарии</h2>
<table>
                 <tr>
                    <th>id поста</th>
                    <th>Отправил</th>
                    <th>Текст</th>
                    <th>ФУНКЦИИ</th>
                  </tr>
<?
    $result = mysql_query("SELECT * FROM comments ") or die(mysql_error());
        //$gitem = mysql_fetch_array($result);

    while ( $items = mysql_fetch_assoc($result) ) {

                echo '
                 <tr>
                    <th>'.$items["pid"].'</th>
                    <th>'.$items["uid"].'</th>
                    <th>'.$items["text"].'</th>
                    <th>
                    <a href="edit.php?id='.$items["id"].' "><i class="fa fa-pencil" aria-hidden="true"></i></a>
                    <a href="php/delete-post.php?id='.$items["id"].'"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    <a href="uppoto.php?id='.$items["id"].'"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                    </th>
                  </tr>
                ';



            }
?>
</table>
<h2>Категории</h2>
<table>
                 <tr>
                    <th>id</th>
                    <th>Категория</th>
                    <th>Аналог</th>
                  </tr>
<?
    $result = mysql_query("SELECT * FROM categories ") or die(mysql_error());
        //$gitem = mysql_fetch_array($result);

    while ( $items = mysql_fetch_assoc($result) ) {

                echo '
                 <tr>
                    <th>'.$items["id"].'</th>
                    <th>'.$items["name"].'</th>
                    <th>'.$items["category"].'</th>
                  </tr>
                ';



            }
?>
</table>
<? bottom(); ?>