<?php
include 'config.php';

// Get item_id and user_id from GET request
$item_id = $_GET['item_id'];
$user_id = $_GET['user_id'];

// Fetch existing product data
$productQuery = "SELECT * FROM items WHERE item_id = ?";
$stmt = mysqli_prepare($db, $productQuery);
mysqli_stmt_bind_param($stmt, "i", $item_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    die("Product not found!");
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
    <title>myCoop | Change Product</title>
    <style>
        /* Same styles as add_product.php */
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
        .logo {
            height: 40px;
            width: 127px;
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
        .first-segment {
            padding: 120px 40px 200px 40px;
        }
        h1 {
            font-family: "Poppins";
            font-weight: 500;
        }
        .change-title {
            margin: 0px;
            font-size:  3.5em;
            margin-bottom: 40px;
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
            <a href="homepageadmin.php?user_id=<?php echo $user_id; ?>">
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
        <h1 class="change-title">Change Product</h1>
        <div style="display: flex; justify-content: center; width: 100%;">
            <div class="main-container">
                <form action="change_process.php" method="post" enctype="multipart/form-data">
                    <table class="main-table">
                        <tr>
                            <td>Item Image</td>
                            <td>:</td>
                            <td><input type="file" name="item_image" class="input"></td>
                        </tr>
                        <tr>
                            <td>Item Name</td>
                            <td>:</td>
                            <td><input type="text" name="item_name" class="input" value="<?php echo htmlspecialchars($product['item_name']); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Item Type</td>
                            <td>:</td>
                            <td>
                                <select name="item_type" class="input" required>
                                    <option <?php if ($product['item_type'] == "Bread") echo "selected"; ?>>Bread</option>
                                    <option <?php if ($product['item_type'] == "Biscuits") echo "selected"; ?>>Biscuits</option>
                                    <option <?php if ($product['item_type'] == "Instant Meal") echo "selected"; ?>>Instant Meal</option>
                                    <option <?php if ($product['item_type'] == "Sweets") echo "selected"; ?>>Sweets</option>
                                    <option <?php if ($product['item_type'] == "Drinks") echo "selected"; ?>>Drinks</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Price</td>
                            <td>:</td>
                            <td><input type="number" name="price" class="input" step="0.01" value="<?php echo htmlspecialchars($product['price']); ?>" required></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <td>:</td>
                            <td>
                                <select name="status" class="input" required>
                                    <option <?php if ($product['status'] == "High stock") echo "selected"; ?>>High stock</option>
                                    <option <?php if ($product['status'] == "Low stock") echo "selected"; ?>>Low stock</option>
                                    <option <?php if ($product['status'] == "No stock") echo "selected"; ?>>No stock</option>
                                </select>
                                <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="3">
                                <center>
                                    <button type="submit" class="submit-btn">Update Product</button>
                                </center>
                            </td>
                        </tr>
                    </table>
                    <input type="hidden" name="item_id" value="<?php echo $item_id; ?>">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
