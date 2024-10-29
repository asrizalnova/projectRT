<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index'); // Default home route

// Routes for login
$routes->get('login', 'Loginctrl::index');
$routes->post('login/process', 'Loginctrl::process');
$routes->get('logout', 'Loginctrl::logout');

// Routes for the admin dashboard
$routes->get('admin/dashboard', 'admin\Dashboardctrl::index');

//Routes for kk
$routes->get('/kk', 'admin\KkController::index');
$routes->get('/kk/create', 'admin\KkController::create');
$routes->post('/kk/store', 'admin\KkController::store');
$routes->get('/kk/edit/(:num)', 'admin\KkController::edit/$1');
$routes->post('/kk/update/(:num)', 'admin\KkController::update/$1');
$routes->get('/kk/delete/(:num)', 'admin\KkController::delete/$1');

//Routes warga
$routes->get('/warga', 'admin\Wargactrl::index');
$routes->get('/warga/tambah', 'admin\Wargactrl::tambah');
$routes->post('/warga/proses_tambah', 'admin\Wargactrl::proses_tambah');
$routes->get('/warga/edit/(:num)', 'admin\Wargactrl::edit/$1');
$routes->post('/warga/proses_edit/(:num)', 'admin\Wargactrl::proses_edit/$1');
$routes->get('/warga/delete/(:num)', 'admin\Wargactrl::delete/$1');

//Routes kas
$routes->get('/kas', 'admin\kasController::index');
$routes->get('/kas/tambah', 'admin\kasController::tambah');
$routes->post('/kas/store', 'admin\kasController::store');
$routes->get('/kas/edit/(:num)', 'admin\kasController::edit/$1');
$routes->post('/kas/update/(:num)', 'admin\kasController::update/$1');
$routes->get('/kas/delete/(:num)', 'admin\kasController::delete/$1');

