<?
    if ( $_POST['mess_f'] ) {
global $CONNECT;
    $sender = $_POST['email'];
    if ( strlen($_POST['subject']) < 1 or strlen($_POST['subject']) > 200 )
        message("Длина сообшения должна быть от 1 до 200 символов!");
    $subj = $_POST['subject'];
    if ($sender == $_SESSION['email']) message('Вы не можете отправить сообщение самому себе');

    $m_q_user = mysql_fetch_assoc(mysql_query("SELECT `id` FROM `users` WHERE `email` = '$sender'"));
    
if (!$m_q_user) message('Пользователь не найден');
    
    
$m_q_dialog = mysql_fetch_assoc(mysql_query("SELECT `id` FROM `dialog` WHERE `recive` = $m_q_user[id] AND `send` = $_SESSION[id] OR `recive` = $_SESSION[id] AND `send` = $m_q_user[id]"));
    
    

if ($m_q_dialog) {

    $DID = $m_q_dialog['id'];
    mysql_query("UPDATE `dialog` SET `status` = 0, `send` = $_SESSION[id], `recive` = $m_q_user[id] WHERE `id` = $m_q_dialog[id]");
    } else {


    mysql_query("INSERT INTO `dialog` VALUES ('', 0, $_SESSION[id], $m_q_user[id])");
    $DID = mysql_insert_id();
    }
    
    
    
    
    mysql_query("INSERT INTO `message` VALUES ('', $DID, $_SESSION[id], '$subj', NOW())");
    //$DID = mysql_insert_id();
    //echo $m_q_user['id'];
        //echo $_SESSION['id'];
//echo $m_q_dialog['id']; echo 'did'; echo $DID;
        cform();
    }

?>

