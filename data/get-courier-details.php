<?php
    include_once '../partials/connectionString.php';
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    if(!empty($order_id)){
        $sql = "SELECT u.id, u.firstname, u.lastname, u.phone_number FROM delivery_details d INNER JOIN users u ON d.courier_id=u.id WHERE d.order_id='{$order_id}'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            echo '<div class="delivery-details">
                    <img src="../assets/user-profiles/profile-'.$row['id'].'.jpg" alt="courier profile">
                    <p>'.$row['firstname'].' '.$row['lastname'].'</p>
                    <small>Courier</small>
                    <p>Contact Number</p>
                    <p>'.$row['phone_number'].'</p>
                </div>';
        } else{
            echo "Please wait for a courier to be assign";
        }
    } else{
        echo "Please wait for a courier to be assign";
    }
?>