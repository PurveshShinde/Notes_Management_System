# Contributing to Notes Management System

Thank you for your interest in contributing to the **Notes Management System**! We welcome contributions from developers of all skill levels. Whether you are fixing a bug, improving documentation, designing new UI features, or optimizing backend performance, your help makes this project better for everyone.

Please take a few moments to review these guidelines before submitting a contribution.

---

## Code of Conduct

By participating in this project, you agree to abide by our [Code of Conduct](CODE_OF_CONDUCT.md). Please read it to ensure a welcoming, respectful, and inclusive environment.

---

## How Can I Contribute?

### 1. Reporting Bugs
Before submitting an issue, please check the existing GitHub Issues to see if the bug has already been reported.

When creating a new bug report, include:
- **A clear, descriptive title.**
- **Steps to reproduce the behavior:** Exact steps, URLs, or inputs that cause the error.
- **Expected vs. actual behavior:** What you expected to happen versus what actually happened.
- **Environment details:** PHP version, web server (Apache/Nginx/XAMPP/Docker), database version, and browser.
- **Screenshots or error logs:** If applicable (ensure sensitive credentials are redacted).

### 2. Suggesting Enhancements
Feature requests are always appreciated! When suggesting a feature:
- Provide a concise summary of the proposed enhancement.
- Explain the user problem or use case it solves.
- Outline any technical implementation considerations (e.g., changes to `tblnotes`, frontend templates, or session handlers).

### 3. Submitting Pull Requests

Follow this workflow to submit code contributions:

1. **Fork the Repository:** Create your own fork of `PurveshShinde/Notes_Management_System`.
2. **Clone your fork locally:**
   ```bash
   git clone https://github.com/<your-username>/Notes_Management_System.git
   cd Notes_Management_System
   ```
3. **Create a dedicated topic branch:**
   ```bash
   git checkout -b feature/your-feature-name
   # or
   git checkout -b fix/issue-description
   ```
4. **Develop and test your changes:**
   - Adhere to the code conventions outlined below.
   - Verify changes locally across desktop and mobile screen sizes.
   - Test database queries and form validations.
5. **Commit your changes:**
   Use clear, conventional commit messages:
   ```bash
   git commit -m "feat(auth): add password complexity validator"
   git commit -m "fix(notes): resolve file replacement thumbnail preview bug"
   ```
6. **Push to your fork:**
   ```bash
   git push origin feature/your-feature-name
   ```
7. **Open a Pull Request:** Open a PR against the `main` branch of `PurveshShinde/Notes_Management_System`.

---

## Development & Coding Standards

### PHP Standards
- **PHP 8.2 Compatibility:** Ensure code runs seamlessly on PHP 8.2+ without deprecation warnings.
- **Security & Data Access:**
  - Always use **PDO prepared statements** with parameter binding (`bindParam` or execute array) for SQL queries.
  - Never concatenate raw user input into SQL statements.
  - Sanitize user inputs and escape outputs to prevent Cross-Site Scripting (XSS).
- **Naming Conventions:**
  - Variables: `$camelCase` or `$snake_case` (consistent with surrounding file).
  - Constants: `UPPER_CASE_SNAKE`.
  - Database table columns: Follow existing schema naming (`ID`, `UserID`, `NotesTitle`, `CreationDate`).

### Frontend Standards
- **HTML/CSS/JS:**
  - Semantic HTML5 structure.
  - Bootstrap 5 utility classes and responsive grids.
  - Clean vanilla JavaScript (ES6+) or jQuery where already integrated.
  - Mobile responsiveness: Test at breakpoints (`<576px`, `768px`, `992px`, `1200px`).

### File Upload Pipeline
- Restrict file types to approved document extensions (`.pdf`, `.doc`, `.docx`, `.txt`, `.ppt`, `.pptx`).
- Store uploaded documents in their designated folders (`user/folder1/`, `user/folder2/`, etc.) with sanitized, collision-resistant filenames.

---

## Review Process

Every Pull Request is reviewed by maintainers according to:
- **Code Quality:** Readability, modularity, and adherence to existing project patterns.
- **Security:** Verification of query parameters, CSRF mitigation, and session handling.
- **Backward Compatibility:** Safe schema migrations without breaking existing records in `tblnotes` or `tbluser`.
- **Documentation:** Updating relevant Markdown documentation if architecture or installation steps change.

---

## Project Maintainers

- **Purvesh Shinde** ([@PurveshShinde](https://github.com/PurveshShinde)) - Lead Maintainer
- **Amey Gawade** ([@ameyg11](https://github.com/ameyg11)) - Core Contributor
- **Prathamesh Ambekar** ([@PrathameshAmbekar15](https://github.com/PrathameshAmbekar15)) - Core Contributor

Feel free to reach out via GitHub Issues or contact `shindepurvesh007@gmail.com` with any questions.

