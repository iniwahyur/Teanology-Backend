<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Data Admin | Teanology</title>
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
                            <li class="breadcrumb-item active">Admin</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Admin</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('admin/new') ?>" class="btn btn-success mb-2 me-1">
                                    <i class="mdi mdi-plus-circle me-2"></i>
                                    Add Admin
                                </a>
                            </div>
                            <div class="col-sm-8">
                                <div class="text-sm-end">
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
                                                    <th>Profile</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Role</th>
                                                    <th>Last Updated</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <?php foreach ($admin as $key =>  $value) : ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?= $key + 1 ?></td>
                                                        <td>
                                                            <?php if (!empty($value->photo_admin)) : ?>
                                                                <img style="height: 100px" src="<?= base_url('uploads/' . $value->photo_admin) ?>" alt="Admin Photo">
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= $value->name_admin ?></td>
                                                        <td><?= $value->email_admin ?></td>
                                                        <td>
                                                            <?php
                                                            $status = $value->role_admin;
                                                            $badge_class = '';
                                                            $status_text = '';

                                                            switch ($status) {
                                                                case 'super_admin':
                                                                    $badge_class = 'bg-success';
                                                                    $status_text = 'Super Admin';
                                                                    break;
                                                                case 'admin':
                                                                    $badge_class = 'bg-primary';
                                                                    $status_text = 'Admin';
                                                                    break;
                                                            }
                                                            ?>
                                                            <span class="badge <?= $badge_class ?>">
                                                                <?= $status_text ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $value->updated_at ?></td>
                                                        <td class="table-action">
                                                            <a href="<?= site_url('admin/edit/' . $value->id_admin) ?>" class="action-icon"> <i class="mdi mdi-pencil btn btn-warning mb-2 text-white"></i></a>
                                                            <form action="<?= site_url('admin/delete/' . $value->id_admin) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin hapus data?')">
                                                                <?= csrf_field() ?>
                                                                <button class="action-icon" style="background: none; border: none;">
                                                                    <i class="mdi mdi-delete btn btn-danger mb-2"></i>
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