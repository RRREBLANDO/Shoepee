<?php
    session_start();
    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] != 2){
        header("location: ../main/not-found.php");
      }
    include_once '../partials/connectionString.php';
    $product_id = $_GET['product_id'];
    $sql = "SELECT p.id, p.product_name, p.price, b.brand_name FROM products p JOIN brands b ON p.brand_id = b.id WHERE p.id = '{$product_id}'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoepee</title>
    <?php require '../partials/imports.php' ?>

</head>
<body>
    <?php require '../partials/message-popup.php' ?>
    
    <div class="product-col">
        <a href="../main/products.php" class="btn btn-sm back-btn"><i class='bx bx-arrow-back'></i></a>
        <div class="product-image">
            <div class="circle-bg">
                <div class="circle-child"></div>
            </div>
            <img  src="../assets/products/product-<?php echo $row['id'] ?>.jpg" alt="<?php echo $row['product_name'] ?> image">
        </div>
        <div class="product-info">
            <input type="hidden" class="p_id" value="<?php echo $row['id'] ?>">
            <h5 class="mb-2"><?php echo $row['brand_name'] ?></h5>
            <h3 style="text-transform: capitalize"><?php echo $row['product_name'] ?></h3>
            <p class="product-price">₱ <?php echo $row['price'] ?></p>
            <p>Good <b style="color: #111111">Shoes</b> Take You To Good Places</p>
            <p class="mt-4" style="color: #111111">Available sizes</p>
            <div class="available-sizes mb-4">
                <span>9</span>
                <span>8</span>
                <span>7</span>
                <span>6</span>
                <span>5</span>
                <span>4</span>
            </div>
            <?php
                if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID'])){
                    echo '<button class="add-to-cart logged-in" data-ident="logged-in">Add to cart <i class="fal fa-long-arrow-right ms-2"></i></button>';
                } else{
                    echo '<button class="add-to-cart not-login" data-ident="not-login">Add to cart <i class="fal fa-long-arrow-right ms-2"></i></button>';
                }
            ?>
        </div>
    </div>
    
    <script src="../js/view-product.js"></script>
</body>
</html>