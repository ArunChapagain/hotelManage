<?php
require('../inc/essential.php');
require('../inc/db_config.php');
adminLogin();


if (isset($_POST['add_member'])) {

    $frm_data = filteration($_post);
    $img_r = uploadImage($_FILES['picture'], ABOUT_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;

    } else if ($img_r == 'inv_size') {
        echo $img_r;

    } else if ($img_r == 'upd_failed') {
        echo $img_r;

    } else {
        $q = "INSERT INTO `team-details` (`name`,`picture`) VALUES (?,?)";
        $values = [$frm_data['name'], $img_r];
        $res = insert($q, $values, 'ss');
        echo $res;
    }
}
?>

