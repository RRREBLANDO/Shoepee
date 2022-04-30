<?php
    session_start();
    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 1){
        header("location: ../admin/dashboard.php");
    } else if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 2){
        header("location: ../main/index.php");
    } else if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID']) && $_SESSION['ROLE_ID'] == 3){
        header("location: ../admin/orders.php");
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

    <?php require '../partials/message-popup.php' ?>

    <div class="signup">
        <div class="signup-left-side">
            <a class="signup-brand-logo" href="../main/index.php"><i class='bx bxs-shopping-bag-alt bx-tada bx-rotate-180' ></i> Shoe<span style="color: #111111">pee</span></a>
            <h2>Few steps away in creating your account.</h2>
            <img src="../assets/signupvec.svg" alt="" class="signup-vector sm-signup-vector md-signup-vector">
        </div>
        <div class="signup-right-side">
            <h3>Register</h3>
            <p class="text-muted">Lets create your account to manage and browse our
                <br> good quality products.</p>
            <form action="#" method="POST">
                <div class="row row-sm gap-2">
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label">Firstname</label>
                            <input type="text" class="form-control" name="firstname" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Lastname</label>
                            <input type="text" class="form-control" name="lastname" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" name="address" required>
                        </div>
                        <div class="form-group mt-3 d-flex">
                            <div>
                                <label class="form-label">Phone No.</label>
                                <input type="text" class="form-control" name="phonenumber" required>
                            </div>
                            <div class="ms-3">
                                <label class="form-label">Age</label>
                                <input type="number" class="form-control" name="age" required>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="confirm_password" required>
                        </div>
                        <div class="form-group mt-3">
                            <label class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" name="profile_pic" required>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-sm register-btn">Register</button>
                </div>
                <p>Already have an account? <a href="../main/login.php" class="signup-link">Log in</a></p>
            </form>
        </div>
    </div>

    <script src="../js/signup.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
</body>
</html>

