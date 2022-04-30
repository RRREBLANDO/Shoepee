<?php
    include_once '../partials/connectionString.php';
    $faq_id = mysqli_real_escape_string($conn, $_POST['faq_id']);
    if(!empty($faq_id)){
        $sql = "DELETE FROM faq WHERE id='{$faq_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "FAQ Successfully Deleted";
        } else{
            echo "Delete Failed";
        }
    } else{
        echo "Delete Failed";
    }
?>