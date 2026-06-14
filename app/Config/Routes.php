<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

// ===== Module Routes =====
require APPPATH . 'Module/Pasien/Config/Routes.php';
