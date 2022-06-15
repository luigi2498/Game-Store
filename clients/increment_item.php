<?php
    // increment_item.php
    require "../functions/connect.php";
    $con = connect();

    // Request variables.
    $id = $_REQUEST['id'];
    $stock = $_REQUEST['stock'];
    $amount = $_REQUEST['amount'];
    $final_amount = $amount + 1;

    if ($amount < $stock){
        $sql = "UPDATE orders_products
                SET amount = $final_amount
                WHERE id_product = $id";

        $res = $con -> query($sql);
    }

    header("Location: cart01.php");
?>