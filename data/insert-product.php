<?php
    include_once '../partials/connectionString.php';
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_brand = mysqli_real_escape_string($conn, $_POST['product_brand']);
    $search_key = mysqli_real_escape_string($conn, $_POST['product_searchkey']);

    if ($_FILES['product_img']['size'] > 0) {
        if(!empty($product_name) && !empty($product_price) && !empty($product_brand) && !empty($search_key)){
            $sql = "INSERT INTO products (product_name, price, brand_id, date_added) VALUES ('{$product_name}', '{$product_price}', '{$product_brand}', current_timestamp())";
            $query = mysqli_query($conn, $sql);
            $product_id = $conn->insert_id;
            if($query){
                if(isset($_FILES['product_img'])){
                    $filename = 'product-'.$product_id;
                    $file = $filename.'.jpg';

                    $dir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/products/';
                    $uploadFile = $dir.$file;

                    if(move_uploaded_file($_FILES['product_img']['tmp_name'], $uploadFile)){
                        $sql1 = "INSERT INTO seo (product_id, search_key) VALUES ('{$product_id}', '{$search_key}')";
                        $query1 = mysqli_query($conn, $sql1);
                        if($query1){
                            echo "Success";
                        } else{
                            echo "Failed";
                        }
                    } else{
                        echo "Upload Failed";
                    }
                }
            } else{
                echo "Insert Failed!";
            }
        } else{
            echo "Fill up all the required fields";
        }
    } else{
        echo "Please select a product image. jpeg, jpg, png.";
    }
?>