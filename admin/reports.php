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
    <title>Reports</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>
    <?php require '../partials/message-popup.php' ?>
    
    <section id="admin-orders">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>Reports</h4>
                    <h6>Generate Reports</h6>
                </div>
                <div class="right" style="display: flex; gap: 1rem">
                    <div class="specific-report-container">
                        <button class="btn btn-sm specific-report">BETWEEN</button>
                        <div class="report-dropdown">
                            <form action="#" method="POST">
                                <div class="form-content">
                                    <label for="">Start</label>
                                    <input type="date" name="start_date" class="start-date-input" required>
                                </div>    
                                <div class="form-content">
                                    <label for="">End</label>
                                    <input type="date" name="end_date" class="end-date-input" required>
                                </div>
                                <div class="action">
                                    <button type="submit" class="btn btn-sm generate-specific-btn">Generate</button>
                                    <button class="btn btn-sm dropdown-close-btn">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <button class="btn btn-sm generate-report">GENERATE</button>
                </div>
            </div>

            <div class="customer-orders">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td>No.</td>
                                <td>Month</td>
                                <td>Day</td>
                                <td>Year</td>
                                <td></td>
                                <td width="15%">Action</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include_once '../partials/connectionString.php';
                            $sql = "SELECT * FROM reports";
                            $query = mysqli_query($conn, $sql);
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_assoc($query)){
                                    echo '<tr>
                                            <td>000'.$row['ID'].'</td>
                                            <td>'.date_format(date_create($row['DATE_GENERATED']), "F").'</td>
                                            <td>'.date_format(date_create($row['DATE_GENERATED']), "d").'</td>
                                            <td>'.date_format(date_create($row['DATE_GENERATED']), "Y").'</td>
                                            <td>'.$row['TYPE'].'</td>
                                            <td>
                                                <button class="btn btn-sm report-details" value="'.$row['DATE_GENERATED'].'"><i class="bx bx-detail"></i></button>
                                            </td>
                                        </tr>';
                                }
                            } else{
                                echo 'No records found';
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
    <script src="../js/report.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>