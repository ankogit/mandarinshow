<?
    if ( $_POST['firstmess_f'] ) {
global $CONNECT;
    $sender = $_POST['id'];
    if ( strlen($_POST['subject']) < 1 or strlen($_POST['subject']) > 200 )
        message("Длина сообшения должна быть от 1 до 200 символов!");
    $subj = $_POST['subject'];
    if ($sender == $_SESSION['id']) message('Вы не можете отправить сообщение самому себе');

    $sender_check = mysql_query("SELECT `id` FROM `users` WHERE `id` = '$sender'");
    if (!mysql_num_rows($sender_check)) message('Пользователь не найден');
    
    
$m_q_dialog = mysql_query("SELECT `id` FROM `dialog` WHERE `recive` = $sender AND `send` = $_SESSION[id] OR `recive` = $_SESSION[id] AND `send` = $sender");
    if (!empty($m_q_dialog)) 
    $m_q_dialog = mysql_fetch_assoc($m_q_dialog);

if ($m_q_dialog) {

    $DID = $m_q_dialog['id'];
    mysql_query("UPDATE `dialog` SET `status` = 0, `send` = $_SESSION[id], `recive` = $sender WHERE `id` = $m_q_dialog[id]");
    } else {


    mysql_query("INSERT INTO `dialog` VALUES ('', 0, $_SESSION[id], $sender)");
    $DID = mysql_insert_id();
    }
    
    
    
    
    mysql_query("INSERT INTO `message` VALUES ('', $DID, $_SESSION[id], '$subj', NOW())");
    //$DID = mysql_insert_id();
    //echo $m_q_user['id'];
        //echo $_SESSION['id'];
//echo $m_q_dialog['id']; echo 'did'; echo $DID;
        go('im/'.$DID.'');
    }

?>

