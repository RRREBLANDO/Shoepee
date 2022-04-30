<?php
    include_once '../partials/connectionString.php';
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);
    if(!empty($user_id)){
        $sql = "DELETE FROM users WHERE id = '{$user_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            $profile_pic = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/user-profiles/profile-'.$user_id.'.jpg';
            if(file_exists($profile_pic)){
                unlink($profile_pic);
            }
            echo "User successfully deleted";
        } else{
            echo "Delete operation failed";
        }
    } else{
        echo "User cannot be found";
    }
?>