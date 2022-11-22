<?php

session_start();

if (!isset($_SESSION['rol'])) {
    header("Location: /proyectoGrupoScout/views/login.php");
} 


?>
<?php

include_once './conexion.php';

$class = "visually-hidden";
$error = "";
$documento = $_GET['id'];

if(empty($documento)){
    header("Location: /proyectoGrupoScout/views/login.php");
}

$contrasena = $_POST['contrasena'];
$nuevaContrasena = $_POST['nuevaContrasena'];
$confirmarContrasena = $_POST['confirmarContrasena'];

$query = "SELECT contrasena FROM usuarios WHERE documento = $documento";
$resultado= mysqli_query($conn,$query);
$mostrar = mysqli_fetch_array($resultado);
$queryContrasena = $mostrar['contrasena'];

if($contrasena === $queryContrasena){
    if($nuevaContrasena === $confirmarContrasena){
        $queryCambiarContrasena = "UPDATE usuarios set contrasena = '$confirmarContrasena' WHERE documento = $documento";
        $resultadoCambiarContrasena = mysqli_query($conn, $queryCambiarContrasena);
        if($resultadoCambiarContrasena){
            echo '<script type="text/javascript">
            alert("La contraseña ha sido actualizada");
            window.location.href="/proyectoGrupoScout/views/scouts/perfilScout.php/#perfil";
            </script>';
        }else{
            $class = "alert alert-danger alert-dismissible fade show text-center";
            $error = "Error. Digite de nuevo los datos";
        }
    }else{
        $class = "alert alert-danger alert-dismissible fade show text-center";
        $error = "La nueva contraseña no coincide en ambos campos.";
    }
}else{
    $class = "alert alert-danger alert-dismissible fade show text-center";
    $error = "Las contraseñas no coinciden.";
}



echo '</br>';
echo $contrasena;
echo '</br>';
echo $nuevaContrasena;
echo '</br>';
echo $confirmarContrasena;



?>