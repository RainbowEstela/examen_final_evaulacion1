<?php

namespace AmigoInvisible\controladores;

use AmigoInvisible\modelos\ModeloAmigoInvisible;
use AmigoInvisible\modelos\ModeloParticipante;
use AmigoInvisible\modelos\ModeloRelacion;
use AmigoInvisible\vistas\VistaDetalles;
use AmigoInvisible\vistas\VistaMenuPrincipal;
use AmigoInvisible\vistas\VistaModificarAmigoInvisible;
use AmigoInvisible\vistas\VistaModificarParticipante;

class ControladorAmigoInvisible
{
    //muestra los amigos invisibles
    public static function mostrarAmigosInvisibles()
    {
        //pedir los amigos invisibles
        $amigosInvisbles = ModeloAmigoInvisible::getAmigosInvisibles();

        //pasarlos a la vista
        VistaMenuPrincipal::render($amigosInvisbles);
    }

    //añade un amigo invisible a la base de datos
    public static function addAmigoInvisible($amigoInvisble)
    {
        //meter amigo invisible a la base de datos
        ModeloAmigoInvisible::addAmigoInvisible($amigoInvisble);

        //volver a mostrar pagina principal
        header("Location: index.php");
        die;
    }

    //borra un amigo invisible por id
    public static function deteleAmigoInvisible($idAmigoInvisible)
    {
        //borramos de la base de datos
        ModeloAmigoInvisible::deteleAmigoInvibleById($idAmigoInvisible);

        //volvemos a la pagina principal
        header("Location: index.php");
        die;
    }

    //muestra el formulario de modiciar AI
    public static function formularioModificarAmigoInvisible($idAmigoInvisible)
    {
        $amigoInvisble = ModeloAmigoInvisible::getAmigoInvisbleById($idAmigoInvisible);

        VistaModificarAmigoInvisible::render($amigoInvisble);
    }

    //modificar amigo invisible
    public static function modificarAmigoInvisible($amigoInvisble)
    {
        ModeloAmigoInvisible::updateAmigoInvisible($amigoInvisble);

        //volvemos a la pagina principal
        header("Location: index.php");
        die;
    }

    //muestra detalles amigo invisible
    public static function mostrarDetalles($idAmigoInvisible)
    {
        //pedir amigo invisible
        $amigoInvisble = ModeloAmigoInvisible::getAmigoInvisbleById($idAmigoInvisible);

        //pedir relacion
        $arrayIdParticipantesMasEstado = ModeloRelacion::getParticipantesByIdAmigoInvisible($idAmigoInvisible);

        //buscar cada participante
        $jugadoresMasEstado = [];

        foreach ($arrayIdParticipantesMasEstado as $valor) {

            array_push($jugadoresMasEstado, [
                "jugador" => ModeloParticipante::getParticiapanteById($valor["idParticiapante"]),
                "estado" => $valor["estado"]
            ]);
        }

        //mostrarlos en vista
        VistaDetalles::render($amigoInvisble, $jugadoresMasEstado);
    }

    //borrar particiapante de un amigo invisible
    public static function borrarParticipante($idParticipante, $idAmigoInvisible)
    {
        //borrar valor de bd
        ModeloRelacion::deleteRelacionByidParticiapanteIdAmigoInvisible($idParticipante, $idAmigoInvisible);

        //volver a mostrar los detalles
        ControladorAmigoInvisible::mostrarDetalles($idAmigoInvisible);
    }

    //añadir particiapante a bd y a su amigo invisible
    public static function addParticipante($idAmigoInvisible, $participante)
    {
        //crear participante y coger su id
        $idParticipante = ModeloParticipante::addParticipante($participante);

        //crear relacion nueva
        ModeloRelacion::addRelacion($idAmigoInvisible, $idParticipante, "no sabe qué regalar");

        //volver a los detalles
        ControladorAmigoInvisible::mostrarDetalles($idAmigoInvisible);
    }

    //muestra el formulario de estado del participante
    public static function formModificarEstado($idAmigoInvisible, $idParticipante)
    {
        //buscar los datos del participante
        $participante = ModeloParticipante::getParticiapanteById($idParticipante);

        //buscar el estado del participante
        $estado = ModeloRelacion::getEstado($idAmigoInvisible, $idParticipante);

        //pasar los datos a la vista
        VistaModificarParticipante::render($participante, $idAmigoInvisible, $estado);
    }

    //modifica el estado de participante y vuelve a los detalles
    public static function modificarEstado($idAmigoInvisible, $idParticipante, $estado)
    {
        ModeloRelacion::updateEstado($idAmigoInvisible, $idParticipante, $estado);

        ControladorAmigoInvisible::mostrarDetalles($idAmigoInvisible);
    }

    public static function buscarParticipantes($idAmigoInvisible, $busqueda)
    {
        $resultados = ModeloParticipante::getParticipanteByNameEmail($busqueda);
        var_dump($resultados);
    }
}
