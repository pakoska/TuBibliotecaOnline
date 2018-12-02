<?php
  require_once('php_includers/db_connection.php');
  $book = DB::getBook($_GET["ISBN"]);
  $frontRute = "img/".$_GET["ISBN"].".png";
  $exitsFront = false;
  if (file_exists($frontRute)){
    $exitsFront = true;
  }
?>
    <div class="book tbo-cream">
      <div class="w3-row">
        <div class="w3-half w3-container">
          <div class="bookContainer">
            <?php
            if($exitsFront){
              print_r('<img src="img/'.$book["ISBN"].'.png" alt="'.$book["TITLE"].'" class="bookCoverSmall" id="'.$book["ISBN"].'">');
            } else {
              print_r('<div class="bookCoverSmall w3-container w3-center"><a class="noUnder" href="addfront.php?ISBN='.$book["ISBN"].'"><p>No se ha añadido ninguna portada. Haz click para añadirla</p></a></div>');
            }
            ?>
            <p><?php print_r($book["TITLE"]) ?></p>
            <p>ISBN: <?php print_r($book["ISBN"]) ?></p>
            <button class="w3-button w3-round tbo-mint w3-block" id="addBook">Añadir</button></br>
            <a href="https://www.google.es/search?q=<?php print_r(str_replace(' ', '+',$book["TITLE"])) ?>" class="noUnder"><button class="w3-button w3-round tbo-mint w3-block">Buscar en Google</button></a>
          </div>
        </div>
        <div class="w3-half w3-container">
          <p class="author">Autor: <?php print_r($book["AUTHOR"]) ?> · Editorial: <a><?php print_r($book["PUBLISHER"]) ?></a></p>
          <p class="plot"><?php print_r($book["PLOT"]) ?></p>
        </div>
      </div>
    </div>