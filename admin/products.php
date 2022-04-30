<?php
    session_start();
    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
        header("location:../main/login.php");
    } else if($_SESSION['ROLE_ID'] != 1){
        header("location: ../main/not-found.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php include_once '../partials/connectionString.php' ?>
    <?php include_once '../data/load-select-brands.php' ?>
    
    <section id="admin-products">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Products</h4>
                    <h6>Products Available</h6>
                </div>
                <div class="right">
                    <a href="../admin/price-change.php" class="btn btn-sm price-change">Price Change</a>
                    <button class="btn btn-sm add-product" data-target="add-product-modal"><i class='bx bx-plus'></i> ADD</button>
                </div>
            </div>

            <div class="product-search-bar shadow-sm">
                <button class="search-btn"><i class='bx bx-search'></i></button>
                <input type="text" class="search-input">
            </div>
            
            <div class="product-list">
                <?php
                    $sql = "SELECT p.id, p.product_name, p.price, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id ORDER BY p.id ASC";
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
                    }
                ?>
            </div>
        </div>
    </section>
    
    <?php require '../partials/modals.php' ?>

    <script src="../js/index.js"></script>
    <script src="../js/product.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>