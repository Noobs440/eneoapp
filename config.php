<?php
// global configuration for the application
// keep this file out of version control or store real values in environment variables

// database configuration is already in db.php, but you can also put payment credentials here

// Toggle between sandbox/testing and real payment gateway
// set to true while you are working with the sandbox API keys
// set to false once you're ready to go live (and update the URL / keys accordingly)
define('USE_SANDBOX', true);

// sandbox API credentials provided by the payment provider
// replace the placeholders below with the values you received

define('PAYMENT_API_URL', 'https://sandbox.example-payment.com/v1/pay');
define('PAYMENT_API_KEY', 'YOUR_SANDBOX_API_KEY');
define('PAYMENT_API_SECRET', 'YOUR_SANDBOX_API_SECRET');

// if the provider requires additional headers or client ids you can define
// constants for them here as well, e.g.:
// define('PAYMENT_API_CLIENT_ID', '...');

?>