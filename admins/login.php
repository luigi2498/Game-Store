<?php
    // login validation (login.php)
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    $passEncrypted = md5($pass);

    $sql = "SELECT * FROM admins WHERE mail = '$mail' AND pass = '$passEncrypted'
            AND status = 1 AND deleted = 0";

    $res = $con -> query($sql);
    $row = mysqli_num_rows($res);

    if ($row == 0){ // Doesn't exists...
        echo 1;
    }

    else{   // Exists - Create Session...
        session_start();
        $name = mysqli_fetch_row($res);
        $_SESSION['user'] = $name[1].' '.$name[2];
        echo 0;
    }
?>