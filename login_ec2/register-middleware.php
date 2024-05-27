<?php 

require_once 'config.php';


$email = $_POST['email'];
$password = $_POST['password'];
$secret = $_POST['secret'];
$user_name = $_POST['user_name'];
$user_lastname = $_POST['user_lastname'];


if($secret != "cloudUach2024!"){
    $cookie_expire_date = time() + 10;
    setcookie("wrong_secret", "true", $cookie_expire_date, "/");
    header("Location: register.php");
    exit();
}

//ENCRIPTAR LA CONTRASEÑA

$options = [
    'cost' => 12
];
$final_password = password_hash($password,PASSWORD_BCRYPT,$options);

//FIN DE ENCRIPTACIÓN DE LA CONTRASEÑA


// Validar y sanitizar entrada
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "final_db");
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}
// Prevenir inyección SQL

// Preparar la consulta SQL
$query = $conexion->prepare("INSERT INTO `users` (`email`, `password`, `user_name`, `user_lastname`)
VALUES (?, ?, ?, ?)");

// Vincular los parámetros
$query->bind_param('ssss', $email, $final_password, $user_name, $user_lastname);

// Ejecutar la consulta
$query->execute();

// Verificar si la inserción fue exitosa
if ($query->affected_rows > 0) {
    // Cerrar la conexión
    $query->close();
    $conexion->close();

    $cookie_expire_date = time() + 5;
    setcookie("register_ok", "true", $cookie_expire_date, "/");
    header("Location: login.php");
    exit();
} else {
        // Cerrar la conexión
    $query->close();
    $conexion->close();

    $cookie_expire_date = time() + 5;
    setcookie("register_error", "true", $cookie_expire_date, "/");
    header("Location: register.php");
    exit();
}



?>

