<?php
require_once('db.php');
session_start();

if(isset($_POST['Submit'])) {
    $inputUser = trim($_POST['Username']);
    $inputPass = trim($_POST['Password']);

    // ✅ SERVER-SIDE VALIDATION
    if (!preg_match('/^[a-zA-Z0-9]{3,}$/', $inputUser)) {
        $error = "Invalid username format. Must be at least 3 alphanumeric characters.";
    } elseif (strlen($inputPass) < 4) {
        $error = "Password must be at least 4 characters.";
    } else {
        // ✅ DATABASE CHECK
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
        $stmt->bind_param("ss", $inputUser, $inputPass);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $_SESSION['Username'] = $inputUser;
            $_SESSION['Active'] = true;
            header("location:welcome.php");
            exit;
        } else {
            $error = 'Incorrect Username or Password';
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../css/signin.css">
</head>
<body>
  <div class="form-container">
    <h2>Login</h2>
    <form method="post" action="">
      <label for="Username">Username:</label><br>
      <!-- ✅ CLIENT-SIDE VALIDATION -->
      <input type="text" name="Username" required pattern="^[a-zA-Z0-9]{3,}$"><br><br>

      <label for="Password">Password:</label><br>
      <input type="password" name="Password" required minlength="4"><br><br>

      <button type="submit" name="Submit">Sign in</button>
    </form>

    <?php if(isset($error)) echo "<p style='color:red;'>$error</p>"; ?>
  </div>
</body>
</html>

