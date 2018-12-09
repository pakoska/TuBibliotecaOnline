<?php
  require_once('php_includers/db_connection.php');
  $books = DB::listAuthors();
  if($admin){
    print_r('
    <div class="advice w3-hide" id="advicedelete">
    <p>¿Deseas borrar el autor?</p>
    <button class="w3-button w3-tiny w3-round tbo-mint w3-block" id="confirmDelete">Sí</button></br>
    <button class="w3-button w3-tiny w3-round tbo-mint w3-block" id="rollbackDelete">No</button>
    </div>
    <div class="advice w3-hide" id="adviceupdate">
    <p>¿Deseas actualizar los datos del autor?</p>
    <button class="w3-button w3-tiny w3-round tbo-mint w3-block" id="confirmUpdate">Sí</button></br>
    <button class="w3-button w3-tiny w3-round tbo-mint w3-block" id="rollbackUpdate">No</button>
    </div>
    <div class="advice w3-hide" id="advice">
    <p>¡No puedes borrar un autor que tenga libros asociados!</p>
    <button class="w3-button w3-tiny w3-round tbo-mint w3-block" id="closeAdvice">OK</button></br>
   
    </div>
        <div class="admin tbo-cream w3-padding-large">
          <h1 class="titles">Administración de autores</h1>
          ');
            print_r("<table class='w3-table w3-bordered w3-hoverable'>
            <tr>
              <th>ID</th>
              <th>Nombre</th>
              <th>Fecha de nacimiento</th>
              <th>Actualizar</th>
              <th>Borrar</th>
            </tr>");
            for ($i = 0; $i < count($books); $i++){
            print_r("<tr>
              <td>".$books[$i]['ID_AUTHOR']."</td>
              <td><input class='w3-input w3-border' name='name_".$books[$i]['ID_AUTHOR']."' id='name_".$books[$i]['ID_AUTHOR']."' type='text' value='".$books[$i]['NAME']."'></td>
              <td><input class='w3-input w3-border' name='date_".$books[$i]['ID_AUTHOR']."' id='date_".$books[$i]['ID_AUTHOR']."' type='date' value='".$books[$i]['YEAROFBIRTH']."'></td>
              <td><button class='w3-button w3-tiny w3-round tbo-mint w3-block' onclick='updateAuthor(\"".$books[$i]['ID_AUTHOR']."\")'>Actualizar</button></td>
              <td><button class='w3-button w3-tiny w3-round tbo-mint w3-block' onclick='deleteAuthor(\"".$books[$i]['ID_AUTHOR']."\")'>X</button></td>
            </tr>");
            }
            print_r("</table>
        </div>");
  } else {
    print_r('<div class="admin tbo-cream w3-padding-large">
      <h1 class="titles">Zona restringida</h1>
      <p>A esta parte de la web solo pueden entrar usuarios administradores</p>
    </div>');
  }

?>