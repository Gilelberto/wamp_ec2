<?php 
require_once 'config.php';
require_once 'check_session.php';

$conexion = mysqli_connect("localhost", "root", "", "final_db");
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM pilotos_f1";
$result = mysqli_query($conexion, $query);
$pilotos = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $query = "SELECT * FROM pilotos_f1 WHERE id=$id";
        $result = mysqli_query($conexion, $query);
        if ($result) {
            $piloto = mysqli_fetch_assoc($result);
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Consultas de Pilotos F1</title>
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
        position: relative;
    }
    header .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #563d62;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
    }
    header .back-button:hover {
        background-color: #724d82;
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
    select, p {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    .info {
        font-weight: bold;
    }
    .back-button {
        background-color: #724d82;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
    }
    .back-button:hover {
        background-color: #563d62;
    }
</style>
</head>
<body>
<header>
    <a href="welcome.php" class="back-button">Volver</a>
    <h1>Consultas de Pilotos F1</h1>
</header>
<div class="container">
    <form action="consultas.php" method="post">
        <label for="piloto">Seleccione un Piloto:</label>
        <select id="piloto" name="id" required>
            <?php foreach ($pilotos as $piloto): ?>
                <option value="<?php echo $piloto['id']; ?>"><?php echo $piloto['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <?php if(isset($piloto)): ?>
        <div class="info">
            <p>Nombre: <?php echo $piloto['nombre']; ?></p>
            <p>Nacionalidad: <?php echo $piloto['nacionalidad']; ?></p>
            <p>Equipo Actual: <?php echo $piloto['equipo_actual']; ?></p>
            <p>Número de Coche: <?php echo $piloto['numero_coche']; ?></p>
            <p>Número de Victorias: <?php echo $piloto['numero_victorias']; ?></p>
            <p>Número de Podios: <?php echo $piloto['numero_podios']; ?></p>
            <p>Número de Carreras Disputadas: <?php echo $piloto['numero_carreras_disputadas']; ?></p>
            <p>Títulos de Campeonato: <?php echo $piloto['titulos_campeonato']; ?></p>
        </div>
    <?php endif; ?>
</div>
</body>
</html>

