<?php
session_start();
if (!isset($_SESSION['Active']) || $_SESSION['Active'] !== true) {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5 text-center">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['Username']); ?>! 👋</h1>
    <p class="lead">You have successfully logged in to EuroTour.</p>

    <a href="index.php" class="btn btn-primary mt-3">Go to Dashboard</a>
    <form action="logout.php" method="post" class="mt-3">
        <button type="submit" name="Submit" value="Logout" class="btn btn-danger">Log Out</button>
    </form>
  </div>
</body>
</html>
