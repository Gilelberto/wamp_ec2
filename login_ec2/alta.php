<?php 

require_once 'config.php';
require_once 'check_session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $nacionalidad = $_POST['nacionalidad'];
    $equipo_actual = $_POST['equipo_actual'];
    $numero_coche = $_POST['numero_coche'];
    $numero_victorias = $_POST['numero_victorias'];
    $numero_podios = $_POST['numero_podios'];
    $numero_carreras_disputadas = $_POST['numero_carreras_disputadas'];
    $titulos_campeonato = $_POST['titulos_campeonato'];

    $conexion = mysqli_connect("localhost", "root", "", "final_db");
    if (!$conexion) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $query = $conexion->prepare("SELECT COUNT(*) FROM pilotos_f1 WHERE LOWER(nombre) = LOWER(?)");
    $query->bind_param('s', $nombre);
    $query->execute();
    $query->bind_result($count);
    $query->fetch();
    $query->close();

    if ($count > 0) {
        $error_message = "El nombre del piloto ya existe. Por favor, elija otro nombre.";
    } else {
        $query = "SELECT MAX(id) AS max_id FROM pilotos_f1";
        $result = mysqli_query($conexion, $query);
        $row = mysqli_fetch_assoc($result);
        $next_id = $row['max_id'] + 1;

        $query = $conexion->prepare("INSERT INTO pilotos_f1 (id, nombre, nacionalidad, equipo_actual, numero_coche, numero_victorias, numero_podios, numero_carreras_disputadas, titulos_campeonato) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('isssiiiii', $next_id, $nombre, $nacionalidad, $equipo_actual, $numero_coche, $numero_victorias, $numero_podios, $numero_carreras_disputadas, $titulos_campeonato);
        if ($query->execute()) {
            $success_message = "El piloto ha sido agregado exitosamente.";
        } else {
            $error_message = "Hubo un error al agregar el piloto. Inténtelo nuevamente.";
        }
        $query->close();
    }

    mysqli_close($conexion);
}

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
?>


<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Altas de Pilotos F1</title>
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
    input[type="text"], input[type="number"] {
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
</head>
<body>
<header>
    <a href="welcome.php" class="back-button">Volver</a>
    <h1>Altas de Pilotos F1</h1>
</header>
<div class="container">
    <form action="alta.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="nacionalidad">Nacionalidad:</label>
        <select id="nacionalidad" name="nacionalidad" required>
            <?php foreach ($nacionalidades as $nacionalidad) {
                echo "<option value='$nacionalidad'>$nacionalidad</option>";
            } ?>
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

        <input type="submit" value="Agregar Piloto">
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
