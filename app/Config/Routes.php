<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
//$routes->get('/', 'Portal::AdminLogin');
$routes->get('/', 'Shop::Index');
$routes->get('/product/(:segment)', 'Shop::detail/$1');
$routes->get('/product', 'Shop::ProductList');
$routes->get('/mycart', 'Shop::Cart');
$routes->post('/checkout', 'Shop::Checkout');
$routes->get('/order-placed/(:segment)', 'Shop::OrderPlaced/$1');

$routes->get('/myorder', 'Shop::MyOrder');
$routes->get('/myorder/(:segment)', 'Shop::MyOrderDetail/$1');

$routes->get('/login', 'Portal::CustomerLogin');
$routes->get('/admin/login', 'Portal::AdminLogin');
$routes->get('/seller/login', 'Portal::SellerLogin');
$routes->get('/register', 'Portal::CustomerRegister');
$routes->get('/seller/register', 'Portal::SellerRegister');

$routes->get('/myaccount', 'Shop::MyAccount');
$routes->post('/myaccount/profile/update', 'Shop::updateProfile');
$routes->post('/myaccount/address/update', 'Shop::updateAddress');
$routes->post('/myaccount/address/add', 'Shop::addAddress');

$routes->post('/create-account', 'Portal::addCustomer');
$routes->post('/seller/create-account', 'Portal::addSeller');

$routes->get('/dashboard-admin', 'Home::Index');
$routes->get('/dashboard-seller', 'Home::Seller');

$routes->post('/login/authseller', 'Portal::authenticationSeller');
$routes->post('/login/authadmin', 'Portal::authenticationAdmin');
$routes->post('/login/authcustomer', 'Portal::authenticationCustomer');
$routes->get('/logout', 'Portal::logout');

$routes->get('/profile', 'UserLogin::profile');
$routes->get('/profile/edit', 'UserLogin::editModeProfile');
$routes->post('/profile/save', 'UserLogin::updateProfile');


/**
 * 
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
