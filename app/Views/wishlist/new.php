<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>New Products | Teanology</title>
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
                            <li class="breadcrumb-item"><a href="#">Products</a></li>
                            <li class="breadcrumb-item active">New</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Add Products</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('wishlist') ?>" class="btn btn-success mb-2 me-1">
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
                                        <form action="<?= site_url('wishlist') ?>" method="post" autocomplete="off">
                                            <?= csrf_field() ?>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Name Customer</label>
                                                <select class="form-select" id="example-select" name="id_customer" required onchange="showLastName()">
                                                    <option value="" hidden></option>
                                                    <?php foreach ($customers as $key => $value) : ?>
                                                        <option value="<?= $value->id_customer ?>" data-lastname="<?= $value->last_name_customer ?>"><?= $value->first_name_customer ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="last-name" class="form-label">Last Name Customer</label>
                                                <input type="text" class="form-control" id="last-name" name="last_name_customer" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Products</label>
                                                <select class="form-select" id="example-select" name="id_product" required>
                                                    <option value="" hidden></option>
                                                    <?php foreach ($products as $key => $value) : ?>
                                                        <option value="<?= $value->id_product ?>"><?= $value->name_product ?></option>
                                                    <?php endforeach; ?>
                                                </select>
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