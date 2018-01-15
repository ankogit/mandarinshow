<?
$hash = '123 \n <br> \r\n "123"% # @ & This \r\n is <br>\n\ra\<br>nstring\r';
//$text = FormChars($hash);
$categories = mysql_query("SELECT * FROM `categories`"); //список категорий 
$posts = mysql_query("SELECT * FROM `posts`");
        function active($id) {
            if ($_SESSION['group_u']==2 OR $_SESSION['group_u']==1) {
            $active_post = mysql_fetch_assoc(mysql_query("SELECT `active` FROM `posts` WHERE  `id` = $id"));
            if ($active_post[active]==0 OR $active_post[active]==2) {
            ?>
            <button class="submit_v2" onclick="post_query('epost', 'activepost', 'id')">Активировать</button>
            <?
            } else {
            ?>
            <button class="submit_v2" onclick="post_query('epost', 'activepost', 'id')">Деактивировать</button>
            <?
              }
            }
        }
if($module=='add') {
top('Добавить статью', 0, 0);
    ?>
<div class="container-block_white">
    <script>
    $(document).ready(function() {
    var wbbOpt = {
      buttons: "header,bold,italic,underline,|,bullist,numlist,|,img,link,video,|,quote,|,slider,slide,|",
      lang: "ru"
    }
    $("#subject").wysibb(wbbOpt);
    });
    function submit_subject() {
        $("#subject").sync();
        post_query('epost', 'addpost', 'title.subject.category.id.image.tags.captcha');
    }
    </script>
    <h1>Add post</h1>

    <form onsubmit="return false" >
    <p><input class="input full_size" type="text" placeholder="Название новости" id="title"></p>
    <p><textarea class="textarea cl" placeholder="Введите статью" id="subject"></textarea>
    <p>От 150 - до 5000</p>
    <p><input class="input half_size" type="text" placeholder="Изображение поста" id="image" value="<?=$post[img]?>"></p>
    <select size="1" name="cat" id="category">
        <?while ($Row = mysql_fetch_assoc($categories)) echo '
        <option value="'.$Row['category'].'">'.$Row['name'].'</option>'?>
    </select>
    <a href="/category/add">-Предложить свою категорию</a>
    <p><input class="input half_size" type="text" placeholder="Поисковые Теги |пример: red, apple, tree" id="tags"><span>*желательно/</span></p>
    <p><input class="input" type="text" placeholder="<?captcha()?>" id="captcha"></p>
    <p><button class="submit_v2" onclick="submit_subject()">Добавить</button>
    <button class="submit_v2" type="reset" value="Очистить">Очистить</button></p>
    <input class="submit_v2" type="button" onclick="history.back();" value="Назад"/>
    </form>
</div>
    <?

} else if($module=='edit') {

    if($Param['id']) {
        top('Редактировать статью', 0, 0); 
        $posts = mysql_query("SELECT * FROM `posts` WHERE  `id` = $Param[id]");
        if(mysql_num_rows($posts) != 0) {
            $post = mysql_fetch_assoc($posts);

            if($post['author']==$_SESSION['id'] || $_SESSION['group_u']==2) {

            $text = str_replace('<br>', '', $post[text]);
            $text = preg_replace('#<br\s*/?>#i', "\n", $text);

            $description = str_replace('<br>', '', $post[description]);
            $description = preg_replace('#<br\s*/?>#i', "\n", $description);
    ?>
<div class="container-block_white">
    <script>
    $(document).ready(function() {
    var wbbOpt = {
      buttons: "header,bold,italic,underline,|,bullist,numlist,|,img,link,video,|,quote,|,slider,slide,|",
      lang: "ru"
    }
    $("#subject").wysibb(wbbOpt);
    });
    function submit_subject() {
        $("#subject").sync();
        post_query('epost', 'editpost', 'title.subject.category.id.captcha.image.tags');
    }
    </script>

    <h1>Редактор поста #<?=$Param[id]?></h1>
    <form onsubmit="return false" >
    <p><input class="input full_size" type="text" placeholder="Название новости" id="title" value="<?=$post[title]?>"></p>
    <p><textarea class="textarea full_size" onkeyup="schet('150', '5000')" class="cl" placeholder="Введите статью" id="subject"><?=$text?></textarea>
    <p id="WordCounter"></p>
    <p>От 150 - до 5000</p>
    </p>
    <p><input class="input half_size" type="text" placeholder="Изображение поста" id="image" value="<?=$post[img]?>"></p>
    <p><select size="1" name="cat" id="category">
    <?while ($Row = mysql_fetch_assoc($categories)) echo '
    <option value="'.$Row['category'].'"'.(($Row['category']==$post[category]) ? 'selected': '').'>'.$Row['name'].'</option>
    '?>
    </select></p>
    <p><input class="input" type="text" placeholder="Поисковые Теги" id="tags" value="<?=$post[tag]?>"><span>*желательно</span></p>
    <p><input class="input" type="text" placeholder="<?captcha()?>" id="captcha"></p>
    <input id='id' value="<?=$Param[id]?>" hidden>
    <p><button class="submit_v2" onclick="submit_subject()">Сохранить</button>
    <button class="submit_v2" type="reset" value="Очистить">Очистить</button></p>
    <?=active($Param[id])?>
    <p><button class="submit_v2" onclick="post_query('epost', 'deletepost', 'id')">Удалить</button></p>
    <button class="submit_v2" type="button" onclick="history.back();">Назад</button>
    </form>
</div>
    <?
            } else echo 'Ошибка';
        } else echo 'Нет доступа';
    } else {
        Location('/post/list');
    }
} else if ($module=='list') {
    //check_admin();
        if ($_SESSION['group_u']!=2) {
            $posts = mysql_query("SELECT * FROM `posts` WHERE `author` = $_SESSION[id]");
        }
    top('Список всех статей', 0, 0);
    MessageShow();
        if ( !mysql_num_rows($posts)) echo '<h1>У вас ещё нет статей :(</h1>';
        else {
            ?>
            <h1>Список всех статей:</h1>
                            <div class="table_block">
                                <table class="table">
                                    <thead>
                                      <tr>
                                        <th class="bg_red white">Номер #</th>
                                        <th class="bg_red white">Название</th>
                                        <th class="bg_red white">Категория</th>
                                        <th class="bg_red white">Статус</th>
                                        <th class="bg_red white">Автор</th>
                                        <th class="bg_red white">Действие</th>
                                      </tr>
                                    </thead>
                                    <tbody> 
                                    <?
                                    while ($Row = mysql_fetch_assoc($posts)) {
                                        if ($Row[active]==1) $status = 'Опубликована';
                                        else if ($Row[active]==0) $status = 'Проверка';
                                        else $status = 'Закрыта';
                                        echo '
                                          <tr>
                                            <td><a href="/news/id/'.$Row[id].'">'.$Row[id].'</a></td>
                                            <td>'.$Row[title].'</td>
                                            <td>'.$Row[category].'</td>
                                            <td>'.$status.'</td>
                                            <td>'.$Row[author].'</td>
                                            <td>
                                            <a href="/post/edit/id/'.$Row[id].'">Edit</a>
                                            </td>
                                          </tr>
                                    
                                        ';
                                    }
                                    ?>
                                    </tbody>
                                  </table>
                            </div><br>
                            <a href="/post/add"><button class="submit">Написать статью</button></a><br>
        <?
        }
} else Location('/post/list');
?>


<? bottom() ?>