<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Beranda::index');

$routes->get('login', 'Login::index');
$routes->post('login/process', 'Login::process');
$routes->get('logout', 'Login::logout');

$routes->get('kk', 'KkController::View');
$routes->post('/kk/store', 'KkController::store');
$routes->get('/kk/edit/(:num)', 'KkController::edit/$1');
$routes->post('/kk/update/(:num)', 'KkController::update/$1');
$routes->get('/kk/delete/(:num)', 'KkController::delete/$1');


$routes->get('kas', 'KasController::index');
$routes->post('kas/store', 'KasController::store');
$routes->get('kas/edit/(:num)', 'KasController::edit/$1'); // Route untuk mengambil data berdasarkan id
$routes->post('kas/update/(:num)', 'KasController::update/$1');
$routes->delete('kas/delete/(:num)', 'KasController::delete/$1');

$routes->get('iuran', 'IuranController::index');
$routes->post('iuran/store', 'IuranController::store');
$routes->get('iuran/edit/(:num)', 'IuranController::edit/$1'); // Route untuk mengambil data berdasarkan id
$routes->post('iuran/update/(:num)', 'IuranController::update/$1');
$routes->delete('iuran/delete/(:num)', 'IuranController::delete/$1');
