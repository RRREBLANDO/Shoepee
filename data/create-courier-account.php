<?php
    include_once '../partials/connectionString.php';
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    if(!empty($firstname) && !empty($lastname) && !empty($address) && !empty($age) && !empty($phonenumber) && !empty($email)){
        if($_FILES['profile_pic']['size'] > 0){
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                $sql = "SELECT * FROM users WHERE  email='{$email}'";
                $query = mysqli_query($conn, $sql);
                if(mysqli_num_rows($query) > 0){
                    echo "Email already exist. Please input a new one";
                } else{
                    if(strlen($phonenumber) == 11){
                        $password = "ShoepeeCourier";
                        $encrypt_pass = md5($password);
                        $sql1 = "INSERT INTO users (firstname, lastname, address, age, phone_number, email, password, role_id, join_date) VALUES ('{$firstname}', '{$lastname}', '{$address}', '{$age}', '{$phonenumber}', '{$email}', '{$encrypt_pass}', '3', current_timestamp())";
                        $query1 = mysqli_query($conn, $sql1);
                        $user_id = $conn->insert_id;
                        if($query){
                            if(isset($_FILES['profile_pic'])){
                                $filename = 'profile-'.$user_id;
                                $file = $filename.'.jpg';
                                $dir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/user-profiles/';
                                $upload_file = $dir.$file;
                                if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $upload_file)){
                                    echo 'Courier Account Successfully Created';
                                } else{
                                    echo "Upload failed";
                                }
                            } else{
                                echo "Please select an image. jpeg, jpg, png.";
                            }
                        } else{
                            echo "Account creation failed";
                        }
                    } else{
                        echo "Please input a 11-digit phone number";
                    }
                }
            } else{
                echo "Invalid Email. Please input a valid one";
            }
        } else{
            echo "Please select an image. jpeg, jpg, png.";
        }
    } else{
        echo "All fields is required";
    }
?>