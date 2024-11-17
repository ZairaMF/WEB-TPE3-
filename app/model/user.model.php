<?php
class UserModel{
    //abre conexion a la base de datos
    private function connect(){
        $db = new PDO('mysql:host=localhost;dbname=viaje_tpe;charset=utf8', 'root', '');
        return $db;
    }

    //Obtiene y devuelve de la base de datos todas las tareas.
    function getUserByGmail($gmail) {
        $db = $this->connect();
        $query = $db->prepare('SELECT * FROM usuario WHERE gmail = ?');
        $query->execute([$gmail]);

        // $tasks es un arreglo de tareas
        return $query->fetch(PDO::FETCH_OBJ);

    }
} 
?>