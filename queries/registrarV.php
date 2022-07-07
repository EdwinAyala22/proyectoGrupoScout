<?php

include_once '../queries/database.php';


$nombres = $_POST["nombres"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$tipodoc = $_POST["tipodoc"];
$documento = $_POST["documento"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];

$db = new Database();
$query = $db->connect()->prepare('SELECT * FROM usuarios WHERE documento =:documento AND contrasena =:contrasena');
    

?>