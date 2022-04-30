<?php
    include_once '../partials/connectionString.php';
    $search_str = mysqli_real_escape_string($conn, $_POST['search_str']);
    if(!empty($search_str)){
        $sql = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id WHERE p.product_name LIKE '%{$search_str}%' OR b.brand_name LIKE '%{$search_str}%'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="card shadow-lg">
                        <div class="card-header">
                        <img src="../assets/brands/brand-'.$row['brand_id'].'.jpg" alt="'.$row['brand_name'].' logo">
                        <p class="ms-auto my-auto">₱ '.$row['price'].'</p>
                        </div>
                        <div class="card-body text-center">
                        <img src="../assets/products/product-'.$row['id'].'.jpg" alt="shoe img" class="img-fluid">
                        <div class="shoe-name">
                            <p style="text-transform: capitalize">'.$row['product_name'].'</p>
                        </div>
                        <a href="../main/viewProduct.php?product_id='.$row['id'].'" class="btn btn-sm addtocart-btn">PREVIEW</a>
                        </div>
                    </div>';
            }
        } else{
            $sql1 = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM seo s INNER JOIN products p ON s.product_id=p.id INNER JOIN brands b ON p.brand_id=b.id WHERE s.search_key LIKE '%{$search_str}%'";
            $query1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($query1) > 0){
                while($row1 = mysqli_fetch_assoc($query1)){
                    echo '<div class="card shadow-lg">
                            <div class="card-header">
                            <img src="../assets/brands/brand-'.$row1['brand_id'].'.jpg" alt="'.$row1['brand_name'].' logo">
                            <p class="ms-auto my-auto">₱ '.$row1['price'].'</p>
                            </div>
                            <div class="card-body text-center">
                            <img src="../assets/products/product-'.$row1['id'].'.jpg" alt="shoe img" class="img-fluid">
                            <div class="shoe-name">
                                <p style="text-transform: capitalize">'.$row1['product_name'].'</p>
                            </div>
                            <a href="../main/viewProduct.php?product_id='.$row1['id'].'" class="btn btn-sm addtocart-btn">PREVIEW</a>
                            </div>
                        </div>';
                }
            } else{
                echo '<div class="no-record">
                    <div class="msg">
                        <img src="../assets/norecord.png" alt="" width="300" height="260">
                        <p>No Record Found</p></div>
                </div>';
            }
        }
    } else{
        $sql2 = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id";
        $query2 = mysqli_query($conn, $sql2);

        while($row2 = mysqli_fetch_assoc($query2)){
            echo '<div class="card shadow-lg">
                    <div class="card-header">
                    <img src="../assets/brands/brand-'.$row2['brand_id'].'.jpg" alt="'.$row2['brand_name'].' logo">
                    <p class="ms-auto my-auto">₱ '.$row2['price'].'</p>
                    </div>
                    <div class="card-body text-center">
                    <img src="../assets/products/product-'.$row2['id'].'.jpg" alt="shoe img" class="img-fluid">
                    <div class="shoe-name">
                        <p style="text-transform: capitalize">'.$row2['product_name'].'</p>
                    </div>
                    <a href="../main/viewProduct.php?product_id='.$row2['id'].'" class="btn btn-sm addtocart-btn">PREVIEW</a>
                    </div>
                </div>';
        }
    }
?>