### Web-base system installation
Before you begin the configuration of the following code, please make sure that you have installed the php libraries of the four deep learninig platforms, based on the instrations od the platforms owners.

Important keys elements:
1. In login.php file, line 20, change $username == "test" and $password = "test" values based n your need.
2. Chage each platform's key with your own keys:
  - /ais/amazon_rekognition_ai.php, lines 13 and 14, for Amazon rekognition platform.
  - /ais/clarifai_ai.php, line 6 , for ClarifAI platform.
  - /keys/google_vision_ai_key.json, Add all personal information, for Google Vision platform.
  - /ais/ibm_watson_ai.php, line 4, for IBM Watson platform.
  


### Guide
- [mobile.php] mobile.php is the file that the android application uses to get the prediction from the platforms. Thos file returns JSON data.

### SOS - Don not forget to include the necessary libraries
