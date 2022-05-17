<?php
    session_start();
    if(!isset($_SESSION['USER']) && !isset($_SESSION['ROLE_ID'])){
        header("location:../main/login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php require '../partials/message-popup.php' ?>
    <?php
        include_once '../partials/connectionString.php';
        $role_id = 3;
        $courier = '<select class="courier" name="courier" required>
        <option value="">Please assign courier</option>';
        $sql = "SELECT * FROM users WHERE role_id='{$role_id}'";
        $query = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($query)){
            $courier .= '<option value="'.$row['ID'].'">'.$row['FIRSTNAME'].' '.$row['LASTNAME'].'</option>';
        }
        $courier .= '</select>';
    ?>
    <section id="admin-orders">
        <div class="container">
            <div class="top">
            <?php
                if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 1)){
                    echo '<div class="left">
                            <h4>Orders</h4>
                            <h6>Customers Place Order</h6>
                        </div>';
                }
            ?>
            <?php
                if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 2)){
                    echo '<div class="left">
                            <h4>Your Orders</h4>
                            <h6>Manage Your Orders</h6>
                        </div>';
                }
            ?>
            <?php
                if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && ($_SESSION['ROLE_ID'] == 3)){
                    echo '<div class="left">
                            <h4>Orders</h4>
                            <h6>Orders To Be Deliver</h6>
                        </div>';
                }
            ?>
            </div>
            <?php
                if(isset($_SESSION['USER']) && ($_SESSION['ROLE_ID'] == 1)){
                    echo '<div class="filter-order">
                            <div class="status">
                                <span class="all active">All</span>
                                <span class="orders-status">Pending</span>
                                <span class="orders-status">To Ship</span>
                                <span class="orders-status">To Receive</span>
                                <span class="orders-status">Delivered</span>
                                <span class="orders-status">Cancelled</span>
                            </div>
                            <div class="orders-search-bar">
                                <button><i class="bx bx-search"></i></button>
                                <input type="text" class="order-searchbar">
                            </div>
                        </div>';
                }
            ?>

            <div class="customer-orders">
                <div class="table-responsive">
                    <table>
                        <?php
                            include_once '../partials/connectionString.php';
                            if($_SESSION['ROLE_ID'] == 2){
                                $customer_id = $_SESSION['USER'];
                                $sql = "SELECT * FROM orders WHERE user_id='{$customer_id}'";
                                $query = mysqli_query($conn, $sql);
                                echo '<thead>
                                        <tr>
                                            <td>Order No.</td>
                                            <td>Amount</td>
                                            <td>Order Status</td>
                                            <td>Order Date</td>
                                            <td width="13%"></td>
                                        </tr>
                                    </thead>
                                    <tbody>';   
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '<tr>
                                                <td>1100'.$row['ID'].'</td>
                                                <td>₱ '.$row['AMOUNT'].'</td>
                                                <td><span class="order-status">'.$row['ORDER_STATUS'].'</span></td>
                                                <td>'.date_format(date_create($row['ORDER_DATE']), "F d, Y").'</td>
                                                <td>
                                                    <button class="btn btn-sm ordered-items" data-target="view-items-modal" value="'.$row['ID'].'"><i class="bx bx-purchase-tag-alt"></i></button>';
                                        if($row['ORDER_STATUS'] === "Delivered"){
                                            echo '<button class="btn btn-sm ordered-receipt" data-target="receipt-modal" value="'.$row['ID'].'"><i class="bx bx-receipt"></i></button>';
                                        }
                                        if($row['ORDER_STATUS'] !== "Pending"){
                                            echo '  <button class="btn btn-sm view-delivery-details" data-target="view-delivery-details-modal" value="'.$row['ID'].'"><i class="bx bx-car"></i></button>
                                                </td>
                                            </tr>'; 
                                        }  
                                    }
                                } else{
                                    echo 'No Orders Found';
                                }
                            } else if ($_SESSION['ROLE_ID'] == 3){
                                $courier_id = $_SESSION['USER'];
                                $sql = "SELECT o.id, o.amount, o.order_status, o.order_date, u.firstname, u.lastname, u.address, u.phone_number FROM delivery_details d INNER JOIN orders o ON d.order_id=o.id INNER JOIN users u ON o.user_id=u.id WHERE courier_id='{$courier_id}'";
                                $query = mysqli_query($conn, $sql);
                                echo '<thead>
                                        <tr>
                                            <td>Customer Name</td>
                                            <td>Address</td>
                                            <td>Contact No.</td>
                                            <td>Amount</td>
                                            <td>Order Status</td>
                                            <td>Order Date</td>
                                            <td></td>
                                        </tr>
                                    </thead>
                                    <tbody>';   
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '<tr>
                                                <td>'.$row['firstname'].' '.$row['lastname'].'</td>
                                                <td>'.$row['address'].'</td>
                                                <td>'.$row['phone_number'].'</td>
                                                <td>₱ '.$row['amount'].'</td>
                                                <td><span class="order-status">'.$row['order_status'].'</span></td>
                                                <td>'.date_format(date_create($row['order_date']), "F d, Y").'</td>
                                                <td>
                                                    <button class="btn btn-sm ordered-items" data-target="view-items-modal" value="'.$row['id'].'"><i class="bx bx-purchase-tag-alt"></i></button>
                                                    <button class="btn btn-sm ordered-update" data-target="update-order-modal" value="'.$row['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>
                                                </td>
                                            </tr>';
                                    }
                                } else{
                                    echo 'No Orders Found';
                                }
                            } else{
                                $sql = "SELECT o.id, u.ID, u.firstname, u.lastname, u.address, u.phone_number, o.amount, o.order_status FROM orders o INNER JOIN users u ON o.user_id=u.id";;
                                $query = mysqli_query($conn, $sql);
                                echo '<thead>
                                        <tr>
                                            <td width="3%">Img</td>
                                            <td>Firstname</td>
                                            <td>Lastname</td>
                                            <td>Address</td>
                                            <td>Conatct No.</td>
                                            <td>Amount</td>
                                            <td>Status</td>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody class="order-list">';   
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '<tr>
                                                <td><img src="../assets/user-profiles/profile-'.$row['ID'].'.jpg" alt="user profile"></td>
                                                <td>'.$row['firstname'].'</td>
                                                <td>'.$row['lastname'].'</td>
                                                <td>'.$row['address'].'</td>
                                                <td>'.$row['phone_number'].'</td>
                                                <td>₱ '.$row['amount'].'</td>
                                                <td><span class="order-status">'.$row['order_status'].'</span></td>
                                                <td>
                                                    <button class="btn btn-sm ordered-items" data-target="view-items-modal" value="'.$row['id'].'"><i class="bx bx-purchase-tag-alt"></i></button>
                                                    <button class="btn btn-sm ordered-delete" data-target="delete-order-dialog" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                                                    <button class="btn btn-sm ordered-update" data-target="update-order-modal" value="'.$row['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>';
                                        $order_id = $row['id'];
                                        $sql1 = "SELECT * FROM delivery_details WHERE order_id='{$order_id}'";
                                        $query1 = mysqli_query($conn, $sql1);
                                        if(mysqli_num_rows($query1) > 0){
                                            echo '<button class="btn btn-sm view-delivery-details" data-target="view-delivery-details-modal" value="'.$row['id'].'"><i class="bx bx-car"></i></button>
                                                    </td>
                                                </tr>';
                                        } else{
                                            echo '<button class="btn btn-sm delivery-details" data-target="delivery-details-modal" value="'.$row['id'].'"><i class="bx bx-car"></i></button>
                                                    </td>
                                                </tr>';
                                        }
                                    }
                                } else{
                                    echo '<tr>No records found</tr>';
                                }
                            }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php require '../partials/modals.php' ?>
    
    <script src="../js/index.js"></script>
    <script src="../js/order.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>