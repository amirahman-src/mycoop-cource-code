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
		if ($detail == "0") {
			$block = "null";
			$dorm = "null";
		}

		$addOrderQuery = "INSERT INTO orders (order_id, user_id, type, block, dorm, datee) VALUES ('$order_id', '$user_id', '$type', '$block', '$dorm', '$date');";
		global $db;
		// Add to orders
		mysqli_query($db, $addOrderQuery);
		$addOrderQuery = "INSERT INTO order_queue (order_id) VALUES ('$order_id');";
		mysqli_query($db, $addOrderQuery);

		$getUserCartItemQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
		$result = mysqli_query($db, $getUserCartItemQuery);

		while ($row = mysqli_fetch_assoc($result)) {
			$item_id = $row['item_id'];
			$quantity = $row['amount'];

			$addOrderQuery = "INSERT INTO order_detail (order_id, user_id, item_id, amount) VALUES ('$order_id', '$user_id', '$item_id', '$quantity');";
			// Add to order details
			mysqli_query($db, $addOrderQuery);

			// Remove item from cart
			$removeItemFromCartQuery = "DELETE FROM cart WHERE user_id = '$user_id';";
			mysqli_query($db, $removeItemFromCartQuery);
			header("Location:cart.php?user_id=$user_id");
		}
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