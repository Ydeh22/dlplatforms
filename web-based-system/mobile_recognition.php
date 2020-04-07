<?php

try {

	$responseData = [
		"google" => "" ,
		"amazon" => "",
		"clarifai" => "",
		"ibm" => "",
		"common" => "",
		"single" => ""
	];

	//Google VISION API
	require('ais/google_vision_ai.php');
	//Amazon Rekognition API
	require('ais/amazon_rekognition_ai.php');
	//ClarifAI
	require('ais/clarifai_ai.php');
	//IBM Watson
	require('ais/ibm_watson_ai.php');


	$allKeyScores = 
    [
            
    ];

    //Google             
    foreach($googleEntities as $googleEntity) { 
        $googleInfo = $googleEntity->info(); 

        if( isset($googleInfo['description']) &&
        	 isset($googleInfo['score']) )
        {
	        $googleDescription = $googleInfo['description'];   
	        $googleScore = round( ($googleInfo['score']*100) , 2 );            
	       	$allKeyScores[strtolower($googleDescription)][] = $googleScore;
	       	$responseData["google"] .= strtolower($googleDescription) . " : " .$googleScore. " % , ";
       	}
    } 
    //Amazon
	foreach($amazonLabels as $amazonlabel) { 
		$amazonDescription = $amazonlabel['Name'] ;
		$amazonScore = round( $amazonlabel['Confidence'] , 2);                
		$allKeyScores[strtolower($amazonDescription)][] = $amazonScore;
		$responseData["amazon"] .= strtolower($amazonDescription) . " : " .$amazonScore. " % , ";
	}
	//clarifai
	foreach($ClarifaiOutput->data() as $clafaiConcept) { 
		$clarifaiDescription = $clafaiConcept->name();
		$clarifaiScore = round( ($clafaiConcept->value() * 100 ) , 2);
		$allKeyScores[strtolower($clarifaiDescription)][] = $clarifaiScore; 
		$responseData["clarifai"] .= strtolower($clarifaiDescription) . " : " .$clarifaiScore. " % , ";            
	} 
	//IBM
	foreach($ibmWatsonClassifications as $ibmClassification) { 
        $ibmDescription = $ibmClassification->class;
        $ibmScore = round ( ($ibmClassification->score * 100) , 2);
      	$allKeyScores[strtolower($ibmDescription)][] = $ibmScore;
      	$responseData["ibm"] .= strtolower($ibmDescription) . " : " . $ibmScore . " % , ";
    }

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

        $commonAverages[$description] = round( $avgScore , 2 ); 
      } else {
        $singleAverages[$description] = round( $scores[0] , 2 );
      }
    }
    asort($commonAverages);
    $commonAverages = array_reverse($commonAverages);

    asort($singleAverages);
    $singleAverages = array_reverse($singleAverages);


    //Add common averages
    foreach($commonAverages as $description => $commonAverage) { 
        $responseData["common"] .= strtolower($description) . " : ". $commonAverage . " % , ";
		} 

	//Add single averages
	foreach($singleAverages as $description => $singleAverage) { 
		$responseData["single"] .= strtolower($description) . " : ". $singleAverage . " % , ";
    } 

	 http_response_code(200);
	 //header("Content-Type: application/json");
	 echo json_encode($responseData);

}
catch(Exception $e) {
	echo "ERROR";
}
