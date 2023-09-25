<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookIn</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
  <link rel="stylesheet" href="style.css">
  <style>
    .pop:hover {
      transform: scale(1.03);
      transition: all;
    }
  </style>
</head>

<body class="bg-light">

  <!-- navbar -->
  <?php require('inc/header.php'); ?>
  <!-- carosel -->
  <div class="container-fluid_swiper mt-4 px-lg-4">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">

        <?php
        $res = selectAll('carousel');
        while ($row = mysqli_fetch_assoc($res)) {
          $path = CAROUSEL_IMG_PATH;
          echo <<<data
            
            <div class="swiper-slide">
            <img src="$path$row[image]" class="w-100 d-block"/>
          </div>
          data;
        }
        ?>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

  <!-- our rooms -->
  <h2 class="mt-5 pt-4 mb-4 text-center h-font">OUR HOTELS</h2>
  <div class="container">
    <div class="row">
      <?php
      $room_res = selectAll('rooms');
      //
      // $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');
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
        }
        $login=0;
        if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
          $login = 1;
        }
        $book_btn = " 
        <button onclick='checkLoginToBook($login,$row[id])' id='bookBtn' class='btn btn-sm bg-dark text-white shadow-none pop'>Book Now</button>
        ";

        //print room card
        echo <<<data
        <div class="col-lg-4 col-md-6 my-3">

        <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
          <img src="$room_thumb" class="card-img-top">
          <div class="card-body d-flex flex-column" style="height:350px">
            <h5>$row[name]</h5>
            <h6 class="mb-4">$row[price] per Night</h6>
            <div class="mb-3">
              <h6 class="mb-1">Room Type</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                $row[type]
              </span>
            </div>
            <div class="features mb-3">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                $features_data
              </span>
            </div>
            <div class="facilities mb-3 flex-grow-1">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                $facilities_data
              </span>
            </div>

            <div class="d-flex justify-content-evenly mb-2">
              $book_btn
              <a href="room_details.php?id=$row[id]" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>

      data;
      }
      ?>
    </div>
  </div>

  <!-- Facilities -->
  <h2 class="mt-5 pt-4 mb-4 text-center h-font">OUR Facilities</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <?php
      $res = selectAll('facilities');
      $path = ICONS_IMG_PATH;

      while ($row = mysqli_fetch_assoc($res)) {
        echo <<<data
            <div class="col-lg-4 col-md-6 mb-4 px-4">
            <div class="bg-white rounded shadow p-4 border-top border-4 pop">
              <div class="d-flex align-items-center mb-2"> <img src="$path$row[icon]" width="40px">
                <h5 class="m-0 ms-3">$row[name]</h5>
              </div>
              </div>
              </div>
          data;
      }

      ?>
    </div>
  </div>
  <?php require('inc/footer.php'); ?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      loop: true,
      autoplay: {
        delay: 3500,
        disableOnInteraction: false,
      }
    });
  </script>

  <style>
    .pop {
      border-top-color: gainsboro !important;
    }

    .pop:hover {
      border-top-color: black !important;
      transform: scale(1.03);
      transition: all;
    }
  </style>
</body>

</html>