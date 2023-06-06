<?php
require('../admin/inc/essential.php');
require('../admin/inc/db_config.php');

date_default_timezone_set("Asia/Kathmandu");


if (isset($_POST['check_availability'])) {
    $data = filteration($_POST);
    $status = "";
    $result = "";

    //checkin and out validations
    $today_data = new DateTime(date("Y-m-d"));
    $checkin_date = new DateTime($data['checkin']);
    $checkout_date = new DateTime($data['checkout']);

    if ($checkin_date == $checkout_date) {
        $status = 'same_date';
        $result = json_encode(["status" => $status]);
    } else if ($checkin_date > $checkout_date) {
        $status = 'inv_cd';
        $result = json_encode(["status" => $status]);
    } else if ($checkin_date < $today_data) {
        $status = 'inv_ci';
        $result = json_encode(["status" => $status]);
    }

    // check booking availability if status is blank else return the error
    if ($status != '') {
        echo $result;
    } else {
        session_start();
        $_SESSION['room'];

        //check the room is available or not 

        $count_days = date_diff($checkin_date, $checkout_date)->days;
        $payment = $_SESSION['room']['price'] * $count_days;
        $_SESSION['room']['payment'] = $payment;
        $_SESSION['room']['available'] = true;
        
        $result=json_encode(["status"=>"available","days"=>$count_days,"payment"=>$payment]);
        echo $result;

    }

}
?>