<?php


include_once '../queries/conexion.php';


$nombres = $_POST["nombres"];
$correo = $_POST["correo"];
$asunto = $_POST["asunto"];
$detalles = $_POST["detalles"];



        $query = "INSERT INTO pqrs (nombres, correo, asunto, detalles) VALUES ('$nombres', '$correo', '$asunto', '$detalles')";

        if (mysqli_query($conn, $query)) {
            echo '<script type="text/javascript">
            alert("Ha sido enviado con éxito");
            window.location.href="/proyectoGrupoScout/";
            </script>';
        } else {
            echo '<script type="text/javascript">
            alert("Error");
            window.location.href="/proyectoGrupoScout/views/contacto.php";
            </script>';
        }
