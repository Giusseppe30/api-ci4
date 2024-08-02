<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/hola', 'Home::index');
$routes->get('/crear','Home::create');
$routes->resource('personas');
$routes->resource('productos');