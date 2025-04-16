## 📘 User Registration Portal
A simple educational web app for registering users with image uploads, WhatsApp validation, and MySQL database integration.

### 🚀 Features
- 📝 Register users with full info + image
- ✅ Client + Server form validation
- 📱 WhatsApp number verification via API
- 🖼️ Profile image upload to `Uploads/`
- 🗃️ Stores data in MySQL (via `DB_Ops.php`)

### ⚙️ Requirements
- PHP 8+
- MySQL
- Curl

### 🛠️ Setup
1. Clone repo
2. Import `DB-backup.sql` into MySQL
3. Edit DB creds in `DB_Ops.php`
4. Add your RapidAPI key in `API_Ops.php`
5. Ensure `Uploads/` is writable
6. Start server: `php -S localhost:8000`

### 📄 License
Educational use only — not for production.

