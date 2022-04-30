<?php
    include_once '../partials/connectionString.php';
    $cart_id = mysqli_real_escape_string($conn, $_GET['cart_id']);
    if(!empty($cart_id)){
        $sql = "DELETE FROM cart WHERE id='{$cart_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            header("location: ../main/viewCart.php");
        }
    }
?>