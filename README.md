# Notes Management System

A simple, web-based system to create, manage, and organize personal notes, built with PHP and MySQL.

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#GettingStarted)
- [Contributing](#contributing)
- [License](#license)
- [Contact](#contact)

---

## Features

- User Registration and Login
- Password Recovery
- Create, Read, Update, Delete (CRUD) Categories
- Create, Read, Update, Delete (CRUD) Notes
- Note History Tracking
- User Profile Management
- Change Password Functionality
- Responsive UI with Bootstrap

---

## Tech Stack

- **Backend:** PHP (7.x or 8.x)
- **Database:** MySQL
- **Frontend:** HTML, CSS, JavaScript, Bootstrap

---

## Prerequisites

- XAMPP, WAMP, or LAMP stack installed
- PHP enabled (version 7.0+)
- MySQL or MariaDB
- Web browser (Chrome, Firefox, Edge, etc.)

---

## Getting Started
Follow these steps to run the project locally:

Clone the Repo

Bash

git clone https://github.com/PurveshShinde/Notes_Management_System.git
Setup Database

Create a database named notes in phpMyAdmin.

Import the database/notes.sql file provided in the project folder.

Configure Connection

Open includes/config.php and update your database credentials:

PHP

define('DB_SERVER', 'localhost');
define('DB_USER', 'root'); // Your DB Username
define('DB_PASS', '');     // Your DB Password
define('DB_NAME', 'notes');
Run

Move the project folder to your server root (e.g., htdocs in XAMPP).

Visit http://localhost/Notes_Management_System/ in your browser.

## Contributing
Contributions are welcome! Please fork the repository and create a pull request for any features or bug fixes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Contact

- **Author:** Purvesh Shinde.
- **Email:** shindepurvesh007@gmail.com

