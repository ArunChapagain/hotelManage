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


  <div class="container-fluid pt-0">
    <div class="row">

      <!-- filter -->
      <div class="col-lg-3 mb-3  mb-ld-0 ps-4">
        <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow ">
          <div class="container-fluid flex-lg-column align-item-stretch">
            <h4 class="mt-2">Filters</h4>
            <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse"
              data-bs-target="#filterDropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false"
              aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse flex-column align-items-stretch" id="filterDropdown">
              <div class="border bg-light rounded mb-3">
                <h5 class="my-3 mx-3" style="font-size: 18px;">CHECK AVAILABILITY</h5>
                <label class="form-label mb-auto ms-2">Check-in</label>
                <input type="date" class="form-control shadow-none mb-2">
                <label class="form-label mt-2 mb-auto ms-2">Check-out</label>
                <input type="date" class="form-control shadow-none">
              </div>

              <div class="border bg-light rounded mb-3">
                <h5 class="my-3 mx-3" style="font-size: 18px;">Facilities</h5>
                <div class="mb-2">
                  <input type="checkbox" id="f1" class="form-check-input shadow-none ms-2 me-1">
                  <label class="form-check-label mb-auto " for="f1">Facility one</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f2" class="form-check-input shadow-none ms-2 me-1">
                  <label class="form-check-label mb-auto " for="f2">Facility two</label>
                </div>
                <div class="mb-2">
                  <input type="checkbox" id="f3" class="form-check-input shadow-none ms-2 me-1">
                  <label class="form-check-label mb-auto" for="f3">Facility three</label>
                </div>
              </div>

              <div class="border bg-light rounded mb-3">
                <h5 class="my-3 mx-3" style="font-size: 18px;">Guest</h5>
                <div class="d-flex justify-content-between">
                  <div>
                    <label class="form-label mb-auto">Adults</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                  <div>
                    <label class="form-label mb-auto ">Children</label>
                    <input type="number" class="form-control shadow-none">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>

      <!-- rooms -->
      <div class="col-lg-9 col-md-12 px-4 ">

        <?php

        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

        while ($row = mysqli_fetch_assoc($room_res)) {
          // get features of room
          $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
          INNER JOIN `room_features` rfea ON f.id=rfea.features_id
          WHERE  rfea.room_id='$row[id]'");

          $features_data = "";
          while ($fea_row = mysqli_fetch_assoc($fea_q)) {
            $features_data .= "
          <span class='badge rounded-pill bg-light text-dark text-wrap'>
          $fea_row[name]</span> ";
          }


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
            $login=0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
              $login = 1;
            }
            $book_btn = " 
            <button onclick='checkLoginToBook($login,$row[id])' id='bookBtn' class='btn  btn-md mb-md-2 bg-dark text-white shadow-none pop'>Book Now</button>
            ";
          }
          //print room card//heroduck method
          echo <<<data
          <div class="card mb-4 border-0 shadow">
            <div class="row g-0 p-3 align-item-center">
              <div class="col-md-5 mb-md-0 mb-3">
                <img src="$room_thumb" class="img-fluid rounded">
              </div>
              <div class="col-md-5 px-md-3 px-lg-3 px-0">
                <h5 class="my-3 ">$row[name]</h5>
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
                <div class="guests mb-3">
                  <h6 class="mb-1">Guests</h6>
                  <span class="badge rounded-pill bg-light text-dark text-wrap mb-1">
                    $row[adult] Adults
                  </span>
                  <span class="badge rounded-pill bg-light text-dark text-wrap">
                    $row[children] children
                  </span>
                </div>
              </div>
              <div class="col-md-2 mt-md-0 mt-4 text-center">
                <h6 class="mb-3 fs-5 mt-lg-5">NRs $row[price] per Night</h6>
                $book_btn
                <a href="room_details.php?id=$row[id]" class="btn btn-md btn-outline-dark shadow-none">More details</a>
              </div>
            </div>
          </div>

          data;
        }
        ?>

      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require('inc/footer.php'); ?>
</body>

</html>