<?php
require 'vendor/autoload.php';

if (isset($_POST['submit'])){
    $file = $_FILES['file'];

    //File variables
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Files allowed
    $allowed = array('jpg', 'jpeg', 'png', 'pdf','gif', 'zip', 'txt', 'xls', 'doc', 'docx');

    try {
        
    //File acceptance and where it uploads to
    if (in_array($lefiActualExt, $allowed)) {
        if ($fileError === 0) {
            if ($fileSize < 1000000) {
                $fileNameNew = uniqid('', true).".".$fileActualExt;
                $fileDestination = './uploads/'.$fileNameNew;
                //move_uploaded_file($fileTmpName, $fileDestination);
                $s3 = new Aws\S3\S3Client([
                    'region'  => 'us-west-2',
                    'version' => 'latest',
                    'credentials' => [
                        'key'    => 'AKIAIGPMQZUIO5ZBAKVQ'
                    ]
                ]);
                
                $result = $s3->putObject([
                    'Bucket' => 'elasticbeanstalk-us-west-2-722883947022',
                    'Key'    => $fileNameNew,
                    'Body'   => 'this is the body!',
                    //'SourceFile' => 'c:\samplefile.png' -- use this if you want to upload a file from a local location
                ]);
                
                // Print the body of the result by indexing into the result object.
                var_dump($result);              
                header("Location: index.php?uploadsuccess");
            //Error if file is too big
            } else {
                echo "The file is too big";
            }
        } else {
            echo "There was an error uploading your file";
        }
        
    //Wrong file type error
    } else{
        echo "Wrong File Type";

    }
} catch(Exception $e){
    echo $e->getMessage();
}
}

?>
