<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Products | Teanology</title>
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
                            <li class="breadcrumb-item active">Products</li>
                        </ol>
                    </div>
                    <h4 class="page-title"></h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('products/new') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add Products
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <!-- <button type="button" class="btn btn-light mb-2 me-1">Import</button>
                                    <button type="button" class="btn btn-light mb-2">Export</button> -->
                                    <button type="button" class="btn btn-light mb-2 me-1 mdi mdi-lock-off">Locked</button>
                                    <button type="button" class="btn btn-light mb-2 mdi mdi-lock-off">Locked</button>
                                </div>
                            </div>
                        </div>

                        <?php if (session()->getFlashdata('success')) : ?>
                            <div class="alert alert-success alert-dismissible show data">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <b>Success !</b>
                                    <?= session()->getFlashdata('success') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('error')) : ?>
                            <div class="alert alert-danger alert-dismissible show data">
                                <div class="alert-body">
                                    <button class="close" data-dismiss="alert">x</button>
                                    <b>Success !</b>
                                    <?= session()->getFlashdata('error') ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="table-responsive">
                            <div id="products-datatable_wrapper" class="dataTables_wrapper dt-bootstrap">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="table-responsive">
                                        <table id="selection-datatable" class="table dt-responsive nowrap w-100">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Photo</th>
                                                    <th>Name Product</th>
                                                    <th>Category</th>
                                                    <th>Price</th>
                                                    <th>Stock</th>
                                                    <th>Count Order</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($products as $key =>  $value) : ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td>
                                                            <?php if (!empty($value->photo_product)) : ?>
                                                                <a href="<?= site_url('products/detail/' . $value->id_product) ?>" class="text-center d-block mb-4">
                                                                    <img src="<?= base_url('upload_product/' . $value->photo_product) ?>" class="img-fluid" style="height:100px" alt="Product-img">
                                                                </a>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $value->name_product ?></td>
                                                        <td><?= $value->name_category ?></td>
                                                        <td>Rp. <?= $value->price_product ?></td>
                                                        <td><?= $value->stock_product ?></td>
                                                        <td><?= $value->order_count_product ?></td>
                                                        <td>
                                                            <?php
                                                            $status = $value->status_product;
                                                            $badge_class = '';
                                                            $status_text = '';

                                                            switch ($status) {
                                                                case 'active':
                                                                    $badge_class = 'bg-success';
                                                                    $status_text = 'Active';
                                                                    break;
                                                                case 'inactive':
                                                                    $badge_class = 'bg-danger';
                                                                    $status_text = 'Deactive';
                                                                    break;
                                                                case 'out_of_stock':
                                                                    $badge_class = 'bg-warning';
                                                                    $status_text = 'Out of Stock';
                                                                    break;
                                                            }
                                                            ?>

                                                            <span class="badge <?= $badge_class ?>">
                                                                <?= $status_text ?>
                                                            </span>
                                                        </td>

                                                        <td class="table-action">
                                                            <a href="<?= site_url('products/edit/' . $value->id_product) ?>" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                                            <form action="<?= site_url('products/delete/' . $value->id_product) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                                <?= csrf_field() ?>
                                                                <button class="action-icon" style="background: none; border: none;">
                                                                    <i class="mdi mdi-delete"></i>
                                                                </button>
                                                            </form>

                                                        </td>
                                                    </tr>
                                                </tbody>
                                            <?php endforeach; ?>
                                        </table>
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