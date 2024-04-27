<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Update Admin | Teanology</title>
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
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Update</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Update Admin</h4>
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

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-sm-4">
                                <a href="<?= site_url('admin') ?>" class="btn btn-success mb-2 me-1">
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
                                        <form action="<?= site_url('admin/update/' . $admin->id_admin) ?>" method="post" autocomplete="off" enctype="multipart/form-data">
                                            <?= csrf_field() ?>

                                            <div class="mb-3">
                                                <label for="simpleinput" class="form-label">Name Admin</label>
                                                <input type="text" id="simpleinput" class="form-control" name="name_admin" value="<?= $admin->name_admin ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailaddress" class="form-label">Email admin</label>
                                                <input class="form-control" type="email" id="email_admin" name="email_admin" value="<?= $admin->email_admin ?>" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-fileinput" class="form-label">Photo</label>
                                                <input type="file" id="example-fileinput" class="form-control" name="photo_admin">
                                            </div>

                                            <div class="mb-3">
                                                <label for="example-select" class="form-label">Role</label>
                                                <select class="form-select" id="example-select" name="role_admin" required>
                                                    <option value="super_admin" <?=$admin->role_admin == 'super_admin' ? 'selected' : ''?>>Super Admin</option>
                                                    <option value="admin" <?=$admin->role_admin == 'admin' ? 'selected' : ''?>>Admin</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <div class="input-group input-group-merge">
                                                    <input type="password" id="password_admin" class="form-control" name="password_admin" placeholder="Enter new password">
                                                    <div class="input-group-text" data-password="false">
                                                        <span class="password-eye"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div>
                                                <button type="submit" class="btn btn-success"><i class="mdi mdi-send"></i>Save</button>
                                                <button type="reset" class="btn btn-secondary">Reset</button>
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