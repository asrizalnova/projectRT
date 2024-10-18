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

//Routes for create kk
$routes->get('/kk', 'admin\KkController::index');
$routes->get('/kk/create', 'admin\KkController::create');
$routes->post('/kk/store', 'admin\KkController::store');
$routes->get('/kk/edit/(:num)', 'admin\KkController::edit/$1');
$routes->post('/kk/update/(:num)', 'admin\KkController::update/$1');
$routes->get('/kk/delete/(:num)', 'admin\KkController::delete/$1');
