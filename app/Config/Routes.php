<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/login', 'LoginController::validar');

$routes->get('/forgot', 'LoginController::forgot');
$routes->get('/restablecer/(:any)', 'LoginController::restablecer/$1');
$routes->post('/forgot', 'LoginController::reset');
$routes->put('/restablecer', 'LoginController::updateClave');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {
    $routes->get('/admin', 'AdminController::index');
        $routes->get('/admin/usuario', 'AdminController::usuario');
        $routes->get('/admin/newusuario', 'AdminController::newusuario');
        $routes->get('/admin/newcarpeta', 'AdminController::newcarpeta');
        $routes->get('/admin/newarchivo', 'AdminController::newarchivo');

    $routes->resource('/usuarios', ['controller' => 'UsuarioController']);
    $routes->resource('/carpetas', ['controller' => 'CarpetaController']);

    $routes->get('/archivos/busqueda', 'ArchivoController::busqueda');
    $routes->get('/archivos/usuarios/(:num)', 'ArchivoController::usuarios/$1');
    $routes->get('/archivos/show/(:num)', 'ArchivoController::show/$1');
    $routes->get('/archivos/(:num)/share', 'ArchivoController::share/$1');
    $routes->post('/archivos/upload', 'ArchivoController::upload');
    $routes->post('/archivos/compartir', 'ArchivoController::compartir');
    $routes->delete('/archivos/(:num)', 'ArchivoController::delete/$1');

    $routes->get('/folder/busqueda', 'CarpetaController::busqueda');
    $routes->get('/folder/usuarios/(:num)', 'CarpetaController::usuarios/$1');
    $routes->get('/folder/(:num)/share', 'CarpetaController::share/$1');
    $routes->post('/folder/compartir', 'CarpetaController::compartir');

    //CARPETAS COMPARTIDAS
    $routes->get('/carpcompartidas', 'CompartidoController::carpeta');
    $routes->get('/carpcompartidas/(:num)/detalle', 'CompartidoController::detcarpeta/$1');

    //ARCHIVOS COMPARTIDAS
    $routes->get('/archcompartidas', 'CompartidoController::archivo');
    $routes->get('/archcompartidas/detarchivo', 'CompartidoController::detarchivo');

    $routes->get('/perfil', 'PerfilController::index');
    $routes->put('/perfil', 'PerfilController::updatePerfil');
    $routes->put('/updatePassword', 'PerfilController::updatePassword');

    $routes->get('/logout', 'LoginController::logout');
});