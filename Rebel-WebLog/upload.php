<?php
$uploadedFile = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $targetDir = "./statics/image"; // Directory where images will be stored
    $fileName = basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }

    // Check file size (limit to 2MB)
    if ($_FILES["image"]["size"] > 2 * 1024 * 1024) {
        echo "Sorry, your file is too large.<br>";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedTypes)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Upload file if all checks pass
    if ($uploadOk) {
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true); // Create uploads directory if it doesn't exist
        }

        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $uploadedFile = $targetFilePath; // Store uploaded file path
        } else {
            echo "Sorry, there was an error uploading your file.<br>";
        }
    } else {
        echo "Sorry, your file was not uploaded.<br>";
    }
}
?>
