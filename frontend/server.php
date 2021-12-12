<?php

session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database ('') -- is meant to be the passowrd securing the dbms , dualcom the name of the websites database
$db = mysqli_connect('localhost', 'root', '', 'dualcom');

// User Registration
if (isset($_POST['signup_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation
  // error is push to $errors array
  if (empty($username)) { array_push($errors, "Username is required"); } //empty checks if variable is empty
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure a user does not already exist with the same username / email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { //check if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  
  if (count($errors) == 0) {// if no errors then signup push input data to database
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, pwd) 
  			  VALUES('$username', '$email', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: products.php');
  }
}


// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  //  validation for login inputs
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {// checks if no errors
  	$password = md5($password); // this encrypts the password (in the sqldb you wont be able to see user's password)
  	$query = "SELECT * FROM users WHERE username='$username' AND pwd='$password'"; // this query the user with the exact username and password
  	$results = mysqli_query($db, $query); 

  	if (mysqli_num_rows($results) == 1) {
      // onsuccess user is relocated to products.php
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: products.php');

  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}



// order product
if (isset($_POST['place_order'])) {
  $FirtName = mysqli_real_escape_string($db, $_POST['FirstName']);
  $LastName = mysqli_real_escape_string($db, $_POST['LastName']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $company = mysqli_real_escape_string($db, $_POST['company']);
  $website = mysqli_real_escape_string($db, $_POST['website']);
  $Job_title = mysqli_real_escape_string($db, $_POST['Job_title']);
  $location = mysqli_real_escape_string($db, $_POST['location']);
  $volume = mysqli_real_escape_string($db, $_POST['volume']);
  $productname = mysqli_real_escape_string($db, $_POST['productname']);
  $info = mysqli_real_escape_string($db, $_POST['info']);

  mysqli_query($db, "INSERT INTO orders (FirstName, LastName, email, CompanyName, CompanyWebsite, JobTitle, country, Estimated_Volume,Additional_Information,ProductTitle) VALUES ('$FirstName', '$LastName', '$email','$company','$website','$Job_title','$location','$volume','$info','$productname')"); 
  $_SESSION['message'] = "Products Saved"; 
  header('location: order.php');

}

// crud
// initialize variables
$name = "";
$category = "";
$series = "";
$update = false;

// add to products
if (isset($_POST['save'])) {
  $name = $_POST['name'];
  $category = $_POST['category'];
  $series = $_POST['series'];
  $productImg = $_POST['product-img'];
  mysqli_query($db, "INSERT INTO products (name, category, series,productImg) VALUES ('$name', '$category', '$series','$productImg')"); 
  $_SESSION['message'] = "Products Saved"; 
  header('location: admin.php');
}

// delete product
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM products WHERE id=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: admin.php');
}

// delete order
if (isset($_GET['del'])) {
	$id = $_GET['del'];
	mysqli_query($db, "DELETE FROM orders WHERE id=$id");
	$_SESSION['message'] = "Address deleted!"; 
	header('location: admin.php');
}

// add admin
if (isset($_POST[''])) {
  $username = mysqli_real_escape_string($db, $_POST['admin_name']);
  $password = mysqli_real_escape_string($db, $_POST['admin_password']);
  $role = mysqli_real_escape_string($db, $_POST['userrole']);

  //  validation for login inputs
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {// checks if no errors
  	$password = md5($password); // this encrypts the password (in the sqldb you wont be able to see user's password)
  	$query = "SELECT * FROM users WHERE username='$username' AND pwd='$password' AND user_role='$role' "; // this query the user with the exact username and password
  	$results = mysqli_query($db, $query); 

  	if (mysqli_num_rows($results) == 1) {
      // onsuccess user is relocated to products.php
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: admin.php');

  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

// add admin
if (isset($_POST['add-admin'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['admin_name']);
  $password = mysqli_real_escape_string($db, $_POST['admin_password']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $role = mysqli_real_escape_string($db, $_POST['userrole']);
  
  // form validation
  // error is push to $errors array
  if (empty($username)) { array_push($errors, "Username is required"); } //empty checks if variable is empty
  if (empty($password)) { array_push($errors, "Password is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }

  // first check the database to make sure a user does not already exist with the same username / email
  $admin_check_query = "SELECT * FROM users WHERE username='$username' OR user_role='$role' LIMIT 1";
  $result = mysqli_query($db, $admin_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { //check if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  
  if (count($errors) == 0) {// if no errors then signup push input data to database
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, pwd, email, user_role) 
  			  VALUES('$username', '$password','$email', '$role')";
  	mysqli_query($db, $query);

  	$_SESSION['admin'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: admin.php');
  }
}

// Login Admin
if (isset($_POST['login_admin'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);
  $email = mysqli_real_escape_string($db, $_POST['email']);

  //  validation for login inputs
  if (empty($username)) {
  	array_push($errors, "Username is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }
  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (count($errors) == 0) {// checks if no errors
  	$password = md5($password); // this encrypts the password (in the sqldb you wont be able to see user's password)
  	$query = "SELECT * FROM users WHERE username='$username' AND pwd='$password' AND user_role='admin'"; // this query the user with the exact username and password
  	$results = mysqli_query($db, $query); 

  	if (mysqli_num_rows($results) == 1) {
      // onsuccess user is relocated to products.php
  	  $_SESSION['admin'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: admin.php');

  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}

?>
