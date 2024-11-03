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

// client
$routes->get('client', 'ClientController::index');
$routes->get('client/order', 'ClientController::order');
$routes->get('client/profile', 'ClientController::profile');
$routes->post('client/order/save', 'ClientController::saveOrder');

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

// survey
$routes->get('infosurvei', 'SurveiController::index');
$routes->post('survey/save', 'SurveiController::save');
$routes->post('survey/edit', 'SurveiController::update');
$routes->get('survei/delete', 'SurveiController::delete');

// kontrak
$routes->get('infokontrak', 'KontrakController::index');
$routes->post('kontrak/save', 'KontrakController::save');
$routes->post('kontrak/edit', 'KontrakController::update');
$routes->get('kontrak/delete', 'KontrakController::delete');

// invoice
$routes->get('infoinvoice', 'InvoiceController::index');
$routes->post('invoice/save', 'InvoiceController::save');
$routes->post('invoice/update', 'InvoiceController::update');
$routes->get('invoice/delete', 'InvoiceController::delete');

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
