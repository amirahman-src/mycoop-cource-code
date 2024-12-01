<?php
    include 'config.php';

    $usernameTaken = false; // Initialize a flag for username taken
    $error = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signin'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        if ($password == $confirm_password) {
            $findNameQuery = "SELECT username FROM user WHERE username = '$username';";
            $result = mysqli_query($db, $findNameQuery);

            if (mysqli_num_rows($result) > 0) {
            	$error = "The username was taken";
                $usernameTaken = true; // Set the flag if username is taken
            } else {
                $addUserQuery = "INSERT INTO user (username, password) VALUES ('$username', '$password');";
                mysqli_query($db, $addUserQuery);

                $checkUserIdQuery = "SELECT user_id FROM user WHERE username = '$username' AND password = '$password';";
                $result = mysqli_query($db, $checkUserIdQuery);
				$row = mysqli_fetch_assoc($result);
				$user_id = $row['user_id'];
                header("Location:homepageuser.php?user_id=$user_id");
            }
        } else {
        	$usernameTaken = true;
            $error = "Password do not match";
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
	<link rel="stylesheet" href="signin.css">
	<title>myCoop | Sign in</title>

	<style type="text/css">
		body {
		    margin: 0px;
		    font-family: "Poppins";
		    font-weight: 500;
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

		.signin-box {
		    width: 527px;
		    padding: 20px;
		    padding-bottom: 70px;
		    border: 3px solid #f36666;
		    border-radius: 14px;
		    display: flex;
		    align-items: center;
		    flex-direction: column;
		    margin-bottom: 120px;
		}

		.signin-box div {
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

		input[name="signin"] {
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

		input[name="signin"]:hover {
		    background-color: #f25555;
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
		    .signin-box {
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
	</style>

</head>
<body>
	<header class="header">
		<div>
			<a href="index.php"><img src="images/logo.png" class="logo"></a>
		</div>
	</header>
	<div class="center-box">
		<h1 class="title">Let's get you started</h1>
		<div class="signin-box">
			<div>
				<img src="images/logo.png" class="logo">
			</div>
			<h2 class="login-title">Sign in to myCoop</h2>
			<form method="post">
				<table>
					<tr>
						<td class="label-form">Create username</td>
					</tr>
					<tr>
						<td class="input-form"><input type="text" name="username" style="margin-bottom: 15px;" placeholder="Username" required></td>
					</tr>
					<tr>
						<td class="label-form">Create password</td>
					</tr>
					<tr>
						<td class="input-form"><input type="password" name="password" placeholder="Password" required></td>
					</tr>
					<tr>
						<td class="label-form">Confirm password</td>
					</tr>
					<tr>
						<td class="input-form"><input type="password" name="confirm_password" placeholder="Password" required></td>
					</tr>
					<tr>
						<td><input type="submit" name="signin" value="Sign in"></td>
					</tr>
				</table>
			</form>
		</div>
		<div class="dark-bg <?php echo $usernameTaken ? '' : 'hidden'; ?>">
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
	<script>
		window.scrollTo(0, 0);
	    document.querySelector('.x-mark').addEventListener('click', function() {
	        document.querySelector('.dark-bg').classList.add('hidden');
	        document.querySelector('.dark-bg').innerHTML = "<?php $usernameTaken = false; ?>";
	        window.location.href="signin.php";
	    });
	</script>
</body>
</html>