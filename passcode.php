<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,800;1,800&family=Hanken+Grotesk:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
	<title>Admin confirmation</title>

	<style>
		
		body {
			margin: 0px;
		    font-family: "Poppins";
		    font-weight: 500;
		    height: 100vh;
		}

		.first-segment {
			padding: 120px 40px 0px 40px;
		}

		.main-container {
			max-width: 760px;
			height: 300px;
			padding: 10px;
			border-radius: 12px;
			border: 4px solid #f36666;
		}

		.main-title {
			margin: 0px;
			font-size: 3.5em;
			font-weight: 500;
		}

		.big-input {
			margin-top: 40px;
			padding: 10px;
			font-family: "Poppins";
			font-size: 3em;
			border-radius: 8px;
			border: 4px solid grey;
			width: 70%;
			text-align: center;
		}

	</style>

</head>
<body>
	<div class="first-segment">
		<center>
			<form method="post" class="main-container">
				<h1 class="main-title">Enter passcode</h1>
				<input type="text" name="passcode" class="big-input"><br>
				<input type="submit" name="submit-passcode" class="">
			</form>
		</center>
	</div>
</body>
</html>