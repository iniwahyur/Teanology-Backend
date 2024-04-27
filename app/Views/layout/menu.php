<li class="side-nav-title side-nav-item">Dashboard</li>

<li class="side-nav-item">
<li class="side-nav-item">
    <a href="<?= site_url('') ?>" class="side-nav-link">
        <i class="uil-home-alt"></i>
        <span> Dashboard </span>
    </a>
</li>
</li>

<li class="side-nav-title side-nav-item">MENU</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarTasks" aria-expanded="false" aria-controls="sidebarTasks" class="side-nav-link">
        <i class="uil-clipboard-alt"></i>
        <span> Ecommerce </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarTasks">
        <ul class="side-nav-second-level">
            <li>
                <a href="<?= site_url('category') ?>">Category</a>
            </li>
            <li>
                <a href="<?= site_url('order') ?>">Order</a>
            </li>
            <li>
                <a href="<?= site_url('products') ?>">Product</a>
            </li>
            <li>
                <a href="<?= site_url('cart') ?>">Cart</a>
            </li>
        </ul>
    </div>
</li>

<li class="side-nav-item">
    <a href="<?= site_url('customers') ?>" class="side-nav-link">
        <i class="uil-users-alt"></i>
        <span> Customers </span>
    </a>
</li>

<?php if (session()->get('role_admin') == 'super_admin') { ?>
    <li class="side-nav-item">
        <a href="<?= site_url('admin') ?>" class="side-nav-link">
            <i class="uil-user"></i>
            <span> Admin </span>
        </a>
    </li>
<?php } ?>

<li class="side-nav-title side-nav-item">TESTING</li>

<li class="side-nav-item">
    <a data-bs-toggle="collapse" href="#sidebarTesting" aria-expanded="false" aria-controls="sidebarTesting" class="side-nav-link">
        <i class="uil-book-alt"></i>
        <span> Sample </span>
        <span class="menu-arrow"></span>
    </a>
    <div class="collapse" id="sidebarTesting">
        <ul class="side-nav-second-level">
            <li>
                <a href="#">Chart</a>
            </li>
            <li>
                <a href="#">Transaksi</a>
            </li>
            <li>
                <a href="#">List Product</a>
            </li>
            <li>
                <a href="#">Whistlist</a>
            </li>
        </ul>
    </div>
</li>