<?php

// Errors
error_reporting(E_ALL);
ini_set("display_errors", 1);

// Database
define("DB_TYPE", "mysql");
define("DB_HOST", "localhost");
define("DB_NAME", "xsuvecom_luxx");
define("DB_USER", "xsuvecom_user");
define("DB_PASS", "V31fA9L;Vytp.9");

// General
define("THEME", "Luxx");
define("URL", "http://xsuve.com/demo/luxx/");

// Invoice
define("INVOICE_NAME", "Mouple");
define("INVOICE_EMAIL", "contact.mouple@gmail.com");
define("INVOICE_ADDRESS", "Street 10, Romania");
define("INVOICE_PHONE", "0123456789");

// Platform
define("TIMEZONE", "Europe/Bucharest"); // https://www.php.net/manual/en/timezones.php
define("CURRENCY", "USD");
define("CURRENCY_SYMBOL", "$");
define("ADMIN_EMAIL", "contact.mouple@gmail.com");
define("ATTACHMENT_MAX_SIZE", 20000000); // 20000000 B -> 20 MB

// PayPal
define('PAYPAL_SANDBOX', 1); // 1 -> Sandbox, 0 -> Live
define('PAYPAL_SANDBOX_URL', 'https://www.sandbox.paypal.com/cgi-bin/webscr');
define('PAYPAL_LIVE_URL', 'https://www.paypal.com/cgi-bin/webscr');
define('PAYPAL_EMAIL', 'contact.mouple@gmail.com');

?>