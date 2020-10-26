<?php

class Expenses extends Controller {

  // Box
  public function index() {
    $account = $this->getSessionAccount();

    if($account != null) {
      require 'includes/modules/expenses/views/_templates/header.php';
      require 'includes/modules/expenses/views/_templates/box.php';
    } else {
        header('location: ' . URL . 'login');
    }
  }

  // View
  public function view() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $modules_model = $this->loadModel('ModulesModel');
      $widget_status = $modules_model->getWidgetDisplayStatus('expenses');
      $pinned_status = $modules_model->getPinnedStatus('expenses');

      $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
      $expenses = $module_model->getAccountExpenses($account->id);
      $stats_expenses = $module_model->getAccountExpenses($account->id);
      
      require 'includes/modules/expenses/views/_templates/header.php';
      require 'includes/modules/expenses/views/index.php';
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Edit
  public function edit($id = null) {
    if(isset($id) && $id != null) {
      $account = $this->getSessionAccount();

      if($account != null) {
        $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
        
        $expense = $module_model->getExpenseData($id);

        if($expense != false) {
          require 'includes/modules/expenses/views/_templates/header.php';
          require 'includes/modules/expenses/views/edit.php';
        } else {
          $_SESSION['alert'] = 'That expense does not exist.';
          $this->redirect(URL . 'modules/view/expenses');
        }
      } else {
        header('location: ' . URL . 'login');
      }
    } else {
      header('location: ' . URL . 'modules/view/expenses');
    }
  }

  // Widget
  public function widget() {
    $account = $this->getSessionAccount();

    if($account != null) {
      $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
      $expenses = $module_model->getAccountExpenses($account->id, 5);
      $stats_expenses = $module_model->getAccountExpenses($account->id);

      require 'includes/modules/expenses/views/_templates/header.php';
      require 'includes/modules/expenses/views/_templates/widget.php';
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Add Expense
  public function addExpense() {
    $account = $this->getSessionAccount();

    if($account != null) {
      if(isset($_POST['submit_add_expense'])) {
        $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
        $add_expense = $module_model->addExpense($account->id, $_POST['expense_title'], $_POST['expense_price'], $_POST['expense_date'], $_POST['expense_category']);
        if(isset($add_expense) && $add_expense != null) {
          $_SESSION['alert'] = $add_expense;
          header('location: ' . URL . 'modules/view/expenses');
        }

        header('location: ' . URL . 'modules/view/expenses');
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Edit Expense
  public function editExpense($id) {
    $account = $this->getSessionAccount();

    if($account != null) {
      if(isset($_POST['submit_edit_expense'])) {
          if($id != 1) {
            $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
            $edit_expense = $module_model->editExpense($id, $_POST['expense_title'], $_POST['expense_price'], $_POST['expense_date'], $_POST['expense_category']);
            if(isset($edit_expense) && $edit_expense != null) {
              $_SESSION['alert'] = $edit_expense;
              header('location: ' . URL . 'modules/edit/expenses/' . $id);
            }
    
            header('location: ' . URL . 'modules/edit/expenses/' . $id);
          } else {
              $_SESSION['alert'] = 'You can not edit the demo expense.';
              header('location: ' . URL . 'modules/view/expenses');
          }
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }

  // Delete Expense
  public function deleteExpense($expense_id) {
    $account = $this->getSessionAccount();
    
    if($account != null) {
      if(isset($expense_id)) {
          if($expense_id != 1) {
            $module_model = $this->loadModuleModel('expenses', 'ExpensesModel');
    
            $expense_data = $module_model->getExpenseData($expense_id);
            if($expense_data->account_id == $account->id) {
              $delete_expense = $module_model->deleteExpense($expense_id);
              if(isset($delete_expense) && $delete_expense != null) {
                $_SESSION['alert'] = $delete_expense;
                header('location: ' . URL . 'modules/view/expenses');
              }
    
              header('location: ' . URL . 'modules/view/expenses');
            } else {
              $_SESSION['alert'] = 'You do not have permission to do this.';
              header('location: ' . URL . 'modules');
            }
          } else {
              $_SESSION['alert'] = 'You can not delete the demo expense.';
              header('location: ' . URL . 'modules/view/expenses');
          }
      }
    } else {
      header('location: ' . URL . 'login');
    }
  }
    
}

?>