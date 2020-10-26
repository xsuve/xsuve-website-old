<?php

class SignUp extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

    if($account != null) {
      header('location: ' . URL . 'dashboard');
    } else {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/alerts.php';
      require 'application/views/signup/index.php';
      require 'application/views/_templates/footer.php';
    }
  }

  // Sign Up Account
  public function signUpAccount() {
  	if(isset($_POST['sign_up_account'])) {
  		$sign_up_model = $this->loadModel('SignUpModel');
  		$sign_up_account = $sign_up_model->signupAccount($_POST['name'], $_POST['email'], $_POST['phone_number'], $_POST['password']);

      if(isset($sign_up_account) && $sign_up_account != null) {
        $_SESSION['alert'] = $sign_up_account;
        header('location: ' . URL . 'signup');
      } else {
        header('location: ' . URL . 'signup');
      }
  	}
  }
    
}

?>