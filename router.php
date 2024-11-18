<?php 
 require_once './libs/router.php';
require_once './app/controller/viaje.controller.php';
require_once './app/controller/categoria.controller.php';
 //Incluyo controllers

$router = new Router();

#                 endopint   verbo      controller          metodo
$router->addRoute('viajes',    'GET', 'viajeApiController', 'getAll');
$router->addRoute('viajes/:id', 'GET', 'viajeApiController', 'get');
$router->addRoute('viajes/:id', 'DELETE', 'viajeApiController', 'delete');
$router->addRoute('viajes', 'POST', 'viajeApiController', 'create');
$router->addRoute('viajes/:id', 'PUT', 'viajeApiController', 'update');
$router->addRoute('categorias',  'GET', 'categoriaApiController', 'getAll');
$router->addRoute('categorias/:id', 'GET', 'categoriaApiController', 'get');
$router->addRoute('categorias/:id', 'DELETE', 'categoriaApiController', 'delete');
$router->addRoute('categorias', 'POST', 'categoriaApiController', 'create');
$router->addRoute('categorias/:id', 'PUT', 'categoriaApiController', 'update');

$router->route($_GET['resource'],$_SERVER ['REQUEST_METHOD']);
?>