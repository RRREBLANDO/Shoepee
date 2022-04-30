<?php
    session_start();
    include_once '../partials/connectionString.php';
    $user_id = $_SESSION['USER'];
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $size = mysqli_real_escape_string($conn, $_POST['size']);
    $sql = "SELECT * FROM cart WHERE product_id='{$product_id}'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        echo "Product already has been added";
    } else{
        if(!empty($user_id) && !empty($product_id) && !empty($quantity) && !empty($size)){
            $sql1 = "INSERT INTO cart (user_id, product_id, quantity, size) VALUES ('{$user_id}', '{$product_id}', '{$quantity}', '{$size}')";
            $query1 = mysqli_query($conn, $sql1);
            if($query1){
                echo "Product is been added to cart";
            } else{
                echo "Adding to cart this product failed";
            }
        } else{
            echo "Adding to cart this product failed";
        }
    }
?>