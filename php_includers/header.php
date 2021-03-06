<?php
  ob_start();
  require_once('php_includers/db_connection.php');
  $numUsers = DB::numUsers();
  //Checking if we don't have user to charge the firsuser page
  if($numUsers["NUMUSERS"] == 0){
    if(!strpos($_SERVER['REQUEST_URI'], "first")){
      header('Location: firstuser.php');
    }
  }
  //checking if the user is an admin
  $admin = false;
  if(isset($_COOKIE["login"])){
    $userType = DB::userIsAdmin($_COOKIE["login"]);
    if ($userType["USERTYPE"] == "ADMIN"){
      $admin = true;
    } else {
      $admin = false;
    }
  }
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <!--If from the main page send a title, use it-->
	<title><?= isset($PageTitle) ? $PageTitle : "tuBibliotecaOnline, todos tus libros organizados"?></title>
	<meta charset="UTF-8">
	<meta name="author" content="García Pozo, Francisco">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/w3.css">	
  <link rel="stylesheet" href="css/pagedesign.css">
  <!--Link to charge the google font-->
  <link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
  <script src="js/js.cookie.js"></script>
  <script src="js/menu.js"></script>
  <!--Link to charge jquery-->
  <script src="https://code.jquery.com/jquery-3.3.1.js"
          integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
          crossorigin="anonymous"></script>
    
</head>
<body>
  <main>
    <div class="w3-top">
      <div class="w3-bar tbo-dark">
        <!--Button to charge the menu-->
        <a href="#" class="w3-bar-item w3-button w3-hover-gray" id="menuButton">☰</a>
        <div id ="toNarrow">
          <a href="index.php" class="w3-bar-item w3-button tbo-hover-cream">tuBibliotecaOnline</a>
          <a href="library.php" class="w3-bar-item w3-button tbo-hover-cream">Tu biblioteca</a>
          <a href="books.php" class="w3-bar-item w3-button tbo-hover-cream">Libros</a>
          <a href="authors.php" class="w3-bar-item w3-button tbo-hover-cream">Autores</a>
          <a href="publishers.php" class="w3-bar-item w3-button tbo-hover-cream">Editoriales</a>
          <?php 
            if($admin){
              print_r('<a href="admin.php" class="w3-bar-item w3-right w3-button w3-hover-gray">Administración</a>');
            }
          ?>
        </div>
        <?php
          if(isset($_COOKIE["login"])){
            print_r('<a href="logout.php" class="w3-bar-item w3-button w3-right w3-hover-gray" id="userButton">Desconectar</a>');
          } else {
            print_r('<a href="login.php" class="w3-bar-item w3-button w3-right w3-hover-gray" id="userButton">Login</a>');
          }
        ?>
      </div>
    </div>
    <div id="header-size"></div>

    <!-- Sidebar -->
    <div class="w3-sidebar w3-bar-block w3-animate-left w3-hide tbo-mint" id="sideBar">
    <?php
      //Menu if the user is an admin
      if($admin){
        print_r('
        <a href="index.php" class="w3-bar-item w3-button tbo-hover-cream">Inicio</a>
        <a href="library.php" class="w3-bar-item w3-button tbo-hover-cream">Tu biblioteca</a>
        <a href="books.php" class="w3-bar-item w3-button tbo-hover-cream">Libros</a>
        <a href="authors.php" class="w3-bar-item w3-button tbo-hover-cream">Autores</a>
        <a href="publishers.php" class="w3-bar-item w3-button tbo-hover-cream">Editoriales</a>
        <a href="adminusers.php" class="w3-bar-item w3-button tbo-hover-cream">Administrar usuarios</a>
        <a href="adminbks.php" class="w3-bar-item w3-button tbo-hover-cream">Administrar libros</a>
        <a href="adminathrs.php" class="w3-bar-item w3-button tbo-hover-cream">Administrar autores</a>
        <a href="adminpubli.php" class="w3-bar-item w3-button tbo-hover-cream">Administrar editoriales</a>
        ');
      } else {
        print_r('
        <a href="index.php" class="w3-bar-item w3-button tbo-hover-cream">Inicio</a>
        <a href="library.php" class="w3-bar-item w3-button tbo-hover-cream">Tu biblioteca</a>
        <a href="books.php" class="w3-bar-item w3-button tbo-hover-cream">Libros</a>
        <a href="authors.php" class="w3-bar-item w3-button tbo-hover-cream">Autores</a>
        <a href="publishers.php" class="w3-bar-item w3-button tbo-hover-cream">Editoriales</a>');
      }
    ?>
  </div>