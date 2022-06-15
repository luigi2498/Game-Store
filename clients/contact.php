<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preload" href="../css/normalize.css" as="style">
    <link rel="stylesheet" href="../css/normalize.css">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preload" href="../css/stylesClient.css" as="style">
    <link rel="stylesheet" href="../css/stylesClient.css">
    <title>FrontEnd Store</title>
    <link rel="icon" type="image/png" href="../files/img/alien.png"/>
    <script src="../js/jquery-3.6.0.js"></script>
    <script>
        function validate(){     // Validate filled fields with JS.
            var name = document.Form1.name.value;
            var mail = document.Form1.mail.value;
            var text = document.Form1.text.value;            

            if (name == "" || mail == "" || text == ""){
                $('#mensaje').html('Error: faltan campos por llenar...');
                setTimeout("$('#mensaje').html('');", 5000);
            }

            else{ 
                document.Form1.method='post';
                document.Form1.action='send_mail.php';
                document.Form1.submit();
            }
        }
    </script>
</head>

<body>
    <header class="header">
        <a href="index.php">
            <img class="header__logo" src="../files/img/logo.png" alt="logotipo">
        </a>
    </header>

    <nav class="navegacion">
        <a class="navegacion__enlace" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="products.php">Productos</a>
        <a class="navegacion__enlace navegacion__enlace--activo" href="contact.php">Contacto</a>
        <a class="navegacion__enlace" href="cart01.php">Carrito</a>
    </nav>

    <main class="contenedor">
        <h1>Nosotros</h1>
</html>

<?php
    require "../functions/connect.php";    // Include lib.
    $con = connect();

    session_start();

    $sql = "SELECT * FROM banners WHERE status = 1 AND deleted = 0 ORDER BY RAND()";
    $res = $con -> query($sql);
    $row = $res -> fetch_assoc();

    $file_n = $row['file_n'];           // Full file's name.
    $file_encrypted = $row['file'];     // Encrypted file's name.

    if ($file_n != ''){
        $string = explode(".", $file_n);    // Take file's extension.
        $ext = $string[1];                  // After the dot.
        $new_name = "$file_encrypted.$ext"; // Full string encrypted file's name.
    }

    echo"
        <div class='nosotros'>
            <div class='nosotros__contenido'>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent molestie metus quis justo interdum convallis. Praesent mauris est, faucibus in sapien non, auctor fringilla nunc. Etiam commodo diam non nunc ultrices, vitae euismod lorem venenatis. Pellentesque at neque a nisl iaculis volutpat. Nullam interdum quam vitae ullamcorper tincidunt. Suspendisse malesuada ac dolor in ultricies. Curabitur enim sem, fermentum vel lectus non, mattis volutpat dui. Duis porta metus quis lorem eleifend sodales. Curabitur eget urna ut tellus lobortis varius.
                </p>
                <p>
                    Sed commodo ultricies nibh ac varius. Praesent vitae scelerisque nisi. Praesent ac tellus auctor, porta odio ut, ultrices metus. Curabitur eget nisi tincidunt, aliquet tortor vitae, luctus purus. Sed quis enim in tellus sodales laoreet ac at ligula. Nunc ut sapien sodales, egestas ligula in, tempor mauris.
                </p>
            </div>
            <img class='nosotros__imagen' src='../files/banners/$new_name' alt='Imagen nosotros'>
        </div>";
?>

<html>
    </main>

    <section class="contenedor comprar">
        <h2 class="comprar__titulo">¿Por qué comprar con nosotros?</h2>

        <div class="bloques">
            <div class="bloque">
                <img class="bloque__imagen" src="../files/img/icono_1.png" alt="Por qué comprar">
                <h3 class="bloque__titulo">El mejor precio</h3>
                <p>
                    Vestibulum mollis lacus vitae tellus efficitur, et ultricies nibh aliquam. Morbi vel dapibus risus. Praesent maximus lobortis fringilla. Maecenas vitae posuere sem.
                </p>
            </div> <!--.bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="../files/img/icono_2.png" alt="Por qué comprar">
                <h3 class="bloque__titulo">Para devs</h3>
                <p>
                    Vestibulum mollis lacus vitae tellus efficitur, et ultricies nibh aliquam. Morbi vel dapibus risus. Praesent maximus lobortis fringilla. Maecenas vitae posuere sem.
                </p>
            </div> <!--.bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="../files/img/icono_3.png" alt="Por qué comprar">
                <h3 class="bloque__titulo">Envío gratis</h3>
                <p>
                    Vestibulum mollis lacus vitae tellus efficitur, et ultricies nibh aliquam. Morbi vel dapibus risus. Praesent maximus lobortis fringilla. Maecenas vitae posuere sem.
                </p>
            </div> <!--.bloque-->
            <div class="bloque">
                <img class="bloque__imagen" src="../files/img/icono_4.png" alt="Por qué comprar">
                <h3 class="bloque__titulo">La mejor calidad</h3>
                <p>
                    Vestibulum mollis lacus vitae tellus efficitur, et ultricies nibh aliquam. Morbi vel dapibus risus. Praesent maximus lobortis fringilla. Maecenas vitae posuere sem.
                </p>
            </div> <!--.bloque-->
        </div> <!--.bloques-->
    </section>

    <section class="contenedor comprar">
        <h1>Formulario de contacto</h1>
        <form class="formulario" name="Form1">
            <input class="formulario__campo" type="text" name="name" id="name" placeholder="Escribe tu nombre">
            <input class="formulario__campo" type="email" name="mail" id="mail" placeholder="Escribe tu correo">
            <textarea class="formulario__campo" name="text" id="text"></textarea>
            <input class="formulario__submit" type="submit" value="Enviar" onclick="validate(); return false;">
            <div class="mensaje" id="mensaje"></div>
        </form>
    </section>

    <footer class="footer">
        <p class="footer__texto">
            Front-End Store (Andrés Aguilar) - Todos los derechos reservados 2022.
        </p>
    </footer>
</body>
</html>