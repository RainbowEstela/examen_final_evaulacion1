<?php

namespace AmigoInvisible\modelos;

use AmigoInvisible\modelos\ConexionBaseDeDatos;

class ModeloRelacion
{
    public static function getParticipantesByIdAmigoInvisible($idAmigoInvisible)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->relaciones->find(["idAmigoInvisible" => intval($idAmigoInvisible)]);

        $idJugadores = [];

        foreach ($resultado as $relacion) {
            array_push($idJugadores, [
                "idParticiapante" => $relacion["idParticipante"],
                "estado" => $relacion["estado"]
            ]);
        }

        return $idJugadores;
    }

    public static function deleteRelacionByidParticiapanteIdAmigoInvisible($idParticipante, $idAmigoInvisible)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->relaciones->deleteOne(['idAmigoInvisible' => intval($idAmigoInvisible), 'idParticipante' => intval($idParticipante)]);

        $conexionObjet->cerrarConexion();
    }

    public static function addRelacion($idAmigoInvisible, $idParticipante, $estado)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->relaciones->insertOne([
            'idAmigoInvisible' => intval($idAmigoInvisible),
            'idParticipante' => intval($idParticipante),
            'estado' => $estado
        ]);

        $conexionObjet->cerrarConexion();
    }

    public static function getEstado($idAmigoInvisible, $idParticipante)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->relaciones->findOne(["idAmigoInvisible" => intval($idAmigoInvisible), "idParticipante" => intval($idParticipante)]);

        $estado = "";

        if (isset($resultado["estado"])) {
            $estado = $resultado["estado"];
        }

        $conexionObjet->cerrarConexion();

        return $estado;
    }

    public static function updateEstado($idAmigoInvisible, $idParticipante, $estado)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();


        $consulta = $conexion->relaciones->updateOne(
            ['idAmigoInvisible' => intval($idAmigoInvisible), 'idParticipante' => intval($idParticipante)],
            [
                '$set' => [
                    'idAmigoInvisible' => intval($idAmigoInvisible),
                    'idParticipante' => intval($idParticipante),
                    'estado' => $estado
                ]
            ]
        );

        $conexionObjet->cerrarConexion();
    }
}
