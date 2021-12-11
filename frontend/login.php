<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" type="text/css" href="./css/signin.css">
</head>
<body>
    <form action="login.php" method="post" class="login-form">
    <?php include('errors.php'); ?>
        <h1>Login</h1>
        <input type="text" name="username" placeholder="Username">
        <input type="text" name="email" placeholder="Email address">
        <input type="password" name="password" placeholder="Password">
        <button type="submit" name="login_user">Login</button>

        <h5>Don't have an account? <a href="signup.php">Signup</a></h5><br>
        <a href="index.php">Go back home</a>
    </form>
    
</body>
</html>