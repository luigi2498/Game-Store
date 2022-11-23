<?php
    // products_edit.php
    require "../functions/connect.php";
    $con = connect();
    
    $id = $_REQUEST['id'];

    $sql = "SELECT * FROM products WHERE id = $id";

    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $name = $row['name'];
    $code = $row['code'];
    $description = $row['description'];
    $price = $row['price'];
    $stock = $row['stock'];

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
        <title>Editar producto</title>
        <script src='../js/jquery-3.6.0.js'></script>
        <script>
            function validate(){     // Validate filled fields with JS.
                var name = document.Form1.name.value;
                var code = document.Form1.code.value;
                var description = document.Form1.description.value;
                var price = document.Form1.price.value;
                var stock = document.Form1.stock.value;

                if (name == '' || code == '' || description == '' || price == '' || stock == 0){
                    $('#mensaje').html('Error: faltan campos por llenar...');
                    setTimeout(\"$('#mensaje').html('');\", 5000);
                }

                else{ 
                    document.Form1.method='post';
                    document.Form1.action='products_saveEdit.php';
                    document.Form1.submit();
                }
            }
    
            function validateCode(){     // Validate an existing code in the DB using AJAX.
                var code = $('#code').val();
                $.ajax({
                    url         : 'products_codeEdit.php',
                    type        : 'post',
                    dataType    : 'text',
                    data        : ('id=' + $id + '&code=' + code),
                    success     : function(res){
                        if (res == 0){
                            $('#mensaje').html('El código \"' + code + '\" ya existe...');
                            $('#code').val('');
                            setTimeout(\"$('#mensaje').html('');\", 5000);
                        }
                    }
                })
            }
    
            function clearField(){     // Clear message's field.
                $('#mensaje').html('');
            }
        </script>
    </head>
    <!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->";

    echo "<body>
            <nav class='navegacion'>
                <a class='navegacion__enlace' href='index.php'>Inicio</a>
                <a class='navegacion__enlace' href='admins_list.php'>Usuarios</a>
                <a class='navegacion__enlace navegacion__enlace--activo' href='products_list.php'>Productos</a>
                <a class='navegacion__enlace' href='banners_list.php'>Banners</a>
                <a class='navegacion__enlace' href='orders_list.php'>Pedidos</a>
                <a class='navegacion__enlace' href='logout.php'>Cerrar sesión</a>
            </nav><br><br>";

    echo "<div>
            <form class='formulario' name='Form1' enctype='multipart/form-data'>
                <legend>Editar producto</legend>
                <div class='campo'>
                    <label>Nombre: </label>
                    <input class='inputText' type='text' name='name' id='name' placeholder='Escribe el nombre' value='$name'>
                </div>
                <div class='campo'>
                    <label>Código: </label>
                    <input class='inputText' type='text' maxlength='32' name='code' id='code' placeholder='Ingrese el código' onFocus='clearField();' onBlur='validateCode();' value='$code'>
                </div>
                <div class='campo'>
                    <label>Descripción: </label>
                    <textarea name='description' id='description' placeholder='Escribe una descripción'>$description</textarea>
                </div>
                <div class='campo'>
                    <label>Precio: </label>
                    <input class='inputText' type='number' step='0.1' min='0.5' name='price' id='price' placeholder='Ingrese el precio' value='$price'>
                </div>
                <div class='campo'>
                    <label>Stock: </label>
                    <input class='inputText' type='number' step='1' min='1' name='stock' id='stock' placeholder='Escribe la cantidad en almacén' value='$stock'>
                </div>
                <div class='campo'>
                    <label>Foto: </label>
                    <input type='file' id='file1' name='file1'>
                </div>
                <input type='hidden' name='id' id='id' value='$id'>
                <div>
                    <label></label>
                    <input class='boton subir' type='submit' value='Guardar' class='boton_agregar' onclick='validate(); return false;'>
                </div>
                <div class='campo mensaje' id='mensaje'></div>
            </form></div><br>
            <br><a class='boton principal' href='products_list.php' class='boton_regresar'>Regresar</a></body>
          </html>";
?>