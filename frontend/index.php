<?php include('server.php'); ?> 
<!DOCTYPE html>
<html>

<head>
	<title>Dualcomm</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
	
	<div class="header">
			<div class="logo">
				<img src="images/Logo.png">
			</div>
			<ul>
				<li class="active"><a href="#">HOME</a></li>
				<li><a href="products.php">PRODUCTS</a></li>
				<li><a href="signup.php">SIGN UP</a></li>
				<li><a href="login.php">LOGIN</a></li>
				<?php if (isset($_SESSION['username'])) : ?>		
    				<h3 class="user-msg">
					<strong>
        				<?php echo $_SESSION['username']; ?>
    					</strong>
	    			</h3>
   		 		<li><a href="products.php?logout='1'" style="color: red;">Logout</a></li>
					<!-- this will logout the user -->
    			<?php endif ?>
			</ul>
	</div>

	<div class="main-content">
		<!-- Homepage marketing message-->
		<div class="title">
			<h1>DUALCOMM</h1>
		</div>
		<div class="marketing-message">
			<h5>Join Dualcomm, and browse our products for exclusives and exciting semi-conductor chips with lots of
				features</h5>
		</div>

		<div class="button">
			<a href="products.php" class="btn">BROWSE PRODUCTS</a>
		</div>

	</div>

	<!--Footer-->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="footer-col">
					<h4>Company</h4>
					<p><a href="#">contact sales</a></p><br>
					<p><a href="#">terms of use</a></p>
				</div>
				<div class="footer-col">
					<h4>Follow Us</h4>
					<div class="social-links">
						<a href="#"><i class="fab fa-facebook-f"></i></a>
						<a href="#"><i class="fab fa-twitter"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
						<a href="#"><i class="fab fa-linkedin-in"></i></a>
					</div>
				</div>
				<div class="footer-message">
					<p>©2021 Dualcomm Technologies, Inc. and/or its affiliated companies.

						References to "Dualcomm" may mean Dualcomm Incorporated, or subsidiaries or business units
						within the Dualcomm corporate structure, as applicable.

						Dualcomm Incorporated includes Dualcomm's licensing business, QTL, and the vast majority of its
						patent portfolio. Dualcomm products referenced on this page are products of Dualcomm
						Technologies, Inc. and/or its subsidiaries.

						Materials that are as of a specific date, including but not limited to press releases,
						presentations, blog posts and webcasts, may have been superseded by subsequent events or
						disclosures.
					</p>
				</div>
			</div>
		</div>

	</footer>

<!-- if the user logs in print information -->

</body>
</html>