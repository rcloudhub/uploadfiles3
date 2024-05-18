<?php

require 'vendor/autoload.php'; // Include the AWS SDK for PHP

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Specify your AWS credentials and the region where your S3 bucket is located
$credentials = [
    'key'    => 'AKIA2UC3A23OPRRF74DU',
    'secret' => 'w1ZHb79E55O1jTfwGSaILQYyevhogg3EYeStVE8y',
    'region' => 'eu-north-1', // e.g., 'us-east-1'
];

// Instantiate an S3 client
$s3 = new S3Client([
    'version'     => 'latest',
    'credentials' => $credentials,
]);

// Specify the bucket name and the object key you want to search for
$bucketName = 'rcloudhubn';
$objectKey = 'Mumbai.jpeg';

try {
    // List objects in the bucket
    $objects = $s3->listObjectsV2(['Bucket' => $bucketName]);

    // Iterate through the objects and check if the desired object exists
    foreach ($objects['Contents'] as $object) {
        if ($object['Key'] === $objectKey) {
            echo "Object '{$objectKey}' found in bucket '{$bucketName}'";
            break;
        }
    }
} catch (AwsException $e) {
    echo $e->getMessage();
}
?>
