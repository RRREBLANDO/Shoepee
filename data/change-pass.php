<?php
    session_start();
    include_once '../partials/connectionString.php';
    $user_id = $_SESSION['USER'];
    $old_pass = mysqli_real_escape_string($conn, $_POST['old_password']);
    $new_pass = mysqli_real_escape_string($conn, $_POST['new_password']);
    $confirm_pass = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if(!empty($old_pass) && !empty($new_pass) && !empty($confirm_pass)){
        $sql = "SELECT * FROM users WHERE id='{$user_id}'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $getpassword = md5($old_pass);
            $ecncrypt_pass = $row['PASSWORD'];
            if($getpassword === $ecncrypt_pass){
                if($new_pass === $confirm_pass){
                    $new_password = md5($new_pass);
                    $sql1 = "UPDATE users SET password='{$new_password}' WHERE id='{$user_id}'";
                    $query1 = mysqli_query($conn, $sql1);
                    if($query1){
                        echo 'Password successfully changed';
                    } else{
                        echo 'Failed to changed password';
                    }
                } else{
                    echo 'Password doesnt matched';
                }
            } else{
                echo 'Password incorrect. Please try again';
            }
        } else{
            echo 'No records found';
        }
    } else{
        echo 'All fields are required';
    }
?>