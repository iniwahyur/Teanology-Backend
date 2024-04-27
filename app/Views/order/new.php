<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>New Order | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Teanology</a></li>
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
                            <li class="breadcrumb-item"><a href="#">Order</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Order</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('order') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-arrow-left"></i>
                                </a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <form action="<?= site_url('order') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <?= csrf_field() ?>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Cart</label>
                                                <select class="form-select" id="example-select" name="id_cart" required>
                                                    <option value="" hidden></option>
                                                    <?php foreach ($cart as $key => $value) : ?>
                                                        <option value="<?= $value->id_cart ?>"><?= $value->id_customer ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Method Payment</label>
                                                <select class="form-select" id="example-select" name="method_payment_order" required>
                                                    <option value="mastercard">Mastercard</option>
                                                    <option value="visa">Visa</option>
                                                    <option value="paypal">Paypal</option>
                                                    <option value="credit_card">Credit Card</option>
                                                    <option value="payoneer">Payoneer</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Status Payment</label>
                                                <select class="form-select" id="example-select" name="status_payment_order" required>
                                                    <option value="paid">Paid</option>
                                                    <option value="awaiting_authorization">Awaiting Authorization</option>
                                                    <option value="payment_failed">Payment Failed</option>
                                                    <option value="cash_on_delivery">COD</option>
                                                    <option value="fulfilled">Fulfilled</option>
                                                    <option value="unfulfilled">Unfulfilled</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Status Order</label>
                                                <select class="form-select" id="example-select" name="status_order" required>
                                                    <option value="shipped">Shipped</option>
                                                    <option value="processing">Processing</option>
                                                    <option value="delivered">Delivered</option>
                                                    <option value="cancelled">Cancelled</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="total-price-order" class="form-label">Total Price Order</label>
                                                <input type="text" class="form-control" id="total-price-order" name="total_price_order" readonly>
                                            </div>


                                            <div class="mb-3">
                                                <label for="example-textarea" class="form-label">Address</label>
                                                <textarea class="form-control" id="example-textarea" rows="5" name="address_shipping_order" required></textarea>
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>Save</button>
                                                <button type="reset" class="btn btn-secondary">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
</section>
<?= $this->endSection(); ?>