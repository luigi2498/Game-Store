<?php
    // users_logout.php
    require "../functions/connect.php";
    $con = connect();
    
    session_start();

    // Audit info.
    $admin = $_SESSION['user'];
    date_default_timezone_set("America/Mexico_City");
    $date = date("d-m-Y");
    $time = date("h:i:sa");

    $sql = "INSERT INTO audit(user_name, statement, current_table, execution_date, execution_time)
    VALUES('$admin', 'LOGOUT', 'users', '$date', '$time')";

    $res = $con -> query($sql);     // Audit statement.
    
    session_destroy();
    header("Location: index.php");
?>