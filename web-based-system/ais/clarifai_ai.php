<?php
use Clarifai\API\ClarifaiClient;
use Clarifai\DTOs\Inputs\ClarifaiFileImage;


$clarifAIClient = new ClarifaiClient('My Key');

$clarifAIResponse = $clarifAIClient->publicModels()->generalModel()->predict(
        new ClarifaiFileImage(file_get_contents($imageWithPath)))
    ->executeSync();

$ClarifaiOutput = null;

if ($clarifAIResponse->isSuccessful()) {
    /** @var ClarifaiOutput $output */
    $ClarifaiOutput = $clarifAIResponse->get();

}