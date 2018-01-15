<? top('🦄 Админка', 0, 0, 0) ?>
<div class="admin_panel">
    <div class="left_side">
        <div class="header_content_panel">
            <h1>Панель администрирования сайта</h1>
            <p>Это набор страниц позволяющих админам/модераторам осуществлять контроль над сайтом. По всем вопросам, скорее всего, вы найдёте здесь ответ.</p>
        </div>
    </div>
    <div class="right_side">
        <? if ($module == 'pages' && $Param[name]) {
            include 'admin/pages/'.$Param[name].'.php';
            echo '<a href="/ahome">На главную панель</a>';
        } else {?>
            <ul>
                <li>
                    <a href="/ahome/pages/name/main">
                        <div class="bg_admi" style="background-image: url(/assets/img/highlights-small-vfl9QucA7.png);"></div>
                        <h3>Основные настройки</h3>
                        <p></p>
                    </a>
                </li>
                <li>
                    <a href="/ahome/pages/name/account/module/list">
                        <div class="bg_admi" style="background-image: url(/assets/img/account-small-vflqhcLEj.png);"></div>
                        <h3>Аккаунты</h3>
                        <p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца.</p>
                    </a>
                </li>
                <li>
                    <a href="/ahome/pages/name/art/module/list">
                        <div class="bg_admi" style="background-image: url(/assets/img/highlights-small-vfl9QucA7.png);"></div>
                        <h3>Арт</h3>
                        <p>Добавить/редактировать или удалить арт работу </p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="bg_admi" style="background-image: url(/assets/img/visibility-and-control-small-vflgveFkN.png);"></div>
                        <h3>Рассылки писем</h3>
                        <p>Душа моя озарена неземной радостью, как эти чудесные весенние утра, которыми я наслаждаюсь от всего сердца.</p>
                    </a>
                </li>
            </ul>
            <?}?>
    </div>
</div>

<? bottom() ?>