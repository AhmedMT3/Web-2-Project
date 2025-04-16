    </main> 
    <footer class="bg-dark text-white py-3 mt-5">
        <div class="container text-center">
            <p class="mb-0">&copy; 2025 | All Rights Reserved - Group 6</p>
        </div>
    </footer>
    
    <script>
        document.getElementById("user_name").addEventListener("blur", function() {
            const username = this.value.trim();
            
            if (username.length < 3) return; 
            
            fetch(`DB_Ops.php?action=check_username&username=${encodeURIComponent(username)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        alert("Username already taken! Please choose another one.");
                        document.getElementById("user_name").value = ""; 
                        document.getElementById("user_name").focus(); 
                    }
                })
                .catch(error => console.error("Error checking username:", error));
        });

        document.getElementById("registrationForm").addEventListener("submit", function(e) {
            e.preventDefault();
            
            document.querySelectorAll(".error").forEach(el => el.textContent = "");

            const formData = new FormData(this);
            fetch("DB_Ops.php", {
                method: "POST",
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("Registration successful!");
                } else {
                    if (data.errors) {
                        for (const [field, error] of Object.entries(data.errors)) {
                            const errorElement = document.getElementById(`${field}_error`);
                            if (errorElement) errorElement.textContent = error;
                        }
                    } else if (data.error) {
                        alert("Error: " + data.error);
                    }
                }
            })
            .catch(error => console.error("Error:", error));
        });
    </script> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
