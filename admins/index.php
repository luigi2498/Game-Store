<?php
    session_start();
    if (isset($_SESSION['user'])){      // If there's an active session...
        header("Location: welcome.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/styles.css" as="style">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Iniciar Sesión</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function validate(){
            var mail = document.Form1.mail.value;
            var pass = document.Form1.pass.value;

            if (mail == "" || pass == ""){
                $('#mensaje').html('Error: faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            }

            else{
                login();
            }
        }

        function login(){
            var mail = $('#mail').val();
            var pass = $('#pass').val();
            $.ajax({
                url         : 'login.php',
                type        : 'post',
                dataType    : 'text',
                data        : 'mail=' + mail + '&pass=' + pass,
                success     : function(res){
                    if (res == 0){      // Login...
                        window.location = "welcome.php";
                    }

                    else{   // Wrong information...
                        $('#mensaje').html('Datos incorrectos...');
                        $('#mail').val('');
                        $('#pass').val('');
                        setTimeout("$('#mensaje').html('');", 5000);
                    }
                }
            })
        }
    </script>
</head>
<!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->
<body>
    <nav class="navegacion">
        <a class="navegacion__enlace navegacion__enlace--activo" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="admins_list.php">Administradores</a>
        <a class="navegacion__enlace" href="products_list.php">Productos</a>
        <a class="navegacion__enlace" href="banners_list.php">Banners</a>
        <a class='navegacion__enlace' href="orders_list.php">Pedidos</a>
    </nav>

    <br><br>

    <div>
        <form class="formulario" name="Form1">
            <legend>Iniciar Sesión</legend>
            <div class="campo">
                <label>Correo: </label>
                <input class="inputText" type="email" name="mail" id="mail" placeholder="Escribe tu correo">
            </div>
            <div class="campo">
                <label>Contraseña: </label>
                <input class="inputText" type="password" name="pass" id="pass" placeholder="Escribe tu contraseña">
            </div>
            <div class="enviar">
                <input class="boton subir" type="submit" value="Enviar" class="boton_agregar" onclick="validate(); return false;">
            </div>
            <div class="campo mensaje" id="mensaje"></div>
        </form>
    </div>
</body>

<footer>

</footer>
</html>