<?php include('server.php');  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="./css/signin.css">
</head>

<body>
    <h1>Contact Sales</h1>
    <p>Are you ready to get started building with one of our solutions? Are you interested in becoming a partner or
        conducting business with Dualcomm? If so, submit your response and our sales team will be in touch with you
        shortly.</p>
    <form action="order.php" method="post">
        <?php 
        	if(isset($_SESSION['success'])) : ?>
        	<h3> 
        	<?php
        			echo $_SESSION['success'];
        			unset($_SESSION['success']);
            
        		?>
        	</h3>
        <?php endif ?>
        <input type="text" name="FirstName" placeholder="First name" required>
        <input type="text" name="LastName" placeholder="Last name" required>
        <input type="email" name="email" placeholder="Work Email address" required>
        <input type="text" name="company" placeholder="Company name" required>
        <input type="text" name="website" placeholder="Company website" required>
        <input type="text" name="Job_title" placeholder="Job Title" required>
        <!--make it a dropdown with several countries, doesnt have to be all-->
        <div class="selections">
            <div class="select">
                <select type="text" name="location" required>
                    <option value="">Select Country</option>
                    <option value="ghana">Ghana</option>
                    <option value="nigeria">Nigeria</option>
                    <option value="southafrica">SouthAfrica</option>
                    <option value="kenya">Kenya</option>
                </select>
            </div>
            <div class="select" id="product-select">
                <select type="text" name="productname" id="store-product" style="padding:5px;" required>
                    <option value="">Select Product</option>
                    <?php $result = mysqli_query($db, "SELECT * FROM products"); ?>
                    <?php while ($row = mysqli_fetch_array($result)) { ?>
                    <option value="<?php echo $row['name']; ?>">
                        <?php echo $row['name']; ?>
                    </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <input type="number" name="volume" placeholder="Estimated volume:" required>
        <input type="text" name="info" placeholder="Additional information:" required>
        <button type="submit" name="place_order">Submit</button><br>
    </form>
    <a href="products.php">Go back to products</a>
</body>

</html>