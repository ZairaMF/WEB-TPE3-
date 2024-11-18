<?php 
 require_once './libs/router.php';
require_once './app/controller/viaje.controller.php';
 //Incluyo controllers

$router = new Router();

#                 endopint   verbo      controller          metodo
$router->addRoute('viajes',    'GET', 'viajeApiController', 'getAll');
$router->addRoute('viajes/:id', 'GET', 'viajeApiController', 'get');
$router->addRoute('viajes/:id', 'DELETE', 'viajeApiController', 'delete');
$router->addRoute('viajes', 'POST', 'viajeApiController', 'create');
$router->addRoute('viajes/:id', 'PUT', 'viajeApiController', 'update');

$router->route($_GET['resource'],$_SERVER ['REQUEST_METHOD']);
?>