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
    public function getAll($req, $res) {
      $viajes = $this->model->getViaje();  // Obtienes los viajes de la base de datos
      return $this->view->response($viajes); 
  }

  //api/viaje/id
  public function get($req, $res){
    //obtengo el id de la tarea desde la ruta 
    $ID_viaje = $req->params->id;

    //obtengo la tarea de la db
    $viaje= $this->model->getViajeById($ID_viaje);
    if (!$viaje){
      return $this->view->response("El viaje con el id= $ID_viaje no existe" , 404);
    }
    //mando la tarea a la vista
    return $this->view->response($viaje);
  }

  //api/viajes/:id
   public function delete($req, $res){
     $ID_viaje = $req->params->id;

     $viaje = $this->model->getViaje();

     if(!$viaje){
      return $this->view->response("El viaje con el id= $ID_viaje no existe" , 404);
     }
     $this->model->deleteViaje($ID_viaje);
     return $this->view->response("Los viajes con el id= $ID_viaje se elimino con exito", 200);

   }

   //api/viajes (POST)
   public function create($req, $res){
    // Verifica si los campos requeridos están presentes
    if(empty( $req->body->Fecha) || empty($req->body->Hora) || 
       empty($req->body->Origen) || empty($req->body->Destino) || 
       empty($req->body->id)) {
        return $this->view->response("Falta completar los campos", 400);
    }

    $fecha = $req->body->Fecha;
    $hora = $req->body->Hora;
    $origen = $req->body->Origen;
    $destino = $req->body->Destino;
    $ID_categoria = $req->body->id;  

    // Verificar que la categoría si existe antes de insertar el viaje
      $categoria = $this->model->verCategoriaById($ID_categoria);
      if (!$categoria) {
          return $this->view->response("La categoría con el id=$ID_categoria no existe", 404);
      }
    // Llamar al modelo para agregar el nuevo viaje
   $ID_viaje =  $this->model->agregarViaje($fecha, $hora, $origen, $destino, $ID_categoria);

    // Responder con un mensaje de éxito
     if(!$ID_viaje){
      return $this->view->response("El viaje fue creado con éxito con id=$ID_viaje", 201);
     }else{
      return $this->view->response("Error al crear el viaje=$ID_viaje", 500);
     }
}

//api/viajes/:id (PUT)
  public function update($req,$res){
   $ID_viaje = $req->params->id;

     $viaje = $this->model->getViaje();

     if(!$viaje){
      return $this->view->response("El viaje con el id= $ID_viaje no existe" , 404);
     }

       
  }
    
   }
  
  ?>