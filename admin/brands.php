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
    <title>Manage Brands</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    
    <section id="admin-brands">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Brands</h4>
                    <h6>Brands Available</h6>
                </div>
                <div class="right">
                    <button class="btn btn-sm add-brand"><i class='bx bx-plus'></i> ADD</button>
                </div>
            </div>
            
            <div class="brands-list">
                <?php
                    include_once '../partials/connectionString.php';

                    $sql = "SELECT * FROM brands";
                    $query = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_assoc($query))
                    {
                        $result = mysqli_query($conn, "SELECT COUNT(*) FROM products WHERE brand_id = '{$row['ID']}'");
                        $shoe_count = mysqli_fetch_array($result);

                        echo '<div class="brand-card">
                                <div class="brand-card-header">
                                    <span class="status-label">'.$row['STATUS'].'</span>
                                </div>
                                <div class="brand-card-body">
                                    <img src="../assets/brands/brand-'.$row['ID'].'.jpg".alt="brand logo">
                                    <span class="brand-name">'.$row['BRAND_NAME'].'</span>
                                    <p>'.$shoe_count[0].' Shoes</p>
                                </div>
                                <div class="brand-card-action">
                                    <button type="hidden" class="btn btn-sm" id="brand-delete" value="'.$row['ID'].'"><i class="bx bx-trash-alt"></i></button>
                                    <button class="btn btn-sm" id="brand-update" value="'.$row['ID'].'"><i class="bx bx-sync bx-rotate-180"></i></button>
                                </div>
                            </div>';
                    }
                ?>
            </div>
        </div>
    </section>

    <?php require '../partials/modals.php' ?>
    
    <script src="../js/index.js"></script>
    <script src="../js/brand.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>