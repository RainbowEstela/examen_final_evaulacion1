<?php

namespace AmigoInvisible\vistas;

class VistaDetalles
{
    public static function render($amigoInvisible, $jugadoresMasEstado)
    {
        include("cabecera.php");


        //contenido principal
        echo ' <main class="container ">';


        echo '
          <div class="d-flex justify-content-center p-4 gap-2">
        ';
        if (strcmp($amigoInvisible->getEstado(), "activo") == 0) {
            echo '
            <div class="d-flex justify-content-center p-4">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">apuntar participante</button>  
          </div>     
          
          
          <form class="form-inline" action="index.php" method="POST">
            <div class="d-flex nowrap">
            <input type="hidden" name="idAmigoInvisible" value="' . $amigoInvisible->getId() . '">
            <input class="form-control mr-sm-2" type="text" placeholder="Email/nombre" name="busqueda">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit" name="accion" value="buscarParticipantes">buscar</button>

            </div>

        </form>
            ';


            //modal
            echo '
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Parámetros de busqueda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
              
              <form id="crearForm" action="index.php" method="POST">

              <input type="hidden" name="idAmigoInvisible" value="' . $amigoInvisible->getId() . '">

              <div class="form-floating">
              <input type="text" class="form-control" id="email" name="email" placeholder="Dodo" required>
              <label for="email">email</label>
          </div>

                <div class="form-floating">
                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Dodo" required>
                    <label for="nombre">nombre</label>
                </div>


                <div class="form-floating">
                    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Dodo" required>
                    <label for="telefono">telefono</label>
                </div>
                

              </form>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button class="btn btn-primary" type="submit" name="accion" value="crearParticipante" form="crearForm" id="crearAmigoInvisible">Crear</button>
              </div>
            </div>
          </div>
        </div>
        ';
            //fin modal
        }

        echo '
          </div>
        <div>
        <h3 class="text-center text-info">Informacion del amigo invisible del dia ' . $amigoInvisible->getFecha() . ' en ' . $amigoInvisible->getLugar() . '</h3>
        </div>
          
          ';
?>



        <div class="cotainer-fluid" id="contenedorPartidas">
            <div class="d-flex flex-row flex-wrap justify-content-center">

                <?php
                if ($jugadoresMasEstado == null) {
                    echo '
        <h3 class="text-center text-danger">No hay jugadores en la partida</h3>
        ';
                } else {

                    echo '
        <table class="table table-hover table-striped table-bordered">
          <tr class="table-dark text-center">
            <th>Nombre</th>
            <th>Email</th>
            <th>Telefono</th>
            <th>Estado</th>
            <th>Acciones</th>
          </tr>
          ';

                    foreach ($jugadoresMasEstado as $jugadorArray) {

                        echo '<tr>';
                        echo ' <td>' . $jugadorArray["jugador"]->getNombre() . '</td>';
                        echo ' <td>' . $jugadorArray["jugador"]->getEmail() . '</td>';
                        echo ' <td>' . $jugadorArray["jugador"]->getTelefono() . '</td>';
                        echo ' <td>' . $jugadorArray["estado"] . '</td>';
                        echo '<td>                  
                        <a href="index.php?accion=borrarParticipante&idParticipante=' . $jugadorArray["jugador"]->getId() . '&idAmigoInvisible=' . $amigoInvisible->getId() . '"><button class="btn btn-danger">X</button></a>
                        <a href="index.php?accion=formModificarParticipante&idParticipante=' . $jugadorArray["jugador"]->getId() . '&idAmigoInvisible=' . $amigoInvisible->getId() . '"><button class="btn btn-warning">M</button></a>

                        </td>';
                        echo '</tr>';
                    }


                    echo '
        </table>';
                }





                ?>


            </div>
        </div>



<?php
        echo '</main>';
        //fin contenido principal
        include_once("pie.php");
    }
}
