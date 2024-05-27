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

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM pilotos_f1 WHERE id=$id";
    $result = mysqli_query($conexion, $query);
    if ($result) {
        $piloto = mysqli_fetch_assoc($result);
        echo json_encode($piloto);
    } else {
        echo json_encode(["error" => "Error en la consulta: " . mysqli_error($conexion)]);
    }
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $id = $_POST['id'];
    $query = $conexion->prepare("DELETE FROM pilotos_f1 WHERE id=?");
    $query->bind_param('i', $id);
    if ($query->execute()) {
        $success_message = "El piloto ha sido eliminado exitosamente.";
    } else {
        $error_message = "Hubo un error al eliminar el piloto. Inténtelo nuevamente.";
    }
    $query->close();
    header("Location: consultas.php");
    exit();
}

mysqli_close($conexion);
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
    button.delete {
        background-color: #d9534f;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 10px;
    }
    button.delete:hover {
        background-color: #c9302c;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pilotoSelect = document.getElementById('piloto');
    const infoDiv = document.querySelector('.info');

    pilotoSelect.addEventListener('change', function() {
        const id = pilotoSelect.value;
        if (id) {
            fetch(`consultas.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        infoDiv.innerHTML = `
                            <p>Nombre: ${data.nombre}</p>
                            <p>Nacionalidad: ${data.nacionalidad}</p>
                            <p>Equipo Actual: ${data.equipo_actual}</p>
                            <p>Número de Coche: ${data.numero_coche}</p>
                            <p>Número de Victorias: ${data.numero_victorias}</p>
                            <p>Número de Podios: ${data.numero_podios}</p>
                            <p>Número de Carreras Disputadas: ${data.numero_carreras_disputadas}</p>
                            <p>Títulos de Campeonato: ${data.titulos_campeonato}</p>
                        `;
                        document.getElementById('id_eliminar').value = id;
                    }
                });
        }
    });
});
</script>
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
            <option value="">Seleccione un piloto</option>
            <?php foreach ($pilotos as $piloto): ?>
                <option value="<?php echo $piloto['id']; ?>"><?php echo $piloto['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <div class="info"></div>

    <form action="consultas.php" method="post">
        <input type="hidden" name="id" id="id_eliminar">
        <button type="submit" name="delete" class="delete">Eliminar Piloto</button>
    </form>

    <?php 
    if (isset($error_message)) {
        echo "<div class='message error'>$error_message</div>";
    } elseif (isset($success_message)) {
        echo "<div class='message success'>$success_message</div>";
    }
    ?>
</div>
</body>
</html>
