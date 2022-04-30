<?php

    include_once '../partials/connectionString.php';
    
    $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);

    $sql = "SELECT * FROM brands WHERE id = {$brand_id}";
    $query = mysqli_query($conn, $sql);

    if($query){
        $result = mysqli_fetch_assoc($query);

        echo json_encode($result);
    } else {
        echo "No records found!";
    }

?>