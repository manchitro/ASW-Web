<?php
session_start();
if (isset($_SESSION['userEmail']) && $_SESSION['userEmail'] == "admin") {
}
else{
  header("Location: ../login.php?error=nosession");
  exit();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Dashboard</title>
  <link rel="icon" href="favicon.png">
</head>

<body>

  <h1 >Admin Dashboard</h1>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
    <textarea name = "qbox" rows = "10" cols = "50" value = "" placeholder="Write query here"></textarea><br>

    <input type="submit" value="submit"><br>
  </form>
  <br><br>


  <?php
  include 'includes/queryprocess.inc.php'
  ?>


</body>
</html>