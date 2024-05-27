<?php 
    session_start();
    if(isset($_SESSION["usr_id"])){
        header("Location: welcome.php");
        exit();
    }
   // session_destroy();

?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulario con Estilos</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #333333;
        color: #724d82;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #6e5773;
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    h1 {
        color: #ffffff;
    }
    .container {
        width: 25%;
        margin: auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
        margin-bottom: 20px;
    }
    input[type="text"], input[type="email"], input[type="password"], textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
        width: 100%;
        background-color: #724d82;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #563d62;
    }
    footer {
        background-color: #724d82;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        position: fixed;
        bottom: 0;
        width: 100%;
    }
</style>
</head>
<body>
<header>
    <h1>Registro</h1>
</header>
<div class="container">
    <?php 
        if(isset($_COOKIE["wrong_secret"])){
            echo "<p>CLAVE SECRETA INCORRECTA</p>";
        }
        if(isset($_COOKIE["register_error"])){
            echo "<p>Ocurrió un problema al registrar el usuario</p>";
        }
    ?>
    <p><a href="login.php">Volver a login</a></p>
    <form action="register-middleware.php" method="post">
    <label for="campo4">Nombre:</label>
    <br>
    <input type="text" id="campo4" name="user_name" required>
    <br>
    <label for="campo5">Apellido:</label>
    <br>
    <input type="text" id="campo5" name="user_lastname" required>
    <br>
    <label for="campo1">Correo:</label>
    <br>
    <input type="text" id="campo1" name="email" required>
    <br>
    <label for="campo2">Contraseña:</label>
    <br>
    <input type="password" id="campo2" name="password" required>
    <br>
    <label for="campo3">Código de registro:</label>
    <br>
    <input type="password" id="campo3" name="secret" required>
    <br>
    <input type="submit" value="Enviar">
</form>

    
    <?php 
        if(isset($_COOKIE["credentials_error"])){
            echo "<p>Usuario y/o contraseña incorrectos.</p>";
        }
    ?>
</div>
</body>
</html>
