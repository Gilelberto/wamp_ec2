<?php 
$email = $_POST['email'];
$password = $_POST['password'];

// Validar y sanear entrada
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Conexión a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "final_db");
if (!$conexion) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prevenir inyección SQL
$query = $conexion->prepare("SELECT * FROM users WHERE email = ?");
$query->bind_param('s', $email);
$query->execute();
$resultado = $query->get_result();
$registro = $resultado->fetch_assoc();

if ($registro && $password == $registro["password"]) {
    // Autenticación exitosa
    $cookie_expire_date = time() + 60;
    setcookie("usuario", $registro["user_name"], $cookie_expire_date, "/");
    header("Location: welcome.php");
    exit();
} else {
    // Credenciales incorrectas
    $cookie_expire_date = time() + 5;
    setcookie("credentials_error", "true", $cookie_expire_date, "/");
    header("Location: login.php");
    exit();
}
?>

