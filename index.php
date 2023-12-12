<?php

namespace AmigoInvisible;

use AmigoInvisible\controladores\ControladorAmigoInvisible;
use AmigoInvisible\modelos\AmigoInvisible;
use AmigoInvisible\modelos\Participante;
use GuzzleHttp\Client;

require_once './vendor/autoload.php';

//Autocargar las clases --------------------------
spl_autoload_register(function ($class) {
    //echo substr($class, strpos($class,"\\")+1);
    $ruta = substr($class, strpos($class, "\\") + 1);
    $ruta = str_replace("\\", "/", $ruta);
    include_once "./" . $ruta . ".php";
});

if (isset($_REQUEST["accion"])) {
    //crear amigo invisible
    if (strcmp($_REQUEST["accion"], "crearAmigoInvisible") == 0) {
        $client = new Client();
        $request = $client->request('GET', "https://emojihub.yurace.pro/api/random");
        $resObj = json_decode($request->getBody());

        $nombre = $_REQUEST["nombre"];
        $estado = "activo";
        $maximoDinero = intval($_REQUEST["maximoDinero"]);
        $fecha = $_REQUEST["fecha"];
        $lugar = $_REQUEST["lugar"];
        $observaciones = $_REQUEST["observaciones"];
        $emoji = $resObj->htmlCode[0];

        $amigoInvisble = new AmigoInvisible("", $nombre, $estado, $maximoDinero, $fecha, $lugar, $observaciones, $emoji);

        ControladorAmigoInvisible::addAmigoInvisible($amigoInvisble);
    }

    //borrar amigo invisible
    if (strcmp($_REQUEST["accion"], "borrarAmigoInvisible") == 0) {
        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];

        ControladorAmigoInvisible::deteleAmigoInvisible($idAmigoInvisible);
    }

    //mostrar formulario de modificar amigo invisible
    if (strcmp($_REQUEST["accion"], "formModificarAmigoInvisible") == 0) {
        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];

        ControladorAmigoInvisible::formularioModificarAmigoInvisible($idAmigoInvisible);
    }

    //modificar amigo invisible
    if (strcmp($_REQUEST["accion"], "modificarAmigoInvisible") == 0) {
        $id = intval($_REQUEST["id"]);
        $nombre = $_REQUEST["nombre"];
        $estado = $_REQUEST["estado"];
        $maximoDinero = intval($_REQUEST["maximoDinero"]);
        $fecha = $_REQUEST["fecha"];
        $lugar = $_REQUEST["lugar"];
        $observaciones = $_REQUEST["observaciones"];
        $emoji = $_REQUEST["emoji"];


        $amigoInvisble = new AmigoInvisible($id, $nombre, $estado, $maximoDinero, $fecha, $lugar, $observaciones, $emoji);

        ControladorAmigoInvisible::modificarAmigoInvisible($amigoInvisble);
    }

    //mostrar detalles
    if (strcmp($_REQUEST["accion"], "mostrarDetalles") == 0) {
        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];
        ControladorAmigoInvisible::mostrarDetalles($idAmigoInvisible);
    }

    //borrar participante de un amigo invisible
    if (strcmp($_REQUEST["accion"], "borrarParticipante") == 0) {
        $idParticipante = $_REQUEST["idParticipante"];
        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];

        ControladorAmigoInvisible::borrarParticipante($idParticipante, $idAmigoInvisible);
    }

    //crear participante
    if (strcmp($_REQUEST["accion"], "crearParticipante") == 0) {

        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];
        $participante = new Participante("", $_REQUEST["email"], $_REQUEST["nombre"], $_REQUEST["telefono"]);

        ControladorAmigoInvisible::addParticipante($idAmigoInvisible, $participante);
    }

    //mostrar formulario modificar estado de participante de un amigo invisible
    if (strcmp($_REQUEST["accion"], "formModificarParticipante") == 0) {

        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];
        $idParticipante = $_REQUEST["idParticipante"];

        ControladorAmigoInvisible::formModificarEstado($idAmigoInvisible, $idParticipante);
    }

    //modificar estado de participante
    if (strcmp($_REQUEST["accion"], "modificarParticipante") == 0) {
        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];
        $idParticipante = $_REQUEST["idParticipante"];
        $estado = $_REQUEST["estado"];

        ControladorAmigoInvisible::modificarEstado($idAmigoInvisible, $idParticipante, $estado);
    }

    //buscar participantes
    if (strcmp($_REQUEST["accion"], "buscarParticipantes") == 0) {

        $idAmigoInvisible = $_REQUEST["idAmigoInvisible"];
        $busqueda = $_REQUEST["busqueda"];

        ControladorAmigoInvisible::buscarParticipantes($idAmigoInvisible, $busqueda);
    }
} else {
    ControladorAmigoInvisible::mostrarAmigosInvisibles();
}
