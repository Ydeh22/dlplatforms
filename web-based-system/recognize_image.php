<?php 
ini_set('max_execution_time', 300);
session_start();

if(!isset($_SESSION['logged_in'])) {
  header("location:login.php");
}

require('./vendor/autoload.php');


//Constants
$uploadsDir = "uploaded_images";

//Check for uplaod errors
$error = null;
if(isset($_FILES['imageToRecognize'])) {
  if($_FILES['imageToRecognize']['error'] !== 0) {
    $error = "Please select an image";
  }
} else {
  $error = "There is no image";
}

//If there isn't an error move image to uploads folder
$newImageName = "";
$imageWithPath = "";
if( is_null($error)) {
  $tempFileName = $_FILES['imageToRecognize']['tmp_name'];
  $newImageName = ( uniqid(rand(), true) . ".jpg" );
  $imageWithPath = $uploadsDir.'/'.$newImageName;
  move_uploaded_file($tempFileName, $imageWithPath);
} 

//Google VISION API
require('ais/google_vision_ai.php');
//Amazon Rekognition API
require('ais/amazon_rekognition_ai.php');
//ClarifAI
require('ais/clarifai_ai.php');
//IBM Watson
require('ais/ibm_watson_ai.php');

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
  <div class="container mainContainer">
    <?php 
    //Show error , if we have errors when upload
    if( !is_null($error) ) { ?>
    <div class="row">
      <div class="col-md-12">
        <div class="alert alert-warning" role="alert">
          <?=$error?>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="row">    
      <div class="col-md-3"> 
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Selected image</h5>
            <?php if( is_null($error) ) { ?>
            <p class="card-text">
              <img src="<?=$imageWithPath?>" class="card-img-top" alt="uploadedImage"/>
            </p>
            <?php } ?>
          </div>
        </div>
      </div>
      <?php
        $allKeyScores = 
        [
          
        ];
        $detailedScores = 
        [
          "google"    => [],
          "amazon"    => [],
          "clarifai"  => [],
          "ibm"       => []
        ];
      ?>
      <div class="col-md-9">

       <div class="card" style="margin-bottom: 10px;">
          <div class="card-body">
            <h5 class="card-title">Image recognition</h5>
            <p class="card-text">
              Google Cloud Vision API
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $aa = 1;
                  foreach($googleEntities as $googleEntity) { 
                  $googleInfo = $googleEntity->info(); 
                  $googleDescription = $googleInfo['description'];   
                  $googleScore = round( ($googleInfo['score']*100) , 2 );            
                  ?>
                  <tr>
                    <th scope="row"><?=$aa?></th>
                    <td><?=$googleDescription?></td>
                    <td><?=$googleScore?> %</td>
                  </tr>
                  <?php
                   $allKeyScores[strtolower($googleDescription)][] = $googleScore;
                   $detailedScores["google"][strtolower($googleDescription)] = $googleScore;
                  $aa++; 
                  } ?>
                </tbody>
              </table>
            </p>              
          </div>
        </div>

        <div class="card" style="margin-bottom: 10px;" >
          <div class="card-body">
            <h5 class="card-title">Image recognition</h5>
            <p class="card-text">
              Amazon Rekognition API
               <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $aa=1;
                  foreach($amazonLabels as $amazonlabel) { 
                  $amazonDescription = $amazonlabel['Name'] ;
                  $amazonScore = round( $amazonlabel['Confidence'] , 2);                
                  ?>
                    <tr>
                    <th scope="row"><?=$aa?></th>
                    <td><?=$amazonDescription?></td>
                    <td><?=$amazonScore?> %</td>
                    </tr>
                  <?php
                  $allKeyScores[strtolower($amazonDescription)][] = $amazonScore;
                  $detailedScores["amazon"][strtolower($amazonDescription)] = $amazonScore;
                  $aa++; 
                  } ?>
                </tbody>
              </table>
            </p>              
          </div>
        </div>

        <div class="card" style="margin-bottom: 10px;">
          <div class="card-body">
            <h5 class="card-title">Image recognition</h5>
            <p class="card-text">
              ClarifAI API
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $aa=1;
                    foreach($ClarifaiOutput->data() as $clafaiConcept) { 
                      $clarifaiDescription = $clafaiConcept->name();
                      $clarifaiScore = round( ($clafaiConcept->value() * 100 ) , 2);
                    ?>
                    <tr>
                      <th scope="row"><?=$aa?></th>
                      <td><?=$clarifaiDescription?></td>
                      <td><?=$clarifaiScore?> %</td>
                    </tr>
                  <?php
                    $allKeyScores[strtolower($clarifaiDescription)][] = $clarifaiScore;
                    $detailedScores["clarifai"][strtolower($clarifaiDescription)] = $clarifaiScore;
                  $aa++; 
                  } ?>
                </tbody>
              </table>
            </p>              
          </div>
        </div> 
        
        <div class="card" style="margin-bottom: 10px;" >
          <div class="card-body">
            <h5 class="card-title">Image recognition</h5>
            <p class="card-text">
              IBM Watson API
               <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Score</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $aa=1;
                    foreach($ibmWatsonClassifications as $ibmClassification) { 
                      $ibmDescription = $ibmClassification->class;
                      $ibmScore = round ( ($ibmClassification->score * 100) , 2);
                  ?>
                    <tr>
                      <th scope="row"><?=$aa?></th>
                      <td><?=$ibmDescription?></td>
                      <td><?=$ibmScore?> %</td>
                    </tr>
                  <?php
                    $allKeyScores[strtolower($ibmDescription)][] = $ibmScore;
                    $detailedScores["ibm"][strtolower($ibmDescription)] = $ibmScore;
                    $aa++; 
                  } ?>
                </tbody>
              </table>
            </p>              
          </div>
        </div>

        <?php
          //Calculation of the average scores
          $commonAverages = [];
          $singleAverages = [];
          foreach( $allKeyScores as $description => $scores) {
            $count = count($scores);
            if($count > 1) {
              $total = 0;
              for($i = 0 ; $i<$count;$i++) {
                $total += $scores[$i];
              }
              $avgScore = $total / $count;
              $commonAverages[$description] = $avgScore;
            } else {
              $singleAverages[$description] = $scores[0];
            }
          }
          asort($commonAverages);
          $commonAverages = array_reverse($commonAverages);

          asort($singleAverages);
          $singleAverages = array_reverse($singleAverages);
        ?>
        <div class="card" >
          <div class="card-body">
            <h5 class="card-title">Total scores</h5>
            <p class="card-text">
              Common scores
               <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Avg. Score</th>
                    <th scope="col">Google</th>
                    <th scope="col">Amazon</th>
                    <th scope="col">ClarifAI</th>
                    <th scope="col">IBM</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $aa=1;
                    foreach($commonAverages as $description => $commonAverage) { 
                  ?>
                    <tr>
                      <th scope="row"><?=$aa?></th>
                      <td><?=$description?></td>
                      <td><b><?=$commonAverage?> %</b></td>
                      <td><?php echo (isset($detailedScores["google"][$description]) ? $detailedScores["google"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["amazon"][$description]) ? $detailedScores["amazon"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["clarifai"][$description]) ? $detailedScores["clarifai"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["ibm"][$description]) ? $detailedScores["ibm"][$description] : "-"); ?></td>
                    </tr>
                  <?php
                    $aa++; 
                  } ?>
                </tbody>
              </table>
            </p> 
            <p class="card-text">
              Single scores
               <table class="table">
                <thead>
                  <tr>
                    <th scope="col">A/A</th>
                    <th scope="col">Description</th>
                    <th scope="col">Score</th>
                    <th scope="col">Google</th>
                    <th scope="col">Amazon</th>
                    <th scope="col">ClarifAI</th>
                    <th scope="col">IBM</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $aa=1;
                    foreach($singleAverages as $description => $singleAverage) { 
                  ?>
                    <tr>
                      <th scope="row"><?=$aa?></th>
                      <td><?=$description?></td>
                      <td><b><?=$singleAverage?> %</b></td>
                      <td><?php echo (isset($detailedScores["google"][$description]) ? $detailedScores["google"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["amazon"][$description]) ? $detailedScores["amazon"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["clarifai"][$description]) ? $detailedScores["clarifai"][$description] : "-"); ?></td>
                      <td><?php echo (isset($detailedScores["ibm"][$description]) ? $detailedScores["ibm"][$description] : "-"); ?></td>
                    </tr>
                  <?php
                    $aa++; 
                  } ?>
                </tbody>
              </table>
            </p>                
          </div>
        </div>

      </div>
    </div>
    <div class="row" style="margin-top: 10px;">
      <div class="col-md-3"></div>
      <div class="col-md-9">
        <a href="index.php" class="btn btn-primary">Return to home</a>
      </div>
    </div>
  </div>
  <?php






  ?>
  <script src="assets/jquery/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>
</html>