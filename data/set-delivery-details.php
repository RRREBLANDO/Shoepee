<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $courier_id = mysqli_real_escape_string($conn, $_POST['courier']);
    if(!empty($order_id) && !empty($courier_id)){
        $sql = "INSERT INTO delivery_details (order_id, courier_id) VALUES ('{$order_id}', '{$courier_id}')";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "Delivery details successfully set";
        }
    } else{
        echo "Failed to set delivery details";
    }
?>