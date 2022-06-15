<?php
    session_start();
    if (!isset($_SESSION['user'])){    // If there's not an active session...
        header("Location: index.php");
    }

    else{
        $user = $_SESSION['user'];
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
    <title>Bienvenida</title>
    <script src="../js/jquery-3.6.0.js"></script>
</head>
<!-- Aguilar Lopez Andres - Programacion para Internet D05 22A -->
<body>
    <nav class="navegacion">
        <a class="navegacion__enlace navegacion__enlace--activo" href="index.php">Inicio</a>
        <a class="navegacion__enlace" href="admins_list.php">Administradores</a>
        <a class="navegacion__enlace" href="products_list.php">Productos</a>
        <a class="navegacion__enlace" href="banners_list.php">Banners</a>
        <a class='navegacion__enlace' href="orders_list.php">Pedidos</a>
        <a class="navegacion__enlace" href="logout.php">Cerrar sesión</a>
    </nav>

    <h1 align='center'>¡Bienvenido <?php echo $user; ?>!</h1>
</body>

<footer>

</footer>
</html>