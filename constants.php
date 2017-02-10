<?php
//Status
 define("REGISTERED",  "REGISTERED");
 define("APPLIED",  "APPLIED");
 define("VERIFIED",  "VERIFIED");
 define("APPROVED",  "APPROVED");
 define("SUBSCRIBED",  "SUBSCRIBED");
 define("READY",  "READY");
 define("REJECTED",  "REJECTED");
//Roles
 define("ADMIN",  "admin");
 define("DOCTOR",  "doctor");
 define("PATIENT",  "patient");
 define("APPROVER",  "approver");
 // Document Upload Directory
 define("UPLOADS",  "uploads");
 //Case Status
 define("OPEN",  "OPEN");
 define("CLOSE",  "CLOSE");
// Your test paypal sanbox url, Replace it with live url after successful testing.
DEFINE('PAYPAL_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr'); 

// Set paypal marchent id.
DEFINE('PAYPAL_ID', 'viswanath0541@gmail.com');  // you can find thuis in your developer account it look like "username-facilitator@gmail.com"

// Define your base currency
DEFINE('CURRENCY', 'INR');

// Define your base currency
DEFINE('PROD', 'PROD');
DEFINE('TEST', 'TEST');
DEFINE('RUNMODE', 'TEST');

DEFINE("NORMAL", "font-weight:normal");
DEFINE("BOLD", "class=alert-danger");

?>