<?php

namespace AmigoInvisible\modelos;

use AmigoInvisible\modelos\ConexionBaseDeDatos;
use AmigoInvisible\modelos\AmigoInvisible;

class ModeloAmigoInvisible
{
    //saca todos los amigos invibles posteriores a hoy
    public static function getAmigosInvisibles()
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $valores = $conexion->amigosinvisibles->find(
            ['fecha' => ['$gte' => date("Y-m-d")]],
            [
                'sort' => ['fecha' => 1]
            ]
        );

        $AmigosInvisiblesArray = [];



        foreach ($valores as $valor) {

            $amigoInvisble = new AmigoInvisible($valor["id"], $valor["nombre"], $valor["estado"], $valor["maximoDinero"], $valor["fecha"], $valor["lugar"], $valor["observaciones"], $valor["emoji"]);

            array_push($AmigosInvisiblesArray, $amigoInvisble);
        }

        $conexionObjet->cerrarConexion();

        return $AmigosInvisiblesArray;
    }

    //añade un nuevo AI
    public static function addAmigoInvisible($amigoInvisble)
    {

        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();



        //Ordeno por id, y me quedo con el mayor
        $resultadoMayor = $conexion->amigosinvisibles->findOne(
            [],
            [
                'sort' => ['id' => -1],
            ]
        );
        if (isset($resultadoMayor))
            $idValue = $resultadoMayor['id'];
        else
            $idValue = 0;

        $consulta = $conexion->amigosinvisibles->insertOne([
            'id' => intval($idValue + 1),
            'nombre' => $amigoInvisble->getNombre(),
            'estado' => $amigoInvisble->getEstado(),
            'maximoDinero' => intval($amigoInvisble->getMaximoDinero()),
            'fecha' => $amigoInvisble->getFecha(),
            'lugar' => $amigoInvisble->getLugar(),
            'observaciones' => $amigoInvisble->getObservaciones(),
            'emoji' => $amigoInvisble->getEmoji()

        ]);

        $conexionObjet->cerrarConexion();
    }

    //borrar AI por id
    public static function deteleAmigoInvibleById($idAmigoInvisible)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $consulta = $conexion->amigosinvisibles->deleteOne(['id' => intval($idAmigoInvisible)]);

        $conexionObjet->cerrarConexion();
    }

    //buscar AI por id
    public static function getAmigoInvisbleById($idAmigoInvisible)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();

        $resultado = $conexion->amigosinvisibles->findOne(["id" => intval($idAmigoInvisible)]);

        $amigoInvisble = null;

        if (isset($resultado["id"])) {
            $amigoInvisble = new AmigoInvisible($resultado["id"], $resultado["nombre"], $resultado["estado"], $resultado["maximoDinero"], $resultado["fecha"], $resultado["lugar"], $resultado["observaciones"], $resultado["emoji"]);
        }

        $conexionObjet->cerrarConexion();

        return $amigoInvisble;
    }

    //modifica AI
    public static function updateAmigoInvisible($amigoInvisble)
    {
        $conexionObjet = new ConexionBaseDeDatos();
        $conexion = $conexionObjet->getConexion();


        $consulta = $conexion->amigosinvisibles->updateOne(
            ['id' => intval($amigoInvisble->getId())],
            [
                '$set' => [
                    'id' => intval($amigoInvisble->getId()),
                    'nombre' => $amigoInvisble->getNombre(),
                    'estado' => $amigoInvisble->getEstado(),
                    'maximoDinero' => intval($amigoInvisble->getMaximoDinero()),
                    'fecha' => $amigoInvisble->getFecha(),
                    'lugar' => $amigoInvisble->getLugar(),
                    'observaciones' => $amigoInvisble->getObservaciones(),
                    'emoji' => $amigoInvisble->getEmoji()
                ]
            ]
        );

        $conexionObjet->cerrarConexion();
    }
}
