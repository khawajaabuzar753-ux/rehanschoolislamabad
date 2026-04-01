# Manahil Interns Check-In / Check-Out System

## 🚀 Quick Start (Local Preview)

### Option 1: Using Batch File (Windows)
Double-click `start-server.bat` or run:
```bash
start-server.bat
```

### Option 2: Using PowerShell (Windows)
```powershell
.\start-server.ps1
```

### Option 3: Manual Command
```bash
cd public
php -S localhost:8000
```

Then open your browser and go to: **http://localhost:8000**

---

## 📋 Requirements

- PHP 8.0 or higher
- MySQL/MariaDB database
- Web browser

---

## 🗄️ Database Setup

1. Import `database.sql` into your MySQL database
2. Update database credentials in `src/database.php`:
   ```php
   const DB_HOST = 'localhost';
   const DB_NAME = 'your_database_name';
   const DB_USER = 'your_username';
   const DB_PASS = 'your_password';
   ```

---

## 👤 Default Admin Login

- **Email:** admin@manahil.com
- **Password:** Admin@123

---

## 📁 Project Structure

```
├── public/          # Public-facing PHP files
├── src/            # Core PHP logic
├── assets/         # CSS, JS, images
└── database.sql    # Database schema
```

---

## 🔧 Troubleshooting

### 500 Error?
- Check PHP error logs
- Verify database connection in `src/database.php`
- Ensure all files are uploaded correctly

### Database Connection Failed?
- Verify credentials in `src/database.php`
- Make sure database exists and is accessible
- Check MySQL server is running

---

## 📱 Features

✅ User Signup & Login  
✅ Admin Login  
✅ Internship Timing Setup  
✅ Check In / Check Out  
✅ Auto-generated WhatsApp Messages  
✅ Admin Ledger with Search & Sort  
✅ Mobile & Desktop Responsive Design  

---

**Built with ❤️ for Manahil Interns**

