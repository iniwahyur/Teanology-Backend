<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Trash Category | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">
    <div class="container-fluid">

        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= site_url('home') ?>">Teanology</a></li>
                            <li class="breadcrumb-item"><a href="#">Menu</a></li>
                            <li class="breadcrumb-item active">Category</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Trash Category</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('category') ?>" class="btn btn-success mb-2 me-1">
                                    <span class="mdi mdi-arrow-left"> Back</span>
                                </a>
                            </div>

                            <div class="col-sm-8">
                                <div class="text-sm-end">
                                    <a href="<?= site_url('category/restore') ?>" class="btn btn-primary mb-2 me-1">
                                        <i class="mdi mdi-delete-restore"></i>
                                        Restore All
                                    </a>
                                    <form action="<?= site_url('category/delete2') ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                        <?= csrf_field() ?>
                                        <button class="action-icon" style="background: none; border: none;">
                                            <span class="btn btn-danger mb-2 mdi mdi-trash-can-outline">Delete Permanent</span>
                                        </button>
                                    </form>

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
                                                        <th>Nama Category</th>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <?php foreach ($category as $key =>  $value) : ?>
                                                    <tbody>
                                                        <tr>
                                                            <td><?= $key + 1 ?></td>
                                                            <td><?= $value->photo_category ?></td>
                                                            <td><?= $value->name_category ?></td>
                                                            <td><?= $value->description_category ?></td>
                                                            <td class="table-action">
                                                                <a href="<?= site_url('category/restore/' . $value->id_category) ?>" class="action-icon"> <span class="btn btn-primary mb-2 text-white mdi mdi-delete-restore"></span></a>
                                                                <form action="<?= site_url('category/delete2/' . $value->id_category) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                                    <?= csrf_field() ?>
                                                                    <button class="action-icon" style="background: none; border: none;">
                                                                        <span class="btn btn-danger mb-2 mdi mdi-trash-can"></span>
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