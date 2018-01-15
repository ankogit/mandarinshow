<?

        //top('Основные настройки', 0, 0); 
        /*$posts = mysql_query("SELECT * FROM `art_gallery` WHERE  `id` = $Param[id]");
        if(mysql_num_rows($posts) != 0) {
            $post = mysql_fetch_assoc($posts);*/
    ?>

    <h1>Основные настройки</h1>

    <form onsubmit="return false" >
    <p><input class="full_size" type="text" placeholder="Title" id="title_art" value="<?=$post[title]?>"></p>
    <p><textarea class="full_size" placeholder="Description" id="desc_art"><?=$description?></textarea>
    <p><input class="full_size" type="text" placeholder="size" id="size_art" value="<?=$post[size]?>"></p>
    <input type="hidden" id="id_art" value="<?=$post[id]?>">
    <p><input class="full_size" type="text" placeholder="resources" id="res_art" value="<?=$post[resources]?>"></p>
    <p><input class="full_size" type="text" placeholder="link" id="link_art" value="<?=$post[link]?>"></p>
    <p><button onclick="post_query('apost', 'editwork', 'id_art.title_art.desc_art.size_art.res_art.link_art')">Принять</button>
    </form>
    <?

    bottom();
?>