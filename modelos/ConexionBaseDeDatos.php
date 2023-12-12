<?php

namespace AmigoInvisible\modelos;

use \PDO;
use \PDOException;
use MongoDB\Client;

class ConexionBaseDeDatos
{

    private $conexion;

    public function __construct()
    {

        $this->conexion = (new Client('mongodb://root:toor@mongo4:27017'))->examen;
    }


    /**
     * Get the value of conexion
     */
    public function getConexion()
    {
        return $this->conexion;
    }

    public function cerrarConexion()
    {
        $this->conexion = null;
    }
}
