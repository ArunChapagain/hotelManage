<?php
require('../inc/essential.php');
require('../inc/db_config.php');


$room_id;
if (isset($_POST['get_booking'])) {
    $res = selectAll('transactions');
    $i = 1;
    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {
        if ($row['removed'] == 0) {
            if ($row['booking_status'] == 1) {
                $status = "<button onclick='toggleStatus($row[id],0,$row[room_id])' class='btn  btn-sm btn-success shadow-none pop' >Booked</button>";
            } else {
                $status = "<button onclick='toggleStatus($row[id],1,$row[room_id])' class='btn btn-sm btn-warning shadow-none pop' >Confirm</button>";
            }
            if ($row['removed'] != 1) {
                $data = "
        <tr class='align-middle'>
            <td >$i</td>
            <td >$row[cus_id]</td>
            <td >$row[room_id]</td>
            <td >$row[cus_card_name]</td>
            <td>$row[cus_card_email]</td>
            <td>$row[hotel_name]</td>
            <td>$row[room_type]</td>
            <td>Rs. $row[paid_amount]</td>
            <td> $status </td>
            <td>$row[checkin]</td>
            <td>$row[checkout]</td>
            <td>$row[created]</td>
            <td>$row[txn_id]</td>
            <td><button type='button' onclick='remove_booking($row[id],$row[booking_status])' class='btn my-3 btn-danger shadow-none pop'> 
            <i class='bi bi-trash'></i>Delete
       </button></td>
         </tr>
         ";
                $i++;
                echo $data;
            }
        }
    }
}


if (isset($_POST['toggle_status'])) {

    $data = filteration($_POST);
    $q1 = "UPDATE `transactions` SET `booking_status`=? WHERE `id`=?";
    $values = [$data['value'], $data['id']];
    update($q1, $values, 'ii');
    if ($data['value'] == 1) {
        $q2 = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
        $values = [0, $data['room_id']];
        update($q2, $values, 'ii');
        echo 1;
    } else {
        $q2 = "UPDATE `rooms` SET `status`=? WHERE `id`=?";
        $values = [1, $data['room_id']];
        update($q2, $values, 'ii');
        echo 1;
    }
}

if (isset($_POST['remove_booking'])) {
    $data = filteration($_POST);
    if ($data['status'] == 0) {
        $q = "UPDATE `transactions` SET `removed`=? WHERE `id`=?";
        $values = [1, $data['id']];
        update($q, $values, 'ii');
        echo 1;
    } else {
        echo 0;
    }
}
