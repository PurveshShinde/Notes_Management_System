# Security Policy & Privacy Guidelines

The **Notes Management System** team takes the security and integrity of our codebase, infrastructure, and user data seriously. This document outlines our vulnerability disclosure process, security controls, and privacy commitments.

---

## Supported Versions

Security patches and bug fixes are prioritized for the current active production release branch.

| Version / Branch | Supported | Notes |
| :--- | :---: | :--- |
| `main` (PHP 8.2.35) | :white_check_mark: | Currently active production branch |
| Legacy / Older Releases | :x: | Unsupported; users must upgrade to `main` |

---

## Reporting a Vulnerability

If you discover a security vulnerability or potential exploit within this project, please report it privately rather than opening a public issue on GitHub.

### How to Report
Send a detailed vulnerability report via email to our lead maintainer:

* **Lead Maintainer:** Purvesh Shinde
* **Email:** [shindepurvesh007@gmail.com](mailto:shindepurvesh007@gmail.com)
* **Subject Line:** `[SECURITY] Potential Vulnerability in Notes Management System`

### What to Include
To help us triage and resolve the issue quickly, please provide:
1. **Description of the vulnerability:** A concise overview of the finding and its potential impact.
2. **Steps to reproduce / Proof of Concept (PoC):** Step-by-step instructions or script reproducing the issue.
3. **Affected files or endpoints:** The specific URLs, templates, or database queries involved.
4. **Proposed mitigation:** If you have suggestions or a patch to resolve the issue.

### Our Commitment
* **Initial Response:** We will acknowledge receipt of your report within **48 hours**.
* **Assessment & Fix:** We will assess the severity and keep you updated on progress toward a patch.
* **Coordinated Disclosure:** We kindly request that you refrain from publicly disclosing the issue until a fix has been tested and deployed.

---

## Security Hardening & Defenses

### 1. Base Image Pinning (Applied: 2026-10-23)
To ensure deterministic, reproducible builds and mitigate vulnerabilities affecting unpatched PHP runtimes, the project's [Dockerfile](Dockerfile) explicitly pins the official base image:

| Parameter | Floating Base (Deprecated) | Hardened Base (Current) |
| :--- | :--- | :--- |
| **Image Tag** | `php:8.2-apache` | `php:8.2.35-apache` |
| **Patch Level** | Non-deterministic / Variable | **8.2.35 (Verified)** |
| **Build Stability** | Susceptible to upstream changes | Fully deterministic and audited |

### 2. SQL Injection Prevention
All user-facing and backend database interactions utilize **PHP Data Objects (PDO)** with parameterized prepared statements. User inputs are bound via `:placeholder` bindings rather than direct string interpolation, rendering SQL injection vectors ineffective.

```php
// Standard query pattern enforced throughout the codebase
$sql = "SELECT ID, FullName, Password FROM tbluser WHERE Email = :email OR MobileNumber = :mobno";
$query = $dbh->prepare($sql);
$query->bindParam(':email', $email, PDO::PARAM_STR);
$query->bindParam(':mobno', $mobno, PDO::PARAM_INT);
$query->execute();
```

### 3. File Upload Safety & Partitioning
* **Collision-Resistant Naming:** Uploaded documents are renamed using MD5 cryptographic hashes concatenated with timestamps.
* **Partitioned File Storage:** File uploads are segregated across dedicated subdirectories (`user/folder1/` through `user/folder4/`) rather than an executable script directory.
* **Restricted File Types:** Permitted file extensions are constrained to educational document types (e.g., `.pdf`, `.doc`, `.docx`, `.txt`, `.ppt`, `.pptx`).

### 4. Session Isolation & Access Control
* Protected portal pages (`user/*.php`) enforce active session checks against `$_SESSION['ocasuid']`.
* Unauthorized requests are immediately redirected to the authentication gateway.
* Passwords are stored in hashed formats to prevent plaintext exposure.

---

## Privacy Policy & Data Handling

### Data Collection
The Notes Management System collects only the minimum necessary data required to deliver core functionality:
* **Account Information:** Full name, email address, mobile number, and authentication hash.
* **Content:** Uploaded study notes, titles, descriptions, and accompanying document attachments.

### Data Ownership & User Rights
1. **Self-Service Note Deletion:** Users have complete control over their content and can delete or replace attached files at any time via `manage-notes.php`.
2. **Account Deletion:** Users can permanently delete their profile and associated notes via `user/delete-account.php`. Once confirmed, user records and files are purged from the database.
3. **No Third-Party Tracking:** The application contains zero third-party advertising scripts or user-tracking pixels.

---

## Contact

For security or privacy inquiries, contact:
* **Lead Maintainer:** Purvesh Shinde
* **Email:** [shindepurvesh007@gmail.com](mailto:shindepurvesh007@gmail.com)
* **Repository:** [https://github.com/PurveshShinde/Notes_Management_System](https://github.com/PurveshShinde/Notes_Management_System)

