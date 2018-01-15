<?php
if ($_FILES['file']['tmp_name']) {
        foreach($_FILES['file']['name'] as $k=>$f) {
            $types = array('image/jpg', 'image/png', 'image/jpeg'); 
            if (!in_array($_FILES['file']['type'][$k], $types)) echo "err";
            if (exif_imagetype(($_FILES['file']['tmp_name'][0])) == IMAGETYPE_PNG) {
                $Image = imagecreatefrompng($_FILES['file']['tmp_name'][$k]);
            } else if (exif_imagetype(($_FILES['file']['tmp_name'][0])) == IMAGETYPE_JPEG) {
                $Image = imagecreatefromjpeg($_FILES['file']['tmp_name'][$k]);
            }
            if ($_FILES['file']['size'][$k] > 1000000) echo "err";

            $Size = getimagesize($_FILES['file']['tmp_name'][$k]);
            $Tmp = imagecreatetruecolor(300, 300);
            imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 300, 300, $Size[0], $Size[1]);
            if (empty($_SESSION['avatar'])) {
                $Files = glob('assets/img/avatars/*', GLOB_ONLYDIR);
                foreach($Files as $num => $Dir) {
                    $Num ++;
                    $Count = sizeof(glob($Dir.'/*.*'));
                    if ($Count < 250) {
                    $Download = $Dir.'/'.$_SESSION['id'];
                    $_SESSION['avatar'] = $Num;
                    $adress = '/'.$_SESSION['avatar'].'/'.$_SESSION['id'];
                    break;
                    }
                }
                echo "y1";
            }else {
                $Download = 'assets/img/avatars'.$_SESSION['avatar'];
                $adress = $_SESSION['avatar'];
            }
            $_SESSION['avatar'] = $adress;
            mysql_query('UPDATE `users`  SET `avatar` = "'.$adress.'" WHERE `id` = "'.$_SESSION['id'].'"');
            imagejpeg($Tmp, $Download.'.jpg');
            imagedestroy($Image);
            imagedestroy($Tmp);
            echo "y2";
    }
} else {
    echo "no file";
}




?>