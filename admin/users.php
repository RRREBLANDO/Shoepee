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
    <title>Manage Users</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php require '../partials/message-popup.php' ?>
    <section id="admin-orders">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Users</h4>
                    <h6>Manage System Users</h6>
                </div>
                <div class="right">
                    <button class="btn btn-sm add-courier" data-target="add-courier-modal">ADD COURIER</button>
                </div>
            </div>

            <div class="filter-order">
                <div class="status">
                    <span class="all active">All</span>
                    <span class="role">Customer</span>
                    <span class="role">Courier</span>
                </div>
                <div class="orders-search-bar">
                    <button><i class='bx bx-search'></i></button>
                    <input type="text" class="user-search">
                </div>
            </div>

            <div class="customer-orders">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td width="3%">P.P</td>
                                <td>Firstname</td>
                                <td>Lastname</td>
                                <td>Address</td>
                                <td>Age</td>
                                <td>Phone Number</td>
                                <td>Email</td>
                                <td>User Type</td>
                                <td width="3%">Action</td>
                            </tr>
                        </thead>
                        <tbody class="user-list">
                            <?php
                                include_once '../partials/connectionString.php';
                                $sql = "SELECT u.id, u.firstname, u.lastname, u.address, u.age, u.phone_number, u.email, r.role_name FROM users u JOIN roles r ON u.role_id = r.id";
                                $query = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '<tr>
                                                <td><img src="../assets/user-profiles/profile-'.$row['id'].'.jpg" alt=""></td>
                                                <td class="user-fname">'.$row['firstname'].'</td>
                                                <td class="user-lname">'.$row['lastname'].'</td>
                                                <td>'.$row['address'].'</td>
                                                <td>'.$row['age'].'</td>
                                                <td>'.$row['phone_number'].'</td>
                                                <td>'.$row['email'].'</td>
                                                <td style="text-transform: capitalize">'.$row['role_name'].'</td>
                                                <td>
                                                    <button class="btn btn-sm delete-user" data-target="delete-user-dialog" value="'.$row['id'].'"><i class="bx bx-trash-alt"></i></button>
                                                </td>
                                            </tr>';
                                    }
                                } else {
                                    echo "No records found";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php include '../partials/modals.php' ?>
    
    <script src="../js/index.js"></script>
    <script src="../js/users.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>