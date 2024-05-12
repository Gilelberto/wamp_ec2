<?php 
    $email = "test@uach.mx";
    $password="abcd1234";

    /*
    * AQUÍ HACER LA CONEXIÓN A LA BASE DE DATOS PARA VERIFICAR SÍ ESTÁ TODO BIEN
    */

    if($email == $_POST["email"] && $password == $_POST["password"]){
        //ENVÍA A BIENVENIDA
        //setear cookie
        $cookie_expire_date = time() + 60;

        /*
        no va  a ser suficiente un cookie usuario, se va a necesitar un mpetodo de autenticación
        que el valor guardado en el cookie usuario valide la sesión, por ejemplo un jwt.
        */
        setcookie("usuario","USUARIO PRUEBA", $cookie_expire_date);
        header("Location: welcome.php");
    }
    else{
        header("Location: login.php");

        //MOSTRAR MENSAJE DE QUE ESTÁ MAL
        $cookie_expire_date = time() + 5;
        setcookie("credentials_error","true", $cookie_expire_date);
    }

?>