<?php
    include_once '../partials/connectionString.php';
    $firstname = "Raymond";
    $lastname = "Reblando";
    $address = "Camagong, Oas, Albay";
    $age = 21;
    $phone_number = "09451479009";
    $email = "shoepeeadmin@gmail.com";
    $password = "ShoepeeAdmin";
    $encrypt_pass = md5($password);
    $role_id = 1;

    $sql = "INSERT INTO users (firstname, lastname, address, age, phone_number, email, password, role_id, join_date) VALUES ('{$firstname}', '{$lastname}', '{$address}', '{$age}' , '{$phone_number}', '{$email}', '{$encrypt_pass}', '{$role_id}', current_timestamp())";
    $query = mysqli_query($conn, $sql);
?>