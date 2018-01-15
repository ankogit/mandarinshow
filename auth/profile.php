<? top('Профайл')?>
<script>
        $(document).ready(function () {             
            $("#upload_image").imageUpload("upload", {
                uploadButtonText: "Загрузить",
                previewImageSize: 100,
                onSuccess: function (response) {
                    //alert(response);
                    go('profile');
                }
            });
        });
    </script>

<h1>Редактировать профайл</h1>
<form onsubmit="return false" enctype="multipart/form-data">
<p>Имя</p>
<p><input type="text" value="<?=$_SESSION['name']?>" placeholder="Имя..." id="name"></p>
<p>Фамилию</p>
<p><input type="text" value="<?=$_SESSION['sur_name']?>" placeholder="Фамилия..." id="sur_name"></p>
<p>Страну</p>
<p><input type="text" value="<?=$_SESSION['country']?>" placeholder="Страна..." id="country"></p>
<p>Год рождения</p>
<p><input type="text" value="<?=$_SESSION['year_birth']?>" placeholder="Год рождения..." id="year"></p>
<p>Изменить пароль</p>
<p><input type="password" placeholder="Новый пароль" id="password"></p>
<p>Защита входа по Email</p>
<p><select id="protected">
<?=str_replace('"'.$_SESSION['protected'].'"', '"'.$_SESSION['protected'].'" selected', '<option value="0">Подтверждение входа Выкл.</option><option value="1">Подтверждение входа Вкл.</option>')?>
</select></p>
<p>Изменить аватар</p>
<div class="u_avatar" style="width: 100px; height: 100px;">
<? my_avatar(); ?>
</div>
<p>
<div id="upload_image">
    </div>
    <p>
<p><button onclick="post_query('aform', 'edit', 'name.sur_name.country.year.password.protected')">Сохранить</button></p>
</form>
<br><p>*Для того, чтобы изменения вступили в силу, вам нужно перезайти.</p>
<? bottom() ?>