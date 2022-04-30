<?php
    include_once '../partials/connectionString.php';
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);
    if(!empty($firstname) && !empty($lastname) && !empty($address) && !empty($phonenumber) && !empty($age) && !empty($email) && !empty($password) && !empty($confirm_password)){
        if($_FILES['profile_pic']['size'] > 0){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $sql = "SELECT * FROM users WHERE email='{$email}'";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query) > 0){
                    echo "Email already been taken. Please try another email";
                } else{
                    if($password === $confirm_password){
                        if(strlen($phonenumber) == 11){
                            $encrypt_pass = md5($password);
                            $sql1 = "INSERT INTO users (firstname, lastname, address, age, phone_number, email, password, role_id, join_date) VALUES ('{$firstname}', '{$lastname}', '{$address}', '{$age}' , '{$phonenumber}', '{$email}', '{$encrypt_pass}', '2', current_timestamp())";
                            $query1 = mysqli_query($conn, $sql1);
                            $user_id = $conn->insert_id;
                            if($query1){
                                if(isset($_FILES['profile_pic'])){
                                    $filename = 'profile-'.$user_id;
                                    $file = $filename.'.jpg';
                                    $dir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/user-profiles/';
                                    $uploadFile = $dir.$file;
                                    if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $uploadFile)){
                                        echo "You are now successfully registered. You may login now to your account";
                                    } else{
                                        echo "Profile picture upload failed";
                                    }
                                } else{
                                    echo "Please upload your profile picture. jeg, jpg, png format";
                                }
                            } else{
                                echo "Registration failed";
                            }
                        } else{
                            echo "Please input an 11-digit phonenumber";
                        }
                    } else{
                        echo "Password not matched. Please try again";
                    }
                }
            } else {
                echo "Invalid Email. Please provide a valid one";
            }
        } else{
            echo "Please upload your profile picture. jpeg, jpg, png format";
        }
    } else{
        echo "All fields are required";
    }
?>