<?php
// process-mtn-payment.php

// User Input from Form
$service = $_POST['service'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// Simulate Payment Amount based on Service Selected
$paymentAmount = 0;
switch ($service) {
    case 'video_consultation':
        $paymentAmount = 30000;
        break;
    case 'helpline':
        $paymentAmount = 15000;
        break;
    case 'subscription':
        $paymentAmount = 50000;
        break;
}

// MTN Mobile Money API endpoint and credentials
$apiUrl = 'https://sandbox.momodeveloper.mtn.com/collection/v1_0/requesttopay';
$apiKey = 'your_api_key';  // Get from MTN developer account
$shortcode = 'your_shortcode'; // Your shortcode
$apiUsername = 'your_api_username'; // API username
$apiPassword = 'your_api_password'; // API password

// MTN Mobile Money API headers
$headers = [
    "Authorization: Bearer your_access_token", // Obtain access token using OAuth2.0
    "Content-Type: application/json"
];

// MTN Payment Request Data
$requestData = json_encode([
    'amount' => $paymentAmount,
    'currency' => 'XOF', // West African CFA Franc
    'externalId' => uniqid('safe-space-', true), // Unique ID for this payment request
    'payer' => [
        'partyIdType' => 'MSISDN', // MTN phone number (user's phone)
        'partyId' => $phone
    ],
    'payerMessage' => 'Payment for Safe Space service: ' . $service,
    'payeeNote' => 'Support for Safe Space Crisis Services',
]);

// Initiate Payment Request to MTN API
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $requestData);

// Execute cURL request
$response = curl_exec($ch);

// Check for errors
if(curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
    exit();
}

// Close cURL connection
curl_close($ch);

// Handle the Response
$responseData = json_decode($response, true);

// Check if the payment request was successful
if (isset($responseData['status']) && $responseData['status'] == 'SUCCESS') {
    // Redirect to payment confirmation
    header("Location: payment-confirmation.php?service=$service&name=$name&email=$email&phone=$phone");
    exit();
} else {
    // Payment failed or something went wrong
    echo "<script>alert('Payment failed. Please try again later.'); window.location.href='payment.php';</script>";
}
?>
