<?php
class DBOperations {
    private $conn;
    
    public function __construct() {
        $this->connectDB();
    }
    
    private function connectDB() {
        $this->conn = new mysqli('localhost', 'fcai_user', '1234', 'user_registration');
        
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }
    
    // Check if username already exists in the database
    public function checkUsernameExists($username) {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE user_name = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();
        
        return $stmt->num_rows > 0;
    }

    // Validate all user input server-side
    private function validateInput($data) {
        $errors = [];

        // Required fields
        $required = ['full_name', 'user_name', 'email', 'phone', 'whatsapp', 'address', 'password'];
        foreach ($required as $field) {
            if (empty($data[$field])) {
                $errors[$field] = "$field is required";
            }
        }

        // Email format
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Invalid email format";
        }

        // Password (matches client-side rules)
        if (strlen($data['password']) < 8) {
            $errors['password'] = "Password must be 8+ characters";
        } elseif (!preg_match('/[0-9]/', $data['password']) || !preg_match('/[!@#$%^&*]/', $data['password'])) {
            $errors['password'] = "Password needs 1 number and 1 special character";
        }

        // Password match
        if ($data['password'] !== $data['confirm_password']) {
            $errors['confirm_password'] = "Passwords don't match";
        }

        return count($errors) ? $errors : true;
    }

    // Registration handler
    public function registerUser($data) {
        $validation = $this->validateInput($data);
        if ($validation !== true) {
            return ['success' => false, 'errors' => $validation];
        }

        // Insert user
        $hashedPassword = password_hash($data['password'], PASSWORD_BCRYPT);
        $stmt = $this->conn->prepare("INSERT INTO users (full_name, user_name, email, phone, whatsapp, address, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
        
        $stmt->bind_param("sssssss", 
            $data['full_name'],
            $data['user_name'],
            $data['email'],
            $data['phone'],
            $data['whatsapp'],
            $data['address'],
            $hashedPassword,
        );

        return $stmt->execute() 
            ? ['success' => true] 
            : ['success' => false, 'error' => "Database error: " . $stmt->error];
    }
}

// AJAX username check request
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
?>
