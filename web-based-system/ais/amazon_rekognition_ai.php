 <?php
 use Aws\Rekognition\RekognitionClient;
 
 //Amazon rekognition API keys
 // putenv('AWS_ACCESS_KEY_ID=AKIAJJSKVAOUJWCBKH5A');
 // putenv('AWS_SECRET_ACCESS_KEY=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');


 $options = [
    'region'            => 'us-west-2',
    'version'           => 'latest' ,
    'credentials' => [
        'key'    => 'My Key',
        'secret' => 'My Secret',
    ],
 ];

 $amazonRekognition = new RekognitionClient($options);

// Get local image
//$photo = './uploaded_images/test_image.jpg';
$photo = $imageWithPath;
$fp_image = fopen($photo, 'r');
$image = fread($fp_image, filesize($photo));
fclose($fp_image);


// Call DetectFaces
$amazonLabelsResult = $amazonRekognition->DetectLabels(array(
   'Image' => array(
      'Bytes' => $image,
   ),
   'Attributes' => array('ALL')
   )
);

$amazonLabels = $amazonLabelsResult['Labels'];

