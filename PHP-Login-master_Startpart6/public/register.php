<?php
require_once('db.php');
session_start();

if (isset($_POST['Submit'])) {
    $newUser = trim($_POST['Username']);
    $newPass = trim($_POST['Password']);

    // ✅ SERVER-SIDE VALIDATION
    if (!preg_match('/^[a-zA-Z0-9]{3,}$/', $newUser)) {
        $error = "Invalid username format. Use at least 3 alphanumeric characters.";
    } elseif (strlen($newPass) < 4) {
        $error = "Password must be at least 4 characters.";
    } else {
        // ✅ Check if username already exists
        $check = $conn->prepare("SELECT * FROM users WHERE username = ?");
        $check->bind_param("s", $newUser);
        $check->execute();
        $checkResult = $check->get_result();

        if ($checkResult->num_rows > 0) {
            $error = "Username already taken. Please choose another.";
        } else {
            // ✅ Insert into database
            $stmt = $conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $newUser, $newPass);

            if ($stmt->execute()) {
                header("location:login.php");
                exit;
            } else {
                $error = "Registration failed: " . $stmt->error;
            }

            $stmt->close();
        }

        $check->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="../css/signin.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <div class="form-container container mt-5">
    <h2>Create an Account</h2>
    <form method="post" action="">
      <div class="mb-3">
        <label for="Username" class="form-label">Username</label>
        <input type="text" name="Username" class="form-control" required pattern="^[a-zA-Z0-9]{3,}$" title="Alphanumeric, 3+ characters">
      </div>
      <div class="mb-3">
        <label for="Password" class="form-label">Password</label>
        <input type="password" name="Password" class="form-control" required minlength="4">
      </div>
      <button type="submit" name="Submit" class="btn btn-primary">Register</button>
    </form>

    <?php if(isset($error)) echo "<p class='text-danger mt-3'>$error</p>"; ?>
  </div>
</body>
</html>

