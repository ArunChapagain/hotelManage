<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YOYO-Room_details</title>
  <?php require('inc/links.php'); ?>

  <link rel="stylesheet" href="style.css">
</head>

</html>

<body class="bg-light">

  <?php require('inc/header.php'); ?>


  <?php
  if (!isset($_GET['id'])) {
    redirect('rooms.php');
  }
  $data = filteration($_GET);
  $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');

  }
  $room_data = mysqli_fetch_assoc($room_res);


  ?>




  <div class="container">
    <div class="row d-flex align-items-center">
      <div class="my-5">
        <h2 class="fw-bold h-font text-center">
          <?php echo $room_data['name'] ?>
        </h2>
      </div>
      <!-- carousel -->
      <div class="col-lg-7 col-md-12 px-2 mb-4 ">
        <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-indicators">
            <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="0" class="active" aria-current="true"
              aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
          </div>
          <div class="carousel-inner">
            <?php
            //get rooms images
            $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
            $img_q = mysqli_query($con, "SELECT * FROM `room_images` 
        WHERE `room_id`='$room_data[id]'");
            if (mysqli_num_rows($img_q) > 0) {
              $active_class = 'active';
              while ($img_res = mysqli_fetch_assoc($img_q)) {
                echo "
                <div class='carousel-item $active_class'>
                 <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100 rounded'>
              </div>
              ";
                $active_class = '';
              }
            } else {
              echo "<div class='carousel-item active'>
                        <img src='$room_img' class='d-block w-100 rounded' >
                    </div>";
            }

            ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
      </div>


      <div class="col-lg-5 col-md-12 mb-4 px-2">
        <div class="card text-middle border-0 shadow-sm rounded-3">
          <div class="card-body">
            <?php
            echo <<<price
            <h3 class="mb-3">
            <span class='badge rounded-pill bg-light text-dark text-wrap mt-lg-2'>
            NRs $room_data[price] per Night
            </span> 
            </h3>
            price;
            ?>
            <div class="row d-flex align-items-center">

              <div class="col-lg-6">
                <?php
                echo <<<type
                <h6 class="mb-1">Room Type</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap mb-1">
                $room_data[type]
                  </span>
                type;
                ?>

              </div>
              <div class="col-lg-6">
                <?php
                echo <<<location
                        <h6 class="mb-1 mt-3">Hotel Location</h6>
                        <span class="badge rounded-pill bg-light text-dark text-wrap mb-1">
                        $room_data[location]
                          </span>
                    location;
                ?>
              </div>
            </div>
            <?php



            //  get features of room
            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f 
            INNER JOIN `room_features` rfea ON f.id=rfea.features_id
            WHERE  rfea.room_id='$room_data[id]'");

            $features_data = "";
            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
              $features_data .= "
            <span class='badge rounded-pill bg-light text-dark text-wrap'>
            $fea_row[name]</span> ";
            }

            echo <<<features
              <div class="features my-3">
                <h6 class="mb-1">Features</h6>$features_data
              </div>
            features;



            // get facilities of room
            $fac_q = mysqli_query($con, "SELECT f.name FROM `facilities` f 
            INNER JOIN `room_facilities` rfac ON f.id=rfac.facilities_id
            WHERE  rfac.room_id='$room_data[id]'");

            $facilities_data = "";
            while ($fac_row = mysqli_fetch_assoc($fac_q)) {
              $facilities_data .= "
            <span class='badge rounded-pill bg-light text-dark text-wrap'>
            $fac_row[name]</span> ";
            }

            echo <<<facilities
              <div class="facilities my-3">
                <h6 class="mb-1">Facilities</h6>$facilities_data
              </div>
            facilities;

            echo <<<guests
            <div class="guests mb-3">
                <h6 class="mb-1">Guests</h6>
                <span class="badge rounded-pill bg-light text-dark text-wrap mb-1">
                  $room_data[adult] Adults
                </span>
                <span class="badge rounded-pill bg-light text-dark text-wrap">
                  $room_data[children] children
                </span>
              </div>
            guests;


            $login = 0;
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
              $login = 1;
            }
            $book_btn = " 
            <button onclick='checkLoginToBook($login,$room_data[id])' id='bookBtn' class='btn w-100 bg-dark text-white shadow-none pop'>Book Now</button>
            ";

            echo <<<book
               $book_btn
            book;

            ?>

          </div>
        </div>
      </div>
    </div>

    <div class="row d-flex align-items-center">
      <div class="col-lg-5 mb-3 px-2">
        <div class="card rounded shadow-sm border-0" style="height:400px">
          <div class="card-body">
            <h5 class="card-title">Description</h5>
            <h6 class="card-subtitle mb-2 text-muted">
              <?php
              echo $room_data['name'];
              ?>
            </h6>
            <p class="card-text ">
              <?php
              echo $room_data['description'];
              ?>
            </p>
          </div>
        </div>
      </div>
      <div class="col-lg-7 px-2">

        <?php
        echo $room_data['gmap'];
        ?>

      </div>
    </div>

  </div>

  <!-- footer -->
  <?php require('inc/footer.php'); ?>
</body>

</html>