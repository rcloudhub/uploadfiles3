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
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Approval Mails</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Adjust the shade of grey as needed */
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        input[type="file"],
        button {
            margin-top: 5px;
            margin-bottom: 10px;
            display: block;
            width: 100%;
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #45a049;
        }

        h2 {
            margin-top: 30px;
            margin-bottom: 10px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 5px;
        }

        a {
            text-decoration: none;
            color: #333;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Upload Approval Mails</h1>

    <form action="/search" method="get">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" placeholder="Type your search query here...">
        <button type="submit">Search</button>
    </form>

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
