<?php

    include_once '../partials/connectionString.php';

    $id = mysqli_real_escape_string($conn, $_POST['brand_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    $sql = "UPDATE brands SET status = '{$status}' WHERE id= '{$id}'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "Brand Successfully Updated";
    } else {
        echo "Update Failed!";
    }

?>