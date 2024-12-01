<?php
	include 'config.php';
	$noItems = false;

	// Gets the username
	$user_id = $_GET['user_id'] or header("Location:index.php");
	$getNameQuery = "SELECT username FROM user WHERE user_id = '$user_id';"; // SQL query
	$result = mysqli_query($db, $getNameQuery);
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];

	// Check if the coop is open
	$getCoopStatusQuery = "SELECT status FROM status;"; // SQL query
	$statusRes = mysqli_query($db, $getCoopStatusQuery);
	$statusRow = mysqli_fetch_assoc($statusRes);
	$status = $statusRow['status'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Google fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | <?php echo $username; ?>'s cart</title>

	<style>
		body {
		    margin: 0px;
		    font-family: "Poppins";
		    font-weight: 500;
		    height: 100vh;
		}

		h1 {
			font-family: "Poppins";
		    font-weight: 500;
		}

		.header {
		    background-color: #f36666;
		    height: 58px;
		    width: 100%;
		    border-radius: 0 0 14px 14px;
		    position: fixed;
		   	display: flex;
		}

		.header div {
		    display: flex;
		    width: 100%;
		    height: 100%;
		    justify-content: space-between;
		    padding: 0px 20px 0px 20px;
		    align-items: center;
		}

		.menu-bar {
			width: 360px;
			height: 100%;
		}

		.link-dl {
			margin: 0px;
			display: flex;
			flex-direction: row-reverse;
			height: 100%;
			align-items: center;
		}

		.link-dl dt {
			height: 100%;
		}

		.link-dl a {
			color: white;
			text-decoration: none;
			height: 100%;
			padding: 0px 10px 0px 10px;
			display: flex;
			align-items: center;
			transition: .2s;
		}

		.link-dl a:hover {
			background-color: #c95555;
		}
		
		.logo {
		    height: 40px;
		    width: 127px;
		}

		.first-segment {
			padding: 120px 40px 120px 40px;
		}

		.cart-title {
			margin: 0px;
			font-size: 	3.5em;
		}

		.item-table {
			width: 100%;
			border-collapse: collapse;
			border-top: 1px solid grey;
		}

		.item-table th {
			text-align: left;
			padding: 8px 0px 8px 0px;
		}

		.item-table tr {
			border-bottom: 1px solid grey;
		}

		.item-tr td {
			padding: 8px 0px 8px 0px;
		}

		.item-image {
			height: 120px;
		}

		.change-amount,
		.delete-btn  {
			text-decoration: none;
			background-color: transparent;
			border-radius: 8px;
			border: 3px solid #f36666;
			padding: 4px;
			color: black;
			transition: .2s;
		}

		.delete-btn:hover {
			background-color: #f36666;
			color: white;
		}

		.change-amount {
			border-color: grey;
		}

		.change-amount:hover {
			background-color: grey;
			color: white;
		}

		.second-segment {
			padding-top: 40px;
			width: 100%;
			display: flex;
			flex-direction: row-reverse;
		}

		.total-label {
			margin-right: 40px;
			height: 40px;
			display: flex;
			align-items: center;
		}

		.checkout-btn {
			height: 40px;
			padding: 0px 10px 0px 10px;
			font-family: "Poppins";
			font-weight: 600;
			background-color: transparent;
			border: 2px solid grey;
			cursor: pointer;
			transition: .2s;
		}

		.checkout-btn:hover {
			border-radius: 8px;
			font-size: 15px;
		}

		.hidden {
			display: none;
		}
	</style>

</head>
<body>
	<header class="header">
		<div>
			<a href="homepageuser.php?user_id=<?php echo $user_id; ?>">
		        <img src="images/logo.png" class="logo">
		    </a>
		    <section class="menu-bar">
		    	<dl class="link-dl">
		    		<dt><a href="profile.php?user_id=<?php echo $user_id; ?>">My profile</a></dt>
		    		<dt><a href="cart.php?user_id=<?php echo $user_id; ?>">Cart</a></dt>
		    	</dl>
		    </section>
		</div>
	</header>
	<div class="first-segment">
		<h1 class="cart-title">Your cart</h1>
		<form action="confirm_order.php" method="post">
			<table class="item-table">
				<tr>
					<th>Item image</th>
					<th>Item name</th>
					<th>Quantity</th>
					<th>Subtotal</th>
					<th>Action</th>
				</tr>
				<?php 
					$getUserCartItemQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
					$cartResult = mysqli_query($db, $getUserCartItemQuery);

					// Check if the cart is empty
					$noItems = mysqli_num_rows($cartResult) == 0;

					$result = mysqli_query($db, $getUserCartItemQuery);

					while ($row = mysqli_fetch_assoc($result)) {
						$quantity = $row['amount'];
						$item_id = $row['item_id'];
						$user_id = $row['user_id'];

						// Use a separate variable for the second query
						$getItemDetailQuery = "SELECT * FROM items WHERE item_id = '$item_id';";
						$itemResult = mysqli_query($db, $getItemDetailQuery);
						$bow = mysqli_fetch_assoc($itemResult);
						$item_name = $bow['item_name'];
						$item_price = $bow['price'];

						echo "<tr class='item-tr'>";
						echo "<td>";
						echo "<img src='get_image.php?item_id=" . $row['item_id'] . "' alt='Product Image' class='item-image'>";
						echo "</td>";
						echo "<td>";
						echo "<label>$item_name</label>";
						// Hidden input that stores user id
						echo "<input type='hidden' value='$user_id' name='user_id'>";
						echo "</td>";
						echo "<td>";
						echo "<label class='quantity'>$quantity</label>";
						echo "<br><br><a href='change_amount.php?item_id=$item_id&user_id=$user_id&quantity=$quantity' class='change-amount'>&#9998;&nbsp;Change</a>";
						echo "</td>";
						echo "<td>";
						// Calculate subtotal
						$subtotal = number_format($item_price * $quantity, 2);
						echo "<label>RM $subtotal</label>";
						echo "<span style='display: none;' class='subtotal'>$subtotal</span>";
						echo "</td>";
						echo "<td>";
						// Sends the user's id to delete.php
						echo "<a href='delete_item.php?item_id=$item_id&user_id=$user_id' class='delete-btn'>Delete</a>";
						echo "</td>";
						echo "</tr>";
					}
				?>
			</table>

			<!-- Display info if there is no item in the cart -->
			<p class="<?php echo $noItems ? '' : 'hidden' ?>">You have no items in your cart</p>
			<div class="second-segment <?php echo $noItems ? 'hidden' : '' ?>">
				<input type="submit" value="Checkout" <?php echo $status == 1 ? '' : 'disabled' ?> class="checkout-btn">
				<label class="total-label"></label>
			</div>
		</form>
	</div>

	<script>
	    // Select all elements with the class "subtotal"
	    var subtotals = document.querySelectorAll('.subtotal');

	    // Initialize the sum variable
	    let totalSum = 0;

	    // Iterate over each element in subtotals
	    subtotals.forEach(function(element) {
	        // Parse the content of the label as a number and add it to the total
	        totalSum += parseFloat(element.textContent) || 0; // Use 0 if parsing fails
	    });

	    // Display the sum in an element, e.g., a paragraph with id "total"
	    document.querySelector('.total-label').textContent = "Total: RM " + totalSum.toFixed(2);
	</script>

</body>
</html>
