<? 

$query = mysql_query('SELECT * FROM `posts` ORDER BY `id` DESC LIMIT '.$_SESSION['loader'].', 2');

    if( !mysql_num_rows($query) ) {
        if ($_SESSION['loader'] == 0) exit('empty');
        else exit('end');
        exit;
    }
$_SESSION['loader'] += 2;
while ( $row = mysql_fetch_assoc($query) ) {
    echo '<h2>'.$row['title'].'</h2><p>'.$row['text'].'<p>';
}

 ?>