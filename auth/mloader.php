<?

 $qmess = mysql_query("SELECT * FROM `message` WHERE `did` = $_SESSION[module] ORDER BY `id` DESC");

        while ( $qmessag = mysql_fetch_assoc($qmess) ) {

            $resiver = mysql_fetch_assoc(mysql_query("SELECT `email` FROM `users` WHERE `id` = $qmessag[user]"));
            if ( $resiver['email'] != $_SESSION['email']) {
                echo '<div class="reviews"><span>От: '.$resiver['email'].'</span>'.$qmessag['text'].'</div></a>';
            } else {
            echo '<div class="reviews" style="text-align: right;"><b>'.$qmessag['date'].'</b><span>От: '.$resiver['email'].'</span>'.$qmessag['text'].'</div></a>';
            }
        }//echo $_SESSION['module'];
?>
