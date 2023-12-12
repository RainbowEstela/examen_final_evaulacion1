<?php

namespace AmigoInvisible\vistas;

class VistaModificarAmigoInvisible
{
    public static function render($AmigoInvisble)
    {
        include_once("cabecera.php");

        echo '
        <form id="crearForm" action="index.php" method="POST">
        <input type="hidden" name="id" value="' . $AmigoInvisble->getId() . '">
        <input type="hidden" name="emoji" value="' . $AmigoInvisble->getEmoji() . '">

                    <div class="form-floating">
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Dodo" value="' . $AmigoInvisble->getNombre() . '" required>
                        <label for="ciudad">nombre</label>
                    </div>

                    <div class="form-floating">
                      <span class="fs-5">Maximo dinero</span>
                      <input type="number" name="maximoDinero" id="maximoDinero" max="1000" min="1" value="' . $AmigoInvisble->getMaximoDinero() . '" required>
                      
                    </div>

                    <div class="form-floating">
                      <input type="date" class="form-control" id="fecha" name="fecha" value="' . $AmigoInvisble->getFecha() . '" required>
                      <label for="fecha">fecha</label>
                    </div>
  
                    
  
                    <div class="form-floating">
                      <input type="text" class="form-control" id="lugar" name="lugar" placeholder="Dodo" value="' . $AmigoInvisble->getLugar() . '" required>
                      <label for="lugar">lugar</label>
                    </div>
  
                    <div class="form-floating">
                      <input type="text" class="form-control" id="observaciones" name="observaciones" placeholder="Dodo" value="' . $AmigoInvisble->getObservaciones() . '" required>
                      <label for="observaciones">observaciones</label>
                    </div>
                    
                    <select name="estado" id="estado">';

        $estados = [
            "activo", "comprado", "entregado"
        ];

        foreach ($estados as $estado) {
            if (strcmp($estado, $AmigoInvisble->getEstado()) == 0) {
                echo '<option value="' . $estado . '" selected>' . $estado . '</option>';
            } else {
                echo '<option value="' . $estado . '">' . $estado . '</option>';
            }
        }


        echo '</select>
                    
  
                  </form>
  
  
  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="accion" value="modificarAmigoInvisible" form="crearForm" id="crearAmigoInvisible">Modificar</button>
                  </div>
                  ';
        include_once("pie.php");
    }
}
