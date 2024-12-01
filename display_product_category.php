<?php
    include 'config.php';
    $user_id = $_GET['user_id'] ?? null;

    // Get the selected category from the query parameter
    $category = $_GET['category'] ?? 'All';
    if (!isset($user_id)) {
        echo "Error: User ID is missing.";
        return;
    }

    // Prepare SQL query based on category
    if ($category === 'All') {
        $query = "SELECT * FROM items ORDER BY status";
    } else {
        // Escape the category to prevent SQL injection
        $category = $db->real_escape_string($category);
        $query = "SELECT * FROM items WHERE item_type = '$category' ORDER BY status";
    }

    $result = $db->query($query);

    if ($result) {
        // Display products
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
            echo "<img src='get_image.php?item_id=" . htmlspecialchars($row['item_id']) . "' alt='Product Image'>";
            echo "<div class='item-name'><label>" . htmlspecialchars($row['item_name']) . "</label></div>";
            echo "<div class='item-info'>";
            echo "<label class='item-price'>RM " . number_format($row['price'], 2) . "</label>";
            echo "<label class='item-status $status_color'>" . htmlspecialchars($row['status']) . "</label>";
            echo "</div>";
            echo "<a class='buy-btn' href='product_page.php?item_id=$item_id&user_id=$user_id'>View</a>";
            echo "</div>";
        }
    } else {
        echo "Error: " . $db->error;
    }

    $db->close();
?>
