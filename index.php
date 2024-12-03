<?php
	include 'config.php';

	$wrongInfo = false;
	$error = "";

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];

		if (empty($username) || empty($password)) {
			// Error
		} else {
			$checkUserQuery = "SELECT * FROM user WHERE username = '$username' AND password = '$password';";
			$result = mysqli_query($db, $checkUserQuery);

			if (mysqli_num_rows($result) > 0) {
				$checkUserIdQuery = "SELECT user_id FROM user WHERE username = '$username' AND password = '$password';";
				$row = mysqli_fetch_assoc($result);
				$user_id = $row['user_id'];

				header("Location:homepageuser.php?user_id=$user_id");
				exit();
			} else {
				$error = "Wrong username or password";
				$wrongInfo = true;
			}
		}
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
	<title>myCoop | Log in</title>

	<style type="text/css">
		body {
		    margin: 0px;
		    font-family: "Poppins";
		    font-weight: 500;
		    background: url('images/bg3.png');
		    background-repeat: no-repeat;
		    background-attachment: fixed;
		    background-size: cover;
		    background-position: left;
		    height: 100vh;
		}

		.header {
		    background-color: #f36666;
		    height: 58px;
		    width: 100%;
		    border-radius: 0 0 14px 14px;
		    position: fixed;
		}

		.header div {
		    display: flex;
		    width: 100%;
		    height: 100%;
		    justify-content: center;
		    align-items: center;
		}

		.logo {
		    height: 40px;
		    width: 127px;
		}

		.center-box {
		    width: 100%;
		    display: flex;
		    align-items: center;
		    flex-direction: column;
		}

		.login-box {
		    width: 527px;
		    height: 477px;
		    padding: 20px;
		    border: 3px solid #f36666;
		    border-radius: 14px;
		    display: flex;
		    align-items: center;
		    flex-direction: column;
		    background-color: white;
		}

		.login-box div {
		    width: 100%;
		    display: flex;
		    align-items: flex-start;
		}

		.title {
		    margin: 100px 0 50px 0;
		    font-weight: 500;
		    font-size: 58px;
		    text-align: center;
		}

		.login-title {
		    font-size: 44px;
		    font-weight: 400;
		    text-align: center;
		}

		table {
		    width: 90%;
		}

		.label-form {
		    font-size: 18px;
		}

		.input-form input {
		    width: 368px;
		    height: 40px;
		    border-radius: 10px;
		    border: 3px solid #f36666;
		    background-color: transparent;
		    font-family: "Poppins";
		    font-weight: 500;
		    padding-left: 10px;
		    font-size: 18px;
		}

		input[name="login"] {
		    margin-top: 8px;
		    width: 100%;
		    height: 46px;
		    border-radius: 10px;
		    border: none;
		    background-color: #f36666;
		    color: white;
		    font-family: "Poppins";
		    font-weight: 500;
		    font-size: 18px;
		    cursor: pointer;
		    transition: 0.2s;
		}

		input[name="login"]:hover {
		    background-color: #f25555;
		}

		.no-account {
		    margin-bottom: 5px;
		}

		.create-acc {
		    width: 340px;
		    height: 65px;
		    display: flex;
		    justify-content: center;
		    align-items: center;
		    border-radius: 10px;
		    border: 3px solid #f36666;
		    font-size: 21px;
		    color: #f36666;
		    text-decoration: none;
		    cursor: pointer;
		    transition: 0.2s;
		}

		.create-acc:hover {
		    background-color: #f36666;
		    color: white;
		}

		.about {
		    margin-bottom: 20px;
		}

		.text {
		    width: 70%;
		}

		.dark-bg {
			background-color: rgba(0, 0, 0, 0.3);	
			width: 100vw;
			height: 100vh;
			position: fixed;
			display: flex;
			justify-content: center;
			align-items: center;
		}

		.hidden {
			display: none;
		}

		.error-box {
			background-color: white;
			padding: 20px;
			width: 300px;
			height: 150px;
			display: flex;
			justify-content: start;
			flex-direction: column;
			align-items: center;
		}

		.x-mark {cursor: pointer;}

		.upper {
			display: flex;
			justify-content: end;
			width: 100%;
		}

		.lower {
			display: flex;
			justify-content: center;
			align-items: center;
			width: 100%;
			height: 100%;
		}

		.error-box p {margin: 0px;}


		@media only screen and (max-width: 720px) {
		    .login-box {
		        width: 100%;
		        border: none;
		        border-top: 3px solid #f36666;
		        border-bottom: 3px solid #f36666;
		        border-radius: 0px;
		    }

		    .logo {
		        margin: 0px 0px 0px 20px;
		    }
		    .login-title {
		    	font-size: 34px;
		    }
		}

		@media only screen and (max-width: 460px) {
			.input-form input {
				width: 300px;
			}
		}
	</style>

</head>
<body>
	<header class="header">
		<div>
			<a href="index.php"><img src="images/logo.png" class="logo"></a>
		</div>
	</header>
	<div class="center-box">
		<h1 class="title">Welcome to myCoop</h1>
		<div class="login-box">
			<div>
				<img src="images/logo.png" class="logo">
			</div>
			<h2 class="login-title">Log in to myCoop</h2>
			<form method="post">
				<table>
					<tr>
						<td class="label-form">Username</td>
					</tr>
					<tr>
						<td class="input-form"><input type="text" name="username" style="margin-bottom: 15px;" placeholder="Username" required></td>
					</tr>
					<tr>
						<td class="label-form">Password</td>
					</tr>
					<tr>
						<td class="input-form"><input type="password" name="password" placeholder="Password" required></td>
					</tr>
					<tr>
						<td><input type="submit" name="login" value="Log in"></td>
					</tr>
				</table>
			</form>
		</div>
		<h1 class="title no-account">No account? Create one!</h1>
		<a href="signin.php" class="create-acc">Create</a>
		<h1 class="title about">About myCoop</h1>
		<p class="text">
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
			<br><br>
			Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
			quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
			consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
			cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
			proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
		</p>
		<div class="dark-bg <?php echo $wrongInfo ? '' : 'hidden'; ?>">
			<div class="error-box">
				<div class="upper">
					<span class="x-mark">&#x2715;</span>
				</div>
				<div class="lower">
					<p><?php echo "$error"; ?></p>
				</div>
			</div>
		</div>
	</div>
	<span></span>
	<script>
		window.scrollTo(0, 0);
	    document.querySelector('.x-mark').addEventListener('click', function() {
	        document.querySelector('.dark-bg').classList.add('hidden');
	        document.querySelector('.dark-bg').innerHTML = "<?php $wrongInfo = false; ?>";
	        window.location.href="index.php";
	    });
	</script>
</body>
</html>