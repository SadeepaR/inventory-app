# EFL - Inventory Management Application

A lightweight web application built for EFL Inventory Management. The system demonstrates user authentication, database CRUD operations, SQL table joins, and asynchronous JavaScript (AJAX) live search.

---

## Features

- **User Authentication**: User registration and login forms with unique email verification and secure password hashing.
- **Product CRUD**: Full Create, Read, Update, and Delete operations for managing products (`product_name`, `category`, `price`, `quantity`, `description`).
- **Table Join View**: A dedicated directory page using an SQL `LEFT JOIN` to combine product records with their respective suppliers (`supplier_name`, `contact_info`).
- **AJAX Real-Time Search**: Live product suggestions displayed as the user types without reloading the page.
- **Form Validation**: Client-side jQuery validation alongside server-side PHP validation.
- **Responsive Interface**: Mobile-friendly layout styled with clean CSS3 and semantic HTML5.

---

## Tech Stack

- **Backend**: PHP (Vanilla/Procedural, PDO)
- **Database**: MySQL
- **Frontend**: HTML5, CSS3, JavaScript, jQuery

---

## Setup & Installation

### 1. Clone the Repository

```bash
git clone https://github.com/SadeepaR/inventory-app.git
cd inventory-app
```

### 2. Import Database Schema

Create the database and import the tables using MySQL CLI or phpMyAdmin:

```bash
mysql -u root -p < schema.sql
```

### 3. Configure Database Credentials

Open `db.php` and update your MySQL connection details:

```php
$host = '127.0.0.1';
$db   = 'efl_logistics_db';
$user = 'root';
$pass = 'YOUR_MYSQL_PASSWORD'; // Set your MySQL password here
```

### 4. Run the Application

Start the built-in PHP development server:

```bash
php -S localhost:8000
```

Open your browser and navigate to:

```
http://localhost:8000/login.php
```
