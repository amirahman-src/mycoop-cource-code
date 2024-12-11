<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $item_id = $_POST['item_id'];
    $item_name = $_POST['item_name'];
    $item_type = $_POST['item_type'];
    $price = $_POST['price'];
    $status = $_POST['status'];
    $user_id = $_POST['user_id'];

    // Check if a new image is uploaded
    if (!empty($_FILES['item_image']['tmp_name'])) {
        $item_image = file_get_contents($_FILES['item_image']['tmp_name']);
        $updateQuery = "UPDATE items SET item_name = ?, item_type = ?, price = ?, status = ?, item_image = ? WHERE item_id = ?";
        $stmt = mysqli_prepare($db, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ssdssi", $item_name, $item_type, $price, $status, $item_image, $item_id);
    } else {
        $updateQuery = "UPDATE items SET item_name = ?, item_type = ?, price = ?, status = ? WHERE item_id = ?";
        $stmt = mysqli_prepare($db, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ssdsi", $item_name, $item_type, $price, $status, $item_id);
    }

    $result = mysqli_stmt_execute($stmt);

    if ($result) {
        echo "Product updated successfully!";
        header("Location: homepageadmin.php?user_id=$user_id");
    } else {
        echo "Failed to update product: " . mysqli_error($db);
    }
}
?>
