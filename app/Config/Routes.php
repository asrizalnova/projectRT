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