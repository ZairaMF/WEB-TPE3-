<?php

    class JSONView {
        public function response($data, $status = 200) { //Rendereriza objeto en formato json
            header("Content-Type: application/json"); //Busca json para el status que le demos osea 200 en este caso
            $statusText = $this->_requestStatus($status);
            header("HTTP/1.1 $status $statusText");
            echo json_encode($data); // Codifica como un json el recurso y lo imprime, va a ser como view ponele
        }

        private function _requestStatus($code) {
            $status = array(
                200 => "OK",
                201 => "Created",
                204 => "No Content",
                400 => "Bad Request",
                401 => "Unauthorized",
                404 => "Not Found",
                500 => "Internal Server Error"
            );
            if(!isset($status[$code])) {
                $code = 500;
            }
            return $status[$code];
        }
    }
