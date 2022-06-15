<?php
    // end_order.php
    require "../functions/connect.php";
    $con = connect();

    // Request variables.
    $id = $_REQUEST['id'];

    $sql = "UPDATE orders
            SET status = 1
            WHERE id = $id";

    $res = $con -> query($sql);
?>