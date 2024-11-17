<?php 
 require_once './libs/router.php';
require_once './app/controller/viaje.controller.php';
 //Incluyo controllers

$router = new Router();

#                 endopint   verbo      controller          metodo
$router->addRoute('viaje',    'GET', 'viajeApiController', 'getAll');
$router->addRoute('viaje/:id', 'GET', 'viajeApiController', 'get');

#               tareas/12
$router->route($_GET['resource'],$_SERVER ['REQUEST_METHOD']);
?>