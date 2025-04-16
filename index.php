<?php include("Header.php"); ?> 

<!-- Page Content -->
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-body">
                <h4 class="card-title mb-4 text-center">Register a New Account</h4>

                <form id="registrationForm" action="DB_Ops.php" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
                    <div class="mb-3">
                        <label class="form-label">Full Name:</label>
                        <input type="text" name="full_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Username:</label>
                        <input type="text" name="user_name" id="user_name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number:</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">WhatsApp Number:</label>
                        <input type="text" name="whatsapp" id="whatsapp" class="form-control" required><br>
                        <button type="button" class="btn btn-secondary mt-2" onclick="validateWhatsApp()">Check</button>
                        <small id="whatsapp_feedback"></small>
                        <span id="loadingSpinner" class="spinner"></span><br><br>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Address:</label>
                        <input type="text" name="address" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password:</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Upload Image:</label>
                        <input type="file" name="image" accept="image/*" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <input type="submit" value="Register" class="btn btn-primary">
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include("Footer.php"); ?>