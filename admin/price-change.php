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
    <title>Price Change</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php include '../data/load-select-products.php' ?>
    
    <section id="admin-orders">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Price Change</h4>
                    <h6>Product Price Changes</h6>
                </div>
                <div class="right">
                    <button class="btn btn-sm add-price" data-target="add-price-modal">ADD</button>
                </div>
            </div>

            <div class="customer-orders">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td>Product Name</td>
                                <td>Amount</td>
                                <td>Start Effectivity Date</td>
                                <td>End Effectivity Date</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                include_once '../partials/connectionString.php';
                                $sql = "SELECT p.product_name, pc.amount, pc.start_eff_date, pc.end_eff_date FROM price_change pc JOIN products p ON pc.product_id = p.id";
                                $query = mysqli_query($conn, $sql);
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo '<tr>
                                                <td style="text-transform: capitalize">'.$row['product_name'].'</td>
                                                <td>Php. '.$row['amount'].'</td>
                                                <td>'.date_format(date_create($row['start_eff_date']), "F d, Y").'</td>
                                                <td>'.date_format(date_create($row['end_eff_date']), "F d, Y").'</td>
                                            </tr>';
                                    }
                                } else{
                                    echo "No Records Found";
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
    <script src="../js/price-change.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>