<?php
    include 'config.php';
    $user_id = $_GET['user_id'] ?? null;

    // Check if user_id is available
    if (!isset($user_id)) {
        echo "Error: User ID is missing.";
        return;
    }

    // Fetch products from the database
    $getProductsQuery = "SELECT * FROM items ORDER BY status;";
    $result = mysqli_query($db, $getProductsQuery);

    while ($row = mysqli_fetch_assoc($result)) {
        $item_id = $row['item_id'];
        $item_status = $row['status'];

        switch ($item_status) {
            case 'High stock':
                $status_color = "green";
                break;
            case 'Low stock':
                $status_color = "yellow";
                break;
            case 'No stock':
                $status_color = "red";
                break;
        }

        echo "<div class='product-card'>";
        echo "<img src='get_image.php?item_id=" . $row['item_id'] . "' alt='Product Image'>";
        echo "<div class='item-name'><label>" . $row['item_name'] . "</label></div>";
        echo "<div class='item-info'>";
        echo "<label class='item-price'>RM " . number_format($row['price'], 2) . "</label>";
        echo "<label class='item-status $status_color'>" . $row['status'] . "</label>";
        echo "</div>";
        echo "<a class='buy-btn' href='product_page.php?item_id=$item_id&user_id=$user_id'>View</a>";
        echo "</div>";
    }
?>
