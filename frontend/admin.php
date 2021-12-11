<?php 
 include('server.php'); 

 if (!isset($_SESSION['admin'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: adminlogin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['admin']);
    header("location: adminlogin.php");
}


// edit
if (isset($_GET['edit'])) {

  $id = $_GET['edit'];
  $update = true;
  $record = mysqli_query($db, "SELECT * FROM products WHERE id=$id");

      $n = mysqli_fetch_array($record);
      $name = $n['name'];
      $category = $n['category'];
      $series = $n['series'];

}

 // update
 if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
    $category = $_POST['category'];
    $series = $_POST['series'];

	mysqli_query($db, "UPDATE products SET name='$name', category='$category', series='$series' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" typ="text/css" href="Semantic-UI-CSS-master/semantic.min.css">
    <link rel="stylesheet" type="text/css" href="./css/adminstyle.css"> 
</head>

<body>
    
    <!-- source: https://www.youtube.com/watch?v=kAt27KFNZNY-->
    <div class="side-menu">
        <div class="brand-name">
            <h1>Dualcomm</h1>
        </div>
        <ul>
            <li><span>Dashboard</span></li>
            <li><span>Admins</span></li>
            <li><span>Orders</span></li>
            <li><span>Settings</span></li>
            <?php if (isset($_SESSION['admin'])) : ?>
            <li class="user-msg">
                <strong>
                    <?php echo $_SESSION['admin']; ?>
                </strong>
            </li>
            <li><a href="adminlogin.php?logout='1'" style="color: red;">Logout</a></li><!-- this logout the admin -->
            <?php endif ?>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="product">
                    <form method="POST" action="admin.php" id="product-input">
                        <div class="ui input input-group">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Product name" >
                        </div>
                        <div class="ui input input-group">
                            <input type="text" name="category" value="<?php echo $category; ?>" placeholder="Category" >
                        </div>
                        <div class="ui input input-group">
                            <input type="text" name="series" value="<?php echo $series; ?>" placeholder="Series" >
                        </div>
                        <div class="ui input input-group">
                            <input type="file" name="product-img" formenctype="multipart/form-data">
                        </div>
                        <div class="ui input input-group">
                            <?php if ($update == true): ?>
	                            <button class="ui button" type="submit" name="update">update</button>
                            <?php else: ?>
	                        <button class="ui button" type="submit" name="save" >Save</button>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="ui two column centered grid">

            <div class="four wide cards">
            <?php $results = mysqli_query($db, "SELECT * FROM products"); ?>

                <table class="ui table">
                	<thead>
                        <tr>
                            <th>Products</th>
                        </tr>
                		<tr>
                			<th>#</th>
                			<th>Name</th>
                			<th>Category</th>
                			<th>Series</th>
                			<th colspan="2">Action</th>
                		</tr>
                	</thead>

                	<?php while ($row = mysqli_fetch_array($results)) { ?>
                		<tr>
                            <td><?php echo $row['id']; ?></td>
                			<td><?php echo $row['name']; ?></td>
                			<td><?php echo $row['category']; ?></td>
                			<td><?php echo $row['series']; ?></td>
                			<td>
                				<a href="admin.php?edit=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                			</td>
                			<td>
                				<a href="admin.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                			</td>
                		</tr>
                	<?php } ?>
                </table>
                
            </div>
            <!-- orders -->
            <div class="four wide cards">
            <?php $results = mysqli_query($db, "SELECT * FROM orders"); ?>

                <table class="ui table">
                	<thead>
                        <tr>
                            <th>Orders</th>
                        </tr>
                		<tr>
                			<th>#</th>
                			<th>Product</th>
                			<th>Name</th>
                			<th>Email</th>
                			<th>Company</th>
                			<th>Country</th>
                			<th>Volume</th>
                			<th>Comment</th>
                			<th colspan="2">Action</th>
                		</tr>
                	</thead>

                	<?php while ($row = mysqli_fetch_array($results)) { ?>
                		<tr>
                            <td><?php echo $row['id']; ?></td>
                			<td><?php echo $row['ProductTitle']; ?></td>
                			<td><?php echo $row['FirstName']; ?></td>
                			<td><?php echo $row['LastName']; ?></td>
                			<td><?php echo $row['CompanyName']; ?></td>
                			<td><?php echo $row['country']; ?></td>
                			<td><?php echo $row['Estimated_Volume']; ?></td>
                			<td><?php echo $row['Additional_Information']; ?></td>
                			<td>
                				<a href="admin.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
                			</td>
                		</tr>
                	<?php } ?>
                </table>

            </div>
            <div class="admin_form">
                <form class="ui form" method="POST" action="admin.php">
                        <div class="ui input">
                            <input type="hidden" name="userrole" value="admin">
                        </div>
                        <div class="ui input">
                            <input type="text" name="admin_name" placeholder="UserName" required>
                        </div>
                        <div class="ui field input">
                            <input type="password" name="admin_password" placeholder="Password" required>
                        </div>
                        <div class="ui input">
                            <input type="text" name="email" placeholder="Email" required>
                        </div>
                        <button class="ui button" type="submit" name="add-admin">Add Admin</button>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>