<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('admin', 'Beranda::index');

$routes->get('login', 'Login::index');
$routes->post('login/process', 'Login::process');
$routes->get('logout', 'Login::logout');

$routes->get('admin/user', 'UserController::index');
$routes->post('admin/user/store', 'UserController::store');
$routes->get('admin/user/edit/(:num)', 'UserController::edit/$1');
$routes->post('admin/user/update/(:num)', 'UserController::update/$1');
$routes->delete('admin/user/delete/(:num)', 'UserController::delete/$1');
$routes->post('admin/user/changePassword/(:num)', 'UserController::changePassword/$1');

$routes->get('admin/kk', 'KkController::View');
$routes->post('admin/kk/store', 'KkController::store');
$routes->get('admin/kk/edit/(:num)', 'KkController::edit/$1');
$routes->post('admin/kk/update/(:num)', 'KkController::update/$1');
$routes->delete('admin/kk/delete/(:num)', 'KkController::delete/$1');

$routes->get('admin/warga', 'WargaController::index');
$routes->post('admin/warga/store', 'WargaController::store');
$routes->get('admin/warga/edit/(:num)', 'WargaController::edit/$1');
$routes->post('admin/warga/update/(:num)', 'WargaController::update/$1');
$routes->delete('admin/warga/delete/(:num)', 'WargaController::delete/$1');

$routes->get('admin/kas', 'KasController::index');
$routes->post('admin/kas/store', 'KasController::store');
$routes->get('admin/kas/edit/(:num)', 'KasController::edit/$1'); // Route untuk mengambil data berdasarkan id
$routes->post('admin/kas/update/(:num)', 'KasController::update/$1');
$routes->delete('admin/kas/delete/(:num)', 'KasController::delete/$1');

$routes->get('admin/iuran', 'IuranController::index');
$routes->post('admin/iuran/store', 'IuranController::store');
$routes->get('admin/iuran/edit/(:num)', 'IuranController::edit/$1'); // Route untuk mengambil data berdasarkan id
$routes->post('admin/iuran/update/(:num)', 'IuranController::update/$1');
$routes->delete('admin/iuran/delete/(:num)', 'IuranController::delete/$1');

$routes->get('admin/pengeluaran', 'PengeluaranController::index');
$routes->post('admin/pengeluaran/store', 'PengeluaranController::store');
$routes->get('admin/pengeluaran/edit/(:num)', 'PengeluaranController::edit/$1'); // Route untuk mengambil data berdasarkan id
$routes->post('admin/pengeluaran/update/(:num)', 'PengeluaranController::update/$1');
$routes->delete('admin/pengeluaran/delete/(:num)', 'PengeluaranController::delete/$1');
