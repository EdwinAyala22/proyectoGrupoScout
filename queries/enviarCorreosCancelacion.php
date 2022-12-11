<?php
require '../views/templates/styles.php';
require './conexion.php';
?>
<div class="vh-100 d-flex justify-content-center align-items-center">
    <span class="spinner-border" role="status"></span>
    <div class="visually-hidden">


<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

    // $usuarios = array(
    //     "esayala86@misena.edu.co" => "Edwin",
    //     "recalde22ayala@gmail.com" => "Recalde",
    //     "e22ayalarecalde@gmail.com" => "Sebastian"
    // );

    // $noUsuarios = array();
    $mensaje = "";

    if (isset($_POST['id_act'])) {
        $id_act = $_POST['id_act'];
        $nombreAct = $_POST['nombreAct'];
        $consulta_inscritos = "SELECT * FROM inscritos WHERE id_act = $id_act";
        $result_consulta_inscritos = mysqli_query($conn, $consulta_inscritos);
        $nr_consulta_inscritos = mysqli_num_rows($result_consulta_inscritos);
        if ($nr_consulta_inscritos != 0) {

            //Hay inscritos en ese evento
            $sql_insc_evento = "SELECT * FROM inscritos WHERE id_act = $id_act";
            $result_sql_insc_evento = mysqli_query($conn, $sql_insc_evento);

            $contador = 0;
            //Import PHPMailer classes into the global namespace
            //These must be at the top of your script, not inside a function

            // $id_act = 'Eje';    
            // $nombreAct = 'EJEMPLO 3';
            $asunto = 'CANCELACIÓN DE LA ACTIVIDAD: ' . $nombreAct . '';
            $detalles = 'La actividad se canceló por x razones';

            //Load Composer's autoloader
            // require 'vendor/autoload.php';
            require "../assets/lib/PHPMailer/src/PHPMailer.php";
            require "../assets/lib/PHPMailer/src/SMTP.php";
            require "../assets/lib/PHPMailer/src/Exception.php";



            //Create an instance; passing `true` enables exceptions
            $mail = new PHPMailer(true);

            try {
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'gruposcoutlb662@gmail.com';                     //SMTP username
                $mail->Password   = 'gghugsxcxdvwedzo';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('gruposcoutlb662@gmail.com', utf8_decode('Grupo Scout 662 León Blanco'));
                while ($mostrar = mysqli_fetch_array($result_sql_insc_evento)) {
                    $mail->addAddress('' . $mostrar['correoIns'] . '', '' . $mostrar['nombreC'] . '');     //Add a recipient
                }
                // $mail->addAddress(''.$correo.'', ''.$nombres.'');     //Add a recipient
                // $mail->addAddress('ellen@example.com');               //Name is optional
                // $mail->addReplyTo('info@example.com', 'Information');
                // $mail->addCC('cc@example.com');
                // $mail->addBCC('bcc@example.com');

                //Attachments
                // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = '' . utf8_decode($asunto) . '';
                $mail->Body    = '' . $detalles . '';
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                // echo 'Message has been sent';

                $query = "DELETE FROM inscritos WHERE id_act = '$id_act'";
                $result = mysqli_query($conn, $query);
                if ($result) {
                    $queryRamEl = "DELETE FROM ramas_actividades WHERE id_act = $id_act";
                    $resultRamEl = mysqli_query($conn, $queryRamEl);
                    if ($resultRamEl) {
                        $query2 = "DELETE FROM f_actividades WHERE id_act = '$id_act'";
                        $result2 = mysqli_query($conn, $query2);
                        if ($result2) {
                            // header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
                            $mensaje = '<script lang="javascript">
                            swal.fire({
                                "title":"¡Evento eliminado!",
                                "text": "El evento se ha eliminado exitosamente",
                                "icon": "success",
                                "confirmButtonText": "Aceptar",
                                "confirmButtonColor": "#1e0941",
                                "allowOutsideClick": false,
                                "allowEscapeKey" : false
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                                }
                            });
                            
                        </script>';
                        } else {
                            // echo "Error eliminando el evento seleccionado.";
                            $mensaje = '<script lang="javascript">
                            swal.fire({
                                "title":"¡Error!",
                                "icon": "error",
                                "confirmButtonText": "Aceptar",
                                "confirmButtonColor": "#ed1b25",
                                "allowOutsideClick": false,
                                "allowEscapeKey" : false
                            }).then((result)=>{
                                if (result.isConfirmed){
                                    window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                                }
                            });
                            
                        </script>';
                        }
                    } else {
                        $mensaje = '<script lang="javascript">
                        swal.fire({
                            "title":"¡Error!",
                            "icon": "error",
                            "confirmButtonText": "Aceptar",
                            "confirmButtonColor": "#ed1b25",
                            "allowOutsideClick": false,
                            "allowEscapeKey" : false
                        }).then((result)=>{
                            if (result.isConfirmed){
                                window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                            }
                        });
                        
                    </script>';
                    }
                } else {
                    // echo "Error eliminando inscritos.";
                    $mensaje = '<script lang="javascript">
                    swal.fire({
                        "title":"¡Error!",
                        "icon": "error",
                        "confirmButtonText": "Aceptar",
                        "confirmButtonColor": "#ed1b25",
                        "allowOutsideClick": false,
                        "allowEscapeKey" : false
                    }).then((result)=>{
                        if (result.isConfirmed){
                            window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                        }
                    });
                    
                </script>';
                }
                // header("Location: /proyectoGrupoScout/views/admin/listPqrs.php");

            } catch (Exception $e) {
                $mensaje = '<script lang="javascript">
                    swal.fire({
                        "title":"¡Error!",
                        "text": "Error al enviar los correos.",
                        "icon": "error",
                        "confirmButtonText": "Aceptar",
                        "confirmButtonColor": "#ed1b25",
                        "allowOutsideClick": false,
                        "allowEscapeKey" : false
                    }).then((result)=>{
                        if (result.isConfirmed){
                            window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                        }
                    });
                    
                </script>';
            }
        } else {
            // No hay inscritos en el evento
            $sql_ramas_evento = "DELETE FROM ramas_actividades WHERE id_act = $id_act";
            $result_sql_ramas_evento = mysqli_query($conn, $sql_ramas_evento);
            if($result_sql_ramas_evento){

                $sql_eliminar_evento = "DELETE FROM f_actividades WHERE id_act = '$id_act'";
                $result_sql_eliminar_evento = mysqli_query($conn, $sql_eliminar_evento);
                if ($result_sql_eliminar_evento) {
                    $mensaje = '<script lang="javascript">
                    swal.fire({
                        "title":"¡Evento eliminado!",
                        "text": "El evento se ha eliminado exitosamente",
                        "icon": "success",
                        "confirmButtonText": "Aceptar",
                        "confirmButtonColor": "#1e0941",
                        "allowOutsideClick": false,
                        "allowEscapeKey" : false
                    }).then((result)=>{
                        if (result.isConfirmed){
                            window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                        }
                    });
                    
                </script>';
                    // header("Location: /proyectoGrupoScout/views/admin/listEventos.php");
                } else {
                    // echo "Error eliminando el evento seleccionado.";
                    $mensaje = '<script lang="javascript">
                        swal.fire({
                            "title":"¡Error!",
                            "text": "Error al intentar eliminar el evento.",
                            "icon": "error",
                            "confirmButtonText": "Aceptar",
                            "confirmButtonColor": "#ed1b25",
                            "allowOutsideClick": false,
                            "allowEscapeKey" : false
                        }).then((result)=>{
                            if (result.isConfirmed){
                                window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                            }
                        });
                        
                    </script>';
                }
            }else{
                
                $mensaje = '<script lang="javascript">
                swal.fire({
                    "title":"¡Error!",
                    "text": "Error al intentar eliminar las ramas del evento.",
                    "icon": "error",
                    "confirmButtonText": "Aceptar",
                    "confirmButtonColor": "#ed1b25",
                    "allowOutsideClick": false,
                    "allowEscapeKey" : false
                }).then((result)=>{
                    if (result.isConfirmed){
                        window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
                    }
                });
                
            </script>';

            }

        }
    } else {
        $mensaje = '<script lang="javascript">
    swal.fire({
        "title":"¡Error!",
        "icon": "error",
        "confirmButtonText": "Aceptar",
        "confirmButtonColor": "#ed1b25",
        "allowOutsideClick": false,
        "allowEscapeKey" : false
    }).then((result)=>{
        if (result.isConfirmed){
            window.location = "/proyectoGrupoScout/views/admin/listEventos.php";
        }
    });
    
</script>';
    }


    ?>

    </div>
</div>
<!-- Scripts Bootstrap 5.1.3  -->
<script src="/proyectoGrupoScout/assets/lib/bootstrap-5.1.3-dist/js/bootstrap.bundle.js"></script>
<?php

require '../views/templates/scripts.php';

echo $mensaje;
?>