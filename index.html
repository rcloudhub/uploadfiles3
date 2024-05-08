<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

// AWS credentials
$bucketName = 'rcloudhubn';
$accessKeyId = 'AKIA2UC3A23OPRRF74DU';
$secretAccessKey = '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';

// Instantiate an S3 client
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'eu-north-1',
    'credentials' => [
        'key' => $accessKeyId,
        'secret' => $secretAccessKey
    ]
]);

// Function to list files in S3 bucket
function listFiles($s3, $bucketName) {
    $objects = $s3->getIterator('ListObjects', array(
        'Bucket' => $bucketName
    ));

    $files = array();
    foreach ($objects as $object) {
        $files[] = $object['Key'];
    }

    return $files;
}

// Upload file to S3
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    $file = $_FILES['file'];

    // File details
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];

    // Upload file to S3
    try {
        $result = $s3->putObject([
            'Bucket' => $bucketName,
            'Key' => $fileName,
            'Body' => fopen($fileTmpName, 'rb'),
            'ACL' => 'public-read'
        ]);

        echo "File uploaded successfully. File URL: " . $result['ObjectURL'];
    } catch (S3Exception $e) {
        echo "Error uploading file: " . $e->getMessage();
    }
}

// List all files in the bucket
$files = listFiles($s3, $bucketName);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style> body {
    font-family: Arial, sans-serif;
    margin: 20px;
}

h1, h2 {
    margin-bottom: 10px;
}

form {
    margin-bottom: 20px;
}

input[type="file"] {
    margin-right: 10px;
}

button {
    padding: 5px 10px;
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

ul {
    list-style: none;
    padding: 0;
}

li {
    margin-bottom: 5px;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}
 </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload and Download Files from S3</title>
</head>
<body>
    <h1>Upload File to S3</h1>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="file" name="file" id="file">
        <button type="submit">Upload</button>
    </form>

    <h2>Files in S3 Bucket</h2>
    <ul>
        <?php foreach ($files as $file): ?>
            <li>
                <a href="<?php echo $s3->getObjectUrl($bucketName, $file); ?>" download="<?php echo $file; ?>"><?php echo $file; ?></a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>


</html>
