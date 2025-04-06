<?php
echo "<h2>Received Registration Data</h2>";

// Text inputs
$fields = [
  "Full Name" => $_POST['full_name'] ?? '',
  "Username" => $_POST['user_name'] ?? '',
  "Phone" => $_POST['phone'] ?? '',
  "WhatsApp" => $_POST['whatsapp'] ?? '',
  "Address" => $_POST['address'] ?? '',
  "Email" => $_POST['email'] ?? '',
  "Password" => $_POST['password'] ?? '',
  "Confirm Password" => $_POST['confirm_password'] ?? ''
];

// Print each value
foreach ($fields as $label => $value) {
  echo "<strong>$label:</strong> " . htmlspecialchars($value) . "<br>";
}

// Image file details
if (isset($_FILES['user_image'])) {
  $image = $_FILES['user_image'];
  echo "<br><strong>Image Name:</strong> " . htmlspecialchars($image['name']) . "<br>";
  echo "<strong>Temp Path:</strong> " . htmlspecialchars($image['tmp_name']) . "<br>";
  echo "<strong>Size:</strong> " . $image['size'] . " bytes<br>";
} else {
  echo "<br>No image uploaded.";
}
?>
