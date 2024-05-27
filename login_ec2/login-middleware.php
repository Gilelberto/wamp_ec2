<?php 

require_once 'config.php';


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


//OBTENER PASSWORD HASHEADO

$options = [
    'cost' => 12
];
$final_password = password_hash($password,PASSWORD_BCRYPT,$options);


if ($resultado->num_rows > 0 && password_verify($password,$registro["password"])) {
    // Autenticación exitosa
    session_start();
    $_SESSION['usr_id'] = $registro['user_id'];
    header("Location: welcome.php");
    exit();

} else {
    $cookie_expire_date = time() + 5;
    setcookie("credentials_error", "true", $cookie_expire_date, "/");
    header("Location: login.php");
    exit();
}
?>

