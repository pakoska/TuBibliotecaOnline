<?php
  //Page to show the book info
  //Only charge the web if the user send the ISBN via the url
  if(isset($_GET["ISBN"])){
    require_once('php_includers/db_connection.php');
    $book = DB::getBook($_GET["ISBN"]);
    
    //Getting the route for the img
    $frontRute = "img/".$_GET["ISBN"].".png";
    $exitsFront = false;
    //If nos exists, variable to charge later the default img
    if (file_exists($frontRute)){
      $exitsFront = true;
    }
    //default value to check if a book is in the library of the user
    $bookInLibrary = 2;
    //Checking if the user is logged with the cookies
    if(isset($_COOKIE['login'])){
        $user = $_COOKIE["login"];
        $bookInLibrary = DB::bookInLibrary($user, $_GET["ISBN"]);
    }
    print_r('
      <div class="book tbo-cream">
        <div class="w3-row">
          <div class="w3-half w3-container">
            <div class="bookContainer">
            ');
                //Charging the default img if we dont have the book front
                if($exitsFront){
                  print_r('<img src="img/'.$book["ISBN"].'.png" alt="'.$book["TITLE"].'" class="bookCoverSmall" id="'.$book["ISBN"].'">');
                } else {
                  print_r('<div class="bookCoverSmall w3-container w3-center"><a class="noUnder" href="addfront.php?ISBN='.$book["ISBN"].'"><p>No se ha añadido ninguna portada. Haz click para añadirla</p></a></div>');
                }
              print_r('
              <p>'.$book["TITLE"].'</p>
              <p>ISBN: '.$book["ISBN"].'</p>');
                if($bookInLibrary["ONLIBRARY"] == 1){
                  print_r("<p>¡Libro ya en tu biblioteca!</p>
                  <button class='w3-hide' id='addBook'>Añadir</button>");
                } else if ($bookInLibrary == 2){
                  print_r("<p>Inicia sesión para añadir este libro a tu biblioteca</p>
                  <button class='w3-hide' id='addBook'>Añadir</button>");
                } else {
                  print_r("
                  <input type='hidden' id='isbn' value='".$_GET['ISBN']."'>
                  <button class='w3-button w3-round tbo-mint w3-block' id='addBook'>Añadir</button></br>
                ");
                }
              print_r('
              <a href="https://www.google.es/search?q='.str_replace(" ", "+", $book["TITLE"]).'" class="noUnder"><button class="w3-button w3-round tbo-mint w3-block">Buscar en Google</button></a>          </div>
            </div>
          <div class="w3-half w3-container">
            <p class="author">Autor: '.$book["AUTHOR"].' · Editorial: <a>'.$book["PUBLISHER"].'</a></p>
            <p class="plot">'.$book["PLOT"].'</p>
          </div>
        </div>
      </div>  ');
  }
  else {
    print_r('<div class="addBook tbo-cream w3-padding-large">
    <p>¡Error! Debes entrar a esta web a traves de un enlace de libro</p>
    </div>');
  }
?>
