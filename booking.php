<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>booking</title>
  <?php require('inc/links.php'); ?>

  <link rel="stylesheet" href="style.css">
</head>

</html>

<body class="bg-light">

  <?php require('inc/header.php'); ?>
  <?php

  if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    alert('alert', 'please login');
    echo ' <div class="my-5 px-5 pb-5">
    <h2 class="fw-bold h-font text-center">
      Bookings
    </h2>
    
  </div>';
    echo <<<chrome
    
      <div class=" text-center">
    <span class="badge rounded-pill bg-white text-dark text-wrap mb-1">
    <h2 class="my-5">No Bookings to show</h2>
    </span>
      </div>
    chrome;
  } else {
    echo ' <div class="my-5 px-5 pb-5">
  <h2 class="fw-bold h-font text-center">
    Bookings
  </h2>
</div>';
    $id = $_SESSION['uId'];
    $trans = select("SELECT * FROM `transactions` WHERE `cus_id`=? AND `removed`=0;", [$id], 'i');
    if (mysqli_num_rows($trans) == 0) {
      echo <<<data
      <div class=" text-center">
      <span class="badge rounded-pill bg-white text-dark text-wrap mb-1">
      <h2 class="my-5">No Bookings to show</h2>
      </span>
        </div>
      <div class="container text-center py-5">
        </div>
      data;
    } else {

      while ($tdata = mysqli_fetch_assoc($trans)) {

        $rooms = select("SELECT * FROM `rooms` WHERE `id`=?;", [$tdata['room_id']], 'i');
        if (mysqli_num_rows($rooms) == 0) {
          redirect('rooms.php');
        }
        $rdata = mysqli_fetch_assoc($rooms);
        if ($tdata['removed'] != 1) {
  ?>

          <div class="container ">
            <div class="row">
              <div class="col-md-12 px-4">
                <div class="card my-4 px-5 py-5 text-middle border-0 shadow rounded-3">
                  <div class="card-body">
                <?php
                $date = date("d-m-y", strtotime($tdata['created']));
                if ($tdata['booking_status'] == 1) {
                  $status = "<button class='btn  btn-sm btn-success shadow-none pop'>Booked</button>";
                } else {
                  $status = "<button class='btn btn-sm btn-warning shadow-none pop' >Pending....</button>";
                }
                echo <<<result
              <div class="d-flex justify-content-between">
                <h4>Booking status </h4>
                $status
              </div>
              </div>
              <div>
                Hotel Name : $rdata[name] <br>
                Room ID : $rdata[id] <br>
                Room Type : $rdata[type]  <br>
                Check-in Date: $tdata[checkin] <br>
                Check-out Date: $tdata[checkin]   <br>
                Customer ID : $id <br>
                Paid By : $tdata[cus_card_name] <br>
                Paid Amount : NRs.$tdata[paid_amount] <br>
                Transaction ID : $tdata[txn_id] <br>
                Booked in : $date<br>
              </div>
              </div>
              </div>
              result;
              }
            }
                ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

      <?php }
  }
      ?>

      <!-- footer -->
      <?php require('inc/footer.php');
      ?>
</body>

</html>