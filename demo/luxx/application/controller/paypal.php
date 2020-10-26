<?php

class Paypal extends Controller {

  public $paypalURL = PAYPAL_SANDBOX == 1 ? 'https://www.sandbox.paypal.com/cgi-bin/webscr' : 'https://www.paypal.com/cgi-bin/webscr';

  public function index() {
    header('location: ' . URL . 'dashboard');
  }

  // Payment Notify
  public function paymentNotify() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $paypal_model = $this->loadModel('PaypalModel');

      $raw_post_data = file_get_contents('php://input');
      $raw_post_array = explode('&', $raw_post_data);
      $myPost = array();
      foreach($raw_post_array as $keyval) { 
        $keyval = explode ('=', $keyval);
        if(count($keyval) == 2) {
          $myPost[$keyval[0]] = urldecode($keyval[1]);
        }
      }

      // Read the post from PayPal system and add 'cmd'
      $req = 'cmd=_notify-validate';
      if(function_exists('get_magic_quotes_gpc')) {
        $get_magic_quotes_exists = true;
      }
      foreach($myPost as $key => $value) {
        if($get_magic_quotes_exists == true && get_magic_quotes_gpc() == 1) {
          $value = urlencode(stripslashes($value));
        } else {
          $value = urlencode($value);
        }
        $req .= "&$key=$value";
      }

      // Post IPN data back to PayPal to validate the IPN data is genuine
      $paypalURL = (PAYPAL_SANDBOX == 1 ? PAYPAL_SANDBOX_URL : PAYPAL_LIVE_URL);
      $ch = curl_init($paypalURL);
      if($ch == FALSE) {
        return FALSE;
      }
      curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $req);
      curl_setopt($ch, CURLOPT_SSLVERSION, 6);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
      curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);

      // Set TCP timeout to 30 seconds 
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30); 
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Connection: Close', 'User-Agent: company-name'));
      $res = curl_exec($ch);

      /*
       * Inspect IPN validation result and act accordingly
       * Split response headers and payload, a better way for strcmp
      */
      $tokens = explode("\r\n\r\n", trim($res));
      $res = trim(end($tokens));
      if(strcmp($res, "VERIFIED") == 0 || strcasecmp($res, "VERIFIED") == 0) {
        // Retrieve transaction info from PayPal
        $item_number = $_POST['item_number'];
        $txn_id = $_POST['txn_id'];
        $payment_gross = $_POST['mc_gross'];
        $currency_code = $_POST['mc_currency'];
        $payment_status = $_POST['payment_status'];
        die(print_r($txn_id));
         
        // Check if transaction data exists with the same TXN ID 
        // $prevPayment = $db->query("SELECT payment_id FROM payments WHERE txn_id = '".$txn_id."'"); 
        // if($prevPayment->num_rows > 0){ 
        //     exit(); 
        // }else{ 
        //     // Insert transaction data into the database 
        //     $insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status) VALUES('".$item_number."','".$txn_id."','".$payment_gross."','".$currency_code."','".$payment_status."')"); 
        // }
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Payment Success
  public function paymentSuccess() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $_SESSION['payment_title'] = 'The payment has been successully processed.';
      $_SESSION['payment_description'] = 'Thanks for your payment.';

      require 'application/views/_templates/header.php';
      require 'includes/modules/saas/views/_templates/header.php';
      require 'includes/modules/saas/views/_templates/popbox-payment.php';
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Payment Cancel
  public function paymentCancel() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $_SESSION['alert'] = 'The payment has been cancelled.';
      header('location: ' . URL . 'dashboard');
    } else {
      header('location: ' . URL . 'login');
    }
  }

}

?>