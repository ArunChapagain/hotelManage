<?php
require('inc/db_config.php');
require('inc/essential.php');
adminLogin();
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Booking Details</title>
  <?php require('inc/links.php'); ?>
</head>

<body>
  <?php require('inc/header.php'); ?>


  <!-- Add Room modal -->
 

  <div class="container-fluid" id="main-content">
    <h3 class="mt-4 mb-3">Booking Details</h3>
    <!--  section -->
    <div class="card border-0 shadow-sm mb-4">
      <div class="card text-center">
        <div class="card-body">
          <!-- Table  -->
          <div class="table-responsive-md mt-4" style="height: 750px; overflow-y: scroll">
            <table class="table table-hover border text-center">
              <thead>
                <tr class="bg-dark text-light">
                  <th scope="col">S.no</th>
                  <th scope="col">User Id</th>
                  <th scope="col">Room Id</th>
                  <th scope="col">cName</th>
                  <th scope="col">cEmail</th>
                  <th scope="col">Hotel Name</th>
                  <th scope="col">Room Type</th>
                  <th scope="col">Paid Amount</th>
                  <th scope="col">Action</th>
                  <th scope="col">Check-in</th>
                  <th scope="col">Check-out</th>
                  <th scope="col">Booked Date</th>
                  <th scope="col">Transaction Id</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody id="booking-data"></tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

 

  <script src="./scripts/booking.js"></script>

</body>

</html>