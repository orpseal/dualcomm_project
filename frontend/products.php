<?php
 include('server.php');  


  if (!isset($_SESSION['username'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['username']);
  	header("location: login.php");
  }

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" typ="text/css" href="Semantic-UI-CSS-master/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="./css/product-css.css">
</head>

<body>
    <?php 
		if(isset($_SESSION['success'])) : ?>
    <h3>
        <?php
				echo $_SESSION['success'];
				unset($_SESSION['success']);
				
			?>
    </h3>
    <?php endif ?>
    <div class="header-body">
        <div class="logo">
            <img src="images/Logo.png">
        </div>
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li class="active"><a href="#">PRODUCTS</a></li>
            <li><a href="order.php">SEND AN ORDER REQUEST</a></li>
            <?php if (isset($_SESSION['username'])) : ?>
            <h3 class="user-msg">
                <strong>
                    <?php echo $_SESSION['username']; ?>
                </strong>
            </h3>
            <li><a href="products.php?logout='1'" style="color: red;">Logout</a></li><!-- this logout the user -->
            <?php endif ?>
        </ul>
    </div>
    <div class="ui four cards products-body">
        <?php $result = mysqli_query($db, "SELECT * FROM products"); ?>
        <!-- <div class="ui two cards"> -->

        <?php while ($row = mysqli_fetch_array($result)) { ?>
        <div class="ui card">
            <div class="image"><img src="./images/Logo.png" alt="product-img"></div>
            <div class="content">
                <div class="header">
                    <?php echo $row['name']; ?>
                </div>
                <div class="meta"><span class="date">
                        <?php echo $row['series']; ?>
                    </span></div>
                <div class="extra content"><i aria-hidden="true" class="user icon"></i><a href="./filesfolder/product-brief.pdf" download>Download</a></div>
            </div>
            </div>
            <?php } ?>
            

        </div>
        <div class="products-message">
            <h2>Our processors drive Innovation</h2>
            <br>
            <p>Our powerful and versatile suite of processors are purpose-built to power mobile experiences, AI
                datacenter
                solutions, and the Internet of Things (IoT). Our CPU processors utilize our strong heritage in
                engineering
                to deliver best-in-class security, AI, and connectivity solutions, all designed to enable the next
                generation of high-tech devices and apps.</p>
            <br>
            <br>
            <h2>Explore Processor Categories</h2>
            <p>" ."</p>
        </div>
        <!-- <script src="Semantic-UI-CSS-master/semantic.min.css"></script> -->
</body>

</html>