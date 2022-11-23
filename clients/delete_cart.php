<?php
    // delete_cart.php
    require "../functions/connect.php";
    $con = connect();

    // Get variables.
    $id = $_REQUEST['id'];

    if ($id > 0){
        $sql = "DELETE FROM orders_products WHERE id_product = $id";
        $res = $con -> query($sql);
    }

    header("Location: cart01.php");
?>