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
    <title>Not Found</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>

    <div class="container">
        <div class="not-found">
            <div class="not-found-content">
                <img src="../assets/not-found.png" alt="not-found img">
                <?php
                    if($_SESSION['ROLE_ID'] == 1){
                        echo '<p>Page is not found. Please click the redirect link to be redirected. <a href="../admin/dashboard.php">Redirect</a></p>';
                    } else if($_SESSION['ROLE_ID'] == 2){
                        echo '<p>Page is not found. Please click the redirect link to be redirected. <a href="../main/index.php">Redirect</a></p>';
                    } else if($_SESSION['ROLE_ID'] == 3){
                        echo '<p>Page is not found. Please click the redirect link to be redirected. <a href="../admin/orders.php">Redirect</a></p>';
                    }
                ?>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>