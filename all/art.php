<?
if ($module=='view' && $Param[id]) {
    top('Арт #'.$Param[id], 1, 0);
    $art = mysql_fetch_assoc(mysql_query("SELECT * FROM art_gallery WHERE `id` = $Param[id]"));
    printf('
    <section class="single-item slider">
        <div class="slide">
            <img src="'.$art[link].'" alt="alt" />
        </div>
    </section>
    <div class="col-md-9">
        <h1>'.$art[title].'</h1>
        <p>'.$art[description].'</p>
    </div>
    <div class="col-md-3">
        <h3>Детали проекта</h3>
        <ul class="project_details">
            <li><span id="desc"><i class="fa fa-calendar" aria-hidden="true"></i> Выложено:</span><span id="desc_val">'.$art[date].'</span></li>
            <li><span id="desc"><i class="fa fa-pencil" aria-hidden="true"></i> Размер:</span><span id="desc_val">'.$art[size].'</span></li>
            <li><span id="desc"><i class="fa fa-window-maximize" aria-hidden="true"></i> Средства:</span><span id="desc_val">'.$art[resources].'</span></li>
            <li><span id="desc"><i class="fa fa-link" aria-hidden="true"></i> Ссылка:</span><span id="desc_val"><a href="'.$art[link].'">copy</a></span></li>
            <li><span id="desc"><i class="fa fa-arrow-down" aria-hidden="true"></i> Скачать:</span><span id="desc_val"><a href="'.$art[link].'" download>Link</a></span></li>
        </ul>
    </div>
        ');
    bottom();
} else {
    $META[title]='Арт';
//$META[type]='<meta property="og:type" content="article"/>';
$META[url]='/art';
$META[image]='http://mandarinshow.ru/assets/img/art.png';
$META[description]='Здесь вы можете посмотреть моё графическое творчество.';
$META[Keywords_ru]='арт, mandarin, show, art, рисунки';
$META[Keywords_en]='арт, mandarin, show, art, рисунки';

$META[Description]='Здесь вы можете посмотреть моё графическое творчество.';

$META[image_src]='/assets/img/art.png';
top('Арт', 1, 0);?>
        </div>
    </div>
</div>
<div class="anime">
    <div class="headband">
        <div class="star"></div>
        <div class="raduga"></div><div class="finn"></div>
        <div class="center_main">
            <h1 class="white">Арт Галерея</h1>
            <hr class="line_h">
            <h2 class="white">Антоненко Анатолий</h2>
        </div>
        <div class="cloud_2"></div>
        <div class="cloud_1"></div>
    </div>
</div>

<div class="bg_white">
    
<?
$first_art = mysql_fetch_assoc(mysql_query("SELECT * FROM art_gallery ORDER BY id DESC LIMIT 1"));
?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="imag_day">
                                    <h3>Свежий арт:</h3>
                                    <a href="<?=$first_art[link]?>"><img src="<?=$first_art[link]?>" alt="alt" /></a>
                                </div>
                            </div>
                        </div>
                    </div>
                        








<section class="gallery" id="image-popups">
                    <div class="container">
                        <div class="row">
                        <?
                        $arts = mysql_query("SELECT * FROM art_gallery");
                            while ($Row = mysql_fetch_assoc($arts)) {
                                print('
                                <div class="col-md-3 col-xs-6">
                                    <div class="gall_item gitem square">
                                        <img src="'.$Row[link].'" alt="Alt">
                                        <div class="item_cont">

                                            <a href="'.$Row[link].'" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>

                                            <a href="/art/view/id/'.$Row[id].'"><span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span></a>

                                            <h2>'.$Row[title].'</h2>
                                        </div>
                                    </div>
                                </div>
                                    ');
                            }
                        ?>
                        <!--
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/catalog/img/1/40.jpg" alt="Alt">
                                    <div class="item_cont">

                                        <a href="/assets/img/catalog/img/1/40.jpg" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>

                                        <a href="/art/1"><span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span></a>

                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <a href="/assets/img/prevew-project.jpg" class="ilink" id="image-popup" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <a href="/assets/img/prevew-project.jpg" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-6">
                                <div class="gall_item gitem square">
                                    <img src="/assets/img/finn312.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <a href="/assets/img/finn312.jpg" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="gall_item gitem">
                                    <img src="/assets/img/finn312.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <a href="/assets/img/finn312.jpg" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-xs-12">
                                <div class="gall_item gitem ">
                                    <img src="/assets/img/prevew-project.jpg" alt="Alt">
                                    <div class="item_cont">
                                        <a href="/assets/img/prevew-project.jpg" class="ilink" data-effect="mfp-zoom-in"><span class="gal_veiw"><i class="fa fa-eye" aria-hidden="true"></i></span></a>
                                        <span class="gal_link"><i class="fa fa-link" aria-hidden="true"></i></span>
                                        <h2>Lorem</h2>
                                    </div>
                                </div>
                            </div>
                        -->
                        </div>
                    </div>
                </section>
</div>
<?bottom();}?>