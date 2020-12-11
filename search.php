<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$s3 = new S3Client([
    'region'  => 'us-west-2',
    'version' => 'latest'
]);
//Creates objects variable, links it to objects in bucket
$objects = $s3->getIterator('ListObjects', array(
    'Bucket' =>'elasticbeanstalk-us-west-2-722883947022',
    'Prefix' => 'files/'
));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Listings</title>
    </head>
    <div id="content" align="center">
    <body>
        <table>
            <thead>
                <tr>
                    <th>File</th>
                    <th>Download</th>
                </tr>
            </thead>
            <!--Table for listing objects-->
            <tbody>
                <!--Finds objects in bucket-->
                <?php foreach($objects as $object): ?>
                <tr>
                     <!--Display name of objects-->
                    <td><?php echo $object['Key']; ?></td>
                    <!--Displays object download link-->
                    <td><a href="<?php echo $s3->getObjectUrl('elasticbeanstalk-us-west-2-722883947022', $object['Key']); ?>" download="<?php $object['Key']; ?>">Download</a></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <body style = "background: url(https://i.pinimg.com/originals/1c/a6/e1/1ca6e1c35e2d884230242cc0326dbf28.jpg)">  
    </body>
</html>
