<?php
    // increment_order.php
    require "../functions/connect.php";
    $con = connect();

    // Request variables.
    $id = $_REQUEST['id'];
    $amount = $_REQUEST['amount'];
    $final_amount = $amount - 1;

    if ($amount > 1){
        $sql = "UPDATE orders_products
            SET amount = $final_amount
            WHERE id_product = $id";

        $res = $con -> query($sql);
    }

    header("Location: cart01.php");
?>