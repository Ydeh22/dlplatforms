<?php
class WatsonClient
{
	protected $apiKey = "";	
	protected $authUrl = "https://iam.bluemix.net/identity/token";
	protected $accessToken = "";

	protected $apiURL = "https://gateway.watsonplatform.net/visual-recognition/api/v3/";
	protected $version = "2018-03-19";

	public function __construct($_apiKey)
	{
		$this->apiKey = $_apiKey;
		$token = $this->getToken();
		if(!is_null($token)) {
			$this->accessToken = $token;
		}
	}
	private function getToken()
	{
		$curl = curl_init();
		curl_setopt_array($curl , array(
			CURLOPT_URL => $this->authUrl,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HTTPHEADER => array(
				"Content-Type: application/x-www-form-urlencoded",
		    	"Accept: application/json"		
			),
			CURLOPT_POSTFIELDS => http_build_query(array(				
				"grant_type" => "urn:ibm:params:oauth:grant-type:apikey" , 
				"apikey" => $this->apiKey
			)),
			
		));
		$serverResponse = curl_exec($curl);
		curl_close ($curl);

		if($serverResponse)
		{
			$data = json_decode($serverResponse);
			return $data->access_token;
		}
		return null;		
	}

	public function classifyImage($imageWithPath)
	{
		$method = "classify";		
		$URL = $this->apiURL.$method."?version=".$this->version;
		$imageWithFullPath = realpath($imageWithPath);

		$curl = curl_init();

		$postFields = array("images_file" => new CURLFile($imageWithFullPath,mime_content_type($imageWithFullPath),basename($imageWithFullPath)));

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $URL,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_VERBOSE => TRUE ,
		  CURLOPT_POSTFIELDS => $postFields,
		  CURLOPT_HTTPHEADER => array(
			"authorization: Bearer ".$this->accessToken			
		  ),
		));
		
		$serverResponse = curl_exec($curl);
		curl_close($curl);
		
		if(!empty($serverResponse))
		{
			$jsonResponse = json_decode($serverResponse);
			$classes = $jsonResponse->images[0]->classifiers[0]->classes;	

			$classifications = $this->sortClassifications($classes);
			return $classifications;

		}
		return null;
	}

	
	private function sortClassifications($classifications) 
	{
		$sorted = $classifications;
		for($i=0;$i<count($sorted);$i++) {
			for($j=$i;$j<count($sorted); $j++) {
				if($sorted[$i]->score < $sorted[$j]->score) {
					$temp = $sorted[$i];
					$sorted[$i] = $sorted[$j];
					$sorted[$j] = $temp;
				}
			}
		}
		return $sorted;
	}
}

