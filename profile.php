<?php
	include 'config.php';

	$user_id = $_GET['user_id'];
	$getNameQuery = "SELECT username FROM user WHERE user_id = '$user_id';";
	$result = mysqli_query($db, $getNameQuery);
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | <?php echo htmlspecialchars($username) . "'s profile" ?></title>

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
		    width: 100%;
		    display: flex;
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

		.profile-title {
			margin: 0px;
			font-size: 	3.5em;
		}

		.main-table {
			font-size: 1.7em;
			table-layout: fixed;
		}

		.main-table td {
			padding: 0px 10px 0px 10px;
		}

		.secondary-btn {
			margin-top: 40px;
			border: 3px solid grey;
			border-radius: 8px;
			padding: 5px;
			font-family: "Poppins";
			font-weight: 500;
			cursor: pointer;
			background-color: transparent;
			transition: .2s;
		}

		.secondary-btn:hover {
			color: white;
			background-color: grey;
		}

		.temp-label {
			font-size: 24px;
		}

		.input-text {
			border: 3px solid grey;
			border-radius: 6px;
			padding: 5px;
			font-family: "Poppins";
			font-weight: 500;
		}

		.input-submit {
			border: 3px solid #f36666;
			border-radius: 6px;
			padding: 5px;
			font-family: "Poppins";
			font-weight: 500;
			background-color: transparent;
			cursor: pointer;
			transition: .2s;
		}

		.input-submit:hover {
			background-color: #f36666;
			color: white;
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
		}

		.sub-table th,
		.sub-table td {
			text-align: left;
			border-bottom: 1px solid lightgrey;
		}

		.product-image {
			height: 180px;
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
        <h1 class="profile-title">Your profile</h1>
        <table class="main-table">
            <tr>
                <td>Username</td>
                <td>:</td>
                <td><?php echo $username; ?></td>
            </tr>
            <tr>
                <td>User ID</td>
                <td>:</td>
                <td><?php echo $user_id; ?></td>
            </tr>
            <tr>
                <td colspan="3">
                    <form action="check_passcode.php" method="post" class="passcode-form">
                        <button type="button" onclick="showPasscodeForm()" class="secondary-btn passcode-form-access-btn">Access Admin Panel</button><br>
                        <div class="passcode-input-form hidden">
                            <label class="temp-label">Enter passcode:</label><br>
                            <input type="password" name="passcode" class="input-text">
                            <input type="submit" name="access-admin" class="input-submit">
                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                        </div>
                    </form>
                </td>
            </tr>
            <tr>
                <td colspan="3">
                    <a href="index.php"><button class="input-submit button">Log out</button></a>
                </td>
            </tr>
        </table>
        <h1 class="profile-title" style="margin-top: 30px;">Purchase history</h1>
        <table class="second-table" border="1">
            <?php
                $getOrdersQuery = "SELECT * FROM orders WHERE user_id = '$user_id' ORDER BY order_id DESC;";
                $result = mysqli_query($db, $getOrdersQuery);

                while ($row = mysqli_fetch_assoc($result)) {
                    $order_id = $row['order_id'];
                    $date = $row['datee'];

                    echo "<tr class='main-tr' onclick='toggler($order_id)'>
                        <td class='row'>
                            <p>Order ID : ".htmlspecialchars($order_id)."</p>
                            <p>".htmlspecialchars($date)."</p>
                        </td>
                    </tr>
                    <tr>
                        <td class='sub-table-holder hidden' id='sub-table-$order_id'>
                            <table class='sub-table'>
                                <tr>
                                    <th>Item Image</th>
                                    <th>Item Name</th>
                                    <th>Amount</th>
                                    <th>Subtotal</th>
                                </tr>";

                    $getOrderDetailQuery = "SELECT * FROM order_detail WHERE order_id = '$order_id';";
                    $subresult = mysqli_query($db, $getOrderDetailQuery);

                    while ($subrow = mysqli_fetch_assoc($subresult)) {
                        $item_id = $subrow['item_id'];
                        $getItemDetailQuery = "SELECT price, item_name FROM items WHERE item_id = '$item_id'";
                        $priceRes = mysqli_query($db, $getItemDetailQuery);
                        $priceRow = mysqli_fetch_assoc($priceRes);
                        $price = $priceRow['price'];
                        $item_name = $priceRow['item_name'];

                        echo "<tr>
                            <td><img src='get_image.php?item_id=$item_id' class='product-image'></td>
                            <td>".htmlspecialchars($item_name)."</td>
                            <td>".htmlspecialchars($subrow['amount'])."</td>
                            <td>RM ".htmlspecialchars($subrow['amount'] * $price)."</td>
                        </tr>";
                    }

                    echo "</table>
                        </td>
                    </tr>";
                }
            ?>
        </table>
    </div>
    <script>
        const passcode_btn = document.querySelector(".passcode-form-access-btn"); // Access button
        const passcode_input_form = document.querySelector(".passcode-input-form"); // Input form
        let show = false;

        function showPasscodeForm() {
            if (!show) {
                passcode_input_form.classList.remove("hidden");
                show = !show;
            } else {
                passcode_input_form.classList.add("hidden");
                show = !show;
            }
        }

        // Manage order detail toggle
        let currentOpen = null;

        function toggler(order_id) {
            const subTable = document.getElementById(`sub-table-${order_id}`);

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
