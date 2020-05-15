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

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>

<body class="p-3" style="background-color:#a5c0d2;">

  <div class="d-flex justify-content-between">
    <h1 style="color:red;" >Admin Dashboard</h1>
    
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
      Change Password
    </button>

    <a class="btn btn-danger" href="logout.php">Log Out</a>
  </div>

  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method ="POST">
    <textarea name = "qbox" rows = "10" cols = "50" value = "" placeholder="Write query here"></textarea><br>

    <input type="submit" value="Submit">

  </form>
  <br><br>


  <?php
  include 'includes/queryprocess.inc.php'
  ?>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Change Admin Password</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
         
          <div class="modal-body">
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
              <div class="form-group row">
                <label for="oldPassword" class="col-sm-2 col-form-label">Old Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="oldPassword" name="oldPassword" required="">
                </div>
              </div>
              <div class="form-group row">
                <label for="newPassword" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" id="newPassword" name="newPassword" required="">
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 offset-2">
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
              </div>
            </form>
          </div>
        
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>


	<!-- Bootstrap js -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>