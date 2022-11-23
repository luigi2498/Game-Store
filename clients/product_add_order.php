<?php
    // product_add_order.php
    require "../functions/connect.php";
    $con = connect();

    session_start();

    // Get variables.
    $id_product = $_REQUEST['id'];  // Product.
    $amount = $_REQUEST['amount'];  // Product.
    $price = $_REQUEST['price'];    // Product.

    $date = date('Y/m/d h:i:s a', time());  // Order.
    $user = session_id();                   // Order.

    // Table orders validation.
    $sqlEmpty = "SELECT * FROM orders WHERE status = 0";

    $result = $con -> query($sqlEmpty);
    $emptyRow = mysqli_num_rows($result);
    
    if ($emptyRow == 0){     // If there's not an existing order...
        // Create the order...
        $sql = "INSERT INTO orders(date, user)
        VALUES('$date', '$user')";
        $res = $con -> query($sql);
        
        $result = $con -> query($sqlEmpty);
        $row = $result -> fetch_assoc();
        
        $_SESSION['id_order'] = $row['id'];     // Set the order id as a session value.
        $id_order = $_SESSION['id_order'];

        // Insert the first item...
        $sql = "INSERT INTO orders_products(id_order, id_product, amount, price)
        VALUES('$id_order', '$id_product', '$amount', '$price')";
        $res = $con -> query($sql);
    }

    else {      // If an unclosed order exists...
        $row = $result -> fetch_assoc();   // Get row by the first SELECT.
        $_SESSION['id_order'] = $row['id'];     // Set the order id as a session value.
        $id_order = $_SESSION['id_order'];

        // Existing item in an order (orders_products table)...
        $sqlItem = "SELECT * FROM orders_products WHERE id_product = $id_product";
        $resultItem = $con -> query($sqlItem);
        $itemRow = mysqli_num_rows($resultItem);

        if ($itemRow == 0){
            $sql = "INSERT INTO orders_products(id_order, id_product, amount, price)
            VALUES('$id_order', '$id_product', '$amount', '$price')";
            $res = $con -> query($sql);
        }

        else {
            $result = $con -> query($sqlItem);
            $row = $result -> fetch_assoc();

            $tempAmount = $row['amount'];

            $finalAmount = $amount + $tempAmount;

            $sql = "UPDATE orders_products
                    SET amount = '$finalAmount'
                    WHERE id_product = $id_product";
            $res = $con -> query($sql);
        }
    }
    
    header("Location: cart01.php");
?>