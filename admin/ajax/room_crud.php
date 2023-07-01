<?php
require('../inc/essential.php');
require('../inc/db_config.php');
adminLogin();

$booking_status = 0;

if (isset($_POST['add_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));

    $frm_data = $_POST;
    $flag = 0;

    $q1 = "INSERT INTO `rooms`(`name`,`type`,`location`,`gmap`,`price`, `adult`, `children`, `description`) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$frm_data['name'], $frm_data['type'], $frm_data['location'], $frm_data['gmap'], $frm_data['price'], $frm_data['adult'], $frm_data['children'], $frm_data['desc']];

    if (insert($q1, $values, 'ssssiiis')) {
        $flag = 1;
    }

    $room_id = mysqli_insert_id($con);

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

    //prepare statement
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared -insert');
    }



    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

    //prepare statement
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $room_id, $f);
            mysqli_stmt_execute($stmt);
        }
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared -insert');
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}



if (isset($_POST['get_all_rooms'])) {
    $res = select("SELECT * FROM `rooms` WHERE `removed`=?", [0], 'i');
    $i = 1;
    $data = "";



    while ($row = mysqli_fetch_assoc($res)) {
        $booked = select("SELECT * FROM `transactions` WHERE `room_id`=?", [$row['id']], 'i');
        $fetch = mysqli_fetch_assoc($booked);
        if ($fetch != null) {
            $booking_status = $fetch['booking_status'];
            if (($row['status'] == 1) && ($fetch['booking_status'] != 1)) {

                $status = "<button onclick='toggleStatus($row[id],0)' class='btn  btn-sm btn-success shadow-none pop' >active</button>";
            } else {
                $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-sm btn-warning shadow-none pop' >inactive</button>";
            }
        } else {
            if ($row['status'] == 1) {

                $status = "<button onclick='toggleStatus($row[id],0)' class='btn  btn-sm btn-success shadow-none pop' >active</button>";
            } else {
                $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-sm btn-warning shadow-none pop' >inactive</button>";
            }
        }

        $data = "
        <tr class='align-middle'>
            <td >$i</td>
            <td >$row[id]</td>
            <td >$row[name]</td>
            <td >$row[type]</td>
            <td >$row[location]</td>
            <td>
            <span class='badge rounded-pill bg-light text-dark mb-1'>
            Adult: $row[adult]
            </span><br>
            <span class='badge rounded-pill bg-light text-dark'>
            Children: $row[children]
            </span>
            </td>
            <td>Rs.$row[price]</td>
            <td> $status </td>
            <td> 
            <button type='button' onclick='edit_details($row[id])' class='btn btn-md shadow-none pop' data-bs-toggle='modal' data-bs-target='#edit-room'>
              <i class='bi bi-pencil-square'></i>Edit
            </button>
            <button type='button' onclick=\"room_images($row[id],'$row[name]')\" class='btn btn-info shadow-none pop' data-bs-toggle='modal' data-bs-target='#room-images'>
              <i class='bi bi-images'></i> Images
            </button>
            <button type='button' onclick='remove_room($row[id])' class='btn my-3 btn-danger shadow-none pop'> 
                 <i class='bi bi-trash'></i>Delete
            </button>
             </td>
         </tr>
         ";
        $i++;
        echo $data;
    }
}

if (isset($_POST['get_room'])) {
    $frm_data = $_POST;
    $res1 = select("SELECT * FROM `rooms` WHERE `id`=?", [$frm_data['get_room']], 'i');
    $res2 = select("SELECT * FROM `room_features` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
    $res3 = select("SELECT * FROM `room_facilities` WHERE `room_id`=?", [$frm_data['get_room']], 'i');
    //error
    $roomdata = mysqli_fetch_assoc($res1);
    $features = [];
    $facilities = [];

    if (mysqli_num_rows($res2) > 0) {
        while ($row = mysqli_fetch_assoc($res2)) {
            array_push($features, $row['features_id']);
        }
    }
    if (mysqli_num_rows($res3) > 0) {
        while ($row = mysqli_fetch_assoc($res3)) {
            array_push($facilities, $row['facilities_id']);
        }
    }

    $data = ["roomdata" => $roomdata, "features" => $features, "facilities" => $facilities];
    $data = json_encode($data);
    echo $data;
}



if (isset($_POST['edit_room'])) {
    $features = filteration(json_decode($_POST['features']));
    $facilities = filteration(json_decode($_POST['facilities']));

    $frm_data = $_POST;
    $flag = 0;

    $q1 = "UPDATE `rooms` SET `name`=?,`type`=?,`location`=?,`gmap`=?,`price`=?,`adult`=?,`children`=?,`description`=? WHERE `id`=?";

    $values = [$frm_data['name'], $frm_data['type'], $frm_data['location'], $frm_data['gmap'], $frm_data['price'], $frm_data['adult'], $frm_data['children'], $frm_data['desc'], $frm_data['room_id']];

    if (update($q1, $values, 'ssssiiisi')) {
        $flag = 1;
    }

    $del_features = deleteData("DELETE FROM `room_features` WHERE `room_id`=?", [$frm_data['room_id']], 'i');
    $del_facilities = deleteData("DELETE FROM `room_facilities` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    if (!($del_facilities && $del_features)) {
        $flag = 0;
    }

    $q2 = "INSERT INTO `room_facilities`(`room_id`, `facilities_id`) VALUES (?,?)";

    //prepare statement
    if ($stmt = mysqli_prepare($con, $q2)) {
        foreach ($facilities as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared -insert');
    }


    $q3 = "INSERT INTO `room_features`(`room_id`, `features_id`) VALUES (?,?)";

    //prepare statement
    if ($stmt = mysqli_prepare($con, $q3)) {
        foreach ($features as $f) {
            mysqli_stmt_bind_param($stmt, 'ii', $frm_data['room_id'], $f);
            mysqli_stmt_execute($stmt);
        }
        $flag = 1;
        mysqli_stmt_close($stmt);
    } else {
        $flag = 0;
        die('query cannot be prepared -insert');
    }

    if ($flag) {
        echo 1;
    } else {
        echo 0;
    }
}



if (isset($_POST['toggleStatus'])) {

    $frm_data = filteration($_POST);
    $booked = select("SELECT * FROM `transactions` WHERE `room_id`=?", [$frm_data['toggleStatus']], 'i');
    if ($fetch = mysqli_fetch_assoc($booked)) {
        if (($fetch['booking_status'] != 1)) {
            $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
            $values = [$frm_data['value'], $frm_data['toggleStatus']];
            if (update($q, $values, 'ii')) {
                echo 1;
            }
        }
    } else {
        $q = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
        $values = [$frm_data['value'], $frm_data['toggleStatus']];
        if (update($q, $values, 'ii')) {
            echo 1;
        }
    }
}

if (isset($_POST['add_image'])) {

    $frm_data = filteration($_POST);
    $img_r = uploadImage($_FILES['image'], ROOMS_FOLDER);

    if ($img_r == 'inv_img') {
        echo $img_r;
    } else if ($img_r == 'inv_size') {
        echo $img_r;
    } else if ($img_r == 'upd_failed') {
        echo $img_r;
    } else {
        $q = "INSERT INTO `room_images`(`room_id`,`image`) VALUES (?,?)";
        $values = [$frm_data['room_id'], $img_r];
        $res = insert($q, $values, 'is');
        echo $res;
    }
}

if (isset($_POST['get_room_images'])) {

    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['get_room_images']], 'i');
    $path = ROOMS_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['thumb'] == 1) {
            $thumb_btn = "
            <i class='bi bi-check2-square text-light bg-success px-2 py-1 rounded fs-5'></i>
            ";
        } else {
            $thumb_btn = "
            <button type='button' onclick='thumb_image($row[sr_no],$row[room_id])' class='btn btn-warning btn-sm shadow-none pop'>
            <i class='bi bi-check2-square text-light bg-warning px-2 py-1 rounded fs-5'></i>
                </button>
            ";
        }
        echo <<<data
        <tr class="align-middle">
            <td><img src="$path$row[image]" class="img-fluid"></td>
            <td>$thumb_btn</td>
            <td>
                <button type="button" onclick="rem_image($row[sr_no],$row[room_id])" class="btn btn-danger btn-sm shadow-none pop">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </td>
         </tr>
        data;
    }
}

if (isset($_POST['thumb_image'])) {

    $frm_data = filteration($_POST);
    $pre_q = "UPDATE `room_images` SET `thumb`=? WHERE `room_id`=?";
    $pre_v = [0, $frm_data['room_id']];
    $pre_res = update($pre_q, $pre_v, 'ii');


    $q = "UPDATE `room_images` SET `thumb`=? WHERE `sr_no`=? AND `room_id`=?";
    $v = [1, $frm_data['image_id'], $frm_data['room_id']];
    $res = update($q, $v, 'iii');
    echo $res;
}

if (isset($_POST['rem_image'])) {

    $frm_data = filteration($_POST);
    $values = [$frm_data['image_id'], $frm_data['room_id']];

    $pre_q = "SELECT * FROM `room_images` WHERE `sr_no`=? AND `room_id`=? ";
    $res = select($pre_q, $values, 'ii');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], ROOMS_FOLDER)) {
        $q = "DELETE FROM `room_images` WHERE `sr_no`=? AND `room_id`=?";
        $res = deleteData($q, $values, 'ii');
        echo $res;
    } else {
        echo 0;
    }
}

if (isset($_POST['remove_room'])) {

    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `room_images` WHERE `room_id`=?", [$frm_data['room_id']], 'i');

    while ($row = mysqli_fetch_assoc($res1)) {
        deleteImage($row['image'], ROOMS_FOLDER);
    }

    $p = "DELETE FROM `room_images` WHERE `room_id`=?";
    $q = "DELETE FROM `room_features` WHERE `room_id`=?";
    $r = "DELETE FROM `room_facilities` WHERE `room_id`=?";
    $t = "UPDATE `rooms` SET `removed`=? WHERE `id`=?";

    $res2 = deleteData($p, [$frm_data['room_id']], 'i');
    $res3 = deleteData($q, [$frm_data['room_id']], 'i');
    $res4 = deleteData($r, [$frm_data['room_id']], 'i');
    $res5 = update($t, [1, $frm_data['room_id']], 'ii');

    if ($res2 || $res3 || $res4 || $res5) {
        echo 1;
    } else {
        echo 0;
    }
}
