<html lang="en">
<!-- //mg-lg-1  margin for the large device -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>YOYO</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Merienda:wght@400;700&family=Poppins:wght@400;500;600&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link
  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css"/>
  <link rel="stylesheet" href="style.css">
  <style>
     .pop:hover{
    transform: scale(1.03);
    transition: all;
  }
</style>
</head>

<body class="bg-light">

<!-- navbar -->
<?php require('inc/header.php');?>
  <!-- carosel -->
  <div class="container-fluid_swiper px-lg-4">
    <!-- Swiper -->
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
      <div class="swiper-slide">
        <img src="./images/carousel/1.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="./images/carousel/2.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="./images/carousel/3.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="./images/carousel/4.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="./images/carousel/5.png" class="w-100 d-block" />
      </div>
      <div class="swiper-slide">
        <img src="./images/carousel/6.png" class="w-100 d-block" />
      </div>
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>

<!-- check availability form -->
  <div class="container">
      <div class=" row">
        <div class="col-lg-12 bg-white shadow p-4 rounded">
          <h5 class="mb-4">Check Booking Availability</h5>
          <form>
            <div class="row d-flex justify-content-around">
              <div class="col-lg-3">
                   <label class="form-label mt-2 mb-auto" style="font-weight: 500;">Check-in</label>
                   <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-3">
                   <label class="form-label mt-2 mb-auto" style="font-weight: 500;">Check-Out</label>
                   <input type="date" class="form-control shadow-none">
              </div>
              <div class="col-lg-2">
                   <label class="form-label mt-2 mb-auto" style="font-weight: 500;">Adult</label>
                   <div class="input-group">
                        <select class="select shadow-none" >
                          <option selected>Choose...</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                </div>  
              </div>    
              <div class="col-lg-2">
                   <label class="form-label mt-2 mb-auto" style="font-weight: 500;">Children</label>
                   <div class="input-group">
                        <select class="select shadow-none" >
                          <option selected>Choose...</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                  </div>
              </div>  
              <div class="col-lg-1">
                <button type="submit" class="btn btn-dark shadow-none mt-3 pop" >Submit</button>
                </button>  
              </div>  
            </div>
          </form>
        </div>
      </div>
  </div>

  <!-- our rooms -->
  <h2 class="mt-5 pt-4 mb-4 text-center h-font">OUR ROOMS</h2>
  <div class="container">
    <div class="row">
      <div class="col-lg-4 col-md-6 my-3">

        <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
          <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 >Simple Room Name</h5>
            <h6 class="mb-4">NRs 200 per Night</h6>
            <div class="features mb-4">
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
            <div class="facilities mb-4">
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

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light"> 
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
              
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm bg-dark text-white shadow-none pop">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-4 col-md-6 my-3">

        <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
          <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 >Simple Room Name</h5>
            <h6 class="mb-4">NRs 200 per Night</h6>
            <div class="features mb-4">
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
            <div class="facilities mb-4">
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

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light"> 
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
              
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm bg-dark text-white shadow-none pop">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-6 my-3">

        <div class="card border-0 shadow" style="max-width: 350px;margin:auto;">
          <img src="images/rooms/1.jpg" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 >Simple Room Name</h5>
            <h6 class="mb-4">NRs 200 per Night</h6>
            <div class="features mb-4">
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
            <div class="facilities mb-4">
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

            <div class="rating mb-4">
              <h6 class="mb-1">Rating</h6>
              <span class="badge rounded-pill bg-light"> 
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
                <i class="bi bi-star-fill text-warning"></i>
              </span>
              
            </div>
            <div class="d-flex justify-content-evenly mb-2">
              <a href="#" class="btn btn-sm bg-dark text-white shadow-none pop">Book Now</a>
              <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More details</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-12 text-center mt-5">
        <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Rooms...</a>
      </div>
    </div>
  </div>


<!-- Facilities -->
  <h2 class="mt-5 pt-4 mb-4 text-center h-font">OUR Facilities</h2>
  <div class="container">
    <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
      <div class="col-lg-2 col-md-2 text-center bg-white rounded shadow py-4 my-3">
        <img src="images/facilities/IMG_27079.svg" width="80px">
        <h5 class="mt-3">Wifi</h5>
      </div>
    </div>
    <div class="col-lg-12 text-center mt-5">
      <a href="#" class="btn btn-sm btn-outline-dark shadow-none">More Facilities...</a>
    </div>
  </div>

<?php require('inc/footer.php');?>

  <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
  <script>
    var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade",
      loop:true,
      autoplay:{
        delay:3500,
        disableOnInteraction:false,
      }
        });
  </script>
</body>

</html>