<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$bucket = 'elasticbeanstalk-us-west-2-722883947022';
$keyname = '/files';

$s3 = new S3Client([
    'region'  => 'us-west-2',
    'version' => 'latest'
]);
//Creates objects variable, links it to objects in bucket
$objects = $s3->getIterator('ListObjects', ['Bucket' => $config['s3']['elasticbeanstalk-us-west-2-722883947022']]);
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
                <?php foreach($objects as $object): ?>
                <tr>
                     <!--Display name of objects-->
                    <td><?php echo $object['Key']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </body>
</html>
