<?php
    include_once '../partials/connectionString.php';
    $search_string = mysqli_real_escape_string($conn, $_POST['search_string']);
    if(!empty($search_string)){
        $sql = "SELECT o.id, u.ID, u.firstname, u.lastname, u.address, u.phone_number, o.amount, o.order_status FROM orders o INNER JOIN users u ON o.user_id=u.id WHERE o.order_status LIKE '%{$search_string}%' OR u.firstname LIKE '%{$search_string}%' OR u.lastname LIKE '%{$search_string}%'";
        $query = mysqli_query($conn, $sql);
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
        } else {
            echo '<tr>No Records Found</tr>';
        }
    } else{
        $sql1 = "SELECT o.id, u.ID, u.firstname, u.lastname, u.address, u.phone_number, o.amount, o.order_status FROM orders o INNER JOIN users u ON o.user_id=u.id";
        $query1 = mysqli_query($conn, $sql1);
        while($row = mysqli_fetch_assoc($query1)){
            echo '<tr>
                    <td><img src="../assets/user-profiles/profile-'.$row['ID'].'.jpg" alt="user profile"></td>
                    <td>'.$row['firstname'].'</td>
                    <td>'.$row['lastname'].'</td>
                    <td>'.$row['address'].'</td>
                    <td>'.$row['phone_number'].'</td>
                    <td>₱ '.$row['amount'].'</td>
                    <td><span class="order-status">'.$row['order_status'].'</span></td>
                    <td>
                        <button class="btn btn-sm ordered-delete" data-target="delete-order-dialog" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                        <button class="btn btn-sm ordered-update" data-target="update-order-modal" value="'.$row['id'].'"><i class="bx bx-sync bx-rotate-180" ></i></button>';
            $order_id = $row['id'];
            $sql2 = "SELECT * FROM delivery_details WHERE order_id='{$order_id}'";
            $query2 = mysqli_query($conn, $sql2);
            if(mysqli_num_rows($query2) > 0){
                echo '<button class="btn btn-sm view-delivery-details" data-target="view-delivery-details-modal" value="'.$row['id'].'"><i class="bx bx-car"></i></button>
                        </td>
                    </tr>';
            } else{
                echo '<button class="btn btn-sm delivery-details" data-target="delivery-details-modal" value="'.$row['id'].'"><i class="bx bx-car"></i></button>
                        </td>
                    </tr>';
            }
        }
    }
?>