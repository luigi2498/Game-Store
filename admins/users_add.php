<?php
    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
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
    <title>Alta de Usuarios</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function validar(){     // Validate filled fields with JS.
            var name = document.Form1.name.value;
            var second_name = document.Form1.second_name.value;
            var mail = document.Form1.mail.value;
            var pass = document.Form1.pass.value;
            var role = document.Form1.rol.value;
            var file = document.Form1.file1.value;

            if (name == "" || second_name == "" || mail == "" || pass == "" || role == 0 || file == ""){
                $('#mensaje').html('Error: faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            }

            else{ 
                document.Form1.method='post';
                document.Form1.action='users_save.php';
                document.Form1.submit();
            }
        }

        function validarMail(){     // Validate an existing email in the DB using AJAX.
            var mail = $('#mail').val();
            $.ajax({
                url         : 'users_mail.php',
                type        : 'post',
                dataType    : 'text',
                data        : 'mail=' + mail,
                success     : function(res){
                    if (res == 0){
                        $('#mensaje').html('El correo "' + mail + '" ya existe...');
                        $('#mail').val('');
                        setTimeout("$('#mensaje').html('');", 5000);
                    }
                }
            })
        }

        function limpiaCampo(){     // Clear email's field.
            $('#mensaje').html('');
        }
    </script>
</head>
<!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->
<body>
    <nav class="navegacion">
        <a class="navegacion__enlace" href="index.php">Inicio</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="users_list.php">Usuarios</a>
        <a class="navegacion__enlace" href="products_list.php">Productos</a>
        <a class="navegacion__enlace" href="banners_list.php">Banners</a>
        <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
        <a class="navegacion__enlace" href="logout.php">Cerrar sesión</a>
    </nav>

    <br><br>

    <div>
        <form class="formulario" name="Form1" enctype="multipart/form-data">
            <legend>Alta de Usuarios</legend>
            <div class="campo">
                <label>Nombre: </label>
                <input class="inputText" type="text" name="name" id="name" placeholder="Escribe tu nombre">
            </div>
            <div class="campo">
                <label>Apellidos: </label>
                <input class="inputText" type="text" name="second_name" id="second_name" placeholder="Escribe tus apellidos">
            </div>
            <div class="campo">
                <label>E-mail: </label>
                <input class="inputText" type="email" name="mail" id="mail" placeholder="Escribe tu correo" onFocus="limpiaCampo();" onBlur="validarMail();">
            </div>
            <div class="campo">
                <label>Contraseña: </label>
                <input class="inputText" type="password" name="pass" id="pass" placeholder="Escribe tu contraseña">
            </div>
            <div class="campo">
                <label>Rol: </label>
                <select class="inputText" name="rol" id="rol">
                    <option value="0">Selecciona una opción</option>
                    <option value="1">Administrador</option>
                    <option value="2">Proveedor</option>
                </select>
            </div>
            <div class="campo">
                <label>Imagen de perfil: </label>
                <input type="file" id="file1" name="file1">
            </div>
            <div>
                <label></label>
                <input class="boton subir" type="submit" value="Guardar" class="boton_agregar" onclick="validar(); return false;">
            </div>
            <div class="campo mensaje" id="mensaje"></div>
        </form>
    </div>
    <br><a class="boton principal" href="users_list.php">Regresar</a>
</body>

<footer>

</footer>
</html>