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

if ($registro && $password == $registro["password"]) {
    // Autenticación exitosa
    session_start();
    // ******REGRESARLA A SU TIEMPO DE 30 MINUTOS UNA VEZ TERMINADO EL PROYECTO******
    //$session_lifetime = 60 * 30;

    //$session_lifetime = 60 * 3;

    //$session_lifetime =  5;

    // Configurar el tiempo de vida de la sesión
    //ini_set('session.gc_maxlifetime', $session_lifetime);
    //ini_set('session.cookie_lifetime', $session_lifetime);

    

    // Configurar el tiempo de vida de la cookie de sesión
    //setcookie(session_name(), session_id(), time() + $session_lifetime);
   // setcookie("usuario", $registro["user_name"],time() + $session_lifetime, "/");

    $_SESSION['usr_id'] = $registro['user_id'];

    //$cookie_expire_date = time() + 60;
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

