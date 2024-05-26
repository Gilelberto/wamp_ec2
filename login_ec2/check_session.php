<?php

//session_start();
if(!isset($_SESSION["usr_id"])){
    header("Location: login.php");
    exit();
}