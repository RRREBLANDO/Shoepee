<?php
    include_once '../partials/connectionString.php';
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_brand = mysqli_real_escape_string($conn, $_POST['product_brand']);

    if(!empty($product_id) && !empty($product_name) && !empty($product_price) && !empty($product_brand)){
        $sql = "UPDATE products SET product_name='{$product_name}', price='{$product_price}', brand_id='{$product_brand}' WHERE id='{$product_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            if(isset($_FILES['product_img'])){
                $filename = 'product-'.$product_id;
                $file = $filename.'.jpg';
                $dir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/products/';
                $uploadFile = $dir.$file;
                if(move_uploaded_file($_FILES['product_img']['tmp_name'], $uploadFile)){
                    echo "Product Details and Image Successfully Updated";
                } else{
                    echo "Product Successfully Updated";
                }
            } 
        }
    } else{
        echo "All input fields must have a value";
    }
?>