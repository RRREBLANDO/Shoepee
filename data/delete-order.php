<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    if(!empty($order_id)){
        $sql = "DELETE FROM orders WHERE id='{$order_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $sql1 = "SELECT * FROM order_items WHERE order_id='{$order_id}'";
            $query1 = mysqli_query($conn, $sql1);
            while($row = mysqli_fetch_assoc($query1)){
                $sql2 = "DELETE FROM order_items WHERE order_id='{$order_id}'";
                $query2 = mysqli_query($conn, $sql2);
                if($query2){
                    $sql3 = "DELETE FROM invoices WHERE order_id='{$order_id}'";
                    $query3 = mysqli_query($conn, $sql3);
                    if($query3){
                        echo 'Order successfully deleted';
                    } else{
                        echo 'Delete operation failed';
                    }
                }
            }
        }
    } else {
        echo 'Delete operation failed';
    }
?>