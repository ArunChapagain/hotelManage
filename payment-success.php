<?php
// Include configuration file  
require_once './inc/config.php';
require_once 'payment_init.php';
require('./admin/inc/essential.php');
require('./admin/inc/db_config.php');
require('inc/links.php');
// require('inc/header.php');

$payment_id = $statusMsg = '';
$status = 'error';

// Include database connection file  
// Check whether stripe checkout session is not empty 
if (!empty($_GET['session_id'])) {
    $session_id = $_GET['session_id'];

    // Fetch transaction data from the database if already exists 
    $sqlQ = "SELECT * FROM transactions WHERE stripe_checkout_session_id = ?";
    $stmt = $con->prepare($sqlQ);
    $stmt->bind_param("s", $con_session_id);
    $con_session_id = $session_id;
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Transaction details 
        $transData = $result->fetch_assoc();
        $payment_id = $transData['id'];
        $transactionID = $transData['txn_id'];
        $paidAmount = $transData['paid_amount'];
        $paidCurrency = $transData['paid_amount_currency'];
        $payment_status = $transData['payment_status'];

        $customer_name = $transData['customer_name'];
        $customer_email = $transData['customer_email'];

        $status = 'success';
        $statusMsg = 'Your Payment has been Successful!';
    } else {
        // Include the Stripe PHP library 
        require_once 'stripe-php/init.php';

        // Set API key 
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY);

        // Fetch the Checkout Session to display the JSON result on the success page 
        try {
            $checkout_session = $stripe->checkout->sessions->retrieve($session_id);
        } catch (Exception $e) {
            $api_error = $e->getMessage();
        }

        if (empty($api_error) && $checkout_session) {
            // Get customer details 
            $customer_details = $checkout_session->customer_details;

            // Retrieve the details of a PaymentIntent 
            try {
                $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent);
            } catch (\Stripe\Exception\ApiErrorException $e) {
                $api_error = $e->getMessage();
            }

            if (empty($api_error) && $paymentIntent) {
                // Check whether the payment was successful 
                if (!empty($paymentIntent) && $paymentIntent->status == 'succeeded') {
                    // Transaction details  
                    $transactionID = $paymentIntent->id;
                    $paidAmount = $paymentIntent->amount;
                    $paidAmount = ($paidAmount / 100);
                    $paidCurrency = $paymentIntent->currency;
                    $payment_status = $paymentIntent->status;

                    // Customer info 
                    $customer_name = $customer_email = '';
                    if (!empty($customer_details)) {
                        $customer_name = !empty($customer_details->name) ? $customer_details->name : '';
                        $customer_email = !empty($customer_details->email) ? $customer_details->email : '';
                    }

                    // Check if any transaction data is exists already with the same TXN ID 
                    $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?";
                    $stmt = $con->prepare($sqlQ);
                    $stmt->bind_param("s", $transactionID);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $prevRow = $result->fetch_assoc();

                    if (!empty($prevRow)) {
                        $payment_id = $prevRow['id'];
                    } else {
                        // Insert transaction data into the database 
                        $sqlQ = "INSERT INTO transactions (cus_id,cus_card_name,cus_card_email,hotel_name,room_type,room_id,paid_amount,txn_id,payment_status,stripe_checkout_session_id,created,`days`,checkin,checkout) VALUES (?,?,?,?,?,?,?,?,?,?,NOW(),?,?,?)";
                        $stmt = $con->prepare($sqlQ);
                        $stmt->bind_param("issssidssssss", $uId, $customer_name, $customer_email, $hotelName, $type, $roomID, $paidAmount, $transactionID, $payment_status, $session_id, $days, $cin_date, $cout_date);
                        $insert = $stmt->execute();

                        if ($insert) {
                            $payment_id = $stmt->insert_id;
                        }
                    }

                    $status = 'success';
                    $statusMsg = 'Your Payment has been Successful!';
                } else {
                    $statusMsg = "Transaction has been failed!";
                }
            } else {
                $statusMsg = "Unable to fetch the transaction details! $api_error";
            }
        } else {
            $statusMsg = "Invalid Transaction! $api_error";
        }
    }
} else {
    $statusMsg = "Invalid Request!";
}
?>

<link rel="stylesheet" href="style.css">

<nav id="nav-bar" class="navbar navbar-expand-lg navbar-light bg-white lg-3 py-lg-2 shadow-sm sticky-top">
    <div class="container-fluid d-flex align-items-center">
        <a class="navbar-brand me-5 fw-bold fs-3 h-font" href="index.php"><?php echo COMP_NAME ?></a>
        <button class="navbar-toggler shadow-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class=" navbar-nav  ms-5 me-auto mb-2 mb-lg-0">
                <li class="nav-item me-2">
                    <a href="index.php" type="button" class="btn btn-outline-dark shadow-none  me-3"><i class="bi bi-house-fill"></i> Home</a>
                </li>
                <li class="nav-item me-2">
                    <a href="rooms.php" type="button" class="btn btn-outline-dark shadow-none  me-3 "><i class="bi bi-hospital"></i> Rooms</a>
                </li>
                <li class="nav-item me-2">
                    <a href="facilities.php" type="button " class="btn btn-outline-dark shadow-none  me-3 "><i class="bi bi-router"></i> Facilities</a>
                </li>
                <li class="nav-item me-2">
                    <a href="booking.php" type="button" class="btn btn-outline-dark shadow-none  "><i class="bi bi-journal-text"></i>
                        Bookings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="card mt-2 px-3 bg-light border-0">
    <div class="card-body">
        <div>

            <h1 class="card-title <?php echo $status; ?> mb-3 text-center" style="color:rgb(179, 229, 211);">
                <?php echo $statusMsg; ?>
            </h1>
            <div>
                <?php if (!empty($payment_id)) { ?>

                    <h4>Payment Information</h4>
                    <p><b>Reference Number:</b>
                        <?php echo $payment_id; ?>
                    </p>
                    <p><b>Transaction ID:</b>
                        <?php echo $transactionID; ?>
                    </p>
                    <p><b>Paid Amount:</b>
                        <?php echo 'NRs' . ' ' . $paidAmount; ?>
                    </p>
                    <p><b>Payment Status:</b>
                        <?php echo $payment_status; ?>
                    </p>

                    <h4>Customer Information</h4>
                    <p><b>Customer Id:</b>
                        <?php echo $uId; ?>
                    </p>
                    <p><b>Paid by:</b>
                        <?php echo $customer_name; ?>
                    </p>
                    <p><b>Email:</b>
                        <?php echo $customer_email; ?>
                    </p>
                    <p><b>Reserved For:</b>
                        <?php echo $days; ?> days
                    </p>
                    <p><b>Check-in Date:</b>
                        <?php echo $cin_date; ?>
                    </p>
                    <p><b>Check-out Date:</b>
                        <?php echo $cout_date; ?>
                    </p>

                    <h4>Hotel Information</h4>
                    <p><b>Name:</b>
                        <?php echo $hotelName; ?>
                    </p>
                    <p><b>Room Type:</b>
                        <?php echo $type; ?>
                    </p>
                    <p><b>Room Id:</b>
                        <?php echo $roomID; ?>
                    </p>

                <?php } else { ?>
                    <h1 class="error">Your Payment been failed!</h1>
                    <p class="error">
                        <?php echo $statusMsg; ?>
                    </p>
                <?php } ?>

            </div>

        </div>
    </div>
</div>

<?php
require('inc/footer.php');
?>