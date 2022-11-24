<?php
    // users_delete.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];

    if ($id > 0){
        // $sql = "DELETE FROM users WHERE id = $id";
        $sql = "UPDATE users SET deleted = 1 WHERE id = $id";
        $res = $con -> query($sql);

        // Audit info.
        session_start();
        $admin = $_SESSION['user'];
        date_default_timezone_set("America/Mexico_City");
        $date = date("d-m-Y");
        $time = date("h:i:sa");

        $sql = "INSERT INTO audit(user_name, statement, current_table, execution_date, execution_time)
        VALUES('$admin', 'DELETE', 'users', '$date', '$time')";

        $res = $con -> query($sql);     // Audit statement.
    }

    header("Location: users_list.php");
?>