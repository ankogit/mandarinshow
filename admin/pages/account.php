<?
if($Param[module]=='add') {
//top('Добавить статью', 0, 0);
    /*?>
    
    <h1>Add work</h1>

    <form onsubmit="return false" >
    <p><input class="full_size" type="text" placeholder="Title" id="title_art"></p>
    <p><textarea class="full_size" placeholder="Description" id="desc_art"></textarea>
    <p><input class="full_size" type="text" placeholder="size" id="size_art"></p>
    <p><input class="full_size" type="text" placeholder="resources" id="res_art"></p>
    <p><input class="full_size" type="text" placeholder="link" id="link_art"></p>
    <p><button class="submit_v2" onclick="post_query('apost', 'addwork', 'title_art.desc_art.size_art.res_art.link_art')">Добавить</button>
    </form>

    <?
*/
} else if($Param[module]=='edit') {

    if($Param['id']) {
        //top('Редактировать статью', 0, 0); 
        $result = mysql_query("SELECT * FROM `users` WHERE  `id` = $Param[id]");
        if(mysql_num_rows($result) != 0) {
            $result = mysql_fetch_assoc($result);

    ?>

    <h1>Редактор пользователя #<?=$Param[id]?></h1>

    <form onsubmit="return false" >
    <p><label>Никнэйм <br><input class="input full_size" type="text" placeholder="Nickname" id="nickname_user" value="<?=$result[nickname]?>"></label></p>
    <p><label>Почта <br><input class="input full_size" type="text" placeholder="Емайл" id="email_user" value="<?=$result[email]?>"></label></p>
    <p><label>Группа (0-2) <br><input class="input full_size" type="text" placeholder="Права" id="group_user" value="<?=$result[group_u]?>"></label></p>
    <input type="hidden" id="id_user" value="<?=$result[id]?>">
    <p><button class="submit_v2" onclick="post_query('apost', 'edituser', 'id_user.nickname_user.email_user.group_user')">Принять</button>
    </form>

    <?
        } else echo "Ошибка 2";
            } else echo "Ошибка 1";
        //Location('/post/list');

} else if ($Param[module]=='list') {
    MessageShow();
    $arts = mysql_query("SELECT * FROM `users`");
        if(mysql_num_rows($arts) == 0) {
            echo '<h1>Нет пользователей :(</h1>';
        } else {
            ?>
            <h1>Список всех пользователей:</h1>
            <div class="table_block">
                <table class="table">
                    <thead>
                      <tr>
                        <th class="bg_red white">id</th>
                        <th class="bg_red white">Никнэйм</th>
                        <th class="bg_red white">Почта</th>
                        <th class="bg_red white">Группа</th>
                        <th class="bg_red white">Действие</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?
                    while ($Row = mysql_fetch_assoc($arts)) {
                        echo '
                          <tr>
                            <td><a href="/user/'.$Row[id].'">'.$Row[id].'</a></td>
                            <td>'.$Row[nickname].'</td>
                            <td>'.$Row[email].'</td>
                            <td>'.$Row[group_u].'</td>
                            <td>
                            <a href="/ahome/pages/name/account/module/edit/id/'.$Row[id].'">Edit</a>
                            <span>|</span>
                            <a href="/control/delete/type/user/id/'.$Row[id].'">Delete</a>
                            </td>
                          </tr>
                    
                        ';
                    }
                    ?>
                    </tbody>
                  </table>
            </div>
            <ul>
                <li>0 - Обычный пользователь</li>
                <li>1 - модератор</li>
                <li>2 - Администратор</li>
            </ul>
        <?
        }
} else {//Location('/post/list');
}
?>