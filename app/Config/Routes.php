<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

// Auth
$routes->get('/', '\App\Modules\Auth\Controllers\AuthController::login');
$routes->get('/login', '\App\Modules\Auth\Controllers\AuthController::login');
$routes->post('/login', '\App\Modules\Auth\Controllers\AuthController::authenticate');
$routes->get('/logout', '\App\Modules\Auth\Controllers\AuthController::logout');

// Protected routes (apply 'auth' filter)
$routes->group('', ['filter' => 'auth'], function($routes) {
    $routes->resource('pasien', ['namespace' => 'App\Modules\Pasien\Controllers', 'controller' => 'PasienController']);
    $routes->resource('dokter', ['namespace' => 'App\Modules\Dokter\Controllers', 'controller' => 'DokterController']);
    $routes->resource('poli', ['namespace' => 'App\Modules\Poli\Controllers', 'controller' => 'PoliController']);
    $routes->resource('pendaftaran', ['namespace' => 'App\Modules\Pendaftaran\Controllers', 'controller' => 'PendaftaranController']);
    $routes->get('laporan', '\App\Modules\Laporan\Controllers\LaporanController::index', ['filter' => 'admin']);
    $routes->get('laporan/export-pdf', '\App\Modules\Laporan\Controllers\LaporanController::exportPdf', ['filter' => 'admin']);
});

