<?php
require 'vendor/autoload.php';
use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;

if (isset($_POST['submit'])){
    $file = $_FILES['file'];


	try {
		//File variables
		$fileName = $_FILES['file']['name'];
		$fileTmpName = $_FILES['file']['tmp_name'];
		$fileSize = $_FILES['file']['size'];
		$fileError = $_FILES['file']['error'];
		$fileType = $_FILES['file']['type'];


		$fileExt = explode('.', $fileName);
		$fileActualExt = strtolower(end($fileExt));

		//Files allowed
		$allowed = array('jpg', 'jpeg', 'png', 'pdf','gif', 'zip', 'txt', 'xls', 'doc', 'docx', 'mp3', 'mp4', 'aac');
			
		//File acceptance and where it uploads to
		if (in_array($fileActualExt, $allowed)) {
			if ($fileError === 0) {
				if ($fileSize < 1000000) {
					$fileNameNew = uniqid('', true).".".$fileActualExt;
					$fileDestination = './uploads/'.$fileNameNew;
					$s3 = new S3Client([
						'region'  => 'us-west-2',
						'version' => 'latest'
					]);
					
					$result = $s3->putObject([
						'Bucket' => 'elasticbeanstalk-us-west-2-722883947022',
						'Key'    => 'files/' . $fileActualExt . '/' . $fileNameNew,
						'SourceFile' => $fileTmpName,
						'ACL' => 'public-read'
					]);
					
					// Display upload success with old + new file name 
					echo('Filename '.$fileName.' uploaded as: '.$fileNameNew."\r\n");   

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
	} catch(S3Exception $e){
		echo $e->getMessage();
	}
}


?>
