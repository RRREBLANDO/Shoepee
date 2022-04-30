<?php
    session_start();
    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] != 2){
      header("location: ../main/not-found.php");
    }
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
    <?php require '../partials/_nav.php' ?>  

    <section id="products">
      <h4 class="mb-4">SHOE<span class="color-custom-dark">PEE PRODUCTS</span></h4>
      <div class="filterby-brands text-center mb-5">
          <a href="../main/products.php" class="btn btn-sm shadow-sm">All</a>
          <?php
            include_once '../partials/connectionString.php';
            $sql = "SELECT * FROM brands";
            $query = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($query)){
              echo '<a href="../main/products.php?brand_id='.$row['ID'].'" class="btn btn-sm shadow-sm">'.$row['BRAND_NAME'].'</a>';
            }
          ?>
      </div>
      <div class="product-search-bar shadow-sm">
        <button><i class='bx bx-search'></i></button>
        <input type="text" class="product-search">
      </div>
      <div class="container">
          <div class="row row-cols-4 row-cols-md-3 gap-5 justify-content-center product-list">
            <?php
                include_once '../partials/connectionString.php';
                if(isset($_GET['brand_id'])){
                  $brand_id = $_GET['brand_id'];
                  $sql = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM products p LEFT JOIN brands b ON p.brand_id = b.id WHERE p.brand_id = '{$brand_id}' ORDER BY p.id DESC";
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
                    echo "No products found";
                  }
                } else{
                  $sql1 = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM products p LEFT JOIN brands b ON p.brand_id = b.id ORDER BY p.id DESC";
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
                    echo "No products found";
                  }
                  }
            ?>
          </div>
      </div>
    </section>

    <footer>
      <div class="container">
        <div class="row row-cols-1 row-cols-md-2">
          <div class="col col-md-6">
            <i class='bx bxs-shopping-bag-alt bx-tada bx-rotate-180' ></i> <span>Shoe</span><span class="color-custom-light">pee</span>
            <p class="heading">BUILD YOUR PATH NOW</p>
            <p class="subheading">WE ARE HERE TO SERVE YOU</p>
          </div>
          <div class="col col-md-6 text-end social">
            <p class="heading">GET CONNECTED WITH US</p>
            <i class='bx bxl-facebook-circle'></i>
            <i class='bx bxl-telegram' ></i>
            <i class='bx bxl-twitter' ></i>
            <i class='bx bxl-instagram-alt' ></i>
            <p class="subheading">ALL RIGHT RESERVED 2021</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

    <script src="../js/index.js"></script>
    <script src="../js/main-products.js"></script>
</body>
</html>