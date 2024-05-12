<?php 

    if(!isset($_COOKIE["usuario"])){
        header("Location: login.php");
    }
?>

<html>
  
    <?php 
        echo "<h1> Bienvenido {$_COOKIE["usuario"]} </h1>";
        //exit(); ésta instrucción es la que cierra el bloque php de golpe para evitar que siga ejecutándose.
    ?>
</html>