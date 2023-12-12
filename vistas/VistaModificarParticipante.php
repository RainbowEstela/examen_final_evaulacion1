<?php

namespace AmigoInvisible\vistas;

class VistaModificarParticipante
{
    public static function render($participante, $idAmigoInvisible, $estado)
    {
        include_once("cabecera.php");

        echo '
        <h3>Estado del participante ' . $participante->getNombre() . '</h3>
        <form id="crearForm" action="index.php" method="POST">
        <input type="hidden" name="idAmigoInvisible" value="' . $idAmigoInvisible . '">
        <input type="hidden" name="idParticipante" value="' . $participante->getId() . '">
                    
                    <select name="estado" id="estado">';

        $estados = [
            "no sabe qué regalar", "ya sabe que regalar", "comprado"
        ];

        foreach ($estados as $estadoSelect) {
            if (strcmp($estadoSelect, $estado) == 0) {
                echo '<option value="' . $estadoSelect . '" selected>' . $estadoSelect . '</option>';
            } else {
                echo '<option value="' . $estadoSelect . '">' . $estadoSelect . '</option>';
            }
        }


        echo '</select>
                    
  
                  </form>
  
  
  
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit" name="accion" value="modificarParticipante" form="crearForm" id="crearAmigoInvisible">Modificar</button>
                  </div>
                  ';
        include_once("pie.php");
    }
}
