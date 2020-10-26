<div class="container-fluid content">

  <!-- Add new invoice -->
  <div class="row">
    <div class="col-lg-6">
      <div class="section">
        <div class="text c-gray m-bottom-10">New invoice</div>
        <div class="box b-white p-all-30">
          <h3 class="project-title c-title m-bottom-30">Add new invoice</h3>
          <form action="<?php echo URL; ?>invoices/addinvoice" method="post" enctype="multipart/form-data">
            <input type="hidden" name="invoice_contact_id" <?php echo ($contact_id != null ? 'value="' . $contact_id . '"' : ''); ?>>
            <?php if(count($invoice_categories) > 0): ?>
              <div class="form-input-box">
                <div class="caption c-text m-bottom-5">Category</div>
                <select name="invoice_category_id" class="text c-text">
                  <option value="" selected="selected" disabled="disabled">Select the invoice category</option>
                    <?php foreach($invoice_categories as $invoice_category): ?>
                      <option value="<?php echo $invoice_category->id; ?>"><?php echo $invoice_category->title; ?></option>
                    <?php endforeach; ?>
                </select>
              </div>
            <?php else: ?>
              <input type="hidden" name="invoice_category_id" value="0">
            <?php endif; ?>
            <div class="form-input-box">
              <div class="caption c-text m-bottom-5">Invoice contact e-mail</div>
              <input type="email" name="invoice_contact_email" placeholder="Enter the invoice contact e-mail" class="text c-text" <?php echo ($contact_email != '' ? 'value="' . $contact_email . '"' : ''); ?>>
            </div>
            <div class="form-input-box">
              <div class="caption c-text m-bottom-5">Invoice contact name</div>
              <input type="text" name="invoice_contact_name" placeholder="Enter the invoice contact name" class="text c-text" <?php echo ($contact_name != '' ? 'value="' . $contact_name . '"' : ''); ?>>
            </div>
            <div class="form-input-box">
              <div class="caption c-text m-bottom-5">Invoice contact phone</div>
              <input type="text" name="invoice_contact_phone" placeholder="Enter the invoice contact phone" class="text c-text" <?php echo ($contact_phone != '' ? 'value="' . $contact_phone . '"' : ''); ?>>
            </div>
            <div class="form-input-box">
              <div class="caption c-text m-bottom-5">Invoice contact address</div>
              <input type="text" name="invoice_contact_address" placeholder="Enter the invoice contact address" class="text c-text" <?php echo ($contact_address != '' ? 'value="' . $contact_address . '"' : ''); ?>>
            </div>
            <div class="row">
              <div class="col-lg-6">
                <div class="form-input-box">
                  <div class="caption c-text m-bottom-5">Due date</div>
                  <input type="text" name="invoice_due_date" placeholder="Enter the invoice due date" class="text c-text" id="addInvoiceDueDateDatepicker">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="form-input-box">
                  <div class="caption c-text m-bottom-5">VAT (%)</div>
                  <input type="text" name="invoice_vat" placeholder="Enter the invoice VAT" class="text c-text">
                </div>
              </div>
            </div>
            <div class="form-input-box">
              <div class="caption c-text m-bottom-5">Invoice logo  (optional)</div>
              <input type="file" name="invoice_logo" class="text c-text">
            </div>
            <div class="form-button">
              <button type="submit" name="submit_add_invoice" class="btn b-secondary c-primary btn-block">Add invoice</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="col-lg-6"></div>
  </div>

</div>