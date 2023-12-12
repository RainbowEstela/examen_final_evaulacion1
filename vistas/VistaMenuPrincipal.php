<?php

namespace AmigoInvisible\vistas;

class VistaMenuPrincipal
{
    public static function render($amigosInvisibles = null)
    {

        include("cabecera.php");


        //contenido principal
        echo ' <main class="container ">';
        echo '
            <div class="d-flex justify-content-center p-4">
              <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear amigo invisible</button>  
            </div>
            ';
?>


        <div class="cotainer-fluid" id="contenedorPartidas">
            <div class="d-flex flex-row flex-wrap justify-content-center">

                <?php
                if ($amigosInvisibles == null) {
                    echo '
          <h3 class="text-center text-info">No hay amigos invisibles</h3>
          ';
                } else {

                    echo '
          <table class="table table-hover table-striped table-bordered">
            <tr class="table-dark text-center">
              <th>Nombre</th>
              <th>Estado</th>
              <th>Maximo dinero</th>
              <th>Fecha</th>
              <th>Lugar</th>
              <th>Observaciones</th>
              <th>Emoji</th>
              <th>Acciones</th>
            </tr>
            ';

                    foreach ($amigosInvisibles as $amigoInvisible) {

                        echo '<tr>';
                        echo ' <td>' . $amigoInvisible->getNombre() . '</td>';
                        echo ' <td>' . $amigoInvisible->getEstado() . '</td>';
                        echo ' <td>' . $amigoInvisible->getMaximoDinero() . '</td>';
                        echo ' <td>' . $amigoInvisible->getFecha() . '</td>';
                        echo ' <td>' . $amigoInvisible->getLugar() . '</td>';
                        echo ' <td>' . $amigoInvisible->getObservaciones() . '</td>';
                        echo ' <td>' . $amigoInvisible->getEmoji() . '</td>';

                        echo ' <td class="d-flex justify-content-center gap-1">
                  <a href="index.php?accion=mostrarDetalles&idAmigoInvisible=' . $amigoInvisible->getId() . '"><button class="btn btn-primary">@</button></a>
                  <a href="index.php?accion=borrarAmigoInvisible&idAmigoInvisible=' . $amigoInvisible->getId() . '"><button class="btn btn-danger">X</button></a>
                  <a href="index.php?accion=formModificarAmigoInvisible&idAmigoInvisible=' . $amigoInvisible->getId() . '"><button class="btn btn-warning">M</button></a>

              </td>
              ';
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
  
                    <div class="form-floating">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Dodo" required>
                        <label for="ciudad">nombre</label>
                    </div>

                    <div class="form-floating">
                      <span class="fs-5">Maximo dinero</span>
                      <input type="number" name="maximoDinero" id="maximoDinero" max="1000" min="1" required>
                      
                    </div>

                    <div class="form-floating">
                      <input type="date" class="form-control" id="fecha" name="fecha" required>
                      <label for="fecha">fecha</label>
                    </div>
  
                    
  
                    <div class="form-floating">
                      <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Dodo" required>
                      <label for="lugar">lugar</label>
                    </div>
  
                    <div class="form-floating">
                      <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Dodo" required>
                      <label for="observaciones">observaciones</label>
                    </div>
                    
  
                    
  
                  </form>
  
  
  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="accion" value="crearAmigoInvisible" form="crearForm" id="crearAmigoInvisible">Crear</button>
                  </div>
                </div>
              </div>
            </div>
            ';
        //fin modal
        ?>

        <script>
            window.onload = llamarInicio();

            async function llamarInicio() {

            }

            document.getElementById("contenedorPartidas").onclick = async function(e) {


            };
        </script>

<?php


        include("pie.php");
    }
}
?>