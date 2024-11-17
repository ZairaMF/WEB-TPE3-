<?php
require_once './app/model/viaje.model.php';
require_once './app/view/json.view.php';

class viajeApiController
{
  private $model;
  private $view;

  public function __construct()
  {
    $this->model = new ViajeModel();
    $this->view = new JSONView();
  }
  public function mostrarViajes($req, $res) {
    $viajes = $this->model->getViaje();  // Obtienes los viajes de la base de datos
   
    
    return $this->view->response($viajes); 
}

//api/viaje/id
public function get($req, $res){
   //obtengo el id de la tarea desde la ruta 
   $ID_viaje = $req->params->ID_viaje;

   //obtengo la tarea de la db
   $viaje= $this->model->getViajeById($ID_viaje);

   //mando la tarea a la vista
   return $this->view->response($viaje);
}


}
?>