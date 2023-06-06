<?php
require('../admin/inc/essential.php');
require('../admin/inc/db_config.php');


if (isset($_POST['register'])) {
    $data = filteration($_POST);

    //password and conform password field
    if ($data['pass'] != $data['cpass']) {
        echo 'pass_mismatch';
        exit;
    }

    //check user exit or not
    $u_exist = select("SELECT * FROM `user_cred` WHERE `email`=? AND `phonenum`=? LIMIT 1", [$data['email'], $data['phonenum']], 'ss');

    if (mysqli_num_rows($u_exist) != 0) {
        $u_exist_fetch = mysqli_fetch_assoc($u_exist);
        if ($u_exist_fetch['email'] == $data['email']) {
            alert("error", "email_already exist");
            exit;
        } else if ($u_exist_fetch['phonenum'] == $data['phonenum']) {
            alert("error", "Number already  exist");
            exit;
        }
    }



    //upload image to server
    $img1 = uploadImage($_FILES['profile'], USERS_FOLDER);
    $img2 = uploadImage($_FILES['document'], USERS_FOLDER);


    if (($img1||$img2)== 'inv_img') {
        echo $img;

    } else if (($img1||$img2) == 'upd_failed') {
        echo $img;
        exit;
    }

    $enc_pass = password_hash($data['pass'], PASSWORD_BCRYPT);
    $query = "INSERT INTO `user_cred`(`name`, `email`, `address`, `phonenum`, `dob`, `profile`,`document`, `password`) VALUES (?,?,?,?,?,?,?,?)";
    $values = [$data['name'], $data['email'], $data['address'], $data['phonenum'], $data['dob'], $img1,$img2,$enc_pass];
    if (insert($query, $values, 'ssssssss')) {
        echo 1;
    } else {
        echo 'ins_failed';
    }

}


if (isset($_POST['login'])) {
    $data = filteration($_POST);
    $u_exist = select(
        "SELECT * FROM `user_cred` WHERE `email`=? OR `phonenum`=? LIMIT 1",
        [$data['email_mob'], $data['email_mob']],
        'ss'
    );

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_usr';
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        if($u_fetch['status']==0)
        {
            echo 'inactive';
        }
       else  {
        if(!password_verify($data['pass'],$u_fetch['password']))
        {
            echo 'inv_pass';
        }
        else{
            session_start();
            $_SESSION['login']=true;
            $_SESSION['uId']=$u_fetch['id'];
            $_SESSION['uName']=$u_fetch['name'];
            $_SESSION['uPic']=$u_fetch['profile'];
            $_SESSION['uphone']=$u_fetch['phonenum'];
            echo 1;
        }
       }
    }
}
?>