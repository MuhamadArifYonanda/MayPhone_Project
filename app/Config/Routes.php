<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'DashboardController::index');
$routes->get('/admin', 'AdminController::index');


$routes->post('/produk/create', 'AdminController::create');
$routes->get('edit(:any)', 'AdminController::edit/$1');
$routes->post('/produk/update/(:any)', 'AdminController::update/$1');
$routes->get('/produk/delete/(:any)', 'AdminController::delete/$1');
