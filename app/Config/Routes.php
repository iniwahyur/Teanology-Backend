<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->setAutoRoute(true);

 // Membuat Database

$routes->get('create-db', function(){
    $forge = \Config\Database::forge();
    if ($forge->createDatabase('teanology')) 
    {
        echo 'Database created!';
    }
});



// Product
// $routes->get('products', 'Products::index');
// $routes->get('products/add', 'Products::create');
// $routes->post('products', 'Products::store');
// $routes->get('products/edit/(:any)', 'Products::edit/$1');
// $routes->put('products/(:any)', 'Products::update/$1');
// $routes->delete('products/(:segment)', 'Products::destroy/$1');

// Auth
$routes->group('api', function ($routes) {
$routes->post('register', 'Auth::insertCustomersApi');
});

// Category
$routes->get('category/trash', 'Category::trash');
$routes->get('category/restore/(:any)', 'Category::restore/$1');
$routes->get('category/restore/', 'Category::restore');
$routes->delete('category/delete2/(:any)', 'Category::delete2/$1');
$routes->delete('category/delete2/', 'Category::delete2');
$routes->presenter('category', ['filter' => 'isLoggedIn']);

// Products
$routes->get('api/products', 'Products::getAllProducts');
$routes->get('products/detail/(:num)', 'Products::detail/$1');
$routes->presenter('products', ['filter' => 'isLoggedIn']);
$routes->get('api/products/(:num)', 'Products::show/$1');

$routes->group('api', function ($routes) {
$routes->get('products/image/(:num)', 'Products::getImage/$1');
});






    $routes->group('api', function ($routes) {
    $routes->get('products', 'Products::readProductsApi');
    $routes->get('products/(:any)', 'Products::getProductsApi/$1');
});


// Order
$routes->presenter('order', ['filter' => 'isLoggedIn']);

// cart
$routes->group('api', function ($routes) {
    $routes->get('cart', 'Cart::readCartApi'); // GET ALL CART
    $routes->get('cart/(:any)', 'Cart::getCartApi/$1'); // GET CART BY ID
    $routes->post('insert-cart', 'Cart::insertCartApi'); // INSERT CART
    $routes->put('cart/(:num)', 'Cart::updateCartApi/$1'); // UPDATE CART
    $routes->delete('cart/(:num)', 'Cart::deleteCartApi/$1'); // DELETE CART
});

// Wishlist
$routes->presenter('wishlist', ['filter' => 'isLoggedIn']);


// Admin
$routes->presenter('admin', ['filter' => 'isLoggedIn']);

// Customers
    $routes->group('api', function ($routes) {
    $routes->get('customers', 'Customers::readCustomersApi'); // GET ALL CUSTOMERS
    $routes->get('customers/(:any)', 'Customers::getCustomersApi/$1'); // GET CUSTOMERS BY ID
    $routes->put('customers/(:num)', 'Customers::updateCustomersApi/$1'); // UPDATE CUSTOMERS
    $routes->delete('customers/(:num)', 'Customers::deleteCustomersApi/$1'); // DELETE CUSTOMERS
});


// Home
$routes->addRedirect('/', 'home');
// $routes->get('home', 'Home::index');
