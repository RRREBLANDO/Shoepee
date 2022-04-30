<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    if(!empty($order_id)){
        $sql = "SELECT p.id, p.product_name, o.quantity, o.size FROM order_items o INNER JOIN products p ON o.product_id=p.id WHERE o.order_id='{$order_id}'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="items">
                        <img src="../assets/products/product-'.$row['id'].'.jpg" alt="product img">
                        <p>'.$row['product_name'].'</p>
                        <p>'.$row['quantity'].'</p>
                        <p>'.$row['size'].'"</p>
                    </div>';
            }
        } else{
            echo "You dont have any purchases";
        }
    } else{
        echo "Failed to get the purchase items";
    }
?>