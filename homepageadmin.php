<?php
	include 'config.php';
	$user_id = $_GET['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | Admin's panel</title>

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
			padding: 120px 40px 200px 40px;
		}

		.admin-title {
			margin: 0px;
			font-size: 	3.5em;
		}

		.main-table {
			border-collapse: collapse;
			width: 100%;
			border-top: 1px solid grey;
		}

		th {
			text-align: left;
		}

		.main-table td, .main-table th {
			border-bottom: 1px solid grey;
			padding: 8px 0px 8px 0px;
		}

		.product-image {
			height: 170px;
		}

		.delete-btn {
			background-color: transparent;
			border-radius: 6px;
			border: 3px solid #f36666;
			width: 100%;
			padding: 5px;
			font-size: 14px;
			font-family: "Poppins";
			cursor: pointer;
			transition: .2s;
		}

		.change-btn {
			background-color: transparent;
			border-radius: 6px;
			border: 3px solid grey;
			padding: 5px;
			margin-bottom: 3px;
			font-size: 14px;
			font-family: "Poppins";
			cursor: pointer;
			width: 100%;
			transition: .2s;
		}

		.change-btn:hover {
			background-color: grey;
			color: white;
		}

		.delete-btn:hover {
			background-color: #f36666;
			color: white;
		}

		.status-panel {
			width: 100%;
			display: grid;
			grid-template-columns: 1fr 1fr;
			border: 3px solid #f36666;
			border-radius: 8px;
			margin-bottom: 20px;
		}

		.status-panel .left {
			padding: 8px;
		}

		.status-panel .right {
			border-left: 3px solid #f36666;
			padding: 0px;
		}

		.left {
			display: grid;
			align-items: center;
			grid-template-columns: 1fr 1fr;
			width: 100%;
		}

		.left form {
			display: flex;
			flex-direction: row-reverse;
		}
		

		.status-toggle-btn {
			background-color: transparent;
			font-family: "Poppins";
			border: 2px solid grey;
			margin-right: 20px;
			cursor: pointer;
			transition: .2s;
		}

		.status-toggle-btn:hover {
			background-color: grey;
			color: white;
		}

		.float-right {
			float: right;
		}

		.right {
			display: grid;
			grid-template-columns: 1fr 1fr;
		}

		.right .orders-tab,
		.right .products-tab {
			display: flex;
			align-items: center;
			justify-content: center;
			cursor: pointer;
			transition: .2s;
		}

		.orders-tab:hover,
		.products-tab:hover {
			background-color: #f36666;
			color: white;
		}

		.right .products-tab {
			border-left: 3px solid #f36666;
		}

		.second-table {
			width: 100%;
			font-size: 1.6em;
			border-collapse: collapse;
		}

		.second-table .main-tr {
			cursor: pointer;
			transition: .2s;
		}

		.second-table .main-tr:hover {
			background-color: #e8e8e8;
		}

		.row {
			display: flex;
			justify-content: space-between;
			padding: 0px 20px 0px 20px;
		}

		.sub-table {
			width: 100%;
			font-size: 0.7em;
			border-collapse: collapse;
		}

		.sub-table th,
		.sub-table td {
			text-align: left;
			border-bottom: 1px solid lightgrey;
		}

		.accept-btn {
			font-family: "Poppins";
			padding: 4px;
			border: 2px solid grey;
			margin: 5px 0px 5px 5px;
			cursor: pointer;
			transition: .2s;
		}

		.accept-btn:hover {
			border-radius: 6px;
		}

		.hidden {
			display: none;
		}

	</style>

</head>

<!-- THIS MANAGE WHEN THE OPEN/CLOSE COOP BUTTON WAS CLICKED -->
<?php
include 'config.php';

// Update status if the form is submitted
if (isset($_POST['toggle_status'])) {
    $getCoopStatusQuery = "SELECT status FROM status;";
    $result = mysqli_query($db, $getCoopStatusQuery);
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    $newStatus = $status == 1 ? 0 : 1;
    $updateStatusQuery = "UPDATE status SET status = $newStatus;";
    mysqli_query($db, $updateStatusQuery);
    // Refresh the page to show the updated status
    echo "<script>window.location = 'homepageadmin.php?user_id=$user_id';</script>";
    exit(); // Ensure no further code is run after header redirect
}
?>
<body>
    <!-- Header Section -->
    <header class="header">
        <div>
            <!-- Logo and Homepage Link -->
            <a href="homepageuser.php?user_id=<?php echo $user_id; ?>">
                <img src="images/logo.png" class="logo" alt="Logo">
            </a>

            <!-- Navigation Menu -->
            <section class="menu-bar">
                <dl class="link-dl">
                    <dt><a href="profile.php?user_id=<?php echo $user_id; ?>">My Profile</a></dt>
                    <dt><a href="cart.php?user_id=<?php echo $user_id; ?>">Cart</a></dt>
                </dl>
            </section>
        </div>
    </header>

    <!-- Main Content -->
    <div class="first-segment">
        <!-- Admin Panel Title -->
        <h1 class="admin-title">Admin Panel</h1>

        <!-- Status Panel -->
        <div class="status-panel">
            <?php
            // Fetch Coop Status from Database
            $getCoopStatusQuery = "SELECT status FROM status;";
            $result = mysqli_query($db, $getCoopStatusQuery);
            $row = mysqli_fetch_assoc($result);
            $status = $row['status'];

            // Determine Coop Status Text and Color
            $coopStatus = $status == 1 ? "Open" : "Close";
            $color = $status == 1 ? "green" : "red";
            ?>
            
            <!-- Left Section: Coop Status -->
            <div class="left">
                <div>
                    <span>Coop Status: </span>
                    <span style="color: <?php echo $color; ?>;"><?php echo htmlspecialchars($coopStatus); ?></span>
                </div>

                <!-- Toggle Coop Status Button -->
                <form method="post">
                    <button type="submit" name="toggle_status" class="status-toggle-btn"
                        onclick="return confirm('Are you sure you want to <?php echo $coopStatus == 'Open' ? 'close' : 'open'; ?> the coop?');">
                        <?php echo $coopStatus == 'Open' ? 'Close' : 'Open'; ?>
                    </button>
                </form>
            </div>

            <!-- Right Section: Navigation Tabs -->
            <div class="right">
                <div class="orders-tab">Orders</div>
                <div class="products-tab">Products</div>
            </div>
        </div>

        <!-- Orders Window (Default Visible) -->
        <div class="orders-window">
		    <table class="second-table" border="1">
		        <?php
		        // Fetch Order Queue from Database
		        $getOrderQueueQuery = "SELECT * FROM order_queue ORDER BY order_id DESC;";
		        $result = mysqli_query($db, $getOrderQueueQuery);

		        if (mysqli_num_rows($result) > 0) {
		            while ($row = mysqli_fetch_assoc($result)) {
		                $order_id = $row['order_id'];

		                // Get User ID and Order Type from Orders Table
		                $getUserIdQuery = "SELECT user_id, type FROM orders WHERE order_id = '$order_id';";
		                $userIdResult = mysqli_query($db, $getUserIdQuery);
		                $userIdRow = mysqli_fetch_assoc($userIdResult);
		                $user_id = $userIdRow['user_id'];
		                $order_type = $userIdRow['type']; // Get the order type

		                // Get Username from User Table
		                $getUsernameQuery = "SELECT username FROM user WHERE user_id = '$user_id';";
		                $usernameResult = mysqli_query($db, $getUsernameQuery);
		                $usernameRow = mysqli_fetch_assoc($usernameResult);
		                $username = $usernameRow['username'];

		                // Order Row with Clickable Toggler
		                echo "<tr class='main-tr' onclick='toggler($order_id)'>
		                <td class='row'>Order ID: $order_id | User: " . htmlspecialchars($username) . "</td>
		                </tr>
		                <tr class='sub-table-$order_id hidden'>
		                <td>
		                    <table class='sub-table'>
		                    <tr>
		                        <th>Item Image</th>
		                        <th>Item Name</th>
		                        <th>Amount</th>
		                        <th>Subtotal</th>
		                    </tr>";

		                // Fetch Order Details
		                $getOrderDetailQuery = "SELECT * FROM order_detail WHERE order_id = '$order_id';";
		                $subresult = mysqli_query($db, $getOrderDetailQuery);

		                $totalCost = 0; // Initialize total cost

		                while ($subrow = mysqli_fetch_assoc($subresult)) {
		                    $item_id = $subrow['item_id'];
		                    $subtotal = $subrow['subtotal'];

		                    // Get Item Details
		                    $getItemDetailQuery = "SELECT * FROM items WHERE item_id = '$item_id';";
		                    $priceRes = mysqli_query($db, $getItemDetailQuery);
		                    $priceRow = mysqli_fetch_assoc($priceRes);
		                    $item_name = $priceRow['item_name'];

		                    echo "<tr>
		                    <td><img src='get_image.php?item_id=$item_id' class='product-image'></td>
		                    <td>" . htmlspecialchars($item_name) . "</td>
		                    <td>" . htmlspecialchars($subrow['amount']) . "</td>
		                    <td>RM " . number_format(htmlspecialchars($subtotal), 2) . "</td>
		                    </tr>";

		                    $totalCost += $subtotal; // Add subtotal to total cost
		                }

		                // Calculate total cost
		                $tax = 0.20; // Fixed tax
		                $deliveryCost = $order_type === 'Delivery' ? 1.00 : 0.00; // Delivery cost if applicable
		                $totalCost += $tax + $deliveryCost; // Add tax and delivery cost to total cost

		                $extraChargesText = "<b>Tax: </b>RM 0.20";
		                if ($order_type === 'Delivery') {
		                    $extraChargesText .= ", <b>Delivery cost: </b>RM 1.00";
		                }

		                // Accept Order Button and Total Cost
		                echo "<tr class='sub-table-$order_id'>
		                <td colspan='4' style='display: flex; align-items: center;'>
		                    <form method='post' action='accept_order.php' style='display: inline;'>
		                        <input type='hidden' name='order_id' value='$order_id'>
		                        <button type='submit' class='accept-btn' onclick='return confirm(\"Are you sure you want to accept this order?\");'>Accept</button>
		                    </form>
		                    <label style='margin-left: 10px;'><strong>Total: RM " . number_format($totalCost, 2) . "</strong></label>
		                </td>
		                </tr>
		                </table>
		                </td>
		                </tr>";
		            }
		        } else {
		            echo "<tr><td colspan='4' style='text-align: center;'>You have no orders right now</td></tr>";
		        }
		        ?>
		    </table>
		</div>



        <!-- Products Window (Initially Hidden) -->
        <div class="products-window hidden">
        	<a href="add_product.php"><button class="change-btn">Add new products</button></a>
            <table class="main-table">
                <tr>
                    <th>Item Image</th>
                    <th>Item Name</th>
                    <th>Type</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                <?php
                // Fetch Items from Database
                $getItemsQuery = "SELECT * FROM items;";
                $result = mysqli_query($db, $getItemsQuery);

                while ($row = mysqli_fetch_assoc($result)) {
                    $item_id = $row['item_id'];
                    $item_name = $row['item_name'];
                    $item_type = $row['item_type'];
                    $price = $row['price'];
                    $status = $row['status'];

                    echo "<tr>
                            <td><img src='get_image.php?item_id=$item_id' alt='Product Image' class='product-image'></td>
                            <td>" . htmlspecialchars($item_name) . "</td>
                            <td>" . htmlspecialchars($item_type) . "</td>
                            <td>RM " . number_format(htmlspecialchars($price), 2) . "</td>
                            <td>" . htmlspecialchars($status) . "</td>
                            <td>
                                <a><button class='change-btn'>&#9998; Change</button></a><br>
                                <a href='delete_item_p.php?item_id=$item_id' onclick='return confirm(\"Are you sure?\");'>
                                    <button class='delete-btn'>Delete</button>
                                </a>
                            </td>
                          </tr>";
                }
                ?>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Tab Navigation
        const ordersTab = document.querySelector(".orders-tab");
        const productsTab = document.querySelector(".products-tab");
        const ordersWindow = document.querySelector(".orders-window");
        const productsWindow = document.querySelector(".products-window");

        ordersTab.addEventListener('click', () => {
            ordersWindow.classList.remove('hidden');
            productsWindow.classList.add('hidden');
        });

        productsTab.addEventListener('click', () => {
            productsWindow.classList.remove('hidden');
            ordersWindow.classList.add('hidden');
        });

        // Toggle Sub-Table Visibility
        let currentOpen = null;

        function toggler(order_id) {
            const subTable = document.querySelector(`.sub-table-${order_id}`);
            if (currentOpen && currentOpen !== subTable) {
                currentOpen.classList.add('hidden');
            }
            if (subTable.classList.contains('hidden')) {
                subTable.classList.remove('hidden');
                currentOpen = subTable;
            } else {
                subTable.classList.add('hidden');
                currentOpen = null;
            }
        }
    </script>
</body>
</html>