<?php
require('../inc/essential.php');
require('../inc/db_config.php');
adminLogin();


if (isset($_POST['get_users'])) {
    $res = selectAll('user_cred');
    $i = 1;
    $path = USERS_IMG_PATH;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {

        $date = date("d-m-y", strtotime($row['datentime']));
        if ($row['status'] == 1) {
            $status = "<button onclick='toggleStatus($row[id],0)' class='btn  btn-sm btn-success shadow-none pop' >active</button>";
        } else {
            $status = "<button onclick='toggleStatus($row[id],1)' class='btn btn-sm btn-warning shadow-none pop' >inactive</button>";
        }

        $data = "
        <tr class='align-middle'>
            <td >$i</td>
            <td >$row[id]</td>
            <td >$row[name]</td>
            <td>$row[address]</td>
            <td>$row[email]</td>
            <td>$row[phonenum]</td>
            <td>$row[dob]</td>
            <td> $status </td>
            <td>$date</td>
            <td> 
            <button type='button' onclick=\"user_images($row[id])\" class='btn btn-sm btn-info shadow-none pop' data-bs-toggle='modal' data-bs-target='#user-images'>
              <i class='bi bi-images'></i> Images
            </button>
            </td>
         </tr>
         ";
        $i++;
        echo $data;
    }
}

if (isset($_POST['get_user_images'])) {

    $frm_data = filteration($_POST);
    $res = select("SELECT * FROM `user_cred` WHERE `id`=?", [$frm_data['get_user_images']], 'i');
    $path = USERS_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<data
        <div class="bg-light">
        <div class="card border-0 shadow-sm mb-4 ">
            <div class="card-body">
                <div class="">
                    <h5 class="card-title m-0 mb-2">$row[name]</h5>
                    <img src="$path$row[profile]" class="img-fluid rounded">
                    
                </div>
            </div>
        </div>
        <div class="card border-0 shadow  mb-2">
            <div class="card-body">
                <div class="">
                    <h5 class="card-title m-0 mb-2">Document</h5>
                    <img src="$path$row[document]" class="img-fluid rounded">
                    
                </div class="mt-2">
            </div>
        </div>
        </div>

        data;
    }
}

if (isset($_POST['toggle_status'])) {

    $data = filteration($_POST);
    $q = "UPDATE `user_cred` SET `status`=? WHERE `id`=?";
    $values = [$data['value'], $data['toggle_status']];
    if (update($q, $values, 'ii')) {
        echo 1;
    } else {
        echo 0;
    }
}


?>