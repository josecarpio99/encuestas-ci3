<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['survey/(:any)'] = 'survey/index';
$route['encuestas/(:num)/preguntas/agregar'] = 'preguntas/agregar/$1/';
$route['encuestas/(:num)/preguntas/(:num)/editar'] = 'preguntas/editar/$1/$2';
$route['encuestas/(:num)/preguntas/(:num)/eliminar'] = 'preguntas/eliminar/$1/$2';
$route['encuestas/(:num)/preguntas'] = 'encuestas/preguntas/$1/';
$route['encuestas/(:num)/responsables/agregar'] = 'encuestaResponsable/agregar/$1';

$route['encuestas/(:num)/getResponsables'] = 'encuestaResponsable/getResponsables/$1';
$route['encuestas/(:num)/responsables'] = 'encuestaResponsable/index/$1';
$route['encuestas/(:num)/responsables/(:num)/eliminar'] = 'encuestaResponsable/eliminar/$1/$2';

$route['encuestas/mostrar'] = 'encuestaCliente/mostrarEncuestasClientes';
$route['encuestas/clientes'] = 'encuestaCliente/getClientesDeEncuesta';
$route['encuestas/(:num)/clientes'] = 'encuestaCliente/getClientesDeEncuesta/$1';
$route['encuestas/(:num)/cliente/(:num)'] = 'encuestaCliente/mostrarRespuestasDeCliente/$1/$2';
$route['encuestas/(:num)/cliente/(:num)/editar'] = 'encuestaCliente/saveEncuestaCliente/$1/$2';
$route['encuestas/(:num)/cliente/(:num)/guardar'] = 'encuestaCliente/saveEncuestaCliente/$1/$2';
$route['encuestas/(:num)/cliente/(:num)/eliminar'] = 'encuestaCliente/eliminar/$1/$2';




$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
