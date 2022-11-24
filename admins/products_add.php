<?php
    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: ../index.php");
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
    <!-- FIX -->
    <style>
        textarea {
            height: 10rem;
            width: 100%;
            resize: none;
            border-radius: 0.5rem;
            font-family: 'Roboto';
        }
    </style>
    <!-- FIX -->
    <title>Alta de Productos</title>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function validate(){     // Validate filled fields with JS.
            var name = document.Form1.name.value;
            var code = document.Form1.code.value;
            var description = document.Form1.description.value;
            var price = document.Form1.price.value;
            var stock = document.Form1.stock.value;
            var file = document.Form1.file1.value;

            if (name == "" || code == "" || description == "" || price == "" || stock == 0 || file == ""){
                $('#mensaje').html('Error: faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            }

            else{ 
                document.Form1.method='post';
                document.Form1.action='products_save.php';
                document.Form1.submit();
            }
        }

        function validateCode(){     // Validate an existing code in the DB using AJAX.
            var code = $('#code').val();
            $.ajax({
                url         : 'products_code.php',
                type        : 'post',
                dataType    : 'text',
                data        : 'code=' + code,
                success     : function(res){
                    if (res == 0){
                        $('#mensaje').html('El código "' + code + '" ya existe...');
                        $('#code').val('');
                        setTimeout("$('#mensaje').html('');", 5000);
                    }
                }
            })
        }

        function clearField(){     // Clear message's field.
            $('#mensaje').html('');
        }
    </script>
</head>
<!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->
<body>
    <nav class="navegacion">
        <a class="navegacion__enlace" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="users_list.php">Usuarios</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="products_list.php">Productos</a>
        <a class="navegacion__enlace" href="banners_list.php">Banners</a>
        <a class='navegacion__enlace' href="orders_list.php">Pedidos</a>
        <a class="navegacion__enlace" href="logout.php">Cerrar sesión</a>
    </nav>

    <br><br>

    <div>
        <form class="formulario" name="Form1" enctype="multipart/form-data">
            <legend>Alta de productos</legend>
            <div class="campo">
                <label>Nombre: </label>
                <input class="inputText" type="text" name="name" id="name" placeholder="Escribe el nombre">
            </div>
            <div class="campo">
                <label>Código: </label>
                <input class="inputText" type="text" maxlength="32" name="code" id="code" placeholder="Ingrese el código" onFocus="clearField();" onBlur="validateCode();">
            </div>
            <div class="campo">
                <label>Descripción: </label>
                <textarea name="description" id="description" placeholder="Escribe una descripción"></textarea>
            </div>
            <div class="campo">
                <label>Precio: </label>
                <input class="inputText" type="number" step="0.1" min="0.5" name="price" id="price" placeholder="Ingrese el precio">
            </div>
            <div class="campo">
                <label>Stock: </label>
                <input class="inputText" type="number" step="1" min="1" name="stock" id="stock" placeholder="Escribe la cantidad en almacén">
            </div>
            <div class="campo">
                <label>Foto: </label>
                <input type="file" id="file1" name="file1">
            </div>
            <div>
                <label></label>
                <input class="boton subir" type="submit" value="Guardar" class="boton_agregar" onclick="validate(); return false;">
            </div>
            <div class="campo mensaje" id="mensaje"></div>
        </form>
    </div>
    <br><a class="boton principal" href="products_list.php">Regresar</a>
</body>

<footer>

</footer>
</html>