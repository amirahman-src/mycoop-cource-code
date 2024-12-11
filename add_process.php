<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_name = $_POST['item_name'];
    $item_type = $_POST['item_type'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];

    // Get binary data from the uploaded image
    $item_image = file_get_contents($_FILES['item_image']['tmp_name']);

    // Insert product into the database
    $insertProductQuery = "INSERT INTO items (item_name, item_type, price, status, item_image) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $insertProductQuery);
    mysqli_stmt_bind_param($stmt, "ssdss", $item_name, $item_type, $price, $status, $item_image);
    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Product added successfully!";
        echo "<script>window.location.href='homepageadmin.php?user_id=$user_id';</script>";
    } else {
        echo "Failed to add product: " . mysqli_error($db);
    }
}
?>
