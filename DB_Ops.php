<?php
include __DIR__ . "/Upload.php"; // Ensure Upload.php is included correctly

class DBOperations
{
    private $conn;

    public function __construct()
    {
        $this->connectDB();
    }

    private function connectDB()
    {
        $this->conn = new mysqli('127.0.0.1', 'root', '', 'web-based');

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function checkUsernameExists($username)
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        return $stmt->num_rows > 0;
    }

    private function validateInput($data)
    {
        $errors = [];

        $required = ['full_name', 'user_name', 'email', 'phone', 'whatsapp', 'address', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $errors[$field] = "$field is required";
            }
        }

        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        if (strlen($data['password']) < 8) {
            $errors['password'] = "Password must be 8+ characters";
        } elseif (!preg_match('/[0-9]/', $data['password']) || !preg_match('/[!@#$%^&*]/', $data['password'])) {
            $errors['password'] = "Password needs 1 number and 1 special character";
        }

        if ($data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = "Passwords don't match";
        }

        return count($errors) ? $errors : true;
    }

    public function registerUser($data)
    {
        $validation = $this->validateInput($data);
        if ($validation !== true) {
            return ['success' => false, 'errors' => $validation];
        }

        $ImgUploader = new ImageUploader();
        $uploadResult = $ImgUploader->upload($_FILES["image"]);

        if ($uploadResult['success'] === false) {
            return ['success' => false, 'errors' => ['image' => $uploadResult['error']]];
        }

        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);

        $stmt = $this->conn->prepare("INSERT INTO users (full_name, user_name, email, phone, whatsapp, address, password, user_image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssss",
            $data['full_name'],
            $data['user_name'],
            $data['email'],
            $data['phone'],
            $data['whatsapp'],
            $data['address'],
            $hashedPassword,
            $uploadResult['fileName']
        );

        return $stmt->execute()
            ? ['success' => true]
            : ['success' => false, 'error' => "Database error: " . $stmt->error];
    }
}

// AJAX username check
if (isset($_GET['action']) && $_GET['action'] == 'check_username' && isset($_GET['username'])) {
    $db = new DBOperations();
    $username = trim($_GET['username']);

    header('Content-Type: application/json');
    echo json_encode([
        'exists' => $db->checkUsernameExists($username)
    ]);
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');
    $db = new DBOperations();
    $response = $db->registerUser($_POST);
    echo json_encode($response);
    exit;
}
