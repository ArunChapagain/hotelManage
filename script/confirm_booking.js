let booking_form = document.getElementById('booking_form');
let info_loader = document.getElementById('info_loader');
let pay_info = document.getElementById('pay_info');
let payBtn = document.getElementById('payBtn');



function check_availability() {
  let checkin_val = booking_form.elements['checkin'].value;
  let checkout_val = booking_form.elements['checkout'].value;

  if (checkin_val != '' && checkout_val != '') {
    let data = new FormData();
    pay_info.classList.add('d-none');
    info_loader.classList.remove('d-none');
    data.append('check_availability', '');
    data.append('checkin', checkin_val);
    data.append('checkout', checkout_val);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/booking_crud.php", true);


    xhr.onload = function () {
      let data = JSON.parse(this.responseText);
      pay_info.classList.replace('text-dark', 'text-danger');
      payBtn.disabled = true;

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
        pay_info.innerHTML = "No. of Days:" + data.days + "<br>" + "Total Amount: Rs." + data.payment;
        pay_info.classList.replace('text-danger', 'text-dark');
        payBtn.disabled=false;
      }
      pay_info.classList.remove('d-none');
      info_loader.classList.add('d-none');
      payBtn.ariaDisabled()
    }
    xhr.send(data);
  }
}


// Set Stripe publishable key to initialize Stripe.js
const stripe = Stripe('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');


// Payment request handler
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
    document.querySelector("#spinner").classList.remove("hidden");
    document.querySelector("#buttonText").classList.add("hidden");
  } else {
    // Enable the button and hide spinner
    payBtn.disabled = false;
    document.querySelector("#spinner").classList.add("hidden");
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