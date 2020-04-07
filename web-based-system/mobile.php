<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
ini_set('max_execution_time', 300);
ini_set('max_input_vars' , 10000);


// header('Cache-Control: no-cache, must-revalidate');
 require('./vendor/autoload.php');


  require_once (dirname(__FILE__).'/PHP_Compat-1.6.0a3/Compat/Function/file_get_contents.php');
  $data = php_compat_file_get_contents('php://input');


  //Constants
  $uploadsDir = "mobile_uploads";


  //If there isn't an error move image to uploads folder
  $newImageName = $_GET['filename'];
  $imageWithPath = $uploadsDir.'/'.$newImageName;

  if (file_put_contents($imageWithPath,$data)) {
    if (filesize($imageWithPath) != 0) {
     

     include "mobile_recognition.php";


    } else {
      header("HTTP/1.0 400 Bad Request");
      echo "File is empty.";
    }
  } else {
    header("HTTP/1.0 400 Bad Request");
    echo "File transfer failed.";
  }