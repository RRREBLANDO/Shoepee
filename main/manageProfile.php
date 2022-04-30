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
    <title>Shoepee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/message-popup.php' ?>
    <div class="particle-container">
    <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        
    </div>
    <?php
        include_once '../partials/connectionString.php';
        $user_id = $_SESSION['USER'];
        $sql = "SELECT u.firstname, u.lastname, u.address, u.age, u.phone_number, u.email, r.role_name FROM users u INNER JOIN roles r ON u.role_id=r.id WHERE u.id='{$user_id}'";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($query);
    ?>
    <div class="manage-profile">
        <div class="manage-profile-content">
            <div class="profile-pic">
                <img src="../assets/user-profiles/profile-<?php echo $_SESSION['USER'] ?>.jpg" alt="">
            </div>
            <div class="username">
                <p><?php echo $row['firstname']." ".$row['lastname'] ?></p>
                <small><?php echo $row['role_name'] ?></small>
            </div>
            <form action="#" method="POST">
                <div class="form-row">
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" value="<?php echo $row['address'] ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Phone Number</label>
                            <input type="text" class="form-control" name="phonenumber" value="<?php echo $row['phone_number'] ?>" disabled>
                        </div>
                    </div>
                    <div class="form-col">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>" disabled>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Age</label>
                            <input type="number" class="form-control" name="age" value="<?php echo $row['age'] ?>" disabled>
                        </div>
                    </div>
                </div>
                <div class="form-group mt-3 profile-input">
                    <label class="form-label prof-label">Change Profile Picture</label>
                    <input type="file" class="form-control" name="profile_pic" disabled>
                </div>
            </form>
            <div class="profile-actions">
                <?php 
                    if($_SESSION['ROLE_ID'] == 1){
                        echo '<a href="../admin/dashboard.php" class="btn btn-sm">Go Back</a>';
                    }
                    if($_SESSION['ROLE_ID'] == 2){
                        echo '<a href="../main/index.php" class="btn btn-sm">Go Back</a>';
                    }
                    if($_SESSION['ROLE_ID'] == 3){
                        echo '<a href="../admin/orders.php" class="btn btn-sm">Go Back</a>';
                    }
                ?>
                <button type="submit" class="btn btn-sm changepass-btn">Change Password</button>
                <button type="submit" class="btn btn-sm updateprof-btn">Update Profile</button>
            </div>
        </div>
    </div>

    <script src="../js/manage-profile.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
</body>
</html>

