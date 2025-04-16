<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        header {
            background: linear-gradient(90deg, #007bff, #0056b3);
        }
    </style>
    <link rel="stylesheet" href="Spinner.css">
    <script>
        let isWhatsAppValid = false;

        function validateWhatsApp() {
            const numberInput = document.getElementById("whatsapp");
            const number = numberInput.value;
            const feedback = document.getElementById("whatsapp_feedback");
            const spinner = document.getElementById("loadingSpinner");

            // Show spinner
            spinner.style.display = "inline-block";

            fetch("API_Ops.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    body: "phone=" + encodeURIComponent(number)
                })
                .then(response => response.json())
                .then(data => {
                    isWhatsAppValid = data.valid;
                    if (data.valid) {
                        numberInput.style.borderColor = "green";
                        feedback.style.color = "green";
                    } else {
                        numberInput.style.borderColor = "red";
                        feedback.style.color = "red";
                    }
                    feedback.innerText = data.msg;
                })
                .catch(() => {
                    isWhatsAppValid = false;
                    numberInput.style.borderColor = "red";
                    feedback.style.color = "red";
                    feedback.innerText = "Error validating number.";
                })
                .finally(() => {
                    spinner.style.display = "none"; // Hide spinner
                });
        }

        function validateForm() {
            if (!isWhatsAppValid) {
                alert("Please validate WhatsApp number.");
                return false;
            }
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
    <header class="text-white py-4">
        <div class="container text-center">
            <h1>User Registration Portal</h1>
            <p class="lead">Web-based Information Systems - Spring 2025</p>
        </div>
    </header>
    <main class="container my-5">