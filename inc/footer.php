<div class="container-fluid bg-white mt-5">
  <div class="row">
    <div class="col-lg-8 p-3">
      <h3 class="h-font fw-bold fs-3 mb-2">
        <?php echo COMP_NAME ?>
      </h3>
      <p>
      At BookIn, we strive to provide you with the ultimate hotel booking experience. Whether you're planning a business trip, a family vacation, or a romantic getaway, we are here to make your travel dreams a reality. Our platform is designed to connect you with a vast selection of hotels, ensuring that you find the perfect accommodation that meets your needs and budget.
      </p>
    </div>
    <div class="col-lg-4 p-3 d-flex align-item-center justify-content-around">
      <div class="text-dark">
        <h5 class="mb-3">Links</h5>
          <a href="index.php" class="text-dark text-decoration-none">Home</a><br />
          <a href="rooms.php" class="text-dark text-decoration-none">Rooms</a><br />
          <a href="facilities.php" class="text-dark text-decoration-none">Facilities</a><br />
          <a href="booking.php" class="text-dark text-decoration-none">Bookings</a>
      </div>
      <div>
        <h5 class="mb-3">Follow us</h5>
        <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
          <i class="bi bi-facebook me-1"></i>Facebook </a><br />
        <a href="#" class="d-inline-block text-dark text-decoration-none mb-2">
          <i class="bi bi-instagram"></i> Instagram </a><br />
      </div>
    </div>
  </div>
</div>
<h6 class="text-center bg-dark text-white p-3 m-0">
  Designed and developed by
  <?php echo COMP_NAME ?> team.
</h6>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

<script>
  function setActive() {
    let navbar = document.getElementById("nav-bar");
    let a_tags = navbar.getElementsByTagName("a");
    for (i = 0; i < a_tags.length; i++) {
      let file = a_tags[i].href.split('/').pop();
      let file_name = file.split('.')[0];
      if (document.location.href.indexOf(file_name) >= 0) {
        a_tags[i].classList.add('active');
      }
    }
  }
  setActive();

  let register_form = document.getElementById('register-form');


  register_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let data = new FormData();

    data.append('register', '');
    data.append('name', register_form.elements['name'].value);
    data.append('email', register_form.elements['email'].value);
    data.append('phonenum', register_form.elements['phonenum'].value);
    data.append('address', register_form.elements['address'].value);
    data.append('profile', register_form.elements['profile'].files[0]);
    data.append('document', register_form.elements['document'].files[0]);
    data.append('dob', register_form.elements['dob'].value);
    data.append('pass', register_form.elements['pass'].value);
    data.append('cpass', register_form.elements['cpass'].value);

    var myModal = document.getElementById('registerModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == 'pass_mismatch') {
        alert('password mismatch');
      }
      else if (this.responseText == 'email_already') {
        alert('Email is already registered');
      }
      else if (this.responseText == 'inv_img') {
        alert('Inv image');
      }
      else if (this.responseText == 'upd_failed') {
        alert('image upload failed');
      }
      else if (this.responseText == 'ins_failed') {
        alert('error');
      }

      else {
        alert('success');
        register_form.reset();
      }
    }
    xhr.send(data);

  });



  let login_form = document.getElementById('login-form');
  login_form.addEventListener('submit', function (e) {
    e.preventDefault();

    let data = new FormData();

    data.append('email_mob', login_form.elements['email_mob'].value);
    data.append('pass', login_form.elements['pass'].value);
    data.append('login', '');

    var myModal = document.getElementById('loginModal');
    var modal = bootstrap.Modal.getInstance(myModal);
    modal.hide();

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/login_register_crud.php", true);

    xhr.onload = function () {
      if (this.responseText == 'inv_usr') {
        alert('Invalid email or Mobile Number!');
      }
      else if (this.responseText == 'inactive') {
        alert('Account Suspended. Contact Admin');
      }
      else if (this.responseText == 'inv_pass') {
        alert('Password doesnot match');
      }

      else {
        let fileurl = window.location.href.split('/').pop().split('?');
        if (fileurl == 'room_details.php') {
          window.location = window.location.href;
        }
        else {
          window.location = window.location.pathname;
        }
      }
    }
    xhr.send(data);

  });



  function checkLoginToBook(status, room_id) {
    if (status) {
      window.location.href = 'confirm_booking.php?id=' + room_id;
    }
    else {
      alert("Please login first.");
    }
  }

</script>