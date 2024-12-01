<?php 
	include 'config.php';

	$item_id = $_GET['item_id'];
	$user_id = $_GET['user_id'];

	$deleteItemQuery = "DELETE FROM cart WHERE item_id = '$item_id' AND user_id = '$user_id';";
	$result = mysqli_query($db, $deleteItemQuery);
	header("Location:cart.php?user_id=$user_id");
?>