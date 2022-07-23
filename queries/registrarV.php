<?php

include_once '../queries/database.php';
include_once '../queries/conexion.php';


$nombres = $_POST["nombres"];
$apellido1 = $_POST["apellido1"];
$apellido2 = $_POST["apellido2"];
$tipodoc = $_POST["tipodoc"];
$documento = $_POST["documento"];
$telefono = $_POST["telefono"];
$correo = $_POST["correo"];
$contrasena = $_POST["contrasena"];

// $db = new Database();
// $query = $db->connect()->prepare('INSERT INTO visitantes (nombres, apellido1, apellido2, tipodoc, documento, telefono, correo, contrasena) VALUES (:nombres, :apellido1, :apellido2, :tipodoc, :documento, :telefono, :correo, :contrasena)');
// $query->execute(['nombres' => $nombres, 'apellido1' => $apellido1, 'apellido2' => $apellido2, 'tipodoc' => $tipodoc, 'documento' => $documento, 'telefono' => $telefono, 'correo' => $correo, 'contrasena' => $contrasena]); 
// $row = $query->fetch(PDO::FETCH_NUM);
// if ($row==true){
//     echo'<script type="text/javascript">
//     alert("registro hecho");
//     window.location.href="http://localhost:8080/proyectoGrupoScout/views/login.php";
//     </script>';
// }

$sql = "SELECT * FROM visitantes WHERE documento = '$documento'";
$result = mysqli_query($conn, $sql);
$rows = mysqli_num_rows($result);

if($rows){
    echo'<script type="text/javascript">
    alert("Error, el documento ya existe");
    window.location.href="http://localhost:8080/proyectoGrupoScout/views/register.php";
    </script>';
}else{
    $query = "INSERT INTO visitantes (nombres, apellido1, apellido2, tipodoc, documento, telefono, correo, contrasena) VALUES ('$nombres', '$apellido1', '$apellido2', '$tipodoc', '$documento', '$telefono', '$correo', '$contrasena')";

    if (mysqli_query($conn, $query)) {
        echo'<script type="text/javascript">
        alert("Registro realizado con éxito");
        window.location.href="http://localhost:8080/proyectoGrupoScout/views/login.php";
        </script>';
    } else {
        echo'<script type="text/javascript">
        alert("Error");
        window.location.href="http://localhost:8080/proyectoGrupoScout/views/register.php";
        </script>';
    }
}
