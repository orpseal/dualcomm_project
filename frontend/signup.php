<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="css/signup.css">
</head>
<body>
    <form action="signup.php" method="post">
        <?php include('errors.php'); ?>
        <h1>SignUp</h1>

        <input type="text" name="username" placeholder="username" value="<?php echo $username; ?>" required>
        
        <input type="email" name="email" placeholder="Email address"  value="<?php echo $email; ?>" required>

        <input type="password" name="password_1" placeholder="Password" required>
        
        <input type="password" name="password_2" placeholder="Confirm password" required>
        
        <button type="submit" name="signup_user">SignUp</button>
        
        <h5>Already a member? <a href="login.php">Login</a></h5><br>
        
        <a href="index.php">Go back home</a>

    </form>
</body>
</html>

<!-- <input type="text" name="firstname" placeholder="First name" required> -->
        <!-- <input type="text" name="lastname" placeholder="Last name" required> -->