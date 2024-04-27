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
                                <a href="<?= site_url('products') ?>" class="btn btn-success mb-2 me-1">
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
                                        <form action="<?= site_url('products') ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <?= csrf_field() ?>
                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Name</label>
                                                <input type="text" id="simpleinput" class="form-control" name="name_product" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Category</label>
                                                <select class="form-select" id="example-select" name="id_category" required>
                                                    <option value="" hidden></option>
                                                    <?php foreach ($category as $key => $value) : ?>
                                                        <option value="<?= $value->id_category ?>"><?=$value->name_category?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-textarea" class="form-label">Description</label>
                                                <textarea class="form-control" id="example-textarea" rows="5" name="description_product" required></textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Rating</label>
                                                <input type="text" id="simpleinput" class="form-control" name="rating_product" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Price</label>
                                                <input class="form-control" id="example-number" type="number" name="price_product" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Stock</label>
                                                <input class="form-control" id="example-number" type="number" name="stock_product" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-number" class="form-label">Order Count</label>
                                                <input class="form-control" id="example-number" type="number" name="order_count_product" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Status</label>
                                                <select class="form-select" id="example-select" name="status_product" required>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">Deactive</option>
                                                    <option value="out_of_stock">Out of Stock</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Photo</label>
                                                <input type="file" id="example-fileinput" class="form-control" name="photo_product" required autofocus>
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