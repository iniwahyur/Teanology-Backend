<?= $this->extend('layout/default') ?>

<?= $this->section('title') ?>
<title>Detail Product | Teanology</title>
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<section class="section">

    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Teanology</a></li>
                            <li class="breadcrumb-item"><a href="#">eCommerce</a></li>
                            <li class="breadcrumb-item"><a href="<?= site_url('products') ?>">Product</a></li>
                            <li class="breadcrumb-item active">Product Details</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Product Details</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-5">

                                <!-- Photo -->
                                <div class="text-center">
                                    <img src="<?= base_url('upload_product/' . $product->photo_product) ?>" class="img-fluid" style="max-width: 280px;" alt="Product-img">
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <form class="ps-lg-4">
                                    <h3 class="mt-0"><?= $product->name_product ?><i class="mdi mdi-square-edit-outline ms-2"></i></h3>
                                    <p>Added Date: <?= date('m/d/Y', strtotime($product->created_at)) ?></p>

                                    <p class="font-16">
                                        <?php
                                        $rating = $product->rating_product;
                                        $fullStars = floor($rating);
                                        $halfStar = $rating - $fullStars;
                                        $emptyStars = 5 - $fullStars - ($halfStar > 0 ? 1 : 0);

                                        // Gambar bintang penuh
                                        for ($i = 1; $i <= $fullStars; $i++) {
                                            echo '<span class="text-warning mdi mdi-star"></span>';
                                        }

                                        // Gambar setengah bintang jika diperlukan
                                        if ($halfStar > 0) {
                                            echo '<span class="text-warning mdi mdi-star-half"></span>';
                                            $emptyStars--; // Mengurangi jumlah bintang kosong untuk menampung bintang setengah
                                        }

                                        // Gambar bintang kosong dengan warna abu-abu
                                        for ($i = 1; $i <= $emptyStars; $i++) {
                                            echo '<span class="text-muted mdi mdi-star-outline"></span>';
                                        }

                                        ?>
                                    </p>

                                    <!-- Product stock -->
                                    <td>
                                        <?php
                                        $status = $product->status_product;
                                        $badge_class = '';

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

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Retail Price:</h6>
                                        <h3>Rp. <?= number_format($product->price_product, 0, ',', '.') ?></h3>
                                    </div>

                                    <!-- Quantity -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Quantity</h6>
                                        <div class="d-flex">
                                            <input type="number" min="1" value="1" class="form-control" placeholder="Qty" style="width: 90px;">
                                            <button type="button" class="btn btn-danger ms-2"><i class="mdi mdi-cart me-1"></i> Add to cart</button>
                                            <a href="https://app.sandbox.midtrans.com/payment-links/1713767831913">
                                                <button type="button" class="btn btn-info ms-2">Buy Now</button>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Product description -->
                                    <div class="mt-4">
                                        <h6 class="font-14">Description:</h6>
                                        <p><?= $product->description_product ?></p>
                                    </div>

                                    <!-- Product information -->
                                    <div class="mt-4">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h6 class="font-14">Available Stock:</h6>
                                                <p class="text-sm lh-150"><?= $product->stock_product ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Number of Orders:</h6>
                                                <p class="text-sm lh-150"><?= $product->order_count_product ?></p>
                                            </div>
                                            <div class="col-md-4">
                                                <h6 class="font-14">Revenue:</h6>
                                                <?php
                                                // Mengkonversi harga menjadi rupiah dan memformatnya
                                                $revenue = $product->order_count_product * $product->price_product;
                                                $revenue_formatted = number_format($revenue, 0, ',', '.'); // Format ke dalam format rupiah
                                                ?>
                                                <p class="text-sm lh-150">Rp <?= $revenue_formatted ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<?= $this->endSection(); ?>