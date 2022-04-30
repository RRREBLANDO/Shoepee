<?php
    include_once '../partials/connectionString.php';
    $type = "Sales Report";
    $current_date = date("Y-m-d");
    $sql = "SELECT * FROM reports WHERE date_generated='{$current_date}'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0){
        echo 'Report Already Exist';
    } else{
        $sql1 = "INSERT INTO reports (type, date_generated) VALUES ('{$type}', current_timestamp())";
        $query1 = mysqli_query($conn, $sql1);
        if($query1){
            echo 'Report is been generated';
        } else{
            echo 'Failed to generate report';
        }
    }
?>