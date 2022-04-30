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
  <?php include '../partials/connectionString.php' ?>

    <section id="banner-section">
        <div class="container">
            <div class="row">
              <div class="col-sm-6 my-auto banner-text">
                <h1 class="text-white mb-4">BUILD YOUR OWN PATH WITH EVERY STEPS.</h1>
                <h4 class="text-white mt-3">START AND GET YOURS NOW</h4>
                <a href="../main/products.php" class="btn btn-sm mt-3 shopnow-btn">Shop Now <i class="fal fa-long-arrow-right ms-2"></i></a>
              </div>
              <div class="col-sm-6 text-end sm-hide">
                <img src="../assets/nike/17.png" alt="nike shoes" class="img-fluid">
              </div>
            </div>
        </div>
    </section>

    <section id="shoe-brands">
      <h4 class="mb-5">SHOP WITH OUR AVAILABLE BRANDS</h4>
      <div class="container">
          <div class="row justify-content-center">
            <?php
              $sql = "SELECT * FROM brands";
              $query = mysqli_query($conn, $sql);
              if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                  echo '<div class="col col-md-2">
                          <img src="../assets/brands/brand-'.$row['ID'].'.jpg" alt="'.$row['BRAND_NAME'].' logo" width="100" height="100">
                        </div>';
                }
              } else{
                echo "No records found";
              }
            ?>
          </div>
      </div>
    </section>

    <section id="new-arrivals">
      <h4 class="mb-5">NEW ARRIVALS</h4>
      <div class="container">
          <div class="row row-cols-3 gap-5 justify-content-center">
            <?php
                $sql = "SELECT p.id, p.product_name, p.price, p.brand_id, b.brand_name FROM products p LEFT JOIN brands b ON p.brand_id = b.id ORDER BY p.id DESC LIMIT 6";
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
            ?>
      </div>
      <a href="../main/products.php" class="btn btn-sm mt-5 view-all-products">VIEW ALL PRODUCTS</a>
    </section>

    <section id="faq">
    <h4 class="mb-5">FREQUENTLY ASK QUESTIONS</h4>
      <div class="container">
        <div class="accordion" id="accordionPanelsStayOpenExample">
          <?php
              $num = 0;
              $sql = "SELECT * FROM faq";
              $query = mysqli_query($conn, $sql);
              if(mysqli_num_rows($query) > 0){
                while($row = mysqli_fetch_assoc($query)){
                  $num++;
                  echo '<div class="accordion-item">
                          <h2 class="accordion-header" id="panelsStayOpen-heading'.$num.'">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse'.$num.'" aria-expanded="false" aria-controls="panelsStayOpen-collapse'.$num.'">
                              '.$row['QUESTION'].'
                            </button>
                          </h2>
                          <div id="panelsStayOpen-collapse'.$num.'" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-heading'.$num.'">
                            <div class="accordion-body">
                            '.$row['ANSWER'].'
                            </div>
                          </div>
                        </div>';
                }
              } else{
                echo "No records";
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
</body>
</html>