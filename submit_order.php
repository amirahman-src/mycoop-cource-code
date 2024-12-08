<?php
	include 'config.php';

	$user_id = $_POST['user_id'];
	$type = $_POST['type'];
	$block = $_POST['block'];
	$dorm = $_POST['dorm'];
	$detail = $_POST['detail'];
	$date = $_POST['date'];

	$order_id = 0;
	$findOrderIdQuery = "SELECT * FROM orders WHERE order_id = (SELECT MAX(order_id) FROM orders);";
	$result = mysqli_query($db, $findOrderIdQuery);

	function addOrderFunc($order_id, $user_id, $type, $block, $dorm, $detail, $date) {
	    global $db;
	    
	    if ($detail == "0") {
	        $block = "null";
	        $dorm = "null";
	    }

	    // Add order to the orders table
	    $addOrderQuery = "INSERT INTO orders (order_id, user_id, type, block, dorm, datee) VALUES ('$order_id', '$user_id', '$type', '$block', '$dorm', '$date');";
	    mysqli_query($db, $addOrderQuery);

	    // Add order to the order_queue table
	    $addOrderQuery = "INSERT INTO order_queue (order_id) VALUES ('$order_id');";
	    mysqli_query($db, $addOrderQuery);

	    // Retrieve items from the cart
	    $getUserCartItemQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
	    $result = mysqli_query($db, $getUserCartItemQuery);

	    while ($row = mysqli_fetch_assoc($result)) {
	        $item_id = $row['item_id'];
	        $quantity = $row['amount'];

	        // Retrieve the price of the item
	        $getItemPriceQuery = "SELECT price FROM items WHERE item_id = '$item_id';";
	        $priceResult = mysqli_query($db, $getItemPriceQuery);
	        $priceRow = mysqli_fetch_assoc($priceResult);
	        $price = $priceRow['price'];

	        // Calculate the subtotal
	        $subtotal = $price * $quantity;

	        // Add order details to the order_detail table
	        $addOrderDetailQuery = "INSERT INTO order_detail (order_id, user_id, item_id, amount, subtotal) VALUES ('$order_id', '$user_id', '$item_id', '$quantity', '$subtotal');";
	        mysqli_query($db, $addOrderDetailQuery);
	    }

	    // Remove items from the cart
	    $removeItemFromCartQuery = "DELETE FROM cart WHERE user_id = '$user_id';";
	    mysqli_query($db, $removeItemFromCartQuery);

	    // Redirect to cart page
	    header("Location:cart.php?user_id=$user_id");
	}

	if (mysqli_num_rows($result) > 0) {
	    $row = mysqli_fetch_assoc($result);
	    $biggestId = $row['order_id'];
	    $order_id = $biggestId + 1;
	    addOrderFunc($order_id, $user_id, $type, $block, $dorm, $detail, $date);
	} else {
	    $order_id = 1;
	    addOrderFunc($order_id, $user_id, $type, $block, $dorm, $detail, $date);
	}
?>
