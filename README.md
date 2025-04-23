# Notes Management System

A simple web-based Notes Management System built with PHP and MySQL that allows users to register, login, create and manage note categories, add, edit, delete notes, and view note history.

---

## Table of Contents

- [Features](#features)
- [Tech Stack](#tech-stack)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Database Setup](#database-setup)
- [Usage](#usage)
- [Folder Structure](#folder-structure)
- [Screenshots](#screenshots)
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

## Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/PurveshShinde/Notes_Management_System.git
   ```
2. **Move the project folder**
   - Copy the `Notes_Management_System` folder into your web server root (e.g., `htdocs` for XAMPP).
3. **Start the server**
   - Launch Apache and MySQL services via XAMPP/WAMP control panel.
4. **Import the database**
   - Open [phpMyAdmin](http://localhost/phpmyadmin).
   - Create a new database named `notes`.
   - Select the `notes` database, go to the **Import** tab, and import the `database/notes.sql` file.

---

## Configuration

1. **Database connection**
   - Open `includes/config.php`.
   - Update the following constants if your MySQL credentials differ:
     ```php
     define('DB_SERVER', 'localhost');
     define('DB_USER', 'root');
     define('DB_PASS', '');
     define('DB_NAME', 'notes');
     ```
2. **File naming**
   - Ensure the config file is named `config.php` (not `config,php`).

---

## Database Setup

The `notes.sql` file contains the following tables:

- `tblregistration` — Stores user details
- `tblcategory` — Stores note categories
- `tblnotes` — Stores notes data
- `tblnoteshistory` — Stores history of note edits

---

## Usage

- Access the application in your browser at:  
  ```
  http://localhost/Notes_Management_System/index.php
  ```
- **Register** a new user or **Login** with existing credentials.
- **Manage Categories:** Add, edit, or delete categories.
- **Manage Notes:** Add, view, edit, delete notes, and view note history.

---

## Folder Structure

```
Notes_Management_System/
├── assets/           # Images and other media
├── css/              # Stylesheets (Bootstrap overrides)
├── js/               # JavaScript files
├── database/         # Database dump (notes.sql)
├── includes/         # Header, footer, sidebar, and config
│   ├── config.php
│   ├── header.php
│   ├── footer.php
│   └── leftbar.php
├── add-category.php
├── add-notes.php
├── change-password.php
├── dashboard.php
├── edit-category.php
├── index.php
├── login.php
├── logout.php
├── manage-categories.php
├── manage-notes.php
├── my-profile.php
├── password-recovery.php
└── registration.php
```

---

## Screenshots

> *Add screenshots of key pages here (e.g., Login, Dashboard, Notes List, Add Note).*  
> *Place images inside the `assets/` folder and reference them like:*  
> `![Dashboard](assets/dashboard.png)`

---

## Contributing

Contributions are welcome! Feel free to:

1. Fork the project
2. Create a new branch (`git checkout -b feature/YourFeature`)
3. Commit your changes (`git commit -m 'Add some feature'`)
4. Push to the branch (`git push origin feature/YourFeature`)
5. Open a Pull Request

Please ensure code style consistency and update documentation as needed.

---

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

---

## Contact

- **Author:** Purvesh Shinde
- **Email:** shindepurvesh007@gmail.com

Feel free to reach out with any questions or feedback!

