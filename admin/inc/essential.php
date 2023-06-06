<?php

//frontend purpose data
define('SITE_URL','http://127.0.0.1/hotelManage/');
define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');
define('ICONS_IMG_PATH',SITE_URL.'images/icons/');
define('ROOMS_IMG_PATH',SITE_URL.'images/rooms/');
define('USERS_IMG_PATH',SITE_URL.'images/users/');


// backend upload  
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hotelManage/images/');
define('CAROUSEL_FOLDER', 'carousel/');
define('ICONS_FOLDER', 'icons/');
define('ROOMS_FOLDER', 'rooms/');
define('USERS_FOLDER', 'users/');
define('SEND_GRID_API_KEY',"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");

function adminLogin()
{
    session_start();
    if (!(isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true)) {
        redirect('index.php');
        echo "<script>
            window.location.href='index.php';
         </script>";
         exit;
    }
    // session_regenerate_id(true);

}
function redirect($url)
{
    echo "<script>
            window.location.href='$url';
        </script>";
}
function alert($type, $msg)
{
    $bs_class = ($type == 'success') ? "alert-sucess" : "alert-danger";

    echo <<<alert
     <div class="alert $bs_class alert-dismissible show fade custom-alert" role="alert">
        <strong class="me-3">$msg</strong> 
        <button type="button" class="btn-close shadow-none" data-bs-dismiss="alert" aria-label="Close" onclicked="redirect('index.php')"></button>
     </div>
   alert;
}
function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024) > 2)) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'Img_' . random_int(11111, 99999) . ".$ext";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }

    }
}

function deleteImage($image,$folder)

{
if(unlink(UPLOAD_IMAGE_PATH.$folder.$image))
{
    return true;
}
else{
    return false;
}
}


function uploadSVGImage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } else if (($image['size'] / (1024 * 1024) > 2)) {
        return 'inv_size';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'Img_' . random_int(11111, 99999) . ".$ext";
        $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;
        if (move_uploaded_file($image['tmp_name'], $img_path)) {
            return $rname;
        } else {
            return 'upd_failed';
        }

    }
}

// contains error so let's use uploadImage function instead of this function
function uploadUserImage($image)
{
    $valid_mime = ['image/jpeg', 'image/png', 'image/webp'];
    $img_mime = $image['type'];

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    } else {
        $ext = pathinfo($image['name'], PATHINFO_EXTENSION);
        $rname = 'Img_' . random_int(11111, 99999) . ".jpeg";
        $img_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $rname;

        if($ext=='png'||$ext=='PNG')
        {
          $img=  imagecreatefrompng($image['name']);
        }
        else  if($ext=='webp'||$ext=='WEBP'){
            $img=  imagecreatefromwebp($image['name']);
        }
        else  if($ext=='jpeg'||$ext=='JPEG'){
            $img=  imagecreatefromjpeg($image['name']);
        }

        if(imagejpeg($img,$img_path,70))
        {
            return $rname;
        }
        else {
            return 'upd_failed';
        }
    }
}


?>