<?php

//frontend purpose data
define('SITE_URL','http://127.0.0.1/hotelManage/');
define('CAROUSEL_IMG_PATH',SITE_URL.'images/carousel/');


// backend upload  
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hotelManage/images/');
define('CAROUSEL_FOLDER', 'carousel/');

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
?>