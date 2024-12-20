<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// Landing Page and Auth
$routes->get('/', 'ClientController::index');
$routes->get('login', 'Home::login');
$routes->post('ceklogin', 'Home::ceklogin');
$routes->get('register', 'Home::register');
$routes->post('register/save', 'Home::save');
$routes->get('logout', 'Home::logout');

// Barang
$routes->get('barang', 'BarangController::index'); // Menampilkan data barang
$routes->post('barang/save', 'BarangController::save'); // Menyimpan data barang
$routes->get('barang/delete/(:num)', 'BarangController::delete/$1'); // Menghapus data barang
$routes->post('barang/update', 'BarangController::update');

// Paket Layanan
$routes->get('paketlayanan', 'PaketLayananController::index');
$routes->get('paketlayanan/detail/(:num)', 'PaketLayananController::detail/$1');
$routes->get('paketlayanan/create', 'PaketLayananController::create');
$routes->post('paketlayanan/store', 'PaketLayananController::store');
$routes->get('paketlayanan/edit/(:num)', 'PaketLayananController::edit/$1');  // Menampilkan form edit
$routes->post('paketlayanan/update/(:num)', 'PaketLayananController::update/$1'); // Menangani update
$routes->get('paketlayanan/delete/(:num)', 'PaketLayananController::delete/$1');
$routes->post('paketlayanan/save', 'PaketLayananController::save');


//service
$routes->get('services', 'ServiceController::index');
$routes->post('services/save', 'ServiceController::save');
$routes->post('services/update', 'ServiceController::update');
$routes->get('uploads/(:segment)', 'ImageController::showImage/$1');
$routes->get('service/delete/(:num)', 'ServiceController::delete/$1');

// client
$routes->get('client', 'ClientController::index');
$routes->get('client/order', 'ClientController::order');
$routes->get('client/invoice', 'ClientController::invoice');
$routes->get('invoice/print/(:num)', 'InvoiceController::print/$1');
$routes->get('client/profile', 'ClientController::profile');
$routes->post('client/order/save', 'ClientController::saveOrder');
$routes->post('client/order/checkout', 'ClientController::checkout');
$routes->get('client/invoice/print/(:num)', 'ClientController::generateInvoice/$1');
$routes->post('/barang/get-by-service', 'ClientController::getBarangByServiceAjax');
$routes->get('images/(:any)', 'ImageController::show/$1');

// admin dashboard
$routes->get('admin', 'AdminController::index');



// jasa
$routes->get('/infojasa', 'JasaController::index');
$routes->post('jasa/save', 'JasaController::simpanjasa');
$routes->post('jasa/update', 'JasaController::updatejasa');
$routes->get('jasa/delete', 'JasaController::delete');

// user
$routes->get('infousers', 'UserController::index');
$routes->post('save', 'UserController::save');
$routes->post('update', 'UserController::update');
$routes->get('delete', 'UserController::delete');

// // survey
// $routes->get('infosurvei', 'SurveiController::index');
// $routes->post('survey/save', 'SurveiController::save');
// $routes->post('survey/edit', 'SurveiController::update');
// $routes->get('survei/delete', 'SurveiController::delete');

// kontrak
$routes->get('infokontrak', 'KontrakController::index');
$routes->post('kontrak/save', 'KontrakController::save');
$routes->post('kontrak/edit', 'KontrakController::update');
$routes->get('kontrak/delete', 'KontrakController::delete');

// invoice
$routes->get('infoinvoice', 'InvoiceController::index');
// $routes->post('invoice/save', 'InvoiceController::save');
// $routes->post('invoice/update', 'InvoiceController::update');
// $routes->get('invoice/delete', 'InvoiceController::delete');
$routes->get('evidence/(:any)', 'EvidenceController::getImage/$1');
$routes->get('invoice/accept/(:num)', 'InvoiceController::accept/$1');
$routes->get('invoice/reject/(:num)', 'InvoiceController::reject/$1');


// pemasangan
$routes->get('infopemasangan', 'PemasanganController::index');
$routes->post('pemasangan/save', 'PemasanganController::save');
$routes->post('pemasangan/edit', 'PemasanganController::update');
$routes->get('pemasangan/delete', 'PemasanganController::delete');

/*
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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
