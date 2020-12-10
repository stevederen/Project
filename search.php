<?php
require 'vendor/autoload.php';
use Aws\S3\S3Client;

$objects = $s3->getIterator('ListObjects', ['Bucket' => $config['s3']['bucket'] ]);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Listings</title>
    </head>
    <body>

    </body>
</html>
