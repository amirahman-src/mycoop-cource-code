<?php
	include 'config.php';

	// Get the image ID or key
	$item_id = $_GET['item_id'];

	// Retrieve the binary image data
	$query = "SELECT item_image FROM items WHERE item_id = ?";
	$stmt = $db->prepare($query);
	$stmt->bind_param("i", $item_id);
	$stmt->execute();
	$stmt->bind_result($imageBlob);
	$stmt->fetch();
	$stmt->close();

	// Detect the MIME type
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mimeType = $finfo->buffer($imageBlob);

	// Output the image with the correct MIME type
	header("Content-Type: $mimeType");
	echo $imageBlob;
?>
