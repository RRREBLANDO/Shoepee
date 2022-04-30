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
    <title>Manage FAQ</title>
    <?php require '../partials/imports.php' ?>
</head>
<body>
    <?php require '../partials/_nav.php' ?>

    <section id="admin-products">
        <div class="container">
            <div class="top">
                <div class="left">
                    <h4>FAQ</h4>
                    <h6>Most Frequent Ask Questions</h6>
                </div>
                <div class="right">
                    <button class="btn btn-sm add-faq" data-target="add-faq-modal"><i class='bx bx-plus'></i> ADD</button>
                </div>
            </div>

            <div class="customer-orders mt-4">
                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <td width="35%">Question</td>
                                <td width="53%">Answer</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <?php
                                    include_once '../partials/connectionString.php';
                                    $sql = "SELECT * FROM faq";
                                    $query = mysqli_query($conn, $sql);
                                    if(mysqli_num_rows($query) > 0){
                                        while($row = mysqli_fetch_assoc($query)){
                                            echo '<tr>
                                                    <td class="faq-question">'.$row['QUESTION'].'</td>
                                                    <td class="faq-answer">'.$row['ANSWER'].'</td>
                                                    <td>
                                                        <button class="btn btn-sm delete-faq" data-target="delete-faq-dialog" value="'.$row['ID'].'"><i class="bx bx-trash-alt"></i></button>
                                                        <button class="btn btn-sm update-faq" data-target="update-faq-modal" value="'.$row['ID'].'"><i class="bx bx-sync bx-rotate-180"></i></button>
                                                    </td>
                                                </tr>';
                                        }
                                    } else{
                                        echo "No records found";
                                    }
                                ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <?php require '../partials/modals.php' ?>

    <script src="../js/index.js"></script>
    <script src="../js/faq.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>

</body>
</html>