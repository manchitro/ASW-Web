<?php

  include '../includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
</head>

<body style="background-color:#0090EE;">

  <h1 style="color:red;">Admin Dashboard</h3>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
  <textarea name = "qbox" rows = "10" cols = "50" value = "">write query here</textarea><br>

  <input type="submit" value="submit"><br>
  </form>
  <br><br>


  <?php
    include '../includes/queryprocess.inc.php'
  ?>


</body>
</html>