<?php
	$passcode = $_POST['passcode'];
	$user_id = $_POST['user_id'];

	if ($passcode == "6061") {
		header("Location:homepageadmin.php?user_id=$user_id");
	} else {
		echo "<script>
			alert('Wrong passcode');
			window.location = 'profile.php?user_id=$user_id';
		</script>";
	}
?>