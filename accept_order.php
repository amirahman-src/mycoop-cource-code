<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    $deleteOrderQuery = "DELETE FROM order_queue WHERE order_id = '$order_id'";
    mysqli_query($db, $deleteOrderQuery);

    // Redirect back to admin panel
    header("Location: homepageadmin.php?user_id=$user_id");
    exit();
}
?>
