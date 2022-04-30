<?php
    include_once '../partials/connectionString.php';

    $brandname = mysqli_real_escape_string($conn, $_POST['brand']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    if($_FILES['logo']['size'] > 0){
        if(!empty($brandname) && !empty($status)){
            $query = "INSERT INTO brands (brand_name, date_added, status) VALUES ('{$brandname}', current_timestamp(), '{$status}')";
            $result = mysqli_query($conn, $query);
            $brandId = $conn -> insert_id;
            if($result){
                if(isset($_FILES['logo'])){     
                    $newName = 'brand-'.$brandId;
                    $newfilename = $newName .".jpg";

                    $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/Shoepee/assets/brands/';
                    $uploadfile = $uploaddir . $newfilename;

                    if (move_uploaded_file($_FILES['logo']['tmp_name'], $uploadfile)) {
                        echo "Success";
                    } else {
                        echo "Please upload an image - jpeg, jpg, png.";
                    }
                } else
                {
                    echo "Please upload an image - jpeg, jpg, png.";
                }
            }
        } else{
            echo "Fill up all the required fields.";
        }
    } else{
        echo "Please upload an image - jpeg, jpg, png.";
    }
?>