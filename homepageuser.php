<?php
	include 'config.php';

	$user_id = $_GET['user_id'] or header("Location:index.php");

	$getNameQuery = "SELECT username FROM user WHERE user_id = '$user_id';";
	$result = mysqli_query($db, $getNameQuery);
	$row = mysqli_fetch_assoc($result);
	$username = $row['username'];

	$coopStatus = "";
	$expected = "Open";
	$getCoopStatusQuery = "SELECT * FROM status WHERE status = 1";
	$result = mysqli_query($db, $getCoopStatusQuery);

	if (mysqli_num_rows($result) > 0) {
		$coopStatus = "Open";
	} else {
		$coopStatus = "Closed";
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>myCoop | Home</title>

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
		}

		.hello-user {
			margin: 0px;
			font-size: 3.5em;
		}

		.status-section {
			display: grid;
			grid-template-columns: 1fr 1fr;
		}

		.coop-status {
			padding: 20px 30px 20px 30px;
			border: 3px solid #f36666;
			border-radius: 14px 0px 0px 14px;
		}

		.coop-status h1 {margin: 0px}

		.main-status {
			font-size: 5em;
			margin: 0px;
		}

		.desc {
			background-color: #f36666;
			border-radius: 0px 14px 14px 0px;
			padding: 20px 30px 20px 30px;
		}

		.desc h1 {
			margin: 0px;
			font-weight: 300;
			color: white;
		}

		.open {color: #3CB371;}
		
		.close {color: #F36666;}

		.cat-tab {
			margin-top: 30px;
			table-layout: fixed;
			width: 100%;
			border-radius: 14px;
			border: 3px solid #f36666;
		    display: table;
		    border-collapse: collapse;
		    padding: 0px;
		    height: 40px;
		}

		.tab-btn {
			display: table-cell;
		    text-align: center;
		    vertical-align: middle;
		    border: 3px solid #f36666;
		    transition: 0.2s;
		    cursor: pointer;
		}

		.tab-btn:hover {
			background-color: #f36666;
			color: white;
			font-size: 1.3em;
		}

		.second-segment {
			padding: 10px 40px 10px 40px;
		}

		.category-title {
			margin-left: 20px;
			margin-bottom: 5px;
		}

		.product-list-section {
			width: 100%;
			display: grid;
			grid-template-columns: 1fr 1fr 1fr 1fr;
    		transition: opacity 0.3s ease;
		}


		.product-card {
		    background-color: transparent;
		    border: 3px solid grey;
		    border-radius: 14px;
		    padding: 10px;
		    margin: 6px;
		}

		.product-card img {
		    width: 100%;
		    aspect-ratio: 1 / 1;
		}

		.item_info {
			width: 100%;
		}

		.item-price {
			text-align: left;
		}

		.item-status {
			display: block;
			margin-bottom: 10px;
		}

		.buy-btn {
			width: 100%;
			height: 40px;
			border-radius: 8px;
			text-decoration: none;
			color: black;
			padding: 0px 10px 0px 10px;
			border: 3px solid #f36666;
			background-color: transparent;
			font-family: "Poppins";
			font-weight: 600;
			cursor: pointer;
			transition: .2s;
		}

		.buy-btn:hover {
			background-color: #f36666;
			color: white;
			padding: 0px 20px 0px 20px;
		}

		.red {color: red;}

		.yellow {color: orange;}

		.green {color: green;}

		@media only screen and (max-width: 1043px) {
			.product-list-section {
				grid-template-columns: 1fr 1fr 1fr;
			}

			.hello-user {
				font-size: 50px;
			}
		}

		@media only screen and (max-width: 810px) {
			.product-list-section {
				grid-template-columns: 1fr 1fr;
			}

			.hello-user {
				font-size: 40px;
			}

			.status-section {
				grid-template-columns: 1fr;
			}

			.coop-status {
				border-radius: 14px 14px 0px 0px;
			}

			.desc {
				border-radius: 0px 0px 14px 14px;
			}

			.first-segment {
				padding-left: 20px;
				padding-right: 20px;
			}

			.second-segment {
				padding-left: 20px;
				padding-right: 20px;
			}
		}

		@media only screen and (max-width: 560px) {
			.hello-user {
				font-size: 30px;
				margin-left: 20px;
			}

			.status-section {
				font-size: smaller;
			}

			.first-segment {
				padding-left: 0px;
				padding-right: 0px;
			}

			.coop-status,
			.desc {
				border-radius: 0px;
				border: 0px;
				border-top: 3px solid #f36666;
			}

			.second-segment {
				padding-left: 10px;
				padding-right: 10px;
			}
		}

		@media only screen and (max-width: 415px) {
			.hello-user {
				font-size: 25px;
			}

			.status-section {
				font-size: x-small;
			}
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
		<h1 class="hello-user">Hello, <span style="font-weight: 300;"><?php echo "$username"; ?></span></h1>
		<div class="status-section">
			<div class="coop-status">
				<h1>Coop is</h1>
				<h1 class="main-status <?php echo $coopStatus === 'Open' ? 'open' : 'close'; ?>">
					<?php echo $coopStatus; ?>
				</h1>
			</div>
			<div class="desc">
				<h1>
					<?php
						if ($coopStatus == "Open") {
							echo "Your coop is open! Plan your shopping and purchase your needs!";
						} else {
							echo "Uh oh! Coop is close now... But you still can plan your shopping first!";
						}
					?>
				</h1>
			</div>
		</div>
		<ul class="cat-tab">
		    <li class="tab-btn" data-category="All">
		        All
		    </li>
		    <li class="tab-btn" data-category="Bread">
		        Bread
		    </li>
		    <li class="tab-btn" data-category="Biscuits">
		        Biscuits
		    </li>
		    <li class="tab-btn" data-category="Instant Meal">
		        Instant Meal
		    </li>
		    <li class="tab-btn" data-category="Sweets">
		        Sweets
		    </li>
		    <li class="tab-btn" data-category="Drinks">
		        Drinks
		    </li>
		</ul>
	</div>
	</div>
	<div class="second-segment">
	    <h1 class="category-title">All</h1>
	    <section class="product-list-section">
	        <?php
	            $user_id = $_GET['user_id'] ?? null; // Retrieve user_id from the URL
	            if ($user_id) {
	                include 'display_product_all.php'; // Include the product list
	            } else {
	                echo "<p>User ID is missing!</p>";
	            }
	        ?>
	    </section>
	</div>


	<?php echo "<a href='statistic.php?user_id={$user_id}'>Statistic</a>"; ?>

	<script>
	    // Extract user_id from the URL query parameters
	    const params = new URLSearchParams(window.location.search);
	    const user_id = params.get('user_id'); // Get the user_id from the URL

	    if (!user_id) {
	        console.error("User ID is missing!");
	    } else {
	        // Add event listeners to each category button
	        document.querySelectorAll('.tab-btn').forEach(button => {
	            button.addEventListener('click', () => {
	                const category = button.getAttribute('data-category');
	                document.querySelector('.category-title').innerHTML = category;

	                // Fetch products via AJAX, including user_id in the query
	                fetch(`display_product_category.php?category=${category}&user_id=${user_id}`)
	                    .then(response => response.text())
	                    .then(html => {
	                        // Replace the product list with the fetched content
	                        document.querySelector('.product-list-section').innerHTML = html;
	                    })
	                    .catch(error => {
	                        console.error('Error fetching products:', error);
	                    });
	            });
	        });
	    }
	</script>


</body>
</html>