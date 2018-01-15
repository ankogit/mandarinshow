<?
if($module) {
    if($module=='list'){
        top('Список всех статей', 0, 0);
        MessageShow();
        ?><h1>Категории</h1><?
        $query = mysql_query("SELECT * FROM `categories` WHERE `status`=1");
        echo '<div class="container-block_white">';
        echo '<h3>Активные:</h3>
        <div class="table_block">
        <table class="table">
            <thead>
              <tr>
                <th class="bg_blue white">Url</th>
                <th class="bg_blue white">Название</th>
                '.(($_SESSION[group_u]==2) ? '<th class="bg_blue white">Действие</th>' : '').'
              </tr>
            </thead>
            <tbody> ';
            
            while ($Row = mysql_fetch_assoc($query)) {
                //$status = (($Row['status']==1) ? 'активна' : 'не активна');
                echo '
                  <tr>
                    <td>'.$Row[category].'</td>
                    <td>'.$Row[name].'</td>
                    '.(($_SESSION[group_u]==2 && $Row['status']==1) ? '
                    <td>
                    <a href="/control/deactivate/type/category/id/'.$Row['id'].'">Деактивировать</a>
                    </td>
                    ' : '').'
                  </tr>
            
                ';
            }
            
            echo '
            </tbody>
            </table>
            </div>
            ';
            if(!$_SESSION[id]) {
            ?><p>
                Здесь вы можете добавить свою статью, а также проголосовать за другие категории. Эти функции доступны после входа
            </p><?}
          /*
        while ($Row = mysql_fetch_assoc($query)) {
            $status = (($Row['status']==1) ? 'активна' : 'не активна');
            printf('<br><a id="tag" href="/news/'.$Row['category'].'">'.$Row['name'].'</a>'.(($_SESSION[group_u]==2 && $Row['status']==1) ? '<a href="/control/deactivate/type/category/id/'.$Row['id'].'">Деактивировать</a>' : '').' <span> Статус: '.$status.' ');
        }*/
        if($_SESSION[id]){
        echo '<br><br><a href="/category/add"><button class="submit">Добавить категорию</button></a>';
        echo '<br><a href="/category/vote"><button class="submit">Голосовать за категории</button></a>';
        }
        echo '</div>';
    }
    if($_SESSION[id]){
        if($module=='add'){
            top('Список всех статей', 0, 0);
            echo '<div class="container-block_white">';
            ?>
            
            <h1>Добавить категорию:</h1>
        
            <form onsubmit="return false" >
            <p><input class="input full_size" type="text" placeholder="Название для поиска *например: sport, games" id="category"></p>
            <p><input class="input full_size" type="text" placeholder="Название человеческое *например: Спорт, игры" id="name"></p>
            <button class="submit" onclick="post_query('aform', 'add_category', 'id.name.category.captcha')">Добавить</button>
            </form>
        
            <?
            echo '</div>';
        }else if($module=='delete' && $_SESSION[group_u]==2){

        }else if($module=='vote') {
            top('Vote', 0, 0);
            MessageShow();
            echo '<div class="container-block_white">';
            echo '<h1>Категоии находящиеся в стадии голосования</h1>';
            $query = mysql_query("SELECT * FROM `categories` WHERE `status` = 0");
            if(mysql_num_rows($query)!=0) {

            echo '
            <div class="table_block">
            <table class="table">
                <thead>
                  <tr>
                    <th class="bg_red white">Url</th>
                    <th class="bg_red white">Название</th>
                    <th class="bg_red white">Голосов</th>
                    <th class="bg_red white">Действие</th>
                  </tr>
                </thead>
                <tbody> ';
            while ($Row = mysql_fetch_assoc($query)) {
                printf('
                <tr>
                <td>'.$Row[category].'</td>
                <td>'.$Row[name].'</td>
                <td>'.$Row[votes].'</td>
                <td>
                '.(($_SESSION[group_u]==2 && $Row['status']==0) ? '
                 <a href="/control/active/type/category/id/'.$Row['id'].'">Активировать</a> <a href="/control/delete/type/category/id/'.$Row['id'].'">Удалить</a>
                ' : '
                <a href="/control/vote/type/category/id/'.$Row['id'].'">Голосовать</a>
                ').'
                </td>
              </tr>
                ');
            }
            echo '
            </tbody>
            </table>
            </div>
            ';
            } else echo '<h3><i class="fa fa-tag" aria-hidden="true"></i>Пусто</h3>';
            echo '<br><a href="/category">Список активных категорий</a>';
            echo '</div>';
        }else if($module=='edit' && $_SESSION[group_u]>=1){
            //изменять и добавлять картинку
        }
    }
} else Location('/category/list');

if($module!='list' && !$_SESSION[id]) Location('/category/list');
bottom();
?>