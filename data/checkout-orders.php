<?php
    session_start();
    include_once '../partials/connectionString.php';
    $user_id = $_SESSION['USER'];
    $amount = mysqli_real_escape_string($conn, $_POST['total_amount']);
    $total_amount = (float) $amount;
    if(!empty($user_id) && !empty($amount)){
        $status = "Pending";
        $sql = "INSERT INTO orders (user_id, amount, order_status, order_date) VALUES ('{$user_id}', '{$total_amount}', '{$status}', current_timestamp())";
        $query = mysqli_query($conn, $sql);
        $order_id = $conn->insert_id;
        if($query){
            $sql1 = "SELECT * FROM cart WHERE user_id='{$user_id}'";
            $query1 = mysqli_query($conn, $sql1);
            $inv_quantity = 0;
            if(mysqli_num_rows($query1) > 0){
                while($row = mysqli_fetch_assoc($query1)){
                    $cart_id = $row['ID'];
                    $product_id = $row['PRODUCT_ID'];
                    $quantity = $row['QUANTITY'];
                    $size = $row['SIZE'];
                    $inv_quantity = $inv_quantity + $quantity;
                    $sql2 = "INSERT INTO order_items (order_id, product_id, size, quantity) VALUES ('{$order_id}', '{$product_id}', '{$size}', '{$quantity}')";
                    $query2 = mysqli_query($conn, $sql2);
                    if($query2){
                        $sql3 = "DELETE FROM cart WHERE id='{$cart_id}'";
                        $query3 = mysqli_query($conn, $sql3);
                    }
                }
                $sql4 = "INSERT INTO invoices (order_id, total_quantity, total_amount, date_created) VALUES ('{$order_id}', '{$inv_quantity}', '{$total_amount}', current_timestamp())";
                $query4 = mysqli_query($conn, $sql4);
            } else{
                echo "No cart items found";
            }
        } else{
            echo "Checking out your order failed";
        }
    } else{
        echo "Checking out your order failed";
    }
?>