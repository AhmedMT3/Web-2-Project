<?php
class ImageUploader
{
    private $targetDir = "Uploads/";
    private $maxFileSize = 5000000; // 5MB
    private $allowedFileTypes = ["jpg", "jpeg", "png", "gif"];

    public function upload($file)
    {
        $errors = [];

        if (!isset($file["name"]) || empty($file["name"])) {
            $errors['image'] = 'No file uploaded.';
            return ['success' => false, 'errors' => $errors];
        }

        $fileName = basename($file["name"]);
        $targetPath = $this->targetDir . $fileName;
        $fileType = strtolower(pathinfo($targetPath, PATHINFO_EXTENSION));

        // Validate file type
        if (!in_array($fileType, $this->allowedFileTypes)) {
            $errors['image'] = 'Invalid file format. Allowed formats: jpg, jpeg, png, gif.';
        }

        // Validate file size
        if ($file["size"] > $this->maxFileSize) {
            $errors['image'] = 'File size exceeds the maximum limit of 5MB.';
        }

        // Validate if file is an actual image
        $check = getimagesize($file["tmp_name"]);
        if ($check === false) {
            $errors['image'] = 'File is not a valid image.';
        }

        if (!empty($errors)) {
            return ['success' => false, 'errors' => $errors];
        }

        // Attempt to move the uploaded file
        if (move_uploaded_file($file["tmp_name"], $targetPath)) {
            return ['success' => true, 'fileName' => $fileName];
        } else {
            $errors['image'] = 'Failed to upload the file.';
            return ['success' => false, 'errors' => $errors];
        }
    }
    
}
?>