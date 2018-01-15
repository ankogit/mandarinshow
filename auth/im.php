<?
if ($module) {
    $row = mysql_query("SELECT * FROM `dialog` WHERE `id` = $module") ;
    if (empty($row)) include '/error/page-404.php';
    if (!mysql_num_rows($row)) {
        include '/error/page-404.php';
    }
    else {
    $row =mysql_fetch_assoc($row);

    if($row['recive'] == $_SESSION['id']) {
        mysql_query("UPDATE `dialog` SET `status` = 1 WHERE `id` = $row[id]");
    }


    if ($row['recive'] == $_SESSION['id']) $row['recive'] = $row['send'];
    $User = mysql_fetch_assoc(mysql_query("SELECT `email`, `nickname` FROM `users` WHERE `id` = $row[recive]"));
top('Диалог с '.$User['nickname'].''); 
$Param['id'] += 0;
//echo $Param['id'];

$_SESSION['module'] = $module;
?>
<div class="container-block_white">
<h1>Диалог с: <?=$User['nickname']?></h1>
<form onsubmit="return false" >
<p><input type="text" placeholder="E-mail" value="<?=$User['email']?>" id="email" hidden></p>
<p><textarea class="textarea cl full_size" placeholder="Текст сообщения" id="subject"></textarea></p>
<p><button class="submit_v2" onclick="post_query('sendmessage', 'mess', 'email.subject.captcha')">Отправить</button> </p>
</form>
<div id="post_b">
    
</div>
</div>
<?
bottom();
    }
} else {
    //top('Диалоги: '.$_SESSION[email].' '); 
    top('Все диалоги'); 
$idlog = mysql_query("SELECT * FROM `dialog` WHERE `send` = $_SESSION[id] OR `recive` = $_SESSION[id]");

if(empty($idlog)) echo 'Список пуст :(';

if ( !mysql_num_rows($idlog) ) echo 'Список пуст :(';



while ( $row = mysql_fetch_assoc($idlog) ) {

    //if ($row['recive'] == $_SESSION['id']) $row['recive'] = $row['send'];
    //$qmess = mysql_fetch_assoc( mysql_query("SELECT `text` FROM `message` WHERE `did` = $row[resive]") );
    $User = mysql_fetch_assoc(mysql_query("SELECT `email`, `nickname` FROM `users` WHERE `id` = $row[recive]"));
    if ($User['email']==$_SESSION['email']) {
        $User2 = mysql_fetch_assoc(mysql_query("SELECT `email`, `nickname` FROM `users` WHERE `id` = $row[send]"));
        $recive = $User2['email'];
        $recive_nickname = $User2['nickname'];
    }else {
        $recive = $User['email'];
        $recive_nickname = $User['nickname'];
    }
//echo $row['status'];
    echo '<a href="/im/'.$row['id'].'"><div class="reviews '.(($row['status'] == 0 AND $row['recive'] == $_SESSION['id']) ? 'unvisit' : '').' '.(($row['status'] == 0 AND $row['send'] == $_SESSION['id']) ? 'unveiw' : '').'"><b>'.$recive_nickname.'</b><span>Диалог с: '.$recive.'</span></div></a>';

    }
    bottom();
}

?>

<script type="text/javascript">
    
function load_messages() {
    $.get('/mloader', function ( data ) {

        if( data == 'emty' ) 
            $('#post_b').text('Пусто');

        if( data != 'end' ) 
            $('#post_b').html( data );
        else $("#load_p").detach();
    })
}
/*
function count_message() {
    $.get('/counter', function ( data ) {

        
            $('#counter').html( data );
        
    })
}
*/
 $(document).ready(function() {
    load_messages();
    setInterval('load_messages()',1000);  
/*
    count_message();
    setInterval('count_message()',3000);  
    */
 });
 </script>
