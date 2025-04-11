<?php
// Database connection 
$db = new mysqli("localhost", "username", "password", "database_name");
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    $targetDir = "uploads/";  
    $fileName = basename($_FILES["image"]["name"]);
    $targetPath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));
    $uploadOk = 1;

  
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

  
    if ($_FILES["image"]["size"] > 5000000) {
        echo "File is too large (max 5MB).";
        $uploadOk = 0;
    }

    $allowedTypes = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($fileType, $allowedTypes)) {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
        $uploadOk = 0;
    }

   
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetPath)) {
         
            $stmt = $db->prepare("INSERT INTO images (filename) VALUES (?)");
            $stmt->bind_param("s", $fileName);
            if ($stmt->execute()) {
                echo "Image uploaded and saved to database successfully!";
            } else {
                echo "Error saving to database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error uploading file.";
        }
    }
}
$db->close();
?>