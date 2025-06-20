#  Task Manager (PHP + MySQL + AJAX)

A simple Task Manager built with:
- PHP (OOP)
- MySQL database
- jQuery + AJAX
- Bootstrap for styling

---

## Setup Instructions

### 1️ Requirements

- XAMPP (or any PHP + MySQL server)
- Web browser

---

### 2️ Copy the Project

- Copy the whole project folder into your XAMPP `htdocs`: C:\xampp\htdocs\task-manager

---

### 3️ Create the Database

1. Open [phpMyAdmin](http://localhost/phpmyadmin)

2. Create a new database named: task_manager

3. Run this SQL to create the `tasks` table:
```sql
CREATE TABLE tasks (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  status ENUM('pending', 'completed') DEFAULT 'pending',
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);
```
### 4️ Check Database Credentials
- In Database.class.php, the default settings are:
```host: localhost
username: root
password: (empty)
database: task_manager
```
- Change them if your local MySQL uses a password.

### 5️ Run the Project
1. Start Apache and MySQL from your XAMPP Control Panel.

2. Open your browser and visit:
```
http://localhost/task-manager
```
3. Now you can add, edit, filter, and delete tasks!




