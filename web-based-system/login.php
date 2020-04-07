<?php
session_start();
ini_set('max_execution_time', 300);
?>
<?php
  $username = null;
  $password = null;
  $loginError = "";
  //If the request methos is POST try to read the data
  if( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    //if username exists
    if(isset($_POST['username'])) {
      $username = $_POST['username'];
    }
    //If password exists
    if(isset($_POST['password'])) {
      $password = $_POST['password'];
    }
    
    if($username == "test" && $password = "test") {
      $_SESSION['logged_in'] = true;
      header("location:index.php");
      exit();
    } else {
      $loginError = "Please check your credentials";
    }
  }
?>
              
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css" crossorigin="anonymous">
    
    <title>Computer Vision</title>
  </head>
  <body>
    <div class="container">
      <div class="row mainContainer" >
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Login</h5>

              <form method="post" action="login.php">
                <?php
                if(! empty($loginError) ) { 
                  ?>                
                  <div class="alert alert-danger" role="alert">
                    <?= $loginError;?>
                  </div>
                  <?php
                }
                ?>
                <div class="form-group">
                  <label for="exampleInputEmail1">Username</label>
                  <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Username">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">Password</label>
                  <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
    </div>
    <script src="assets/jquery/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  </body>
</html>