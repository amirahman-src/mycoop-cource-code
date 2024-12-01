<?php
	include 'config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add'])) {
	    // Check if user_id and item_id are set in the POST request
	    if (isset($_POST['user_id']) && isset($_POST['item_id'])) {
	        $user_id = $_POST['user_id'];
	        $item_id = $_POST['item_id'];
	        $quantity = $_POST['quantity'];
	        
	        $addItemToCartQuery = "INSERT INTO cart (item_id, amount, user_id) VALUES ('$item_id', '$quantity', '$user_id');";
	        $checkItemQuery = "SELECT * FROM cart WHERE user_id = '$user_id' AND item_id = '$item_id';";
	        $result = mysqli_query($db, $checkItemQuery);

	        if (mysqli_num_rows($result)) {
	        	$row = mysqli_fetch_assoc($result);
	        	$currentQuantity = $row['amount'];
	        	$newQuantity = $currentQuantity + $quantity;

	        	$updateQuantityQuery = "UPDATE cart SET amount = '$newQuantity' WHERE user_id = '$user_id' AND item_id = '$item_id';";
	        	$result = mysqli_query($db, $updateQuantityQuery);

	        } else {
	        	$result = mysqli_query($db, $addItemToCartQuery);
	        }

	        header("Location:homepageuser.php?user_id=$user_id");

	    } else {
	        echo "user_id or item_id not set in POST request.<br>";
	    }
	} else {
	    echo "Form not submitted properly.<br>";
	}
?>
