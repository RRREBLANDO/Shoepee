<?php

    include_once '../partials/connectionString.php';

    $brandId = mysqli_real_escape_string($conn, $_POST['BRAND_ID']);

    $sql = "SELECT * FROM brands WHERE ID='{$brandId}'";
    $query = mysqli_query($conn, $sql);
    
    if(mysqli_num_rows($query) > 0){
        $result = mysqli_fetch_assoc($query);
        $selected = $result['STATUS'];
        // echo '
        // <div class="form-content">
        //     <label for="">Brand Name</label>
        //     <input type="text" class="brand-name-input" value="'.$result['BRAND_NAME'].'" disabled>
        // </div>
        // <div class="form-content">
        //     <label for="">Brand Status</label>
        //     <select class="brand-status" name="status">
        //         <option value="">Please select</option>
        //         <option value="Available" '.(($selected=='Available')?'selected="selected"':"").'>Available</option>
        //         <option value="Unavailable" '.(($selected == 'Unavailable')? 'selected="selected"':"").'>Unavailable</option>
        //     </select>
        // </div>
        // <button type="submit" name="updateBrand" class="submit-btn" id="update-brand-submit">Submit</button>
        // <button class="close-btn">Close</button>
        //     ';
        echo json_encode($result);
    } else{
        echo "No data found";
    }
?>