<?php
require_once 'config.php';
require_once 'check_session.php';

$conexion = mysqli_connect("localhost", "root", "", "final_db");
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT id, nombre FROM pilotos_f1";
$result = mysqli_query($conexion, $query);
$pilotos = mysqli_fetch_all($result, MYSQLI_ASSOC);

$nacionalidades = [
    'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola', 'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria', 
    'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan', 
    'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia', 
    'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile', 'China', 'Colombia', 'Comoros', 'Congo, Democratic Republic of the', 'Congo, Republic of the', 
    'Costa Rica', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 
    'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini', 'Ethiopia', 'Fiji', 'Finland', 'France', 
    'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece', 'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 
    'Guyana', 'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran', 'Iraq', 'Ireland', 
    'Israel', 'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, North', 'Korea, South', 
    'Kosovo', 'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 
    'Lithuania', 'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 
    'Mauritius', 'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia', 'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 
    'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'North Macedonia', 'Norway', 
    'Oman', 'Pakistan', 'Palau', 'Palestine', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Poland', 
    'Portugal', 'Qatar', 'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia', 'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 
    'Sao Tome and Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 
    'Somalia', 'South Africa', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Sweden', 'Switzerland', 'Syria', 
    'Taiwan', 'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo', 'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 
    'Turkmenistan', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'Uruguay', 'Uzbekistan', 'Vanuatu', 
    'Vatican City', 'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        $query = $conexion->prepare("DELETE FROM pilotos_f1 WHERE id=?");
        $query->bind_param('i', $id);
        if ($query->execute()) {
            $success_message = "El piloto ha sido eliminado exitosamente.";
        } else {
            $error_message = "Hubo un error al eliminar el piloto. Inténtelo nuevamente.";
        }
        $query->close();
    } else {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $nacionalidad = $_POST['nacionalidad'];
        $equipo_actual = $_POST['equipo_actual'];
        $numero_coche = $_POST['numero_coche'];
        $numero_victorias = $_POST['numero_victorias'];
        $numero_podios = $_POST['numero_podios'];
        $numero_carreras_disputadas = $_POST['numero_carreras_disputadas'];
        $titulos_campeonato = $_POST['titulos_campeonato'];

        $query = $conexion->prepare("UPDATE pilotos_f1 SET nombre=?, nacionalidad=?, equipo_actual=?, numero_coche=?, numero_victorias=?, numero_podios=?, numero_carreras_disputadas=?, titulos_campeonato=? WHERE id=?");
        $query->bind_param('sssiiiiii', $nombre, $nacionalidad, $equipo_actual, $numero_coche, $numero_victorias, $numero_podios, $numero_carreras_disputadas, $titulos_campeonato, $id);
        if ($query->execute()) {
            $success_message = "Los cambios se han guardado exitosamente.";
        } else {
            $error_message = "Hubo un error al guardar los cambios. Inténtelo nuevamente.";
        }
        $query->close();
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cambios de Pilotos F1</title>
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
    select, input[type="text"], input[type="number"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }
    input[type="submit"], button {
        width: 100%;
        background-color: #724d82;
        color: #fff;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-bottom: 10px;
    }
    input[type="submit"]:hover, button:hover {
        background-color: #563d62;
    }
    button.delete {
        background-color: #d9534f;
    }
    button.delete:hover {
        background-color: #c9302c;
    }
    .message {
        margin-bottom: 20px;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
    }
    .success {
        background-color: #d4edda;
        color: #155724;
    }
    .error {
        background-color: #f8d7da;
        color: #721c24;
    }
</style>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const pilotoSelect = document.getElementById('piloto');
    const nombreInput = document.getElementById('nombre');
    const nacionalidadSelect = document.getElementById('nacionalidad');
    const equipoActualInput = document.getElementById('equipo_actual');
    const cocheInput = document.getElementById('numero_coche');
    const victoriasInput = document.getElementById('numero_victorias');
    const podiosInput = document.getElementById('numero_podios');
    const carrerasInput = document.getElementById('numero_carreras_disputadas');
    const titulosInput = document.getElementById('titulos_campeonato');

    pilotoSelect.addEventListener('change', function() {
        const id = pilotoSelect.value;
        if (id) {
            fetch(`consultas.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        nombreInput.value = data.nombre;
                        nacionalidadSelect.value = data.nacionalidad;
                        equipoActualInput.value = data.equipo_actual;
                        cocheInput.value = data.numero_coche;
                        victoriasInput.value = data.numero_victorias;
                        podiosInput.value = data.numero_podios;
                        carrerasInput.value = data.numero_carreras_disputadas;
                        titulosInput.value = data.titulos_campeonato;
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
    <h1>Cambios de Pilotos F1</h1>
</header>
<div class="container">
    <form action="cambios.php" method="post">
        <label for="piloto">Seleccione el piloto a modificar:</label>
        <select id="piloto" name="id" required>
            <option value="">Seleccione un piloto</option>
            <?php foreach ($pilotos as $piloto): ?>
                <option value="<?php echo $piloto['id']; ?>"><?php echo $piloto['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="nacionalidad">Nacionalidad:</label>
        <select id="nacionalidad" name="nacionalidad" required>
            <?php foreach ($nacionalidades as $nacionalidad): ?>
                <option value="<?php echo $nacionalidad; ?>"><?php echo $nacionalidad; ?></option>
            <?php endforeach; ?>
        </select>

        <label for="equipo_actual">Equipo Actual:</label>
        <input type="text" id="equipo_actual" name="equipo_actual" required>

        <label for="numero_coche">Número de Coche:</label>
        <input type="number" id="numero_coche" name="numero_coche" min="1" required>

        <label for="numero_victorias">Número de Victorias:</label>
        <input type="number" id="numero_victorias" name="numero_victorias" min="0" required>

        <label for="numero_podios">Número de Podios:</label>
        <input type="number" id="numero_podios" name="numero_podios" min="0" required>

        <label for="numero_carreras_disputadas">Número de Carreras Disputadas:</label>
        <input type="number" id="numero_carreras_disputadas" name="numero_carreras_disputadas" min="0" required>

        <label for="titulos_campeonato">Títulos de Campeonato:</label>
        <input type="number" id="titulos_campeonato" name="titulos_campeonato" min="0" required>

        <input type="submit" value="Guardar Cambios">
    </form>
    
    <form action="cambios.php" method="post">
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
