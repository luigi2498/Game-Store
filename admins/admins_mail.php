<?php
    // mail validation (mail.php)
    require "../functions/connect.php";
    $con = connect();

    // Request variables.
    $mail = $_REQUEST['mail'];

    $sql = "SELECT * FROM admins WHERE mail = '$mail'
            AND status = 1 AND deleted = 0";

    $res = $con -> query($sql);
    $row = mysqli_num_rows($res);

    if ($row == 0){
        echo 1;
    }

    else{
        echo 0;
    }
?>