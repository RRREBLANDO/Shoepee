<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    if(!empty($status)){
        $sql = "UPDATE orders SET order_status='{$status}' WHERE id='{$order_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "Order status successfully updated";
        } else{
            echo "Update operation failed";
        }
    } else{
        echo "Update operation failed";
    }
?>