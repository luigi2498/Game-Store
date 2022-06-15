<?php
    // send_mail.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $to = $_REQUEST['mail'];
    $name = $_REQUEST['name'];
    $text = $_REQUEST['text'];

    $subject = "Formulario de contacto - Game Store";

    $message = "<html><head></head><body>";
    $message .= "<p>Copia del mensaje: </p>
                <p>$text</p><p></p>
                <p>Gracias por suscribirte a nuestro newsletter, por este medio te estarán llegando todas las promociones de nuestra tienda.</p>
                <p>Recuerda que no es necesario que respondas a este correo electrónico.</p>
                <p>Gracias: $name</p>
                <p>Equipo de soporte Game Store.</p>";
    $message .= "<p><img src='https://i.ibb.co/K5MqBfm/logo.png'/></p></body></html>";

    $headers = "From: tiendragamestore@gmail.com\nMIME-Version: 1.0\nContent-Type: text/html; charset=utf-8\n";

    mail($to, $subject, $message, $headers);

    header("Location: index.php");
?>