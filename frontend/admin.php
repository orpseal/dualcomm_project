<?php 
 include('server.php'); 


 // update
if (isset($_POST['update'])) {
	$id = $_POST['id'];
	$name = $_POST['name'];
    $category = $n['category'];
    $series = $n['series'];

	mysqli_query($db, "UPDATE products SET name='$name', category='$category', series='$series' WHERE id=$id");
	$_SESSION['message'] = "Address updated!"; 
	header('location: admin.php');
}

// edit
if (isset($_GET['edit'])) {

  $id = $_GET['edit'];
  $update = true;
  $record = mysqli_query($db, "SELECT * FROM products WHERE id=$id");

//   if (count($record) == 1 ) {
      $n = mysqli_fetch_array($record);
      $name = $n['name'];
      $category = $n['category'];
      $series = $n['series'];
//   }

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" type="text/css" href="./css/adminstyle.css"> 
</head>

<body>
    <?php if (isset($_SESSION['message'])): ?>
    <div class="msg">
        <?php 
    			echo $_SESSION['message']; 
    			unset($_SESSION['message']);
    		?>
    </div>
    <?php endif ?>
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
        </ul>
    </div>

    <div class="container">
        <div class="header">
            <div class="nav">
                <!--
                <div class="search">
                    <input type="text" placeholder="Search..">
                    <button type="submit">Search</button>
                </div>
                -->
                <div class="product">
                    <form method="POST" action="admin.php" id="product-input">
                        <div class="input-group">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="text" name="name" value="" placeholder="Product name" value="<?php echo $name; ?>">
                        </div>
                        <div class="input-group">
                            <input type="text" name="category" value="" placeholder="Category" value="<?php echo $category; ?>">
                        </div>
                        <div class="input-group">
                            <input type="text" name="series" value="" placeholder="Series" value="<?php echo $series; ?>">
                        </div>
                        <div class="input-group">
                            <input type="file" name="product-img" formenctype="multipart/form-data">
                        </div>
                        <div class="input-group">
                            <?php if ($update == true): ?>
	                            <button class="btn" type="submit" name="update" style="background: #556B2F;" >update</button>
                            <?php else: ?>
	                        <button class="btn" type="submit" name="save" >Save</button>
                            <?php endif ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="cards">
            <?php $results = mysqli_query($db, "SELECT * FROM products"); ?>

                <table>
                	<thead>
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
        </div>
    </div>

    <!-- source: https://www.youtube.com/watch?v=gLWIYk0Sd38-->
    <div class="bg-modal">
        <div class="modal-content">
            <div class="close">+</div>
            <h3>Add new product</h3>
            <form action="">
                <input type="text" placeholder="Product name">
                <input type="text" placeholder="Category">
                <input type="text" placeholder="Series">
                <a href="" class="modal-button">Submit</a>
            </form>
        </div>
    </div>
</body>

</html>