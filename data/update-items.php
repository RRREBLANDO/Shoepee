<?php
    include_once '../partials/connectionString.php';
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    if(!empty($cart_id) && !empty($quantity)){
        $sql = "UPDATE cart SET quantity='{$quantity}' WHERE id='{$cart_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "success";
        }
    } else{
        echo "Error";
    }
?>