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

  /*
    check room if from url is present or not
    user is logged in or not
  */


  if (!isset($_GET['id'])) {
    redirect('rooms.php');
  } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
    redirect('rooms.php');
    alert('alert', 'please login');
  }

  //filter and get room and user data
  
  $data = filteration($_GET);
  $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

  if (mysqli_num_rows($room_res) == 0) {
    redirect('rooms.php');

  }
  $room_data = mysqli_fetch_assoc($room_res);

  $_SESSION['room'] = [
    "id" => $room_data['id'],
    "name" => $room_data['name'],
    "type" => $room_data['type'],
    "price" => $room_data['price'],
    "payment" => null,
    "available" => false,
    "checkin" => null,
    "checkout" => null
  ];

  $user_res = select(
    "SELECT * FROM `user_cred` WHERE `id`=? LIMIT 1",
    [$_SESSION['uId']],
    'i'
  );
  $user_data = mysqli_fetch_assoc($user_res);
  ?>




  <div class="container">
    <div id="paymentResponse" class="hidden"></div>
    <div class="row">
      <div class="my-5" px-4>
        <h2 class="fw-bold h-font text-center">
          Confirm Booking
        </h2>
      </div>
      <!-- carousel -->
      <div class="col-lg-6 col-md-12 px-4">

        <?php
        //get thumbnail of images
        $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
        $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` 
          WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

        if (mysqli_num_rows($thumb_q) > 0) {

          $thumb_res = mysqli_fetch_assoc($thumb_q);
          $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
          $login = 0;
          if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
            $login = 1;
          }
        }

        echo <<<data
        <div class="card p-3 shadow rounded">
         <img src="$room_thumb" class="img-fluid rounded mb-3">
         <h5>$room_data[name]</h5>
         <h6>NRs. $room_data[price] per Night</h6>

         </div>
        data;

        ?>
      </div>


      <div class="col-lg-6 col-md-12 px-4">
        <div class="card my-4 text-middle border-0 shadow rounded-3">
          <div class="card-body">
            <form action="" id="booking_form">


              <h6 class="mb-3">Booking Details</h6>
              <div class="row">
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Name</label>
                  <input type="text" name="name" value="<?php echo $user_data['name'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Phone Number</label>
                  <input type="number" name="number" value="<?php echo $user_data['phonenum'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Address</label>
                  <input type="text" name="address" value="<?php echo $user_data['address'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Email</label>
                  <input type="email" name="email" value="<?php echo $user_data['email'] ?>"
                    class="form-control shadow-none" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Check-in</label>
                  <input type="date" name="checkin" class="form-control shadow-none" onchange="check_availability()"
                    required>
                </div>
                <div class="col-md-6">
                  <label class="form-label" style="color:black;">Check-out</label>
                  <input type="date" name="checkout" class="form-control shadow-none" onchange="check_availability()"
                    required>
                </div>
                <div class="col-12">
                  <h6 class="text-danger my-2" id="pay_info">Provide check-in & check-out date<br/>Alert:Refund is not available.</h6>
                  <div class="spinner-border my-2 d-none" id="spinner" style="width: 2rem; height: 2rem;" role="status">
                    <span class="visually-hidden">Loading...</span>
                  </div>
                  <div>
                    <button class="stripe-button" id="payButton">
                      <span id="buttonText">Pay Now</span>
                    </button>
                  </div>

                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require('inc/footer.php');
  ?>

  <?php
  require('./inc/config.php');
  ?>

  <script src="https://js.stripe.com/v3/"></script>

  <script>
    const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

    const payBtn = document.querySelector("#payButton");

    payBtn.addEventListener("click", function (evt) {
      setLoading(true);

      createCheckoutSession().then(function (data) {
        if (data.sessionId) {
          stripe.redirectToCheckout({
            sessionId: data.sessionId,
          }).then(handleResult);
        } else {
          handleResult(data);
        }
      });
    });

    // Create a Checkout Session with the selected product
    const createCheckoutSession = function (stripe) {
      return fetch("payment_init.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({
          createCheckoutSession: 1,
        }),
      }).then(function (result) {
        return result.json();
      });
    };
    // Handle any errors returned from Checkout
    const handleResult = function (result) {
      if (result.error) {
        showMessage(result.error.message);
      }

      setLoading(false);
    };

    // Show a spinner on payment processing
    function setLoading(isLoading) {
      if (isLoading) {
        // Disable the button and show a spinner
        payBtn.disabled = true;
        document.querySelector("#spinner").classList.remove("d-none");
        document.querySelector("#buttonText").classList.add("hidden");
      } else {
        // Enable the button and hide spinner
        payBtn.disabled = false;
        document.querySelector("#spinner").classList.add("d-none");
        document.querySelector("#buttonText").classList.remove("hidden");
      }
    }

    // Display message
    function showMessage(messageText) {
      const messageContainer = document.querySelector("#paymentResponse");

      messageContainer.classList.remove("hidden");
      messageContainer.textContent = messageText;

      setTimeout(function () {
        messageContainer.classList.add("hidden");
        messageText.textContent = "";
      }, 5000);
    }

  </script>

  <script>
    let booking_form = document.getElementById('booking_form');
    let info_loader = document.getElementById('info_loader');
    let pay_info = document.getElementById('pay_info');
    payBtn.disabled = true;

    function check_availability() {
      let checkin_val = booking_form.elements['checkin'].value;
      let checkout_val = booking_form.elements['checkout'].value;

      if (checkin_val != '' && checkout_val != '') {
        let data = new FormData();
        pay_info.classList.add('d-none');
        data.append('check_availability', '');
        data.append('checkin', checkin_val);
        data.append('checkout', checkout_val);

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/booking_crud.php", true);


        xhr.onload = function () {
          let data = JSON.parse(this.responseText);
          pay_info.classList.replace('text-dark', 'text-danger');
          if (data.status == 'same_date') {
            pay_info.innerHTML = "Cannot have same check-in check-out date";
          }
          else if (data.status == 'inv_cd') {
            pay_info.innerHTML = "invalid checkout date";
          }
          else if (data.status == 'inv_ci') {
            pay_info.innerHTML = "invalid checkin date";
          }
          else if (data.status == 'unavailable') {
            pay_info.innerHTML = "rooms not available";
          }
          else {
            payBtn.disabled = false;
            pay_info.innerHTML = "No. of Days:" + data.days + "<br>" + "Total Amount: Rs." + data.payment;
            pay_info.classList.replace('text-danger', 'text-dark');
          }
          pay_info.classList.remove('d-none');
        }
        xhr.send(data);
      }
    }



  </script>

</body>

</html>