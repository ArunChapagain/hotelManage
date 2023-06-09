<?php
if (isset($_POST['get_carousel'])) {
    $res = selectAll('carousel');

    while ($row = mysqli_fetch_assoc($res)) {
        $path = CAROUSEL_IMG_PATH;
        echo <<<data
            <div class="col-md-4 lg-4 mb-3">
                <div class="card bg-dark text-white">
                    <img src="$path$row[image]" class="card-img">
                        <div class="card-img-overlay text-end">
                        <button type="button" onclick="rem_image($row[Img_no])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i> Delete
                        </button>
                    </div>
                </div>
            </div>
        data;


    }
}


if (isset($_POST['rem_image'])) {

    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_image']];

    $pre_q = "SELECT * FROM `carousel` WHERE `Img_no`=? ";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], CAROUSEL_FOLDER)) {
        $q = "DELETE FROM `carousel` WHERE `Img_no`=?";
        $res = deleteData($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}