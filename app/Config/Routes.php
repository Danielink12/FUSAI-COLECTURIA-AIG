<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('Home', 'Home::index');
$routes->get('Home/cerrarSesion','Home::cerrarSesion');
$routes->get('Login','Login::index');
$routes->post('Login/loginweb','Login::loginweb');
$routes->get('Agencias','Agencias::index');
$routes->get('Agencias/vistaCrearAgencia','Agencias::vistaCrearAgencia');
$routes->post('Agencias/crearAgencia','Agencias::crearAgencia');
$routes->get('Agencias/vistaEditarAgencia/(:num)','Agencias::vistaEditarAgencia/$1');
$routes->post('Agencias/editarAgencia','Agencias::editarAgencia');
$routes->get('Agencias/activardesactivaragencia/(:num)/(:num)','Agencias::activardesactivaragencia/$1/$2');
$routes->get('Colectores','Colectores::index');
$routes->get('Colectores/vistaCrearColector','Colectores::vistaCrearColector');
$routes->post('Colectores/crearColector','Colectores::crearColector');
$routes->get('Colectores/vistaEditarColector/(:num)','Colectores::vistaEditarColector/$1');
$routes->post('Colectores/editarColector','Colectores::editarColector');
$routes->get('Colectores/activardesactivarcolector/(:num)/(:num)','Colectores::activardesactivarcolector/$1/$2');
$routes->get('TipoPago','TipoPago::index');
$routes->get('TipoPago/vistaCrearTipoPago','TipoPago::vistaCrearTipoPago');
$routes->post('TipoPago/crearTipoPago','TipoPago::crearTipoPago');
$routes->get('TipoPago/vistaEditarFormaPago/(:num)','TipoPago::vistaEditarFormaPago/$1');
$routes->post('TipoPago/editarTipoPago','TipoPago::editarTipoPago');
$routes->get('TipoPago/activardesactivarformapago/(:num)/(:num)','TipoPago::activardesactivarformapago/$1/$2');
$routes->get('FormaPago','FormaPago::index');
$routes->get('FormaPago/vistaCrearFormaPago','FormaPago::vistaCrearFormaPago');
$routes->get('FormaPago/vistaEditarFormaPago/(:num)','FormaPago::vistaEditarFormaPago/$1');
$routes->post('FormaPago/editarFormaPago','FormaPago::editarFormaPago');
$routes->post('FormaPago/crearFormaPago','FormaPago::crearFormaPago');
$routes->get('FormaPago/activardesactivarformapago/(:num)/(:num)','FormaPago::activardesactivarformapago/$1/$2');
$routes->get('Usuarios','Usuarios::index');
$routes->get('Usuarios/vistaCrearUsuario','Usuarios::vistaCrearUsuario');
$routes->post('Usuarios/crearUsuario','Usuarios::crearUsuario');
$routes->get('Usuarios/vistaEditarUsuario/(:num)','Usuarios::vistaEditarUsuario/$1');
$routes->post('Usuarios/editarUsuario','Usuarios::editarUsuario');
$routes->get('Usuarios/activardesactivarusuario/(:num)/(:num)','Usuarios::activardesactivarusuario/$1/$2');
$routes->get('Clientes','Clientes::index');
$routes->get('Clientes/vistaCrearCliente','Clientes::vistaCrearCliente');
$routes->post('Clientes/crearCliente','Clientes::crearCliente');
$routes->get('Clientes/vistaEditarCliente/(:num)','Clientes::vistaEditarCliente/$1');
$routes->post('Clientes/editarCliente','Clientes::editarCliente');
$routes->get('Pagos','Pagos::index');
$routes->get('Pagos/vistaCrearPago','Pagos::vistaCrearPago');
$routes->post('Pagos/crearPago','Pagos::crearPago');
$routes->get('Pagos/anularaplicarpago/(:num)/(:num)','Pagos::anularaplicarpago/$1/$2');
$routes->get('Pagos/getInfoC/(:any)/(:any)/(:any)','Pagos::getInfoC/$1/$2/$3');
$routes->get('Reportes/filtrosexcel','Reportes::filtrosexcel');
$routes->get('Reportes/filtrosLiquidacion','Reportes::filtrosLiquidacion');
$routes->post('Reportes/comprobacionLiquidacion','Reportes::comprobacionLiquidacion');
$routes->post('Reportes/reporteexcel','Reportes::reporteexcel');
$routes->post('Reportes/liquidacion','Reportes::liquidacion');
$routes->get('Reportes/reciboPago/(:num)/(:any)','Reportes::reciboPago/$1/$2');
$routes->get('Reportes/liquidacionPDF/(:num)','Reportes::liquidacionPDF/$1');
$routes->get('Accesos','Accesos::index');

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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
