<?php
    session_start();
    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
        header("location:../main/login.php");
    } if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] != 2){
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
  <?php require '../partials/message-popup.php' ?>
  <section id="shopping-bag">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Shopping Cart</h4>
                    <h6>Shopping Cart Items</h6>
                </div>
            </div>
            
            <?php
                include_once '../partials/connectionString.php';
                $sql = "SELECT c.id, c.product_id, p.product_name, p.price, c.quantity, c.size FROM cart c INNER JOIN products p ON c.product_id=p.id WHERE c.user_id='{$_SESSION['USER']}'";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query) > 0){
                    echo '<div class="shopping-bag-items">
                            <div class="table-responsive" style="box-shadow:none">
                                <table>
                                    <thead>
                                        <tr>
                                            <td width="5%">Img</td>
                                            <td>Product Name</td>
                                            <td width="15%">Price</td>
                                            <td width="20%">Quantity</td>
                                            <td>Size</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>';
                    while($row = mysqli_fetch_assoc($query)){
                        echo '<tr>
                                <td><img src="../assets/products/product-'.$row['product_id'].'.jpg" alt="'.$row['product_name'].' image"></td>
                                <td style="text-transform: capitalize">'.$row['product_name'].'</td>
                                <td>₱ '.$row['price'].'</td>
                                <td>
                                    <button class="btn btn-sm quantity-minus">-</button>
                                    <span class="item-quantity">'.$row['quantity'].'</span>
                                    <button class="btn btn-sm quantity-add">+</button>
                                </td>
                                <td>'.$row['size'].'</td>
                                <td>
                                    <a href="../data/remove-from-cart.php?cart_id='.$row['id'].'" class="btn btn-sm cart-id" data-value="'.$row['id'].'"><i class="bx bx-x"></i></a>
                                </td>
                            </tr>';
                    }
                    echo '</tbody>
                        </table>
                    </div>
                    <div class="shopping-cart-summary">
                        <div class="header">
                            <span>Shopping Cart Summary</span>
                        </div>
                        <div class="body">
                            <p>Review orders before</p>
                            <p>checking out.</p>
    
                            <div class="no-orders">
                                <p>No. of Orders</p>';
                                $sql1 = "SELECT COUNT(*) FROM cart WHERE user_id='{$_SESSION['USER']}'";
                                $query1 = mysqli_query($conn, $sql1);
                                $count = mysqli_fetch_array($query1);
                                echo '<span>'.$count[0].'</span>
                                    </div>
                                    <div class="total-amount">
                                        <p>Total Amount</p>
                                        
                                        <span>₱ <span class="cart-summary-amount">0</span></span>
                                    </div>
                                </div>
                                <div class="footer">
                                    <button class="btn btn-sm checkout-btn">Check Out</button>
                                </div>
                            </div>
                        </div>';
                } else{
                    echo '<div class="empty-cart">
                            <img src="../assets/empty.png" alt="img">
                            <p>Your cart is empty. Just click this link to be redirected to product page <a href="../main/products.php">Shop Now.</a></p>
                        </div>';;
                }
            ?>
        </div>
    </section>

    <script src="../js/index.js"></script>
    <script src="../js/cart.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
</body>
</html>