
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-light px-  lg-3 py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid">
    <a class="navbar-brand me-5" href="dashboard.php">
      <div class="me-5  d-flex align-item-center">
        <div class="fw-bold fs-3 h-font">
        <?php echo COMP_NAME ?>
        </div>
        <div class="fw-bold fs-2 mx-5">
          Admin Panal
        </div>
      </div>
    </a>
    <button class="navbar-toggler shadow-none ms-auto" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link me-2" href="rooms.php">Hotels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="carousel.php">Carousel</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="features&facilities.php">Features & Facilities</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="users.php">User settings</a>
        </li>
        <li class="nav-item">
          <a class="nav-link me-2" href="booking_details.php">Booking Details</a>
        </li>
      </ul>
      <a type="button" class="btn btn-dark shadow-none me-lg-3 me-2 pop" href="logout.php">
        Logout
      </a>
    </div>
  </div>
</nav>
<?php require('inc/scripts.php'); ?>
