<?php
require('inc/db_config.php');
require('inc/essential.php');
session_start();
if (isset($_SESSION['adminLogin']) && $_SESSION['adminLogin'] == true) {
    redirect('dashboard.php');
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Login Panal</title>
  <?php require('inc/links.php'); ?>
  <style>
    .login-form {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 350px;
    }
  </style>
</head>

<body class="bg-light">
  <div class="login-form text-center rounded bg-white shadow overflow-none">
    <form method="POST">
      <h4 class="pt-3">ADMIN LOGIN PANEL</h4>
      <div class="p-3">
        <div class="mb-3">
          <input name="admin_name" required type="text" class="form-control shadow-none text-center"
            placeholder="Admin Name" />
        </div>
        <div class="mb-3">
          <input name="admin_pass" required type="password" class="form-control shadow-none text-center"
            placeholder="Password" />
        </div>
        <button name="login" type="submit" class="btn btn-md bg-dark text-white shadow-none pop">
          Login
        </button>
      </div>
    </form>
  </div>


  <?php

  if (isset($_POST['login'])) {
    $frm_data = filteration($_POST);
    $query = "SELECT * FROM `admin_cred` WHERE `admin_name`=? AND `admin_pass`=?";
    $values = [$frm_data['admin_name'], $frm_data['admin_pass']];

    $res = select($query, $values, "ss");
    if ($res->num_rows == 1) {
      $row = mysqli_fetch_assoc($res);
      session_start();
      $_SESSION['adminLogin']=true;
      $_SESSION['adminId']=$row['sr_no'];
      redirect('rooms.php');
    } else {
      alert('error','Invalid Admin name or password.');
    }

  }
  ?>

</body>

</html>