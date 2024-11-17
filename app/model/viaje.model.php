<?php

 class ViajeModel {
    private $db;

        public function __construct() {
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
        $categoria = $query->fetchAll(PDO::FETCH_OBJ);
        return $categoria;
    }
    
    public function verCategoriaById($ID_categoria){
        $query = $this->db->prepare('SELECT * FROM categoria WHERE id = ?');
        $query->execute([$ID_categoria]);      
        $categoria = $query->fetch(PDO::FETCH_OBJ);    
        return $categoria;
    }  
     //Agregar Viaje
    public function agregarViaje($fecha, $hora, $origen, $destino, $ID_categoria) {
        $query = $this->db->prepare('INSERT INTO viaje(Fecha, Hora, Origen, Destino, id) VALUES (?, ?, ?, ?, ?)');
        $query->execute([$fecha, $hora, $origen, $destino, $ID_categoria]);
        $ID_viaje = $this->db->lastInsertId(); 
        return $ID_viaje;
    }

  //Editar viaje
    public function editarViaje($fecha, $hora, $origen, $destino, $ID_categoria, $ID_viaje) {
        $query = $this->db->prepare('UPDATE viaje SET `Fecha` = ?, `Hora` = ?, `Origen` = ?, `Destino` = ?, id = ? WHERE `ID_viaje` = ?');
        $query->execute([$fecha, $hora, $origen, $destino, $ID_categoria, $ID_viaje]);
    }

    // Eliminar viaje
    public function deleteViaje($ID_viaje) {
        $query = $this->db->prepare('DELETE FROM viaje WHERE ID_viaje = ?');
        $query->execute([$ID_viaje]);
    }
}
    ?>