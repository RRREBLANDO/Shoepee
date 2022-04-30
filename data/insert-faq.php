<?php 
    include_once '../partials/connectionString.php';
    $question = mysqli_real_escape_string($conn, $_POST['question']);
    $answer = mysqli_real_escape_string($conn, $_POST['answer']);
    if(!empty($question) && !empty($answer)){
        $sql = "INSERT INTO faq (question, answer, date_added) VALUES ('{$question}', '{$answer}', current_timestamp())";
        $query = mysqli_query($conn, $sql);
        if($query){
            echo "FAQ Successfully Added";
        } else{
            echo "Insert Failed";
        }
    } else{
        echo "All fields are required";
    }
?>