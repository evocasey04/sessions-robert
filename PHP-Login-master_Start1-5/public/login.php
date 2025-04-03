<?php
require_once('config.php'); 
session_start();

if(isset($_POST['Submit'])) {
    if( ($_POST['Username'] == $Username) && ($_POST['Password'] == $Password) ) {
        $_SESSION['Username'] = $Username;
        $_SESSION['Active'] = true;
        header("location:index.php");
        exit;
    } else {
        $error = 'Incorrect Username or Password';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="../css/signin.css">
</head>
<body>
    <div class="form-container">
        <h2>Login</h2>
        <form method="post" action="">
            <label for="Username">Username:</label><br>
            <input type="text" name="Username" required><br><br>
            <label for="Password">Password:</label><br>
            <input type="password" name="Password" required><br><br>
            <button type="submit" name="Submit">Sign in</button>
        </form>
        <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
    </div>
</body>
</html>

