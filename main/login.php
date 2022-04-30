<?php
    session_start();
    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 1){
        header("location: ../admin/dashboard.php");
    } else if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 2){
        header("location: ../main/index.php");
    } else if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 3){
        header("location: ../admin/orders.php");
    }
    if(isset($_POST['login_btn'])){
        include_once '../partials/connectionString.php';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, md5($_POST['password']));
        if(!empty($email) && !empty($password)){
            $sql = "SELECT * FROM users WHERE email='{$email}' AND password='{$password}'";
            $query = mysqli_query($conn, $sql);
            if(mysqli_num_rows($query) > 0){
                $row = mysqli_fetch_assoc($query);
                if($row['ROLE_ID'] == 2){
                    $_SESSION['USER'] = $row['ID'];
                    $_SESSION['ROLE_ID'] = $row['ROLE_ID'];
                    header("location:../main/index.php");
                } else if($row['ROLE_ID'] == 3){
                    $_SESSION['USER'] = $row['ID'];
                    $_SESSION['ROLE_ID'] = $row['ROLE_ID'];
                    header("location:../admin/orders.php");
                } else{
                    $_SESSION['USER'] = $row['ID'];
                    $_SESSION['ROLE_ID'] = $row['ROLE_ID'];
                    header("location:../admin/dashboard.php");
                }
            } else{
                echo '<div class="popup-message show">
                        <div class="popup-icon">
                            <i class="bx bx-error-circle bx-tada" style="color:#ff4365" ></i>
                        </div>
                        <div class="popup-body">
                            <p style="color:#ff4365">Error</p>
                            <p style="color:#ff4365">Email or Password is incorrect</p>
                        </div>
                    </div>';
            }
        } else{
            echo '<div class="popup-message show">
                    <div class="popup-icon">
                        <i class="bx bx-error-circle bx-tada" style="color:#ff4365" ></i>
                    </div>
                    <div class="popup-body">
                        <p style="color:#ff4365">Error</p>
                        <p style="color:#ff4365">Email and Password should not be empty</p>
                    </div>
                </div>';
        }
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

    <div class="login">
        <div class="left-side text-center">
            <h2>A few clicks away to start shopping. <br> Login now to buy the shoes offered by Shoepee.</h2>
            <img src="../assets/loginvec.svg" alt="login vec">
        </div>
        <div class="right-side">
            <a class="brand-logo" href="../main/index.php"><i class='bx bxs-shopping-bag-alt bx-tada bx-rotate-180' ></i> Shoe<span class="color-custom-dark">pee</span></a>

            <h3>Login</h3>
            <h5>Provide valid account credentials</h5>
            <form method="POST" action="#">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
                <div class="form-group mt-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <button type="submit" name="login_btn" class="btn btn-sm">Login</button>
                </div>
                <p>Dont have account yet? <a href="../main/signup.php" class="signup-link">Signup now</a></p>
            </form>
        </div>
    </div>

    <script>
        const popupMsg = document.querySelector(".popup-message");
        setInterval(() => {
            popupMsg.classList.remove("show");
        }, 2000);
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
</body>
</html>