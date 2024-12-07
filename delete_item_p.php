<?php
	include 'config.php';

	$item_id = $_GET['item_id'];

	$deleteItemQuery = "DELETE FROM items WHERE item_id = '$item_id';";
	mysqli_query($db, $deleteItemQuery);
?>