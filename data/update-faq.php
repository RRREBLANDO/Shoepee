<?php
    include_once '../partials/connectionString.php';
    $faq_id = mysqli_real_escape_string($conn, $_POST['faq_id']);
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    if(!empty($faq_id) && !empty($question) && !empty($answer)){
        $sql = "UPDATE faq SET question='{$question}', answer='{$answer}' WHERE id='{$faq_id}'";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "FAQ Successfully Updated";
        } else{
            echo "Update Failed";
        }
    } else{
        echo "All fields are required";
    }
?>