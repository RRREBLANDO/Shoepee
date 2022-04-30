<?php
    session_start();
    include_once '../partials/connectionString.php';
    $user_id = $_SESSION['USER'];
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone_number = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    if(!empty($address) && !empty($phone_number) && !empty($email) && $age){
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            $sql = "UPDATE users SET address='{$address}', phone_number='{$phone_number}', email='{$email}', age='{$age}' WHERE id='{$user_id}'";
            $query = mysqli_query($conn, $sql);
            if($query){
                if($_FILES['profile_pic']['size'] > 0){
                    $filename = 'profile-'.$user_id;
                    $file = $filename.'.jpg';
                    $dir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/user-profiles/';
                    $fileupload = $dir.$file;
                    if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $fileupload)){
                        echo 'Profile picture successfully updated';
                    }
                } else{
                    echo 'Profile Successfully Updated';
                }
            }
        } else{
            echo 'Invalid email address';
        }
    } else{
        echo 'Fields should not be empty';
    }
?>