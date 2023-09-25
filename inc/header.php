<?php
require('admin/inc/db_config.php');
require('admin/inc/essential.php');
require('links.php');
?>
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white py-lg-2 shadow-sm sticky-top">
  <div class="container-fluid d-flex align-items-center">
    <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo COMP_NAME ?></a>
    <button class="navbar-toggler shadow-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- <div class="d-flex align-items-center> -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item me-2">
          <a href="index.php" type="button" class="btn btn-outline-dark shadow-none  me-3"><i class="bi bi-house-fill"></i> Home</a>
        </li>
        <li class="nav-item me-2">
          <a href="rooms.php" type="button" class="btn btn-outline-dark shadow-none  me-3 "><i class="bi bi-hospital"></i> Hotels</a>
        </li>
        <li class="nav-item me-2">
          <a href="facilities.php" type="button " class="btn btn-outline-dark shadow-none  me-3 "><i class="bi bi-router"></i> Facilities</a>
        </li>
        <li class="nav-item me-2">
          <a href="booking.php" type="button" class="btn btn-outline-dark shadow-none  "><i class="bi bi-journal-text"></i>
            Bookings</a>
        </li>
      </ul>
      <?php
      session_start();
      $data = "";
      if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
        echo <<<data
                   <div class="dropdown">
                    <a class="btn btn-outline-dark  shadow-none pop" type="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    $_SESSION[uName]
                    </a>
                    <a type="button" class="btn btn-outline-dark shadow-none mx-3 me-lg-3 me-2 text-center" href="logout.php">
                      Logout
                    </a>
                  </div>
                  data;
      } else {
        echo <<<login_data
            <div>
              <div class="dropdown">
                  <button class="btn btn-outline-dark dropdown-toggle shadow-none me-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Login
                  </button>
                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                  <li><a type="button" class="btn dropdown-item shadow-none bg-dark pop" data-bs-toggle="modal"
              data-bs-target="#loginModal">
              User Login
            </a></li>
                    <li><a class="btn dropdown-item shadow-none bg-dark text-white  pop mt-2" href="./admin/admin.php">Admin Login</a></li>
                  </ul>
                </div>
                </div>
            <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal"
              data-bs-target="#registerModal">
              Register
            </button>
            </div>
            login_data;
      }
      ?>
    </div>
  </div>
</nav>
<div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form id="login-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" style="color:black;"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" style="color:black;">
          <div class="mb-3">
            <label class="form-label" style="color:black;">Email address</label>
            <input type="email" name="email_mob" class="form-control shadow-none" required>
          </div>
          <div class="mb-3">
            <label class="form-label" style="color:black;">Password</label>
            <input type="password" name="pass" class="form-control shadow-none" required>
          </div>
          <div class="d-flex align-items-center justify-content-between">
            <button class="btn btn-dark shadow-none pop">Login </button>
            <a href="javascript: void(0)" class="text-decoration-none"> </a>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form id="register-form">
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" style="color:black;"><i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color:black;">
          <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
            Note:Your details must match with your ID( Citizenship card,password,driving license,National identity card
            ) that will be required during check-in.
          </span>
          <div class="container-fluid">
            <div class="row d-flex">
              <div class="col-md-6 mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Phone Number</label>
                <input type="number" name="phonenum" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Address</label>
                <textarea class="form-control shadow-none" name="address" rows="3" required></textarea>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Picture</label>
                <input type="file" accept=".jpg,.png,jpeg,.webp" name="profile" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Document Image</label>
                <input type="file" accept=".jpg,.png,jpeg,.webp" name="document" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Date of birth</label>
                <input type="date" name="dob" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="pass" class="form-control shadow-none" required>
              </div>
              <div class="col-md-6 mb-3">
                <label class="form-label">Confirm Password</label>
                <input type="password" name="cpass" class="form-control shadow-none" required>
              </div>
            </div>
          </div>
          <div class="text-center">
            <button type="submit" class="btn btn-dark shadow-none pop">Register</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>