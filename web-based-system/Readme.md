### Web-base system installation

1. In login.php file, line 20, change $username == "test" and $password = "test" values based n your need.
2. Chage each platform's key with your own keys.
  - 2.1 /ais/amazon_rekognition_ai.php, lines 13 and 14, for Amazon rekognition platform.
  - 2.2 /ais/clarifai_ai.php, line 6 , for ClarifAI platform.
  - 2.3 /keys/google_vision_ai_key.json, Add all personal information, for Google Vision platform.
  - 2.4 /ais/ibm_watson_ai.php, line 4, for IBM Watson platform.
