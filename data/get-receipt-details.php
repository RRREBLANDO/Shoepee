<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    if(!empty($order_id)){
        $sql = "SELECT p.product_name, p.price, oi.quantity, i.total_quantity, i.total_amount FROM invoices i INNER JOIN order_items oi ON i.order_id=oi.order_id INNER JOIN products p ON oi.product_id=p.id WHERE i.order_id='{$order_id}'";
        $query = mysqli_query($conn, $sql);
        $output = '';
        if(mysqli_num_rows($query) > 0){
            $total_amount = '';
            $total_quantity = '';
            while($row = mysqli_fetch_assoc($query)){
                $total_amount = $row['total_amount'];
                $total_quantity = $row['total_quantity'];
                $output .= '<div class="receipt-order-items">
                                <p style="text-transform: capitalize">'.$row['product_name'].'</p>
                                <p style="text-align:center">Price <br> ₱'.$row['price'].'</p>
                                <p style="text-align:center">Quantity <br>'.$row['quantity'].'</p>
                            </div>';
            }
            $output .= '<div class="receipt-order-items">
                            <p>Total Amount : ₱'.$total_amount.'</p>
                            <p>Total Quantity : '.$total_quantity.'</p>
                        </div>';
            echo $output;
        } else{
            echo 'No details found';
        }
    } else{
        echo 'No details found';
    }
?>