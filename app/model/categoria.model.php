<?php
class categoriaModel{
    private $db;
    public function __construct(){
        $this->db = new PDO('mysql:host=localhost;dbname=viaje_tpe;charset=utf8', 'root', '');
    }
    
//Traer la DB completa fetchAll
public function getViaje() {
   $query = $this->db->prepare('SELECT * FROM viaje');
   $query->execute();
   //Obtengo todos los datos que arroja la query
  $viaje = $query->fetchAll(PDO::FETCH_OBJ);
  return $viaje;
}
//Obtengo viaje por ID
public function getViajeById($ID_viaje) {
   $query = $this->db->prepare('SELECT * FROM viaje WHERE ID_viaje = ?');
   $query->execute([$ID_viaje]);
   $viaje = $query->fetch(PDO::FETCH_OBJ);
   return $viaje;
}

public function getCategorias(){
   $query = $this->db->prepare('SELECT * FROM categoria');
   $query->execute();
   $categorias = $query->fetchAll(PDO::FETCH_OBJ);
   return $categorias;
}

public function verCategoriaById($ID_categoria){
   $query = $this->db->prepare('SELECT * FROM categoria WHERE id = ?');
   $query->execute([$ID_categoria]);      
   $categoria = $query->fetch(PDO::FETCH_OBJ);    
   return $categoria;
}  

    //insertar a la DB 
    public function agregarCategoria($temporada, $empresa, $comodidad = null) { 
        $query = $this->db->prepare('INSERT INTO categoria(temporada, empresa, comodidad) VALUES (?, ?, ?)');
        $query->execute([$temporada, $empresa, $comodidad]);    
        $ID_categoria= $this->db->lastInsertId(); 
        return $ID_categoria;
    }
    
    

  
    public function editarCategoria( $ID_categoria, $temporada, $empresa, $comodidad) { 
        $query = $this->db->prepare('UPDATE categoria SET `temporada` = ?, `empresa` = ?, `comodidad` = ? WHERE `id` = ?');
        $query->execute([$temporada, $empresa, $comodidad, $ID_categoria]);  // Los parámetros están en el orden correcto
    }
    
    
    
    // borrar de la DB
    public function borrarCategoria($ID_categoria){
        $query = $this->db->prepare('DELETE FROM categoria WHERE id = ?');
        $query->execute([$ID_categoria]);
    }

        // Obtener los viajes asociados a una categoría
public function getViajesByCategoriaId($ID_categoria) {
    $query = $this->db->prepare('SELECT * FROM viaje WHERE id = ?');
    $query->execute([$ID_categoria]);
    $viajes = $query->fetchAll(PDO::FETCH_OBJ);
    return $viajes;
}
}