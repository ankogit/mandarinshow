<?
if(!empty($_POST['search'])){
    if ( $_POST['search_f'] ) {
            go('search/'.$_POST['search'].'');
    }
} else message ("Введите запрос");
?>