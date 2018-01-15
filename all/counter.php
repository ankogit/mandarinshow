<?
$Count = mysql_query("SELECT COUNT(`id`) FROM `dialog` WHERE `recive` = $_SESSION[id] AND `status` = 0");
if (empty($Count)) echo '<span class="count_message">0</span>';
else {
    if (mysql_num_rows($Count)) {
        $Count = mysql_fetch_row($Count);
    if ($Count[0] != 0) echo ' <span class="count_message">'.$Count[0].'</span>';
     else {
        echo ' <span class="count_message">0</span>';
        }
    }
}

?>