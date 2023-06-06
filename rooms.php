<html lang="en">
<!-- //mg-lg-1  margin for the large device -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YOYO-facilities</title>
<?php require('inc/links.php');?>
 
  <link rel="stylesheet" href="style.css">
 </head>
</html>
 
<body class="bg-light">

<!-- navbar -->
<?php require('inc/header.php');?>
  
<div class="my-5" px-4>
  <h2 class="fw-bold h-font text-center">Our Rooms</h2>
</div>


<div class="container pt-0">
  <div class="row">
    <!-- filter -->
    <div class="col-lg-3 mb-3 mb-md-0 mb-ld-0">
      <nav class="navbar navbar-expand-lg navbar-light bg-white rounded shadow ">
        <div class="container-fluid flex-lg-column align-item-stretch">
          <h4 class="mt-2">Filters</h4>
          <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
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
      <!-- card -->
      <div class="card mb-4 border-0 shadow">
        <div class="row g-0 p-3 align-item-center">
          <div class="col-md-5 mb-md-0 mb-3">
            <img src="images/rooms/1.jpg" class="img-fluid rounded">
          </div>
          <div class="col-md-4 px-md-3 px-lg-3 ms-ld-3">
            <h5 class="my-3 ">Simple Room Name</h5>
            <!-- features -->
            <div class="features mb-3">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Bathroom
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Balcony
               </span>
            </div>
            <!-- facilities -->
            <div class="facilities mb-3">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Wifi
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Televison
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                AC
               </span>
            </div>
          </div>
          <div class="col-md-2 ms-ld-2 text-center">
            <h6 class="mb-4 mt-5">NRs 200 per Night</h6>
            <a href="#" class="btn btn-md mb-md-2 bg-dark text-white shadow-none pop">Book Now</a>
            <a href="#" class="btn btn-md btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>

      <!-- card -->
      <div class="card my-4 border-0 shadow">
        <div class="row g-0 p-3 align-item-center">
          <div class="col-md-5 mb-md-0 mb-3">
            <img src="images/rooms/1.jpg" class="img-fluid rounded">
          </div>
          <div class="col-md-4 px-md-3 px-lg-3 ms-ld-3">
            <h5 class="my-3 ">Simple Room Name</h5>
            <!-- features -->
            <div class="features mb-3">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Bathroom
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Balcony
               </span>
            </div>
            <!-- facilities -->
            <div class="facilities mb-3">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Wifi
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Televison
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                AC
               </span>
            </div>
          </div>
          <div class="col-md-2 ms-ld-2 text-center">
            <h6 class="mb-4 mt-5">NRs 200 per Night</h6>
            <a href="#" class="btn btn-md mb-md-2 bg-dark text-white shadow-none pop">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
      <!-- card -->
      <div class="card my-4 border-0 shadow">
        <div class="row g-0 p-3 align-item-center">
          <div class="col-md-5 mb-md-0 mb-3">
            <img src="images/rooms/1.jpg" class="img-fluid rounded">
          </div>
          <div class="col-md-4 px-md-3 px-lg-3 ms-ld-3">
            <h5 class="my-3 ">Simple Room Name</h5>
            <!-- features -->
            <div class="features mb-3">
              <h6 class="mb-1">Features</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                2 Rooms
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Bathroom
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                1 Balcony
               </span>
            </div>
            <!-- facilities -->
            <div class="facilities mb-3">
              <h6 class="mb-1">Facilities</h6>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Wifi
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                Televison
               </span>
              <span class="badge rounded-pill bg-light text-dark text-wrap">
                AC
               </span>
            </div>
          </div>
          <div class="col-md-2 ms-ld-2 text-center">
            <h6 class="mb-4 mt-5">NRs 200 per Night</h6>
            <a href="#" class="btn btn-md mb-md-2 bg-dark text-white shadow-none pop">Book Now</a>
            <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>

<!-- footer -->
<?php require('inc/footer.php');?>
</body>

</html>