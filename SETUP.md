# Installation & Local Setup Guide

This guide provides step-by-step instructions for configuring and running the **Notes Management System** across local development environments, native servers, and containerized Docker setups.

---

## 1. Prerequisites

Before beginning, ensure your environment meets the minimum version requirements:

* **PHP:** `8.2.0` or higher (compatible with `php:8.2.35-apache`)
  * Required extensions: `pdo`, `pdo_mysql`, `mysqli`, `curl`, `mbstring`, `fileinfo`
* **Database:** MySQL `8.0+` or MariaDB `10.4+` (or compatible cloud database like TiDB)
* **Web Server:** Apache `2.4+`, Nginx, XAMPP / WampServer, or Docker
* **Git:** Version control client for cloning the repository
* *(Optional)* **Node.js:** `18.x+` (only required if running the standalone JavaScript keep-alive worker)

---

## 2. Quickstart with Docker (Recommended)

Docker provides an isolated, deterministic environment that matches production container settings.

### Step 1: Clone the Repository
```bash
git clone https://github.com/PurveshShinde/Notes_Management_System.git
cd Notes_Management_System
```

### Step 2: Build the Docker Image
The project includes a hardened [Dockerfile](Dockerfile) with PHP 8.2.35 and Apache:
```bash
docker build -t notes-management-system .
```

### Step 3: Run the Container
Expose the container on your local host (e.g., port `8080` mapped to container port `80`):
```bash
docker run -d -p 8080:80 --name notes-app notes-management-system
```

Once running, access the application in your browser at:
```text
http://localhost:8080/
```

### Using Docker Compose (Optional)
To run both the application and a local MySQL instance together, create a `docker-compose.yml`:

```yaml
version: '3.8'

services:
  web:
    build: .
    ports:
      - "8080:80"
    environment:
      - DB_SERVER=db
      - DB_USER=root
      - DB_PASS=secret
      - DB_NAME=notes
    depends_on:
      - db

  db:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: secret
      MYSQL_DATABASE: notes
    volumes:
      - ./database/notes.sql:/docker-entrypoint-initdb.d/notes.sql
      - db_data:/var/lib/mysql

volumes:
  db_data:
```

Launch with:
```bash
docker compose up -d
```

---

## 3. Native Local Setup (XAMPP / Apache / WAMP)

If you prefer running directly on a local LAMP/WAMP/XAMPP stack:

### Step 1: Clone or Move Files to Web Root
* **XAMPP (Windows):** `C:\xampp\htdocs\Notes_Management_System`
* **XAMPP / Apache (Linux):** `/var/www/html/Notes_Management_System`
* **MAMP (macOS):** `/Applications/MAMP/htdocs/Notes_Management_System`

```bash
git clone https://github.com/PurveshShinde/Notes_Management_System.git
```

### Step 2: Database Setup & Schema Import

1. Start your MySQL service via your control panel or terminal:
   ```bash
   mysql -u root -p
   ```
2. Create the target database:
   ```sql
   CREATE DATABASE notes CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```
3. Import the database schema and sample records from `database/notes.sql`:
   ```bash
   mysql -u root -p notes < database/notes.sql
   ```
   *Alternatively, open phpMyAdmin (`http://localhost/phpmyadmin`), click **Import**, select `database/notes.sql`, and execute.*

### Step 3: Configure Database Credentials

Open `user/includes/dbconnection.php` and verify or update the connection constants to match your database environment:

```php
<?php 
// DB credentials.
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','notes');

// Establish database connection via PDO
try {
    $dbh = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}
?>
```

### Step 4: Storage Directory Permissions
Ensure that the web server process has write access to the uploaded note directories:
```bash
chmod -R 755 user/folder1 user/folder2 user/folder3 user/folder4
```

### Step 5: Test via PHP Built-in Server
For quick local testing without configuring a full Apache VirtualHost:
```bash
php -S localhost:8000
```
Then visit `http://localhost:8000/` in your browser.

---

## 4. Keep-Alive Service Setup

Render free-tier hosting suspends web instances after 15 minutes of inactivity. To ensure zero cold starts and 100% crawl availability, use the built-in keep-alive daemons.

### Verify Health Endpoint
First, check that the lightweight health check probe responds with HTTP `200 OK`:
```bash
curl -i https://notes-management-system-beae.onrender.com/ping.php
# or locally:
curl -i http://localhost:8080/ping.php
```

### Option A: PHP Daemon (Integrated in Docker)
The Docker container automatically launches `services/keep_alive.php` via `entrypoint.sh`. To run it manually:
```bash
KEEP_ALIVE_URL="https://notes-management-system-beae.onrender.com/ping.php" php services/keep_alive.php
```

### Option B: Node.js Standalone Daemon
If you prefer running a background worker from a separate server or continuous integration environment:
```bash
node services/keep_alive.js
```

---

## 5. Troubleshooting & Diagnostics

| Issue | Cause | Solution |
| :--- | :--- | :--- |
| **`SQLSTATE[HY000] [2002]`** | Database server is not running or wrong host | Ensure MySQL is active and verify `DB_HOST` in `user/includes/dbconnection.php`. |
| **`404 Not Found` on subpages** | Missing web server alias or rewrite rules | Verify that your server's DocumentRoot correctly targets the project root. |
| **File uploads fail** | Directory write permissions restricted | Grant write permissions (`chmod 755` or `chmod 777` locally) to `user/folder1` through `user/folder4`. |
| **Missing images or CSS** | Incorrect relative asset paths | Ensure assets are accessed via root paths matching the virtual host configuration. |

