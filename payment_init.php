<?php 
// require('inc/header.php');
// Include the configuration file 
require_once './inc/config.php';
// Include the Stripe PHP library 
require_once 'stripe-php/init.php'; 
// Set API key 
$stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 

session_start();
$uId = $_SESSION['uId'];
$hotelName = $_SESSION['room']['name'];
$type=$_SESSION['room']['type'];
$roomID = $_SESSION['room']['id'];


$currency = "NPR";
$roomPrice = ($_SESSION['payment']);
$days = ($_SESSION['days']);
$cin_date = ($_SESSION['checkin']);
$cout_date = ($_SESSION['checkout']);



$response = array( 
    'status' => 0, 
    'error' => array( 
        'message' => 'Invalid Request!'    
    ) 
); 
 
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $input = file_get_contents('php://input'); 
    $request = json_decode($input);     
} 
 
if (json_last_error() !== JSON_ERROR_NONE) { 
    http_response_code(400); 
    echo json_encode($response); 
    exit; 
} 
 
if(!empty($request->createCheckoutSession)){ 
    // Convert product price to cent 
    $stripeAmount = round($roomPrice*100, 2); 
 
    // Create new Checkout Session for the order 
    try { 
        $checkout_session = $stripe->checkout->sessions->create([ 
            'line_items' => [[ 
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => $hotelName, 
                        'metadata' => [ 
                            'pro_id' => $roomID 
                        ] 
                    ], 
                    'unit_amount' => $stripeAmount, 
                    'currency' => $currency, 
                ], 
                'quantity' => 1 
            ]], 
            'mode' => 'payment', 
            'success_url' => STRIPE_SUCCESS_URL.'?session_id={CHECKOUT_SESSION_ID}', 
            'cancel_url' => STRIPE_CANCEL_URL, 
        ]); 
    } catch(Exception $e) {  
        $api_error = $e->getMessage();  
    } 
     
    if(empty($api_error) && $checkout_session){ 
        $response = array( 
            'status' => 1, 
            'message' => 'Checkout Session created successfully!', 
            'sessionId' => $checkout_session->id 
        ); 
    }else{ 
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Checkout Session creation failed! '.$api_error    
            ) 
        ); 
    } 
    echo json_encode($response); 
} 
?>