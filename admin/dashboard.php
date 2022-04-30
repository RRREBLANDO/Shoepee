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
    <title>Dashboard</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php include_once '../partials/connectionString.php' ?>
    
    <section id="admin-dashboard">
        <div class="container">
            <h4>Dashboard</h4>
            <h6>Overview</h6>

            <div class="overview">
                <div class="overview-cards">
                    <div class="brand-available">
                        <div class="top">
                            <div class="icon">
                                <i class='bx bx-layer'></i>
                            </div>
                            <div class="top-label">
                                <p>Available</p>
                                <p>Brands</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <?php
                                $sql = "SELECT COUNT(*) FROM brands";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_array($result);

                                echo "<p>$count[0]</p>";
                            ?>
                        </div>
                    </div>
                    <div class="product-available">
                        <div class="top">
                            <div class="icon">
                                <i class='bx bx-heart'></i>
                            </div>
                            <div class="top-label">
                                <p>Available</p>
                                <p>Products</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <?php
                                $sql = "SELECT COUNT(*) FROM products";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_array($result);

                                echo "<p>$count[0]</p>";
                            ?>
                        </div>
                    </div>
                    <div class="delivered-orders">
                        <div class="top">
                            <div class="icon">
                                <i class='bx bx-car'></i>
                            </div>
                            <div class="top-label">
                                <p>Delivered</p>
                                <p>Orders</p>
                            </div>
                        </div>
                        <div class="bottom">
                            <?php
                                $status = "Delivered";
                                $sql = "SELECT COUNT(*) FROM orders WHERE ORDER_STATUS = '{$status}'";
                                $result = mysqli_query($conn, $sql);
                                $count = mysqli_fetch_array($result);

                                echo "<p>$count[0]</p>";
                            ?>
                        </div>
                    </div>
                    <div class="pending-orders">
                        <div class="top">
                            <div class="icon">
                                <i class='bx bx-basket'></i>
                            </div>
                            <div class="top-label">
                                <p>Pending</p>
                                <p>Orders</p>
                            </div>
                        </div>
                        <div class="bottom">
                        <?php
                            $status = "Pending";
                            $sql = "SELECT COUNT(*) FROM orders WHERE ORDER_STATUS = '{$status}'";
                            $result = mysqli_query($conn, $sql);
                            $count = mysqli_fetch_array($result);

                            echo "<p>$count[0]</p>";
                        ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-orders">
                <div class="top">
                    <h6>Recent Orders</h6>
                    <a href="orders.php" class="btn btn-sm">Manage</a>
                </div>
                
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td width="3%"></td>
                                <td>Firstname</td>
                                <td>Lastname</td>
                                <td>Address</td>
                                <td>Phone Number</td>
                                <td>Amount</td>
                                <td>Status</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        include_once '../partials/connectionString.php';
                            $sql = "SELECT o.id, u.ID, u.firstname, u.lastname, u.address, u.phone_number, o.amount, o.order_status FROM orders o INNER JOIN users u ON o.user_id=u.id ORDER BY o.id DESC LIMIT 3";;
                            $query = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_assoc($query)){
                                    echo '<tr>
                                            <td><img src="../assets/user-profiles/profile-'.$row['ID'].'.jpg" width="30" height="30" style="border-radius: 50%" alt="user profile"></td>
                                            <td>'.$row['firstname'].'</td>
                                            <td>'.$row['lastname'].'</td>
                                            <td>'.$row['address'].'</td>
                                            <td>'.$row['phone_number'].'</td>
                                            <td>₱ '.$row['amount'].'</td>
                                            <td><span class="order-status">'.$row['order_status'].'</span></td>';
                                }
                            } else{
                                echo '<tr>No records found</tr>';
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="../js/index.js"></script>
    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>