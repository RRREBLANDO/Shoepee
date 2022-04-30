<?php 
    session_start();
    include_once '../partials/connectionString.php';
    $sql = "SELECT p.price, c.quantity FROM cart c INNER JOIN products p ON c.product_id=p.id WHERE c.user_id='{$_SESSION['USER']}'";
    $query = mysqli_query($conn, $sql);
    $total_amount = 0;
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            $price = $row['price'];
            $quantity = $row['quantity'];
            $amount = $price * $quantity;
            $total_amount = $total_amount + $amount;
        }
        echo $total_amount;
    } else{
        echo '<span>0</span>';
    }
?>