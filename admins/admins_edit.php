<?php
    // admins_edit.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM admins WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row['name'];
    $second_name = $row['second_name'];
    $mail = $row['mail'];
    $role = $row['role'];

    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <link href='https://fonts.googleapis.com/css2?family=Roboto&display=swap' rel='stylesheet'>
        <link rel='preload' href='../css/styles.css' as='style'>
        <link rel='stylesheet' href='../css/styles.css'>
        <title>Editar usuario</title>
        <script src='../js/jquery-3.6.0.js'></script>
        <script>
            function validar(){     // Validar campos llenos con JS.
                var name = document.Form1.name.value;
                var second_name = document.Form1.second_name.value;
                var mail = document.Form1.mail.value;
                var role = document.Form1.role.value;
    
                if (name == '' || second_name == '' || mail == '' || role == 0){
                    $('#mensaje').html('Error: faltan campos por llenar...');
                    setTimeout(\"$('#mensaje').html('');\", 5000);
                }
    
                else{
                    document.Form1.method='post';
                    document.Form1.action='admins_saveEdit.php';
                    document.Form1.submit();
                }
            }
    
            function validarMail(){     // Validar email existente en BD - JAX.
                var mail = $('#mail').val();
                $.ajax({
                    url         : 'admins_mailEdit.php',
                    type        : 'post',
                    dataType    : 'text',
                    data        : ('id=' + $id + '&mail=' + mail),
                    success     : function(res){
                        if (res == 0){
                            $('#mensaje').html('El correo ' + mail + ' ya existe...');
                            $('#mail').val('');
                            setTimeout(\"$('#mensaje').html('');\", 5000);
                        }
                    }
                })
            }
    
            function limpiaCampo(){     // Funcion para limpiar el campo el email.
                $('#mensaje').html('');
            }
        </script>
    </head>
    <!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->";

    echo "<body>
            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='admins_list.php'>Usuarios</a>
                <a class='navegacion__enlace' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "<div>
            <form class='formulario' name='Form1' enctype='multipart/form-data'>
                <legend>Editar usuario</legend>
                <div class='campo'>
                    <label>Nombre:</label>
                    <input class='inputText' type='text' name='name' id='name' placeholder='Escribe tu nombre' value='$name'>
                </div>
                <div class='campo'>
                    <label>Apellidos:</label>
                    <input class='inputText' type='text' name='second_name' id='second_name' placeholder='Escribe tus apellidos' value='$second_name'><br>
                </div>
                <div class='campo'>
                    <label>E-mail:</label>
                    <input class='inputText' type='email' name='mail' id='mail' placeholder='Escribe tu correo' onFocus='limpiaCampo();' onBlur='validarMail();' value='$mail'><br>
                </div>
                <div class='campo'>
                    <label>Contraseña</label>
                    <input class='inputText' type='password' name='pass' id='pass' placeholder='Escribe tu contraseña'><br>
                </div>
                <div class='campo'>
                    <label>Rol:</label>
                    <select class='inputText' name='role' id='role'>
                        <option value='0'>Selecciona una opción</option>";
                        if ($role == 1){
                            echo "<option value='1' selected='selected'>Administrador</option>
                                <option value='2'>Proveedor</option>";
                        }
                        else{
                            echo "<option value='1'>Administrador</option>
                                <option value='2' selected='selected'>Proveedor</option>";
                        }
            echo    "</select>
                </div>
                <div class='campo'>
                    <label>Imagen de perfil</label>
                    <input type='file' id='file1' name='file1'>
                </div>
                <input type='hidden' name='id' id='id' value='$id'>
                <div class='campo'>
                    <input class='boton subir' type='submit' value='Guardar' class='boton_agregar' onclick='validar(); return false;'>
                </div>
                <div class='campo mensaje' id='mensaje'></div>
            </form></div><br>
            <br><a class='boton principal' href='admins_list.php' class='boton_regresar'>Regresar</a></body>
          </html>";
?>