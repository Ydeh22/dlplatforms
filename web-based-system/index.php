<?php
ini_set('max_execution_time', 300);
session_start();


if(! isset($_SESSION['logged_in'])) {
  header("location:login.php");
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
      <?php include "includes/logout_bar.php"; ?>
  </div>
      <div class="row mainContainer">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <div class="card" >
            <div class="card-body">
              <h5 class="card-title">Select your image to recognize</h5>
              <form action="recognize_image.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="file" class="form-control-file" name="imageToRecognize">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Recognize</button>
              </form>
              <hr/>
              <h3>Welcome to "food image analyzing" portal.</h3>
              <p>
                Here you can upload your image and after clicking the "Recognize" button you can see results from 4 different Artificial intelligent API's. That are :                
              </p>
              <ul>
                  <li>Google -  Cloud Vision API</li>
                  <li>Amazon - Rekognition API </li>
                  <li>ClarifAI - API</li>
                  <li>IBM - Watson API</li>
              </ul>
              <p>
                After analyze you will get a list with the descriptions and scopres per API. Also you'll get averages scores and common descriptions calculated by this softtware. Finally you'll see a list with single scores/decsriptions only.
              </p>
            </div>
          </div>
        </div>
        <div class="col-md-3"></div>
      </div>
      
    
    <script src="assets/jquery/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"  crossorigin="anonymous"></script>
  </body>
</html>