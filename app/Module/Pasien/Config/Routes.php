<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->group('pasien', ['namespace' => 'App\Module\Pasien\Controllers'], static function ($routes) {
    $routes->get('/', 'PasienController::index');
    $routes->get('create', 'PasienController::create');
    $routes->post('store', 'PasienController::store');
    $routes->get('(:num)', 'PasienController::show/$1');
    $routes->get('(:num)/edit', 'PasienController::edit/$1');
    $routes->post('(:num)/update', 'PasienController::update/$1');
    $routes->post('(:num)/delete', 'PasienController::delete/$1');
});
