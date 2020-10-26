<?php

class Account extends Controller {

  public function index() {
    $account = $this->getSessionAccount();

    if($account != null) {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/topbar.php';
      require 'application/views/_templates/sidebar.php';
      require 'application/views/_templates/alerts.php';
      require 'application/views/account/index.php';
      require 'application/views/_templates/footer.php';
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Edit
  public function edit() {
    $account = $this->getSessionAccount();

    if($account != null) {
      require 'application/views/_templates/header.php';
      require 'application/views/_templates/topbar.php';
      require 'application/views/_templates/sidebar.php';
      require 'application/views/_templates/alerts.php';
      require 'application/views/account/edit.php';
      require 'application/views/_templates/footer.php';
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Edit Account
  public function editAccount() {
    $account = $this->getSessionAccount();

    if($account != null) {
      if(isset($_POST['submit_edit_account'])) {
        $account_model = $this->loadModel('AccountModel');
        $edit_account = $account_model->editAccount($account->id, $_POST['account_phone_number'], $_FILES['account_profile']);

        if(isset($edit_account) && $edit_account != null) {
          $_SESSION['alert'] = $edit_account;
          header('location: ' . URL . 'account/edit');
        }

        header('location: ' . URL . 'account/edit');
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Update Password
  public function updatePassword() {
    $account = $this->getSessionAccount();

    if($account != null) {
      if(isset($_POST['submit_update_password'])) {
        $account_model = $this->loadModel('AccountModel');
        $update_password = $account_model->updatePassword($account->id, $account->password, $_POST['current_password'], $_POST['new_password'], $_POST['confirm_new_password']);

        if(isset($update_password) && $update_password != null) {
          $_SESSION['alert'] = $update_password;
          header('location: ' . URL . 'account/edit');
        }

        header('location: ' . URL . 'account/edit');
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }
    
}

?>