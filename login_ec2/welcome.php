<?php 
    require_once 'config.php';
    require_once 'check_session.php';

?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Bienvenido</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
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
        width: 50%;
        margin: auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }
    .button-container {
        display: flex;
        justify-content: space-around;
        margin-top: 20px;
    }
    .button-container a {
        display: block;
        width: 20%;
        padding: 15px;
        text-align: center;
        background-color: #724d82;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    .button-container a:hover {
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
    <h1>Bienvenido</h1>
</header>
<div class="container">
    <h2>Menú Principal</h2>
    <div class="button-container">
        <a href="alta.php">Altas</a>
        <a href="cambios.php">Cambios</a>
        <a href="consultas.php">Consultas</a>
        <a href="descargas.php">Descargas</a>
    </div>
</div>
<footer>
    <h2>Menú</h2>
</footer>
</body>
</html>
