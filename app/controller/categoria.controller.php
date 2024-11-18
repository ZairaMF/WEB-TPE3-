<?php
require_once './app/model/categoria.model.php';
require_once './app/view/json.view.php';

class categoriaApiController{
    private $model;
    private $view;

    public function __construct(){
        $this->model = new categoriaModel();
        $this->view = new JSONView();
    }

    public function getAll($req, $res){
        $categorias = $this->model->getCategorias();

        return $this->view->response($categorias);
    }

    public function get($req, $res){
        $ID_categoria = $req->params->id;

        $categoria = $this->model->verCategoriaById($ID_categoria);
        if(!$categoria){
            return $this->view->response("La categoria con el id= $ID_categoria no existe", 404);
        }
        return $this->view->response($categoria);
    }

    public function delete($req, $res){
        $ID_categoria = $req->params->id;
        $categoria = $this->model->getCategorias();
        if(!$categoria){
            return $this->view->response("La categoria con el id= $ID_categoria no existe", 404);
        }
        $this->model->borrarCategoria($ID_categoria);
        return $this->view->response("La categoria con el id= $ID_categoria se elimino con exito", 200);

    }

    public function create($req, $res){
        if(empty($req->body['temporada']) || empty($req->body['empresa']) || empty($req->body['comodidad'])){
            return $this->view->response("Falta completar los campos", 400);
        }

        $temporada = $req->body['temporada'];
        $empresa = $req->body['empresa'];
        $comodidad = $req->body['comodidad'];

        $ID_categoria = $this->model->agregarCategoria($temporada, $empresa, $comodidad);
        if(!$ID_categoria){
            return $this->view->response("La categoria fue creado con éxito con id=$ID_categoria", 201);
           }else{
            return $this->view->response("Error al crear la categoria=$ID_categoria", 500);
           }
    }

    public function update($req,$res){
        $ID_categoria = $req->params->id;
     
          $categoria = $this->model->getCategorias();
     
          if(!$categoria){
           return $this->view->response("La categoria con el id= $ID_categoria no existe" , 404);
          }

          if(empty($req->body['temporada']) || empty($req->body['empresa']) || empty($req->body['comodidad'])){
            return $this->view->response("Falta completar los campos", 400);
        }

        $temporada = $req->body['temporada'];
        $empresa = $req->body['empresa'];
        $comodidad = $req->body['comodidad'];

        $this->model->editarCategoria($ID_categoria, $temporada, $empresa, $comodidad);
         $categoria = $this->model->getViajesByCategoriaId($ID_categoria);
         $this->view->response($categoria, 200);
       }
}
?>