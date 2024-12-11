<?php
	include 'config.php';

	$user_id = $_GET['user_id'];
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | Add product</title>

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

		.add-title {
			margin: 0px 0px 40px 0px;
			font-size: 	3.5em;
		}

		.main-container {
			width: 450px;
			border: 3px solid #f36666;
			padding: 20px 40px 20px 20px;
			border-radius: 12px;
		}

		.main-table {
			width: 100%;
		}

		.input {
			width: 100%;
			padding: 6px;
			font-family: "Poppins";
			border-radius: 6px;
			border: 2px solid grey;
		}

		.input::file-selector-button {
			font-family: "Poppins";
			background-color: transparent;
			border: 2px solid darkgrey;
			border-radius: 4px;
			cursor: pointer;
		}

		.submit-btn {
			width: 100%;
			background-color: transparent;
			border-radius: 6px;
			border: 3px solid #f36666;
			font-family: "Poppins";
			font-weight: 500;
			padding: 5px;
			margin-top: 20px;
			cursor: pointer;
			transition: .2s;
		}

		.submit-btn:hover {
			background-color: #f36666;
			color: white;
		}

	</style>

</head>
<body>
    <header class="header">
        <div>
            <a href="homepageuser.php?user_id=<?php echo $user_id; ?>">
                <img src="images/logo.png" class="logo" alt="Logo">
            </a>
            <section class="menu-bar">
                <dl class="link-dl">
                    <dt><a href="profile.php?user_id=<?php echo $user_id; ?>">My Profile</a></dt>
                    <dt><a href="cart.php?user_id=<?php echo $user_id; ?>">Cart</a></dt>
                </dl>
            </section>
        </div>
    </header>

    <div class="first-segment">
        <h1 class="add-title">Add New Product</h1>
        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="main-container">
                <form action="add_process.php" method="post" enctype="multipart/form-data">
                    <table class="main-table">
                        <tr>
                            <td>Item Image</td>
                            <td>:</td>
                            <td><input type="file" name="item_image" class="input" required></td>
                        </tr>
                        <tr>
                            <td>Item Name</td>
                            <td>:</td>
                            <td><input type="text" name="item_name" class="input" required></td>
                        </tr>
                        <tr>
                            <td>Item Type</td>
                            <td>:</td>
                            <td>
                                <select name="item_type" class="input" required>
                                    <option>Bread</option>
                                    <option>Biscuits</option>
                                    <option>Instant Meal</option>
                                    <option>Sweets</option>
                                    <option>Drinks</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>:</td>
                            <td><input type="number" name="price" class="input" step="0.01" required></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <select name="status" class="input" required>
                                    <option>High stock</option>
                                    <option>Low stock</option>
                                    <option>No stock</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <center>
                                    <button type="submit" class="submit-btn">Add Product</button>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                </form>
            </div>
        </div>
    </div>
</body>
</html>