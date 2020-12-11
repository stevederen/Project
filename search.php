<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$s3 = new S3Client([
    'region'  => 'us-west-2',
    'version' => 'latest'
]);
var_dump($s3);
//Creates objects variable, links it to objects in bucket
$objects = $s3->getIterator('ListObjects', array(
    'Bucket' =>'elasticbeanstalk-us-west-2-722883947022',
    'Prefix' => '/files/txt/'
));
var_dump($s3->getIterator('ListObjects', array(
    'Bucket' =>'elasticbeanstalk-us-west-2-722883947022'
)));
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Listings</title>
    </head>
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
                <?php var_dump($objects); ?>
                BEFOREFOREACH
                <?php foreach($objects as $object): ?>
                <tr>
                    INFOREACH
                     <!--Display name of objects-->
                    <td><?php echo $object['Key']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
