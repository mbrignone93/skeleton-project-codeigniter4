<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// rutas modulo controlador de errores
$routes->get('/error/404', 'Error\ErrorController::error404');
$routes->get('/error/403', 'Error\ErrorController::error403');

// rutas modulo controlador de autenticacion
$routes->get('/', 'Auth\AuthController::index');
$routes->post('/auth/login', 'Auth\AuthController::login');
$routes->get('/auth/logout', 'Auth\AuthController::logout');
$routes->post('/auth/changePassword', 'Auth\AuthController::changePassword');
$routes->post('/auth/resetPassword', 'Auth\AuthController::resetPassword');

// ruta menu principal
$routes->get('/menu', 'Menu\MenuController::index');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
