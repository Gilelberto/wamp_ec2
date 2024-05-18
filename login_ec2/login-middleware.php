<?php 
   
    $email = $_POST['email'];
    $password=$_POST['password'];

    $conexion = mysqli_connect("localhost","root","","final_db");
    $query = "select * from users where email = '".$email."'; ";
    $resultado = mysqli_query($conexion,$query);
    $registro = mysqli_fetch_array($resultado);
    

    $correct_email = $registro["email"];
    $correct_password = $registro["password"];
    $user_name = $registro["user_name"];

    if($correct_email == $email && $correct_password == $password){
        //ENVÍA A BIENVENIDA
        //setear cookie
        $cookie_expire_date = time() + 60;

        /*
        no va  a ser suficiente un cookie usuario, se va a necesitar un mpetodo de autenticación
        que el valor guardado en el cookie usuario valide la sesión, por ejemplo un jwt.
       */
        setcookie("usuario",$user, $cookie_expire_date);
        header("Location: welcome.php");
    }
    else{
        header("Location: login.php");

        //MOSTRAR MENSAJE DE QUE ESTÁ MAL
        $cookie_expire_date = time() + 5;
        setcookie("credentials_error","true", $cookie_expire_date);
    } 

?>
