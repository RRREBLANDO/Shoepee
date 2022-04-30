<?php

    include_once '../partials/connectionString.php';

    $brand_id = mysqli_real_escape_string($conn, $_POST['brand_id']);

    $sql = "DELETE FROM brands WHERE id = {$brand_id}";
    $query = mysqli_query($conn, $sql);

    if($query){
        $img = $_SERVER['DOCUMENT_ROOT']."/Shoepee/assets/brands/brand-".$brand_id.".jpg";

        if(file_exists($img)){
            unlink($img);
        }

        echo "Deleted";
    } else{
        echo "Delete Failed";
    }

?>