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
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');

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
$routes->presenter('cart', ['filter' => 'isLoggedIn']);

// Wishlist
$routes->presenter('wishlist', ['filter' => 'isLoggedIn']);


// Admin
$routes->presenter('admin', ['filter' => 'isLoggedIn']);

// Customers
$routes->presenter('customers', ['filter' => 'isLoggedIn']);


// Home
$routes->addRedirect('/', 'home');
// $routes->get('home', 'Home::index');
