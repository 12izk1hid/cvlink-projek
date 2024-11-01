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

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->post('/ceklogin', 'Home::ceklogin');

$routes->get('/home', 'Home::index');
$routes->get('/admin', 'Admin::index');

// $routes->get('/infoleveluser', 'Admin::leveluser');
// $routes->post('/simpanleveluser', 'Admin::simpanleveluser');
// $routes->post('/updateleveluser', 'Admin::updateleveluser');

$routes->get('/infokategori', 'Admin::kategori');
$routes->post('/simpankategori', 'Admin::simpankategori');
$routes->post('/updatekategori', 'Admin::updatekategori');
$routes->post('/hapuskategori', 'Admin::hapuskategori');

$routes->get('/infojasa', 'JasaController::index');                 // Menampilkan daftar jasa
$routes->post('jasa/save', 'JasaController::simpanjasa');        // Menyimpan data jasa
$routes->post('jasa/update', 'JasaController::updatejasa');        // Mengupdate data jasa
$routes->get('jasa/delete', 'JasaController::delete');          // Menghapus data jasa


$routes->get('infousers', 'UserController::index');
$routes->post('save', 'UserController::save');
$routes->post('update', 'UserController::update');
$routes->get('delete', 'UserController::delete');

$routes->get('client', 'ClientDashboardController::index');

$routes->get('infosurvei', 'SurveiController::index');
$routes->post('survey/save', 'SurveiController::save');
$routes->post('survey/edit', 'SurveiController::update');
$routes->get('survei/delete', 'SurveiController::delete');

$routes->get('infokontrak', 'KontrakController::index');
$routes->post('kontrak/save', 'KontrakController::save');
$routes->post('kontrak/edit', 'KontrakController::update');
$routes->get('kontrak/delete', 'KontrakController::delete');

$routes->get('infoinvoice', 'InvoiceController::index');
$routes->post('invoice/save', 'InvoiceController::save');
$routes->post('invoice/update', 'InvoiceController::update');
$routes->get('invoice/delete', 'InvoiceController::delete');

$routes->get('infopemasangan', 'PemasanganController::index');
$routes->post('pemasangan/save', 'PemasanganController::save');
$routes->post('pemasangan/edit', 'PemasanganController::update');
$routes->get('pemasangan/delete', 'PemasanganController::delete');

$routes->get('/infouser', 'Admin::user');
$routes->post('/simpanuser', 'Admin::simpanuser');
$routes->post('/updateuser', 'Admin::updateuser');

$routes->get('/client/dashboard', 'ClientDashboardController::index', ['filter' => 'clientOnly']);


// $routes->get('/infojabatan', 'Admin::jabatan');
// $routes->post('/simpanjabatan', 'Admin::simpanjabatan');
// $routes->post('/updatejabatan', 'Admin::updatejabatan');

$routes->get('/infonomorakun', 'Admin::nomorakun');
$routes->get('/shownomorakun', 'Admin::shownomorakun');
$routes->post('/simpannomorakun', 'Admin::simpannomorakun');
$routes->post('/updatenomorakun', 'Admin::updatenomorakun');

$routes->get('/infoinvoice', 'Admin::invoice');
$routes->post('/simpaninvoice', 'Admin::simpaninvoice');
$routes->get('/detailinvoice/(:num)', 'Admin::detailinvoice/$1');
$routes->post('/simpaninvoicedetail', 'Admin::simpaninvoicedetail');
$routes->post('/hapusinvoicedetail', 'Admin::hapusinvoicedetail');
$routes->post('/cetakinvoice', 'Admin::cetakinvoice');

$routes->get('/infocashbank', 'Admin::cashbank');
$routes->post('/simpancashbank', 'Admin::simpancashbank');
$routes->post('/simpansaldoawalbulan', 'Admin::simpansaldoawalbulan');

// $routes->get('/infopayable', 'Admin::payable');
// $routes->post('/simpanpayable', 'Admin::simpanpayable');

// $routes->get('/inforeceivable', 'Admin::receivable');
// $routes->post('/simpanreceivable', 'Admin::simpanreceivable');

//laporan

$routes->get('/infojurnal', 'Admin::jurnal');
$routes->post('/cetakjurnal', 'Admin::cetakjurnal');

$routes->get('logout', 'Home::logout');

// $routes->post('/ceklogin', 'Home::ceklogin');
// $routes->get('/logout', 'Home::logout');

// $routes->get('/admin', 'Admin::index');
// $routes->get('/infoleveluser', 'Admin::leveluser');
// $routes->post('/simpanleveluser', 'Admin::simpanleveluser');
// $routes->post('/updateleveluser', 'Admin::updateleveluser');



// $routes->get('(nama yang di panggil di controller/ menu)', 'Admin::(nama fungsi yang akan di baca di controller Admin)');

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
