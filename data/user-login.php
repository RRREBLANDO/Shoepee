<?php
    session_start();
    if(isset($_POST['login_btn'])){
        include_once '../partials/connectionString.php';
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        if(!empty($email) && !empty($password)){
            
        } else{
            echo '<div class="popup-message show">
                    <div class="popup-icon">
                        <i class="bx bx-error-circle bx-tada" style="color:#ff4365" ></i>
                    </div>
                    <div class="popup-body">
                        <p style="color:#ff4365">Error</p>
                        <p style="color:#ff4365">Email and Password should not be empty</p>
                    </div>
                </div>';
        }
    }
?>