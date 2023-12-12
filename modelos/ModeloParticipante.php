<?php

namespace AmigoInvisible\modelos;

use AmigoInvisible\modelos\ConexionBaseDeDatos;
use AmigoInvisible\modelos\Participante;

class ModeloParticipante
{
    public static function getParticiapanteById($idParticipante)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->participantes->findOne(["id" => intval($idParticipante)]);

        $participante = null;

        if (isset($resultado["id"])) {
            $participante = new Participante($resultado["id"], $resultado["email"], $resultado["nombre"], $resultado["telefono"]);
        }

        $conexionObjet->cerrarConexion();

        return $participante;
    }

    public static function addParticipante($participante)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();



        //Ordeno por id, y me quedo con el mayor
        $resultadoMayor = $conexion->participantes->findOne(
            [],
            [
                'sort' => ['id' => -1],
            ]
        );
        if (isset($resultadoMayor))
            $idValue = $resultadoMayor['id'];
        else
            $idValue = 0;



        $consulta = $conexion->participantes->insertOne([
            'id' => intval($idValue + 1),
            'email' => $participante->getEmail(),
            'nombre' => $participante->getNombre(),
            'telefono' => $participante->getTelefono(),


        ]);

        $conexionObjet->cerrarConexion();

        return $idValue + 1;
    }

    public static function getParticipanteByNameEmail($busqueda)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultados = $conexion->participantes->find(['$or' => ['nombre' => $busqueda], ['email'] => $busqueda]);

        $participantes = [];

        foreach ($resultados as $resultado) {
            $participante = new Participante($resultado["id"], $resultado["email"], $resultado["nombre"], $resultado["telefono"]);
            array_push($participantes, $participante);
        }


        $conexionObjet->cerrarConexion();

        return $participantes;
    }
}
