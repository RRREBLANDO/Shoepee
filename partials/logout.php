<?php
    session_start();
    if(isset($_SESSION['USER']) && isset($_SESSION['ROLE_ID'])){
        session_unset();
        session_destroy();
        header("location:../main/index.php");
    }
?>