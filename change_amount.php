<?php 
	include 'config.php';

	$item_id = $_GET['item_id'];
	$user_id = $_GET['user_id'];
	$quantity = $_GET['quantity'];
	$getProductQuery = "SELECT * FROM items WHERE item_id = $item_id";
	$result = mysqli_query($db, $getProductQuery);
	$row = mysqli_fetch_assoc($result);

	$item_name = $row['item_name'];
	$item_price = $row['price'];

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | <?php echo $item_name; ?></title>

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
			padding: 120px 40px 0px 40px;
			display: flex;
			justify-content: center;
		}

		.main-container {
			border-radius: 14px;
			border: 3px solid grey;
			width: 900px;
			padding: 40px;
			height: 400px;
			display: flex;
			flex-direction: row;
		}

		.product-image {
			height: 100%;
		}

		.info-section {
			padding: 0px 0px 0px 20px;
			display: grid;
			grid-template-rows: 2fr 1fr;
			width: 100%;
		}

		.item-label {
			margin: 0px;
			font-weight: 500;
		}

		.item-name {
			font-weight: 600;
			font-size: xx-large;
			margin: 0px;
		}

		.lower {
			display: grid;
			grid-template-rows: 1fr 1fr 1fr;
		}

		.counter-base {
		    display: flex;
		    align-items: center;
		    gap: 5px; /* Adds spacing between elements */
		}

		.minus,
		.plus {
		    width: 36px;
		    height: 36px;
		    border: 3px solid #f36666;
		    border-radius: 10px;
		    font-weight: bold;
		    font-size: 30px;
		    color: #f36666;
		    background-color: transparent;
		    cursor: pointer;
		    transition: .2s;
		    display: flex;
		    align-items: center;
		    justify-content: center; /* Centers content */
		}

		.minus:hover,
		.plus:hover {
		    color: white;
		    background-color: #f36666;
		}

		.counter-num {
		    width: 50px; /* Set a specific width for consistent sizing */
		    height: 100%; /* Matches the buttons */
		    text-align: center; /* Centers the number */
		    font-size: 18px; /* Adjust font size */
		    border: 3px solid #f36666; /* Matches the buttons */
		    border-radius: 10px; /* Rounded edges */
		    box-sizing: border-box; /* Includes padding and border in width/height */
		    font-family: "Poppins";
		    transition: .2s;
		}

		.counter-num:hover {
			width: 120px;
		}


		.price-tag {
			font-size: xx-large;
		}

		.buy-btn {
			height: 100%;
			width: 100%;
			font-family: "Poppins";
			font-size: 20px;
			font-weight: 600;
			cursor: pointer;
			background-color: transparent;
			border: 3px solid #f36666;
			border-radius: 10px;
			transition: .2s;
		}

		.buy-btn:hover {
			color: white;
			background-color: #f36666;
		}

		.buy-btn[disabled] {
			border-color: lightgrey;
		}

		.buy-btn[disabled]:hover {
			background-color: white;
			color: lightgrey;
		}

		.user-id,
		.item-id {
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
		<div class="main-container">
			<img src="get_image.php?item_id=<?php echo $row['item_id']; ?>" alt="Product Image" class="product-image">
			<form action="update_amount.php" method="POST" class="info-section">
			    <div class="upper">
			        <h3 class="item-label">Product name:</h3>
			        <h2 class="item-name"><?php echo $item_name; ?></h2>
			        <!-- Hidden input to include product name in the form -->
			        <input type="hidden" name="product_name" value="<?php echo $item_name; ?>">
			    </div>
			    <div class="lower">
			        <div class="first">
			            <div class="counter-base">
			                <button type="button" class="minus" onclick="updateCounter(-1)">-</button>
			                <!-- Quantity input field -->
			                <input type="number" name="quantity" class="counter-num" value="<?php echo htmlspecialchars($quantity); ?>" min="1" onchange="updatePrice()">
			                <button type="button" class="plus" onclick="updateCounter(1)">+</button>
			                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
							<input type="hidden" name="item_id" value="<?php echo htmlspecialchars($item_id); ?>">
			            </div>
			        </div>
			        <div class="second">
			            <!-- Dynamic price display -->
			            <label class="price-tag">RM <span id="total-price"><?php echo $item_price; ?></span></label>
			            <input type="hidden" name="price" id="hidden-price" value="<?php echo $item_price; ?>">
			        </div>
			        <div class="third">
			            <!-- Submit button -->
			            <?php 
			            	$status = $row['status'];
			            ?>
			            <button name="add" type="submit" class="buy-btn" <?php echo $status === "No stock" ? "disabled" : ""; ?>>Confirm change</button>
			        </div>
			    </div>
			</form>
		</div>
	</div>

	<script>
	    // JavaScript to handle the + and - button functionality
	    function updateCounter(change) {
	        const counterInput = document.querySelector('.counter-num');
	        let currentValue = parseInt(counterInput.value, 10);

	        // Update the value but ensure it's not less than 1
	        currentValue = Math.max(1, currentValue + change);
	        counterInput.value = currentValue;

	        // Update the price dynamically
	        updatePrice();
	    }

	    // Update price dynamically based on quantity
	    function updatePrice() {
	        const quantity = parseInt(document.querySelector('.counter-num').value, 10);
	        const basePrice = parseFloat(document.getElementById('hidden-price').value);
	        const totalPrice = quantity * basePrice;

	        // Update the displayed price
	        document.getElementById('total-price').innerText = totalPrice.toFixed(2);
	    }

	    updatePrice();
	</script>

</body>
</html>