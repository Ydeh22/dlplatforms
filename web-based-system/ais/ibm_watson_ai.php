<?php
require("library/watson_client.php");

$API_KEY = "My Key";
$watsonClient = new WatsonClient($API_KEY);


$ibmWatsonClassifications = $watsonClient->classifyImage($imageWithPath);

