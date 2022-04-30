<?php
    $sql = "SELECT * FROM brands";
    $query = mysqli_query($conn, $sql);

    $brands = '<select name="product_brand" id="brands-select" required>
    <option value="">Please select brand</option>';
    while ($row = mysqli_fetch_assoc($query)) {
        $brands .= '<option value="'.$row['ID'].'">'.$row['BRAND_NAME'].'</option>';
    }
    $brands .= '</select>';
?>