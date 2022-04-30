<?php
    include_once '../partials/connectionString.php';
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    if(!empty($product_id)){
        $sql = "DELETE FROM products WHERE id='{$product_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $oldProdImg = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/products/product-'.$product_id.'.jpg';
            if(file_exists($oldProdImg)){
                unlink($oldProdImg);
            }
            echo "Product Deleted Successfully";
        } else{
            echo "Failed";
        }
    } else{
        echo "No record found";
    }
?>