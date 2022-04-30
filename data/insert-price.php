<?php
    include_once '../partials/connectionString.php';
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $amount = mysqli_real_escape_string($conn, $_POST['amount']);
    $start_eff = mysqli_real_escape_string($conn, $_POST['start_eff_date']);
    $end_eff = mysqli_real_escape_string($conn, $_POST['end_eff_date']);
    if(!empty($product) && !empty($amount) && !empty($start_eff) && !empty($end_eff)){
        $sql = "INSERT INTO price_change (product_id, amount, start_eff_date, end_eff_date) VALUES ('{$product}', '{$amount}', '{$start_eff}', '{$end_eff}')";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "Price Successfully Added";
        } else{
            echo "Insert Failed";
        }
    } else{
        echo "All fields are required";
    }
?>