<?php
	include 'config.php';

	$user_id = $_POST['user_id'] or header("Location:index.php");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>Confirm order</title>

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

		.title {
			margin: 0px;
			font-size: 3.5em;
		}

		table {
			text-align: left;
			width: 100%;
			border-top: 1px solid lightgrey;
			border-collapse: collapse;
		}

		td, th {
			border-bottom: 1px solid lightgrey;
		}

		td {
			padding: 10px 0px 10px 0px;
		}

		.receive-label,
		.delivery-details {
			display: inline-block;
		}

		.delivery-details {
			margin-left: 40px;
		}

		.select-option,
		.pay-btn {
			margin-left: 20px;
			padding: 5px;
			font-family: "Poppins";
			font-weight: 600;
			border: 3px solid grey;
			border-radius: 8px;
		}

		.special {
			margin-left: 0px;
		}

		.special2 {
			margin-left: 20px;
		}

		.pay-btn {
			width: 90px;
			background-color: transparent;
			border: 3px solid #f36666;
			border-radius: 8px;
			cursor: pointer;
			float: right;
			margin-top: 10px;
			transition: .2s;
		}

		.pay-btn:hover {
			color: white;
			background-color: #f36666;
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
		<h1 class="title">Confirm order</h1>
		<h1>Items</h1>
		<table>
			<tr>
				<th>Item name</th>
				<th>Quantity</th>
				<th>Subtotal</th>
			</tr>
			<?php
				$getUserCartItemQuery = "SELECT * FROM cart WHERE user_id = '$user_id';";
				$cartResult = mysqli_query($db, $getUserCartItemQuery); // Renamed variable

				while ($row = mysqli_fetch_assoc($cartResult)) {
				    $item_id = $row['item_id'];
				    $quantity = $row['amount'];

				    $getItemDetailQuery = "SELECT * FROM items WHERE item_id = '$item_id';";
				    $itemResult = mysqli_query($db, $getItemDetailQuery); // New variable name
				    $itemDetailRow = mysqli_fetch_assoc($itemResult);

				    $item_name = $itemDetailRow['item_name'];
				    $item_price = $itemDetailRow['price'];

				    $subtotal = number_format($item_price * $quantity, 2);

				    echo "<tr>";
				    echo "<td>" . htmlspecialchars($item_name) . "</td>";
				    echo "<td>" . htmlspecialchars($quantity) . "</td>";
				    echo "<td>RM " . "<label class='subtotal'>" . htmlspecialchars($subtotal) . "</label>" . "</td>";
				    echo "</tr>";
				}
			?>
		</table>
		<form method="post" action="submit_order.php" class="pay-form">
			<p class="receive-label">Receive type:</p>
			<select name="type" class="select-option">
				<option>Pick up</option>
				<option>Delivery</option>
			</select>
			<section class="delivery-details hidden">
				<p class="receive-label">Blok:</p>
				<select name="block" class="select-option">
					<option>ASPURA BLOK A</option>
					<option>ASPURA BLOK B</option>
					<option>ASPURA BLOK C</option>
					<option>ASPURI BLOK A</option>
					<option>ASPURI BLOK B</option>
				</select>
				<select name="dorm" class="select-option special">
					<option>101</option>
					<option>102</option>
					<option>103</option>
					<option>201</option>
					<option>202</option>
					<option>203</option>
					<option>301</option>
					<option>302</option>
					<option>303</option>
					<option>401</option>
					<option>402</option>
					<option>403</option>
				</select>
				<p class="receive-label special2">Delivery fund : RM 1.00</p>
			</section>
			<p class="receive-label special2">Tax : RM 0.20</p>
			<input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
			<input type="hidden" name="detail" class="detail" value="0">
			<input type="submit" name="pay" class="pay-btn" value="Pay">
		</form>
		<section class="total-section pay-form">
		</section>
	</div>
	<script>
	    document.addEventListener("DOMContentLoaded", function () {
		    const selectElement = document.querySelector("select[name='type']");
		    const deliveryDetails = document.querySelector(".delivery-details");
		    const detailPass = document.querySelector(".detail");
		    const totalSection = document.querySelector(".total-section");
		    let totalLabel = document.createElement("p");
		    totalLabel.classList.add("total-label");
		    totalSection.appendChild(totalLabel);

		    let totalSum = 0;

		    function updateVisibility() {
		        const selectedOption = selectElement.value;
		        if (selectedOption === "Pick up") {
		            deliveryDetails.classList.add("hidden");
		            detailPass.value = "0"; // No delivery details
		        } else {
		            deliveryDetails.classList.remove("hidden");
		            detailPass.value = "1"; // Delivery details shown
		        }
		        updateTotal(); // Ensure total updates based on visibility
		    }

		    function getTotal() {
		        totalSum = 0; // Reset sum
		        const subtotals = document.querySelectorAll(".subtotal");
		        subtotals.forEach((element) => {
		            totalSum += parseFloat(element.textContent) || 0;
		        });
		    }

		    function updateTotal() {
		        getTotal();
		        const selectedOption = selectElement.value;
		        let totalWithExtras = totalSum;

		        if (selectedOption === "Delivery") {
		            totalWithExtras += 1.2; // Delivery fund + tax
		        } else {
		            totalWithExtras += 0.2; // Only tax
		        }

		        totalLabel.innerHTML = `Total (including tax and funds): RM ${totalWithExtras.toFixed(2)}`;
		    }

		    // Set initial visibility and total
		    updateVisibility();

		    // Update on change
		    selectElement.addEventListener("change", updateVisibility);
		});

	</script>
</body>
</html>
