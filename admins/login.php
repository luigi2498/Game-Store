<?php
    // login validation (login.php)
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $mail = $_REQUEST['mail'];
    $pass = $_REQUEST['pass'];
    $passEncrypted = md5($pass);

    $sql = "SELECT * FROM users WHERE mail = '$mail' AND pass = '$passEncrypted'
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

        // Audit info.
        $admin = $_SESSION['user'];
        date_default_timezone_set("America/Mexico_City");
        $date = date("d-m-Y");
        $time = date("h:i:sa");

        $sql = "INSERT INTO audit(user_name, statement, current_table, execution_date, execution_time)
        VALUES('$admin', 'LOGIN', 'users', '$date', '$time')";

        $res = $con -> query($sql);     // Audit statement.

        echo 0;        
    }
?>