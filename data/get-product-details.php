<?php
    include_once '../partials/connectionString.php';
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);

    if(!empty($product_id)){
        $sql = "SELECT * FROM products WHERE id='{$product_id}'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $result = mysqli_fetch_assoc($query);
            echo json_encode($result);
        } else{
            echo "No record found";
        }
    } else{
        echo "No record found";
    }
?>