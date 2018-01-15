<?
if($Param[module]=='add') {
//top('Добавить статью', 0, 0);
    ?>
    
    <h1>Add work</h1>

    <form onsubmit="return false" >
    <p><input class="input full_size" type="text" placeholder="Title" id="title_art"></p>
    <p><textarea class="textarea full_size" placeholder="Description" id="desc_art"></textarea>
    <p><input class="input full_size" type="text" placeholder="size" id="size_art"></p>
    <p><input class="input full_size" type="text" placeholder="resources" id="res_art"></p>
    <p><input class="input full_size" type="text" placeholder="link" id="link_art"></p>
    <p><button class="submit_v2" onclick="post_query('apost', 'addwork', 'title_art.desc_art.size_art.res_art.link_art')">Добавить</button>
    </form>

    <?

} else if($Param[module]=='edit') {

    if($Param['id']) {
        //top('Редактировать статью', 0, 0); 
        $posts = mysql_query("SELECT * FROM `art_gallery` WHERE  `id` = $Param[id]");
        if(mysql_num_rows($posts) != 0) {
            $post = mysql_fetch_assoc($posts);

            $text = str_replace('<br>', '', $post[descpiption]);
            $text = preg_replace('#<br\s*/?>#i', "\n", $text);

            $description = str_replace('<br>', '', $post[description]);
            $description = preg_replace('#<br\s*/?>#i', "\n", $description);
    ?>

    <h1>Редактор работы #<?=$Param[id]?></h1>

    <form onsubmit="return false" >
    <p><input class="full_size" type="text" placeholder="Title" id="title_art" value="<?=$post[title]?>"></p>
    <p><textarea class="full_size" placeholder="Description" id="desc_art"><?=$description?></textarea>
    <p><input class="full_size" type="text" placeholder="size" id="size_art" value="<?=$post[size]?>"></p>
    <input type="hidden" id="id_art" value="<?=$post[id]?>">
    <p><input class="full_size" type="text" placeholder="resources" id="res_art" value="<?=$post[resources]?>"></p>
    <p><input class="full_size" type="text" placeholder="link" id="link_art" value="<?=$post[link]?>"></p>
    <p><button class="submit_v2" onclick="post_query('apost', 'editwork', 'id_art.title_art.desc_art.size_art.res_art.link_art')">Принять</button>
    </form>

    <?
        } else echo "Ошибка 2";
            } else echo "Ошибка 1";
        //Location('/post/list');

} else if ($Param[module]=='list') {
    MessageShow();
    $arts = mysql_query("SELECT * FROM `art_gallery`");
        if(mysql_num_rows($arts) == 0) {
            echo '<h1>Нет работ :(</h1>';
        } else {
            ?>
            <h1>Список всех работ:</h1>
            <div class="table_block">
                <table class="table">
                    <thead>
                      <tr>
                        <th class="bg_blue white">#</th>
                        <th class="bg_blue white">Название</th>
                        <th class="bg_blue white">Действие</th>
                      </tr>
                    </thead>
                    <tbody> 
                    <?
                    while ($Row = mysql_fetch_assoc($arts)) {
                        echo '
                          <tr>
                            <td><a href="/news/id/'.$Row[id].'">'.$Row[id].'</a></td>
                            <td>'.$Row[title].'</td>
                            <td>
                            <a href="/ahome/pages/name/art/module/edit/id/'.$Row[id].'">Edit</a>
                            <span>|</span>
                            <a href="/control/delete/type/art/id/'.$Row[id].'">Delete</a>
                            </td>
                          </tr>
                    
                        ';
                    }
                    ?>
                    </tbody>
                  </table>
            </div>
        <?
        }
    echo '<br><a href="/ahome/pages/name/art/module/add"><button class="submit_v2">Добавить</button></a>';
    echo '<a href="http://phprun1/load">-Загрузрить файл</a><br>';
} else {//Location('/post/list');
}
?>