<?php 
require('admin/inc/db_config.php');
require('admin/inc/essential.php');
?>
<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-light px-  lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid">
      <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php">YOYO</a>
      <button class="navbar-toggler shadow-none ms-auto" type="button" data-bs-toggle="collapse"
        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link me-2" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="rooms.php">Rooms</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="facilities.php">Facilities</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="#">Contact us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link me-2" href="#">About
          </li>
        </ul>
        <a class="nav-link" href="#">
        <div class="d-flex">
          <button type="button" class="btn btn-outline-dark shadow-none me-lg-3 me-2" data-bs-toggle="modal" data-bs-target="#loginModal">
            Login
          </button>
          <button type="button" class="btn btn-outline-dark shadow-none" data-bs-toggle="modal" data-bs-target="#registerModal">
            Register
          </button>
        </div>
      </div>
    </div>
  </nav>

  <div class="modal fade" id="loginModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">        
        <form> 
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" style="color:black;"><i class="bi bi-person-circle fs-3 me-2"></i>User Login</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body" style="color:black;">
            <div class="mb-3">
              <label class="form-label" style="color:black;">Email address</label>
              <input type="email" class="form-control shadow-none">
            </div>
            <div class="mb-3">
              <label class="form-label" style="color:black;">Password</label>
              <input type="password" class="form-control shadow-none">
            </div>
            <div class="d-flex align-items-center justify-content-between">
              <button class="btn btn-dark shadow-none pop" >Login </button>
              <a href="javascript: void(0)" class="text-decoration-none">Forgot possword</a>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">        
        <form> 
        <div class="modal-header">
          <h5 class="modal-title d-flex align-items-center" style="color:black;"><i class="bi bi-person-lines-fill fs-3 me-2"></i>User Registration</h5>
          <button type="reset" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" style="color:black;">
             <span class="badge bg-light text-dark mb-3 text-wrap lh-base">
              Note:Your details must match with your ID( Citizenship card,password,driving license,National identity card ) that will be required during check-in.
             </span>
             <div class="container-fluid">
              <div class="row d-flex">
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control shadow-none">
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control shadow-none">
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="number" class="form-control shadow-none">
                    </div>
                    <div class="col-md-6 mb-3">
                    <label class="form-label">Picture</label>
                    <input type="file" class="form-control shadow-none">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label class="form-label">Address</label>
                      <textarea class="form-control shadow-none"  rows="1"></textarea>
                    </div>
                      <div class="col-md-6 mb-3">
                      <label class="form-label">Date of birth</label>
                      <input type="date" class="form-control shadow-none">
                      </div>
                      <div class="col-md-6 mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" class="form-control shadow-none">
                      </div>
                      <div class="col-md-6 mb-3">
                      <label class="form-label">Conform Password</label>
                      <input type="password" class="form-control shadow-none">
                      </div>
                 </div>
             </div>
             <div class="text-center">
              <button class="btn btn-dark shadow-none pop">Register</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
