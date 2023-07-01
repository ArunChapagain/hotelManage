<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YOYO-facilities</title>
  <?php require('inc/links.php'); ?>

  <link rel="stylesheet" href="style.css">
</head>

</html>

<body class="bg-light">

  <!-- navbar -->
  <?php require('inc/header.php'); ?>

  <div class="my-5" px-4>
    <h2 class="fw-bold h-font text-center">Our Rooms</h2>
  </div>

  <div>
    <?php
    $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
    $flex = 1;
    while ($row = mysqli_fetch_assoc($room_res)) {
      // get features of room
      $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
          INNER JOIN `room_features` rfea ON f.id=rfea.features_id
          WHERE  rfea.room_id='$row[id]'");

      $features_data = "";

    ?>
      <!-- <div class="d-flex flex-column  "> -->
      <?php
      while ($fea_row = mysqli_fetch_assoc($fea_q)) {
        $features_data .= "
           <span class='badge rounded-pill bg-light text-dark text-wrap'>
          $fea_row[name]</span>";
      }
      ?>
      <!-- </div> -->
    <?php
      // get facilities of room
      $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
          INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id
          WHERE  rfac.room_id='$row[id]'");

      $facilities_data = "";
      while ($fac_row = mysqli_fetch_assoc($fac_q)) {
        $facilities_data .= "
          <span class='badge rounded-pill bg-light text-dark text-wrap'>
          $fac_row[name]</span> ";
      }

      //get thumbnail of images
      $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
      $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
            WHERE `room_id`='$row[id]' AND `thumb`='1'");

      if (mysqli_num_rows($thumb_q) > 0) {

        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
        $login = 0;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          $login = 1;
        }
        $book_btn = " 
            <button onclick='checkLoginToBook($login,$row[id])' id='bookBtn' class='btn  btn-md mb-md-2 bg-dark text-white shadow-none pop'>Book Now</button>
            ";
      }

      if (($flex % 2) != 0) {
        echo <<<ctn1
          <div class="d-flex justify-content-start pt-0">
            <div class="col-lg-10 col-md-12 px-4 ">
          ctn1;
      } else {
        echo <<<ctn1
          <div class="d-flex justify-content-end pt-0">
            <div class="col-lg-10 col-md-12 px-4 ">
          ctn1;
      }
      //print room card//heroduck method
      echo <<<data
          <div class="card mb-4 border-0 shadow">
            <div class="row g-0 p-3 align-item-center">
              <div class="col-lg-7 mb-md-0 mb-3">
                <img src="$room_thumb" class="img-fluid rounded">
              </div>
              <div class="col-lg-2 px-md-3 ms-lg-4 px-0">
                <h5 class="my-3 ">$row[name]</h5>
                <div class="mb-3">
                  <h6 class="mb-1">Room Type</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $row[type]
                  </span>
                </div>
                <div class="mb-3">
                  <h6 class="mb-1">Hotel Location</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $row[location]
                  </span>
                </div>
                <!-- features -->
                <div class="features mb-3">
                  <h6 class="mb-1">Features</h6>
                  $features_data
                </div>
                <!-- facilities -->
                <div class="facilities mb-3">
                  <h6 class="mb-1">Facilities</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap fs-6">
                    $facilities_data
                  </span>
                </div>
              </div>
              <div class="col-lg-2 mt-md-0 px-md-3 mt-4 ">
              <div class="guests mt-3 pt-lg-1 mb-3">
                <h6 class="mb-1 mt-lg-5">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap mb-1">
                  $row[adult] Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  $row[children] children
                </span>
            </div>
                <div class="text-center">
                <h6 class="mb-3 fs-5 mt-lg-5">NRs $row[price] per Night</h6>
                <a href="room_details.php?id=$row[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
                
              </div>
              </div>
              </div>
            </div>
          </div>
          data;

      echo <<<ctn1
                  </div>
                </div>
          ctn1;
      $flex += 1;
    }
    ?>

  </div>

  <!-- footer -->
  <?php require('inc/footer.php'); ?>
</body>

</html>