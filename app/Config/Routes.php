<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'PermitController::index');
$routes->get('permit', 'PermitController::index');
$routes->post('permit/submit', 'PermitController::submit');
$routes->post('permit/status', 'PermitController::checkStatus');
$routes->get('permit/download/(:num)', 'PermitController::download/$1');
$routes->get('files/(:any)', 'PermitController::viewFile/$1');

// Admin Portal
$routes->group('nssapprover', function($routes) {
    $routes->get('/', 'AdminController::login');
    $routes->post('auth', 'AdminController::auth');
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->post('update', 'AdminController::updateStatus');
    $routes->get('logout', 'AdminController::logout');
});
