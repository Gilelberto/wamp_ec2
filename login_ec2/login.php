<?php 
    if(isset($_COOKIE["usuario"])){
        header("Location: welcome.php");
    }

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
        color: #724d82;
    }
    .container {
        width: 50%;
        margin: auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
        margin-bottom: 20px;
    }
    input[type="text"], input[type="email"], textarea {
        width: 100%;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"] {
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
    <h1>Formulario de Contacto</h1>
</header>
<div class="container">
    <form action="login-middleware.php" method="post">
        <label for="campo1">correo:</label>
        <input type="text" id="campo1" name="email" required="true">
        <label for="campo2">contraseña:</label>
        <input type="password" id="campo2" name="password" required="true">
        <br>
        <input type="submit" value="Enviar">
    </form>
    
    <?php 
        if(isset($_COOKIE["credentials_error"])){
            echo "<p>Usurio y/o contraseña incorrectos.</p>";
        }
    ?>
</div>
<footer>
    <h2 style="color: #724d82;">Formulario</h2>
</footer>
</body>
</html>
