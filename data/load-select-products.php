<?php
    include_once '../partials/connectionString.php';
    $sql = "SELECT * FROM products";
    $query = mysqli_query($conn, $sql);
    $products = '<select name="product" class="product-select" required>
    <option value="">Please select a product</option>';
    while($row = mysqli_fetch_assoc($query)){
        $products .= '<option value="'.$row['ID'].'">'.$row['PRODUCT_NAME'].'</option>';
    }
    $products .= '</select>';
?>