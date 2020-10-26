<?php

class InvoicesModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Account Invoices
  public function getAccountInvoices($account_id) {
    $account_id = strip_tags($account_id);

    $sql = 'SELECT * FROM luxx_invoices WHERE account_id = :account_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':account_id' => $account_id));

    return $query->fetchAll();
  }

  // Get Invoice
  public function getInvoiceData($invoice_id) {
    $invoice_id = strip_tags($invoice_id);

    $sql = 'SELECT * FROM luxx_invoices WHERE id = :invoice_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':invoice_id' => $invoice_id));

    return $query->fetch();
  }

  // Get Invoice Contact Data
  public function getInvoiceContactData($contact_id) {
    $contact_id = strip_tags($contact_id);

    $sql = 'SELECT * FROM luxx_contacts WHERE id = :contact_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':contact_id' => $contact_id));

    return $query->fetch();
  }

  // Get Invoice Item Data
  public function getInvoiceItemData($item_id) {
    $item_id = strip_tags($item_id);

    $sql = 'SELECT * FROM luxx_invoices_items WHERE id = :item_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':item_id' => $item_id));

    return $query->fetch();
  }

  // Get Invoice Category Value
  public function getInvoiceCategoryValue($category_id) {
    $category_id = strip_tags($category_id);
    $total = 0;

    $sql = 'SELECT * FROM luxx_invoices WHERE category_id = :category_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':category_id' => $category_id));
    $invoices = $query->fetchAll();

    foreach($invoices as $invoice) {
      $total += $this->getInvoiceItemsValue($invoice->id);
    }

    return $total;

  }

  // Invoice Due Date
  public function formatInvoiceDueDate($invoice_due_date, $format) {
    $invoice_due_date = strip_tags($invoice_due_date);

    if($invoice_due_date != 0) {
      $deadline_date = date_create($invoice_due_date);
      return $deadline_date->format($format);
    } else {
      return '--';
    }
  }

  // Add Invoice
  public function addInvoice($account_id, $invoice_contact_id, $invoice_category_id, $contact_email, $contact_name, $contact_address, $contact_phone, $due_date, $vat, $invoice_logo) {
    if(!empty($account_id) && !empty($contact_name) && !empty($contact_email) && !empty($contact_address) && !empty($contact_phone) && !empty($due_date) && !empty($vat)) {
      $account_id = strip_tags($account_id);
      $contact_id = ((isset($invoice_contact_id) && $invoice_contact_id != '') ? $invoice_contact_id : 0);
      $invoice_category_id = strip_tags($invoice_category_id);
      $contact_name = strip_tags($contact_name);
      $contact_email = strip_tags($contact_email);
      $contact_address = strip_tags($contact_address);
      $contact_phone = strip_tags($contact_phone);
      $due_date = strip_tags($due_date);
      $vat = strip_tags($vat);
      $invoice_logo = ((isset($invoice_logo) && $invoice_logo['size'] != 0) ? $invoice_logo : '');

      $sql = 'INSERT INTO luxx_invoices (account_id, category_id, contact_id, contact_name, contact_email, contact_address, contact_phone, due_date, vat, paid) VALUES (:account_id, :invoice_category_id, :contact_id, :contact_name, :contact_email, :contact_address, :contact_phone, :due_date, :vat, :paid)';
      $query = $this->db->prepare($sql);
      $query->execute(array(':account_id' => $account_id, ':invoice_category_id' => $invoice_category_id, ':contact_id' => $contact_id, ':contact_name' => $contact_name, ':contact_email' => $contact_email, ':contact_address' => $contact_address, ':contact_phone' => $contact_phone, ':due_date' => $due_date, ':vat' => $vat, ':paid' => 0));

      if($invoice_logo != '') {
        $last_id = $this->db->lastInsertId();
        if($last_id != 0) {
          $invoice_dirs = 'public/application/invoices/';
          $invoice_file = $invoice_dirs . $last_id . '.png';
          if(!file_exists($invoice_file)) {
            if($invoice_logo['size'] < 500000) {
              if(move_uploaded_file($invoice_logo['tmp_name'], $invoice_file)) {
                return 'Your invoice has been added.';
              } else {
                return 'Your invoice has not been added.';
              }
            } else {
              return 'The invoice logo image file is too large.';
            }
          } else {
            return 'Invoice image logo with this ID already exists.';
          }
        } else {
          return 'Your invoice has not been added - image error.';
        }
      } else {
        return 'Your invoice has been added.';
      }
    } else {
      return 'Please fill all the input fields.';
    }
  }

  // Add Item
  public function addItem($account_id, $invoice_id, $item_title, $item_quantity, $item_price) {
    if(!empty($account_id) && !empty($invoice_id) && !empty($item_title) && !empty($item_quantity) && !empty($item_price)) {
      $account_id = strip_tags($account_id);
      $invoice_id = strip_tags($invoice_id);
      $item_title = strip_tags($item_title);
      $item_quantity = strip_tags($item_quantity);
      $item_price = strip_tags($item_price);

      $sql = 'INSERT INTO luxx_invoices_items (invoice_id, title, quantity, price) VALUES (:invoice_id, :item_title, :item_quantity, :item_price)';
      $query = $this->db->prepare($sql);
      $query->execute(array(':invoice_id' => $invoice_id, ':item_title' => $item_title, ':item_quantity' => $item_quantity, ':item_price' => $item_price));

      return 'The item has been added to the invoice.';
    } else {
      return 'Please fill all the input fields.';
    }
  }

  // Edit Item
  public function editItem($item_id, $item_title, $item_quantity, $item_price) {
    if(!empty($item_id) && !empty($item_title) && !empty($item_quantity) && !empty($item_price)) {
      $item_id = strip_tags($item_id);
      $item_title = strip_tags($item_title);
      $item_quantity = strip_tags($item_quantity);
      $item_price = strip_tags($item_price);

      $sql = 'UPDATE luxx_invoices_items SET title = :item_title, quantity = :item_quantity, price = :item_price WHERE id = :item_id';
      $query = $this->db->prepare($sql);
      $query->execute(array(':item_id' => $item_id, ':item_title' => $item_title, ':item_quantity' => $item_quantity, ':item_price' => $item_price));

      return 'The item has been edited.';
    } else {
      return 'Please fill all the input fields.';
    }
  }

  // Delete Item
  public function deleteItem($account_id, $item_id) {
    if(!empty($account_id) && !empty($item_id)) {
      $account_id = strip_tags($account_id);
      $item_id = strip_tags($item_id);

      $sql = 'DELETE FROM luxx_invoices_items WHERE id = :item_id';
      $query = $this->db->prepare($sql);
      $query->execute(array(':item_id' => $item_id));

      return 'The item has been removed from the invoice.';
    } else {
      return 'No item id provided.';
    }
  }

  // Invoice Items Value
  public function getInvoiceItemsValue($invoice_id) {
    $invoice_id = strip_tags($invoice_id);

    $sql = 'SELECT SUM(price * quantity) AS invoice_items_value FROM luxx_invoices_items WHERE invoice_id = :invoice_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':invoice_id' => $invoice_id));

    return $query->fetch()->invoice_items_value;
  }

  // Total Invoices Items Value
  public function getTotalInvoicesItemsValue($account_id, $status = null) {
    if($status != null) {
      $sql = 'SELECT SUM(ITEMS.price * ITEMS.quantity) AS total_invoices_items_value FROM luxx_invoices_items ITEMS, luxx_invoices INVOICES WHERE ITEMS.invoice_id = INVOICES.id AND INVOICES.account_id = :account_id AND INVOICES.status = :status';
      $query = $this->db->prepare($sql);
      $query->execute(array(':account_id' => $account_id, ':status' => $status));

      return $query->fetch()->total_invoices_items_value;
    } else {
      $sql = 'SELECT SUM(ITEMS.price * ITEMS.quantity) AS total_invoices_items_value FROM luxx_invoices_items ITEMS, luxx_invoices INVOICES WHERE ITEMS.invoice_id = INVOICES.id AND INVOICES.account_id = :account_id';
      $query = $this->db->prepare($sql);
      $query->execute(array(':account_id' => $account_id));

      return $query->fetch()->total_invoices_items_value;
    }
  }

  // Invoice Items
  public function getInvoiceItems($invoice_id) {
    $invoice_id = strip_tags($invoice_id);

    $sql = 'SELECT * FROM luxx_invoices_items WHERE invoice_id = :invoice_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':invoice_id' => $invoice_id));

    return $query->fetchAll();
  }

  // Edit Invoice
  public function editInvoice($invoice_id, $contact_id, $category_id, $contact_name, $contact_email, $contact_address, $contact_phone, $due_date, $vat, $paid, $invoice_logo) {
    if(!empty($invoice_id) && (!empty($contact_id) || $contact_id == 0) && !empty($contact_name) && !empty($contact_email) && !empty($contact_address) && !empty($contact_phone) && !empty($due_date) && !empty($vat)) {
      $invoice_id = strip_tags($invoice_id);
      $contact_id = strip_tags($contact_id);
      $category_id = strip_tags($category_id);
      $contact_name = strip_tags($contact_name);
      $contact_email = strip_tags($contact_email);
      $contact_address = strip_tags($contact_address);
      $contact_phone = strip_tags($contact_phone);
      $due_date = strip_tags($due_date);
      $vat = strip_tags($vat);
      $paid = ($paid == 1 ? strip_tags($paid) : 0);
      $invoice_logo = ((isset($invoice_logo) && $invoice_logo['size'] != 0) ? $invoice_logo : '');

      $sql = 'UPDATE luxx_invoices SET contact_id = :contact_id, category_id = :category_id, contact_name = :contact_name, contact_email = :contact_email, contact_address = :contact_address, contact_phone = :contact_phone, due_date = :due_date, vat = :vat, paid = :paid WHERE id = :invoice_id';
      $query = $this->db->prepare($sql);
      $query->execute(array(':contact_id' => $contact_id, ':category_id' => $category_id, ':contact_name' => $contact_name, ':contact_email' => $contact_email, ':contact_address' => $contact_address, ':contact_phone' => $contact_phone, ':due_date' => $due_date, ':vat' => $vat, ':paid' => $paid, ':invoice_id' => $invoice_id));

      if($invoice_logo != '') {
        $invoice_dirs = 'public/application/invoices/';
        $invoice_file = $invoice_dirs . $invoice_id . '.png';
        if($invoice_logo['size'] < 500000) {
          if(move_uploaded_file($invoice_logo['tmp_name'], $invoice_file)) {
            return 'Your invoice has been updated.';
          } else {
            return 'Your invoice has not been updated.';
          }
        } else {
          return 'The invoice logo image file is too large.';
        }
      } else {
        return 'Your invoice has been updated.';
      }
    } else {
      return 'Please fill all the input fields.';
    }
  }

  // Pay Invoice
  public function payInvoice($account_id, $invoice_id) {
    if(!empty($account_id) && !empty($invoice_id)) {
      $account_id = strip_tags($account_id);
      $invoice_id = strip_tags($invoice_id);

      //
    } else {
      return 'No invoice id provided.';
    }
  }

  // Download Invoice
  public function downloadInvoice($invoice_id) {
    $invoice_id = strip_tags($invoice_id);

    $sql = 'SELECT * FROM luxx_invoices WHERE id = :invoice_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':invoice_id' => $invoice_id));

    return $query->fetch();
  }

  // Delete Invoice
  public function deleteInvoice($invoice_id) {
    if(!empty($invoice_id)) {
      $invoice_id = strip_tags($invoice_id);
      
      $sql = 'DELETE FROM luxx_invoices WHERE id = :invoice_id';
      $query = $this->db->prepare($sql);
      $query->execute(array(':invoice_id' => $invoice_id));

      $this->_deleteInvoiceImage('public/application/invoices/' . $invoice_id . '.png');

      $sql_delete_items = 'DELETE FROM luxx_invoices WHERE invoice_id = :invoice_id';
      $query_delete_items = $this->db->prepare($sql_delete_items);
      $query_delete_items->execute(array(':invoice_id' => $invoice_id));

      return 'The invoice has been deleted.';
    } else {
      return 'No invoice id provided.';
    }
  }

  private function _deleteInvoiceImage($file) {
    $_delete_invoice_image = unlink($file);

    if($_delete_invoice_image == true) {
      return true;
    } else {
      return false;
    }
  }

}

?>