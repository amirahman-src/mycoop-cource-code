<?php
	include 'config.php';

	if ($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['add'])) {
	    // Check if user_id and item_id are set in the POST request
	    if (isset($_POST['user_id']) && isset($_POST['item_id'])) {
	        $user_id = $_POST['user_id'];
	        $item_id = $_POST['item_id'];
	        $quantity = $_POST['quantity'];

	        $updateQuantityQuery = "UPDATE cart SET amount = '$quantity' WHERE user_id = '$user_id' AND item_id = '$item_id';";
	        $result = mysqli_query($db, $updateQuantityQuery);

	        header("Location:cart.php?user_id=$user_id");

	    } else {
	        echo "user_id or item_id not set in POST request.<br>";
	    }
	} else {
	    echo "Form not submitted properly.<br>";
	}
?>
