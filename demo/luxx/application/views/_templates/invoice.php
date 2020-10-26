<style>
@page {
    margin: 70px;
}
body {
    font-family: montserrat;
}

/* Grid */
.row {
    width: 100%;
}
.text-right {
    text-align: right;
}
.text-left {
    text-align: left;
}

/* Download Invoice */
.download-invoice-box {
    position: relative;
    background-color: #fff;
    margin: 0px;
    width: 100%;
}
.download-invoice-box-header {

}
.download-invoice-box-title {
    color: #484848;
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 19px;
    padding-top: 50px;
}
.download-invoice-box-details {
    padding-top: 50px;
}
.download-invoice-box-subtitle {
    color: #484848;
    font-weight: bold;
    letter-spacing: 0.2px;
    font-size: 14px;
    margin-bottom: 10px;
}
.download-invoice-box-text {
    color: #989898;
    font-weight: 600;
    letter-spacing: 0.2px;
    font-size: 12px;
}
.download-invoice-box-text div {
    display: block;
}
.download-invoice-box-text div span {
    color: #484848;
}
.download-invoice-box-items {
    padding-bottom: 50px;
}
.download-invoice-box-items-header {
    
}
.download-invoice-box-line {
    height: 1px;
    background-color: #dfdfdf;
}
.download-invoice-box-items-title {
    color: #989898;
    font-weight: 600;
    letter-spacing: 0.2px;
    font-size: 10px;
}
.download-invoice-box-items-text {
    color: #484848;
    font-weight: 600;
    letter-spacing: 0.2px;
    font-size: 12px;
}
.download-invoice-box-item {
    
}
.download-invoice-box-footer {
    padding-bottom: 70px;
}
.footer-text {
    font-size: 21px;
}
.footer-total {
    color: #7674ff;
    font-size: 22px;
    font-weight: bold;
}
.download-invoice-box-item.footer-info {
    margin-bottom: 0px;
}
</style>
<div class="download-invoice-box">
    <div class="download-invoice-box-header">
        <div class="row">
            <columns column-count="2" />
                <div class="col-3">
                    <div class="download-invoice-box-image">
                        <img src="<?php echo URL; ?>public/img/luxx-logo.png" width="128" height="128">
                    </div>
                </div>
            <newcolumn />
                <div class="col-9">
                    <div class="download-invoice-box-title">INVOICE #<?php echo $invoice->id; ?></div>
                </div>
            <columns column-count="1" />
        </div>
    </div>
    <div class="download-invoice-box-details">
        <div class="row">
            <columns column-count="2" />
                <div class="col-6 text-left">
                    <div class="download-invoice-box-subtitle"><?php echo $invoice->contact_name; ?></div>
                    <div class="download-invoice-box-text">
                        <div>E-mail: <span><?php echo $invoice->contact_email; ?></span></div>
                        <div>Address: <span><?php echo $invoice->contact_address; ?></span></div>
                        <div>Phone: <span><?php echo $invoice->contact_phone; ?></span></div>
                    </div>
                </div>
            <newcolumn />
                <div class="col-6 text-right">
                    <div class="download-invoice-box-subtitle"><?php echo INVOICE_NAME; ?></div>
                    <div class="download-invoice-box-text">
                        <div>E-mail: <span><?php echo INVOICE_EMAIL; ?></span></div>
                        <div>Address: <span><?php echo INVOICE_ADDRESS; ?></span></div>
                        <div>Phone: <span><?php echo INVOICE_PHONE; ?></span></div>
                    </div>
                </div>
            <columns column-count="1" /> 
        </div>
    </div>
    <div class="download-invoice-box-items">
        <div class="download-invoice-box-items-header">
            <div class="row">
                <columns column-count="3" />
                    <div class="col-6 text-left">
                        <div class="download-invoice-box-items-title">DESCRIPTION</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-title">QUANTITY</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-title">PRICE</div>
                    </div>
                <columns column-count="1" />
                    <div class="col-12">
                        <div class="download-invoice-box-line"></div>
                    </div>
                <columns column-count="1" />
            </div>
        </div>
        <div class="download-invoice-box-items-rows">
            <?php if(count($invoice_items) > 0): ?>
                <?php foreach($invoice_items as $invoice_item): ?>
                    <div class="download-invoice-box-item">
                        <div class="row">
                            <columns column-count="3" />
                                <div class="col-6 text-left">
                                    <div class="download-invoice-box-items-text"><?php echo $invoice_item->title; ?></div>
                                </div>
                            <newcolumn />
                                <div class="col-3 text-right">
                                    <div class="download-invoice-box-items-text"><?php echo $invoice_item->quantity; ?></div>
                                </div>
                            <newcolumn />
                                <div class="col-3 text-right">
                                    <div class="download-invoice-box-items-text"><?php echo CURRENCY_SYMBOL . $invoice_item->price; ?></div>
                                </div>
                            <columns column-count="1" />
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="download-invoice-box-item">
                    <div class="row">
                        <columns column-count="3" />
                            <div class="col-6 text-left">
                                <div class="download-invoice-box-items-text">-</div>
                            </div>
                        <newcolumn />
                            <div class="col-3 text-right">
                                <div class="download-invoice-box-items-text">-</div>
                            </div>
                        <newcolumn />
                            <div class="col-3 text-right">
                                <div class="download-invoice-box-items-text">-</div>
                            </div>
                        <columns column-count="1" />
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </div>
    <div class="download-invoice-box-footer">
        <div class="download-invoice-box-items-header">
            <div class="row">
                <columns column-count="4" />
                    <div class="col-6 text-left">
                        <div class="download-invoice-box-items-title">BASIC INFORMATIONS</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-title">QUANTITY</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-title">VAT</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-title">TOTAL</div>
                    </div>
                <columns column-count="1" />
                    <div class="col-12">
                        <div class="download-invoice-box-line footer-line"></div>
                    </div>
                <columns column-count="1" />
            </div>
        </div>
        <div class="download-invoice-box-item footer-info">
            <div class="row">
                <columns column-count="4" />
                    <div class="col-6 text-left">
                        <div class="download-invoice-box-text">
                            <div>Total items: <span><?php echo count($invoice_items); ?></span></div>
                            <div>Due date: <span><?php echo $invoice->due_date; ?></span></div>
                        </div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-text"><?php echo $total_quantity; ?></div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-text"><?php echo $invoice->vat; ?>%</div>
                    </div>
                <newcolumn />
                    <div class="col-3 text-right">
                        <div class="download-invoice-box-items-text footer-text footer-total"><?php echo CURRENCY_SYMBOL . ($invoice_items_value > 0 ? (((19 * $invoice_items_value) / 100) + $invoice_items_value) : 0); ?></div>
                    </div>
                <columns column-count="1" />
            </div>
        </div>
    </div>
</div>