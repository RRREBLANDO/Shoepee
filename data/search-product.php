<?php
    include_once '../partials/connectionString.php';
    $search_string = mysqli_real_escape_string($conn, $_POST['search_string']);
    if(!empty($search_string)){
        $sql = "SELECT p.id, p.product_name, p.price, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id WHERE p.product_name LIKE '%{$search_string}%' OR b.brand_name LIKE '%{$search_string}%'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            while($row = mysqli_fetch_assoc($query)){
                echo '<div class="product-card">
                        <div class="product-card-body">
                            <img src="../assets/products/product-'.$row['id'].'.jpg" alt="product logo">
                            <span>'.$row['product_name'].'</span>
                            <p class="product-price">Php '.$row['price'].'</p>
                            <p>'.$row['brand_name'].'</p>
                        </div>
                        <div class="product-card-action">
                            <button class="btn btn-sm" id = "product-delete" data-target="delete-product-dialog" data-name="'.$row['product_name'].'" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                            <button class="btn btn-sm product-update" data-target="update-product-modal" value="'.$row['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>
                        </div>
                    </div>';
            }
        } else{
            $sql1 = "SELECT p.id, p.product_name, p.price, b.brand_name FROM seo s INNER JOIN products p ON s.product_id=p.id INNER JOIN brands b ON p.brand_id=b.id WHERE s.search_key LIKE '%{$search_string}%'";
            $query1 = mysqli_query($conn, $sql1);
            if(mysqli_num_rows($query1) > 0){
                while($row1 = mysqli_fetch_assoc($query1)){
                    echo '<div class="product-card">
                        <div class="product-card-body">
                            <img src="../assets/products/product-'.$row1['id'].'.jpg" alt="product logo">
                            <span>'.$row1['product_name'].'</span>
                            <p class="product-price">Php '.$row1['price'].'</p>
                            <p>'.$row1['brand_name'].'</p>
                        </div>
                        <div class="product-card-action">
                            <button class="btn btn-sm" id = "product-delete" data-target="delete-product-dialog" data-name="'.$row1['product_name'].'" value="'.$row1['id'].'"><i class="bx bx-trash-alt"></i></button>
                            <button class="btn btn-sm product-update" data-target="update-product-modal" value="'.$row1['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>
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
        $sql2 = "SELECT p.id, p.product_name, p.price, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id";
        $query2 = mysqli_query($conn, $sql2);

        while($row2 = mysqli_fetch_assoc($query2)){
            echo '<div class="product-card">
                    <div class="product-card-body">
                        <img src="../assets/products/product-'.$row2['id'].'.jpg" alt="product logo">
                        <span>'.$row2['product_name'].'</span>
                        <p class="product-price">Php '.$row2['price'].'</p>
                        <p>'.$row2['brand_name'].'</p>
                    </div>
                    <div class="product-card-action">
                        <button class="btn btn-sm" id = "product-delete" data-target="delete-product-dialog" data-name="'.$row2['product_name'].'" value="'.$row2['id'].'"><i class="bx bx-trash-alt"></i></button>
                        <button class="btn btn-sm product-update" data-target="update-product-modal" value="'.$row2['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>
                    </div>
                </div>';
        }
    }
?>