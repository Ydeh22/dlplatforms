<?php
use Google\Cloud\Vision\VisionClient;

$config['keyFile'] = json_decode(file_get_contents('keys/google_vision_ai_key.json'), true);



//Create new VisionClient instance
$googleVision = new VisionClient($config);
//Open image with read mode
$googleImageData =  fopen($imageWithPath , 'r');
//Create image from vision client
$googleImage = $googleVision->image($googleImageData, ['WEB_DETECTION']);
//Annotate and get image result from vision api
$googleResult = $googleVision->annotate($googleImage);
//Get WEB DETECTION result from the result 
$googleWeb = $googleResult->web();
//Get only entities from the WEB DETECTION
$googleEntities = $googleWeb->entities();

