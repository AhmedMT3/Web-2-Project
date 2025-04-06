<!-- <?php include("Header.php"); ?>  -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <script>
        function validateForm() {
            const password = document.getElementById("password").value;
            const confirmPassword = document.getElementById("confirm_password").value;
            const passwordRegex = /^(?=.*[0-9])(?=.*[!@#$%^&*])/;

            if (password !== confirmPassword) {
                alert("Passwords do not match.");
                return false;
            }

            if (password.length < 8) {
                alert("Password must be at least 8 characters");
                return false;
            }
            if (!passwordRegex.test(password)) {
                alert("Password must contain at least one number and one special character.");
                return false;
            }

            return true;
        }
    </script>
</head>

<body>
    <h2>User Registration</h2>
    <form action="DB_Ops.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        <label>Full Name:</label>
        <input type="text" name="full_name" required><br><br>

        <label>Username:</label>
        <input type="text" name="user_name" id="user_name" required><br><br>

        <label>Phone Number:</label>
        <input type="text" name="phone" required><br><br>

        <label>WhatsApp Number:</label>
        <input type="text" name="whatsapp" id="whatsapp" required>
        <button type="button" onclick="validateWhatsApp()">Check</button><br><br>

        <label>Address:</label>
        <input type="text" name="address" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Password:</label>
        <input type="password" name="password" id="password" required><br><br>

        <label>Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required><br><br>

        <label>Upload Image:</label>
        <input type="file" name="user_image" accept="image/*" required><br><br>

        <input type="submit" value="Register">
    </form>

    <script src="API_Ops.js"></script>
</body>

</html>

<!-- <?php include("Footer.php"); ?> -->